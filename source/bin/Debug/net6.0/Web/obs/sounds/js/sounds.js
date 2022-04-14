var xmlhttp = new XMLHttpRequest();
var animating = false;
var doUpdate = false;

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
    loadSounds();
  }
}

function isEmpty(obj) {
    return Object.keys(obj).length === 0;
}

// Set Audio File
function setAudio(audio) {
	sound = new Howl({
		src: [audio]
	});
}

function loadSounds() {
	// Load Data
	$.getJSON('/api.php?state=get&table=gb_sounds_queue&order="id"&order_state=asc&limit=1', function(data) {

	if (!isEmpty(data)) {

        setAudio("files/" + data[0]["file"]);

	    // Sound Volume Handler
	    Howler.volume(0.2);
        deletePlayed(data[0]["id"]);
		
		sound.play();
		console.log("Audio queue finished");
		isPlaying = false;

		} else {
			console.log("Waiting for a Sound Call");
		}
	})
}

// Perform SQL Delete on Viewed
function deletePlayed(id) {
	$.ajax({
		type: "POST",
		url: "/api.php?state=delete&table=gb_sounds_queue&column=id&value=" + id,
		success: function()
		{
		  console.log("Info: Deleted SQL Row " + id);
		}
	});
}