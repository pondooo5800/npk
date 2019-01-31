<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/logo.png" type="image/x-icon">
    <link rel="icon" href="<?php echo base_url(); ?>assets/images/logo.png" type="image/x-icon">


    <title><?php echo $title . ' - ' . $subtitle ?></title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/plugins/gentelella-master/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>assets/plugins/gentelella-master/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url(); ?>assets/plugins/gentelella-master/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url(); ?>assets/plugins/gentelella-master/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url(); ?>assets/plugins/gentelella-master/build/css/custom.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-select-master/dist/css/bootstrap-select.css" rel="stylesheet" >

  </head>

<body class="nav-md">
  
  <div class="container body">
    <div class="main_container">

      <?php $this->load->view('layout/slidemenu'); ?>

      <?php $this->load->view('layout/header'); ?>

      <?php $this->load->view($view_isi); ?>

      <?php $this->load->view('layout/footer'); ?>
      

    </div>
  </div>

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/plugins/gentelella-master/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>assets/plugins/gentelella-master/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>assets/plugins/gentelella-master/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url(); ?>assets/plugins/gentelella-master/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo base_url(); ?>assets/plugins/gentelella-master/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- jQuery Sparklines -->
    <script src="<?php echo base_url(); ?>assets/plugins/gentelella-master/vendors/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- Flot -->
    <script src="<?php echo base_url(); ?>assets/plugins/gentelella-master/vendors/Flot/jquery.flot.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/gentelella-master/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/gentelella-master/vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/gentelella-master/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/gentelella-master/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?php echo base_url(); ?>assets/plugins/gentelella-master/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/gentelella-master/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/gentelella-master/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="<?php echo base_url(); ?>assets/plugins/gentelella-master/vendors/DateJS/build/date.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url(); ?>assets/plugins/gentelella-master/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/gentelella-master/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>assets/plugins/gentelella-master/build/js/custom.min.js"></script>
    <!-- bootstrap-select -->
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select-master/dist/js/bootstrap-select.js"></script>

  </body>
</html>