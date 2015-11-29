<?php

// Kickstart the framework
$f3 = require('lib/base.php');

$f3->set('DEBUG', 1);

// Load configuration
$f3->config('config.ini');

// Routes
$f3->route('GET /', function($f3) {
	// Go to random video
});

$f3->route('GET /v/@videoid', function($f3, $params) {
	$videoid = (string)$params['videoid'];

	if (strlen($videoid) == 11) {
		$f3->set('content','video.html');
		echo View::instance()->render('layout.htm');
	} else {
		$f3->error(404);
	}
});

$f3->route('GET /about', function($f3) {
	$f3->set('content','about.html');
	echo View::instance()->render('layout.htm');
});

$f3->set('ONERROR', function($f3) {
	$f3->set('content','404.html');
	echo View::instance()->render('layout.htm');
});

$f3->run();
