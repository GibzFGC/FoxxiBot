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
            <h1 class="m-0">Points Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Points Management</li>
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
                <h3 class="card-title">User Management</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">

                <div class="form-group">
                    <label for="points_username">Username</label>
                    <input type="text" class="form-control" id="points_username" name="points_username" placeholder="Search a Username" autocomplete="off" required>
                </div>

                <div class="form-group">
                    <label for="points_current">Points</label>
                    <input type="number" class="form-control" id="points_current" name="points_current" placeholder="0" required>
                </div>

                </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button style="float: right;" id="update_user" type="submit" class="btn btn-v-sm btn-primary">Update</button>
                <button style="float: right;" id="update_user_clear" type="submit" class="btn btn-v-sm btn-danger btn-spacer">Clear</button>
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
                <h3 class="card-title">Fun Tools</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">

                <div class="form-group">
                    <label for="points_modifier">Set Points to Change (only works for Give to All & Take from All)</label>
                    <input type="number" class="form-control" id="points_modifier" name="points_modifier" placeholder="0">
                </div>

                <div class="form-group">
                    <label for="points_rain">Max Points for Make it Rain?</label>
                    <input type="number" class="form-control" id="points_rain" name="points_rain" placeholder="0">
                </div>

                </div>
              <!-- /.card-body -->
              
              <div class="card-footer">
                <button style="float: right;" type="submit" class="btn btn-v-sm btn-primary">Take from All</button>
                <button style="float: right;" type="submit" class="btn btn-v-sm btn-primary btn-spacer">Give to All</button>
                <button style="float: right;" type="submit" class="btn btn-v-sm btn-primary btn-spacer">Make it Rain!</button>
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
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Main Points Settings</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">

                <div class="form-group">
                    <label for="points_name">Points Name</label>
                    <input type="text" class="form-control" id="points_name" name="points_name" placeholder="Enter Points Name" value="<?php print $options["points_name"]; ?>" required>
                </div>

                <div class="form-group">
                    <label for="points_shortname">Points Short Name</label>
                    <input type="text" class="form-control" id="points_shortname" name="points_shortname" placeholder="Enter Points Short Name" value="<?php print $options["points_short"]; ?>" required>
                </div>

                <div class="form-group">
                    <label for="points_increment">Points Given Every 5 Mins</label>
                    <input type="number" class="form-control" id="points_increment" name="points_increment" placeholder="Enter Points Value" value="<?php print $options["points_increment"]; ?>" required>
                </div>

                </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button style="float: right;" id="update_settings" type="submit" class="btn btn-primary">Save Settings</button>
              </div>

              </div>
            <!-- /.card -->

            </form>
           <!--/.form -->

          </div>
          <!--/.col (third) -->

          <script src="<?php print $gfw['template_path']; ?>/plugins/jquery/jquery.min.js"></script>
          <script src="/pages/points/js/points.js"></script>