<?php

return new \Phalcon\Config(array(

	'application' => array(
		'controllersDir' => __DIR__.'../controllers/',
		'modelsDir'      => __DIR__.'../models/',
		'viewsDir'       => __DIR__.'../views/',
		'pluginsDir'     => __DIR__.'../plugins/',
		'libraryDir'     => __DIR__.'../library/',
		'formsDir'       => __DIR__.'../forms/',
	)
));
