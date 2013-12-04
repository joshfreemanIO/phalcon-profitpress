<?php

$acl = new \Phalcon\Acl\Adapter\Memory();

// Default action is deny access
$acl->setDefaultAction(Phalcon\Acl::DENY);

/**
 * Create Roles
 */
$roleTier3  	= new \Phalcon\Acl\Role('Tier 3', 'Tier 3');
$roleTier2  	= new \Phalcon\Acl\Role('Tier 2', 'Tier 2');
$roleTier1Plus  = new \Phalcon\Acl\Role('Tier 1+', 'Tier 1+');
$roleTier1  	= new \Phalcon\Acl\Role('Tier 1', 'Tier 1');

/**
 * Generate Role Hierarchy
 */
$acl->addRole($roleGuests);
$acl->addRole($roleTier1, $roleGuests);
$acl->addRole($roleTier1Plus, $roleTier1);
$acl->addRole($roleTier2, $roleTier1Plus);
$acl->addRole($roleTier3, $roleTier2);
$acl->addRole($roleAdmins, $roleTier3);


require_once __APPSDIR__.'account/config/AccessControlList-Tier.php';
require_once __APPSDIR__.'blog/config/AccessControlList-Tier.php';
require_once __APPSDIR__.'offers/config/AccessControlList-Tier.php';
require_once __APPSDIR__.'permalink/config/AccessControlList-Tier.php';
require_once __APPSDIR__.'site/config/AccessControlList-Tier.php';

return $acl;