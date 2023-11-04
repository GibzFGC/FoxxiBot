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

// Get Points Options
$options = array();

$result = $PDO->query("SELECT * FROM gb_points_options");
foreach($result as $row)
{
  $options[$row["parameter"]] = $row["value"];
}

// Get Edit Data
$data = $PDO->query("SELECT * FROM gb_commands WHERE id='$_REQUEST[id]' LIMIT 1");
foreach($data as $edit)
{

  $command_name = str_replace("!", "", $edit["name"]);
  $multi_data = json_decode($edit["response"]);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?= _TWITCH_CMD_EDIT_MULTI ?>: </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?= _HOME ?></a></li>
              <li class="breadcrumb-item"><?= _TWITCH_CMD_MNGMNT ?></li>
              <li class="breadcrumb-item active"><?= _EDIT ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <form method="post" enctype="multipart/form-data" action="<?php print $gfw["site_url"]; ?>/index.php?p=twitch_commands&a=funcs&v=edit_multi">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?= _TWITCH_CMD_INFO ?></h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">

                  <div class="form-group">
                    <label for="exampleInputEmail1"><?= _TWITCH_CMD_NAME ?></label>
                    <input type="text" class="form-control" id="commandName" name="commandName" placeholder="<?= _TWITCH_CMD_NAME_PLACE ?>" value="<?php print $command_name; ?>" required>
                  </div>

                  <div class="form-group">
                    <label for="commandResponse1"><?= _RESPONSE_1 ?></label>
                    <textarea class="form-control" rows="3"  id="commandResponse1" name="commandResponse1" placeholder="<?= _TWITCH_CMD_RESPONSE_1 ?>" required><?php print $multi_data->message_1; ?></textarea>
                  </div>

                  <div class="form-group">
                    <label for="commandResponse2"><?= _RESPONSE_2 ?></label>
                    <textarea class="form-control" rows="3"  id="commandResponse2" name="commandResponse2" placeholder="<?= _TWITCH_CMD_RESPONSE_2 ?>" required><?php print $multi_data->message_2; ?></textarea>
                  </div>

                  <div class="form-group">
                    <label for="commandResponse3"><?= _RESPONSE_3 ?></label>
                    <textarea class="form-control" rows="3"  id="commandResponse3" name="commandResponse3" placeholder="<?= _TWITCH_CMD_RESPONSE_3 ?>"><?php print $multi_data->message_3; ?></textarea>
                  </div>

                  <div class="form-group">
                    <label for="commandResponse4"><?= _RESPONSE_4 ?></label>
                    <textarea class="form-control" rows="3"  id="commandResponse4" name="commandResponse4" placeholder="<?= _TWITCH_CMD_RESPONSE_4 ?>"><?php print $multi_data->message_4; ?></textarea>
                  </div>

                  <div class="form-group">
                    <label for="commandResponse5"><?= _RESPONSE_5 ?></label>
                    <textarea class="form-control" rows="3"  id="commandResponse5" name="commandResponse5" placeholder="<?= _TWITCH_CMD_RESPONSE_5 ?>"><?php print $multi_data->message_5; ?></textarea>
                  </div>

                  <div class="form-group">
                    <label for="commandResponse6"><?= _RESPONSE_6 ?></label>
                    <textarea class="form-control" rows="3"  id="commandResponse6" name="commandResponse6" placeholder="<?= _TWITCH_CMD_RESPONSE_6 ?>"><?php print $multi_data->message_6; ?></textarea>
                  </div>

                  <div class="form-group">
                    <label for="commandResponse7"><?= _RESPONSE_7 ?></label>
                    <textarea class="form-control" rows="3"  id="commandResponse7" name="commandResponse7" placeholder="<?= _TWITCH_CMD_RESPONSE_7 ?>"><?php print $multi_data->message_7; ?></textarea>
                  </div>

                  <div class="form-group">
                    <label for="commandResponse8"><?= _RESPONSE_8 ?></label>
                    <textarea class="form-control" rows="3"  id="commandResponse8" name="commandResponse8" placeholder="<?= _TWITCH_CMD_RESPONSE_8 ?>"><?php print $multi_data->message_8; ?></textarea>
                  </div>

                  <div class="form-group">
                    <label for="commandResponse9"><?= _RESPONSE_9 ?></label>
                    <textarea class="form-control" rows="3"  id="commandResponse9" name="commandResponse9" placeholder="<?= _TWITCH_CMD_RESPONSE_9 ?>"><?php print $multi_data->message_9; ?></textarea>
                  </div>

                  <div class="form-group">
                    <label for="commandResponse10"><?= _RESPONSE_10 ?></label>
                    <textarea class="form-control" rows="3"  id="commandResponse10" name="commandResponse10" placeholder="<?= _TWITCH_CMD_RESPONSE_10 ?>"><?php print $multi_data->message_10; ?></textarea>
                  </div>

                  <?php if ($options["points_active"] == "on") { ?>
                  <div class="form-group">
                    <label for="commandPoints"><?= _POINT_COST ?></label>
                    <input type="number" class="form-control" id="commandPoints" name="commandPoints" value="<?php print $edit["points"]; ?>">
                  </div>
                  <?php } ?>

                  <div class="form-group">
                  <label>Permission</label>
                  <select class="form-control select2" id="commandPermissions" name="commandPermissions" style="width: 100%;">

                  <?php
                  $result = $PDO->query("SELECT * FROM gb_twitch_perms");
                  foreach($result as $row)
                  {
                      if ($edit["active"] == $row["value"]) {
                        print '<option value="'. $row['value'] .'">'. $row['name'] .'</option>';
                      } else {
                        print '<option value="'. $row['value'] .'">'. $row['name'] .'</option>';  
                      }
                  }
                  ?>
                  </select>
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
                <button style="float: right;" type="submit" class="toast_success btn btn-primary"><?= _UPDATE_CMD ?></button>
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
                <h3 class="card-title"><?= _TWITCH_CMD_USEFUL_VARS ?></h3>
              </div>
              <!-- /.card-header -->
              
                <div class="card-body">

                  <div class="form-group">
                    <?= _TWITCH_CMD_VARS_INFO ?>
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