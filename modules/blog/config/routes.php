<?php

/**
 * Handle 'Blog' Module-Specific Routes
 */
$blog = new \Phalcon\Mvc\Router\Group(array(
    'module' => 'blog',
    'controller' => 'posts',
    'action' => 'viewall',
    ));

$blog->setPrefix('/blog');

$blog->add('/:controller/:action/:params', array(
    'controller'  => 1,
    'action'      => 2,
    'params'      => 3,
    ));

$blog->add("/:controller/:action", array(
    'controller'  => 1,
    'action'      => 2,
    ));

$router->add('/blog/posts/viewall', array(
    'namespace' => 'ProfitPress\Blog\Controllers\PostsController',
    'module' => 'blog',
    'controller'  => 'posts',
    'action'      => 'viewall',
    ));

$router->mount($blog);