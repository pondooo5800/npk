
      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu">
          <nav>
            <div class="nav toggle">
              <a id="menu_toggle">
                <i class="fa fa-bars"></i>
              </a>
            </div>

            <ul class="nav navbar-nav navbar-right">
              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <?php
                  if(isset($_SESSION['user_image']) && $_SESSION['user_image']!=''){
                    $user_image = $_SESSION['user_image'];
                  }else{
                    $user_image = 'assets/plugins/gentelella-master/production/images/user.png';
                  }
                  ?>
                  <img src="<?php echo base_url().$user_image; ?>" alt=""><?php echo $_SESSION['user_name'] ?>                 <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <li>
                    <a href="#" id="data" data-id="data" data-toggle="modal" data-target="#usermodal" >
                      <i class="fa fa-user pull-right"></i> แก้ไขข้อมูลผู้ใช้งาน</a>
                  </li>
                  <li>
                    <a href="<?php echo site_url('usm/logout'); ?>">
                      <i class="fa fa-sign-out pull-right"></i> ออกจากระบบ</a>
                  </li>
                </ul>
              </li>
            </ul>
          </nav>
          <!-- Modal Popup -->
          <div class="modal fade" id="usermodal" tabindex="-1" role="dialog" aria-labelledby="usermodal" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-dialog modal-sm">
                  <div class="modal-content"  style="width:600px;height:500px;">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="usermodal">แก้ไขข้อมูลผู้ใช้งาน</h4>
                      </div>

                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-4 col-sm-4 col-xs-4 text-center">
                            <div class="form-group">
                                <label><img id="img-uploadimgInp0" src="<?php echo base_url().$user_image; ?>" alt="" style="width:120px;height:140px;"></label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-success btn-file-user">
                                            อัปโหลด <input type="file" id="user_photo_file" name="user_photo_file" class="imgInpUser">
                                            </span>
                                        </span>
                                    </div>
                                    <div id="b64" style="display:none;"></div>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group">
                              <label>เลขประจำตัวประชาชน</label>
                              <input class="form-control" type="text" id="pid" name="pid" value=""/>
                              <input class="form-control" type="hidden" id="user_id" name="user_id" value=""/>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group">
                              <label>หน่วยงานที่สังกัด</label>
                              <input class="form-control" type="text" readonly id="org_title" name="org_title" value=""/>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group">
                              <label>รหัสบัญชีผู้ใช้งาน</label>
                              <input class="form-control" type="password" id="passcode" name="passcode" value=""/>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group">
                              <label>วันเวลา ที่แก้ไขข้อมูลล่าสุด</label>
                              <div id="update_datetime"></div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group">
                              <label>คำนำหน้านาม</label>
                              <select id="user_prename" name="user_prename" class="form-control">
                                <option value="003">นาย</option>
                                <option value="005">นาง</option>
                                <option value="004">นางสาว</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group">
                              <label>ชื่อตัว</label>
                              <input class="form-control" type="text" id="user_firstname" name="user_firstname" value=""/>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group">
                              <label>ชื่อสกุล</label>
                              <input class="form-control" type="text" id="user_lastname" name="user_lastname" value=""/>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group">
                              <label>เพศ</label>
                              <div class="form-group">
                                <input type="radio" id="user_gender1"  name="user_gender" value="1"/> ชาย
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" id="user_gender2" name="user_gender" value="2"/> หญิง
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group">
                              <label>วันเดือนปีเกิด</label>
                              <input type="text" id="date_of_birth" value="" data-provide="datepicker" data-date-language="th-th" class="form-control datepicker" />
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group">
                              <label>ชื่อตำแหน่ง</label>
                              <input class="form-control" type="text" id="user_position" name="user_position" value=""/>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group">
                              <label>เบอร์โทรศัพท์ (มือถือ)</label>
                              <input class="form-control" type="text" id="tel_no" name="tel_no" value=""/>
                            </div>
                          </div>
                          <div class="col-md-8 col-sm-4 col-xs-4">
                            <div class="form-group">
                              <label>ที่อยู่อีเมล์</label>
                              <input class="form-control" type="text" id="email_addr" name="email_addr" value=""/>
                            </div>
                          </div>
                      </div>

                      <div class="modal-footer">
                          <button type="button" id="btn-save"  class="btn btn-primary" onclick="getUserUpdate();"><i class="fa fa-save"></i> บันทึก
                          </button>

                          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก
                          </button>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      <style>
      .btn-file-user {
          position: relative;
          overflow: hidden;
          margin-top: -40px;
          width: 120px;
          color: #2E2EFE;
          background-color: rgba(0,128,0, 0.3);
          border-top: 0px solid #CCC;
          border-radius: 1px 1px 10px 10px !important;
      }
      .btn-file-user input[type=file] {
          position: absolute;
          z-index: 999;
          top: 0;
          right: 0;
          min-width: 100%;
          min-height: 100%;
          text-align: right;
          filter: alpha(opacity=0);
          opacity: 0;
          outline: none;
          background: white;
          cursor: inherit;
          display: block;
      }
      #img-uploadimgInp0{
        border: 1px solid #CCC;
        border-radius: 10px;
      }
      #img-upload-user{
          width: 100%;
      }
      </style>
      <script>

      function readFile() {

        if (this.files && this.files[0]) {

          var FR= new FileReader();

          FR.addEventListener("load", function(e) {
            document.getElementById("img-uploadimgInp0").src  = e.target.result;
            document.getElementById("b64").innerHTML = e.target.result;
          });

          FR.readAsDataURL( this.files[0] );
        }

      }

      document.getElementById("user_photo_file").addEventListener("change", readFile);
      /*
      $("#user_photo_file").change(function(){
          readURL(this);
      });*/
      </script>
      <!-- /top navigation -->
