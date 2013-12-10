<?php

/**
 * Handle 'posts' Module-Specific Routes
 */
$posts = new \Phalcon\Mvc\Router\Group(array(
    'module' => 'posts',
    'controller' => 'posts',
    'action' => 'viewall',
    ));

$posts->setPrefix('/posts');

// $posts->add('/:controller/:action/:params', array(
//     'controller'  => 1,
//     'action'      => 2,
//     'params'      => 3,
//     ));

// $posts->add("/:controller/:action", array(
//     'controller'  => 1,
//     'action'      => 2,
//     ));

$posts->add("/:action/:params", array(
	'controller' => 'posts',
    'action'  => 1,
    'params'  => 2,
    ));

// $router->add('/posts/posts/viewall', array(
//     'namespace' => 'ProfitPress\Posts\Controllers\PostsController',
//     'module' => 'posts',
//     'controller'  => 'posts',
//     'action'      => 'viewall',
//     ));

$router->mount($posts);
