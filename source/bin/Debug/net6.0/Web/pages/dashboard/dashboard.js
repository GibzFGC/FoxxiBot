// Copyright (C) 2020-2022 FoxxiBot
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.

let socket = new ReconnectingWebSocket("ws://localhost:24000");
socket.debug = true;

function truncate(str, n){
  return (str.length > n) ? str.substr(0, n-1) + '...' : str;
};

socket.onopen = function(e) {
    console.log("[open] Connection established");
    console.log("Sending to server");
    
    // Set Panel Status
    document.getElementById("socket_status").classList.add('bg-success');
    document.getElementById("socket_status").classList.remove('bg-danger');
    document.getElementById("socket_status").innerHTML = "Online";

    // Send Commands
    socket.send("GetCPUUsage end");
    socket.send("GetRAMUsage end");
  };
  
  socket.onmessage = function(e) {
    json = JSON.parse(e.data);
    // console.log(json);

    if ( typeof json["data"][0].cpu_usage !== 'undefined' ) {
      document.getElementById("cpu_usage").textContent = json["data"]["0"].cpu_usage + "%";
    }
  
    if ( typeof json["data"][0].ram_usage !== 'undefined' ) {
      document.getElementById("ram_usage").textContent = json["data"]["0"].ram_usage + " MB";
    }
  };

  socket.onclose = function(e) {
    // Set Panel Status
    document.getElementById("socket_status").classList.remove('bg-success');
    document.getElementById("socket_status").classList.add('bg-danger');
    document.getElementById("socket_status").innerHTML = "Offline";

    // Check Server Status
    serverCheck();

    if (e.wasClean) {
        // e.g. server process killed or network down
        console.log(`[close] Connection closed cleanly, code=${e.code} reason=${e.reason}`);
    } else {
      // e.g. server process killed or network down
      // event.code is usually 1006 in this case
      console.log('[close] Connection died');
    }
  };
  
  socket.onerror = function(error) {
    console.log(`[error] ${error.message}`);
  };

  function serverCheck() {
    $.ajax({
        type: 'HEAD',
        timeout: 1000,
        url:"http://localhost:25000",
        statusCode:{
          400: function(response){
            document.getElementById("server_status").classList.remove('bg-success');
            document.getElementById("server_status").classList.add('bg-danger');
            document.getElementById("server_status").innerHTML = "Offline";
          },
          200: function(response){
            document.getElementById("server_status").classList.add('bg-success');
            document.getElementById("server_status").classList.remove('bg-danger');
            document.getElementById("server_status").innerHTML = "Online";
          }
        }
      });
  }

// This handles EVERYTHING!
var sysinfo = window.setInterval(function() {
    socket.send("GetCPUUsage end");
    socket.send("GetRAMUsage end");

    // Check Server Status
    serverCheck();
}, 1000);


// Twitch Handler
const clientId = TwitchClientID;
const token = TwitchClientOAuth;
const { api } = new TwitchJs({ clientId, token })

// Set Game Form Data
api.get('channels', { search: { broadcaster_id: TwitchChannelID } })
.then(response => {
  if (document.getElementById("searchGame").value != response["data"][0].gameName) {
    document.getElementById("searchGame").value = response["data"][0].gameName;
  }

  if (document.getElementById("setTitle").value != response["data"][0].title) {
    document.getElementById("setTitle").value = response["data"][0].title;
  }
})

// Twitch Game Search
$("#searchGame").change(function() {

  // Encode String
  var encodedString = encodeURIComponent(document.getElementById("searchGame").value);
  $("#setGame").empty();

  // Get Users Channel Info
  api.get('search/categories', { search: { query: document.getElementById("searchGame").value } })
  .then(response => {
    var data = $.map(response["data"], function (obj) {
      obj.id = obj.id;
      obj.text = obj.name;

      return obj;
    });

    $('#setGame').select2({data: data });

  })

})

$('#setGame').on("select2:select", function(e) { 
  console.log(e);
});

var twitch = window.setInterval(function() {
  // Get Users Channel Info
  api.get('channels', { search: { broadcaster_id: TwitchChannelID } })
  .then(response => {
      document.getElementById("stream_game").innerHTML = response["data"][0].gameName;
      document.getElementById("stream_title").innerHTML = response["data"][0].title;
  })

  // Get Users Profile Image & View Count
  api.get('users', { search: { id: TwitchChannelID } })
  .then(response => {
      document.getElementById("twitch_profile_url").src = response["data"][0].profileImageUrl;
      document.getElementById("twitch_profile_sidebar").src = response["data"][0].profileImageUrl;
      document.getElementById("dashboard_displayname").innerHTML = response["data"][0].displayName;
      document.getElementById("twitch_profile_name").innerHTML = response["data"][0].displayName;
      document.getElementById("total_views").innerHTML = response["data"][0].viewCount;
  })

  // Get Users Total Followers
  api.get('users/follows', { search: { to_id: TwitchChannelID, first: 9 } })
  .then(response => {
      document.getElementById("total_follows").innerHTML = response.total;

      document.getElementById("follower_list").innerHTML ="";
      response["data"];
      for (let follow_list in response["data"]) {
        // Convert Date / Time
        var date = new Date(response["data"][follow_list].followedAt);
        var output = date.getDate() + "\\" +  (date.getMonth()+1) + "\\" + date.getFullYear();

        // Final List Send
        document.getElementById("follower_list").innerHTML += '<li class="nav-item"><span class="nav-link">' + response["data"][follow_list].fromName +'<span class="float-right">'+ output +'</span></span></li>';
      }

  })

  // Milliseconds to Time
  function msToTime(duration) {
    var milliseconds = Math.floor((duration % 1000) / 100),
      seconds = Math.floor((duration / 1000) % 60),
      minutes = Math.floor((duration / (1000 * 60)) % 60),
      hours = Math.floor((duration / (1000 * 60 * 60)) % 24);
  
    hours = (hours < 10) ? "0" + hours : hours;
    minutes = (minutes < 10) ? "0" + minutes : minutes;
    seconds = (seconds < 10) ? "0" + seconds : seconds;
  
    return hours + " hours, " + minutes + " mins, " + seconds + " secs";
  }

  // Get Stream Status
  api.get('streams', { search: { user_id: TwitchChannelID } })
  .then(response => {
    console.log(response);


      if (response["data"].length == 0) {
        document.getElementById("stream_status").innerHTML = "Offline";
        document.getElementById("stream_uptime").innerHTML = "Waiting for next stream!";
      } else {
        document.getElementById("stream_status").innerHTML = "Live!";
        document.getElementById("stream_viewers").innerHTML = response["data"][0].viewerCount;

        // Convert time to milliseconds from current date & start time
        var prevTime = new Date(response["data"][0].startedAt);
        var thisTime = new Date();
        var diff = thisTime.getTime() - prevTime.getTime();

        //document.getElementById("stream_uptime").innerHTML = response["data"][0].startedAt;
        document.getElementById("stream_uptime").innerHTML = msToTime(diff);
      }
  })

}, 5000);