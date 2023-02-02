var xmlhttp = new XMLHttpRequest();

var doUpdate = false;
var isPlaying = false;

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
		animation();
	}
}

function isEmpty(obj) {
    return Object.keys(obj).length === 0;
}

// Perform SQL Delete on Viewed
function updatePlayed(id) {
	$.ajax({
		type: "POST",
		url: "/api.php?state=send&table=gb_points_actions&column=status&value=1&id=id&position=" + id,
		success: function()
		{
		  console.log("Info: Updated SQL Row " + id);
		}
	});
}

function animation() {
    // Load Data
    $.getJSON('/api.php?state=get&table=gb_points_actions&where=action:"wobbly" AND status:0&order="id"&order_state=asc&limit=1', function(data) {
    
        if (!isEmpty(data)) {

            if (data[0]["action"] == "wobbly") {
                console.log("Preparing wobbly!");

                let elem = document.getElementById("wobbly_anim");
                elem.setAttribute("style", "visibility: visible");

                var anim_time = setTimeout(function() {
                    elem.setAttribute("style", "visibility: hidden");

                    // Set Anim Status End!
                    console.log("Animation queue finished");
                    clearTimeout(anim_time);
                }, 10000);

                // Set Anim Status End!
			    updatePlayed(data[0]["id"]);
            }
    
        } else {
            console.log("Waiting for an Event");
        }
    })
}