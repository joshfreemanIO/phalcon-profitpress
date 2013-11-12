<?php

$resourceName = "ProfitPress\Permalink\Controllers\PermalinkController";

$resourcePermalink = new \Phalcon\Acl\Resource($resourceName);

$acl->addResource($resourcePermalink, "forward");
$acl->allow("Guests", $resourceName, "forward");

$acl->addResource($resourcePermalink, "createPermalink");
$acl->allow("Owner", $resourceName, "createPermalink");