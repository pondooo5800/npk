
<div class="right_col" role="main">
  <div class="">
      <div class="page-title">
          <div class="title_left">
            <h3>บันทึกรายการ</h3>
          </div>
      </div>

          <br>
          <br>

      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_content">
              <br />

              <!-- Smart Wizard -->
              <?php if (($this->uri->segment(3))) { ?>
                <form id="individual-form" method="post" action="<?php echo base_url('receive/receive_taxadd_popup_save' . '/' . $this->uri->segment(3)); ?>" data-parsley-validate class="form-horizontal form-label-left">
              <?php

            } else { ?>
                <form id="individual-form" method="post" action="<?php echo base_url('receive/receive_taxadd_popup_save'); ?>" data-parsley-validate class="form-horizontal form-label-left">
              <?php

            } ?>

                <!-- Smart Wizard -->
                  <div id="form_tab" class="x_panel">



                      <?php if (!empty($individual[0]->tax_type_id)) { // have  data individual
                        if ($individual[0]->tax_type_id == 1) { ?>
                          <div class="" role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                              <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">บุคคลธรรมดา</a>
                              </li>
                            </ul>
                            <div id="myTabContent" class="tab-content">
                              <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                <div id="step-1">
                                  <h2 class="StepTitle">&nbsp;</h2>

                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-3 col-xs-12" >
                                          เลขประจำตัวผู้เสียภาษี <span class="required" style="color:red">*</span>
                                        </label>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <input name="individual_number[0]" type="text" value="<?php echo @$individual[0]->individual_number; ?>" placeholder="เลขประจำตัว 10 หรือ 13 หลัก" id="tab_1" class="form-control col-md-7 col-xs-12" maxlength="13" onKeyUp="if(this.value*1!=this.value) this.value='' ;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-md-4 col-sm-3 col-xs-12" >
                                        รหัสชื่อ
                                      </label>
                                      <div class="col-md-4 col-sm-6 col-xs-12">
                                          <input type="text" name="code_name[0]"  type="text" value="<?php echo @$individual[0]->code_name; ?>" placeholder="ระบุรหัสชื่อ" id="tab_1" class="form-control col-md-7 col-xs-12">
                                      </div>
                                    </div>
                                    <hr/>
                                    <div class="row">
                                      <div class="col-md-2">
                                        <label>ข้อมูลส่วนบุคคล</label>
                                      </div>
                                    </div>
                                    <br>
                                    <div class="form-group type-value" id="" style="display:block;margin-bottom: 0px;" >
                                      <div class="row">
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                          <div class="form-group">
                                                <label >คำนำหน้าชื่อ</label> <span class="required" style="color:red">*</span>
                                                <select name="individual_prename[0]" class="form-control " type="text" id="type_tax">
                                                  <option selected disabled>เลือก</option>
                                                    <?php foreach ($prename as $key => $value) {
                                                      $prename = '';
                                                      if (@$individual[0]->individual_prename == $value->prename_th) {
                                                        $prename = 'selected';
                                                      }
                                                      ?>
                                                      <option <?php echo $prename; ?> value="<?php echo $value->prename_th; ?>"><?php echo $value->prename_th; ?></option>
                                                    <?php

                                                  } ?>
                                                </select>
                                          </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                          <div class="form-group">
                                            <label>ชื่อ <span class="required" style="color:red">*</span>
                                            </label>
                                            <div >
                                                <input type="text" value="<?php echo @$individual[0]->individual_firstname; ?>" placeholder="ระบุชื่อ" name="individual_firstname[0]" class="form-control col-md-7 col-xs-12">
                                            </div>

                                          </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                          <div class="form-group">
                                            <label for="middle-name" class="" for="last_name">นามสกุล
                                            </label>
                                            <div >
                                                <input type="text" value="<?php echo @$individual[0]->individual_lastname; ?>" placeholder="ระบุนามสกุล" name="individual_lastname[0]" class="form-control col-md-7 col-xs-12">
                                            </div>

                                          </div>
                                        </div>


                                      </div>


                                      <div class="row">
                                        <div class="col-md-4 col-sm-6 col-xs-4">
                                            <div class="form-group">
                                              <label  >เบอร์โทรศัพท์
                                              </label>
                                              <div >
                                                  <input type="text" value="<?php echo @$individual[0]->individual_phone; ?>" name="individual_phone[0]" placeholder="ระบุเบอร์โทรศัพท์" id="id_tax" class="form-control col-md-7 col-xs-12" maxlength="10" onKeyUp="if(this.value*1!=this.value) this.value='' ;">
                                              </div>

                                            </div>
                                          </div>
                                        <div class="col-md-2 col-sm-3 col-xs-4">
                                          <label >เลขที่บ้าน <span class="required" style="color:red">*</span>
                                          </label>
                                          <div >
                                              <input type="text" name="individual_address[0]" value="<?php echo @$individual[0]->individual_address; ?>" placeholder="ระบุเลขที่บ้าน" id="id_tax" class="form-control col-md-7 col-xs-12">
                                          </div>

                                        </div>
                                        <div class="col-md-2 col-sm-3 col-xs-4">
                                          <label  >หมู่ <span class="required" style="color:red">*</span>
                                            </label>
                                            <div>
                                                <input type="text" name="individual_village[0]" value="<?php echo @$individual[0]->individual_village; ?>" placeholder="ระบุหมู่"id="id_tax" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-3 col-xs-4">
                                          <label  >ซอย/ตรอก
                                            </label>
                                            <div>
                                                <input type="text" placeholder="" name="individual_lane[0]" value="<?php echo @$individual[0]->individual_lane; ?>" id="id_tax" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-3 col-xs-4">
                                          <label  >ถนน
                                            </label>
                                            <div>
                                                <input type="text" placeholder=""id="id_tax" name="individual_road[0]" value="<?php echo @$individual[0]->individual_road; ?>" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>


                                      </div>

                                      <div class="row">
                                        <div class="col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 10px;">
                                          <label>จังหวัด <span class="required" style="color:red">*</span>
                                          </label>
                                          <div>
                                              <select style="width: 100%;" class="form-control" name="individual_provice[0]" id="province">
                                                <option value="" >เลือก</option>
                                                <?php foreach ($province as $key => $value) {
                                                  $data_province = '';
                                                  if (@$individual[0]->individual_provice == $value->area_code) {
                                                    $data_province = 'selected';
                                                  }
                                                  ?>
                                                  <option <?php echo $data_province; ?> value="<?php echo $value->area_code; ?>"><?php echo $value->area_name_th; ?> </option>
                                                <?php

                                              } ?>
                                              </select>
                                          </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 10px;">
                                            <label >อำเภอ <span class="required" style="color:red">*</span>
                                            </label>
                                            <div>
                                              <select style="width: 100%;" class="form-control" name="individual_district[0]" id="district">
                                                <option value=""  >เลือก</option>
                                                  <?php foreach ($amphur as $key => $value) {
                                                    $send_district = '';
                                                    if (@$individual[0]->individual_district == $value->area_code) {
                                                      $send_district = 'selected';
                                                    }

                                                    ?>
                                                    <option <?php echo $send_district; ?> value="<?php echo $value->area_code; ?>"><?php echo $value->area_name_th; ?> </option>
                                                  <?php

                                                } ?>
                                              </select>
                                            </div>
                                          </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 10px;">
                                            <label >ตำบล <span class="required" style="color:red">*</span>
                                            </label>
                                            <div >
                                              <select style="width: 100%;" class="form-control" name="individual_subdistrict[0]" id="subdistrict">
                                                <option value=""  >เลือก</option>
                                                  <?php foreach ($tambon as $key => $value) {
                                                    $send_district = '';
                                                    if (@$individual[0]->individual_subdistrict == $value->area_code) {
                                                      $send_district = 'selected';
                                                    }

                                                    ?>
                                                    <option <?php echo $send_district; ?> value="<?php echo $value->area_code; ?>"><?php echo $value->area_name_th; ?> </option>
                                                  <?php

                                                } ?>
                                              </select>
                                            </div>
                                          </div>



                                      </div>
                                      <div class="row">
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <label  >รหัสไปรษณีย์ <span class="required" style="color:red">*</span>
                                            </label>
                                            <div >
                                                <input type="text" name="individual_zipcode[0]" value="<?php echo @$individual[0]->individual_zipcode; ?>" class="form-control col-md-7 col-xs-12" maxlength="5" onKeyUp="if(this.value*1!=this.value) this.value='' ;" >
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <label  >ชื่อร้านค้า/องค์กร/หน่วยงาน (ถ้ามี)
                                            </label>
                                            <div >
                                                <input type="text" name="individual_business_name[0]"  value="<?php echo @$individual[0]->individual_business_name; ?>" class="form-control col-md-7 col-xs-12" >
                                            </div>
                                        </div>
                                      </div>

                                    </div>

                                    <hr/>
                                    <div class="row">
                                      <div class="col-md-2">
                                        <label>ที่อยู่จัดส่ง</label>
                                      </div>
                                      <div class="col-md-3">
                                        <p>
                                          <input type="radio"  <?php echo (empty($individual[0]->individual_send_address)) ? 'checked' : ''; ?> class="flat" name="individual_adr" id="individual_adr" value="0" checked=""  /> ที่อยู่เดิม &nbsp;
                                          <input type="radio" <?php echo (!empty($individual[0]->individual_send_address)) ? 'checked' : ''; ?> class="flat" name="individual_adr" id="individual_adr2" value="1" /> เพิ่มที่อยู่
                                        </p>
                                      </div>
                                    </div>
                                    <br/>
                                    <?php $display = 'display:none;';
                                    if (!empty($individual[0]->individual_send_address)) {
                                      $display = 'display:block';
                                    } ?>
                                    <div class="form-group type-value" id="individual_tab1" style="<?= $display; ?>margin-bottom: 0px;" >

                                      <div class="row">

                                        <div class="col-md-3 col-sm-6 col-xs-6" style="margin-bottom: 10px;">
                                          <label >เลขที่บ้าน
                                          </label>
                                          <div >
                                              <input type="text" placeholder="ระบุเลขที่บ้าน" name="individual_send_address[0]" value="<?php echo @$individual[0]->individual_send_address; ?>" id="id_tax" class="form-control col-md-7 col-xs-12">
                                          </div>

                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-6" style="margin-bottom: 10px;">
                                          <label  >หมู่
                                            </label>
                                            <div>
                                                <input type="text" placeholder="ระบุหมู่" id="id_tax" name="individual_send_village[0]" value="<?php echo @$individual[0]->individual_send_village; ?>" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-6" style="margin-bottom: 10px;">
                                          <label  >ซอย/ตรอก
                                            </label>
                                            <div>
                                                <input type="text" placeholder=""id="id_tax" name="individual_send_lane[0]" value="<?php echo @$individual[0]->individual_send_lane; ?>" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-6" style="margin-bottom: 10px;">
                                          <label  >ถนน
                                            </label>
                                            <div>
                                                <input type="text" placeholder=""id="id_tax" name="individual_send_road[0]" value="<?php echo @$individual[0]->individual_send_road; ?>" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>


                                      </div>

                                      <div class="row">
                                        <div class="col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 10px;">
                                          <label>จังหวัด
                                          </label>
                                          <div>
                                              <select style="width: 100%;" class="form-control" name="individual_send_province[0]" id="province_send">
                                                <option value="" >เลือก</option>
                                                <?php foreach ($province as $key => $value) {
                                                  $data_province = '';
                                                  if (@$individual[0]->individual_send_province == $value->area_code) {
                                                    $data_province = 'selected';
                                                  }

                                                  ?>
                                                  <option <?php echo $data_province; ?> value="<?php echo $value->area_code; ?>"><?php echo $value->area_name_th; ?> </option>
                                                <?php

                                              } ?>
                                              </select>
                                          </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 10px;">
                                            <label >อำเภอ
                                            </label>
                                            <div>
                                              <select style="width: 100%;" class="form-control" name="individual_send_district[0]" id="district_send">
                                                <option value=""  >เลือก</option>
                                                <?php foreach ($send_amphur as $key => $value) {
                                                  $send_district = '';
                                                  if (@$individual[0]->individual_send_district == $value->area_code) {
                                                    $send_district = 'selected';
                                                  }

                                                  ?>
                                                  <option <?php echo $send_district; ?> value="<?php echo $value->area_code; ?>"><?php echo $value->area_name_th; ?> </option>
                                                <?php

                                              } ?>
                                              </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 10px;">
                                            <label >ตำบล
                                            </label>
                                            <div >
                                              <select style="width: 100%;" class="form-control" name="individual_send_subdistrict[0]"  id="subdistrict_send">
                                                <option value=""  >เลือก</option>
                                                <?php foreach ($send_tambon as $key => $value) {
                                                  $subdistrict = '';
                                                  if (@$individual[0]->individual_send_subdistrict == $value->area_code) {
                                                    $subdistrict = 'selected';
                                                  }

                                                  ?>
                                                  <option <?php echo $subdistrict; ?> value="<?php echo $value->area_code; ?>"><?php echo $value->area_name_th; ?> </option>
                                                <?php

                                              } ?>
                                              </select>
                                            </div>
                                          </div>



                                      </div>
                                      <div class="row">
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                              <label  >รหัสไปรษณีย์
                                              </label>
                                              <div >
                                                  <input type="text" name="individual_send_zipcode[0]" placeholder="ระบุรหัสไปรษณีย์" value="<?php echo @$individual[0]->individual_send_zipcode; ?>"  class="form-control col-md-7 col-xs-12" maxlength="5" onKeyUp="if(this.value*1!=this.value) this.value='' ;">
                                              </div>
                                        </div>
                                      </div>
                                      <br/>


                                    </div>

                                </div>
                              </div>
                            </div>
                          </div>


                      <?php

                    } else { ?>
                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                              <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">นิติบุคคล</a>
                              </li>
                            </ul>
                            <div id="myTabContent" class="tab-content">
                              <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                <div id="step-2">
                                  <h2 class="StepTitle">&nbsp;</h2>
                                  <div class="row">
                                      <div class="col-md-2">
                                        <label>ข้อมูลนิติบุคคล</label>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-4 col-sm-3 col-xs-12" >
                                        เลขประจำตัวผู้เสียภาษี <span class="required" style="color:red">*</span>
                                      </label>
                                      <div class="col-md-4 col-sm-6 col-xs-12">
                                          <input type="text" name="individual_number[1]"  value="<?php echo @$individual[0]->individual_number; ?>" placeholder="เลขประจำตัว 10 หรือ 13 หลัก" id="tab_2" class="form-control col-md-7 col-xs-12" maxlength="13" onKeyUp="if(this.value*1!=this.value) this.value='' ;">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-4 col-sm-3 col-xs-12" >
                                        รหัสชื่อ
                                      </label>
                                      <div class="col-md-4 col-sm-6 col-xs-12">
                                          <input type="text" name="code_name[1]"  type="text" value="<?php echo @$individual[0]->code_name; ?>" placeholder="ระบุรหัสชื่อ" id="tab_2" class="form-control col-md-7 col-xs-12">
                                      </div>
                                  </div>

                                  <hr/>


                                  <div class="form-group type-value" style=" display:block;margin-bottom: 0px;" >
                                    <div class="row">
                                      <div class="col-md-4 col-sm-6 col-xs-12">
                                        <label >ชื่อบริษัท <span class="required" style="color:red">*</span>
                                          </label>
                                          <div >
                                              <input type="text" placeholder="ระบุชื่อบริษัท" id="name_tax" name="individual_firstname[1]" value="<?php echo @$individual[0]->individual_firstname; ?>" class="form-control col-md-7 col-xs-12">
                                          </div>
                                      </div>


                                      <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                          <label  >เบอร์โทรศัพท์
                                          </label>
                                          <div >
                                              <input type="text" placeholder="ระบุเบอร์โทรศัพท์" nane="individual_phone[1]" value="<?php echo @$individual[0]->individual_phone; ?>" class="form-control col-md-7 col-xs-12" >
                                          </div>

                                        </div>
                                      </div>

                                      <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="row">
                                              <div class="col-md-6 col-sm-6 col-xs-12">
                                              <label >เลขที่บ้าน <span class="required" style="color:red">*</span>
                                              </label>
                                              <div >
                                                  <input type="text" placeholder="ระบุเลขที่บ้าน" name="individual_address[1]" value="<?php echo @$individual[0]->individual_address; ?>" id="id_tax" class="form-control col-md-7 col-xs-12">
                                              </div>

                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                              <label  >หมู่ <span class="required" style="color:red">*</span>
                                                </label>
                                                <div>
                                                    <input type="text" placeholder="ระบุหมู่" name="individual_village[1]" value="<?php echo @$individual[0]->individual_village; ?>" id="id_tax" class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>
                                        </div>

                                      </div>
                                    </div>


                                    <div class="row">

                                      <div class="col-md-2 col-sm-3 col-xs-4" style="margin-bottom: 10px;">
                                        <label  >ซอย/ตรอก
                                          </label>
                                          <div>
                                              <input type="text" placeholder="" name="individual_lane[1]" id="id_tax" value="<?php echo @$individual[0]->individual_lane; ?>" class="form-control col-md-7 col-xs-12">
                                          </div>
                                      </div>
                                      <div class="col-md-2 col-sm-3 col-xs-4" style="margin-bottom: 10px;">
                                        <label  >ถนน
                                          </label>
                                          <div>
                                              <input type="text" placeholder="" name="individual_road[1]" id="id_tax" value="<?php echo @$individual[0]->individual_road; ?>" class="form-control col-md-7 col-xs-12">
                                          </div>
                                      </div>


                                      <div class="col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 10px;">
                                        <label>จังหวัด <span class="required" style="color:red">*</span>
                                        </label>
                                        <div>
                                            <select style="width: 100%;" class="form-control" name="individual_provice[1]" id="province">
                                                  <option value="" >เลือก</option>
                                              <?php foreach ($province as $key => $value) {
                                                $data_province = '';
                                                if (@$individual[0]->individual_provice == $value->area_code) {
                                                  $data_province = 'selected';
                                                }

                                                ?>
                                                <option <?php echo $data_province; ?> value="<?php echo $value->area_code; ?>"><?php echo $value->area_name_th; ?> </option>
                                              <?php

                                            } ?>
                                            </select>
                                        </div>
                                      </div>
                                      <div class="col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 10px;">
                                          <label >อำเภอ <span class="required" style="color:red">*</span>
                                          </label>
                                          <div>
                                            <select style="width: 100%;" class="form-control" name="individual_district[1]" id="district">
                                                <option value=""  >เลือก</option>
                                                  <?php foreach ($amphur as $key => $value) {
                                                    $send_district = '';
                                                    if (@$individual[0]->individual_district == $value->area_code) {
                                                      $send_district = 'selected';
                                                    }

                                                    ?>
                                                    <option <?php echo $send_district; ?> value="<?php echo $value->area_code; ?>"><?php echo $value->area_name_th; ?> </option>
                                                  <?php

                                                } ?>
                                            </select>
                                          </div>
                                      </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                          <label >ตำบล <span class="required" style="color:red">*</span>
                                          </label>
                                          <div >
                                            <select style="width: 100%;" class="form-control" name="individual_subdistrict[1]" id="subdistrict">
                                              <option value=""  >เลือก</option>
                                                <?php foreach ($tambon as $key => $value) {
                                                  $subdistrict = '';
                                                  if (@$individual[0]->individual_subdistrict == $value->area_code) {
                                                    $subdistrict = 'selected';
                                                  }

                                                  ?>
                                                  <option <?php echo $subdistrict; ?> value="<?php echo $value->area_code; ?>"><?php echo $value->area_name_th; ?> </option>
                                                <?php

                                              } ?>
                                            </select>
                                          </div>
                                        </div>

                                      <div class="col-md-4 col-sm-6 col-xs-12">
                                        <label  >รหัสไปรษณีย์ <span class="required" style="color:red">*</span>
                                        </label>
                                        <div >
                                            <input type="text" name="individual_zipcode[1]" value="<?php echo @$individual[0]->individual_zipcode; ?>" class="form-control col-md-7 col-xs-12" maxlength="5" onKeyUp="if(this.value*1!=this.value) this.value='' ;">
                                        </div>
                                      </div>

                                    </div>

                                  </div>

                                  <hr/>
                                  <div class="row">
                                    <div class="col-md-2">
                                      <label>ที่อยู่จัดส่ง</label>
                                    </div>
                                    <div class="col-md-3">
                                      <p>
                                        <input <?php echo (empty($individual[0]->individual_send_address)) ? 'checked' : ''; ?> type="radio" class="flat" name="individual_adr1"  value="0"   /> ที่อยู่เดิม &nbsp;
                                        <input <?php echo (!empty($individual[0]->individual_send_address)) ? 'checked' : ''; ?> type="radio" class="flat" name="individual_adr1" id="individual_adr12" value="1" /> เพิ่มที่อยู่
                                      </p>
                                    </div>

                                  </div>
                                  <br/>
                                  <?php $display = 'display:none;';
                                  if (!empty($individual[0]->individual_send_address)) {

                                    $display = 'display:block';
                                  } ?>
                                  <div class="form-group type-value" id="individual_tab2"style="<?= $display; ?> margin-bottom: 0px;" >

                                    <div class="row">

                                      <div class="col-md-3 col-sm-6 col-xs-6" style="margin-bottom: 10px;">
                                        <label >เลขที่บ้าน
                                        </label>
                                        <div >
                                            <input type="text" placeholder="" name="individual_send_address[1]" value="<?php echo @$individual[0]->individual_send_address; ?>" id="id_tax" class="form-control col-md-7 col-xs-12">
                                        </div>

                                      </div>
                                      <div class="col-md-3 col-sm-3 col-xs-6" style="margin-bottom: 10px;">
                                        <label  >หมู่
                                          </label>
                                          <div>
                                              <input type="text" placeholder="" id="id_tax" name="individual_send_village[1]" value="<?php echo @$individual[0]->individual_send_village; ?>" class="form-control col-md-7 col-xs-12">
                                          </div>
                                      </div>
                                      <div class="col-md-3 col-sm-3 col-xs-6" style="margin-bottom: 10px;">
                                        <label  >ซอย/ตรอก
                                          </label>
                                          <div>
                                              <input type="text" placeholder=""id="id_tax" name="individual_send_lane[1]" value="<?php echo @$individual[0]->individual_send_lane; ?>" class="form-control col-md-7 col-xs-12">
                                          </div>
                                      </div>
                                      <div class="col-md-3 col-sm-3 col-xs-6" style="margin-bottom: 10px;">
                                        <label  >ถนน
                                          </label>
                                          <div>
                                              <input type="text" placeholder=""id="id_tax" name="individual_send_road[1]" value="<?php echo @$individual[0]->individual_send_road; ?>" class="form-control col-md-7 col-xs-12">
                                          </div>
                                      </div>


                                    </div>

                                    <div class="row">
                                      <div class="col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 10px;">
                                        <label>จังหวัด
                                        </label>
                                        <div>
                                            <select style="width: 100%;" class="form-control" name="individual_send_province[1]" id="province_send">
                                                  <option value="" >เลือก</option>
                                              <?php foreach ($province as $key => $value) {
                                                $data_province = '';
                                                if (@$individual[0]->individual_send_province == $value->area_code) {
                                                  $data_province = 'selected';
                                                }
                                                ?>
                                                <option <?php echo $data_province; ?> value="<?php echo $value->area_code; ?>"><?php echo $value->area_name_th; ?> </option>
                                              <?php

                                            } ?>
                                            </select>
                                        </div>
                                      </div>
                                      <div class="col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 10px;">
                                          <label >อำเภอ
                                          </label>
                                          <div>
                                            <select style="width: 100%;" class="form-control" name="individual_send_district[1]" id="district_send">
                                              <option value=""  >เลือก</option>
                                                <?php foreach ($send_amphur as $key => $value) {
                                                  $subdistrict = '';
                                                  if (@$individual[0]->individual_send_district == $value->area_code) {
                                                    $subdistrict = 'selected';
                                                  }

                                                  ?>
                                                  <option <?php echo $subdistrict; ?> value="<?php echo $value->area_code; ?>"><?php echo $value->area_name_th; ?> </option>
                                                <?php

                                              } ?>
                                            </select>
                                          </div>
                                      </div>
                                      <div class="col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 10px;">
                                          <label >ตำบล
                                          </label>
                                          <div >
                                            <select  style="width: 100%;" class="form-control" name="individual_send_subdistrict[1]" id="subdistrict_send">
                                              <option value=""  >เลือก</option>
                                                <?php foreach ($send_tambon as $key => $value) {
                                                  $subdistrict = '';
                                                  if (@$individual[0]->individual_send_subdistrict == $value->area_code) {
                                                    $subdistrict = 'selected';
                                                  }

                                                  ?>
                                                  <option <?php echo $subdistrict; ?> value="<?php echo $value->area_code; ?>"><?php echo $value->area_name_th; ?> </option>
                                                <?php

                                              } ?>
                                            </select>
                                          </div>
                                      </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                              <label  >รหัสไปรษณีย์
                                              </label>
                                              <div >
                                                  <input type="text" name="individual_send_zipcode[1]" value="<?php echo @$individual[0]->individual_send_zipcode; ?>" class="form-control col-md-7 col-xs-12" >
                                              </div>
                                        </div>
                                      </div>
                                    <br/>


                                  </div>



                                </div>
                              </div>
                            </div>
                          </div>

                      <?php

                    }
                  } else { //don't have data ?>

                  <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="tab1" role="tab" data-toggle="tab" aria-expanded="true">บุคคลธรรมดา</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="tab2" data-toggle="tab" aria-expanded="false">นิติบุคคล</a>
                        </li>
                      </ul>
                      <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                          <div id="step-1">
                            <h2 class="StepTitle">&nbsp;</h2>

                              <div class="form-group">
                                  <label class="control-label col-md-4 col-sm-3 col-xs-12" >
                                    เลขประจำตัวผู้เสียภาษี <span class="required" style="color:red">*</span>
                                  </label>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                      <input name="individual_number[0]" type="text" placeholder="เลขประจำตัว 10 หลัก หรือ 13 หลัก" id="tab_1" class="form-control col-md-7 col-xs-12" maxlength="13" onKeyUp="if(this.value*1!=this.value) this.value='' ;" >
                                  </div>
                              </div>
                              <div class="form-group">
                                      <label class="control-label col-md-4 col-sm-3 col-xs-12" >
                                        รหัสชื่อ
                                      </label>
                                      <div class="col-md-4 col-sm-6 col-xs-12">
                                          <input type="text" name="code_name[0]"  type="text" placeholder="ระบุรหัสชื่อ" id="tab_1" class="form-control col-md-7 col-xs-12">
                                      </div>
                              </div>

                              <hr/>

                              <div class="row">
                                <div class="col-md-2">
                                  <label>ข้อมูลส่วนบุคคล</label>
                                </div>
                              </div>
                              <br>
                              <div class="form-group type-value" id="" style="display:block;margin-bottom: 0px;" >
                                <div class="row">
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                          <label >คำนำหน้าชื่อ <span class="required" style="color:red">*</span></label>
                                          <select name="individual_prename[0]" class="form-control " type="text" id="type_tax">
                                              <?php foreach ($prename as $key => $value) { ?>
                                                <option value="<?php echo $value->prename_th; ?>"><?php echo $value->prename_th; ?></option>
                                              <?php

                                            } ?>
                                          </select>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                      <label>ชื่อ <span class="required" style="color:red">*</span>
                                      </label>
                                      <div >
                                          <input type="text" placeholder="ระบุชื่อ" id="name_tax" name="individual_firstname[0]" class="form-control col-md-7 col-xs-12">
                                      </div>

                                    </div>
                                  </div>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                      <label>นามสกุล <span class="required" style="color:red">*</span>
                                      </label>
                                      <div >
                                          <input type="text" placeholder="ระบุนามสกุล" id="name_tax" name="individual_lastname[0]" class="form-control col-md-7 col-xs-12">
                                      </div>

                                    </div>
                                  </div>


                                </div>


                                <div class="row">
                                  <div class="col-md-4 col-sm-6 col-xs-4">
                                      <div class="form-group">
                                        <label  >เบอร์โทรศัพท์
                                        </label>
                                        <div >
                                            <input type="text" name="individual_phone[0]" placeholder="ระบุเบอร์โทรศัพท์" id="id_tax" class="form-control col-md-7 col-xs-12" maxlength="10" onKeyUp="if(this.value*1!=this.value) this.value='' ;" >
                                        </div>

                                      </div>
                                    </div>
                                  <div class="col-md-2 col-sm-3 col-xs-4">
                                    <label >เลขที่บ้าน <span class="required" style="color:red">*</span>
                                    </label>
                                    <div >
                                        <input type="text" name="individual_address[0]" placeholder="ระบุเลขที่บ้าน" id="id_tax" class="form-control col-md-7 col-xs-12">
                                    </div>

                                  </div>
                                  <div class="col-md-2 col-sm-3 col-xs-4">
                                    <label  >หมู่ <span class="required" style="color:red">*</span>
                                      </label>
                                      <div>
                                          <input type="text" name="individual_village[0]" placeholder="ระบุหมู่"id="id_tax" class="form-control col-md-7 col-xs-12">
                                      </div>
                                  </div>
                                  <div class="col-md-2 col-sm-3 col-xs-4">
                                    <label  >ซอย/ตรอก
                                      </label>
                                      <div>
                                          <input type="text" placeholder="" name="individual_lane[0]" id="id_tax" class="form-control col-md-7 col-xs-12">
                                      </div>
                                  </div>
                                  <div class="col-md-2 col-sm-3 col-xs-4">
                                    <label  >ถนน
                                      </label>
                                      <div>
                                          <input type="text" placeholder=""id="id_tax" name="individual_road[0]" class="form-control col-md-7 col-xs-12">
                                      </div>
                                  </div>


                                </div>

                                <div class="row">
                                  <div class="col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 10px;">
                                    <label>จังหวัด <span class="required" style="color:red">*</span>
                                    </label>
                                    <div>
                                        <select style="width: 100%;" class="form-control" name="individual_provice[0]" id="province">
                                              <option value="" >เลือก</option>
                                          <?php foreach ($province as $key => $value) { ?>
                                            <option value="<?php echo $value->area_code; ?>"><?php echo $value->area_name_th; ?> </option>
                                          <?php

                                        } ?>
                                        </select>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 10px;">
                                      <label >อำเภอ <span class="required" style="color:red">*</span>
                                      </label>
                                      <div>
                                        <select  style="width: 100%;"class="form-control" name="individual_district[0]" id="district">
                                          <option value=""  >เลือก</option>
                                        </select>
                                      </div>
                                    </div>
                                  <div class="col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 10px;">
                                      <label >ตำบล <span class="required" style="color:red">*</span>
                                      </label>
                                      <div >
                                        <select style="width: 100%;" class="form-control" name="individual_subdistrict[0]" id="subdistrict">
                                          <option value=""  >เลือก</option>
                                        </select>
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                      <label  >รหัสไปรษณีย์ <span class="required" style="color:red">*</span>
                                      </label>
                                      <div >
                                          <input type="text" name="individual_zipcode[0]" value="" placeholder="ระบุรหัสไปรษณีย์" class="form-control col-md-7 col-xs-12" maxlength="5" onKeyUp="if(this.value*1!=this.value) this.value='' ;">
                                      </div>
                                  </div>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                      <label  >ชื่อร้านค้า/องค์กร/หน่วยงาน (ถ้ามี)
                                      </label>
                                      <div >
                                          <input type="text" name="individual_business_name[0]" value="" class="form-control col-md-7 col-xs-12" >
                                      </div>
                                  </div>
                                </div>

                              </div>

                              <hr/>
                              <div class="row">
                                <div class="col-md-2">
                                  <label>ที่อยู่จัดส่ง</label>
                                </div>
                                <div class="col-md-3">
                                  <p>
                                    <input type="radio" class="flat" name="individual_adr_1" id="individual_adr_11" value="0" checked="checked"  /> ที่อยู่เดิม &nbsp;
                                    <input type="radio" class="flat" name="individual_adr_1" id="individual_adr_12" value="1" /> เพิ่มที่อยู่
                                  </p>
                                </div>

                              </div>
                              <br/>
                              <div class="form-group type-value" id="individualadd_tab1" style="display:none;" >

                                <div class="row">

                                  <div class="col-md-3 col-sm-6 col-xs-6" style="margin-bottom: 10px;">
                                    <label >เลขที่บ้าน
                                    </label>
                                    <div >
                                        <input type="text" placeholder="ระบุเลขที่บ้าน" name="individual_send_address[0]" id="id_tax" class="form-control col-md-7 col-xs-12">
                                    </div>

                                  </div>
                                  <div class="col-md-3 col-sm-3 col-xs-6" style="margin-bottom: 10px;">
                                    <label  >หมู่
                                      </label>
                                      <div>
                                          <input type="text" placeholder="ระบุหมู่" id="id_tax" name="individual_send_village[0]" class="form-control col-md-7 col-xs-12">
                                      </div>
                                  </div>
                                  <div class="col-md-3 col-sm-3 col-xs-6" style="margin-bottom: 10px;">
                                    <label  >ซอย/ตรอก
                                      </label>
                                      <div>
                                          <input type="text" placeholder=""id="id_tax" name="individual_send_lane[0]" class="form-control col-md-7 col-xs-12">
                                      </div>
                                  </div>
                                  <div class="col-md-3 col-sm-3 col-xs-6" style="margin-bottom: 10px;">
                                    <label  >ถนน
                                      </label>
                                      <div>
                                          <input type="text" placeholder=""id="id_tax" name="individual_send_road[0]" class="form-control col-md-7 col-xs-12">
                                      </div>
                                  </div>


                                </div>

                                <div class="row">
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <label>จังหวัด
                                    </label>
                                    <div>
                                        <select style="width: 100%;" class="form-control" name="individual_send_province[0]" id="province_send">
                                              <option value="" >เลือก</option>
                                          <?php foreach ($province as $key => $value) { ?>
                                            <option value="<?php echo $value->area_code; ?>"><?php echo $value->area_name_th; ?> </option>
                                          <?php

                                        } ?>
                                        </select>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                      <label >อำเภอ
                                      </label>
                                      <div>
                                        <select style="width: 100%;" class="form-control" name="individual_send_district[0]" id="district_send">
                                          <option value=""  >เลือก</option>
                                        </select>
                                      </div>
                                  </div>
                                  <div class="col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 10px;">
                                      <label >ตำบล
                                      </label>
                                      <div >
                                        <select style="width: 100%;" class="form-control" name="individual_send_subdistrict[0]" id="subdistrict_send">
                                          <option value=""  >เลือก</option>
                                        </select>
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 10px;">
                                        <label  >รหัสไปรษณีย์
                                        </label>
                                        <div >
                                            <input type="text" placeholder="ระบุรหัสไปรษณีย์"  name="individual_send_zipcode[0]" value="" class="form-control col-md-7 col-xs-12" maxlength="5" onKeyUp="if(this.value*1!=this.value) this.value='' ;">
                                        </div>
                                  </div>
                                </div>
                                <br/>


                              </div>

                          </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                          <div id="step-2">
                              <h2 class="StepTitle">&nbsp;</h2>

                              <div class="form-group">
                                  <label class="control-label col-md-4 col-sm-3 col-xs-12" >
                                    เลขประจำตัวผู้เสียภาษี <span class="required" style="color:red">* </span>
                                  </label>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                      <input type="text" placeholder="เลขประจำตัว 10 หลัก หรือ 13 หลัก" id="tab_2" name="individual_number[1]" class="form-control col-md-7 col-xs-12" maxlength="13" onKeyUp="if(this.value*1!=this.value) this.value='' ;">
                                  </div>
                              </div>
                              <div class="form-group">
                                      <label class="control-label col-md-4 col-sm-3 col-xs-12" >
                                        รหัสชื่อ
                                      </label>
                                      <div class="col-md-4 col-sm-6 col-xs-12">
                                          <input type="text" name="code_name[1]"  type="text" placeholder="ระบุรหัสชื่อ" id="tab_2" class="form-control col-md-7 col-xs-12">
                                      </div>
                                    </div>

                              <hr/>

                              <div class="row">
                                <div class="col-md-2">
                                  <label>ข้อมูลนิติบุคคล</label>
                                </div>
                              </div>
                              <br/>


                              <div class="form-group type-value" style=" display:block;margin-bottom: 0px;" >
                                <div class="row">
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <label>ชื่อบริษัท <span class="required" style="color:red">*</span>
                                      </label>
                                      <div >
                                          <input type="text" placeholder="ระบุชื่อบริษัท" id="name_tax" name="individual_firstname[1]" class="form-control col-md-7 col-xs-12">
                                      </div>
                                  </div>


                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                      <label  >เบอร์โทรศัพท์
                                      </label>
                                      <div >
                                          <input type="text" placeholder="ระบุเบอร์โทรศัพท์" nane="individual_phone[1]" class="form-control col-md-7 col-xs-12" maxlength="10" onKeyUp="if(this.value*1!=this.value) this.value='' ;">
                                      </div>

                                    </div>
                                  </div>

                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="row">
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                          <label >เลขที่บ้าน <span class="required" style="color:red">*</span>
                                          </label>
                                          <div >
                                              <input type="text" placeholder="ระบุเลขที่บ้าน" name="individual_address[1]" id="id_tax" class="form-control col-md-7 col-xs-12">
                                          </div>

                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                          <label  >หมู่ <span class="required" style="color:red">*</span>
                                            </label>
                                            <div>
                                                <input type="text" placeholder="ระบุหมู่" name="individual_village[1]" id="id_tax" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                    </div>

                                  </div>
                                </div>


                                <div class="row">

                                  <div class="col-md-2 col-sm-3 col-xs-4" style="margin-bottom: 10px;">
                                    <label  >ซอย/ตรอก
                                      </label>
                                      <div>
                                          <input type="text" placeholder="" name="individual_lane[1]" id="id_tax" class="form-control col-md-7 col-xs-12">
                                      </div>
                                  </div>
                                  <div class="col-md-2 col-sm-3 col-xs-4" style="margin-bottom: 10px;">
                                    <label  >ถนน
                                      </label>
                                      <div>
                                          <input type="text" placeholder="" name="individual_road[1]" id="id_tax" class="form-control col-md-7 col-xs-12">
                                      </div>
                                  </div>


                                  <div class="col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 10px;">
                                    <label>จังหวัด <span class="required" style="color:red">*</span>
                                    </label>
                                    <div>
                                        <select style="width: 100%;" class="form-control" name="individual_provice[1]" id="province_1">
                                              <option value="" >เลือก</option>
                                          <?php foreach ($province as $key => $value) { ?>
                                            <option value="<?php echo $value->area_code; ?>"><?php echo $value->area_name_th; ?> </option>
                                          <?php

                                        } ?>
                                        </select>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 10px;">
                                      <label >อำเภอ <span class="required" style="color:red">*</span>
                                      </label>
                                      <div>
                                        <select  style="width: 100%;" class="form-control" name="individual_district[1]" id="district_1">
                                          <option value=""  >เลือก</option>
                                        </select>
                                      </div>
                                  </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                      <label >ตำบล <span class="required" style="color:red">*</span>
                                      </label>
                                      <div >
                                        <select style="width: 100%;" class="form-control" name="individual_subdistrict[1]" id="subdistrict_1">
                                          <option value=""  >เลือก</option>
                                        </select>
                                      </div>
                                    </div>

                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <label  >รหัสไปรษณีย์ <span class="required" style="color:red">*</span>
                                    </label>
                                    <div >
                                        <input type="text" name="individual_zipcode[1]" placeholder="ระบุรหัสไปรษณีย์" value="" class="form-control col-md-7 col-xs-12" maxlength="5" onKeyUp="if(this.value*1!=this.value) this.value='' ;">
                                    </div>
                                  </div>

                                </div>

                              </div>

                              <hr/>
                              <div class="row">
                                <div class="col-md-2">
                                  <label>ที่อยู่จัดส่ง</label>
                                </div>
                                <div class="col-md-3">
                                  <p>
                                    <input type="radio" class="flat" name="individual_adr_2" id="individual_adr_2" value="0" checked=""  /> ที่อยู่เดิม &nbsp;
                                    <input type="radio" class="flat" name="individual_adr_2" id="individual_adr_22" value="1" /> เพิ่มที่อยู่
                                  </p>
                                </div>

                              </div>
                              <br/>
                              <div class="form-group type-value" id="individualadd_tab2" style="display:none;margin-bottom: 0px;" >

                                <div class="row">

                                  <div class="col-md-3 col-sm-6 col-xs-6" style="margin-bottom: 10px;">
                                    <label >เลขที่บ้าน
                                    </label>
                                    <div >
                                        <input type="text" placeholder="ระบุเลขที่บ้าน" name="individual_send_address[1]" id="id_tax" class="form-control col-md-7 col-xs-12">
                                    </div>

                                  </div>
                                  <div class="col-md-3 col-sm-3 col-xs-6" style="margin-bottom: 10px;">
                                    <label  >หมู่
                                      </label>
                                      <div>
                                          <input type="text" placeholder="ระบุหมู่" id="id_tax" name="individual_send_village[1]" class="form-control col-md-7 col-xs-12">
                                      </div>
                                  </div>
                                  <div class="col-md-3 col-sm-3 col-xs-6" style="margin-bottom: 10px;">
                                    <label  >ซอย/ตรอก
                                      </label>
                                      <div>
                                          <input type="text" placeholder=""id="id_tax" name="individual_send_lane[1]" class="form-control col-md-7 col-xs-12">
                                      </div>
                                  </div>
                                  <div class="col-md-3 col-sm-3 col-xs-6" style="margin-bottom: 10px;">
                                    <label  >ถนน
                                      </label>
                                      <div>
                                          <input type="text" placeholder=""id="id_tax" name="individual_send_road[1]" class="form-control col-md-7 col-xs-12">
                                      </div>
                                  </div>


                                </div>

                                <div class="row">
                                  <div class="col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 10px;">
                                    <label>จังหวัด
                                    </label>
                                    <div>
                                        <select style="width: 100%;" class="form-control" name="individual_send_province[1]" id="province_send_1">
                                              <option value="" >เลือก</option>
                                          <?php foreach ($province as $key => $value) { ?>
                                            <option value="<?php echo $value->area_code; ?>"><?php echo $value->area_name_th; ?> </option>
                                          <?php

                                        } ?>
                                        </select>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 10px;">
                                      <label >อำเภอ
                                      </label>
                                      <div>
                                        <select style="width: 100%;" class="form-control" name="individual_send_district[1]" id="district_send_1">
                                          <option value=""  >เลือก</option>
                                        </select>
                                      </div>
                                  </div>
                                  <div class="col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 10px;">
                                      <label >ตำบล
                                      </label>
                                      <div >
                                        <select style="width: 100%;" class="form-control" name="individual_send_subdistrict[1]" id="subdistrict_send_1">
                                          <option value=""  >เลือก</option>
                                        </select>
                                      </div>
                                  </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 10px;">
                                          <label  >รหัสไปรษณีย์
                                          </label>
                                          <div >
                                              <input type="text" name="individual_send_zipcode[1]" placeholder="ระบุรหัสไปรษณีย์" value="" class="form-control col-md-7 col-xs-12" maxlength="5" onKeyUp="if(this.value*1!=this.value) this.value='' ;" >
                                          </div>
                                    </div>
                                  </div>
                                <br/>


                              </div>



                          </div>
                        </div>

                      </div>
                  </div>




                      <?php

                    } ?>


                  </div>
                <!-- End SmartWizard Content -->

                  <div class="ln_solid"></div>
                      <div class="form-group">
                          <div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3 text-center">
                              <button  type="submit" id="btn-submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก
                              </button>
                              <button onclick="window.location.replace('<?php echo site_url('receive/receive_tax'); ?>');" type="button" class="btn btn-warning"><i class="fa fa-close"></i> ยกเลิก
                              </button>
                          </div>
                  </div>


              </form>
            </div>


          </div>
        </div>
      </div>

  </div>
</div>









