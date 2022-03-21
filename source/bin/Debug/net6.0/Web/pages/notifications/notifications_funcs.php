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

if ($_REQUEST["v"] == "event") {

     // Save to Events
    $sql = 'INSERT INTO gb_twitch_events (type, user, viewers) VALUES (:type, :user, :viewers)' or die(print_r($PDO->errorInfo(), true));
    $stmt = $PDO->prepare($sql);
    
    $stmt->bindValue(':type', $_REQUEST["type"]);
    $stmt->bindValue(':user', $_REQUEST["name"]);
    $stmt->bindValue(':viewers', $_REQUEST["views"]);
    $stmt->execute();

    // Redirect
    $URL="$gfw[site_url]/index.php";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';    
}

if ($_REQUEST["v"] == "play") {

    // Get the Event Data
    $data = $PDO->query("SELECT * FROM gb_twitch_notifications WHERE id='$_REQUEST[id]' LIMIT 1");

    foreach($data as $row)
    {
        $type = $row["type"];
        $user = $row["user"];
        $viewers = $row["viewers"];
    }

    // Save to Events
    $sql = 'INSERT INTO gb_twitch_events (type, user, viewers) VALUES (:type, :user, :viewers)' or die(print_r($PDO->errorInfo(), true));
    $stmt = $PDO->prepare($sql);
    
    $stmt->bindValue(':type', $row["type"]);
    $stmt->bindValue(':user', $row["user"]);
    $stmt->bindValue(':viewers', $row["viewers"]);
    $stmt->execute();

    // Redirect
    $URL="$gfw[site_url]/index.php?p=notifications&s=success";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}

if ($_REQUEST["v"] == "delete") {
    $sql = 'DELETE FROM gb_twitch_events WHERE id = :commandID';
    $stmt = $PDO->prepare($sql);
    
    $stmt->bindValue(':commandID', $_REQUEST["id"]);
    $stmt->execute();

    // Redirect
    $URL="$gfw[site_url]/index.php?p=notifications&s=success";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}