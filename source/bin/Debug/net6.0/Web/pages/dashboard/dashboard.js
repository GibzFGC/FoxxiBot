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

function truncate(str, n){
  return (str.length > n) ? str.substr(0, n-1) + '...' : str;
};

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

// Twitch Handler
const clientId = TwitchClientID;
const token = TwitchClientOAuth;
const { api } = new TwitchJs({ clientId, token })

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

      if (response["data"][0].broadcasterType == "") {
        document.getElementById("broadcaster_type").innerHTML = "Not Affiliate / Partner";
      }

      if (response["data"][0].broadcasterType == "affiliate") {
        document.getElementById("broadcaster_type").innerHTML = "Twitch Affiliate";
      }

      if (response["data"][0].broadcasterType == "partner") {
        document.getElementById("broadcaster_type").innerHTML = "Twitch Partner";
      }
  })

  // Get Users Total Followers
  api.get('channels/followers', { search: { broadcaster_id: TwitchChannelID, first: 8 } })
  .then(response => {
    console.log(response);
      document.getElementById("total_follows").innerHTML = response.total;

      document.getElementById("follower_list").innerHTML ="";
      response["data"];
      for (let follow_list in response["data"]) {
        // Convert Date / Time
        var date = new Date(response["data"][follow_list].followedAt);
        var output = date.getDate() + "\\" +  (date.getMonth()+1) + "\\" + date.getFullYear();

        // Final List Send
        document.getElementById("follower_list").innerHTML += '<li class="nav-item"><span class="nav-link"><a style="margin-right: 10px;" href=\"/index.php?p=notifications&a=funcs&v=event&type=Follower&views=0&name='+ response["data"][follow_list].userLogin +'\" class=\"follow-sync btn btn-primary btn-sm\">Play</a> <a style="color: #fff;" target="_blank" href="https://www.twitch.tv/'+ response["data"][follow_list].userLogin +'">' + response["data"][follow_list].userName +'</a><span class="float-right">'+ output +'</span></span></li>';
      }

  })

  // Get Stream Status
  api.get('streams', { search: { user_id: TwitchChannelID } })
  .then(response => {
      if (response["data"].length == 0) {
        document.getElementById("stream_status").innerHTML = "Offline";
        document.getElementById("stream_uptime").innerHTML = "Waiting for next stream!";
        document.getElementById("stream_viewers").innerHTML = 0;
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

}, 1000);