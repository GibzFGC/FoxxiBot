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

$result = $PDO->query("SELECT * FROM gb_tournament_scoreboard");
foreach($result as $row)
{
  $options[$row["parameter"]] = $row["value"];
}
?>
  <!-- Custom CSS -->
  <link rel="stylesheet" href="/pages/tournament/css/tournament_scoreboard.css">

  <!-- Form Start -->
  <form method="post" id="save_scoreboard" enctype="multipart/form-data" action="<?php print $gfw["site_url"]; ?>/index.php?p=tournament&a=funcs&v=scoreboard_save">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Scoreboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Tournament</li>
              <li class="breadcrumb-item active">Scoreboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">

          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card">
              <div class="card-header">
                <h3 class="card-title">Player 1 Settings</h3>

                <button style="float:right;" type="button" class="btn btn-info btn-v-sm" data-toggle="modal" data-target="#editModal1" id="tournament-edit-player"> Add a Player</button>
                <button style="float:right;" type="button" class="btn btn-success btn-v-sm btn-spacer" data-toggle="modal" data-target="#addModal" id="tournament-add-player"> Edit a Player</button>
              </div>
              <!-- /.card-header -->
                <div class="card-body">

                  <div class="form-group">
                    <label for="p1_tag">Group Tag / Organisation</label>
                    <input type="text" class="form-control" id="p1_tag" name="p1_tag" placeholder="Group Tag / Organisation" value="<?php print $options["p1Tag"]; ?>">
                  </div>

                  <div class="form-group">
                    <label for="p1_name">Player Name</label>
                    <input type="text" class="form-control" id="p1_name" name="p1_name" placeholder="Enter the Players Name" autocomplete="off" value="<?php print $options["p1Name"]; ?>">
                  </div>

                  <div class="form-group">
                    <label for="p1_country">Player Country</label>
                    <input type="text" class="form-control" id="p1_country" name="p1_country" autocomplete="off" placeholder="Select a Country" value="<?php print $options["p1Country"]; ?>">
                    <input type="hidden" class="form-control" id="p1_country_code" name="p1_country_code" placeholder="Player Country" title="Player Country" autocomplete="off" value="<?php print $options["p1CountryCode"]; ?>">
                  </div>

                  <div class="form-group">
                    <label for="p1_status">Player Status</label>
                    <input type="text" class="form-control" id="p1_status" name="p1_status" placeholder="Set the Status [ex. W]" value="<?php print $options["p1Status"]; ?>">
                  </div>

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" class="btn btn-info btn-sm btn-spacer pull-left" id="player-1-swap"> Swap</button>
                <button type="button" class="btn btn-danger btn-sm btn-spacer pull-left" id="player-1-clear"> Clear</button>
                <button type="button" class="btn btn-warning btn-sm btn-spacer pull-left" id="player-all-clear1"> Clear Both</button>

                <button style="float: right;" type="submit" class="btn btn-sm btn-primary">Submit</button>

                <div style="float:right;" class="form-group btn-v-sm">
                    <select style="font-size: 12px; width: 200px; height: 30px; margin-right: 10px;" class="form-control" id="tournament-move-p1" name="tournament-move-p1">
                        <option value="Set Top 8 Placement">Set Top 8 Placement</option>
                        <option value=""></option>
                        <option value="w-ws-m1-p1">Winners Semis - Slot 1 </option>
                        <option value="w-ws-m1-p2">Winners Semis - Slot 2 </option>
                        <option value=""></option>
                        <option value="w-ws-m2-p1">Winners Semis - Slot 3 </option>
                        <option value="w-ws-m2-p2">Winners Semis - Slot 4 </option>
                        <option value=""></option>
                        <option value="l-lx-m1-p1">Losers Eighths - Slot 1 </option>
                        <option value="l-lx-m1-p2">Losers Eighths - Slot 2 </option>
                        <option value=""></option>
                        <option value="l-lx-m2-p1">Losers Eighths - Slot 3 </option>
                        <option value="l-lx-m2-p2">Losers Eighths - Slot 4 </option>
                    </select>
                </div>  
              </div>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->

          <!-- right column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card">
              <div class="card-header">
                <h3 class="card-title">Player 2 Settings</h3>

                <button style="float:right;" type="button" class="btn btn-info btn-v-sm" data-toggle="modal" data-target="#editModal2" id="tournament-edit-player"> Edit a Player</button>
                <button style="float:right;" type="button" class="btn btn-success btn-v-sm btn-spacer" data-toggle="modal" data-target="#addModal" id="tournament-add-player"> Add a Player</button>
              </div>
              <!-- /.card-header -->
                <div class="card-body">

                  <div class="form-group">
                    <label for="p2_tag">Group Tag / Organisation</label>
                    <input type="text" class="form-control" id="p2_tag" name="p2_tag" placeholder="Enter the Players Tag / Organisation" value="<?php print $options["p2Tag"]; ?>">
                  </div>

                  <div class="form-group">
                    <label for="p2_name">Player Name</label>
                    <input type="text" class="form-control" id="p2_name" name="p2_name" placeholder="Enter the Players Name" autocomplete="off" value="<?php print $options["p2Name"]; ?>">
                  </div>

                  <div class="form-group">
                    <label for="p2_country">Player Country</label>
                    <input type="text" class="form-control" id="p2_country" name="p2_country" autocomplete="off" placeholder="Select a Country" value="<?php print $options["p2Country"]; ?>">
                    <input type="hidden" class="form-control" id="p2_country_code" name="p2_country_code" placeholder="Player Country" title="Player Country" autocomplete="off" value="<?php print $options["p2CountryCode"]; ?>">
                  </div>

                  <div class="form-group">
                    <label for="p2_status">Player Status</label>
                    <input type="text" class="form-control" id="p2_status" name="p2_status" placeholder="Set the Status [ex. W]" value="<?php print $options["p2Status"]; ?>">
                  </div>

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" class="btn btn-info btn-sm btn-spacer pull-left" id="player-2-swap"> Swap</button>
                <button type="button" class="btn btn-danger btn-sm btn-spacer pull-left" id="player-2-clear"> Clear</button>
                <button type="button" class="btn btn-warning btn-sm btn-spacer pull-left" id="player-all-clear1"> Clear Both</button>

                <button style="float: right;" type="submit" class="btn btn-sm btn-primary">Submit</button>

                <div style="float:right;" class="form-group btn-v-sm btn-spacer">
                    <select style="font-size: 12px; width: 200px; height: 30px; margin-right: 10px;" class="form-control" id="tournament-move-p2" name="tournament-move-p2">
                        <option value="Set Top 8 Placement">Set Top 8 Placement</option>
                        <option value=""></option>
                        <option value="w-ws-m1-p1">Winners Semis - Slot 1 </option>
                        <option value="w-ws-m1-p2">Winners Semis - Slot 2 </option>
                        <option value=""></option>
                        <option value="w-ws-m2-p1">Winners Semis - Slot 3 </option>
                        <option value="w-ws-m2-p2">Winners Semis - Slot 4 </option>
                        <option value=""></option>
                        <option value="l-lx-m1-p1">Losers Eighths - Slot 1 </option>
                        <option value="l-lx-m1-p2">Losers Eighths - Slot 2 </option>
                        <option value=""></option>
                        <option value="l-lx-m2-p1">Losers Eighths - Slot 3 </option>
                        <option value="l-lx-m2-p2">Losers Eighths - Slot 4 </option>
                    </select>
                </div>  
              </div>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (right) -->  

          <!-- player score column -->
          <div class="col-md-3">
            <!-- general form elements -->
            <div class="card card">
              <div class="card-header">
                <h3 class="card-title">Current Scores</h3>
                <button style="float:right;" type="button" class="btn btn-danger btn-v-sm btn-spacer" id="tournament-score-clear"> Reset</button>
              </div>
              <!-- /.card-header -->
                <div class="card-body">

                  <div class="form-group">
                    <label for="p1_score">Player 1</label>
                    <input type="number" class="form-control" id="p1_score" name="p1_score" value="<?php print $options["p1Score"]; ?>">
                  </div>

                  <div class="form-group">
                    <label for="p2_score">Player 2</label>
                    <input type="number" class="form-control" id="p2_score" name="p2_score" value="<?php print $options["p2Score"]; ?>">
                  </div>

              </div>
              <!-- /.card-body -->

            </div>
            <!-- /.card -->

          </div>
          <!--/.col (player positions - teams) -->  
          
          <!-- player score column -->
          <div class="col-md-3">
            <!-- general form elements -->
            <div class="card card">
              <div class="card-header">
                <h3 class="card-title">Player Positions (Teams)</h3>
                <button style="float:right;" type="button" class="btn btn-danger btn-v-sm btn-spacer" id="tournament-position-clear"> Reset</button>
              </div>
              <!-- /.card-header -->
                <div class="card-body">

                  <div class="form-group">
                    <label for="p1_position">Player 1</label>
                    <input type="number" class="form-control" id="p1_position" name="p1_position" value="0" value="<?php print $options["p1TeamPosition"]; ?>">
                  </div>

                  <div class="form-group">
                    <label for="p2_position">Player 2</label>
                    <input type="number" class="form-control" id="p2_position" name="p2_position" value="0" value="<?php print $options["p2TeamPosition"]; ?>">
                  </div>

              </div>
              <!-- /.card-body -->

            </div>
            <!-- /.card -->

          </div>
          <!--/.col (player positions - teams) -->  
          
          <!-- player score column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card">
              <div class="card-header">
                <h3 class="card-title">Tournament Status</h3>
                <button style="float:right;" type="button" class="btn btn-danger btn-v-sm" id="tournament-status-clear"> Set Status to BO3</button>
                <button style="float:right; margin-right: 10px;" type="button" class="btn btn-danger btn-v-sm" id="tournament-round-clear"> Set Round to Pools</button>
              </div>
              <!-- /.card-header -->
                <div class="card-body">

                  <div class="form-group">
                    <label for="tournament-round">Tournament Round</label>
                    <select class="form-control" id="tournament-round" name="tournament-round">
                        <option value="Pools">Pools</option>
                        <option value="Top 8">Top 8</option>
                        <option value=""></option>
                        <option value="Losers Quarters">Losers Quarters</option>
                        <option value="Losers Semis">Losers Semis</option>
                        <option value=""></option>
                        <option value="Winners Finals">Winners Finals</option>
                        <option value="Losers Finals">Losers Finals</option>
                        <option value=""></option>
                        <option value="Grand Finals">Grand Finals</option>
                        <option value="Bracket Reset">Bracket Reset</option>
                        <option value=""></option>
                        <option value="Winners">Winners</option>
                        <option value="Losers">Losers</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="tournament-round-extra">Tournament Round Status</label>
                    <input type="text" class="form-control" id="tournament-round-extra" name="tournament-round-extra" placeholder="ex. Best of 3" data-toggle="tooltip" value="<?php print $options["tournamentRoundStatus"]; ?>">
                  </div>

              </div>
              <!-- /.card-body -->

            </div>
            <!-- /.card -->

          </div>
          <!--/.col (player positions - teams) -->  

        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
    
    </form>
    <!-- Form End -->

    <!-- Scoreboard Live -->
    <section id="live-preview" class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">

              <!-- full column -->
              <div class="col-md-12">

                <div class="card card">
                  <div class="card-header">
                    <h3 class="card-title">Live Preview <small>(Max preview is 1280x100)</small></h3>

                    <div style="width: 300px;" class="card-tools">
                        <select id="live_preview" class="form-control select2bs4" style="width: 100%;">
                            <option selected="selected">Select a Scoreboard</option>

                            <?php
                              $dir = new DirectoryIterator('obs/tournament/');

                              foreach ($dir as $fileinfo) {
                                if ($fileinfo->isDir() && !$fileinfo->isDot()) {
                                    print "<option value=" . $fileinfo->getFilename() . ">" . $fileinfo->getFilename() . "</option>";
                                }
                              }
                            ?>

                        </select>
                    </div>

                  </div>

                  <div class="card-body">

                      <div style="background-color:#343a40" align="center">
                        <iframe class="iframe" id="final-preview" width="1200" height="100" frameborder="0" scrolling="yes"></iframe>
                      </div> 

                  </div>

                </div>

              </div>

            </div>
        </div>
    </section>

  <!-- Add Player Modal -->
  <div class="modal" id="addModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add a Player</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <!-- Form Start -->
        <form method="post" id="save_player" enctype="multipart/form-data" action="<?php print $gfw["site_url"]; ?>/index.php?p=tournament&a=funcs&v=save_player">

          <div class="modal-body">

            <div class="form-group">
              <label for="p2_tag">Group Tag / Organisation</label>
              <input type="text" class="form-control" id="modal_player_tag" name="modal_player_tag" placeholder="Enter the Players Tag / Organisation">
            </div>

            <div class="form-group">
              <label for="p2_name">Player Name</label>
              <input type="text" class="form-control" id="modal_player_name" name="modal_player_name" placeholder="Enter the Players Name" autocomplete="off" required>
            </div>

            <div class="form-group">
              <label for="p2_country">Player Country</label>
              <input type="text" class="form-control" id="modal_player_country" name="modal_player_country" autocomplete="off" placeholder="Select a Country" required>
              <input type="hidden" class="form-control" id="modal_player_country_code" name="modal_player_country_code" placeholder="Player Country" title="Player Country" autocomplete="off">
            </div>

          </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Player Data</button>
        </div>

        </form>
      </div>
    </div>
  </div>

    <!-- Edit Player 1 Modal -->
    <div class="modal" id="editModal1" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editing Player 1</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <!-- Form Start -->
        <form method="post" id="edit_player1" enctype="multipart/form-data" action="<?php print $gfw["site_url"]; ?>/index.php?p=tournament&a=funcs&v=edit_player1">

          <div class="modal-body">

            <div class="form-group">
              <label for="modal_edit_player1_tag">Group Tag / Organisation</label>
              <input type="text" class="form-control" id="modal_edit_player1_tag" name="modal_edit_player1_tag" placeholder="Enter the Players Tag / Organisation" value="<?php print $options["p1Tag"]; ?>">
            </div>

            <div class="form-group">
              <label for="modal_edit_player1_name">Player Name <small>(Read Only)</small></label>
              <input type="text" class="form-control" id="modal_edit_player1_name" name="modal_edit_player1_name" placeholder="Enter the Players Name" autocomplete="off" readonly value="<?php print $options["p1Name"]; ?>">
            </div>

            <div class="form-group">
              <label for="modal_edit_player1_country">Player Country</label>
              <input type="text" class="form-control" id="modal_edit_player1_country" name="modal_edit_player1_country" autocomplete="off" placeholder="Select a Country" required value="<?php print $options["p1Country"]; ?>">
              <input type="hidden" class="form-control" id="modal_edit_player1_country_code" name="modal_edit_player1_country_code" placeholder="Player Country" title="Player Country" autocomplete="off" value="<?php print $options["p1CountryCode"]; ?>">
            </div>

          </div>
        
        <div class="modal-footer">
          <button type="button" id="edit_modal1_close" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Player Data</button>
        </div>

        </form>
      </div>
    </div>
  </div>

    <!-- Edit Player 2 Modal -->
    <div class="modal" id="editModal2" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editing Player 2</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <!-- Form Start -->
        <form method="post" id="edit_player2" enctype="multipart/form-data" action="<?php print $gfw["site_url"]; ?>/index.php?p=tournament&a=funcs&v=edit_player2">

          <div class="modal-body">

            <div class="form-group">
              <label for="modal_edit_player2_tag">Group Tag / Organisation</label>
              <input type="text" class="form-control" id="modal_edit_player2_tag" name="modal_edit_player2_tag" placeholder="Enter the Players Tag / Organisation" value="<?php print $options["p2Tag"]; ?>">
            </div>

            <div class="form-group">
              <label for="modal_edit_player2_name">Player Name <small>(Read Only)</small></label>
              <input type="text" class="form-control" id="modal_edit_player2_name" name="modal_edit_player2_name" placeholder="Enter the Players Name" autocomplete="off" readonly value="<?php print $options["p2Name"]; ?>">
            </div>

            <div class="form-group">
              <label for="modal_edit_player2_country">Player Country</label>
              <input type="text" class="form-control" id="modal_edit_player2_country" name="modal_edit_player2_country" autocomplete="off" placeholder="Select a Country" required value="<?php print $options["p2Country"]; ?>">
              <input type="hidden" class="form-control" id="modal_edit_player2_country_code" name="modal_edit_player2_country_code" placeholder="Player Country" title="Player Country" autocomplete="off" value="<?php print $options["p2CountryCode"]; ?>">
            </div>

          </div>
        
        <div class="modal-footer">
          <button type="button" id="edit_modal2_close" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Player Data</button>
        </div>

        </form>
      </div>
    </div>
  </div>

  <script src="<?php print $gfw['template_path']; ?>/plugins/jquery/jquery.min.js"></script>
  <script src="/pages/tournament/js/tournament_scoreboard.js"></script>