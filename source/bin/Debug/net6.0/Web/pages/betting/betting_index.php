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

$result = $PDO->query("SELECT * FROM gb_betting_options");
foreach($result as $row)
{
  $options[$row["parameter"]] = $row["value"];
}
?>

  <form method="post" enctype="multipart/form-data" action="<?php print $gfw["site_url"]; ?>/index.php?p=betting&a=funcs&v=save">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Betting Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?= _HOME ?></a></li>
              <li class="breadcrumb-item active">Betting Management</li>
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
                <h3 class="card-title">Here are your Bet Settings &amp; Winners List</h3>

                <div class="card-tools">
                  <h3 style="margin-top: 4px;" class="card-title">Status:&nbsp;&nbsp;</h3>
                  <?php
                  if (!isset($options["betting_active"]) || $options["betting_active"] == "off") {
                    print '<input type="checkbox" name="betting_active" data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                  } else {
                    print '<input type="checkbox" name="betting_active" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                  }
                ?>
                </div>                
              </div>
              <!-- /.card-header -->
            
              <div class="card-body">

              <div class="row">
                  
                  <div class="col-md-4">
                    <div class="card">
                      <div class="card-header">
                        <h3 style="margin-top: 3px;" class="card-title">Bet Setup</h3>
                      </div>
                    
                      <div class="card-body">

                        <div class="form-group">
                          <label for="bettingDetails">Bet Details</label>
                          <textarea class="form-control" rows="3"  id="bettingDetails" name="bettingDetails" placeholder="Put your Bet description in here..." required><?php if (isset($options["bet_info"])) { print $options["bet_info"]; } ?></textarea>
                        </div>

                        <div class="form-group">
                          <label for="bettingOption1">Bet Option #1</label>
                          <input type="text" class="form-control" id="bettingOption1" name="bettingOption1" placeholder="" value="<?php print $options["bet_option_1"]; ?>" required>
                        </div>

                        <div class="form-group">
                          <label for="bettingOption2">Bet Option #2</label>
                          <input type="text" class="form-control" id="bettingOption2" name="bettingOption2" placeholder="" value="<?php print $options["bet_option_2"]; ?>" required>
                        </div>

                        <div class="form-group">
                          <label for="bettingPercentage">Bet Winnings Percentage</label>
                          <input type="number" class="form-control" id="bettingPercentage" name="bettingPercentage" value="<?php print $options["bet_win_percentage"]; ?>" required>

                        </div>
                      </div>
                      <!-- /.card-body -->

                      <div class="card-footer">
                        <input type="hidden" id="submit" name="submit" value="submit">
                        <a onclick="return confirm('Are you sure you wish to delete all Betting data?');" href="<?php print $gfw["site_url"]; ?>/index.php?p=betting&a=funcs&v=clear" class="btn btn-danger"><?= _CLEAR_DATA ?></a>
                        <button style="float: right;" type="submit" class="btn btn-primary"><?= _SAVE_DATA ?></button>
                      </div>

                    </div>
                    <!-- /.card -->
                  </div>

                  <div class="col-md-8">
                    <div class="card">
                      <div class="card-header">
                        <h3 style="margin-top: 3px;" class="card-title">Betting Results</h3>

                        <div class="card-tools">
                          <?php
                          $gw_statement = "SELECT COUNT(*) FROM gb_betting WHERE bet_option = '" . $options["bet_winner"]  . "'"; 
                          $gw_result = $PDO->prepare($gw_statement); 
                          $gw_result->execute(); 
                          $number_of_rows = $gw_result->fetchColumn(); 
                          ?>
                          <h3 style="margin-top: 3px;" class="card-title"><?php echo $number_of_rows; ?> Winning Participants</h3>
                        </div>
                      </div>
                    
                      <div class="card-body">

                      <ul class="nav flex-column">

                      <?php
                        $n_result = $PDO->query("SELECT * FROM gb_betting WHERE bet_option = '" . $options["bet_winner"]  . "'");
                        foreach($n_result as $n_row)
                        {
                        
                        if (!empty($options["bet_winner"])) {
                            print $n_row["username"] . " voted for '" . $options["bet_winner"] . "' and used  " . $n_row["bet_points"] . " points<br />";

                        } else {
                            print '
                            <li class="nav-item">
                            <span class="nav-link">System:
                              <span class="float-right">No Winners Yet</span>
                            </span>
                          </li>
                          ';
                          }
                        }
                      ?>

                      </ul>

                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
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

  </form>