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

if ($_REQUEST["v"] == "list") {

    $sql = 'INSERT INTO gb_twitch_modlist (item, allowed) VALUES (:listItem, :listAllowed)' or die(print_r($PDO->errorInfo(), true));
    $stmt = $PDO->prepare($sql);
    
    $stmt->bindValue(':listItem', $_POST["listName"]);
    $stmt->bindValue(':listAllowed', $_POST["listType"]);
    $stmt->execute();

    // Redirect
    $URL="$gfw[site_url]/index.php?p=twitch&a=modlist&s=success";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';

}

if ($_REQUEST["v"] == "delete") {

    $sql = 'DELETE FROM gb_twitch_modlist WHERE id = :commandID';
    $stmt = $PDO->prepare($sql);
    
    $stmt->bindValue(':commandID', $_REQUEST["id"]);
    $stmt->execute();

    // Redirect
    $URL="$gfw[site_url]/index.php?p=twitch&a=modlist&s=success";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';

}

if ($_REQUEST["v"] == "save") {

    $sql = 'INSERT OR REPLACE INTO gb_twitch_options (parameter, value) VALUES (:parameter, :value)' or die(print_r($PDO->errorInfo(), true));
    $stmt = $PDO->prepare($sql);
    
    // Check if value null
    if (!isset($_POST["blacklist_status"])) {
        $_POST["blacklist_status"] = "off";
    }

    $stmt->bindValue(':parameter', "Blacklist_Status");
    $stmt->bindValue(':value', $_POST["blacklist_status"]);
    $stmt->execute();

    // Check if value null
    if (!isset($_POST["whitelist_status"])) {
        $_POST["whitelist_status"] = "off";
    }

    $stmt->bindValue(':parameter', "Whitelist_Status");
    $stmt->bindValue(':value', $_POST["whitelist_status"]);
    $stmt->execute();

    // Check if value null
    if (!isset($_POST["linkfilter_status"])) {
        $_POST["linkfilter_status"] = "off";
    }

    $stmt->bindValue(':parameter', "LinkFilter_Status");
    $stmt->bindValue(':value', $_POST["linkfilter_status"]);
    $stmt->execute();

    // Check if value null
    if (!isset($_POST["capsfilter_status"])) {
        $_POST["capsfilter_status"] = "off";
    }

    $stmt->bindValue(':parameter', "CapsFilter_Status");
    $stmt->bindValue(':value', $_POST["capsfilter_status"]);
    $stmt->execute();

    // Check if value null
    if (!isset($_POST["symbolsfilter_status"])) {
        $_POST["symbolsfilter_status"] = "off";
    }

    $stmt->bindValue(':parameter', "SymbolsFilter_Status");
    $stmt->bindValue(':value', $_POST["symbolsfilter_status"]);
    $stmt->execute();

    // Check if value null
    if (!isset($_POST["spamfilter_status"])) {
        $_POST["spamfilter_status"] = "off";
    }

    $stmt->bindValue(':parameter', "SpamFilter_Status");
    $stmt->bindValue(':value', $_POST["spamfilter_status"]);
    $stmt->execute();

    // Check if value null
    if (!isset($_POST["mefilter_status"])) {
        $_POST["mefilter_status"] = "off";
    }

    $stmt->bindValue(':parameter', "MeFilter_Status");
    $stmt->bindValue(':value', $_POST["mefilter_status"]);
    $stmt->execute();

    // Check if value null
    if (!isset($_POST["systemfilter_status"])) {
        $_POST["systemfilter_status"] = "off";
    }

    $stmt->bindValue(':parameter', "SystemFilter_Status");
    $stmt->bindValue(':value', $_POST["systemfilter_status"]);
    $stmt->execute();

    // Redirect
    $URL="$gfw[site_url]/index.php?p=twitch&a=moderation";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}

if ($_REQUEST["v"] == "settings") {

    $sql = 'INSERT OR REPLACE INTO gb_twitch_options (parameter, value) VALUES (:parameter, :value)' or die(print_r($PDO->errorInfo(), true));
    $stmt = $PDO->prepare($sql);

    // Check if value null
    if (!isset($_POST["partner_status"])) {
        $_POST["partner_status"] = "off";
    }

    $stmt->bindValue(':parameter', "Partner_Status");
    $stmt->bindValue(':value', $_POST["partner_status"]);
    $stmt->execute();
    
    $stmt->bindValue(':parameter', "Joined_Channel");
    $stmt->bindValue(':value', $_POST["joined_channel"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', "On_Raid_Message");
    $stmt->bindValue(':value', $_POST["on_raid_message"]);
    $stmt->execute();    

    $stmt->bindValue(':parameter', "Follow_Message");
    $stmt->bindValue(':value', $_POST["follow_message"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', "Raid_Message");
    $stmt->bindValue(':value', $_POST["raid_message"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', "Prime_Message");
    $stmt->bindValue(':value', $_POST["prime_message"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', "Subscriber_Message");
    $stmt->bindValue(':value', $_POST["subscriber_message"]);
    $stmt->execute();

    // Redirect
    $URL="$gfw[site_url]/index.php?p=twitch&a=settings";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';

}