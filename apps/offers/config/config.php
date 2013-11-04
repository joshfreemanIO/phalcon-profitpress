<?php

return new \Phalcon\Config(array(

	'application' => array(
		'controllersDir' => __DIR__ . '/../app/controllers/',
		'modelsDir'      => __DIR__ . '/../app/models/',
		'viewsDir'       => __DIR__ . '/../app/views/',
		'pluginsDir'     => __DIR__ . '/../app/plugins/',
		'libraryDir'     => __DIR__ . '/../app/library/',
		'formsDir'       => __DIR__ . '/../app/forms/',
		'baseUri'        => '/',
	),
	'models' => array(
		'metadata' => array(
			'adapter' => 'Memory'
		)
	)
));
