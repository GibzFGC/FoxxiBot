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

$whitelist = $PDO->query("SELECT * FROM gb_twitch_modlist WHERE allowed='1'");
$blacklist = $PDO->query("SELECT * FROM gb_twitch_modlist WHERE allowed='0'");
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?= _MODERATION_MNGMNT ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?= _HOME ?></a></li>
              <li class="breadcrumb-item active"><?= _MODERATION_MNGMNT ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <form onsubmit="return validityCheck(this)" method="post" enctype="multipart/form-data" action="<?php print $gfw["site_url"]; ?>/index.php?p=twitch&a=funcs&v=list">
    <!-- Main content -->
    <section class="content">

    <div class="container-fluid">

      <div class="row">
        <div class="col-md-6">

            <div class="card">
              <div class="card-header">
              <h3 class="card-title"><?= _MODERATION_DEFINITION ?></h3>
              </div>
              <!-- /.card-header -->

              <div class="card-body">

                  <div class="form-group">
                    <label for="listName"><?= _MODERATION_STRING ?></label>
                    <input type="text" class="form-control" id="listName" name="listName" placeholder="<?= _MODERATION_STRING_PLACE ?>">
                    <span style="margin-top: 10px; background: #FF0000; padding: 10px; visibility: hidden;" id="commandNameError"></span>
                  </div>

              </div>

            </div>
        </div>
        
        <div class="col-md-6">

            <div class="card">
              <div class="card-header">
              <h3 class="card-title"><?= _MODERATION_LIST ?></h3>
              </div>
              <!-- /.card-header -->

              <form method="post" enctype="multipart/form-data" action="<?php print $gfw["site_url"]; ?>/index.php?p=twitch&a=funcs&v=list">
              <div class="card-body">

                <div class="form-group">
                    <label><?= _MODERATION_ADD ?></label>
                    <select class="form-control select2" id="listType" name="listType" style="width: 100%;">
                      <option value="1" SELECTED><?= _WHITELIST ?></option>';
                      <option value="0"><?= _BLACKLIST ?></option>';
                    </select>
                  </div>

                  <input type="hidden" id="submit" name="submit" value="submit">
                  <button style="float: right;" type="submit" class="btn btn-sm btn-primary"><?= _MODERATION_ADD_LIST ?></button>

              </div>
              </form>

            </div>
        </div>

      </div>
      </section>
      </form>

    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true" style=""><?= _WHITELIST ?></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false" style=""><?= _BLACKLIST ?></a>
                  </li>
                </ul>
              </div>
              <!-- /.card-header -->

              <div class="card-body">

                <div class="tab-content" id="custom-tabs-three-tabContent">
                  <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">

                    <table id="gb_datatable" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 65%;"><?= _ITEM ?></th>
                        <th><?= _ACTIONS ?></th>
                      </tr>
                    </thead>
                    <tbody>

  <?php
    foreach($whitelist as $w_item)
    {
                print "
                    <tr>
                      <td>". $w_item["item"] ."</td>
                      <td>
                      <a onclick=\"return confirm('". _DELETE_MSG ."');\" href=\"$gfw[site_url]/index.php?p=twitch&a=funcs&v=delete&id=$w_item[id]\" class=\"btn btn-danger btn-sm\">". _DELETE ."</a>
                      </td>
                    </tr>
                ";
    }
  ?>

                    </tfoot>
                  </table>

                  </div>

                  <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">

                  <table id="gb_datatable" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 65%;"><?= _ITEM ?></th>
                        <th><?= _ACTIONS ?></th>
                      </tr>
                    </thead>
                    <tbody>

  <?php
    foreach($blacklist as $b_item)
    {
                print "
                    <tr>
                      <td>". $b_item["item"] ."</td>
                      <td>
                        <a onclick=\"return confirm('". _DELETE_MSG ."');\" href=\"$gfw[site_url]/index.php?p=twitch&a=funcs&v=delete&id=$b_item[id]\" class=\"btn btn-danger btn-sm\">". _DELETE ."</a>
                      </td>
                    </tr>
                ";
    }
  ?>

                    </tfoot>
                  </table>

                  </div>
                </div>

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

  <script src="<?php print $gfw['template_path']; ?>/plugins/jquery/jquery.min.js"></script>
  <script src="/pages/twitch/js/twitch_modlist.js"></script>