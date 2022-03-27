$(document).ready(function() {

    // Load Modal State
    $(".match_box").on('click', function() {
        document.getElementById("modal-title").innerText = "Editing: " + $(this).data("title");
        document.getElementById("top8_block").value = $(this).data("match");
    });

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
        document.getElementById($current_match + "-p1-name").innerText = $('#player_1_name').val();
        var p1_flag = document.getElementById($current_match + "-p1-country-code");
        p1_flag.classList.add("flag-icon-" + $('#player_1_country_code').val());
        document.getElementById($current_match + "-p1-score").innerText = $('#player_1_score').val();

        document.getElementById($current_match + "-p2-name").innerText = $('#player_2_name').val();
        var p2_flag = document.getElementById($current_match + "-p2-country-code");
        p2_flag.classList.add("flag-icon-" + $('#player_2_country_code').val());
        document.getElementById($current_match + "-p2-score").innerText = $('#player_2_score').val();

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

});