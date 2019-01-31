
<div class="right_col" role="main">
            <section class="row">
                  <div class="col-md-6 col-sm-4 col-xs-4">
                      <h3>ข้อมูลรายรับ</h3>
                  </div>
            </section>
            <br>
                            <div class="container">
                                    <div class="col-md-12 sm-12 col-xs-12">
                                            <br>
                                            <br>
                                                <div class="col-md-4 col-sm-12 col-xs-12 col-centered">
                                                    <a href="<?php echo (base_url('receive/receive_save_house')) ?>">
                                                        <button type="button" class="btn btn-nav" style="height: 110px; width:270px;" >
                                                            <img src="../assets/plugins/icons/houses.png" width="43" height="43" />
                                                            <h4>ภาษีโรงเรือนและที่ดิน</h4>
                                                        </button>
                                                    </a>
                                                </div>
                                                
                                                <div class="col-md-4 col-sm-12 col-xs-12 col-centered">
                                                    <a href="<?php echo (base_url('receive/receive_save_local')) ?>">
                                                        <button type="button" class="btn btn-nav" style="height: 110px; width:270px;">
                                                            <img src="../assets/plugins/icons/area.png" width="43" height="43" />
                                                            <h4>ภาษีบำรุงท้องที่</h4>
                                                        </button>
                                                    </a>
                                                </div>
                                               
                                                <div class="col-md-4 col-sm-12 col-xs-12 col-centered">
                                                    <a href="<?php echo (base_url('receive/receive_save_label')) ?>">
                                                        <button type="button" class="btn btn-nav" style="height: 110px; width:270px;">
                                                            <img src="../assets/plugins/icons/stand.png" width="43" height="43"  />
                                                            <h4>ภาษีป้าย</h4>
                                                        </button>
                                                    </a>
                                                </div>

                                    </div>        
                                    <div class="col-md-12 sm-12 col-xs-12">
                                            <br>
                                            <br>
                                                <div class="col-md-4 col-sm-12 col-xs-12 col-centered">
                                                    <a href="<?php echo (base_url('receive/other_tax')) ?>">
                                                        <button type="button" class="btn btn-nav" style="height: 110px; width:270px;">
                                                        <img src="../assets/plugins/icons/document.png" width="43" height="43" />
                                                            <h4>หมวดรายรับอื่น</h4>
                                                        </button>
                                                    </a>
                                                </div>

                                                <div class="col-md-4 col-sm-12 col-xs-12 col-centered">
                                                    <a href="<?php echo (base_url('receive_outside/outside')) ?>">
                                                        <button type="button" class="btn btn-nav" style="height: 110px; width:270px;">
                                                        <img src="../assets/plugins/icons/addition.png" width="43" height="43" />
                                                            <h4>รายรับนอกงบประมาณ</h4>
                                                        </button>
                                                    </a>
                                                </div>
                                    </div> 
                                </div>  
                                
                                    
</div>

<style>
/* centered columns styles */

.col-centered {
    display:inline-block;
    text-align: center;
}
*, *:before, *:after {
  /* Chrome 9-, Safari 5-, iOS 4.2-, Android 3-, Blackberry 7- */
  -webkit-box-sizing: border-box; 

  /* Firefox (desktop or Android) 28- */
  -moz-box-sizing: border-box;

  /* Firefox 29+, IE 8+, Chrome 10+, Safari 5.1+, Opera 9.5+, iOS 5+, Opera Mini Anything, Blackberry 10+, Android 4+ */
  box-sizing: border-box;
}


.btn-nav {
    text-align: center;
    border-radius: 10px;
    background-color: #2A3F54;
    color: white;
    -webkit-box-shadow: -1px 9px 40px -12px rgba(0,0,0,0.75);
    -moz-box-shadow: -1px 9px 40px -12px rgba(0,0,0,0.75);
    box-shadow: -1px 9px 40px -12px rgba(0, 0, 0, 0.75);
    margin-bottom: 40px;
}
.btn-nav:hover {
    background-color: #1ABC9C;
    color: white;
    
    -webkit-box-shadow: -1px 9px 40px -12px rgba(0,0,0,0.75);
    -moz-box-shadow: -1px 9px 40px -12px rgba(0,0,0,0.75);
    box-shadow: -1px 9px 40px -12px rgba(0, 0, 0, 0.75);
}


.btn-nav .fas {
    padding-top: 16px;
	font-size: 40px;
}
.btn-nav.active p {
    margin-bottom: 8px;
}

</style>

<script>
    $(document).ready(function(){

        $('.btn-nav').hover(
            // trigger when mouse hover
            function(){
                $(this).animate({
                    marginTop: "-=1%",
                },200);
            },

            // trigger when mouse out
            function(){
                $(this).animate({
                    marginTop: "0%"
                },200);
            }
        );
        $('.btn-nav-one').hover(
            // trigger when mouse hover
            function(){
                $(this).animate({
                    marginTop: "-=1%",
                },200);
            },

            // trigger when mouse out
            function(){
                $(this).animate({
                    marginTop: "0%"
                },200);
            }
        );
    });
</script>
