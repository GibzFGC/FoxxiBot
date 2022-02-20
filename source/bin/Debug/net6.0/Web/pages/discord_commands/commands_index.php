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

$result = $PDO->query("SELECT * FROM gb_discord_commands");
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Discord Commands Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Discord Commands Management</li>
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
                <h3 class="card-title">Here are your Discord Commands.</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="gb_datatable" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Command</th>
                    <th style="width: 65%;">Response</th>
                    <th>Permission</th>
                    <th>Active</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>

<?php
  foreach($result as $row)
  {
              print "
                  <tr>
                    <td>". $row["name"] ."</td>
                    <td>". $row["response"] ."</td>

                    <td>
              ";

              foreach(json_decode($row["permission"]) as $role) {
                  $roles_sql = $PDO->query("SELECT role_name FROM gb_discord_roles WHERE role_id='$role'");
                  foreach($roles_sql as $role_id)
                  {
                      print $role_id["role_name"] . "<br />";
                  }
              }
             
              print "
                    </td>

                    <td>". boolean_return($row["active"]) ."</td>
                    <td>
                      <a href=\"$gfw[site_url]/index.php?p=discord_commands&a=edit&id=$row[id]\" class=\"btn btn-warning btn-sm\">Edit</a>
                      <a onclick=\"return confirm('Are you sure you want to delete this item?');\" href=\"$gfw[site_url]/index.php?p=discord_commands&a=funcs&v=delete&id=$row[id]\" class=\"btn btn-danger btn-sm\">Delete</a>
                    </td>
                  </tr>
              ";
  }
?>

                  </tfoot>
                </table>

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