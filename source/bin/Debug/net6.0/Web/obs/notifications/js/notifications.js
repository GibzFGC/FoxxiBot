var xmlhttp = new XMLHttpRequest();	
    
var animating = false;
var doUpdate = false;
var isPlaying = false;

// Set Audio File
function setAudio(audio) {
	sound = new Howl({
		src: [audio]
	});
}

function init() {
	xmlhttp.overrideMimeType('application/json');

	var timeout = this.window.setInterval(function() {
		pollHandler();
	}, 1000);
}

function pollHandler()
{
	doUpdate = true;
	if (!animating && doUpdate) {
		loadEvents();
	}
}

function isEmpty(obj) {
    return Object.keys(obj).length === 0;
}

function loadEvents() {
	// Load Data
	$.getJSON('/api.php?state=get&table=gb_twitch_events&order="id"&order_state=asc&limit=1', function(data) {

	if (!isEmpty(data)) {
		if (document.getElementById('json').innerHTML !== data[0]["type"] + " - " + data[0]["user"]) {
			animation(data[0]["id"], data[0]["type"], data[0]["user"], data[0]["viewers"]);
		}

		} else {
			console.log("Waiting for an Event");
		}
	})
}

// Perform SQL Delete on Viewed
function deletePlayed(id) {
	$.ajax({
		type: "POST",
		url: "/api.php?state=delete&table=gb_twitch_events&column=id&value=" + id,
		success: function()
		{
		  console.log("Info: Deleted SQL Row " + id);
		}
	});
}

// Start Animation Cycle
function animation(id, type, user, viewers) {

	// Check Flag
	console.log("Animation Flag");

	// Check if latest action is a follow
	if (type == "Follower") {
		$("#background").removeClass("host");
		$("#background").removeClass("raid");

		setAudio("audio/follow.wav");
		$("#background").addClass("follow");
		// char = '<img class="anim" style="margin-left: 90px;" src="img/thank_you.gif'+"?a="+Math.random() +'" />';
		quote = "Welcome our new foxy friend, <br>" + user + "!";
	}

	// Check if latest action is a host
	if (type == "Host") {
		$("#background").removeClass("follow");
		$("#background").removeClass("raid");

		setAudio("audio/host.wav");
		$("#background").addClass("host");
		// char = '<img class="anim" src="img/megablast.gif'+"?a="+Math.random() +'" />';
		quote = "Whoa, a host of "+ viewers + " viewers from <br>" + user + "!";	
	}

	// Check if latest action is a raid
	if (type == "Raid") {
		$("#background").removeClass("host");
		$("#background").removeClass("follower");

		setAudio("audio/raid.wav");
		$("#background").addClass("raid");
		// char = '<img class="anim" style="margin-left: 50px; transform: scaleX(-1);" src="img/proto.gif'+"?a="+Math.random() +'" />';
		quote = "A foxy raid of "+ viewers + " viewers from <br>" + user + "!";
	}

	// Check if latest action is a Birthday
	if (type == "Birthday") {
		$("#background").removeClass("host");
		$("#background").removeClass("follower");

		$("#background").addClass("birthday");
		char = '<img class="anim" style="margin-left: 50px; transform: scaleX(-1);" src="img/proto.gif'+"?a="+Math.random() +'" />';
		quote = "Make sure to wish " + user + " a happy Birthday!";
	}

	// Reset GIF Animation
	window.restartAnim = function () {
		img.src = "";
		img.src = char;
	}
	
	// Audio handler on Data Changed
	Howler.volume(0.2);
	sound.play();

	$("#background").animate({ opacity: 0}, 0)
		.animate({ opacity: 1}, "slow");

	$("#char").animate({ opacity: 0}, 0)
		.html(char)
		.animate({ opacity: 1}, "slow");

	$("#user").animate({ opacity: 0}, 0)
		.html(quote)
		.animate({ opacity: 1}, "slow");

	var anim_time = setTimeout(function() {
	$("#background").animate({ opacity: 1}, 1)
		.animate({ opacity: 0}, "slow");

	$("#char").animate({ opacity: 1}, 1)
		.html(char)
		.animate({ opacity: 0}, "slow");

	$("#user").animate({ opacity: 1}, 1)
		.html(quote)
		.animate({ opacity: 0}, "slow", function() {

			// Set Anim Status End!
			deletePlayed(id);
			console.log("Animation queue finished");
			isPlaying = false;
			clearTimeout(anim_time);

		});
	}, 6500);

	document.getElementById('json').innerHTML = type + " - " + user;
}