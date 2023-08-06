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

// Check for Secure Connection
if (!defined("G_FW") or !constant("G_FW")) die("Direct access not allowed!");

$options = array();

$result = $PDO->query("SELECT * FROM gb_points_options");
foreach($result as $row)
{
  $options[$row["parameter"]] = $row["value"];
}

if ($_REQUEST["v"] == "blacklist") {

    if ($_REQUEST["d"] == "save") {
        $sql = 'INSERT INTO gb_commands_blacklist (username) VALUES (:username)' or die(print_r($PDO->errorInfo(), true));
        $stmt = $PDO->prepare($sql);
    
        $stmt->bindValue(':username', $_POST["twitchName"]);
        $stmt->execute();

        // Redirect
        $URL="$gfw[site_url]/index.php?p=twitch_commands&a=blacklist&s=success";
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    }

    if ($_REQUEST["d"] == "delete") {
        $sql = 'DELETE FROM gb_commands_blacklist WHERE id = :commandID';
        $stmt = $PDO->prepare($sql);
        
        $stmt->bindValue(':commandID', $_REQUEST["id"]);
        $stmt->execute();

        // Redirect
        $URL="$gfw[site_url]/index.php?p=twitch_commands&a=blacklist&s=success";
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    }

}

if ($_REQUEST["v"] == "save") {

    // Check if Bot Controlled Command
    if (in_array($_POST["commandName"], $gfw["bot_twitch_commands"])) {

        // Redirect
        $URL="$gfw[site_url]/index.php?p=twitch_commands&s=error";
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';

    } else {
    
        $sql = 'INSERT INTO gb_commands (name, response, points, permission, active) VALUES (:commandName, :commandResponse, :commandPoints, :commandPermissions, :commandActive)' or die(print_r($PDO->errorInfo(), true));
        $stmt = $PDO->prepare($sql);
        
        $stmt->bindValue(':commandName', "!" . $_POST["commandName"]);
        $stmt->bindValue(':commandResponse', $_POST["commandResponse"]);
        
        if ($options["points_active"] == "off") {
            $stmt->bindValue(':commandPoints', 0);
        } else {
            $stmt->bindValue(':commandPoints', $_POST["commandPoints"]);
        }
        
        $stmt->bindValue(':commandPermissions', $_POST["commandPermissions"]);
        $stmt->bindValue(':commandActive', $_POST["commandActive"]);
        $stmt->execute();
    
        // Redirect
        $URL="$gfw[site_url]/index.php?p=twitch_commands&s=success";
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    }
}

if ($_REQUEST["v"] == "save_multi") {

    // Check if Bot Controlled Command
    if (in_array($_POST["commandName"], $gfw["bot_twitch_commands"])) {

        // Redirect
        $URL="$gfw[site_url]/index.php?p=twitch_commands&s=error";
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';

    } else {

        $sql = 'INSERT INTO gb_commands (name, response, points, permission, active) VALUES (:commandName, :commandResponse, :commandPoints, :commandPermissions, :commandActive)' or die(print_r($PDO->errorInfo(), true));
        $stmt = $PDO->prepare($sql);


        $stmt->bindValue(':commandName', "!" . $_POST["commandName"]);

        $new_message = array(
            "message_1" => $_POST['commandResponse1'],
            "message_2" => $_POST['commandResponse2'],
            "message_3" => $_POST['commandResponse3'],
            "message_4" => $_POST['commandResponse4'],
            "message_5" => $_POST['commandResponse5'],
            "message_6" => $_POST['commandResponse6'],
            "message_7" => $_POST['commandResponse7'],
            "message_8" => $_POST['commandResponse8'],
            "message_9" => $_POST['commandResponse9'],
            "message_10" => $_POST['commandResponse10']
         );

        $encoded_data = json_encode($new_message, JSON_PRETTY_PRINT);
        $stmt->bindValue(':commandResponse', $encoded_data);
        
        if ($options["points_active"] == "off") {
            $stmt->bindValue(':commandPoints', 0);
        } else {
            $stmt->bindValue(':commandPoints', $_POST["commandPoints"]);
        }
        
        $stmt->bindValue(':commandPermissions', $_POST["commandPermissions"]);
        $stmt->bindValue(':commandActive', $_POST["commandActive"]);
        $stmt->execute();

        // Redirect
        $URL="$gfw[site_url]/index.php?p=twitch_commands&s=success";
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    }
}

if ($_REQUEST["v"] == "edit") {

    // Check if Bot Controlled Command
    if (in_array($_POST["commandName"], $gfw["bot_twitch_commands"])) {

        // Redirect
        $URL="$gfw[site_url]/index.php?p=twitch_commands&s=error";
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';

    } else {

        $sql = "UPDATE gb_commands SET name = :commandName, response = :commandResponse, points = :commandPoints, permission = :commandPermissions, active = :commandActive WHERE id = :commandID";
        $stmt = $PDO->prepare($sql);

        $stmt->bindValue(':commandID', $_POST["commandID"]);
        $stmt->bindValue(':commandName', "!" . $_POST["commandName"]);
        $stmt->bindValue(':commandResponse', $_POST["commandResponse"]);

        if ($options["points_active"] == "off") {
            $stmt->bindValue(':commandPoints', 0);
        } else {
            $stmt->bindValue(':commandPoints', $_POST["commandPoints"]);
        }

        $stmt->bindValue(':commandPermissions', $_POST["commandPermissions"]);
        $stmt->bindValue(':commandActive', $_POST["commandActive"]);
        $stmt->execute();

        // Redirect
        $URL="$gfw[site_url]/index.php?p=twitch_commands&s=success";
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    }
}

if ($_REQUEST["v"] == "edit_multi") {

    // Check if Bot Controlled Command
    if (in_array($_POST["commandName"], $gfw["bot_twitch_commands"])) {

        // Redirect
        $URL="$gfw[site_url]/index.php?p=twitch_commands&s=error";
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';

    } else {

        $sql = "UPDATE gb_commands SET name = :commandName, response = :commandResponse, points = :commandPoints, permission = :commandPermissions, active = :commandActive WHERE id = :commandID";
        $stmt = $PDO->prepare($sql);

        $stmt->bindValue(':commandID', $_POST["commandID"]);
        $stmt->bindValue(':commandName', "!" . $_POST["commandName"]);

        $new_message = array(
            "message_1" => $_POST['commandResponse1'],
            "message_2" => $_POST['commandResponse2'],
            "message_3" => $_POST['commandResponse3'],
            "message_4" => $_POST['commandResponse4'],
            "message_5" => $_POST['commandResponse5'],
            "message_6" => $_POST['commandResponse6'],
            "message_7" => $_POST['commandResponse7'],
            "message_8" => $_POST['commandResponse8'],
            "message_9" => $_POST['commandResponse9'],
            "message_10" => $_POST['commandResponse10']
         );

        $encoded_data = json_encode($new_message, JSON_PRETTY_PRINT);
        $stmt->bindValue(':commandResponse', $encoded_data);
        
        if ($options["points_active"] == "off") {
            $stmt->bindValue(':commandPoints', 0);
        } else {
            $stmt->bindValue(':commandPoints', $_POST["commandPoints"]);
        }

        $stmt->bindValue(':commandPermissions', $_POST["commandPermissions"]);
        $stmt->bindValue(':commandActive', $_POST["commandActive"]);
        $stmt->execute();

        // Redirect
        $URL="$gfw[site_url]/index.php?p=twitch_commands&s=success";
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    }
}

if ($_REQUEST["v"] == "delete") {

    $sql = 'DELETE FROM gb_commands WHERE id = :commandID';
    $stmt = $PDO->prepare($sql);
    
    $stmt->bindValue(':commandID', $_REQUEST["id"]);
    $stmt->execute();

    // Redirect
    $URL="$gfw[site_url]/index.php?p=twitch_commands&s=success";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';

}
?>