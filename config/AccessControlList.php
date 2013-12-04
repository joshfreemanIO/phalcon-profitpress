<?php

$acl = new \Phalcon\Acl\Adapter\Memory();

// Default action is deny access
$acl->setDefaultAction(Phalcon\Acl::DENY);

/**
 * Create Roles
 */
$roleAdmins 	= new \Phalcon\Acl\Role('Administrators', 'Application Super User');
$roleTier3  	= new \Phalcon\Acl\Role('Tier 3', 'Tier 3 Owner');
$roleTier2  	= new \Phalcon\Acl\Role('Tier 2', 'Tier 2 Owner');
$roleTier1Plus  = new \Phalcon\Acl\Role('Tier 1+', 'Tier 1+ Owner');
$roleTier1  	= new \Phalcon\Acl\Role('Tier 1', 'Tier 1 Owner');
$roleGuests 	= new \Phalcon\Acl\Role('Guest', 'Unauthenticated users');

/**
 * Generate Role Hierarchy
 */
$acl->addRole($roleGuests);
$acl->addRole($roleTier1, $roleGuests);
$acl->addRole($roleTier1Plus, $roleTier1);
$acl->addRole($roleTier2, $roleTier1Plus);
$acl->addRole($roleTier3, $roleTier2);
$acl->addRole($roleAdmins, $roleTier3);


require_once __APPSDIR__.'account/config/AccessControlList.php';
require_once __APPSDIR__.'blog/config/AccessControlList.php';
require_once __APPSDIR__.'offers/config/AccessControlList.php';
require_once __APPSDIR__.'permalink/config/AccessControlList.php';
require_once __APPSDIR__.'site/config/AccessControlList.php';

return $acl;