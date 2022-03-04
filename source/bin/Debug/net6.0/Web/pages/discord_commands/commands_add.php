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
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Adding a Command</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Discord Commands</li>
              <li class="breadcrumb-item active">Add</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <form onsubmit="return validityCheck(this)" method="post" enctype="multipart/form-data" action="<?php print $gfw["site_url"]; ?>/index.php?p=discord_commands&a=funcs&v=save">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Command Information</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">

                  <div class="form-group">
                    <label for="commandName">Name (without prefix)</label>
                    <input type="text" class="form-control" id="commandName" name="commandName" placeholder="Enter Command Name" required>
                    <span style="margin-top: 10px; background: #FF0000; padding: 10px; visibility: hidden;" id="commandNameError"></span>
                  </div>

                  <div class="form-group">
                    <label for="commandResponse">Response</label>
                    <textarea class="form-control" rows="3"  id="commandResponse" name="commandResponse" placeholder="Enter the response text here..." required></textarea>
                  </div>

                  <div class="form-group">
                  <label>Permission</label>
                  <select class="form-control select2" multiple id="commandPermissions" name="commandPermissions[]" style="width: 100%;">

                  <?php
                  $result = $PDO->query("SELECT * FROM gb_discord_roles ORDER BY role_name ASC");
                  foreach($result as $row)
                  {
                    if ($row["role_name"] == "@everyone") {
                      print '<option SELECTED value="'. $row['role_id'] .'">'. $row['role_name'] .'</option>';
                    } else {
                      print '<option value="'. $row['role_id'] .'">'. $row['role_name'] .'</option>';
                    }
                  }
                  ?>
                  </select>
                </div>

                <div class="form-group">
                  <label>Active</label>
                  <select class="form-control select2" id="commandActive" name="commandActive" style="width: 100%;">
                    <option value="1" SELECTED>Yes</option>';
                    <option value="0">No</option>';
                  </select>
                </div>

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <input type="hidden" id="submit" name="submit" value="submit">
                <button style="float: right;" type="submit" class="btn btn-primary">Create Command</button>
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
                <h3 class="card-title">Useful Variables</h3>
              </div>
              <!-- /.card-header -->
              
                <div class="card-body">

                  <div class="form-group">
                    Here is a list of internal variables:<br /><br />
                    {1} - A custom argument for whatever you want<br />
                    {2} - A custom argument for whatever you want (only works if the first is set)<br />
                    {8ball} - Creates an 8ball with responses<br />
                    {dice} - rolls a dice and returns a random value<br />
                    {sender} - returns the command users display name<br />
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

  <script src="<?php print $gfw['template_path']; ?>/plugins/jquery/jquery.min.js"></script>
  <script src="/pages/discord_commands/js/commands_add.js"></script>