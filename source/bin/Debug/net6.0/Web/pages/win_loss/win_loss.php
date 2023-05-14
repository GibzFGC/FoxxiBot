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

$result = $PDO->query("SELECT * FROM gb_win_loss");
foreach($result as $row)
{
  $results[$row["parameter"]] = $row["value"];
}
?>

  <!-- Form Start -->
  <form method="post" id="save" enctype="multipart/form-data" action="<?php print $gfw["site_url"]; ?>/index.php?p=win_loss&a=funcs&v=save">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Wins &amp; Losses Manager</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?= _HOME ?></a></li>
              <li class="breadcrumb-item active">Wins &amp; Losses Manager</li>
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
                <h3 class="card-title">Wins &amp; Losses Counter</h3>              
              </div>
              <!-- /.card-header -->
            
              <div class="card-body">

                <div class="row justify-content-md-center">
                    <div class="col-3 text-center">
                    <h3 class="h3">
                    <?= _WIN_LOSS_WINS ?>: <span class="badge badge-success" name="wins" id="wins"> <?php print $results["wins"]; ?> </span>
                    </h3>
                    </div>

                    <div class="col-3 text-center">
                    <h3 class="h3">
                    <?= _WIN_LOSS_LOSSES ?>: <span class="badge badge-danger" name="losses" id="losses"> <?php print $results["losses"]; ?> </span>
                    </h3>
                    </div>
                </div>

                <br />

                <div class="row justify-content-md-center">
                    <div class="col-6 text-center">
                    <h3 class="h1">
                    <?= _WIN_LOSS_WIN_RATIO ?>: <span class="badge badge-info" name="ratio" id="ratio"> <?php print $results["ratio"]; ?> </span>
                    </h3>
                    </div>
                </div>

                <br />

                <div class="row justify-content-md-center">
                    <div class="col-2">
                    <button class="btn btn-primary btn-block btn-sm" onclick="win();"> <?= _WIN_LOSS_WIN_BTN ?> </button>
                    </div>
                    <div class="col-2">
                    <button class="btn btn-danger btn-block btn-sm" onclick="loss();"> <?= _WIN_LOSS_LOSS_BTN ?> </button>
                    </div>
                    <div class="col-2">
                    <button class="btn btn-warning btn-block btn-sm" onclick="reset_all();"> <?= _WIN_LOSS_RESET_BTN ?> </button>
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

</form>

  <script src="<?php print $gfw['template_path']; ?>/plugins/jquery/jquery.min.js"></script>
  <script src="/pages/win_loss/js/win_loss.js"></script>