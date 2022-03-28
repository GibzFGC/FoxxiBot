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

$options = array();

$result = $PDO->query("SELECT * FROM gb_tournament_top8");
foreach($result as $row)
{
  $results[$row["parameter"]] = $row["value"];
}
?>

  <!-- Custom CSS -->
  <link rel="stylesheet" href="/pages/tournament/css/tournament_top8.css">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/2.3.1/css/flag-icon.min.css'>

    <style>

    .dark-mode .modal-content {
        background-color: #454D55;
    }

    .modal-result {
        background-color: #343A40;
    }

    @media screen and (min-width: 676px) {
        .modal-dialog {
          max-width: 1000px; /* New width for default modal */
        }
    }
    </style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tournament Top 8</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tournament Top 8</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Top 8: Winners Side</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <div class="tournament-bracket tournament-bracket--rounded">                                                     
                <div class="tournament-bracket__round tournament-bracket__round--quarterfinals">
                <h3 class="tournament-bracket__round-title">Winners Semis</h3>
                <ul class="tournament-bracket__list">
                
                    <li class="tournament-bracket__item">
                        <div class="tournament-bracket__match" tabindex="0">
                            <table data-toggle="modal" data-target="#editModal" data-title="Winners Semis - Match 1" data-match="w-ws-m1" class="match_box  tournament-bracket__table">
                            <thead class="sr-only">
                                <tr>
                                <th>Player</th>
                                <th>Score</th>
                                </tr>
                            </thead>  
                            <tbody class="tournament-bracket__content">
                                <tr class="tournament-bracket__team">
                                <td class="tournament-bracket__country">
                                    <span id="w-ws-m1-p1-country-code" class="flag-erase tournament-bracket__flag flag-icon flag-icon-<?php echo $results["w-ws-m1-p1-country-code"]; ?>" aria-label="Flag"></span>
                                    <abbr id="w-ws-m1-p1-name" class="erasable tournament-bracket__code"><?php print $results["w-ws-m1-p1-name"]; ?></abbr>

                                    <abbr style="display: none;" id="w-ws-m1-p1-tag" class="erasable tournament-bracket__code"><?php print $results["w-ws-m1-p1-tag"]; ?></abbr>
                                    <abbr style="display: none;" id="w-ws-m1-p1-country" class="erasable tournament-bracket__code"><?php print $results["w-ws-m1-p1-country"]; ?></abbr>
                                    <abbr style="display: none;" id="w-ws-m1-p1-country-code-value" class="erasable tournament-bracket__code"><?php print $results["w-ws-m1-p1-country-code"]; ?></abbr>
                                </td>
                                <td class="tournament-bracket__score">
                                    <span id="w-ws-m1-p1-score" class="erasable tournament-bracket__number"><?php print $results["w-ws-m1-p1-score"]; ?></span>
                                </td>
                                </tr>
                                <tr class="tournament-bracket__team">
                                <td class="tournament-bracket__country">
                                    <abbr id="w-ws-m1-p2-name" class="erasable tournament-bracket__code"><?php print $results["w-ws-m1-p2-name"]; ?></abbr>
                                    <span id="w-ws-m1-p2-country-code" class="flag-erase tournament-bracket__flag flag-icon flag-icon-<?php echo $results["w-ws-m1-p2-country-code"]; ?>" aria-label="Flag"></span>

                                    <abbr style="display: none;" id="w-ws-m1-p2-tag" class="erasable tournament-bracket__code"><?php print $results["w-ws-m1-p2-tag"]; ?></abbr>
                                    <abbr style="display: none;" id="w-ws-m1-p2-country" class="erasable tournament-bracket__code"><?php print $results["w-ws-m1-p2-country"]; ?></abbr>
                                    <abbr style="display: none;" id="w-ws-m1-p2-country-code-value" class="erasable tournament-bracket__code"><?php print $results["w-ws-m1-p2-country-code"]; ?></abbr>
                                </td>
                                <td class="tournament-bracket__score">
                                    <span id="w-ws-m1-p2-score" class="erasable tournament-bracket__number"><?php print $results["w-ws-m1-p2-score"]; ?></span>
                                </td>
                                </tr>
                            </tbody>
                            </table>
                        </div>

                        <div class="match-options">
                            <a class="match-swap btn btn-v-sm btn-primary btn-spacer" data-match="w-ws-m1" href="#"><i class="fas fa-exchange-alt"></i> Swap</a>
                            <a class="match-reset btn btn-v-sm btn-danger" data-match="w-ws-m1" href="#"><i class="fas fa-eraser"></i> Reset Match</a>
                        </div>
                    </li>

                    <li class="tournament-bracket__item">
                        <div class="tournament-bracket__match" tabindex="0">
                            <table data-toggle="modal" data-target="#editModal" data-title="Winners Semis - Match 2" data-match="w-ws-m2" class="match_box tournament-bracket__table">
                            <thead class="sr-only">
                                <tr>
                                <th>Player</th>
                                <th>Score</th>
                                </tr>
                            </thead>  
                            <tbody class="tournament-bracket__content">
                                <tr class="tournament-bracket__team">
                                <td class="tournament-bracket__country">
                                <span id="w-ws-m2-p1-country-code" class="flag-erase tournament-bracket__flag flag-icon flag-icon-<?php print $results["w-ws-m2-p1-country-code"]; ?>" aria-label="Flag"></span>
                                    <abbr id="w-ws-m2-p1-name" class="erasable tournament-bracket__code"><?php print $results["w-ws-m2-p1-name"]; ?></abbr>

                                    <abbr style="display: none;" id="w-ws-m2-p1-tag" class="erasable tournament-bracket__code"><?php print $results["w-ws-m2-p1-tag"]; ?></abbr>
                                    <abbr style="display: none;" id="w-ws-m2-p1-country" class="erasable tournament-bracket__code"><?php print $results["w-ws-m2-p1-country"]; ?></abbr>
                                    <abbr style="display: none;" id="w-ws-m2-p1-country-code-value" class="erasable tournament-bracket__code"><?php print $results["w-ws-m2-p1-country-code"]; ?></abbr>
                                </td>
                                <td class="tournament-bracket__score">
                                    <span id="w-ws-m2-p1-score" class="erasable tournament-bracket__number"><?php print $results["w-ws-m2-p1-score"]; ?></span>
                                </td>
                                </tr>
                                <tr class="tournament-bracket__team">
                                <td class="tournament-bracket__country">
                                    <abbr id="w-ws-m2-p2-name" class="erasable tournament-bracket__code"><?php print $results["w-ws-m2-p2-name"]; ?></abbr>
                                    <span id="w-ws-m2-p2-country-code" class="flag-erase tournament-bracket__flag flag-icon flag-icon-<?php print $results["w-ws-m2-p2-country-code"]; ?>" aria-label="Flag"></span>

                                    <abbr style="display: none;" id="w-ws-m2-p2-tag" class="erasable tournament-bracket__code"><?php print $results["w-ws-m2-p2-tag"]; ?></abbr>
                                    <abbr style="display: none;" id="w-ws-m2-p2-country" class="erasable tournament-bracket__code"><?php print $results["w-ws-m2-p2-country"]; ?></abbr>
                                    <abbr style="display: none;" id="w-ws-m2-p2-country-code-value" class="erasable tournament-bracket__code"><?php print $results["w-ws-m2-p2-country-code"]; ?></abbr>
                                </td>
                                <td class="tournament-bracket__score">
                                    <span id="w-ws-m2-p2-score" class="erasable tournament-bracket__number"><?php print $results["w-ws-m2-p2-score"]; ?></span>
                                </td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                        
                        <div class="match-options">
                            <a class="match-swap btn btn-v-sm btn-primary btn-spacer" data-match="w-ws-m2" href="#"><i class="fas fa-exchange-alt"></i> Swap</a>
                            <a class="match-reset btn btn-v-sm btn-danger" data-match="w-ws-m2" href="#"><i class="fas fa-eraser"></i> Reset Match</a>
                        </div>
                    </li>

                </ul>
                </div>
            
                <div class="tournament-bracket__round tournament-bracket__round--semifinals">
                <h3 class="tournament-bracket__round-title">Winners Finals</h3>
                <ul class="tournament-bracket__list">
                
                <li class="tournament-bracket__item">
                <div class="tournament-bracket__match" tabindex="0">
                    <table data-toggle="modal" data-target="#editModal" data-title="Winners Finals" data-match="w-wf" class="match_box tournament-bracket__table">
                    <thead class="sr-only">
                        <tr>
                        <th>Player</th>
                        <th>Score</th>
                        </tr>
                    </thead>  
                    <tbody class="tournament-bracket__content">
                        <tr class="tournament-bracket__team">
                        <td class="tournament-bracket__country">
                            <span id="w-wf-p1-country-code" class="flag-erase tournament-bracket__flag flag-icon flag-icon-<?php print $results["w-wf-p1-country-code"]; ?>" aria-label="Flag"></span>
                            <abbr id="w-wf-p1-name" class="erasable tournament-bracket__code"><?php print $results["w-wf-p1-name"]; ?></abbr>

                            <abbr style="display: none;" id="w-wf-p1-tag" class="erasable tournament-bracket__code"><?php print $results["w-wf-p1-tag"]; ?></abbr>
                            <abbr style="display: none;" id="w-wf-p1-country" class="erasable tournament-bracket__code"><?php print $results["w-wf-p1-country"]; ?></abbr>
                            <abbr style="display: none;" id="w-wf-p1-country-code-value" class="erasable tournament-bracket__code"><?php print $results["w-wf-p1-country-code"]; ?></abbr>
                        </td>
                        <td class="tournament-bracket__score">
                            <span id="w-wf-p1-score" class="erasable tournament-bracket__number"><?php print $results["w-wf-p1-score"]; ?></span>
                        </td>
                        </tr>
                        <tr class="tournament-bracket__team">
                        <td class="tournament-bracket__country">
                            <abbr id="w-wf-p2-name" class="erasable tournament-bracket__code"><?php print $results["w-wf-p2-name"]; ?></abbr>
                            <span id="w-wf-p2-country-code" class="flag-erase tournament-bracket__flag flag-icon flag-icon-<?php print $results["w-wf-p2-country-code"]; ?>" aria-label="Flag"></span>

                            <abbr style="display: none;" id="w-wf-p2-tag" class="erasable tournament-bracket__code"><?php print $results["w-wf-p2-tag"]; ?></abbr>
                            <abbr style="display: none;" id="w-wf-p2-country" class="erasable tournament-bracket__code"><?php print $results["w-wf-p2-country"]; ?></abbr>
                            <abbr style="display: none;" id="w-wf-p2-country-code-value" class="erasable tournament-bracket__code"><?php print $results["w-wf-p2-country-code"]; ?></abbr>
                        </td>
                        <td class="tournament-bracket__score">
                            <span id="w-wf-p2-score" class="erasable tournament-bracket__number"><?php print $results["w-wf-p2-score"]; ?></span>
                        </td>
                        </tr>
                    </tbody>
                    </table>
                </div>

                <div class="match-options">
                    <a class="match-swap btn btn-v-sm btn-primary btn-spacer" data-match="w-wf" href="#"><i class="fas fa-exchange-alt"></i> Swap</a>
                    <a class="match-reset btn btn-v-sm btn-danger" data-match="w-wf" href="#"><i class="fas fa-eraser"></i> Reset Match</a>
                </div>                
                </li>

            </ul>
            </div>

            <!-- Get Grand Finals Winner -->
            <?php
                if ($results["w-gf-p1-score"] > $results["w-gf-p2-score"]) {
                    $win_class_1 = "gold";
                    $win_class_2 = "silver";
                } else {
                    $win_class_1 = "silver";
                    $win_class_2 = "gold";
                }
            ?>
            <!-- /winner -->

            <div class="tournament-bracket__round tournament-bracket__round--gold">
            <h3 class="tournament-bracket__round-title">Grand Finals</h3>
            <ul class="tournament-bracket__list">
                <li class="tournament-bracket__item">
                <div class="tournament-bracket__match" tabindex="0">
                    <table data-toggle="modal" data-target="#editModal" data-title="Grand Finals" data-match="w-gf" class="match_box tournament-bracket__table">
                    <thead class="sr-only">
                        <tr>
                        <th>Player</th>
                        <th>Score</th>
                        </tr>
                    </thead>  
                    <tbody class="tournament-bracket__content">
                        <tr class="tournament-bracket__team">
                        <td class="tournament-bracket__country">
                            <span id="w-gf-p1-country-code" class="flag-erase tournament-bracket__flag flag-icon flag-icon-<?php print $results["w-gf-p1-country-code"]; ?>" aria-label="Flag"></span>
                            <abbr id="w-gf-p1-name" class="erasable tournament-bracket__code"><?php print $results["w-gf-p1-name"]; ?></abbr>

                            <abbr style="display: none;" id="w-gf-p1-tag" class="erasable tournament-bracket__code"><?php print $results["w-gf-p1-tag"]; ?></abbr>
                            <abbr style="display: none;" id="w-gf-p1-country" class="erasable tournament-bracket__code"><?php print $results["w-gf-p1-country"]; ?></abbr>
                            <abbr style="display: none;" id="w-gf-p1-country-code-value" class="erasable tournament-bracket__code"><?php print $results["w-gf-p1-country-code"]; ?></abbr>
                        </td>
                        <td class="tournament-bracket__score">
                            <span id="w-gf-p1-score" class="erasable tournament-bracket__number"><?php print $results["w-gf-p1-score"]; ?></span>
                            <span id="w-gf-p1-trophy" class="tournament-bracket__medal tournament-bracket__medal--<?php print $win_class_1; ?> fa fa-trophy" aria-label="Gold medal"></span>
                        </td>
                        </tr>
                        <tr class="tournament-bracket__team">
                        <td class="tournament-bracket__country">
                            <abbr id="w-gf-p2-name" class="erasable tournament-bracket__code"><?php print $results["w-gf-p2-name"]; ?></abbr>
                            <span id="w-gf-p2-country-code" class="flag-erase tournament-bracket__flag flag-icon flag-icon-<?php print $results["w-gf-p2-country-code"]; ?>" aria-label="Flag"></span>

                            <abbr style="display: none;" id="w-gf-p2-tag" class="erasable tournament-bracket__code"><?php print $results["w-gf-p2-tag"]; ?></abbr>
                            <abbr style="display: none;" id="w-gf-p2-country" class="erasable tournament-bracket__code"><?php print $results["w-gf-p2-country"]; ?></abbr>
                            <abbr style="display: none;" id="w-gf-p2-country-code-value" class="erasable tournament-bracket__code"><?php print $results["w-gf-p2-country-code"]; ?></abbr>
                        </td>
                        <td class="tournament-bracket__score">
                            <span id="w-gf-p2-score" class="erasable tournament-bracket__number"><?php print $results["w-gf-p2-score"]; ?></span>
                            <span id="w-gf-p2-trophy" class="tournament-bracket__medal tournament-bracket__medal--<?php print $win_class_2; ?> fa fa-trophy" aria-label="Silver medal"></span>
                        </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  
                  <div class="match-options">
                    <a class="match-swap btn btn-v-sm btn-primary btn-spacer" data-match="w-gf" href="#"><i class="fas fa-exchange-alt"></i> Swap</a>
                    <a class="match-reset btn btn-v-sm btn-danger" data-match="w-gf" href="#"><i class="fas fa-eraser"></i> Reset Match</a>
                  </div>
                </li>
              </ul>
            </div>
           </div>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->


          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Top 8: Losers Side</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <div class="tournament-bracket tournament-bracket--rounded">                                                     
                <div class="tournament-bracket__round tournament-bracket__round--quarterfinals">
                <h3 class="tournament-bracket__round-title">Losers Round X</h3>
                <ul class="tournament-bracket__list">
                
                    <li class="tournament-bracket__item">
                        <div class="tournament-bracket__match" tabindex="0">
                            <table data-toggle="modal" data-target="#editModal" data-title="Losers Round X - Match 1" data-match="l-lx-m1" class="match_box tournament-bracket__table">
                            <thead class="sr-only">
                                <tr>
                                <th>Player</th>
                                <th>Score</th>
                                </tr>
                            </thead>  
                            <tbody class="tournament-bracket__content">
                                <tr class="tournament-bracket__team">
                                <td class="tournament-bracket__country">
                                    <span id="l-lx-m1-p1-country-code" class="flag-erase tournament-bracket__flag flag-icon flag-icon-<?php print $results["l-lx-m1-p1-country-code"]; ?>" aria-label="Flag"></span>
                                    <abbr id="l-lx-m1-p1-name" class="erasable tournament-bracket__code"><?php print $results["l-lx-m1-p1-name"]; ?></abbr>

                                    <abbr style="display: none;" id="l-lx-m1-p1-tag" class="erasable tournament-bracket__code"><?php print $results["l-lx-m1-p1-tag"]; ?></abbr>
                                    <abbr style="display: none;" id="l-lx-m1-p1-country" class="erasable tournament-bracket__code"><?php print $results["l-lx-m1-p1-country"]; ?></abbr>
                                    <abbr style="display: none;" id="l-lx-m1-p1-country-code-value" class="erasable tournament-bracket__code"><?php print $results["l-lx-m1-p1-country-code"]; ?></abbr>
                                </td>
                                <td class="tournament-bracket__score">
                                    <span id="l-lx-m1-p1-score" class="erasable tournament-bracket__number"><?php print $results["l-lx-m1-p1-score"]; ?></span>
                                </td>
                                </tr>
                                <tr class="tournament-bracket__team">
                                <td class="tournament-bracket__country">
                                    <abbr id="l-lx-m1-p2-name" class="erasable tournament-bracket__code"><?php print $results["l-lx-m1-p2-name"]; ?></abbr>
                                    <span id="l-lx-m1-p2-country-code" class="flag-erase tournament-bracket__flag flag-icon flag-icon-<?php print $results["l-lx-m1-p2-country-code"]; ?>" aria-label="Flag"></span>

                                    <abbr style="display: none;" id="l-lx-m1-p2-tag" class="erasable tournament-bracket__code"><?php print $results["l-lx-m1-p2-tag"]; ?></abbr>
                                    <abbr style="display: none;" id="l-lx-m1-p2-country" class="erasable tournament-bracket__code"><?php print $results["l-lx-m1-p2-country"]; ?></abbr>
                                    <abbr style="display: none;" id="l-lx-m1-p2-country-code-value" class="erasable tournament-bracket__code"><?php print $results["l-lx-m1-p2-country-code"]; ?></abbr>
                                </td>
                                <td class="tournament-bracket__score">
                                    <span id="l-lx-m1-p2-score" class="erasable tournament-bracket__number"><?php print $results["l-lx-m1-p2-score"]; ?></span>
                                </td>
                                </tr>
                            </tbody>
                            </table>
                        </div>

                        <div class="match-options">
                            <a class="match-swap btn btn-v-sm btn-primary btn-spacer" data-match="l-lx-m1" href="#"><i class="fas fa-exchange-alt"></i> Swap</a>
                            <a class="match-reset btn btn-v-sm btn-danger" data-match="l-lx-m1" href="#"><i class="fas fa-eraser"></i> Reset Match</a>
                        </div>
                    </li>

                    <li class="tournament-bracket__item">
                        <div class="tournament-bracket__match" tabindex="0">
                            <table data-toggle="modal" data-target="#editModal" data-title="Losers Round X - Match 2" data-match="l-lx-m2" class="match_box tournament-bracket__table">
                            <thead class="sr-only">
                                <tr>
                                <th>Player</th>
                                <th>Score</th>
                                </tr>
                            </thead>  
                            <tbody class="tournament-bracket__content">
                                <tr class="tournament-bracket__team">
                                <td class="tournament-bracket__country">
                                    <span id="l-lx-m2-p1-country-code" class="flag-erase tournament-bracket__flag flag-icon flag-icon-<?php print $results["l-lx-m2-p1-country-code"]; ?>" aria-label="Flag"></span>
                                    <abbr id="l-lx-m2-p1-name" class="erasable tournament-bracket__code"><?php print $results["l-lx-m2-p1-name"]; ?></abbr>

                                    <abbr style="display: none;" id="l-lx-m2-p1-tag" class="erasable tournament-bracket__code"><?php print $results["l-lx-m2-p1-tag"]; ?></abbr>
                                    <abbr style="display: none;" id="l-lx-m2-p1-country" class="erasable tournament-bracket__code"><?php print $results["l-lx-m2-p1-country"]; ?></abbr>
                                    <abbr style="display: none;" id="l-lx-m2-p1-country-code-value" class="erasable tournament-bracket__code"><?php print $results["l-lx-m2-p1-country-code"]; ?></abbr>
                                </td>
                                <td class="tournament-bracket__score">
                                    <span id="l-lx-m2-p1-score" class="erasable tournament-bracket__number"><?php print $results["l-lx-m2-p1-score"]; ?></span>
                                </td>
                                </tr>
                                <tr class="tournament-bracket__team">
                                <td class="tournament-bracket__country">
                                    <abbr id="l-lx-m2-p2-name" class="erasable tournament-bracket__code"><?php print $results["l-lx-m2-p2-name"]; ?></abbr>
                                    <span id="l-lx-m2-p2-country-code" class="flag-erase tournament-bracket__flag flag-icon flag-icon-<?php print $results["l-lx-m2-p2-country-code"]; ?>" aria-label="Flag"></span>

                                    <abbr style="display: none;" id="l-lx-m2-p2-tag" class="erasable tournament-bracket__code"><?php print $results["l-lx-m2-p2-tag"]; ?></abbr>
                                    <abbr style="display: none;" id="l-lx-m2-p2-country" class="erasable tournament-bracket__code"><?php print $results["l-lx-m2-p2-country"]; ?></abbr>
                                    <abbr style="display: none;" id="l-lx-m2-p2-country-code-value" class="erasable tournament-bracket__code"><?php print $results["l-lx-m2-p2-country-code"]; ?></abbr>
                                </td>
                                <td class="tournament-bracket__score">
                                    <span id="l-lx-m2-p2-score" class="erasable tournament-bracket__number"><?php print $results["l-lx-m2-p2-score"]; ?></span>
                                </td>
                                </tr>
                            </tbody>
                            </table>
                        </div>

                        <div class="match-options">
                            <a class="match-swap btn btn-v-sm btn-primary btn-spacer" data-match="l-lx-m2" href="#"><i class="fas fa-exchange-alt"></i> Swap</a>
                            <a class="match-reset btn btn-v-sm btn-danger" data-match="l-lx-m2" href="#"><i class="fas fa-eraser"></i> Reset Match</a>
                        </div>
                    </li>

                </ul>
                </div>

                <div class="tournament-bracket__round tournament-bracket__round--semifinals">
                <h3 class="tournament-bracket__round-title">Losers Quarters</h3>
                <ul class="tournament-bracket__list">

                <li class="tournament-bracket__item">
                <div class="tournament-bracket__match" tabindex="0">
                    <table data-toggle="modal" data-target="#editModal" data-title="Losers Quarters - Match 1" data-match="l-lq-m1" class="match_box tournament-bracket__table">
                    <thead class="sr-only">
                        <tr>
                        <th>Player</th>
                        <th>Score</th>
                        </tr>
                    </thead>  
                    <tbody class="tournament-bracket__content">
                        <tr class="tournament-bracket__team">
                        <td class="tournament-bracket__country">
                            <span id="l-lq-m1-p1-country-code" class="flag-erase tournament-bracket__flag flag-icon flag-icon-<?php print $results["l-lq-m1-p1-country-code"]; ?>" aria-label="Flag"></span>
                            <abbr id="l-lq-m1-p1-name" class="erasable tournament-bracket__code"><?php print $results["l-lq-m1-p1-name"]; ?></abbr>

                            <abbr style="display: none;" id="l-lq-m1-p1-tag" class="erasable tournament-bracket__code"><?php print $results["l-lq-m1-p1-tag"]; ?></abbr>
                            <abbr style="display: none;" id="l-lq-m1-p1-country" class="erasable tournament-bracket__code"><?php print $results["l-lq-m1-p1-country"]; ?></abbr>
                            <abbr style="display: none;" id="l-lq-m1-p1-country-code-value" class="erasable tournament-bracket__code"><?php print $results["l-lq-m1-p1-country-code"]; ?></abbr>
                        </td>
                        <td class="tournament-bracket__score">
                            <span id="l-lq-m1-p1-score" class="erasable tournament-bracket__number"><?php print $results["l-lq-m1-p1-score"]; ?></span>
                        </td>
                        </tr>
                        <tr class="tournament-bracket__team">
                        <td class="tournament-bracket__country">
                            <abbr id="l-lq-m1-p2-name" class="erasable tournament-bracket__code"><?php print $results["l-lq-m1-p2-name"]; ?></abbr>
                            <span id="l-lq-m1-p2-country-code" class="flag-erase tournament-bracket__flag flag-icon flag-icon-<?php print $results["l-lq-m1-p2-country-code"]; ?>" aria-label="Flag"></span>

                            <abbr style="display: none;" id="l-lq-m1-p2-tag" class="erasable tournament-bracket__code"><?php print $results["l-lq-m1-p2-tag"]; ?></abbr>
                            <abbr style="display: none;" id="l-lq-m1-p2-country" class="erasable tournament-bracket__code"><?php print $results["l-lq-m1-p2-country"]; ?></abbr>
                            <abbr style="display: none;" id="l-lq-m1-p2-country-code-value" class="erasable tournament-bracket__code"><?php print $results["l-lq-m1-p2-country-code"]; ?></abbr>
                        </td>
                        <td class="tournament-bracket__score">
                            <span id="l-lq-m1-p2-score" class="erasable tournament-bracket__number"><?php print $results["l-lq-m1-p2-score"]; ?></span>
                        </td>
                        </tr>
                    </tbody>
                    </table>
                </div>

                <div class="match-options">
                    <a class="match-swap btn btn-v-sm btn-primary btn-spacer" data-match="l-lq-m1" href="#"><i class="fas fa-exchange-alt"></i> Swap</a>
                    <a class="match-reset btn btn-v-sm btn-danger" data-match="l-lq-m1" href="#"><i class="fas fa-eraser"></i> Reset Match</a>
                </div>
                </li>

                <li class="tournament-bracket__item">
                <div class="tournament-bracket__match" tabindex="0">
                    <table data-toggle="modal" data-target="#editModal" data-title="Losers Quarters - Match 2" data-match="l-lq-m2" class="match_box tournament-bracket__table">
                    <thead class="sr-only">
                        <tr>
                        <th>Player</th>
                        <th>Score</th>
                        </tr>
                    </thead>  
                    <tbody class="tournament-bracket__content">
                        <tr class="tournament-bracket__team">
                        <td class="tournament-bracket__country">
                            <span id="l-lq-m2-p1-country-code" class="flag-erase tournament-bracket__flag flag-icon flag-icon-<?php print $results["l-lq-m2-p1-country-code"]; ?>" aria-label="Flag"></span>
                            <abbr id="l-lq-m2-p1-name" class="erasable tournament-bracket__code"><?php print $results["l-lq-m2-p1-name"]; ?></abbr>

                            <abbr style="display: none;" id="l-lq-m2-p1-tag" class="erasable tournament-bracket__code"><?php print $results["l-lq-m2-p1-tag"]; ?></abbr>
                            <abbr style="display: none;" id="l-lq-m2-p1-country" class="erasable tournament-bracket__code"><?php print $results["l-lq-m2-p1-country"]; ?></abbr>
                            <abbr style="display: none;" id="l-lq-m2-p1-country-code-value" class="erasable tournament-bracket__code"><?php print $results["l-lq-m2-p1-country-code"]; ?></abbr>
                        </td>
                        <td class="tournament-bracket__score">
                            <span id="l-lq-m2-p1-score" class="erasable tournament-bracket__number"><?php print $results["l-lq-m2-p1-score"]; ?></span>
                        </td>
                        </tr>
                        <tr class="tournament-bracket__team">
                        <td class="tournament-bracket__country">
                            <abbr id="l-lq-m2-p2-name" class="erasable tournament-bracket__code"><?php print $results["l-lq-m2-p2-name"]; ?></abbr>
                            <span id="l-lq-m2-p2-country-code" class="flag-erase tournament-bracket__flag flag-icon flag-icon-<?php print $results["l-lq-m2-p2-country-code"]; ?>" aria-label="Flag"></span>

                            <abbr style="display: none;" id="l-lq-m2-p2-tag" class="erasable tournament-bracket__code"><?php print $results["l-lq-m2-p2-tag"]; ?></abbr>
                            <abbr style="display: none;" id="l-lq-m2-p2-country" class="erasable tournament-bracket__code"><?php print $results["l-lq-m2-p2-country"]; ?></abbr>
                            <abbr style="display: none;" id="l-lq-m2-p2-country-code-value" class="erasable tournament-bracket__code"><?php print $results["l-lq-m2-p2-country-code"]; ?></abbr>
                        </td>
                        <td class="tournament-bracket__score">
                            <span id="l-lq-m2-p2-score" class="erasable tournament-bracket__number"><?php print $results["l-lq-m2-p2-score"]; ?></span>
                        </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                
                <div class="match-options">
                    <a class="match-swap btn btn-v-sm btn-primary btn-spacer" data-match="l-lq-m2" href="#"><i class="fas fa-exchange-alt"></i> Swap</a>
                    <a class="match-reset btn btn-v-sm btn-danger" data-match="l-lq-m2" href="#"><i class="fas fa-eraser"></i> Reset Match</a>
                </div>
                </li>

            </ul>
            </div>

                <div class="tournament-bracket__round tournament-bracket__round--semifinals">
                <h3 class="tournament-bracket__round-title">Losers Semis</h3>
                <ul class="tournament-bracket__list">
                
                <li class="tournament-bracket__item">
                <div class="tournament-bracket__match" tabindex="0">
                    <table data-toggle="modal" data-target="#editModal" data-title="Losers Semis" data-match="l-ls" class="match_box tournament-bracket__table">
                    <thead class="sr-only">
                        <tr>
                        <th>Player</th>
                        <th>Score</th>
                        </tr>
                    </thead>  
                    <tbody class="tournament-bracket__content">
                        <tr class="tournament-bracket__team">
                        <td class="tournament-bracket__country">
                            <span id="l-ls-p1-country-code" class="flag-erase tournament-bracket__flag flag-icon flag-icon-<?php print $results["l-ls-p1-country-code"]; ?>" aria-label="Flag"></span>
                            <abbr id="l-ls-p1-name" class="erasable tournament-bracket__code"><?php print $results["l-ls-p1-name"]; ?></abbr>

                            <abbr style="display: none;" id="l-ls-p1-tag" class="erasable tournament-bracket__code"><?php print $results["l-ls-p1-tag"]; ?></abbr>
                            <abbr style="display: none;" id="l-ls-p1-country" class="erasable tournament-bracket__code"><?php print $results["l-ls-p1-country"]; ?></abbr>
                            <abbr style="display: none;" id="l-ls-p1-country-code-value" class="erasable tournament-bracket__code"><?php print $results["l-ls-p1-country-code"]; ?></abbr>
                        </td>
                        <td class="tournament-bracket__score">
                            <span id="l-ls-p1-score" class="erasable tournament-bracket__number"><?php print $results["l-ls-p1-score"]; ?></span>
                        </td>
                        </tr>
                        <tr class="tournament-bracket__team">
                        <td class="tournament-bracket__country">
                            <abbr id="l-ls-p2-name" class="erasable tournament-bracket__code"><?php print $results["l-ls-p1-name"]; ?></abbr>
                            <span id="l-ls-p2-country-code" class="flag-erase tournament-bracket__flag flag-icon flag-icon-<?php print $results["l-ls-p1-country-code"]; ?>" aria-label="Flag"></span>

                            <abbr style="display: none;" id="l-ls-p2-tag" class="erasable tournament-bracket__code"><?php print $results["l-ls-p2-tag"]; ?></abbr>
                            <abbr style="display: none;" id="l-ls-p2-country" class="erasable tournament-bracket__code"><?php print $results["l-ls-p2-country"]; ?></abbr>
                            <abbr style="display: none;" id="l-ls-p2-country-code-value" class="erasable tournament-bracket__code"><?php print $results["l-ls-p2-country-code"]; ?></abbr>
                        </td>
                        <td class="tournament-bracket__score">
                            <span id="l-ls-p2-score" class="erasable tournament-bracket__number"><?php print $results["l-ls-p2-score"]; ?></span>
                        </td>
                        </tr>
                    </tbody>
                    </table>
                </div>

                <div class="match-options">
                    <a class="match-swap btn btn-v-sm btn-primary btn-spacer" data-match="l-ls" href="#"><i class="fas fa-exchange-alt"></i> Swap</a>
                    <a class="match-reset btn btn-v-sm btn-danger" data-match="l-ls" href="#"><i class="fas fa-eraser"></i> Reset Match</a>
                </div>
                </li>

            </ul>
            </div>

            <!-- Get Grand Finals Winner -->
            <?php
                if ($results["l-lf-p1-score"] > $results["l-lf-p2-score"]) {
                    $lose_class_1 = "gold";
                    $lose_class_2 = "silver";
                } else {
                    $lose_class_1 = "silver";
                    $lose_class_2 = "gold";
                }
            ?>
            <!-- /winner -->

            <div class="tournament-bracket__round tournament-bracket__round--gold">
            <h3 class="tournament-bracket__round-title">Losers Finals</h3>
            <ul class="tournament-bracket__list">
                <li class="tournament-bracket__item">
                <div class="tournament-bracket__match" tabindex="0">
                    <table data-toggle="modal" data-target="#editModal" data-title="Losers Finals" data-match="l-lf" class="match_box tournament-bracket__table">
                    <thead class="sr-only">
                        <tr>
                        <th>Player</th>
                        <th>Score</th>
                        </tr>
                    </thead>  
                    <tbody class="tournament-bracket__content">
                        <tr class="tournament-bracket__team">
                        <td class="tournament-bracket__country">
                            <span id="l-lf-p1-country-code" class="flag-erase tournament-bracket__flag flag-icon flag-icon-<?php print $results["l-lf-p1-country-code"]; ?>" aria-label="Flag"></span>
                            <abbr id="l-lf-p1-name" class="erasable tournament-bracket__code"><?php print $results["l-lf-p1-name"]; ?></abbr>

                            <abbr style="display: none;" id="l-lf-p1-tag" class="erasable tournament-bracket__code"><?php print $results["l-lf-p1-tag"]; ?></abbr>
                            <abbr style="display: none;" id="l-lf-p1-country" class="erasable tournament-bracket__code"><?php print $results["l-lf-p1-country"]; ?></abbr>
                            <abbr style="display: none;" id="l-lf-p1-country-code-value" class="erasable tournament-bracket__code"><?php print $results["l-lf-p1-country-code"]; ?></abbr>
                        </td>
                        <td class="tournament-bracket__score">
                            <span id="l-lf-p1-score" class="erasable tournament-bracket__number"><?php print $results["l-lf-p1-score"]; ?></span>
                            <span id="l-lf-p1-trophy" class="tournament-bracket__medal tournament-bracket__medal--<?php print $lose_class_1; ?> fa fa-trophy" aria-label="Gold medal"></span>
                        </td>
                        </tr>
                        <tr class="tournament-bracket__team">
                        <td class="tournament-bracket__country">
                            <abbr id="l-lf-p2-name" class="erasable tournament-bracket__code"><?php print $results["l-lf-p2-name"]; ?></abbr>
                            <span id="l-lf-p2-country-code" class="flag-erase tournament-bracket__flag flag-icon flag-icon-<?php print $results["l-lf-p2-country-code"]; ?>" aria-label="Flag"></span>

                            <abbr style="display: none;" id="l-lf-p2-tag" class="erasable tournament-bracket__code"><?php print $results["l-lf-p2-tag"]; ?></abbr>
                            <abbr style="display: none;" id="l-lf-p2-country" class="erasable tournament-bracket__code"><?php print $results["l-lf-p2-country"]; ?></abbr>
                            <abbr style="display: none;" id="l-lf-p2-country-code-value" class="erasable tournament-bracket__code"><?php print $results["l-lf-p2-country-code"]; ?></abbr>
                        </td>
                        <td class="tournament-bracket__score">
                            <span id="l-lf-p2-score" class="erasable tournament-bracket__number"><?php print $results["l-lf-p2-score"]; ?></span>
                            <span id="l-lf-p2-trophy" class="tournament-bracket__medal tournament-bracket__medal--<?php print $lose_class_2; ?> fa fa-trophy" aria-label="Silver medal"></span>
                        </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <div class="match-options">
                    <a class="match-swap btn btn-v-sm btn-primary btn-spacer" data-match="l-lf" href="#"><i class="fas fa-exchange-alt"></i> Swap</a>
                    <a class="match-reset btn btn-v-sm btn-danger" data-match="l-lf" href="#"><i class="fas fa-eraser"></i> Reset Match</a>
                  </div>
                </li>
              </ul>
            </div>
           </div>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <!-- second column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <!-- /.card-header -->
              
                <div class="card-footer">
                  <input type="hidden" id="submit" name="submit" value="submit">
                    <p style="float: left; margin-top:15px;">Reset All will clear all values!</p>
                    <button style="float: right; margin-top:9px;" id="purge-all" class="btn btn-danger">Reset All</button>
                  </div>
                </div>

            </div>
            <!-- /.card -->

          </div>

        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
 
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->

    <!-- Edit Player 2 Modal -->
    <div class="modal" id="editModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="modal-title" class="modal-title">Editing</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <!-- Form Start -->
        <form method="post" id="post_results" enctype="multipart/form-data" action="<?php print $gfw["site_url"]; ?>/index.php?p=tournament&a=funcs&v=top8_save">

          <div class="modal-body">

          <section class="content">

            <div class="container-fluid">

            <div class="row">
                <div class="col-md-6">

                    <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Player 1</h3>
                    </div>
                    <!-- /.card-header -->

                    <div class="modal-result card-body">

                        <div class="form-group">
                            <label for="player_1_tag">Player Tag</label>
                            <input type="text" class="form-control" id="player_1_tag" name="player_1_tag">
                        </div>

                        <div class="form-group">
                            <label for="player_1_name">Player Name</label>
                            <input type="text" class="form-control" id="player_1_name" name="player_1_name" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="player_1_country">Player Country</label>
                            <input type="text" class="form-control" id="player_1_country" name="player_1_country" autocomplete="off">
                            <input type="hidden" class="form-control" id="player_1_country_code" name="player_1_country_code">
                        </div>

                        <div class="form-group">
                            <label for="player_2_score">Player Score</label>
                            <input type="number" class="form-control" id="player_1_score" name="player_1_score" value="0">
                        </div>                        

                    </div>

                    </div>
                </div>
                
                <div class="col-md-6">

                    <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Player 2</h3>
                    </div>
                    <!-- /.card-header -->

                    <div class="modal-result card-body">

                        <div class="form-group">
                            <label for="player_2_tag">Player Tag</label>
                            <input type="text" class="form-control" id="player_2_tag" name="player_2_tag">
                        </div>

                        <div class="form-group">
                            <label for="player_2_name">Player Name</label>
                            <input type="text" class="form-control" id="player_2_name" name="player_2_name" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="player_2_country">Player Country</label>
                            <input type="text" class="form-control" id="player_2_country" name="player_2_country" autocomplete="off">
                            <input type="hidden" class="form-control" id="player_2_country_code" name="player_2_country_code">
                        </div>

                        <div class="form-group">
                            <label for="player_2_score">Player Score</label>
                            <input type="number" class="form-control" id="player_2_score" name="player_2_score" value="0">
                        </div>

                    </div>

                </div>
            </div>

            </div>

          </div>
          
          <div class="modal-footer">
            <input type="hidden" id="top8_block" name="top8_block">
            <button style="float: left;" type="button" id="clear_modal" class="btn btn-danger">Clear</button>
            <button type="submit" class="btn btn-primary">Save Results</button>
          </div>
        
          </form>
        </section>
      </div>
    </div>
  </div>

  <script src="<?php print $gfw['template_path']; ?>/plugins/jquery/jquery.min.js"></script>
  <script src="/pages/tournament/js/tournament_top8.js"></script>