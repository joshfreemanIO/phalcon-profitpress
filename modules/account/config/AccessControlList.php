<?php

$resourceName = "ProfitPress\Account\Controllers\AccountController";

$resourceOffers = new \Phalcon\Acl\Resource($resourceName);

$acl->addResource($resourceOffers, "create");
$acl->allow("Guest", $resourceName, "create");

$acl->addResource($resourceOffers, "delete");
$acl->allow("Guest", $resourceName, "delete");


// $acl->addResource($resourceOffers, "viewall");
// $acl->allow("Guest", $resourceName, "viewall");

// $acl->addResource($resourceOffers, "create");
// $acl->allow("Tier 1", $resourceName, "create");

// $acl->addResource($resourceOffers, "choosetemplate");
// $acl->allow("Tier 1", $resourceName, "choosetemplate");
