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
    $sql = 'INSERT OR REPLACE INTO gb_discord_options (parameter, value) VALUES (:parameter, :value)' or die(print_r($PDO->errorInfo(), true));
    $stmt = $PDO->prepare($sql);
    
    $stmt->bindValue(':parameter', "BotChannel");
    $stmt->bindValue(':value', $_POST["discord_setbotchannel"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', "GreetingChannel");
    $stmt->bindValue(':value', $_POST["discord_setgreetingchannel"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', "StreamChannel");
    $stmt->bindValue(':value', $_POST["discord_setstreamchannel"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', "AutoRole");
    $stmt->bindValue(':value', $_POST["discord_setautoroll"]);
    $stmt->execute();

    // Check if value null
    if (!isset($_POST["botchannel_status"])) {
        $_POST["botchannel_status"] = "off";
    }

    $stmt->bindValue(':parameter', "BotChannel_Status");
    $stmt->bindValue(':value', $_POST["botchannel_status"]);
    $stmt->execute();

    // Check if value null
    if (!isset($_POST["setgreeting_status"])) {
        $_POST["setgreeting_status"] = "off";
    }

    $stmt->bindValue(':parameter', "GreetingChannel_Status");
    $stmt->bindValue(':value', $_POST["setgreeting_status"]);
    $stmt->execute();

    // Check if value null
    if (!isset($_POST["streamchannel_status"])) {
        $_POST["streamchannel_status"] = "off";
    }

    $stmt->bindValue(':parameter', "StreamChannel_Status");
    $stmt->bindValue(':value', $_POST["streamchannel_status"]);
    $stmt->execute();

    // Check if value null
    if (!isset($_POST["autorole_status"])) {
        $_POST["autorole_status"] = "off";
    }

    $stmt->bindValue(':parameter', "AutoRole_Status");
    $stmt->bindValue(':value', $_POST["autorole_status"]);
    $stmt->execute();

    // Redirect
    $URL="$gfw[site_url]/index.php?p=discord&a=settings&s=success";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}