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
    $sql = 'INSERT INTO gb_ticker (name, response, active) VALUES (:tickerName, :tickerResponse, :tickerActive)' or die(print_r($PDO->errorInfo(), true));
    $stmt = $PDO->prepare($sql);
    
    $stmt->bindValue(':tickerName', $_POST["tickerName"]);
    $stmt->bindValue(':tickerResponse', $_POST["tickerResponse"]);
    $stmt->bindValue(':tickerActive', $_POST["tickerActive"]);
    $stmt->execute();
    
    // Redirect
    $URL="$gfw[site_url]/index.php?p=ticker";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}

if ($_REQUEST["v"] == "edit") {

    $sql = "UPDATE gb_ticker SET name = :tickerName, response = :tickerResponse, active = :tickerActive WHERE id = :tickerID";
    $stmt = $PDO->prepare($sql);

    $stmt->bindValue(':tickerID', $_POST["tickerID"]);
    $stmt->bindValue(':tickerName', $_POST["tickerName"]);
    $stmt->bindValue(':tickerResponse', $_POST["tickerResponse"]);
    $stmt->bindValue(':tickerActive', $_POST["tickerActive"]);
    $stmt->execute();
    
    // Redirect
    $URL="$gfw[site_url]/index.php?p=ticker";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}

if ($_REQUEST["v"] == "delete") {

    $sql = 'DELETE FROM gb_ticker WHERE id = :commandID';
    $stmt = $PDO->prepare($sql);
    
    $stmt->bindValue(':commandID', $_REQUEST["id"]);
    $stmt->execute();

    // Redirect
    $URL="$gfw[site_url]/index.php?p=ticker";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';

}
?>