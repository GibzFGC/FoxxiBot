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

$result = $PDO->query("SELECT * FROM gb_points_options");
foreach($result as $row)
{
  $options[$row["parameter"]] = $row["value"];
}
?>
<!-- Custom CSS -->
<link rel="stylesheet" href="/pages/points/css/points.css">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?= _POINTS_SETTINGS ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?= _HOME ?></a></li>
              <li class="breadcrumb-item"><?= _POINTS_SETTINGS ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
       
          <!-- first column -->
          <div class="col-md-6">

          <!-- Form Start -->
          <form method="post" id="user_points" enctype="multipart/form-data" action="<?php print $gfw["site_url"]; ?>/index.php?p=points&a=funcs&v=update_user">

          <!-- general form elements -->
            <div class="card card">
              <div class="card-header">
                <h3 class="card-title"><?= _POINTS_USR_MNGMNT ?></h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">

                <div class="form-group">
                    <label for="points_username"><?= _USERNAME ?></label>
                    <input type="text" class="form-control" id="points_username" name="points_username" data-key="<?php print $bot_obj->APIKey; ?>" placeholder="<?= _SEARCH_USERNAME ?>" autocomplete="off" required>
                </div>

                <div class="form-group">
                    <label for="points_current"><?= _POINTS ?></label>
                    <input type="number" class="form-control" id="points_current" name="points_current" placeholder="0" required>
                </div>

                </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button style="float: right;" id="update_user" type="submit" class="btn btn-v-sm btn-primary"><?= _UPDATE ?></button>
                <button style="float: right;" id="update_user_clear" type="submit" class="btn btn-v-sm btn-danger btn-spacer"><?= _CLEAR ?></button>
              </div>

            </div>
            <!-- /.card -->

           </form>
           <!--/.form -->

          </div>
          <!--/.col (first) -->

          <!-- second column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card">
              <div class="card-header">
                <h3 class="card-title"><?= _POINTS_FUN_TOOLS ?></h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">

                <div class="form-group">
                    <label for="points_modifier"><?= _POINTS_MODIFIER ?></label>
                    <input type="number" class="form-control" id="points_modifier" name="points_modifier" placeholder="0">
                </div>

                <div class="form-group">
                    <label for="points_rain"><?= _POINTS_RAIN ?></label>
                    <input type="number" class="form-control" id="points_rain" name="points_rain" placeholder="0">
                </div>

                </div>
              <!-- /.card-body -->
              
              <div class="card-footer">
                <button style="float: right;" id="take_from_all" class="btn btn-v-sm btn-primary"><?= _POINTS_TAKE_ALL ?></button>
                <button style="float: right;" id="give_to_all" class="btn btn-v-sm btn-primary btn-spacer"><?= _POINTS_GIVE_ALL ?></button>
                <button style="float: right;" id="make_it_rain" class="btn btn-v-sm btn-primary btn-spacer"><?= _POINTS_MAKE_RAIN ?></button>
              </div>

            </div>
            <!-- /.card -->

          </div>
          <!--/.col (second) -->

          <!-- third column -->
          <div class="col-md-12">

          <!-- Form Start -->
          <form method="post" id="points_settings" enctype="multipart/form-data" action="<?php print $gfw["site_url"]; ?>/index.php?p=points&a=funcs&v=save">          

            <!-- general form elements -->
            <div class="card card">
              <div class="card-header">
                <h3 style="margin-top: 4px;" class="card-title"><?= _POINTS_SETTINGS_MAIN ?></h3>

                <div class="card-tools">
                <?php
                  if ($options["points_active"] == "off") {
                    print '<input type="checkbox" name="points_active" data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                  } else {
                    print '<input type="checkbox" name="points_active" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                  }
                ?>
                </div>                
              </div>
              <!-- /.card-header -->
                <div class="card-body">

                <div class="form-group">
                    <label for="points_name"><?= _POINTS_NAME ?></label>
                    <input type="text" class="form-control" id="points_name" name="points_name" placeholder="<?= _POINTS_NAME_ENTER ?>" value="<?php print $options["points_name"]; ?>" required>
                </div>

                <div class="form-group">
                    <label for="points_shortname"><?= _POINTS_SHORT ?></label>
                    <input type="text" class="form-control" id="points_shortname" name="points_shortname" placeholder="<?= _POINTS_SHORT_ENTER ?>" value="<?php print $options["points_short"]; ?>" required>
                </div>

                <div class="form-group">
                    <label for="points_increment"><?= _POINTS_GIVEN ?></label>
                    <input type="number" class="form-control" id="points_increment" name="points_increment" placeholder="<?= _POINTS_GIVEN_VALUE ?>" value="<?php print $options["points_increment"]; ?>" required>
                </div>

                </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button style="float: right;" id="update_settings" type="submit" class="btn btn-primary"><?= _SAVE_SETTINGS ?></button>
              </div>

              </div>
            <!-- /.card -->

            </form>
           <!--/.form -->

          </div>
          <!--/.col (third) -->

          <script type="text/javascript">
            const username = '<?php print $gfw["Twitch_ClientUser"]; ?>'
            const channel = '<?php print $gfw["Twitch_BroadcasterChannel"]; ?>'
          </script>

          <script src="<?php print $gfw['template_path']; ?>/plugins/jquery/jquery.min.js"></script>
          <script src="/pages/points/js/points.js"></script>