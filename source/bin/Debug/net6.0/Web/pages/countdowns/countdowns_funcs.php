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

    $datetime = $_POST["commandDateTime"];
    $date_filter = new DateTime($datetime);
    $date_format = $date_filter->format("d M Y H:i:s");

    $sql = 'INSERT INTO gb_countdowns (title, datetime, timestamp) VALUES (:commandTitle, :commandDateTime, :commandTimeStamp)' or die(print_r($PDO->errorInfo(), true));
    $stmt = $PDO->prepare($sql);
    
    $stmt->bindValue(':commandTitle', $_POST["commandTitle"]);
    $stmt->bindValue(':commandDateTime', $date_format);
    $stmt->bindValue(':commandTimeStamp', $datetime);
    $stmt->execute();

    // Redirect
    $URL="$gfw[site_url]/index.php?p=countdowns&s=success";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}

if ($_REQUEST["v"] == "edit") {

    $datetime = $_POST["commandDateTime"];
    $date_filter = new DateTime($datetime);
    $date_format = $date_filter->format("d M Y H:i:s");

    $sql = "UPDATE gb_countdowns SET title = :commandTitle, datetime = :commandDateTime, timestamp = :commandTimeStamp WHERE id = :commandID";
    $stmt = $PDO->prepare($sql);

    $stmt->bindValue(':commandID', $_POST["commandID"]);
    $stmt->bindValue(':commandTitle', $_POST["commandTitle"]);
    $stmt->bindValue(':commandDateTime', $date_format);
    $stmt->bindValue(':commandTimeStamp', $datetime);
    $stmt->execute();

    // Redirect
    $URL="$gfw[site_url]/index.php?p=countdowns&s=success";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';

}

if ($_REQUEST["v"] == "delete") {

    $sql = 'DELETE FROM gb_countdowns WHERE id = :commandID';
    $stmt = $PDO->prepare($sql);
    
    $stmt->bindValue(':commandID', $_REQUEST["id"]);
    $stmt->execute();

    // Redirect
    $URL="$gfw[site_url]/index.php?p=countdowns&s=success";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';

}
?>