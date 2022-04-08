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

    if (empty($_FILES["soundUpload"]["name"])) {

        $add_sound = "";
        $sound_name = $add_sound;
    } else {
    
        $filenamed = str_replace("?", "", $_FILES["soundUpload"]["name"]);
        $filenamee = str_replace(":", "", $filenamed);
        $filenamef = str_replace(" ", "", $filenamee);
    
        $extension1 = end(explode(".", $filenamef));
    
        $add_sound = "../Files/Sounds/". $_POST["soundName"] . "." . $extension1;
        $sound_name = $_POST["soundName"] . "." . $extension1;
        copy($_FILES["soundUpload"]["tmp_name"], $add_sound);
        chmod("$add_sound",0777);
        $add_new = str_replace('../','', $add_sound);
    }

    $sql = 'INSERT INTO gb_sounds (name, file, active) VALUES (:soundName, :soundFile, :soundPoints, :soundActive)' or die(print_r($PDO->errorInfo(), true));
    $stmt = $PDO->prepare($sql);
    
    $stmt->bindValue(':soundName', $_POST["soundName"]);
    $stmt->bindValue(':soundPoints', $_POST["soundPoints"]);
    $stmt->bindValue(':soundFile', $sound_name);
    $stmt->bindValue(':soundActive', $_POST["soundActive"]);
    $stmt->execute();

    // Redirect
    $URL="$gfw[site_url]/index.php?p=audio&s=success";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';

}

if ($_REQUEST["v"] == "edit") {

    if (empty($_FILES["soundUpload"]["name"])) {
        $add_sound = $_POST["soundLocalFile"];
        $sound_name = $add_sound;
    } else {
    
        $filenamed = str_replace("?", "", $_FILES["soundUpload"]["name"]);
        $filenamee = str_replace(":", "", $filenamed);
        $filenamef = str_replace(" ", "", $filenamee);
    
        $extension1 = end(explode(".", $filenamef));
    
        $add_sound = "../Files/Sounds/". $_POST["soundName"] . "." . $extension1;
        $sound_name = $_POST["soundName"] . "." . $extension1;
        copy($_FILES["soundUpload"]["tmp_name"], $add_sound);
        chmod("$add_sound",0777);
        $add_new = str_replace('../','', $add_sound);
    }

    $sql = "UPDATE gb_sounds SET name = :soundName, points = :soundPoints, file = :soundFile, active = :soundActive WHERE id = :commandID";
    $stmt = $PDO->prepare($sql);

    $stmt->bindValue(':commandID', $_POST["commandID"]);
    $stmt->bindValue(':soundName', $_POST["soundName"]);
    $stmt->bindValue(':soundPoints', $_POST["soundPoints"]);
    $stmt->bindValue(':soundFile', $sound_name);
    $stmt->bindValue(':soundActive', $_POST["soundActive"]);
    $stmt->execute();

    // Redirect
    $URL="$gfw[site_url]/index.php?p=audio&s=success";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';

}

if ($_REQUEST["v"] == "delete") {

    $sql = 'DELETE FROM gb_sounds WHERE id = :commandID';
    $stmt = $PDO->prepare($sql);
    
    $stmt->bindValue(':commandID', $_REQUEST["id"]);
    $stmt->execute();

    // Redirect
    $URL="$gfw[site_url]/index.php?p=audio&s=success";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';

}