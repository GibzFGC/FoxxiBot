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
    $sql = 'INSERT OR REPLACE INTO gb_options (parameter, value) VALUES (:parameter, :value)' or die(print_r($PDO->errorInfo(), true));
    $stmt = $PDO->prepare($sql);
    
    // Main Bot Settings

    // debug_mode
    if (!isset($_POST["debug_mode"])) {
        $_POST["debug_mode"] = "off";
    }

    $stmt->bindValue(':parameter', "debug");
    $stmt->bindValue(':value', $_POST["debug_mode"]);
    $stmt->execute();

    // Side Menu Settings

    // discord_features
    if (!isset($_POST["discord_features"])) {
        $_POST["discord_features"] = "off";
    }

    $stmt->bindValue(':parameter', "discord_features");
    $stmt->bindValue(':value', $_POST["discord_features"]);
    $stmt->execute();

    // twitch_features
    if (!isset($_POST["twitch_features"])) {
        $_POST["twitch_features"] = "off";
    }

    $stmt->bindValue(':parameter', "twitch_features");
    $stmt->bindValue(':value', $_POST["twitch_features"]);
    $stmt->execute();

    // tournament_features
    if (!isset($_POST["tournament_features"])) {
        $_POST["tournament_features"] = "off";
    }

    $stmt->bindValue(':parameter', "tournament_features");
    $stmt->bindValue(':value', $_POST["tournament_features"]);
    $stmt->execute();

    // twitter_features
    if (!isset($_POST["twitter_features"])) {
        $_POST["twitter_features"] = "off";
    }

    $stmt->bindValue(':parameter', "twitter_features");
    $stmt->bindValue(':value', $_POST["twitter_features"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', "twitter_username");
    $stmt->bindValue(':value', $_POST["twitter_username"]);
    $stmt->execute(); 

    $stmt->bindValue(':parameter', "twitter_usertoken");
    $stmt->bindValue(':value', $_POST["twitter_usertoken"]);
    $stmt->execute(); 

    $stmt->bindValue(':parameter', "twitter_usertokensecret");
    $stmt->bindValue(':value', $_POST["twitter_usertokensecret"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', "twitter_consumerkey");
    $stmt->bindValue(':value', $_POST["twitter_consumerkey"]);
    $stmt->execute(); 

    $stmt->bindValue(':parameter', "twitter_consumersecret");
    $stmt->bindValue(':value', $_POST["twitter_consumersecret"]);
    $stmt->execute();

    // twitter_features
    if (!isset($_POST["twitter_livestatement_status"])) {
        $_POST["twitter_livestatement_status"] = "off";
    }

    $stmt->bindValue(':parameter', "twitter_livestatement_status");
    $stmt->bindValue(':value', $_POST["twitter_livestatement_status"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', "twitter_livestatement");
    $stmt->bindValue(':value', $_POST["twitter_livestatement"]);
    $stmt->execute();

    // Redirect
    $URL="$gfw[site_url]/index.php?p=options&a=settings&s=success";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}