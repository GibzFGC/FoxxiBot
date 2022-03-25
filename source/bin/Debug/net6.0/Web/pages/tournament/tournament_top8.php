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

$result = $PDO->query("SELECT * FROM gb_tournament_players");
?>

  <!-- Custom CSS -->
  <link rel="stylesheet" href="/pages/tournament/css/tournament_top8.css">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/2.3.1/css/flag-icon.min.css'>

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
                            <table class="tournament-bracket__table">
                            <thead class="sr-only">
                                <tr>
                                <th>Player</th>
                                <th>Score</th>
                                </tr>
                            </thead>  
                            <tbody class="tournament-bracket__content">
                                <tr class="tournament-bracket__team">
                                <td class="tournament-bracket__country">
                                    <span class="tournament-bracket__flag flag-icon flag-icon-gb" aria-label="Flag"></span>    
                                    <abbr class="tournament-bracket__code">Player 1</abbr>
                                </td>
                                <td class="tournament-bracket__score">
                                    <span class="tournament-bracket__number">0</span>
                                </td>
                                </tr>
                                <tr class="tournament-bracket__team">
                                <td class="tournament-bracket__country">
                                    <abbr class="tournament-bracket__code">Player 2</abbr>
                                    <span class="tournament-bracket__flag flag-icon flag-icon-de" aria-label="Flag"></span>
                                </td>
                                <td class="tournament-bracket__score">
                                    <span class="tournament-bracket__number">0</span>
                                </td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </li>

                    <li class="tournament-bracket__item">
                        <div class="tournament-bracket__match" tabindex="0">
                            <table class="tournament-bracket__table">
                            <thead class="sr-only">
                                <tr>
                                <th>Player</th>
                                <th>Score</th>
                                </tr>
                            </thead>  
                            <tbody class="tournament-bracket__content">
                                <tr class="tournament-bracket__team">
                                <td class="tournament-bracket__country">
                                <span class="tournament-bracket__flag flag-icon flag-icon-" aria-label="Flag"></span>
                                    <abbr class="tournament-bracket__code">Player 1</abbr>
                                </td>
                                <td class="tournament-bracket__score">
                                    <span class="tournament-bracket__number">0</span>
                                </td>
                                </tr>
                                <tr class="tournament-bracket__team">
                                <td class="tournament-bracket__country">
                                    <abbr class="tournament-bracket__code">Player 2</abbr>
                                    <span class="tournament-bracket__flag flag-icon flag-icon-" aria-label="Flag"></span>
                                </td>
                                <td class="tournament-bracket__score">
                                    <span class="tournament-bracket__number">0</span>
                                </td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </li>

                </ul>
                </div>
            
                <div class="tournament-bracket__round tournament-bracket__round--semifinals">
                <h3 class="tournament-bracket__round-title">Winners Finals</h3>
                <ul class="tournament-bracket__list">
                
                <li class="tournament-bracket__item">
                <div class="tournament-bracket__match" tabindex="0">
                    <table class="tournament-bracket__table">
                    <thead class="sr-only">
                        <tr>
                        <th>Player</th>
                        <th>Score</th>
                        </tr>
                    </thead>  
                    <tbody class="tournament-bracket__content">
                        <tr class="tournament-bracket__team">
                        <td class="tournament-bracket__country">
                            <span class="tournament-bracket__flag flag-icon flag-icon-" aria-label="Flag"></span>
                            <abbr class="tournament-bracket__code">Player 1</abbr>
                        </td>
                        <td class="tournament-bracket__score">
                            <span class="tournament-bracket__number">0</span>
                        </td>
                        </tr>
                        <tr class="tournament-bracket__team">
                        <td class="tournament-bracket__country">
                            <abbr class="tournament-bracket__code">Player 2</abbr>
                            <span class="tournament-bracket__flag flag-icon flag-icon-" aria-label="Flag"></span>
                        </td>
                        <td class="tournament-bracket__score">
                            <span class="tournament-bracket__number">0</span>
                        </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                </li>

            </ul>
            </div>

            <div class="tournament-bracket__round tournament-bracket__round--gold">
            <h3 class="tournament-bracket__round-title">Grand Finals</h3>
            <ul class="tournament-bracket__list">
                <li class="tournament-bracket__item">
                <div class="tournament-bracket__match" tabindex="0">
                    <table class="tournament-bracket__table">
                    <thead class="sr-only">
                        <tr>
                        <th>Player</th>
                        <th>Score</th>
                        </tr>
                    </thead>  
                    <tbody class="tournament-bracket__content">
                        <tr class="tournament-bracket__team">
                        <td class="tournament-bracket__country">
                            <span class="tournament-bracket__flag flag-icon flag-icon-" aria-label="Flag"></span>
                            <abbr class="tournament-bracket__code">Player 1</abbr>
                        </td>
                        <td class="tournament-bracket__score">
                            <span class="tournament-bracket__number">0</span>
                            <span class="tournament-bracket__medal tournament-bracket__medal--gold fa fa-trophy" aria-label="Gold medal"></span>
                        </td>
                        </tr>
                        <tr class="tournament-bracket__team">
                        <td class="tournament-bracket__country">
                            <abbr class="tournament-bracket__code">Player 2</abbr>
                            <span class="tournament-bracket__flag flag-icon flag-icon-" aria-label="Flag"></span>
                        </td>
                        <td class="tournament-bracket__score">
                            <span class="tournament-bracket__number">0</span>
                            <span class="tournament-bracket__medal tournament-bracket__medal--silver fa fa-trophy" aria-label="Silver medal"></span>
                        </td>
                        </tr>
                      </tbody>
                    </table>
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
                            <table class="tournament-bracket__table">
                            <thead class="sr-only">
                                <tr>
                                <th>Player</th>
                                <th>Score</th>
                                </tr>
                            </thead>  
                            <tbody class="tournament-bracket__content">
                                <tr class="tournament-bracket__team">
                                <td class="tournament-bracket__country">
                                    <span class="tournament-bracket__flag flag-icon flag-icon-" aria-label="Flag"></span>
                                    <abbr class="tournament-bracket__code">Player 1</abbr>
                                </td>
                                <td class="tournament-bracket__score">
                                    <span class="tournament-bracket__number">0</span>
                                </td>
                                </tr>
                                <tr class="tournament-bracket__team">
                                <td class="tournament-bracket__country">
                                    <abbr class="tournament-bracket__code">Player 2</abbr>
                                    <span class="tournament-bracket__flag flag-icon flag-icon-" aria-label="Flag"></span>
                                </td>
                                <td class="tournament-bracket__score">
                                    <span class="tournament-bracket__number">0</span>
                                </td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </li>

                    <li class="tournament-bracket__item">
                        <div class="tournament-bracket__match" tabindex="0">
                            <table class="tournament-bracket__table">
                            <thead class="sr-only">
                                <tr>
                                <th>Player</th>
                                <th>Score</th>
                                </tr>
                            </thead>  
                            <tbody class="tournament-bracket__content">
                                <tr class="tournament-bracket__team">
                                <td class="tournament-bracket__country">
                                    <span class="tournament-bracket__flag flag-icon flag-icon-" aria-label="Flag"></span>
                                    <abbr class="tournament-bracket__code">Player 1</abbr>
                                </td>
                                <td class="tournament-bracket__score">
                                    <span class="tournament-bracket__number">0</span>
                                </td>
                                </tr>
                                <tr class="tournament-bracket__team">
                                <td class="tournament-bracket__country">
                                    <abbr class="tournament-bracket__code">Player 2</abbr>
                                    <span class="tournament-bracket__flag flag-icon flag-icon-" aria-label="Flag"></span>
                                </td>
                                <td class="tournament-bracket__score">
                                    <span class="tournament-bracket__number">0</span>
                                </td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </li>

                </ul>
                </div>

                <div class="tournament-bracket__round tournament-bracket__round--semifinals">
                <h3 class="tournament-bracket__round-title">Losers Quarters</h3>
                <ul class="tournament-bracket__list">

                <li class="tournament-bracket__item">
                <div class="tournament-bracket__match" tabindex="0">
                    <table class="tournament-bracket__table">
                    <thead class="sr-only">
                        <tr>
                        <th>Player</th>
                        <th>Score</th>
                        </tr>
                    </thead>  
                    <tbody class="tournament-bracket__content">
                        <tr class="tournament-bracket__team">
                        <td class="tournament-bracket__country">
                            <span class="tournament-bracket__flag flag-icon flag-icon-" aria-label="Flag"></span>
                            <abbr class="tournament-bracket__code">Player 1</abbr>
                        </td>
                        <td class="tournament-bracket__score">
                            <span class="tournament-bracket__number">0</span>
                        </td>
                        </tr>
                        <tr class="tournament-bracket__team">
                        <td class="tournament-bracket__country">
                            <abbr class="tournament-bracket__code">Player 2</abbr>
                            <span class="tournament-bracket__flag flag-icon flag-icon-" aria-label="Flag"></span>
                        </td>
                        <td class="tournament-bracket__score">
                            <span class="tournament-bracket__number">0</span>
                        </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                </li>

                <li class="tournament-bracket__item">
                <div class="tournament-bracket__match" tabindex="0">
                    <table class="tournament-bracket__table">
                    <thead class="sr-only">
                        <tr>
                        <th>Player</th>
                        <th>Score</th>
                        </tr>
                    </thead>  
                    <tbody class="tournament-bracket__content">
                        <tr class="tournament-bracket__team">
                        <td class="tournament-bracket__country">
                            <span class="tournament-bracket__flag flag-icon flag-icon-" aria-label="Flag"></span>
                            <abbr class="tournament-bracket__code">Player 1</abbr>
                        </td>
                        <td class="tournament-bracket__score">
                            <span class="tournament-bracket__number">0</span>
                        </td>
                        </tr>
                        <tr class="tournament-bracket__team">
                        <td class="tournament-bracket__country">
                            <abbr class="tournament-bracket__code">Player 2</abbr>
                            <span class="tournament-bracket__flag flag-icon flag-icon-" aria-label="Flag"></span>
                        </td>
                        <td class="tournament-bracket__score">
                            <span class="tournament-bracket__number">0</span>
                        </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                </li>

            </ul>
            </div>

                <div class="tournament-bracket__round tournament-bracket__round--semifinals">
                <h3 class="tournament-bracket__round-title">Losers Semis</h3>
                <ul class="tournament-bracket__list">
                
                <li class="tournament-bracket__item">
                <div class="tournament-bracket__match" tabindex="0">
                    <table class="tournament-bracket__table">
                    <thead class="sr-only">
                        <tr>
                        <th>Player</th>
                        <th>Score</th>
                        </tr>
                    </thead>  
                    <tbody class="tournament-bracket__content">
                        <tr class="tournament-bracket__team">
                        <td class="tournament-bracket__country">
                            <span class="tournament-bracket__flag flag-icon flag-icon-" aria-label="Flag"></span>
                            <abbr class="tournament-bracket__code">Player 1</abbr>
                        </td>
                        <td class="tournament-bracket__score">
                            <span class="tournament-bracket__number">0</span>
                        </td>
                        </tr>
                        <tr class="tournament-bracket__team">
                        <td class="tournament-bracket__country">
                            <abbr class="tournament-bracket__code">Player 2</abbr>
                            <span class="tournament-bracket__flag flag-icon flag-icon-" aria-label="Flag"></span>
                        </td>
                        <td class="tournament-bracket__score">
                            <span class="tournament-bracket__number">0</span>
                        </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                </li>

            </ul>
            </div>

            <div class="tournament-bracket__round tournament-bracket__round--gold">
            <h3 class="tournament-bracket__round-title">Losers Finals</h3>
            <ul class="tournament-bracket__list">
                <li class="tournament-bracket__item">
                <div class="tournament-bracket__match" tabindex="0">
                    <table class="tournament-bracket__table">
                    <thead class="sr-only">
                        <tr>
                        <th>Player</th>
                        <th>Score</th>
                        </tr>
                    </thead>  
                    <tbody class="tournament-bracket__content">
                        <tr class="tournament-bracket__team">
                        <td class="tournament-bracket__country">
                            <span class="tournament-bracket__flag flag-icon flag-icon-" aria-label="Flag"></span>
                            <abbr class="tournament-bracket__code">Player 1</abbr>
                        </td>
                        <td class="tournament-bracket__score">
                            <span class="tournament-bracket__number">0</span>
                            <span class="tournament-bracket__medal tournament-bracket__medal--gold fa fa-trophy" aria-label="Gold medal"></span>
                        </td>
                        </tr>
                        <tr class="tournament-bracket__team">
                        <td class="tournament-bracket__country">
                            <abbr class="tournament-bracket__code">Player 2</abbr>
                            <span class="tournament-bracket__flag flag-icon flag-icon-" aria-label="Flag"></span>
                        </td>
                        <td class="tournament-bracket__score">
                            <span class="tournament-bracket__number">0</span>
                            <span class="tournament-bracket__medal tournament-bracket__medal--silver fa fa-trophy" aria-label="Silver medal"></span>
                        </td>
                        </tr>
                      </tbody>
                    </table>
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

        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
 
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->