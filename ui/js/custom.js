$(document).foundation();

$(function() {
	$('#next-video-button').click(function() {
		playNextVideo();
	})
});

// YouTube JavaScript Player
// ----------------------------------------

var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

var nextVideoID = getRandomVideoID();

var player;
function onYouTubeIframeAPIReady() {
	player = new YT.Player('player', {
		height: '315',
		width: '560',
		videoId: nextVideoID,
		events: {
			'onReady': onPlayerReady,
			'onStateChange': onPlayerStateChange,
			'onError': playNextVideo
		}
	});
}

// YouTube JavaScript Player Functions
// ----------------------------------------

function onPlayerReady(event) {
	player.playVideo();
}

function onPlayerStateChange(event) {
	// Play next video as soon as the current one ends
	if (event.data == YT.PlayerState.ENDED) {
		playNextVideo();
	}
}

function playNextVideo(event) {
	var randomVideoID = getRandomVideoID();
	// Start playing the next video
	player.loadVideoById(randomVideoID);
}

// API Functions
// ----------------------------------------

function getRandomVideoID() {
	// Get new videoID from the API
	var randomVideoID = '';
	$.ajax({
		url: '/api/randomvideoid',
		dataType: 'json',
		async: false,
		success: function(jsonData) {
			randomVideoID = jsonData.randomVideoID;
		}
	});
	return randomVideoID;
}
