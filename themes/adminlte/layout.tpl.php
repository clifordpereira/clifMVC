<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title><?php echo _SITE_NAME_; ?></title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?=_THEME_URL_ ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?=_THEME_URL_ ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=_THEME_URL_ ?>/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<?php echo '<script src="' . _THEME_URL_ . '/plugins/jquery/jquery.min.js"></script>'; ?>
<!-- Bootstrap 4 -->
<?php echo '<script src="' . _THEME_URL_ . '/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>'; ?>
<!-- DataTables -->
<?php echo '<script src="' . _THEME_URL_ . '/plugins/datatables/jquery.dataTables.js"></script>'; ?>
<?php echo '<script src="' . _THEME_URL_ . '/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>'; ?>
<!-- ChartJS -->
<?php echo '<script src="' . _THEME_URL_ . '/plugins/chart.js/Chart.min.js"></script>'; ?>
<!-- AdminLTE App -->
<?php echo '<script src="' . _THEME_URL_ . '/dist/js/adminlte.min.js"></script>'; ?>
<!-- these files and included on top because values from database need to be fetched by php and given to javascript which is in corresponging page -->

<!-- page script -->
<script>
  $(function () {
    $("#datatable").DataTable();
  });
</script>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <?php require_once($nav); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

  <?php @include_once($header); ?>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        <!-- Actual page content -->
        <?php route($routes, $controller, $action); ?>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php @include_once($footer); ?>

</div>
<!-- ./wrapper -->

</body>
</html>
