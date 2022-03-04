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

    $sql = 'INSERT OR REPLACE INTO gb_twitch_options (parameter, value) VALUES (:parameter, :value)' or die(print_r($PDO->errorInfo(), true));
    $stmt = $PDO->prepare($sql);

    $stmt->bindValue(':parameter', "Giveaway_Name");
    $stmt->bindValue(':value', $_POST["giveawayName"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', "Giveaway_Details");
    $stmt->bindValue(':value', $_POST["giveawayDetails"]);
    $stmt->execute();

    // Check if value null
    if (!isset($_POST["Giveaway_Status"])) {
        $_POST["Giveaway_Status"] = "off";
    }

    $stmt->bindValue(':parameter', "Giveaway_Status");
    $stmt->bindValue(':value', $_POST["Giveaway_Status"]);
    $stmt->execute();

    // Check if value null
    if (!isset($_POST["Giveaway_AllowTwitchStaff"])) {
        $_POST["Giveaway_AllowTwitchStaff"] = "off";
    }

    $stmt->bindValue(':parameter', "Giveaway_AllowTwitchStaff");
    $stmt->bindValue(':value', $_POST["Giveaway_AllowTwitchStaff"]);
    $stmt->execute();

    // Check if value null
    if (!isset($_POST["Giveaway_AllowMods"])) {
        $_POST["Giveaway_AllowMods"] = "off";
    }

    $stmt->bindValue(':parameter', "Giveaway_AllowMods");
    $stmt->bindValue(':value', $_POST["Giveaway_AllowMods"]);
    $stmt->execute();

    // Send a Message to Twitch

    // Redirect
    $URL="$gfw[site_url]/index.php?p=giveaway&s=success";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';

}

if ($_REQUEST["v"] == "clear") {
    
    // Delete all Participants
    $give_stmt = $PDO->prepare("DELETE FROM gb_twitch_giveaway");
    $give_stmt->execute();

    // Reset all Data
    $sql = 'INSERT OR REPLACE INTO gb_twitch_options (parameter, value) VALUES (:parameter, :value)' or die(print_r($PDO->errorInfo(), true));
    $stmt = $PDO->prepare($sql);

    $stmt->bindValue(':parameter', "Giveaway_Name");
    $stmt->bindValue(':value', "");
    $stmt->execute();

    $stmt->bindValue(':parameter', "Giveaway_Details");
    $stmt->bindValue(':value', "");
    $stmt->execute();

    $stmt->bindValue(':parameter', "Giveaway_Status");
    $stmt->bindValue(':value', "off");
    $stmt->execute();

    $stmt->bindValue(':parameter', "Giveaway_AllowTwitchStaff");
    $stmt->bindValue(':value', "off");
    $stmt->execute();

    $stmt->bindValue(':parameter', "Giveaway_AllowMods");
    $stmt->bindValue(':value', "off");
    $stmt->execute();
    
    // Redirect
    $URL="$gfw[site_url]/index.php?p=giveaway";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';  
}