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

$data = $PDO->query("SELECT * FROM gb_discord_commands WHERE id='$_REQUEST[id]' LIMIT 1");

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
            <h1 class="m-0">Editing a Command: </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?= _HOME ?></a></li>
              <li class="breadcrumb-item"><?= _DISCORD_CMDS ?></li>
              <li class="breadcrumb-item active"><?= _EDIT ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <form method="post" enctype="multipart/form-data" action="<?php print $gfw["site_url"]; ?>/index.php?p=discord_commands&a=funcs&v=edit">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?= _DISCORD_CMD_INFO ?></h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">

                  <div class="form-group">
                    <label for="exampleInputEmail1"><?= _DISCORD_CMD_NAME ?></label>
                    <input type="text" class="form-control" id="commandName" name="commandName" placeholder="Enter Command Name" value="<?php print $edit["name"]; ?>" required>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Response</label>
                    <textarea class="form-control" rows="3"  id="commandResponse" name="commandResponse" placeholder="Enter the response text here..." required><?php print $edit["response"]; ?></textarea>
                  </div>

                  <div class="form-group">
                  <label>Permission</label>
                  <select class="form-control select2" multiple id="commandPermissions" name="commandPermissions[]" style="width: 100%;">

                  <?php
                  $result = $PDO->prepare("SELECT * FROM gb_discord_roles ORDER BY role_name ASC");
                  $result->execute();

                  while ($row = $result->fetch(PDO::FETCH_ASSOC))
                  {
                  
                    foreach(json_decode($edit["permission"]) as $role) {
                      if ($role == $row["role_id"]) {
                        print '<option SELECTED value="'. $row['role_id'] .'">'. $row['role_name'] .'</option>';
                      }
                    }
                    
                    print '<option value="'. $row['role_id'] .'">'. $row['role_name'] .'</option>';
                  }
                  ?>
                  </select>
                </div>

                <div class="form-group">
                  <label><?= _ACTIVE ?></label>
                  <select class="form-control select" id="commandActive" name="commandActive" style="width: 100%;">
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
                <h3 class="card-title"><?= _DISCORD_USEFUL_VARS ?></h3>
                
              </div>
              <!-- /.card-header -->
              
                <div class="card-body">

                <div class="form-group">
                    <?= _DISCORD_VARS_INFO ?>
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