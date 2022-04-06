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

if ($_REQUEST["v"] == "save") {

    if ($_POST["commandName"] == "so" || $_POST["commandName"] == "quote" || $_POST["commandName"] == "age" || $_POST["commandName"] == "followage" || $_POST["commandName"] == "sound" || $_POST["commandName"] == "audio" || $_POST["commandName"] == "play") {

        // Redirect
        $URL="$gfw[site_url]/index.php?p=twitch_commands&s=error";
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';

    } else {
    
        $sql = 'INSERT INTO gb_commands (name, response, points, permission, active) VALUES (:commandName, :commandResponse, :commandPoints, :commandPermissions, :commandActive)' or die(print_r($PDO->errorInfo(), true));
        $stmt = $PDO->prepare($sql);
        
        $stmt->bindValue(':commandName', "!" . $_POST["commandName"]);
        $stmt->bindValue(':commandResponse', $_POST["commandResponse"]);
        $stmt->bindValue(':commandPoints', $_POST["commandPoints"]);
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

    if ($_POST["commandName"] == "so" || $_POST["commandName"] == "quote" || $_POST["commandName"] == "age" || $_POST["commandName"] == "sound" || $_POST["commandName"] == "audio" || $_POST["commandName"] == "play") {

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
        $stmt->bindValue(':commandPoints', $_POST["commandPoints"]);
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