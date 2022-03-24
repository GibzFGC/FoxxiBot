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

    // Redirect
    $URL="$gfw[site_url]/index.php?p=tournament";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}