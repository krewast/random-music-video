<?php

// Kickstart the framework
$f3 = require('lib/base.php');

$f3->set('DEBUG', 1);

// Load configuration
$f3->config('config.ini');

$f3->route('GET /',
	function($f3) {
		// Go to random video
	}
);

$f3->route('GET /v/@videoid',
	function($f3) {
		$videoid = $params['videoid'];

		$f3->set('content','video.html');
		echo View::instance()->render('layout.htm');
	}
);

$f3->route('GET /about',
	function($f3) {
		$f3->set('content','about.html');
		echo View::instance()->render('layout.htm');
	}
);

$f3->run();
