<!DOCTYPE html>
<html lang="en" >

  <head>
    <meta charset="UTF-8">
    <title>FoxxiBot | Poll Widget</title>
    <link rel="stylesheet" href="./style.css">
  </head>

  <body>

    <section id="show_poll">
      <h1 id="poll_title">Poll Question </h1>
      <p class="poll_time" id="poll_time">Time Left</p>
      <div class="poll-option">
        <span id="poll_option_1" class="poll-option__label">Option 1</span>
        <table class="poll-option__result">
          <tr>
            <td id="poll_option_1_count">0</td>
            <td>
              <span></span>
              <span id="poll_option_1_count_bar" style="width: 0%;"></span>
            </td>
            <td id="poll_option_1_percentage">0%</td>
          </tr>
        </table>
      </div>
      
      <div class="poll-option">
        <span id="poll_option_2" class="poll-option__label">Option 2</span>
        <table class="poll-option__result">
          <tr>
            <td id="poll_option_2_count">0</td>
            <td>
              <span></span>
              <span id="poll_option_2_count_bar" style="width: 0%;"></span>
            </td>
            <td id="poll_option_2_percentage">0%</td>
          </tr>
        </table>
      </div>
      
      <div class="poll-option">
        <span id="poll_option_3" class="poll-option__label">Option 3</span>
        <table class="poll-option__result">
          <tr>
            <td id="poll_option_3_count">0</td>
            <td>
              <span></span>
              <span id="poll_option_3_count_bar" style="width: 0%;"></span>
            </td>
            <td id="poll_option_3_percentage">0%</td>
          </tr>
        </table>
      </div>
      
        <div class="poll-option">
        <span id="poll_option_4" class="poll-option__label">Option 4</span>
        <table class="poll-option__result">
          <tr>
            <td id="poll_option_4_count">0</td>
            <td>
              <span></span>
              <span id="poll_option_4_count_bar" style="width: 0%;"></span>
            </td>
            <td id="poll_option_4_percentage">0%</td>
          </tr>
        </table>
      </div>
      
    </section>
    
    <script src="../SHARED/js/jquery-3.6.0.min.js"></script>
        <script type="text/javascript">

            var id = "<?php print $_REQUEST["id"]; ?>";
            var datetime = null;

            var pollID = 0;
            var pollLive = 0;        

            function init_poll() {

            // Load Poll Options Data
            $.getJSON('/api.php?state=get&table=gb_polls_options&where=parameter:"allow_voting"', function(data) {
                pollLive = data[0]["value"];

                if (pollLive == 0) {
                  $("#show_poll").fadeOut();
                }

                if (pollLive == 1) {
                  $("#show_poll").fadeIn();
                }
            });

            // Load Poll Data
            $.getJSON('/api.php?state=get&table=gb_polls&where=id:' + id, function(data) {
                document.getElementById("poll_title").innerText = data[0]["title"];

                document.getElementById("poll_option_1").innerText = "[1] " + data[0]["option1"];
                document.getElementById("poll_option_2").innerText = "[2] " + data[0]["option2"];
                document.getElementById("poll_option_3").innerText = "[3] " + data[0]["option3"];
                document.getElementById("poll_option_4").innerText = "[4] " + data[0]["option4"];    
                
                datetime = data[0]["datetime"];
            });

            // Load Vote Data
            $.getJSON('/api.php?state=get&table=gb_polls_votes&where=poll_id:' + id, function(data) {

                // Get JSON Vote Count
                var count_option1 = data.filter(function (el) {
                  return el.value == '1';
                }).length;

                var count_option2 = data.filter(function (el) {
                  return el.value == '2';
                }).length;
                
                var count_option3 = data.filter(function (el) {
                  return el.value == '3';
                }).length;
                
                var count_option4 = data.filter(function (el) {
                  return el.value == '4';
                }).length;

                // Show How Many Voted for Each
                document.getElementById("poll_option_1_count").innerText = count_option1;
                document.getElementById("poll_option_2_count").innerText = count_option2;
                document.getElementById("poll_option_3_count").innerText = count_option3;
                document.getElementById("poll_option_4_count").innerText = count_option4;

                // Show How Many Voted for Each (Percentage)
                document.getElementById("poll_option_1_percentage").innerText = Math.round(count_option1 / data.length * 100) + "%";
                document.getElementById("poll_option_2_percentage").innerText = Math.round(count_option2 / data.length * 100) + "%";
                document.getElementById("poll_option_3_percentage").innerText = Math.round(count_option3 / data.length * 100) + "%";
                document.getElementById("poll_option_4_percentage").innerText = Math.round(count_option4 / data.length * 100) + "%";

                // Show Count Bar
                document.getElementById("poll_option_1_count_bar").style = "width: " + count_option1 / data.length * 100 + "%";
                document.getElementById("poll_option_2_count_bar").style = "width: " + count_option2 / data.length * 100 + "%";
                document.getElementById("poll_option_3_count_bar").style = "width: " + count_option3 / data.length * 100 + "%";
                document.getElementById("poll_option_4_count_bar").style = "width: " + count_option4 / data.length * 100 + "%";
            });
          }

          function countdown() {
                const countdownDate = new Date(datetime);
                const currentDate = new Date();

                const totalSeconds = (countdownDate - currentDate) / 1000;

                const days = Math.floor(totalSeconds / 3600 / 24);
                const hours = Math.floor(totalSeconds / 3600) % 24;
                const mins = Math.floor(totalSeconds / 60) % 60;
                const seconds = Math.floor(totalSeconds) % 60;

                if (formatTime(hours) <= "00" & formatTime(mins) <= "00" & formatTime(seconds) <= "00" ) {
                  document.getElementById("poll_time").innerText = "Poll has Ended!";                 
                } else {
                  document.getElementById("poll_time").innerText = "Time Left: " + formatTime(hours) + " hours, " + formatTime(mins) + " mins, " + formatTime(seconds) + " secs";
                }
            }

            function formatTime(time) {
              return time < 10 ? `0${time}` : time;
            }

        // initial call
        countdown();
        init_poll();
        setInterval(init_poll, 1000);
        setInterval(countdown, 1000);

        </script>

  </body>
</html>