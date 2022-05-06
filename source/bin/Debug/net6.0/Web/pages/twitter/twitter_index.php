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

$result = $PDO->query("SELECT * FROM gb_twitter_status");
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?= _TWITTER_STATUS_MNGMNT ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?= _HOME ?></a></li>
              <li class="breadcrumb-item active"><?= _TWITTER_STATUS_MNGMNT ?></li>
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
                <h3 class="card-title"><?= _TWITTER_STATUS_YOURS ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="gb_datatable" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th><?= _GAME ?></th>
                    <th style="width: 45%;"><?= _TWEET ?></th>
                    <th><?=_ACTIVE ?></th>
                    <th><?= _ACTIONS ?></th>
                  </tr>
                  </thead>
                  <tbody>

<?php
  foreach($result as $row)
  {
              print "
                  <tr>
                    <td>". $row["game"] ."</td>
                    <td>". $row["tweet"] ."</td>

                    <td>". boolean_return($row["active"]) ."</td>
                    <td>
                      <a href=\"$gfw[site_url]/index.php?p=twitter&a=edit&id=$row[game]\" class=\"btn btn-warning btn-sm\">Edit</a>
                    ";

                    if ($row["game"] != "null") {
              print "
                      <a onclick=\"return confirm('". _DELETE_MSG ."');\" href=\"$gfw[site_url]/index.php?p=twitter&a=funcs&v=delete&id=$row[game]\" class=\"btn btn-danger btn-sm\">". _DELETE ."</a>
              ";
                    } else {
              print "
                      <a style=\"color: #fff;\" href=\"#\" class=\"btn btn-sm\">". _BOT_CONTROLLED ."</a>
              ";
                    }

              print "
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