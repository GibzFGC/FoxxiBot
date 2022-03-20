<?php
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

// Read Bot JSON / Get Twitch API Data
$bot_json = file_get_contents("../../../Data/config.json");
$bot_obj = json_decode($bot_json);
?>

<!DOCTYPE html>
<html lang="en" >
  <head>
      <meta charset="UTF-8">
      <title>FoxxiBot Chat Widget</title>
      <link rel="stylesheet" href="css/style.css">
  </head>

  <body>

    <div id="chat"></div>
    
    <!-- JS -->
    <script src="../SHARED/js/tmi.min.js"></script>
    <script src="js/twemoji.min.js"></script>
    
    <script>
      var $botName = "<?php print $bot_obj->BotName; ?>";
      var $botAuth = "<?php print $bot_obj->TwitchClientOAuth; ?>";
      var $botChannel = "<?php print $bot_obj->TwitchClientChannel; ?>";
    </script>

    <script src="js/script.js"></script>

  </body>
</html>