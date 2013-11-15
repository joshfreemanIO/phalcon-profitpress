<?php

$resourceName = "ProfitPress\Blog\Controllers\PostsController";

$resourceOffers = new \Phalcon\Acl\Resource($resourceName);

$acl->addResource($resourceOffers, "show");
$acl->allow("Guest", $resourceName, "show");

$acl->addResource($resourceOffers, "view");
$acl->allow("Tier 1", $resourceName, "view");

$acl->addResource($resourceOffers, "viewall");
$acl->allow("Tier 1", $resourceName, "viewall");

$acl->addResource($resourceOffers, "create");
$acl->allow("Tier 1", $resourceName, "create");
