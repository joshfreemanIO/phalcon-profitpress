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

require_once __APPSDIR__.'permalink/config/acl.php';
require_once __APPSDIR__.'offers/config/acl.php';

return $acl;
