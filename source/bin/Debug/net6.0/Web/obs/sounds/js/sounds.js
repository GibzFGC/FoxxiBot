var xmlhttp = new XMLHttpRequest();
var isPlaying = false;
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
if (isPlaying == false && doUpdate) {
    loadSounds();
  }
}

function isEmpty(obj) {
    return Object.keys(obj).length === 0;
}

// Set Audio File
function setAudio(audio) {
	sound = new Howl({
		src: [audio],
		autoplay: true,
		loop: false,
	});
}

function loadSounds() {
	// Load Data
	$.getJSON('/api.php?state=get&table=gb_sounds_queue&order="id"&order_state=asc&limit=1', function(data) {

	if (!isEmpty(data)) {

		// Set isPlaying
		isPlaying = true;

		// Play the Next Sound
		setAudio("files/" + data[0]["file"]);

		// Fires when the sound finishes playing.
		sound.on('end', function(){
			deletePlayed(data[0]["id"]);
			console.log("Audio queue finished");
			isPlaying = false;
  		});
		
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