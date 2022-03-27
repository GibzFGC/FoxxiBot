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

if ($_REQUEST["v"] == "save_player") {

    // Check if Player Exists
    $sql = "SELECT COUNT(*) FROM gb_tournament_players WHERE name='$_POST[modal_player_name]'";
    $res = $PDO->query($sql);
    $count = $res->fetchColumn();

    if ($count > 0) {
        throw new Exception('Player Name is already taken!');
        return;
    }

    // Player Save Data
    $sql = 'INSERT OR IGNORE INTO gb_tournament_players (tag, name, country, country_code) VALUES (:tag, :name, :country, :country_code)' or die(print_r($PDO->errorInfo(), true));
    $stmt = $PDO->prepare($sql);
    
    $stmt->bindValue(':tag', $_POST["modal_player_tag"]);
    $stmt->bindValue(':name', $_POST["modal_player_name"]);
    $stmt->bindValue(':country', $_POST["modal_player_country"]);
    $stmt->bindValue(':country_code', $_POST["modal_player_country_code"]);
    $stmt->execute();

}

if ($_REQUEST["v"] == "edit_player1") {

    $sql = "UPDATE gb_tournament_players SET tag = :tag, country = :country, country_code = :country_code WHERE name = :commandID";
    $stmt = $PDO->prepare($sql);

    $stmt->bindValue(':commandID', $_POST["modal_edit_player1_name"]);
    $stmt->bindValue(':tag', $_POST["modal_edit_player1_tag"]);
    $stmt->bindValue(':country', $_POST["modal_edit_player1_country"]);
    $stmt->bindValue(':country_code', $_POST["modal_edit_player1_country_code"]);
    $stmt->execute();

}

if ($_REQUEST["v"] == "edit_player2") {

    $sql = "UPDATE gb_tournament_players SET tag = :tag, country = :country, country_code = :country_code WHERE name = :commandID";
    $stmt = $PDO->prepare($sql);

    $stmt->bindValue(':commandID', $_POST["modal_edit_player2_name"]);
    $stmt->bindValue(':tag', $_POST["modal_edit_player2_tag"]);
    $stmt->bindValue(':country', $_POST["modal_edit_player2_country"]);
    $stmt->bindValue(':country_code', $_POST["modal_edit_player2_country_code"]);
    $stmt->execute();

}

if ($_REQUEST["v"] == "delete_player") {

    $sql = 'DELETE FROM gb_tournament_players WHERE id = :commandID';
    $stmt = $PDO->prepare($sql);
    
    $stmt->bindValue(':commandID', $_REQUEST["id"]);
    $stmt->execute();

    // Redirect
    $URL="$gfw[site_url]/index.php?p=tournament&a=players&s=success";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';

}

if ($_REQUEST["v"] == "scoreboard_save") {

    $sql = 'INSERT OR REPLACE INTO gb_tournament_scoreboard (parameter, value) VALUES (:parameter, :value)' or die(print_r($PDO->errorInfo(), true));
    $stmt = $PDO->prepare($sql);
    
    // Player 1 Data
    $stmt->bindValue(':parameter', "p1Tag");
    $stmt->bindValue(':value', $_POST["p1_tag"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', "p1Name");
    $stmt->bindValue(':value', $_POST["p1_name"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', "p1Country");
    $stmt->bindValue(':value', $_POST["p1_country"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', "p1CountryCode");
    $stmt->bindValue(':value', $_POST["p1_country_code"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', "p1Status");
    $stmt->bindValue(':value', $_POST["p1_status"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', "p1Score");
    $stmt->bindValue(':value', $_POST["p1_score"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', "p1TeamPosition");
    $stmt->bindValue(':value', $_POST["p1_position"]);
    $stmt->execute();

    // Player 2 Data
    $stmt->bindValue(':parameter', "p2Tag");
    $stmt->bindValue(':value', $_POST["p2_tag"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', "p2Name");
    $stmt->bindValue(':value', $_POST["p2_name"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', "p2Country");
    $stmt->bindValue(':value', $_POST["p2_country"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', "p2CountryCode");
    $stmt->bindValue(':value', $_POST["p2_country_code"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', "p2Status");
    $stmt->bindValue(':value', $_POST["p2_status"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', "p2Score");
    $stmt->bindValue(':value', $_POST["p2_score"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', "p2TeamPosition");
    $stmt->bindValue(':value', $_POST["p2_position"]);
    $stmt->execute();

    // Tournament Data
    $stmt->bindValue(':parameter', "tournamentRound");
    $stmt->bindValue(':value', $_POST["tournament-round"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', "tournamentRoundStatus");
    $stmt->bindValue(':value', $_POST["tournament-round-extra"]);
    $stmt->execute();

}

if ($_REQUEST["v"] == "top8_save") {

    $match_block = $_POST["top8_block"];

    $sql = 'INSERT OR REPLACE INTO gb_tournament_top8 (parameter, value) VALUES (:parameter, :value)' or die(print_r($PDO->errorInfo(), true));
    $stmt = $PDO->prepare($sql);

    $stmt->bindValue(':parameter', $match_block . "-p1-tag");
    $stmt->bindValue(':value', $_POST["player_1_tag"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', $match_block . "-p2-tag");
    $stmt->bindValue(':value', $_POST["player_2_tag"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', $match_block . "-p1-name");
    $stmt->bindValue(':value', $_POST["player_1_name"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', $match_block . "-p2-name");
    $stmt->bindValue(':value', $_POST["player_2_name"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', $match_block . "-p1-country");
    $stmt->bindValue(':value', $_POST["player_1_country"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', $match_block . "-p2-country");
    $stmt->bindValue(':value', $_POST["player_2_country"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', $match_block . "-p1-country-code");
    $stmt->bindValue(':value', $_POST["player_1_country_code"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', $match_block . "-p2-country-code");
    $stmt->bindValue(':value', $_POST["player_2_country_code"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', $match_block . "-p1-score");
    $stmt->bindValue(':value', $_POST["player_1_score"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', $match_block . "-p2-score");
    $stmt->bindValue(':value', $_POST["player_2_score"]);
    $stmt->execute();    

}