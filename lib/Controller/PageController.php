<?php
namespace OCA\N2ntransfer\Controller;

use OCP\IRequest;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Http\RedirectResponse;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Controller;
use OCP\IUserSession;
use OCP\IURLGenerator;
use OCP\IL10N;

class PageController extends Controller {
	private $userdata;
	private $files;
	private $checked_files;
	protected $urlGenerator;
	/** @var IL10N */
	private $l;

	public function __construct($AppName, IRequest $request, IURLGenerator $urlGenerator, IUserSession $userSession, IL10N $l){
		parent::__construct($AppName, $request);
		$this->urlGenerator = $urlGenerator;
		$this->l = $l;
		$this->userdata = array(
			'uuid'		=>	$userSession->getUser()->getUID(),
			'username'	=>	$userSession->getUser()->getDisplayName(),
			'email'		=>	$userSession->getUser()->getEMailAddress(),
			'home'		=>	$userSession->getUser()->getHome().self::getUserSubfolder(),
			'homeRel'	=>	self::getUserSubfolder(),
		);
		if(!$this->checkUserSubfolder()) die('Ordner nicht beschreibbar');
		$this->files = $this->getFolderContents($this->userdata['home']);
		unset($this->files[0]);
		sort($this->files);
		$this->relPaths($this->files);
		$this->checked_files = isset($request->parameters["checked_files"]) ? $request->parameters["checked_files"] : array();
	}

	/**
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function index() {
		return new TemplateResponse('n2ntransfer', 'index', [
			'userdata'	=>	$this->userdata,
			'files'		=>	$this->files,
		]);
	}
	/**
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function collect() {
		if(count($this->checked_files)>0) {
			$this->compressFiles($this->files, array_keys($this->checked_files));
		}
		return new RedirectResponse($this->urlGenerator->linkToRoute('files.view.index'));
	}

	private function compressFiles($all, $selected) {
		$files = array();
		foreach($selected as $k) {
			$files[] = $all[$k];
		}

		$zip = new \ZipArchive;
		$dst = date("YmdHis")."_e-akte_".$this->userdata['username'].".zip";
		$res = $zip->open($dst, \ZipArchive::CREATE);
		$password = self::generatePassword();
		$zip->setPassword($password);
		if ($res === TRUE) {
			for($i=0; $i<count($files); $i++) {
				$f = $files[$i];
				if(is_dir($this->userdata["home"]."/".$f)) {
					$zip->addEmptyDir(iconv("UTF-8","CP852", $f));
				} else {
					$zip->addFile($this->userdata["home"]."/".$f, iconv("UTF-8","CP852",$f));
				}
				$zip->setEncryptionIndex ($i, \ZipArchive::EM_AES_256);
			}

			if($zip->close()) {
				$dstFile = self::uploadExternal(dirname($_SERVER['SCRIPT_FILENAME'])."/".$dst);
				$share = self::getExternalCloudShareLink($dstFile);
				$body = $this->l->t("n2ntransfer_mail_template %s %s %s %s %s", array(implode("\n", $files), $password, round(filesize($dst)/1024, 1), $share['link'], $share['expiration']));

				$this->sendConfirmation($body);
				unlink($dst);
			}
		} else {
			echo 'Fehler, Code:' . $res;
		}
	}

	private function sendConfirmation($body) {
		$mailer = \OC::$server->getMailer();
		$message = $mailer->createMessage();
		$message->setSubject(self::getMailSubject());
		$message->setFrom([self::getMailFrom() => self::getMailFromName()]);
		$message->setTo([$this->userdata['email'] => $this->userdata['email']]);
		//	Attachments gehen erst ab Version 13
		// $att = $mailer->createAttachmentFromPath($src);
		// $message->attach($att);
		// $body = implode("\n", $meta['files'])."\n";
		// $body .= "Passwort: ".$meta['password']."\n";
		$message->setPlainBody($body);
		$result = $mailer->send($message);
		return TRUE;
	}
	
	private function checkUserSubfolder() {
		if(!is_dir($this->userdata['home'])) {
			$return = mkdir($this->userdata['home']);
			self::rescanFilesystem($this->userdata['uuid']);
			return $return;
		}
		return TRUE;
	}
	
	private static function rescanFilesystem($userId=NULL) {
		 // sudo -u apache php occ files:scan admin
		if(is_null($userId)) {$userId=" --all";}
		$cmd = "php occ files:scan ".$userId;
		exec($cmd);
	}

	private static function getFolderContents($startdir = '', $pattern='*') {
		$files = glob($startdir.$pattern, GLOB_MARK);
		foreach (glob($startdir.'*', GLOB_ONLYDIR|GLOB_NOSORT|GLOB_MARK) as $dir){
			$files = array_merge($files, self::getFolderContents($dir, $pattern));
		}
		return $files;
	}
	
	private function relPaths(&$array) {
		$removePath = $this->userdata['home']."/";
		foreach($array as &$a) {
			$a = str_replace($removePath, "", $a);
		}
	}
	
	private static function generatePassword() {
		// $useCapitalLetter	= \OC::$server->getConfig()->getAppValue('n2ntransfer', 'n2ntransfer_password_upper_alpha');
		$cnt_alpha 		= \OC::$server->getConfig()->getAppValue('n2ntransfer', 'n2ntransfer_password_cnt_alpha');
		$cnt_numbers	= \OC::$server->getConfig()->getAppValue('n2ntransfer', 'n2ntransfer_password_cnt_numbers');
		$cnt_specChar	= \OC::$server->getConfig()->getAppValue('n2ntransfer', 'n2ntransfer_password_cnt_specialchars');
		$numberChars = '123456789';
		$specialChars = '!$%&=?*-:;.,+~@_';
		$secureChars = 'abcdefghjkmnpqrstuvwxyz';
		$stack = '';
		$stack .= ($cnt_alpha>0) ? substr(str_shuffle(str_repeat($secureChars , $cnt_alpha )),0, $cnt_alpha) : "";
		$stack .= ($cnt_numbers>0) ? substr(str_shuffle(str_repeat($numberChars , $cnt_numbers )),0, $cnt_numbers) : "";
		$stack .= ($cnt_specChar>0) ? substr(str_shuffle(str_repeat($specialChars , $cnt_specChar )),0, $cnt_specChar) : "";

		if(strlen($stack)==0) {
			return "password";
		} else {
			return str_shuffle ( $stack );
		}
	} 
	
	private static function uploadExternal($file) {
		$user=self::getExternalCloudUser();
		$pass=self::getExternalCloudPassword();
		$dstFile=self::getExternalCloudURL()."/remote.php/webdav/".basename($file);
		$header="Destination: ".$dstFile;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $dstFile);
		curl_setopt($ch, CURLOPT_USERPWD, $user.":".$pass);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_HEADER, $header);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_UPLOAD, 1);

		$fh_res = fopen($file, 'r');
		rewind($fh_res);
		curl_setopt($ch, CURLOPT_INFILE, $fh_res);
		curl_setopt($ch, CURLOPT_INFILESIZE, filesize($file));

		$filedata = fread($file,filesize($file));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $filedata);

		$output = curl_exec($ch);
		$info = curl_getinfo($ch);
		curl_close($ch);
		fclose($fh_res);
		return $dstFile;
	}
	
	private static function getExternalCloudShareLink($file) {
		$file = basename($file);
		$user=self::getExternalCloudUser();
		$pass=self::getExternalCloudPassword();
		$dstFile=self::getExternalCloudURL()."ocs/v2.php/apps/files_sharing/api/v1/shares";

		$expireDate = new \DateTime('now');
		$expireDate->add(new \DateInterval('P'.self::getExternalCloudExpirationDays().'D'));

		$args = "path=".$file."&shareType=3&permissions=1&expireDate=".$expireDate->format('Y-m-d');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $dstFile);
		curl_setopt($ch, CURLOPT_USERPWD, $user.":".$pass);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded', 'OCS-APIRequest: true'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
		
		$output = curl_exec($ch);
		$info = curl_getinfo($ch);

		$xml = simplexml_load_string($output);
		curl_close($ch);
		return array("link"=>$xml->data->url, "expiration"=>$xml->data->expiration, "raw"=>$output);
	}
	private static function getUserSubfolder() {return \OC::$server->getConfig()->getAppValue('n2ntransfer', 'n2ntransfer_default_folder');}
	private static function getExternalCloudURL() {return \OC::$server->getConfig()->getAppValue('n2ntransfer', 'n2ntransfer_externalcloud_host');}
	private static function getExternalCloudUser() {return \OC::$server->getConfig()->getAppValue('n2ntransfer', 'n2ntransfer_externalcloud_user');}
	private static function getExternalCloudPassword() {return \OC::$server->getConfig()->getAppValue('n2ntransfer', 'n2ntransfer_externalcloud_pass');}	
	private static function getExternalCloudExpirationDays() {return \OC::$server->getConfig()->getAppValue('n2ntransfer', 'n2ntransfer_externalcloud_expiry');}
	private static function getMailFrom() {return \OC::$server->getConfig()->getAppValue('n2ntransfer', 'n2ntransfer_mails_from');}
	private static function getMailFromName() {return \OC::$server->getConfig()->getAppValue('n2ntransfer', 'n2ntransfer_mails_from_name');}
	private static function getMailSubject() {return \OC::$server->getConfig()->getAppValue('n2ntransfer', 'n2ntransfer_mails_subject');}
}
