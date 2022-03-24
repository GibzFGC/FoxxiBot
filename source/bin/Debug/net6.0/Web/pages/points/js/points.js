$(document).ready(function() {

	// Username Search
	$('#points_username').autoComplete({
		resolver: 'custom',
		formatResult: function (item) {	

            $('#points_current').val(item.value);
            return {
				value: item.username,
				text: item.username,
			};
		},
		events: {
			search: function (qry, callback) {
			$.ajax(
				'/api.php?state=get&table=gb_points&where=username LIKE "' + $('#points_username').val() + '%"',
				{
					data: { 'username': qry}
				}
				).done(function (res) {
					callback(res)
				});
			}
		}
	});

	 // Save Main Points Settings
	 $( "#update_settings" ).click(function(e) {

		e.preventDefault(); // avoid to execute the actual submit of the form.

        var points_name = document.getElementById("points_name").value;
        var points_shortname = document.getElementById("points_shortname").value;
		var points_increment = document.getElementById("points_shortname").value;

		if (points_name === "" || points_shortname === "" || points_increment === "") {
			Toast.fire({
				icon: 'error',
				title: 'An error occured, please check you\'ve filled all fields'
			})

			return;
		}

		var form = $("#points_settings");
		var actionUrl = form.attr('action');

		$.ajax({
			type: "POST",
			url: actionUrl,
			data: form.serialize(), // serializes the form's elements.
			success: function(data)
			{
                Toast.fire({
                    icon: 'success',
                    title: 'Points Settings Updated'
                })
			}
		});

	 });

	 // Save User Management
	 $( "#update_user" ).click(function(e) {
		e.preventDefault(); // avoid to execute the actual submit of the form.

        var username = document.getElementById("points_username").value;
        var points = document.getElementById("points_current").value;

		if (username === "" || points === "") {
			Toast.fire({
				icon: 'error',
				title: 'An error occured, please check you\'ve filled all fields'
			})

			return;
		}

		var form = $("#user_points");
		var actionUrl = form.attr('action');

		$.ajax({
			type: "POST",
			url: actionUrl,
			data: form.serialize(), // serializes the form's elements.
			success: function(data)
			{
                Toast.fire({
                    icon: 'success',
                    title: 'The user ' + username + ' has been updated and now has ' + points + ' point(s)'
                })
			}
		});
		
        $(" #update_user_clear" ).click();
	 });

	 // Clear User Management
	 $(" #update_user_clear" ).click(function(e) {
		e.preventDefault();

        $('#points_username').val("");
        $('#points_current').val("");
    });

});