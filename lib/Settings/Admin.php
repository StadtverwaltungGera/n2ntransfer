<?php
/**
*	Icon by https://glyph.smarticons.co/
*/
namespace OCA\n2ntransfer\Settings;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\IConfig;
use OCP\IL10N;
use OCP\Settings\ISettings;

class Admin implements ISettings {

        /** @var Collector */
#        private $collector;

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
#                $this->collector = $collector;
                $this->config = $config;
                $this->l = $l;
        }

        /**
         * @return TemplateResponse
         */
        public function getForm() {
                $parameters = [
			'n2ntransfer_default_folder' 			=> $this->config->getAppValue('n2ntransfer', 'n2ntransfer_default_folder', '/files/Akten'),
			'n2ntransfer_password_cnt_alpha'		=> $this->config->getAppValue('n2ntransfer', 'n2ntransfer_password_cnt_alpha', '3'),
			'n2ntransfer_password_upper_alpha' 		=> $this->config->getAppValue('n2ntransfer', 'n2ntransfer_password_upper_alpha', 'no'),
			'n2ntransfer_password_cnt_numbers' 		=> $this->config->getAppValue('n2ntransfer', 'n2ntransfer_password_cnt_numbers', '3'),
			'n2ntransfer_password_cnt_specialchars' 	=> $this->config->getAppValue('n2ntransfer', 'n2ntransfer_password_cnt_specialchars', '3'),

			'n2ntransfer_externalcloud_host'		=> $this->config->getAppValue('n2ntransfer', 'n2ntransfer_externalcloud_host', ''),
			'n2ntransfer_externalcloud_user'		=> $this->config->getAppValue('n2ntransfer', 'n2ntransfer_externalcloud_user', ''),
			'n2ntransfer_externalcloud_expiry' 		=> $this->config->getAppValue('n2ntransfer', 'n2ntransfer_externalcloud_expiry', ''),

			'n2ntransfer_mails_subject' 			=> $this->config->getAppValue('n2ntransfer', 'n2ntransfer_mails_subject', 'E-Akte'),
			'n2ntransfer_mails_from_name' 			=> $this->config->getAppValue('n2ntransfer', 'n2ntransfer_mails_from_name', ''),
			'n2ntransfer_mails_from' 			=> $this->config->getAppValue('n2ntransfer', 'n2ntransfer_mails_from', ''),
                ];
                return new TemplateResponse('n2ntransfer', 'admin', $parameters);
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