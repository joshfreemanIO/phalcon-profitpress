<?php

/**
 * Site Controller
 */
$controller = "ProfitPress\Site\Controllers\SiteController";

$resource = new \Phalcon\Acl\Resource($controller);

$acl->addResource($resource, "dashboard");
$acl->allow("Tier 1", $controller, "dashboard");

$acl->addResource($resource, "accountinfo");
$acl->allow("Tier 1", $controller, "accountinfo");

$acl->addResource($resource, "login");
$acl->allow("Guest", $controller, "login");

$acl->addResource($resource, "logout");
$acl->allow("Guest", $controller, "logout");

$acl->addResource($resource, "home");
$acl->allow("Guest", $controller, "home");


/**
 * Error Controller
 */
$controller = "ProfitPress\Site\Controllers\ErrorController";

$resource = new \Phalcon\Acl\Resource($controller);

$acl->addResource($resource, "error403");
$acl->allow("Tier 1", $controller, "error403");

$acl->addResource($resource, "error404");
$acl->allow("Guest", $controller, "error404");