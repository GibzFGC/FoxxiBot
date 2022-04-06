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

    $sql = 'INSERT OR REPLACE INTO gb_points_options (parameter, value) VALUES (:parameter, :value)' or die(print_r($PDO->errorInfo(), true));
    $stmt = $PDO->prepare($sql);

    // Check if value null
    if (!isset($_POST["points_active"])) {
        $_POST["points_active"] = "off";
    }

    $stmt->bindValue(':parameter', "points_active");
    $stmt->bindValue(':value', $_POST["points_active"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', "points_name");
    $stmt->bindValue(':value', $_POST["points_name"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', "points_short");
    $stmt->bindValue(':value', $_POST["points_shortname"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', "points_increment");
    $stmt->bindValue(':value', $_POST["points_increment"]);
    $stmt->execute();    

}

if ($_REQUEST["v"] == "update_user") {

    $sql = "UPDATE gb_points SET value = :value WHERE username = :username";
    $stmt = $PDO->prepare($sql);

    $stmt->bindValue(':username', $_POST["points_username"]);
    $stmt->bindValue(':value', $_POST["points_current"]);
    $stmt->execute();

}

if ($_REQUEST["v"] == "refund") {

    // Refund Points
    $sql = "UPDATE gb_points SET value = value + $_REQUEST[points] WHERE username = :username";
    $stmt = $PDO->prepare($sql);

    $stmt->bindValue(':username', $_REQUEST["user"]);
    $stmt->execute();

    // Delete Action
    $sql = 'DELETE FROM gb_points_actions WHERE id = :commandID';
    $stmt = $PDO->prepare($sql);
    
    $stmt->bindValue(':commandID', $_REQUEST["id"]);
    $stmt->execute();

}

if ($_REQUEST["v"] == "rain") {

    $sql = "UPDATE gb_points SET value = value + $_REQUEST[points] WHERE EXISTS (SELECT username FROM gb_twitch_watchlist WHERE username = gb_points.username)";
    $stmt = $PDO->prepare($sql);
    $stmt->execute();
    
}

if ($_REQUEST["v"] == "give") {

    $sql = "UPDATE gb_points SET value = value + $_REQUEST[points] WHERE EXISTS (SELECT username FROM gb_twitch_watchlist WHERE username = gb_points.username)";
    $stmt = $PDO->prepare($sql);
    $stmt->execute();

}

if ($_REQUEST["v"] == "take") {
 
    $sql = "UPDATE gb_points SET value = value - $_REQUEST[points] WHERE EXISTS (SELECT username FROM gb_twitch_watchlist WHERE username = gb_points.username)";
    $stmt = $PDO->prepare($sql);
    $stmt->execute();

}