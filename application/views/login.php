<!DOCTYPE html>
<html>
    <head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/logo.png" type="image/x-icon">
    <link rel="icon" href="<?php echo base_url(); ?>assets/images/logo.png" type="image/x-icon">
	<title>ระบบบริหารและจัดการข้อมูล</title>

<!-- *************** Load gentelella-master Template *************** -->
    <!-- Bootstrap -->
    <?php echo css_asset('../plugins/gentelella-master/vendors/bootstrap/dist/css/bootstrap.min.css'); ?>

    <!-- Custom Theme Style -->
    <?php echo css_asset('../plugins/gentelella-master/build/css/custom.min.css'); ?>
<!-- *************** End Load gentelella-master Template *************** -->



<style tyle="text/css">
            /* body {
              background: url('<?php echo base_url(); ?>assets/images/bg.png');
            } */

			.skype {
			background: #fff;
			-webkit-backface-visibility: hidden;
			-moz-backface-visibility: hidden;
			-ms-backface-visibility: hidden;
			backface-visibility: hidden;
			width: 150px;
			height: 150px;
			position: relative;
			margin: 0 auto;
			border-radius: 100px;
			border: solid 15px #fff;
			animation: play 1.5s ease infinite;
			-webkit-backface-visibility: hidden;
			-moz-backface-visibility: hidden;
			-ms-backface-visibility: hidden;
			backface-visibility: hidden;
			}

</style>

    <?php echo css_asset('../admin/css/login.css'); ?>




    </head>

    <body>
        <div id="wrapper">
            <div class="login" style="background-color: inherit">
                <form action="<?php echo site_url('usm/checklogin'); ?>" method="post" class="form-signin" autocomplete="off">

                    <input type="hidden" name="" value="" />

                    <div title="" class="row logo">
                        <div class="col-xs-12 col-sm-12 text-center" style="text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;">
                            <div class="skype"><img width="120px" height="120px" src="<?php echo base_url(); ?>assets/images/logo.png"></div>
                            <h1 class='title'>NPK SYSTEMS</h1>
                            <h4 class="sec1_title">ระบบบริหารและจัดการข้อมูล</h4>
                        </div>

                        <?php if (isset($error)): ?>
                            <div class="col-md-12">
                                <div class="alert alert-danger text-center" role="alert" style="margin-bottom: 0;">
                                <?=$error; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>

                    <div class="row clearfix">

                        <div class="col-xs-12 col-sm-12 text-right">
                            &nbsp;<span id="wrn" style="font-size: 14px;"></span>
                        </div>

                        <div class="col-xs-12 col-sm-12">
                            <input type="text" class="form-control input_idcard" value="" name="pid" placeholder="เลขประจำตัวประชาชน" required autofocus="" />
                        </div>
                        <div class="col-xs-12 col-sm-12">
                            <input type="password" class="form-control" value="" name="passcode" placeholder="รหัสผ่าน" required />
                        </div>
                        <div class="col-xs-12 col-sm-12 text-center">
                            <button type="submit" class="btn btn-primary btn-lg " style="background-color: rgba(25, 43, 57, 0.72);border:0;">เข้าสู่ระบบ</button>
                        </div>
                    </div>



                    <!-- <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button> -->
                    <h2 style="font-size: 14px; color: #f3f4f7 !important;text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;" class="text-center">สำนักงานเทศบาลตำบลหนองป่าครั่ง</h2>
                    <h2 style="font-size: 14px; color: #f3f4f7 !important;text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;" class="text-center">อำเภอเมืองเชียงใหม่ เชียงใหม่ 50000</h2>
                    <input type="submit" name="bt_submit" hidden='hidden'>
                </form>
                <!-- <h2 style="font-size: 14px;color: #f3f4f7 !important;text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;" class="text-center">พบปัญหาการใช้งานระบบกรุณาติดต่อผู้ดูแลระบบ</h2>
                <h3 style="font-size: 14px;color: #f3f4f7 !important;text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;" class="text-center">© สงวนลิขสิทธ์โดย สำนักงานเทศบาลตำบลหนองป่าครั่ง พัฒนาโดย บริษัท จิ๊กซอว์ อินโนเวชั่น จำกัด</h3> -->
            </div>
        </div>
    </body>


</html>
