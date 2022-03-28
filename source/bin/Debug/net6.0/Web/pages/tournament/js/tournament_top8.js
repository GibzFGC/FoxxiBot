$(document).ready(function() {

    // Load Modal State
    $(".match_box").on('click', function() {
        document.getElementById("modal-title").innerText = "Editing: " + $(this).data("title");
        document.getElementById("top8_block").value = $(this).data("match");

		if ($('#'+ $(this).data("match") + "-p1-name").is(':empty') || $('#'+ $(this).data("match") + "-p2-name").is(':empty')){
			
			// Empty Modal
			$('#player_1_tag').val("");
			$('#player_1_name').val("");
			$('#player_1_country').val("");
			$('#player_1_country_code').val("");
			$('#player_1_score').val("0");
		
			$('#player_2_tag').val("");
			$('#player_2_name').val("");
			$('#player_2_country').val("");
			$('#player_2_country_code').val("");
			$('#player_2_score').val("0");
			
		} else {

			$('#player_1_tag').val(document.getElementById($(this).data("match") + "-p1-tag").innerText);
			$('#player_1_name').val(document.getElementById($(this).data("match") + "-p1-name").innerText);
			$('#player_1_country').val(document.getElementById($(this).data("match") + "-p1-country").innerText);
			$('#player_1_country_code').val(document.getElementById($(this).data("match") + "-p1-country-code-value").innerText);
			$('#player_1_score').val(document.getElementById($(this).data("match") + "-p1-score").innerText);
		
			$('#player_2_tag').val(document.getElementById($(this).data("match") + "-p2-tag").innerText);
			$('#player_2_name').val(document.getElementById($(this).data("match") + "-p2-name").innerText);
			$('#player_2_country').val(document.getElementById($(this).data("match") + "-p2-country").innerText);
			$('#player_2_country_code').val(document.getElementById($(this).data("match") + "-p2-country-code-value").innerText);
			$('#player_2_score').val(document.getElementById($(this).data("match") + "-p2-score").innerText);
		}
    });

    // Swap Player Positions
    $(".match-swap").on('click', function(e) {
		e.preventDefault(); // avoid to execute the actual submit of the form.

		var $current_match = $(this).data("match");

		player1tag = $('#' + $current_match + '-p1-tag').text();
		player1name = $('#' + $current_match + '-p1-name').text();
		player1country = $('#' + $current_match + '-p1-country').text();
		player1countrycode = $('#' + $current_match + '-p1-country-code-value').text();
		player1score = $('#' + $current_match +  '-p1-score').text();

		var p1_flag = document.getElementById($current_match + "-p1-country-code");
		player1flag = p1_flag.className;

		player2tag = $('#' + $current_match + '-p2-tag').text();
		player2name = $('#' + $current_match + '-p2-name').text();
		player2country = $('#' + $current_match + '-p2-country').text();
		player2countrycode = $('#' + $current_match + '-p2-country-code-value').text();
		player2score = $('#' + $current_match +  '-p2-score').text();

		var p2_flag = document.getElementById($current_match + "-p2-country-code");
		player2flag = p2_flag.className;

		$('#' + $current_match + '-p1-tag').text(player2tag);
		$('#' + $current_match + '-p1-name').text(player2name);
		$('#' + $current_match + '-p1-country').text(player2country);
		$('#' + $current_match + '-p1-county-code-value').text(player2countrycode);
		$('#' + $current_match + '-p1-score').text(player2score);
		p1_flag.className = player2flag;

		$('#' + $current_match + '-p2-tag').text(player1tag);
		$('#' + $current_match + '-p2-name').text(player1name);
		$('#' + $current_match + '-p2-country').text(player1country);
		$('#' + $current_match + '-p2-county-code-value').text(player1countrycode);
		$('#' + $current_match + '-p2-score').text(player1score);
		p2_flag.className = player1flag;
	});

    // Erase Match
    $(".match-reset").on('click', function(e) {
		e.preventDefault(); // avoid to execute the actual submit of the form.
		var $current_match = $(this).data("match");

		$.ajax({
			type: "POST",
			url: "/index.php?p=tournament&a=funcs&v=top8_reset_match",
            data: {
                'top8_block' : $current_match,
            },
			success: function(data)
			{
                Toast.fire({
                    icon: 'success',
                    title: 'The match data has been reset!'
                })
			}
		});

		// Reset Player 1
        document.getElementById($current_match + "-p1-name").innerText = "";
		var p1_flag = document.getElementById($current_match + "-p1-country-code");
		p1_flag.className = '';
        document.getElementById($current_match + "-p1-score").innerText = "0";

		// Reset Player 2
        document.getElementById($current_match + "-p2-name").innerText = "";
		var p2_flag = document.getElementById($current_match + "-p2-country-code");
		p2_flag.className = '';
        document.getElementById($current_match + "-p2-score").innerText = "0";		
	});

    // Purge All
    $("#purge-all").on('click', function(e) {
		e.preventDefault(); // avoid to execute the actual submit of the form.

		$.ajax({
			type: "POST",
			url: "/index.php?p=tournament&a=funcs&v=top8_purge_db",
			success: function()
			{
                Toast.fire({
                    icon: 'success',
                    title: 'The Top 8 data has been reset!'
                })

				purge_cleanup();
			}
		});
	});

	// Clean all variables in real-time
	function purge_cleanup() {
		var erasable_elements = document.getElementsByClassName("erasable");
		Array.from(erasable_elements).forEach( element =>
		  element.innerHTML = ""
		)

		var erasable_flags = document.getElementsByClassName("flag-erase");
		Array.from(erasable_flags).forEach( element =>
		  element.className = "flag-erase tournament-bracket__flag flag-icon flag-icon-"
		)		
	}

	 // Save the Data to the Top 8
	 $(" #post_results" ).submit(function(e) {

		e.preventDefault(); // avoid to execute the actual submit of the form.
        $current_match = document.getElementById("top8_block").value;

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
                    title: 'Data Saved to the Top 8 Data Pool'
                })
			}
		});
		
        // Fill with Relevant Data
		document.getElementById($current_match + "-p1-tag").innerText = $('#player_1_tag').val();
		document.getElementById($current_match + "-p1-name").innerText = $('#player_1_name').val();
		var p1_flag = document.getElementById($current_match + "-p1-country-code");
		p1_flag.className = 'flag-erase tournament-bracket__flag flag-icon flag-icon-' + $('#player_1_country_code').val();
		document.getElementById($current_match + "-p1-country").innerText = $('#player_1_country').val();
		document.getElementById($current_match + "-p1-country-code-value").innerText = $('#player_1_country_code').val();
        document.getElementById($current_match + "-p1-score").innerText = $('#player_1_score').val();

		document.getElementById($current_match + "-p2-tag").innerText = $('#player_2_tag').val();
        document.getElementById($current_match + "-p2-name").innerText = $('#player_2_name').val();
		var p2_flag = document.getElementById($current_match + "-p2-country-code");
		p2_flag.className = 'flag-erase tournament-bracket__flag flag-icon flag-icon-' + $('#player_2_country_code').val();
		document.getElementById($current_match + "-p2-country").innerText = $('#player_2_country').val();
		document.getElementById($current_match + "-p2-country-code-value").innerText = $('#player_2_country_code').val();
        document.getElementById($current_match + "-p2-score").innerText = $('#player_2_score').val();

		if ($current_match === "w-gf" || $current_match === "l-lf") {
			if ($('#player_1_score').val() > $('#player_2_score').val()) {
				var p1_trophy = document.getElementById($current_match + "-p1-trophy");
				p1_trophy.className = 'tournament-bracket__medal tournament-bracket__medal--gold fa fa-trophy';

				var p2_trophy = document.getElementById($current_match + "-p2-trophy");
				p2_trophy.className = 'tournament-bracket__medal tournament-bracket__medal--silver fa fa-trophy';
			} else {
				var p1_trophy = document.getElementById($current_match + "-p1-trophy");
				p1_trophy.className = 'tournament-bracket__medal tournament-bracket__medal--silver fa fa-trophy';

				var p2_trophy = document.getElementById($current_match + "-p2-trophy");
				p2_trophy.className = 'tournament-bracket__medal tournament-bracket__medal--gold fa fa-trophy';
			}
		}

        // Empty Modal
        $('#player_1_tag').val("");
        $('#player_1_name').val("");
        $('#player_1_country').val("");
        $('#player_1_country_code').val("");
        $('#player_1_score').val("0");
    
        $('#player_2_tag').val("");
        $('#player_2_name').val("");
        $('#player_2_country').val("");
        $('#player_2_country_code').val("");
        $('#player_2_score').val("0");

		// Close Modal
		$('#editModal').modal('toggle');

	 });

    // Clear Modal
    $("#clear_modal").on('click', function() {
        $('#player_1_tag').val("");
        $('#player_1_name').val("");
        $('#player_1_country').val("");
        $('#player_1_country_code').val("");
        $('#player_1_score').val("0");
    
        $('#player_2_tag').val("");
        $('#player_2_name').val("");
        $('#player_2_country').val("");
        $('#player_2_country_code').val("");
        $('#player_2_score').val("0");
    });

	// Clear all Values
	$("#clear-all").on('click', function() {
		
	});	

	// Player 1 Name
	$('#player_1_name').autoComplete({
		resolver: 'custom',
		formatResult: function (item) {
			$('#player_1_tag').val(item.tag);
			$('#player_1_country').val(item.country);
			$('#player_1_country_code').val(item.country_code);

			return {
				value: item.name,
				text: item.name,
			};
		},
		events: {
			search: function (qry, callback) {
			$.ajax(
				'/api.php?state=get&table=gb_tournament_players&where=name LIKE "' + $('#player_1_name').val() + '%"',
				{
					data: { 'name': qry}
				}
				).done(function (res) {
					callback(res)
				});
			}
		}
	});

	// Player 1 Country Loader
	$('#player_1_country').autoComplete({
		resolver: 'custom',
		formatResult: function (item) {
			$('#player_1_country_code').val(item.code);

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

	// Player 2 Name
	$('#player_2_name').autoComplete({
		resolver: 'custom',
		formatResult: function (item) {
			$('#player_2_tag').val(item.tag);
			$('#player_2_country').val(item.country);
			$('#player_2_country_code').val(item.country_code);

			return {
				value: item.name,
				text: item.name,
			};
		},
		events: {
			search: function (qry, callback) {
			$.ajax(
				'/api.php?state=get&table=gb_tournament_players&where=name LIKE "' + $('#player_2_name').val() + '%"',
				{
					data: { 'name': qry}
				}
				).done(function (res) {
					callback(res)
				});
			}
		}
	});

	// Player 2 Country Loader
	$('#player_2_country').autoComplete({
		resolver: 'custom',
		formatResult: function (item) {
			$('#player_2_country_code').val(item.code);

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

});