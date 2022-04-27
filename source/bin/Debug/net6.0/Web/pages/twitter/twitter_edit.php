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

// Get Edit Data
$data = $PDO->query("SELECT * FROM gb_twitter_status WHERE game='$_REQUEST[id]' LIMIT 1");
foreach($data as $edit)
{
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?= _TWITTER_EDIT_STATUS ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?= _HOME ?></a></li>
              <li class="breadcrumb-item"><?= _TWITTER ?></li>
              <li class="breadcrumb-item active"><?= _EDIT ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <form method="post" enctype="multipart/form-data" action="<?php print $gfw["site_url"]; ?>/index.php?p=twitter&a=funcs&v=edit">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?= _TWITTER_TWEET_INFO ?></h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">

                  <div class="form-group">
                    <label for="commandName"><?= _TWITTER_GAME_NAME ?></label>
                    <?php
                    if ($edit["game"] == "null") {
                      print '<input type="text" class="form-control" id="commandGame" name="commandGame" placeholder="'. _TWITTER_GAME_NAME_PLACE .'" value="' . $edit["game"] . '" readonly required>';
                    } else {
                      print '<input type="text" class="form-control" id="commandGame" name="commandGame" placeholder="'. _TWITTER_GAME_NAME_PLACE .'" value="' . $edit["game"] . '" required>';
                    }
                    ?>
                  </div>

                  <div class="form-group">
                    <label for="commandResponse"><?= _TWITTER_CONTENT ?></label>
                    <textarea class="form-control" rows="3"  id="commandTweet" name="commandTweet" placeholder="<?= _TWITTER_CONTENT_PLACE ?>" required><?php print $edit["tweet"]; ?></textarea>
                  </div>

                  <div class="form-group">
                  <label><?= _ACTIVE ?></label>
                  <select class="form-control select2" id="commandActive" name="commandActive" style="width: 100%;">
                  <?php if($edit["active"] == 0) {
                      print "<option value=\"0\" SELECTED>". _NO ."</option>";
                      print "<option value=\"1\">". _YES ."</option>";
                    } else {
                      print "<option value=\"1\" SELECTED>". _YES ."</option>";
                      print "<option value=\"0\">". _NO ."</option>";
                    }
                    ?>
                  </select>
                </div>

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <input type="hidden" id="commandID" name="commandID" value="<?php print $_REQUEST["id"]; ?>">
                <input type="hidden" id="submit" name="submit" value="submit">
                <button style="float: right;" type="submit" class="btn btn-primary"><?= _TWITTER_TWEET_UPDATE ?></button>
              </div>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
          
        </form>

          <!-- right column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?= _TWITTER_USEFUL_VARS ?></h3>
              </div>
              <!-- /.card-header -->
              
                <div class="card-body">

                  <div class="form-group">
                    <?= _TWITTER_VARS_INFO ?>
                  </div>

                </div>
                <!-- /.card-body -->

            </div>
            <!-- /.card -->

          </div>
          <!--/.col (right) -->

    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
<?php } ?>

  <script src="<?php print $gfw['template_path']; ?>/plugins/jquery/jquery.min.js"></script>
  <script src="/pages/twitch_commands/js/commands_add.js"></script>