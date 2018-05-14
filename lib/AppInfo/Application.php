<?php

namespace OCA\Generictrigger\AppInfo;

use OCA\Generictrigger\Controller\PageController;
use OCP\AppFramework\App;
use OCP\IContainer;

class Application extends App {

	/**
	 * Application constructor.
	 * @param array $urlParams
	 */
	public function __construct(array $urlParams = array()) {
		parent::__construct('generictrigger', $urlParams);

		// $container = $this->getContainer();
		// $server = $container->getServer();

		/**
		 * Controllers
		 */
		// $container->registerService('PageController', function (IContainer $c) {
			// return new PageController(
				// $c->query('AppName'),
				// $c->query('Request'),
				// $c->query('UserManager'),
				// $c->query('GroupManager'),
				// $c->query('AvatarManager'),
				// $c->query('Logger'),
				// $c->query('L10N'),
				// $c->query('ServerContainer')->getURLGenerator(),
				// $c->query('UserId'),
				// $c->query('CommentMapper'),
				// $c->query('DateMapper'),
				// $c->query('EventMapper'),
				// $c->query('NotificationMapper'),
				// $c->query('ParticipationMapper'),
				// $c->query('ParticipationTextMapper'),
				// $c->query('TextMapper')
			// );
		// });

		// $container->registerService('UserManager', function (IContainer $c) {
			// return $c->query('ServerContainer')->getUserManager();
		// });
	}

	/**
	 * Register navigation entry for main navigation.
	 */
	// public function registerNavigationEntry() {
		// $container = $this->getContainer();
		// $container->query('OCP\INavigationManager')->add(function () use ($container) {
			// $urlGenerator = $container->query('OCP\IURLGenerator');
			// $l10n = $container->query('OCP\IL10N');
			// return [
				// 'id' => 'polls',
				// 'order' => 77,
				// 'href' => $urlGenerator->linkToRoute('polls.page.index'),
				// 'icon' => $urlGenerator->imagePath('polls', 'app.svg'),
				// 'name' => $l10n->t('Polls')
			// ];
		// });
	// }
}
