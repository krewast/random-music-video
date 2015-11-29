<?php

// Kickstart the framework
$f3 = require('lib/base.php');

// Load configuration
$f3->config('config.ini');

// Routes
$f3->route('GET /', function($f3) {
	$videoIds = file('data/videoids.csv');
	$randomVideoId = $videoIds[array_rand($videoIds)];

	$f3->reroute($randomVideoId);
});

$f3->route('GET /@videoId', function($f3, $params) {
	$videoId = (string)$params['videoId'];

	if (strlen($videoId) == 11) {
		$f3->set('videoId', $videoId);
		$f3->set('title', $videoId);
		$f3->set('content', 'video.html');
		echo View::instance()->render('layout.html');
	} else {
		$f3->error(404);
	}
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
