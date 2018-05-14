<?php
/**
 * Create your routes in here. The name is the lowercase name of the controller
 * without the controller part, the stuff after the hash is the method.
 * e.g. page#index -> OCA\GenericTrigger\Controller\PageController->index()
 *
 * The controller class has to be registered in the application.php file since
 * it's instantiated in there
 */
// print_r($_REQUEST);
// die();
return [
    'routes' => [
		['name' => 'page#index', 'url' => '/', 'verb' => 'GET'],
		['name' => 'page#collect', 'url' => '/', 'verb' => 'POST'],
	   // ['name' => 'page#foo', 'url' => '/echo', 'verb' => 'GET'],
	   // ['name' => 'collection#do_echo', 'url' => '/echo', 'verb' => 'POST'],
    ]
];
