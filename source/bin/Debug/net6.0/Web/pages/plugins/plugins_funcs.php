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

if ($_REQUEST["v"] == "status") {

    if ($_REQUEST["platform"] == "twitch") {

        $sql = "UPDATE gb_twitch_plugins SET active = :pluginActive WHERE command = :commandID";
        $stmt = $PDO->prepare($sql);

        $stmt->bindValue(':commandID', $_REQUEST["id"]);
        $stmt->bindValue(':pluginActive', $_REQUEST["status"]);
        $stmt->execute();

        // Redirect
        $URL="$gfw[site_url]/index.php?p=plugins&s=success";
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';

    }

    if ($_REQUEST["platform"] == "discord") {

        $sql = "UPDATE gb_discord_plugins SET active = :pluginActive WHERE command = :commandID";
        $stmt = $PDO->prepare($sql);

        $stmt->bindValue(':commandID', $_REQUEST["id"]);
        $stmt->bindValue(':pluginActive', $_REQUEST["status"]);
        $stmt->execute();

        // Redirect
        $URL="$gfw[site_url]/index.php?p=plugins&s=success";
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';

    }

}

if ($_REQUEST["v"] == "delete") {

    if ($_REQUEST["platform"] == "twitch") {
        $sql = 'DELETE FROM gb_twitch_plugins WHERE command = :commandID';
        $stmt = $PDO->prepare($sql);
        
        $stmt->bindValue(':commandID', $_REQUEST["id"]);
        $stmt->execute();
    }

    if ($_REQUEST["platform"] == "discord") {
        $sql = 'DELETE FROM gb_discord_plugins WHERE command = :commandID';
        $stmt = $PDO->prepare($sql);
        
        $stmt->bindValue(':commandID', $_REQUEST["id"]);
        $stmt->execute();
    }

    // Redirect
    $URL="$gfw[site_url]/index.php?p=plugins&s=success";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';

}