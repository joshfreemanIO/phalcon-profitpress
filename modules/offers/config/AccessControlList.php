<?php

$acl = new \Phalcon\Acl\Adapter\Memory();

// Default action is deny access
$acl->setDefaultAction(Phalcon\Acl::DENY);

/**
 * Create Roles
 */
$roleAdmins = new \Phalcon\Acl\Role("Administrators", "Application Super User");
$roleOwner  = new \Phalcon\Acl\Role("Owner", "Site Owner");
$roleGuests = new \Phalcon\Acl\Role("Guests", "Unauthenticated users");

$acl->addRole($roleGuests);
$acl->addRole($roleOwner, $roleGuests);
$acl->addRole($roleAdmins, $roleOwner);

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
