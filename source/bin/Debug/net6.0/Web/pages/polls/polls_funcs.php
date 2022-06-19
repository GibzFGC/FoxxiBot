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

    $sql = 'INSERT INTO gb_polls (title, option1, option2, option3, option4, datetime, timestamp, active) VALUES (:title, :option1, :option2, :option3, :option4, :datetime, :timestamp, :active)' or die(print_r($PDO->errorInfo(), true));
    $stmt = $PDO->prepare($sql);
    
    $stmt->bindValue(':title', $_POST["pollTitle"]);
    $stmt->bindValue(':option1', $_POST["pollOption1"]);
    $stmt->bindValue(':option2', $_POST["pollOption2"]);
    $stmt->bindValue(':option3', $_POST["pollOption3"]);
    $stmt->bindValue(':option4', $_POST["pollOption4"]);
    $stmt->bindValue(':datetime', $date_format);
    $stmt->bindValue(':timestamp', $datetime);
    $stmt->bindValue(':active', $_POST["pollActive"]);
    $stmt->execute();

    // Redirect
    $URL="$gfw[site_url]/index.php?p=polls&s=success";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}

if ($_REQUEST["v"] == "state") {

}

if ($_REQUEST["v"] == "delete") {

    $sql = 'DELETE FROM gb_polls WHERE id = :commandID';
    $stmt = $PDO->prepare($sql);
    
    $stmt->bindValue(':commandID', $_REQUEST["id"]);
    $stmt->execute();

    // Redirect
    $URL="$gfw[site_url]/index.php?p=polls&s=success";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';

}

if ($_REQUEST["v"] == "clear") {
    
    $sql = 'DELETE FROM gb_polls_votes WHERE poll_id = :commandID';
    $stmt = $PDO->prepare($sql);
    
    $stmt->bindValue(':commandID', $_REQUEST["id"]);
    $stmt->execute();

    // Redirect
    $URL="$gfw[site_url]/index.php?p=polls&s=success";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';

}

?>