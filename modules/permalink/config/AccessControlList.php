<?php

$resourceName = "ProfitPress\Permalink\Controllers\PermalinkController";

$resourcePermalink = new \Phalcon\Acl\Resource($resourceName);

$acl->addResource($resourcePermalink, "forward");
$acl->allow("Guest", $resourceName, "forward");

$acl->addResource($resourcePermalink, "createPermalink");
$acl->allow("Tier 1", $resourceName, "createPermalink");