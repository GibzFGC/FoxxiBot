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
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= _TITLE ?></title>

  <link rel="apple-touch-icon" sizes="180x180" href="<?php print $gfw['template_path']; ?>/img/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php print $gfw['template_path']; ?>/img/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php print $gfw['template_path']; ?>/img/favicon/favicon-16x16.png">
  <link rel="manifest" href="<?php print $gfw['template_path']; ?>/img/favicon/site.webmanifest">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php print $gfw['template_path']; ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php print $gfw['template_path']; ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php print $gfw['template_path']; ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php print $gfw['template_path']; ?>/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php print $gfw['template_path']; ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php print $gfw['template_path']; ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php print $gfw['template_path']; ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php print $gfw['template_path']; ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php print $gfw['template_path']; ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">  
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php print $gfw['template_path']; ?>/css/adminlte.min.css">
  <link rel="stylesheet" href="<?php print $gfw['template_path']; ?>/css/extra.css">

  <!-- dropzonejs -->
  <link rel="stylesheet" href="<?php print $gfw['template_path']; ?>/plugins/dropzone/min/dropzone.min.css">
  <!-- SweetAlert2 -->
  <script src="<?php print $gfw['template_path']; ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- TwitchJS -->
  <script src="<?php print $gfw['template_path']; ?>/plugins/twitch-js/twitch.js"></script>

  <script>
  var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });
  </script>

</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!--<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="<?php print $gfw['template_path']; ?>/img/FoxxiBot.png" alt="AdminLTELogo" height="60" width="60">
  </div>-->

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php print $gfw['site_url']; ?>" class="nav-link"><?= _HOME ?></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">0</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">0 <?= _NOTIFICATION ?></span>
          <div class="dropdown-divider"></div>

          <!--
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          -->
          
          <div class="dropdown-divider"></div>

          <a href="#" class="dropdown-item dropdown-footer"><?= _NOTIFICATION_ALL ?></a>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->