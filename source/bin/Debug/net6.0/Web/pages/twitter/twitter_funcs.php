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

if ($_REQUEST["v"] == "settings") {

    $sql = 'INSERT OR REPLACE INTO gb_options (parameter, value) VALUES (:parameter, :value)' or die(print_r($PDO->errorInfo(), true));
    $stmt = $PDO->prepare($sql);

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
    
    if (!isset($_POST["twitter_livestatement_status"])) {
        $_POST["twitter_livestatement_status"] = "off";
    }
    
    $stmt->bindValue(':parameter', "twitter_livestatement_status");
    $stmt->bindValue(':value', $_POST["twitter_livestatement_status"]);
    $stmt->execute();

    // Redirect
    $URL="$gfw[site_url]/index.php?p=twitter&a=settings&s=success";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}

if ($_REQUEST["v"] == "save") {

    $sql = 'INSERT INTO gb_twitter_status (game, tweet, active) VALUES (:commandGame, :commandTweet, :commandActive)' or die(print_r($PDO->errorInfo(), true));
    $stmt = $PDO->prepare($sql);
    
    $stmt->bindValue(':commandGame', $_POST["commandGame"]);
    $stmt->bindValue(':commandTweet', $_POST["commandTweet"]);
    $stmt->bindValue(':commandActive', $_POST["commandActive"]);
    $stmt->execute();

    // Redirect
    $URL="$gfw[site_url]/index.php?p=twitter&s=success";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';

}

if ($_REQUEST["v"] == "edit") {

    $sql = "UPDATE gb_twitter_status SET game = :commandGame, tweet = :commandTweet, active = :commandActive WHERE game = :commandID";
    $stmt = $PDO->prepare($sql);

    $stmt->bindValue(':commandID', $_POST["commandID"]);
    $stmt->bindValue(':commandGame', $_POST["commandGame"]);
    $stmt->bindValue(':commandTweet', $_POST["commandTweet"]);
    $stmt->bindValue(':commandActive', $_POST["commandActive"]);
    $stmt->execute();

    // Redirect
    $URL="$gfw[site_url]/index.php?p=twitter&s=success";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';  

}

if ($_REQUEST["v"] == "delete") {

    $sql = 'DELETE FROM gb_twitter_status WHERE game = :commandID';
    $stmt = $PDO->prepare($sql);
    
    $stmt->bindValue(':commandID', $_REQUEST["id"]);
    $stmt->execute();

    // Redirect
    $URL="$gfw[site_url]/index.php?p=twitter&s=success";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';  

}