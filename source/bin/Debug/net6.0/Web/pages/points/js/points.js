$(document).ready(function() {
	
	// Let the Script Access Twitch Chat
	const { chat } = new TwitchJs({ token, username })

	// Random selector for Make it Rain
	function getRandomInt(max) {
		return Math.floor(Math.random() * max);
	}

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
				'/api.php?key=' + $("#points_username").data("key") + '&state=get&table=gb_points&where=username LIKE "' + $('#points_username').val() + '%"',
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
	 $( "#points_settings" ).submit(function(e) {

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
                    title: 'Points Settings Updated'
                })
			}
		});

	 });

	 // Save User Management
	 $( "#user_points" ).submit(function(e) {
		e.preventDefault(); // avoid to execute the actual submit of the form.

		var username = document.getElementById("points_username").value;
		var points = document.getElementById("points_current").value;

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

	// Make it Rain
	$( "#make_it_rain" ).click(function(e) {

		var points = getRandomInt(document.getElementById("points_rain").value);

		$.ajax({
			type: "POST",
			url: '/index.php?p=points&a=funcs&v=rain&points=' + points,
			success: function(data)
			{
                Toast.fire({
                    icon: 'success',
                    title: 'The amount of ' + points + ' has been given to all viewers!'
                })
			}
		});

		chat.connect().then(globalUserState => {
			chat.say('#' + channel, 'Make it rain is happening, everyone gets ' + points + ' points!')
		})

	});

	// Give to All
	$( "#give_to_all" ).click(function(e) {
		
		var points = document.getElementById("points_modifier").value;

		$.ajax({
			type: "POST",
			url: '/index.php?p=points&a=funcs&v=give&points=' + points,
			success: function(data)
			{
                Toast.fire({
                    icon: 'success',
                    title: 'The amount of ' + points + ' has been given to all viewers!'
                })
			}
		});

		chat.connect().then(globalUserState => {
			chat.say('#' + channel, 'Everyone got a bonus of ' + points + ' points!')
		})

	});

	// Take from All
	$( "#take_from_all" ).click(function(e) {

		var points = document.getElementById("points_modifier").value;

		$.ajax({
			type: "POST",
			url: '/index.php?p=points&a=funcs&v=take&points=' + points,
			success: function(data)
			{
                Toast.fire({
                    icon: 'success',
                    title: 'The amount of ' + points + ' has been taken from all viewers!'
                })
			}
		});

		chat.connect().then(globalUserState => {
			chat.say('#' + channel, 'Everyone just lost ' + points + ' points... oh no~')
		})

	});

});