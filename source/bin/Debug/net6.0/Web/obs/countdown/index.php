<!DOCTYPE html>
<html lang="en" >
    <head>
      <meta charset="UTF-8">
      <title>FoxxiBot | Countdown Timer</title>
      <link rel="stylesheet" href="./style.css">
    </head>

    <body>
        <h1 id="countdown_title">Countdown Title...</h1>

        <div class="countdown-container">
            <div class="countdown-el days-c">
                <p class="big-text" id="days">0</p>
                <span>DAYS</span>
            </div>
            <div class="countdown-el hours-c">
                <p class="big-text" id="hours">0</p>
                <span>HOURS</span>
            </div>
            <div class="countdown-el mins-c">
                <p class="big-text" id="mins">0</p>
                <span>MINS</span>
            </div>
            <div class="countdown-el seconds-c">
                <p class="big-text" id="seconds">0</p>
                <span>SECONDS</span>
            </div>
        </div>

        <script src="../SHARED/js/jquery-3.6.0.min.js"></script>
        <script type="text/javascript">
            const daysEl = document.getElementById("days");
            const hoursEl = document.getElementById("hours");
            const minsEl = document.getElementById("mins");
            const secondsEl = document.getElementById("seconds");

            var id = "<?php print $_REQUEST["id"]; ?>";
            var datetime = null;

            // Load Data
            let searchParams = new URLSearchParams(window.location.search);
            if (searchParams.has('key')) {
                $.getJSON('/api.php?key='+ searchParams.get("key") +'state=get&table=gb_countdowns&where=id:' + id, function(data) {
                    datetime = data[0]["datetime"];
                    document.getElementById("countdown_title").innerText = data[0]["title"];
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

                daysEl.innerHTML = days;
                hoursEl.innerHTML = formatTime(hours);
                minsEl.innerHTML = formatTime(mins);
                secondsEl.innerHTML = formatTime(seconds);
            }

            function formatTime(time) {
                return time < 10 ? `0${time}` : time;
            }

            // initial call
            countdown();

            setInterval(countdown, 1000);
        </script>

    </body>
</html>