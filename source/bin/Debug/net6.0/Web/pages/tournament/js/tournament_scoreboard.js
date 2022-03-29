$(document).ready(function() {

	// Player 1 Name
	$('#p1_name').autoComplete({
		resolver: 'custom',
		formatResult: function (item) {
			$('#p1_tag').val(item.tag);
			$('#p1_country').val(item.country);
			$('#p1_country_code').val(item.country_code);

			$('#modal_edit_player1_tag').val(item.tag);
			$('#modal_edit_player1_name').val(item.name);
			$('#modal_edit_player1_country').val(item.country);
			$('#modal_edit_player1_country_code').val(item.country_code);

			return {
				value: item.name,
				text: item.name,
			};
		},
		events: {
			search: function (qry, callback) {
			$.ajax(
				'/api.php?state=get&table=gb_tournament_players&where=name LIKE "' + $('#p1_name').val() + '%"',
				{
					data: { 'name': qry}
				}
				).done(function (res) {
					callback(res)
				});
			}
		}
	});

	// Player 2 Name
	$('#p2_name').autoComplete({
		resolver: 'custom',
		formatResult: function (item) {
			$('#p2_tag').val(item.tag);
			$('#p2_country').val(item.country);
			$('#p2_country_code').val(item.country_code);

			$('#modal_edit_player2_tag').val(item.tag);
			$('#modal_edit_player2_name').val(item.name);
			$('#modal_edit_player2_country').val(item.country);
			$('#modal_edit_player2_country_code').val(item.country_code);

			return {
				value: item.name,
				text: item.name,
			};
		},
		events: {
			search: function (qry, callback) {
			$.ajax(
				'/api.php?state=get&table=gb_tournament_players&where=name LIKE "' + $('#p2_name').val() + '%"',
				{
					data: { 'name': qry}
				}
				).done(function (res) {
					callback(res)
				});
			}
		}
	});

	// Modal Edit Name
	$('#modal_edit_player_name').autoComplete({
		resolver: 'custom',
		formatResult: function (item) {
			$('#modal_edit_player_tag').val(item.tag);
			$('#modal_edit_player_country').val(item.country);
			$('#modal_edit_player_country_code').val(item.country_code);

			return {
				value: item.name,
				text: item.name,
			};
		},
		events: {
			search: function (qry, callback) {
			$.ajax(
				'/api.php?state=get&table=gb_tournament_players&where=name LIKE "' + $('#modal_edit_player_name').val() + '%"',
				{
					data: { 'name': qry}
				}
				).done(function (res) {
					callback(res)
				});
			}
		}
	});

	// Clear Edit Modal 1
	$("#edit_modal1_close").click(function() {
		$('#modal_edit_player1_tag').val("");
		$('#modal_edit_player1_name').val("");
		$('#modal_edit_player1_country').val("");
		$('#modal_edit_player1_country_code').val("");
	});

	// Clear Edit Modal 2
	$("#edit_modal1_close").click(function() {
		$('#modal_edit_player2_tag').val("");
		$('#modal_edit_player2_name').val("");
		$('#modal_edit_player2_country').val("");
		$('#modal_edit_player2_country_code').val("");
	});

	// Player 1 Country Loader
	$('#p1_country').autoComplete({
		resolver: 'custom',
		formatResult: function (item) {
			$('#p1_country_code').val(item.code);

			return {
				value: item.code,
				text: item.name,
			};
		},
		events: {
			search: function (qry, callback) {
			$.ajax(
				'pages/tournament/js/countries.php',
				{
					data: { 'name': qry}
				}
				).done(function (res) {
					let name = res.filter( (e) => { return e.name.indexOf(qry) > -1 } );
					callback(name)
				});
			}
		}
	});

	// Player 2 Country Loader
	$('#p2_country').autoComplete({
		resolver: 'custom',
		formatResult: function (item) {
			$('#p2_country_code').val(item.code);
			return {
				value: item.code,
				text: item.name,
			};
		},
		events: {
			search: function (qry, callback) {
			$.ajax(
				'pages/tournament/js/countries.php',
				{
					data: { 'name': qry}
				}
				).done(function (res) {
					let results = res.filter( (e) => { return e.name.indexOf(qry) > -1 } );
					callback(results)
				});
			}
		}
	});

	// Modal Country Loader
	$('#modal_player_country').autoComplete({
		resolver: 'custom',
		formatResult: function (item) {
			$('#modal_player_country_code').val(item.code);

			return {
				value: item.code,
				text: item.name,
			};
		},
		events: {
			search: function (qry, callback) {
			$.ajax(
				'pages/tournament/js/countries.php',
				{
					data: { 'name': qry}
				}
				).done(function (res) {
					let name = res.filter( (e) => { return e.name.indexOf(qry) > -1 } );
					callback(name)
				});
			}
		}
	});

	// Edit Modal Country Loader
	$('#modal_edit_player1_country').autoComplete({
		resolver: 'custom',
		formatResult: function (item) {
			$('#modal_edit_player1_country_code').val(item.code);

			return {
				value: item.code,
				text: item.name,
			};
		},
		events: {
			search: function (qry, callback) {
			$.ajax(
				'pages/tournament/js/countries.php',
				{
					data: { 'name': qry}
				}
				).done(function (res) {
					let name = res.filter( (e) => { return e.name.indexOf(qry) > -1 } );
					callback(name)
				});
			}
		}
	});

	// Edit Modal Country Loader
	$('#modal_edit_player2_country').autoComplete({
		resolver: 'custom',
		formatResult: function (item) {
			$('#modal_edit_player2_country_code').val(item.code);

			return {
				value: item.code,
				text: item.name,
			};
		},
		events: {
			search: function (qry, callback) {
			$.ajax(
				'pages/tournament/js/countries.php',
				{
					data: { 'name': qry}
				}
				).done(function (res) {
					let name = res.filter( (e) => { return e.name.indexOf(qry) > -1 } );
					callback(name)
				});
			}
		}
	});	

    // Sanitize HTML Input
	function sanitizeHTML(unsafe) {
		return unsafe
			 .replace(/&/g, "&amp;")
			 .replace(/</g, "&lt;")
			 .replace(/>/g, "&gt;")
			 .replace(/"/g, "&quot;")
			 .replace(/'/g, "&#039;");
	 }

	 // Save the Data to the Scoreboard
	 $(" #save_scoreboard" ).submit(function(e) {

		e.preventDefault(); // avoid to execute the actual submit of the form.

		var form = $(this);
		var actionUrl = form.attr('action');
		
		$.ajax({
			type: "POST",
			url: actionUrl,
			data: form.serialize(), // serializes the form's elements.
			success: function(data)
			{
                Toast.fire({
                    icon: 'success',
                    title: 'Data Saved to the Scoreboard'
                })
			}
		});
		
	 });

	 // Save the Player Data to the Database
	 $(" #save_player" ).submit(function(e) {
		e.preventDefault(); // avoid to execute the actual submit of the form.

		var form = $(this);
		var actionUrl = form.attr('action');
		
		$.ajax({
			type: "POST",
			url: actionUrl,
			data: form.serialize(), // serializes the form's elements.
			error: function(data)
			{
                Toast.fire({
                    icon: 'error',
                    title: 'An error has occured'
                })
			},
			success: function(data)
			{
                Toast.fire({
                    icon: 'success',
                    title: 'Player Saved to the Database'
                })

				// Clear Data on Save
				$('#modal_player_tag').val("");
				$('#modal_player_name').val("");
				$('#modal_player_country').val("");
				$('#modal_player_country_code').val("");

				// Close Modal
				$('#addModal').modal('toggle');
			}
		});
		
	 });

	 // Send Player 1 Edit Data to the Database
	 $(" #edit_player1" ).submit(function(e) {
		e.preventDefault(); // avoid to execute the actual submit of the form.

		var name = document.getElementById("modal_edit_player1_name").value;

		var form = $(this);
		var actionUrl = form.attr('action');
		
		$.ajax({
			type: "POST",
			url: actionUrl,
			data: form.serialize(), // serializes the form's elements.
			error: function(data)
			{
                Toast.fire({
                    icon: 'error',
                    title: 'An error has occured'
                })
			},
			success: function(data)
			{
                Toast.fire({
                    icon: 'success',
                    title: 'Player Named '+ name +' has been Updated in the Database'
                })

				$('#p1_tag').val(document.getElementById("modal_edit_player1_tag").value);
				$('#p1_country').val(document.getElementById("modal_edit_player1_country").value);
				$('#p1_country_code').val(document.getElementById("modal_edit_player1_country_code").value);

				// Clear Data on Save
				$('#modal_edit_player1_tag').val("");
				$('#modal_edit_player1_name').val("");
				$('#modal_edit_player1_country').val("");
				$('#modal_edit_player1_country_code').val("");

				// Close Modal
				$('#editModal1').modal('toggle');
			}
		});
		
	 });

	 // Send Player 2 Edit Data to the Database
	 $(" #edit_player2" ).submit(function(e) {
		e.preventDefault(); // avoid to execute the actual submit of the form.

		var name = document.getElementById("modal_edit_player2_name").value;

		var form = $(this);
		var actionUrl = form.attr('action');
		
		$.ajax({
			type: "POST",
			url: actionUrl,
			data: form.serialize(), // serializes the form's elements.
			error: function(data)
			{
                Toast.fire({
                    icon: 'error',
                    title: 'An error has occured'
                })
			},
			success: function(data)
			{
                Toast.fire({
                    icon: 'success',
                    title: 'Player Named '+ name +' has been Updated in the Database'
                })

				$('#p2_tag').val(document.getElementById("modal_edit_player2_tag").value);
				$('#p2_country').val(document.getElementById("modal_edit_player2_country").value);
				$('#p2_country_code').val(document.getElementById("modal_edit_player2_country_code").value);

				// Clear Data on Save
				$('#modal_edit_player2_tag').val("");
				$('#modal_edit_player2_name').val("");
				$('#modal_edit_player2_country').val("");
				$('#modal_edit_player2_country_code').val("");

				// Close Modal
				$('#editModal2').modal('toggle');
			}
		});
		
	 });

	 function manualSave() {
		$( "#save_scoreboard" ).submit();
	 };

	// Swap Player 1
	$( "#player-1-swap, #player-2-swap" ).click(function() {

		player1tag = $('#p1_tag').val();
		player1name = $('#p1_name').val();
		player1country = $('#p1_country').val();
		player1countrycode = $('#p1_country_code').val();
		player1status = $('#p1_status').val();
		player1score = $('#p1_score').val();
		player1position = $('#p1_position').val();
		
		player2tag = $('#p2_tag').val();
		player2name = $('#p2_name').val();
		player2country = $('#p2_country').val();
		player2countrycode = $('#p2_country_code').val();
		player2status = $('#p2_status').val();
		player2score = $('#p2_score').val();
		player2position = $('#p2_position').val();
		
		$('#p1_tag').val(player2tag);
		$('#p1_name').val(player2name);
		$('#p1_country').val(player2country);
		$('#p1_country-code').val(player2countrycode);
		$('#p1_status').val(player2status);
		$('#p1_score').val(player2score);
		$('#p1_position').val(player2position);

		$('#p2_tag').val(player1tag);
		$('#p2_name').val(player1name);
		$('#p2_country').val(player1country);
		$('#p2_country-code').val(player1countrycode);
		$('#p2_status').val(player1status);
		$('#p2_score').val(player1score);
		$('#p1_position').val(player1position);
		
		manualSave();
	});

	// Reset Both Players
	$( "#player-all-clear1, #player-all-clear2" ).click(function() {
		$('#p1_tag').val('');
		$('#p1_name').val('');
		$('#p1_country').val('');
		$('#p1_country_code').val('');
		$('#p1_status').val('');

		$('#p2_tag').val('');
		$('#p2_name').val('');
		$('#p2_country').val('');
		$('#p2_country_code').val('');
		$('#p2_status').val('');

		$('#p1_score').val('0');
		$('#p2_score').val('0');

		$('#p1_position').val('0');
		$('#p2_position').val('0');

		$('#modal_edit_player1_tag').val("");
		$('#modal_edit_player1_name').val("");
		$('#modal_edit_player1_country').val("");
		$('#modal_edit_player1_country_code').val("");

		$('#modal_edit_player2_tag').val("");
		$('#modal_edit_player2_name').val("");
		$('#modal_edit_player2_country').val("");
		$('#modal_edit_player2_country_code').val("");

		manualSave();
	});	
	
	// Reset Player 1
	$( "#player-1-clear" ).click(function() {
		$('#p1_tag').val('');
		$('#p1_name').val('');
		$('#p1_country').val('');
		$('#p1_country_code').val('');
		$('#p1_status').val('');

		$('#modal_edit_player1_tag').val("");
		$('#modal_edit_player1_name').val("");
		$('#modal_edit_player1_country').val("");
		$('#modal_edit_player1_country_code').val("");

		manualSave();
	});

	// Reset Player 2
	$( "#player-2-clear" ).click(function() {
		$('#p2_tag').val('');
		$('#p2_name').val('');
		$('#p2_country').val('');
		$('#p2_country_code').val('');
		$('#p2_status').val('');

		$('#modal_edit_player2_tag').val("");
		$('#modal_edit_player2_name').val("");
		$('#modal_edit_player2_country').val("");
		$('#modal_edit_player2_country_code').val("");

		manualSave();
	});

	// Reset Scores
	$( "#tournament-score-clear" ).click(function() {
		$('#p1_score').val('0');
		$('#p2_score').val('0');

		manualSave();
	});

	// Reset Position
	$( "#tournament-position-clear" ).click(function() {
		$('#p1_position').val('0');
		$('#p2_position').val('0');

		manualSave();
	});	

	// Reset Round
	$( "#tournament-round-clear" ).click(function() {
		$('#tournament-round').val('Pools');
		manualSave();
	});

	// Reset Round Status
	$( "#tournament-status-clear" ).click(function() {
		$('#tournament-round-extra').val('Round 1 - Best of 3');
		manualSave();
	});	

	// Save Scores -- Auto
	$("#p1_score, #p2_score").blur(function() {
		manualSave();
	});

	// Save Position -- Auto
	$("#p1_position, #p2_position").blur(function() {
		manualSave();
	});

	// Save Tournament -- Auto
	$("#tournament-round").change(function() {
		manualSave();
	});

	// Shortbut Key Binds
	$(window).bind('keydown', function(event) {
		if (event.ctrlKey || event.metaKey) {
			switch (String.fromCharCode(event.which).toLowerCase()) {
			case 's':
				event.preventDefault();
				manualSave();
				break;
			case 'c':
				event.preventDefault();
				$("#player-all-clear1", "#team-all-clear1").click()
				break;
			case 'z':
				event.preventDefault();
				$("#player-1-swap", "#team-1-swap").click()
				break;
				case '0':
					event.preventDefault();
					$("#addplayer1-button").click()
					break;
				case '1':
					event.preventDefault();
					$("#player-1-edit").click()
					break;
				case '2':
					event.preventDefault();
					$("#player-2-edit").click()
					break;
			}
		}
	});

	// Screen Size Tweaks
	function CheckBounds() {
		if ($(window).width() < 1280) {
			$("#live-preview").fadeOut("slow");
		} else {
			$("#live-preview").fadeIn("slow");
		}
	}
	
    //Check for Resized Window
    $(window).resize(function() {
        CheckBounds();
	});
	
	// Check Live Preview
	$('.live-preview').click(function() {
		var selected = $(this).data("live");
		
		var iheight = $(this).data("height");
		var iwidth = $(this).data("width");

		$('#final-preview').attr('height', iheight);
		$('#final-preview').attr('width', iwidth);
		$('#final-preview').attr('src', "/custom/scoreboard/" + selected + "/Scoreboard.html");
	});	

	// Send to Top 8
	$("#tournament-move-p1").change(function() {

		if ($(this).val() == "Set Top 8 Placement" || $(this).val() == "") {
			return;
		}

		var match = $(this).val();
		$.ajax({
			type: "POST",
			url: "/index.php?p=tournament&a=funcs&v=top8_quick_add",
            data: {
                'top8_block' : match,
				'player_tag' :  $("#p1_tag").val(),
				'player_name' : $("#p1_name").val(),
				'player_country' : $("#p1_country").val(),
				'player_country_code' : $("#p1_country_code").val(),
				'player_score' : "0",
            },
			success: function(data)
			{
                Toast.fire({
                    icon: 'success',
                    title: 'The player has been saved to the Top 8'
                })
			}
		});

	});

	$("#tournament-move-p2").change(function() {

		if ($(this).val() == "Set Top 8 Placement" || $(this).val() == "") {
			return;
		}

		var match = $(this).val();
		$.ajax({
			type: "POST",
			url: "/index.php?p=tournament&a=funcs&v=top8_quick_add",
            data: {
                'top8_block' : match,
				'player_tag' :  $("#p2_tag").val(),
				'player_name' : $("#p2_name").val(),
				'player_country' : $("#p2_country").val(),
				'player_country_code' : $("#p2_country_code").val(),
				'player_score' : "0",
            },
			success: function(data)
			{
                Toast.fire({
                    icon: 'success',
                    title: 'The player has been saved to the Top 8'
                })
			}
		});

	});

});