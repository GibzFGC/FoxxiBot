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

$result = $PDO->query("SELECT * FROM gb_points WHERE username NOT IN (SELECT username FROM gb_points_blacklist) AND username NOT IN (SELECT username FROM gb_twitch_botlist)");
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?= _POINTS_RANKING ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?= _HOME ?></a></li>
              <li class="breadcrumb-item active"><?= _POINTS_RANKING ?></li>
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
                <h3 class="card-title"><?= _POINTS_RANKING_TITLE ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="gb_points_rankings" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th><?= _USERNAME ?></th>
                    <th><?= _POINTS ?></th>
                    <th><?= _ACTIONS ?></th>
                  </tr>
                  </thead>
                  <tbody>

<?php
  foreach($result as $row)
  {
              print "
                  <tr>
                    <td>". $row["username"] ."</td>
                    <td>". $row["value"] ."</td>
                    <td>
                      <a onclick=\"return confirm('". _DELETE_USER_POINTS . "');\" href=\"$gfw[site_url]/index.php?p=points&a=funcs&v=delete&id=$row[username]\" class=\"btn btn-danger btn-sm\">". _DELETE ."</a>                    
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