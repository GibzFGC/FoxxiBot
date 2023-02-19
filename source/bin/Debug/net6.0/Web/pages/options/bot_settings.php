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

$result = $PDO->query("SELECT * FROM gb_options");
foreach($result as $row)
{
  $options[$row["parameter"]] = $row["value"];
}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?= _BOT_SETTINGS ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?= _HOME ?></a></li>
              <li class="breadcrumb-item active"><?= _BOT_SETTINGS ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <form method="post" enctype="multipart/form-data" action="<?php print $gfw["site_url"]; ?>/index.php?p=options&a=funcs&v=save">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <!-- first column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?= _BOT_SETTINGS_MAIN ?></h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">

                <div class="form-group">
                    <label><?= _BOT_SETTINGS_LANG ?></label>
                    <select class="form-control select2" id="bot_lang" name="bot_lang" style="width: 100%;">

                    <?php
                    foreach (new DirectoryIterator("modules/locales/") as $file) {
                      if ($file->isFile()) {
                          $file_no_lang = str_replace("lang_", "", $file->getFilename());
                          $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $file_no_lang);

                          if ($gfw['bot_language'] == $withoutExt) {
                            print "<option value='". $withoutExt ."' SELECTED>" . $withoutExt . "</option>";
                          } else {
                            print "<option value='". $withoutExt ."'>" . $withoutExt . "</option>";
                          }
                      }
                    }
                    ?>

                    </select>
                    
                  </div>

                  <div class="form-group">
                    <label><?= _BOT_SETTINGS_DEBUG ?> <small><?= _BOT_SETTINGS_DEBUG_RESTART ?></small></label>
                      <div style="float: right;">
                      <?php
                      if ($options["debug"] == "off") {
                      print '<input type="checkbox" name="debug_mode" data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                      } else {
                        print '<input type="checkbox" name="debug_mode" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                      }
                      ?>
                    </div>
                  </div>

                </div>
              <!-- /.card-body -->

            <!-- /.card -->

          </div>
          <!--/.col (first) -->
          
          <!-- second column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?= _BOT_SETTINGS_SIDEBAR ?></h3>
              </div>

              <!-- /.card-header -->
              <div class="card-body">

                <div class="form-group">
                  <label><?= _BOT_SETTINGS_DISCORD_MENU ?></label>
                    <div style="float: right;">
                    <?php
                    if ($options["discord_features"] == "off") {
                    print '<input type="checkbox" name="discord_features" data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                    } else {
                      print '<input type="checkbox" name="discord_features" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                    }
                    ?>
                  </div>
                </div>

                <div class="form-group">
                  <label><?= _BOT_SETTINGS_TWITCH_MENU ?></label>
                    <div style="float: right;">
                    <?php
                    if ($options["twitch_features"] == "off") {
                    print '<input type="checkbox" name="twitch_features" data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                    } else {
                      print '<input type="checkbox" name="twitch_features" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                    }
                    ?>
                  </div>
                </div>

                <div class="form-group">
                  <label><?= _BOT_SETTINGS_TOURN_MENU ?></label>
                    <div style="float: right;">
                    <?php
                    if ($options["tournament_features"] == "off") {
                    print '<input type="checkbox" name="tournament_features" data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                    } else {
                      print '<input type="checkbox" name="tournament_features" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                    }
                    ?>
                  </div>
                </div>

              </div>
              <!-- /.card-body -->

            </div>
            <!-- /.card -->

          </div>
          <!--/.col (second) -->

          <!-- second column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <!-- /.card-header -->
              
                <div class="card-footer">
                  <input type="hidden" id="submit" name="submit" value="submit">
                    <p style="float: left; margin-top:15px;"><?= _BOT_SETTINGS_DISCORD_OPT ?></p>
                    <button style="float: right; margin-top:9px;" type="submit" class="btn btn-primary"><?= _SAVE_SETTINGS ?></button>
                  </div>
                </div>

            </div>
            <!-- /.card -->

    </section>
    <!-- /.content -->

  </form>
  <!-- /.form -->

</div>
<!-- /.content-wrapper -->