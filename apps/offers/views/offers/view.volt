<?php
$templates = array(
	'5' => 'video2',
	'6' => 'video1',
	'9' => 'picture-2',
	);
$template = $templates[$template_id];

$this->view->partial('offertemplates/'.$template);