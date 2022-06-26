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

if ($_REQUEST["v"] == "send") {

}

if ($_REQUEST["v"] == "save") {

    // Check if Bot Controlled Command
    if (in_array($_POST["commandName"], $gfw["bot_discord_commands"])) {

        // Redirect
        $URL="$gfw[site_url]/index.php?p=discord_commands&s=error";
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';

    } else {
    
        if (isset($_POST["commandPermissions"])) {
            $permissions = json_encode($_POST["commandPermissions"]); 
        } else {
            $permissions = "";
        }

        $sql = 'INSERT INTO gb_discord_commands (name, response, permission, active) VALUES (:commandName, :commandResponse, :commandPermissions, :commandActive)' or die(print_r($PDO->errorInfo(), true));
        $stmt = $PDO->prepare($sql);
        
        $stmt->bindValue(':commandName', $_POST["commandName"]);
        $stmt->bindValue(':commandResponse', $_POST["commandResponse"]);
        $stmt->bindValue(':commandPermissions', $permissions);
        $stmt->bindValue(':commandActive', $_POST["commandActive"]);
        $stmt->execute();
    
        // Redirect
        $URL="$gfw[site_url]/index.php?p=discord_commands&s=success";
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    }
}

if ($_REQUEST["v"] == "edit") {

    // Check if Bot Controlled Command
    if (in_array($_POST["commandName"], $gfw["bot_discord_commands"])) {

        // Redirect
        $URL="$gfw[site_url]/index.php?p=discord_commands&s=error";
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';

    } else {

        if (isset($_POST["commandPermissions"])) {
            $permissions = json_encode($_POST["commandPermissions"]); 
        } else {
            $permissions = "";
        }

        $sql = "UPDATE gb_discord_commands SET name = :commandName, response = :commandResponse, permission = :commandPermissions, active = :commandActive WHERE id = :commandID";
        $stmt = $PDO->prepare($sql);

        $stmt->bindValue(':commandID', $_POST["commandID"]);
        $stmt->bindValue(':commandName', $_POST["commandName"]);
        $stmt->bindValue(':commandResponse', $_POST["commandResponse"]);
        $stmt->bindValue(':commandPermissions', $permissions);
        $stmt->bindValue(':commandActive', $_POST["commandActive"]);
        $stmt->execute();

        // Redirect
        $URL="$gfw[site_url]/index.php?p=discord_commands&s=success";
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    }
}

if ($_REQUEST["v"] == "delete") {

    $sql = 'DELETE FROM gb_discord_commands WHERE id = :commandID';
    $stmt = $PDO->prepare($sql);
    
    $stmt->bindValue(':commandID', $_REQUEST["id"]);
    $stmt->execute();

    // Redirect
    $URL="$gfw[site_url]/index.php?p=discord_commands&s=success";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';

}
?>