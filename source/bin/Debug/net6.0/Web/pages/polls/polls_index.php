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

$opt_result = $PDO->query("SELECT * FROM gb_polls_options");
foreach($opt_result as $row)
{
  $options[$row["parameter"]] = $row["value"];
}

$result = $PDO->query("SELECT * FROM gb_polls");
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Poll Managment</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?= _HOME ?></a></li>
              <li class="breadcrumb-item active">Poll Management</li>
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
                <h3 class="card-title">Your Current Polls</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="gb_datatable" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th><?=_ID ?></th>
                    <th style="width: 30%;"><?=_TITLE ?></th>
                    <th>Items</th>
                    <th>Poll Ends</th>
                    <th><?=_URL ?></th>
                    <th>Status</th>
                    <th><?= _ACTIONS ?></th>
                  </tr>
                  </thead>
                  <tbody>

<?php
  foreach($result as $row)
  {
              print "
                  <tr>
                    <td>". $row["id"] ."</td>
                    <td>". $row["title"] ."</td>
                    <td>&bull; ". $row["option1"] ."<br>&bull; ". $row["option2"] ."<br>&bull; ". $row["option3"] ."<br>&bull; ". $row["option4"] ."</td>
                    <td>". $row["datetime"] ."</td>
                    <td><a target='_blank' href='". $gfw['site_url'] . "/obs/polls/index.php?id=$row[id]'>View Poll</a></td>
              ";

              if ($options["active_poll"] == $row["id"]) {
                print "<td>Voting Started</td>";
              } else {
                print "<td>Currently Closed</td>";
              }

              print "
                    <td>
              ";

              if ($options["active_poll"] == $row["id"]) {
                print "<a href=\"$gfw[site_url]/index.php?p=polls&a=funcs&v=state&id=$row[id]\" class=\"btn btn-warning btn-sm\">De-Activate</a>";
              } else {
                print "<a href=\"$gfw[site_url]/index.php?p=polls&a=funcs&v=state&id=$row[id]\" class=\"btn btn-success btn-sm\">Activate</a>";
              }

              print "
                      <a href=\"$gfw[site_url]/index.php?p=polls&a=edit&id=$row[id]\" class=\"btn btn-info btn-sm\">Edit</a>
                      <a onclick=\"return confirm('Are you sure you wish to clear all of this polls votes');\" href=\"$gfw[site_url]/index.php?p=polls&a=funcs&v=clear&id=$row[id]\" class=\"btn btn-default btn-sm\">Clear</a>
                    ";

                    print "
                      <a onclick=\"return confirm('". _DELETE_MSG ."');\" href=\"$gfw[site_url]/index.php?p=polls&a=funcs&v=delete&id=$row[id]\" class=\"btn btn-danger btn-sm\">". _DELETE ."</a>
                    ";

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