<?php

$acl->setDefaultAction(\Phalcon\Acl::DENY);

$resourceName = "ProfitPress\Offers\Controllers\OffersController";

$resourceOffers = new \Phalcon\Acl\Resource($resourceName);

$acl->addResource($resourceOffers, "view");
$acl->allow("Guests", $resourceName, "view");

$acl->addResource($resourceOffers, "viewall");
$acl->allow("Guests", $resourceName, "viewall");

$acl->addResource($resourceOffers, "create");
$acl->allow("Guests", $resourceName, "create");

$acl->addResource($resourceOffers, "choosetemplate");
$acl->allow("Guests", $resourceName, "choosetemplate");
