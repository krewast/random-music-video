<?php

// Kickstart the framework
$f3 = require('lib/base.php');

// Load configuration
$f3->config('config.ini');

// Routes
$f3->route('GET /', function($f3) {
	$f3->set('title', 'Main');
	$f3->set('content', 'video.html');
	echo View::instance()->render('layout.html');
});

$f3->route('GET /api/randomvideoid', function($f3) {
	$videoIDs = file('data/videoids.csv');
	$randomVideoID = str_replace(array("\r", "\n"), '', $videoIDs[array_rand($videoIDs)]);

	$returnObject = new stdClass();
	$returnObject->randomVideoID = $randomVideoID;
	echo json_encode($returnObject);
});

$f3->route('GET /about', function($f3) {
	$f3->set('title', 'About');
	$f3->set('content', 'about.html');
	echo View::instance()->render('layout.html');
});

$f3->set('ONERROR', function($f3) {
	$f3->set('title', 'Error');
	$f3->set('content', '404.html');
	echo View::instance()->render('layout.html');
});

$f3->run();
