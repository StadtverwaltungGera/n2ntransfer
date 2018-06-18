<?php

namespace OCA\n2ntransfer\AppInfo;

use OCA\N2ntransfer\Controller\PageController;
use OCP\AppFramework\App;
use OCP\IContainer;

class Application extends App {

	/**
	 * Application constructor.
	 * @param array $urlParams
	 */
	public function __construct(array $urlParams = array()) {
		parent::__construct('n2ntransfer', $urlParams);
	}
}
