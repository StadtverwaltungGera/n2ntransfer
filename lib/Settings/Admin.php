<?php
/**
*	Icon by https://glyph.smarticons.co/
*/
namespace OCA\GenericTrigger\Settings;
// echo "<br/><br/><br/><br/>".__FILE__;
// $h=fopen("generictrigger.log", "a+");
// fwrite($h, date("Y-m-d H:i:s")."\n");
// fclose($h);
// die();
// use OCA\Generictrigger\Collector;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\IConfig;
use OCP\IL10N;
use OCP\Settings\ISettings;

class Admin implements ISettings {

        /** @var Collector */
        private $collector;

        /** @var IConfig */
        private $config;

        /** @var IL10N */
        private $l;

        /**
         * Admin constructor.
         *
         * @param Collector $collector
         * @param IConfig $config
         * @param IL10N $l
         */
        public function __construct(IConfig $config, IL10N $l) {
        // public function __construct() {
                $this->collector = $collector;
                $this->config = $config;
                $this->l = $l;
        }

        /**
         * @return TemplateResponse
         */
        public function getForm() {
                $parameters = [
						'generictrigger_default_folder' 		=> $this->config->getAppValue('generictrigger', 'generictrigger_default_folder', '/files/Akten'),
						
						'generictrigger_password_cnt_alpha' 		=> $this->config->getAppValue('generictrigger', 'generictrigger_password_cnt_alpha', '3'),
						'generictrigger_password_upper_alpha' 		=> $this->config->getAppValue('generictrigger', 'generictrigger_password_upper_alpha', 'no'),
						'generictrigger_password_cnt_numbers' 		=> $this->config->getAppValue('generictrigger', 'generictrigger_password_cnt_numbers', '3'),
						'generictrigger_password_cnt_specialchars' 	=> $this->config->getAppValue('generictrigger', 'generictrigger_password_cnt_specialchars', '3'),

						'generictrigger_externalcloud_host' 		=> $this->config->getAppValue('generictrigger', 'generictrigger_externalcloud_host', ''),
						'generictrigger_externalcloud_user' 		=> $this->config->getAppValue('generictrigger', 'generictrigger_externalcloud_user', ''),
						'generictrigger_externalcloud_expiry' 		=> $this->config->getAppValue('generictrigger', 'generictrigger_externalcloud_expiry', ''),

						'generictrigger_mails_subject' 				=> $this->config->getAppValue('generictrigger', 'generictrigger_mails_subject', 'E-Akte'),
						'generictrigger_mails_from_name' 			=> $this->config->getAppValue('generictrigger', 'generictrigger_mails_from_name', ''),
						'generictrigger_mails_from' 				=> $this->config->getAppValue('generictrigger', 'generictrigger_mails_from', ''),
						
						
						
                ];
/*
generictrigger_externalcloud_pass
*/
                return new TemplateResponse('generictrigger', 'admin', $parameters);
        }

        /**
         * @return string the section ID, e.g. 'sharing'
         */

        public function getSection() {
                return 'sharing';
        }
		public function getPriority() {
			return 0;
		}
}
?>