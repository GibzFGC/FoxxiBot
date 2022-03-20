$(run = function() {

	var items = [];
	var json = {};

	// Set Socket URL
	let socket = new ReconnectingWebSocket("ws://localhost:24000");

	socket.onopen = function() {
		socket.send("GetStreamGame end");

		function gameCheck() {
			console.log("Looking for a game update...");
			socket.send("GetStreamGame end");
		}

		function updateGame() {
			if (document.getElementById('game_title').innerHTML !== json["data"][0].stream_game) {
				console.log("Update found: " + json["data"][0].stream_game);
				$("#game_title").animate({ opacity: 0}, 0)
				.html(json["data"][0].stream_game)
				.animate({ opacity: 1}, "slow");

				document.getElementById('json').innerHTML = json["data"][0].stream_game;
			}
		}

		socket.onmessage = function(e) {
			json = JSON.parse(e.data);
		};

		// This handles EVERYTHING!
		var timeout = window.setInterval(function() {
			gameCheck();
			updateGame();
		}, 5000);

	}

});

