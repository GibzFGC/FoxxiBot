$(document).ready(function() {

	// Set Action Status
	$( ".completed_button" ).click(function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.

        var id = $(this).data("id");
        var status = $(this).data("status");

		$.ajax({
			type: "POST",
			url: '/index.php?p=points&a=funcs&v=status&id=' + id + '&status=' + status,
            data: {
                'id' : id,
				'status' : status,
            },
			success: function(data)
			{
                Toast.fire({
                    icon: 'success',
                    title: 'The status has been updated'
                })
			}
		});

        // Set Table Status
        if (status == 0) {
            $( this ).text("Set as Complete");
            $( this ).attr("class", "btn btn-success btn-sm");
            $( this ).attr("data-status", 1);
            return;
        }
        
        if (status == 1) {
            $( this ).text("Set as Incomplete");
            $( this ).attr("class", "btn btn-warning btn-sm");
            $( this ).attr("data-status", 0);
            return;
        }
	});

	// Send Refund
	$( ".refund_button" ).click(function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.

        var id = $(this).data("id");
        var user = $(this).data("user");
        var points = $(this).data("points");

		$.ajax({
			type: "POST",
			url: '/index.php?p=points&a=funcs&v=refund&id=' + id + '&user=' + user + '&points=' + points,
            data: {
                'id' : id,
				'user' : user,
                'points' : points,
            },
			success: function(data)
			{
                Toast.fire({
                    icon: 'success',
                    title: 'The user '+ user +' has been refunded ' + points + ' point(s)'
                })
			}
		});

        var complete_elem = document.getElementById('completed_button');
        complete_elem.parentNode.removeChild(complete_elem);

        $( this ).text("This action has been refunded");
        $( this ).attr("class", "btn btn-sm");
        $( this ).attr("style", "color: #fff;");

        $( this).removeAttr("data-id");
        $( this ).removeAttr("data-user");
        $( this ).removeAttr("data-points");
	});    

});