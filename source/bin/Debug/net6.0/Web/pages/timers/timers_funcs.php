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
    $sql = 'INSERT INTO gb_twitch_timers (name, response, active) VALUES (:timerName, :timerResponse, :timerActive)' or die(print_r($PDO->errorInfo(), true));
    $stmt = $PDO->prepare($sql);
    
    $stmt->bindValue(':timerName', $_POST["timerName"]);
    $stmt->bindValue(':timerResponse', $_POST["timerResponse"]);
    $stmt->bindValue(':timerActive', $_POST["timerActive"]);
    $stmt->execute();
    
    // Redirect
    $URL="$gfw[site_url]/index.php?p=timers";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}

if ($_REQUEST["v"] == "edit") {

    $sql = "UPDATE gb_twitch_timers SET name = :timerName, response = :timerResponse, active = :timerActive WHERE id = :timerID";
    $stmt = $PDO->prepare($sql);

    $stmt->bindValue(':timerID', $_POST["timerID"]);
    $stmt->bindValue(':timerName', $_POST["timerName"]);
    $stmt->bindValue(':timerResponse', $_POST["timerResponse"]);
    $stmt->bindValue(':timerActive', $_POST["timerActive"]);
    $stmt->execute();
    
    // Redirect
    $URL="$gfw[site_url]/index.php?p=timers";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}

if ($_REQUEST["v"] == "delete") {

    $sql = 'DELETE FROM gb_twitch_timers WHERE id = :commandID';
    $stmt = $PDO->prepare($sql);
    
    $stmt->bindValue(':commandID', $_REQUEST["id"]);
    $stmt->execute();

    // Redirect
    $URL="$gfw[site_url]/index.php?p=timers";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';

}
?>