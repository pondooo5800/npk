<!-- *************** inspinia-3 Template: JS *************** ----->
      <!-- Mainly scripts -->
<?php //echo js_asset('../plugins/Static_Full_Version/js/bootstrap.min.js'); ?>
<?php //echo js_asset('../plugins/Static_Full_Version/js/plugins/metisMenu/jquery.metisMenu.js'); ?>
<?php //echo js_asset('../plugins/Static_Full_Version/js/plugins/slimscroll/jquery.slimscroll.min.js'); ?>
      <!-- Custom and plugin javascript -->
<?php //echo js_asset('../plugins/Static_Full_Version/js/inspinia.js'); ?>
<?php //echo js_asset('../plugins/Static_Full_Version/js/plugins/pace/pace.min.js'); ?>
<!-- *************** End inspinia-3 Template: JS *************** -->

<!-- *************** Set Format Plugin *************** -->
<?php //echo js_asset('../plugins/setformat/jquery.number.min.js'); ?>
<?php //echo js_asset('../plugins/setformat/jquery.maskedinput.min.js'); ?>
<?php //echo js_asset('../plugins/setformat/jquery.setformat.js'); ?>
<!-- *************** End Set Format Plugin *************** -->


<!-- *************** Load gentelella-master Template *************** -->
    <!-- jQuery -->
    <?php echo js_asset('../plugins/gentelella-master/vendors/jquery/dist/jquery.min.js'); ?>
    <!-- Bootstrap -->
    <?php echo js_asset('../plugins/gentelella-master/vendors/bootstrap/dist/js/bootstrap.min.js'); ?>
    <!-- FastClick -->
    <?php echo js_asset('../plugins/gentelella-master/vendors/fastclick/lib/fastclick.js'); ?>
    <!-- NProgress -->
    <?php echo js_asset('../plugins/gentelella-master/vendors/nprogress/nprogress.js'); ?>
    <!-- Chart.js -->
    <?php echo js_asset('../plugins/gentelella-master/vendors/Chart.js/dist/Chart.min.js'); ?>
    <!-- gauge.js -->
    <?php echo js_asset('../plugins/gentelella-master/vendors/gauge.js/dist/gauge.min.js'); ?>
    <!-- bootstrap-progressbar -->
    <?php echo js_asset('../plugins/gentelella-master/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js'); ?>
    <!-- iCheck -->
    <?php echo js_asset('../plugins/gentelella-master/vendors/iCheck/icheck.min.js'); ?>
    <!-- Skycons -->
    <?php echo js_asset('../plugins/gentelella-master/vendors/skycons/skycons.js'); ?>
    <!-- Flot -->
    <?php echo js_asset('../plugins/gentelella-master/vendors/Flot/jquery.flot.js'); ?>
    <?php echo js_asset('../plugins/gentelella-master/vendors/Flot/jquery.flot.pie.js'); ?>
    <?php echo js_asset('../plugins/gentelella-master/vendors/Flot/jquery.flot.time.js'); ?>
    <?php echo js_asset('../plugins/gentelella-master/vendors/Flot/jquery.flot.stack.js'); ?>
    <?php echo js_asset('../plugins/gentelella-master/vendors/Flot/jquery.flot.resize.js'); ?>
    <!-- Flot plugins -->
    <?php echo js_asset('../plugins/gentelella-master/vendors/flot.orderbars/js/jquery.flot.orderBars.js'); ?>
    <?php echo js_asset('../plugins/gentelella-master/vendors/flot-spline/js/jquery.flot.spline.min.js'); ?>
    <?php echo js_asset('../plugins/gentelella-master/vendors/flot.curvedlines/curvedLines.js'); ?>
    <!-- DateJS -->
    <?php echo js_asset('../plugins/gentelella-master/vendors/DateJS/build/date.js'); ?>
    <!-- JQVMap -->
    <?php echo js_asset('../plugins/gentelella-master/vendors/jqvmap/dist/jquery.vmap.js'); ?>
    <?php echo js_asset('../plugins/gentelella-master/vendors/jqvmap/dist/maps/jquery.vmap.world.js'); ?>
    <?php echo js_asset('../plugins/gentelella-master/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js'); ?>
    <!-- bootstrap-daterangepicker -->
    <?php echo js_asset('../plugins/gentelella-master/vendors/moment/min/moment.min.js'); ?>
    <?php echo js_asset('../plugins/gentelella-master/vendors/bootstrap-daterangepicker/daterangepicker.js'); ?>

    <!-- Custom Theme Scripts -->
    <?php echo js_asset('../plugins/gentelella-master/build/js/custom.min.js'); ?>

    <!-- switchery -->
    <?php echo js_asset('../plugins/gentelella-master/vendors/switchery/dist/switchery.min.js'); ?>
<!-- *************** End Load gentelella-master Template *************** -->


    <?php echo js_asset('mapmarker.js','webconfig'); ?>

<?php
  if(isset($this->template->js_assets_footer))
  foreach ($this->template->js_assets_footer as $key => $data) {
    echo $data;
  }
?>
<?php
	if(isset($this->template->css_assets_footer))
    foreach ($this->template->css_assets_footer as $key => $data) {
      echo $data;
    }
?>
<!--
<div id="toast-container" class="toast-top-right" aria-live="polite" role="alert"><div class="toast toast-success"><div class="toast-title">หน้าต่างแจ้งเตือน</div><div class="toast-message">sdfksdkflsdkf;ksdfksdkflsdkflkl</div></div></div>
-->
<script>

$(document).ready(function(){
/*  setTimeout(function(){
    $("div.wrapper.wrapper-content").removeClass("animated");
    $("div.wrapper.wrapper-content").removeClass("fadeInRight");
  },1000);*/
});

//alert toastr message
/*if(toastr_msg!=null) {
  setTimeout(function() {
      toastr.options = {
          closeButton: true,
          progressBar: true,
          showMethod: 'slideDown',
          timeOut: 3000
      };
      switch(toastr_type) {
        case 'Success': toastr.success(toastr_msg, "หน้าต่างแจ้งเตือน"); break; 
        case 'Error': toastr.error(toastr_msg, "หน้าต่างแจ้งเตือน"); break; 
        case 'Warning': toastr.warning(toastr_msg, "หน้าต่างแจ้งเตือน"); 
      }
  }, 1500);
}*/

</script>

<script>
  
  setTimeout(function(){
    $("li.active").addClass("current-page");
    $("li.active ul").css("display",'none');
    $("li.active").removeClass("active");
  },50);

/*  $("ul.nav.side-menu li").hover(function(){
    $(this).children().show();
  });

  $("ul.nav.side-menu>li>ul.nav.child_menu").mouseout(function(){
    console.log($(this));
  });*/

</script>



