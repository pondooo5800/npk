<?php $edit = $this->uri->segment(5);?>
<div class="right_col" role="main">
    <div class="page-title">
      <div class="title_left">
        <h3>โครงการ</h3>
      </div>
    </div>

    <br>
    <br>

    <div class="clearfix"></div>



    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="nav navbar-left panel_toolbox">
            <h5 style="font-size:15px;"><?php echo $prj_tree; ?></h5>

        </div>
        <div class="nav navbar-right panel_toolbox">
          <h5 style="font-size:15px;"> ปีงบประมาณ : <?php echo $this->session->userdata('year') + 543; ?> </h5>
        </div>

        <br/>
        <br/>
        <div class="" role="tabpanel" data-example-id="togglable-tabs">
          <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
            <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">โครงการ</a>
            </li>
            <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">ข้อมูลโครงการ</a>
            </li>
          </ul>
          <div id="myTabContent" class="tab-content">
            <!-- <tab1> -->
            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
              <!-- //check edit form -->
              <?php if ($edit == 'edit') {?>
                <form id="prj_form" action="<?php echo base_url('project_training/insertPrj'); ?>" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                    <input type="hidden" name="prj_parent" value="<?php echo $this->uri->segment(3); ?>">
                    <input type="hidden" name="prj_id" value="<?php echo $this->uri->segment(4); ?>">
                    <input type="hidden" name="edit" value="<?php echo ($this->uri->segment(5) == 'edit') ? 'true' : 'false'; ?>">
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">ชื่อโครงการ <span style="color:red;">*</span>
                      </label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                        <input class="form-control" id="prj_name"  name="prj_name" placeholder="ระบุชื่อโครงการ" type="text" value="<?=@$prj[0]->prj_name;?>">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="budget">กรอบงบประมาณ <span style="color:red;">*</span>
                      </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <div class="row">
                          <div class="col-md-5 col-sm-5 col-xs-12">
                            <div class="checkbox" style="border:none;">
                              <label>
                              <?php
$log = false;
    foreach ($budget_log as $key => $value) {
        if ($value->prj_budget_type == 1) {
            $log = true;
        }

    }
    // if (!empty($prj[0]->prj_budget)) {
    //     $log = true;
    // }

    ?>
                                <input type="checkbox" <?=($log) ? 'checked' : '';?>  name="prj_budget_inside" id="prj_budget_inside" value="1" class="flat" > งบประมาณที่ได้รับ
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row well" id="budget_inside" style="display:none;">
                      <div class="">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="prj_budget">ระบุจำนวนเงิน <span style="color:red;">*</span>
                          </label>


                          <div class="col-md-3 col-sm-3 col-xs-6 ">
                           <?php $prj_bud_in = 0;
    foreach ($budget_log as $key => $value) {
        if ($value->prj_budget_type == 1 && $value->prj_budget_parent != null) {
            $prj_bud_in = $prj_bud_in + $value->prj_amount;
        }

    }?>
                          <?php if (@$prj_bud_in > 0) {?>
                            <input class="form-control numeric text-right" id="prj_budget" value="<?php echo $prj_bud_in; ?>" name="prj_budget" placeholder="จำนวน" type="text">
                          <?php } else {?>
                             <input class="form-control numeric text-right" id="prj_budget" value="" name="prj_budget" placeholder="จำนวน" type="text">
                          <?php }?>
                          </div>

                          <div class="col-md-1 col-sm-1 col-xs-12">
                            บาท
                          </div>

                        </div>
                      </div>

                    </div>

                    <div class="clearfix"></div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                      </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <div class="row">
                          <div class="col-md-5 col-sm-5 col-xs-12">
                            <div class="checkbox" style="border:none;">
                              <label>
                                <?php

    $log = false;
    foreach ($budget_log as $key => $value) {
        if ($value->prj_budget_type == 2 && $value->prj_amount > 0) {
            $log = true;
        }

    }
    ?>
                                <input type="checkbox" <?=($log) ? 'checked' : '';?>  name="prj_budget_convert" id="prj_budget_convert"  value="1" class="flat" > แปลงงบประมาณ
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="row well" id="budget_convert" style="display:none;">
                      <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                          <div class="row " >
                            <div class="col-md-6 col-sm-6 col-xs-12 col-sm-offset-3">
                              <div class="input-group">
                                <input class="form-control" type="text" id="val_budget_convert">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-success" id="search_convert">ค้นหา</button>
                                </span>
                              </div>
                            </div>
                          </div>
                          <br/>
                          <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <div class="x_panel show-search"  style="display:none;">
                                <div class="x_content" style="overflow: auto;height:200px; ">

                                  <table class="table table-search"  >
                                    <thead>
                                      <tr>
                                        <!-- <th width="5%">#</th> -->
                                        <th width="55%" >ชื่อโครงการ</th>
                                        <th width="20%" >กรอบงบประมาณ (บาท)</th>
                                        <th width="15%">งบเหลือจ่าย (บาท)</th>
                                        <th width="10%">&nbsp;</th>
                                      </tr>
                                    </thead>
                                    <tbody id="table_search">
                                      <!-- <tr>
                                        <td scope="row">1</td>
                                        <td >asd</td>
                                        <td>1000</td>
                                        <td><div class="btn-group">
                                              <button class="btn btn-warning" type="button">เลือก</button>
                                            </div>
                                        </td>
                                      </tr> -->
                                    </tbody>
                                  </table>

                                </div>
                              </div>

                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <div class="x_panel">
                                <div class="x_content">
                                <div class="clearfix"></div>
                                  <table class="table prj_select">
                                    <thead>
                                      <tr>
                                        <th width="100%" class="text-left">โครงการที่เลือก</th>
                                      </tr>
                                    </thead>
                                    <tbody id="table_select">
                                      <tr></tr>
                                      <?php foreach ($budget_log as $key => $value) {
        if ($value->prj_budget_type == 2 && $value->prj_budget_parent != null && $value->prj_amount > 0) {
            ?>
                                        <tr data-select="<?php echo $value->prj_budget_id; ?>" >
                                            <div class="row">
                                              <td class="text-left" style="">
                                                <span class="col-sm-7 text-left"> <?php echo @$value->prj_name . '<br>งบเหลือจ่าย ' . number_format($value->budget, 2) . ' บาท'; ?></span>
                                                <span class="col-sm-3 "><input class="form-control numeric budget_item text-right" value="<?php echo $value->prj_amount; ?>" onkeyup="integerInRange(this,<?php echo ($value->budget + $value->prj_amount); ?>)" name="prj_selects[<?php echo $value->prj_ref_id; ?>]" type="text"></span>
                                                <span class="col-sm-1">บาท</span>
                                                <div class="btn-group col-sm-1"><button onclick=delSelect(<?php echo $value->prj_budget_id; ?>) class="btn btn-danger btn-sm" type="button">ลบ</button></div>
                                              </td>
                                            </div>

                                        </tr>
                                      <?php }}?>

                                    </tbody>
                                    <tr>
                                        <div class="row">
                                          <td class="text-left" style="">
                                            <span class="col-sm-7 text-right">รวม</span>
                                            <span class="col-sm-3"><input disabled class="form-control numeric text-right" id="budget_convert_sum" value=""  type="text"></span>
                                            <span class="col-sm-1">บาท</span>
                                            <div class="btn-group col-sm-1">&nbsp;</div>
                                          </td>
                                        </div>

                                      </tr>
                                  </table>

                                </div>
                              </div>
                            </div>
                          </div>


                      </div>
                    </div>

                    <br>


                      <!--
                    </div> -->

                    <!-- <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">ผู้รับผิดชอบ
                      </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <select id="prj_owner"  name="prj_owner" class="select2_single form-control" tabindex="1">
                          <option disabled>เลือก</option>
                          <?php foreach ($user as $key => $value) {?>
                            <option value="<?=$value->user_id?>"><?=$value->user_firstname . ' ' . $value->user_lastname . ' ' . $value->tel_no;?></option>
                          <?php }?>

                        </select>
                      </div>
                    </div> -->

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                      มติที่ประชุม
                      </label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                        <textarea id="message" class="form-control"  name="approve" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                                data-parsley-validation-threshold="10"><?=@$prj[0]->approve;?></textarea>

                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">ประเภทโครงการ <span style="color:red;">*</span>
                      </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <div class="radio">
                          <label>
                            <input type="radio" class="flat"  checked  id="prj_type0" value="0" name="prj_type"> โครงการใหม่
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" class="flat" <?=(@$prj[0]->prj_type == 1) ? 'checked' : '';?>  id="prj_type1" value="1" name="prj_type"> โครงการต่อเนื่อง
                          </label>
                        </div>
                      </div>

                    </div>
                    <div class="row well" id="type_connect" style="display:none;">
                          <div class="">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="budget">เลือกโครงการ <span style="color:red;">*</span>
                              </label>

                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <select style="width: 100%;" class="form-control" name="prj_type_connect" id="prj_type_connect">
                                  <option value=""  >เลือก</option>
                                  <?php foreach ($prj_name as $key => $value) {
        $data_select = '';
        if (@$prj[0]->prj_type_connect == $value->prj_id) {
            $data_select = 'selected';
        }

        ?>
                                    <option <?php echo $data_select; ?> value="<?php echo $value->prj_id; ?>"><?php echo $value->prj_name; ?> </option>
                                  <?php }?>
                                </select>
                              </div>

                            </div>
                          </div>

                    </div>
                    <hr/>
                    <div class="form-group">
                      <div style="text-align: center;">
                      <button type="submit" id="btn-submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>
                      <button onclick="window.location.replace('<?php echo @$_SERVER['HTTP_REFERER']; ?>');" type="button" class="btn btn-warning"><i class="fa fa-close"></i> ยกเลิก
                      </button>

                      </div>
                    </div>
                </form>
              <?php } else {?>
                <form id="prj_form" action="<?php echo base_url('project_training/insertPrj'); ?>" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                    <input type="hidden" name="prj_parent" value="<?php echo $this->uri->segment(3); ?>">
                    <input type="hidden" name="prj_id" value="<?php echo $this->uri->segment(4); ?>">
                    <input type="hidden" name="edit" value="<?php echo ($this->uri->segment(5) == 'edit') ? 'true' : 'false'; ?>">
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">ชื่อโครงการ <span style="color:red;">*</span>
                      </label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                        <input class="form-control" id="prj_name"  name="prj_name" placeholder="ระบุชื่อโครงการ" type="text" >
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="budget">กรอบงบประมาณ <span style="color:red;">*</span>
                      </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <div class="row">
                          <div class="col-md-5 col-sm-5 col-xs-12">
                            <div class="checkbox" style="border:none;">
                              <label>
                                <input type="checkbox"  name="prj_budget_inside" id="prj_budget_inside" value="1" class="flat" > งบประมาณที่ได้รับ
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row well" id="budget_inside" style="display:none;">
                      <div class="">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="prj_budget">ระบุจำนวนเงิน <span style="color:red;">*</span>
                          </label>


                          <div class="col-md-3 col-sm-3 col-xs-6 ">
                            <input class="form-control numeric" id="prj_budget"  name="prj_budget" placeholder="จำนวน" type="text">
                          </div>

                          <div class="col-md-1 col-sm-1 col-xs-12">
                            บาท
                          </div>

                        </div>
                      </div>

                    </div>

                    <div class="clearfix"></div>

                      <!-- <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <div class="row">
                            <div class="col-md-5 col-sm-5 col-xs-12">
                              <div class="checkbox" style="border:none;">
                                <label>
                                  <input type="checkbox"  name="prj_budget" id="prj_budget_outside" class="flat" > งบประมาณภายนอก
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row well" id="budget_outside" style="display:none;">
                        <div class="outside_clone">
                          <div id="outside">
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="budget">ระบุจำนวนเงิน
                              </label>

                              <div class="col-md-3 col-sm-3 col-xs-4">
                                <input class="form-control" id="prj_name"  name="prj_name" placeholder="จำนวน" type="text">
                              </div>
                              <div class="col-md-1 col-sm-1 col-xs-4">
                                บาท
                              </div>

                              <label class="control-label col-md-1 col-sm-1 col-xs-12" for="budget">แหล่งที่มา
                              </label>
                              <div class="col-md-3 col-sm-3 col-xs-3">
                                <input class="form-control" id="prj_name"  name="prj_name" placeholder="ที่มา" type="text">
                              </div>
                              <div class="col-md-1 col-sm-1 col-xs-3">
                                <div class="btn-group">
                                    <button class="btn btn-info" id="add_outside" type="button">เพิ่ม</button>
                                  </div>
                              </div>
                            </div>
                          </div>

                        </div>

                      </div> -->
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                      </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <div class="row">
                          <div class="col-md-5 col-sm-5 col-xs-12">
                            <div class="checkbox" style="border:none;">
                              <label>
                                <input type="checkbox"  name="prj_budget_convert" id="prj_budget_convert"  value="1" class="flat" > แปลงงบประมาณ
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="row well" id="budget_convert" style="display:none;">
                      <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                          <div class="row " >
                            <div class="col-md-6 col-sm-6 col-xs-12 col-sm-offset-3">
                              <div class="input-group">
                                <input class="form-control" type="text" id="val_budget_convert">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-success " id="search_convert">ค้นหา</button>
                                </span>
                              </div>
                            </div>
                          </div>
                          <br/>
                          <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel show-search"  style="display:none;">
                                <div class="x_content" style="overflow: auto;height:200px;">

                                  <table class="table table-search"  >
                                    <thead>
                                      <tr>

                                        <th width="55%" >ชื่อโครงการ</th>
                                        <th width="20%" >กรอบงบประมาณ (บาท)</th>
                                        <th width="15%">งบเหลือจ่าย (บาท)</th>
                                        <th width="10%">&nbsp;</th>
                                      </tr>
                                    </thead>
                                    <tbody id="table_search">
                                      <!-- <tr>
                                        <td scope="row">1</td>
                                        <td >asd</td>
                                        <td>1000</td>
                                        <td><div class="btn-group">
                                              <button class="btn btn-warning" type="button">เลือก</button>
                                            </div>
                                        </td>
                                      </tr> -->
                                    </tbody>

                                  </table>

                                </div>
                              </div>


                              <div class="x_panel">
                                <div class="x_content">

                                  <table class="table"  >
                                    <thead>
                                      <tr>
                                        <th width="100%" class="text-left">โครงการที่เลือก</th>
                                      </tr>
                                    </thead>
                                    <tbody id="table_select">
                                      <tr></tr>
                                      <!-- <tr>
                                        <div class="row">
                                          <td>
                                            <span class="col-sm-5">
                                              เงินเดือน (งบเหลือจ่าย 1000)
                                            </span>
                                            <span class="col-sm-3">
                                              <input class="form-control" type="text">
                                            </span>
                                            <span class="col-sm-1">
                                              บาท
                                            </span>

                                            <div class="btn-group col-sm-1">
                                                <button class="btn btn-danger" type="button">ลบ</button>
                                            </div>
                                          </td>
                                        </div>
                                      </tr> -->
                                    </tbody>
                                    <tr>
                                        <div class="row">
                                          <td class="text-left" style="">
                                            <span class="col-sm-7 text-right">รวม</span>
                                            <span class="col-sm-3"><input class="form-control numeric" id="budget_convert_sum" value=""  type="text"></span>
                                            <span class="col-sm-1">บาท</span>
                                            <div class="btn-group col-sm-1">&nbsp;</div>
                                          </td>
                                        </div>

                                      </tr>
                                  </table>

                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                    </div>

                    <br>


                      <!--
                    </div> -->

                    <!-- <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">ผู้รับผิดชอบ
                      </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <select id="prj_owner"  name="prj_owner" class="select2_single form-control" tabindex="1">
                          <option disabled>เลือก</option>
                          <?php foreach ($user as $key => $value) {?>
                            <option value="<?=$value->user_id?>"><?=$value->user_firstname . ' ' . $value->user_lastname . ' ' . $value->tel_no;?></option>
                          <?php }?>

                        </select>
                      </div>
                    </div> -->

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                      มติที่ประชุม
                      </label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                        <textarea id="message" class="form-control"  name="approve" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                                data-parsley-validation-threshold="10"></textarea>

                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">ประเภทโครงการ <span style="color:red;">*</span>
                      </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <div class="radio">
                          <label>
                            <input type="radio" class="flat"  checked  id="prj_type0" value="0" name="prj_type"> โครงการใหม่
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" class="flat"    id="prj_type1" value="1" name="prj_type"> โครงการต่อเนื่อง
                          </label>
                        </div>
                      </div>

                    </div>
                    <div class="row well" id="type_connect" style="display:none;">
                          <div class="">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="budget">เลือกโครงการ <span style="color:red;">*</span>
                              </label>

                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <select style="width: 100%;" class="form-control" name="prj_type_connect" id="prj_type_connect">
                                  <option value=""  >เลือก</option>
                                  <?php foreach ($prj_name as $key => $value) {
    $data_province = '';
    // if (@$individual[0]->individual_send_province == $value->area_code) {
    //   $data_province = 'selected';
    // }

    ?>
                                    <option <?php echo $data_province; ?> value="<?php echo $value->prj_id; ?>"><?php echo $value->prj_name; ?> </option>
                                  <?php }?>
                                </select>
                              </div>

                            </div>
                          </div>

                    </div>
                    <hr/>
                    <div class="form-group">
                      <div style="text-align: center;">
                        <button type="submit" id="btn-submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>
                        <button onclick="window.location.replace('<?php echo base_url('project_training/project'); ?>');" type="button" class="btn btn-warning"><i class="fa fa-close"></i> ยกเลิก
                        </button>

                      </div>
                    </div>
                </form>
              <?php }?>
            </div>

            <!-- tab2 -->
            <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
              <!-- <div class="form-group">
                  <label>สถานะโครงการ</label>
                  <p>
                    <input type="radio" class="flat" name="prj_status" id="prj_status0" value="0" /> ยังไม่ได้ดำเนินการ &nbsp;
                    <input type="radio" class="flat" name="prj_status" id="prj_status1" value="1" /> อยู่ระหว่างดำเนินการ &nbsp;
                    <input type="radio" class="flat" name="prj_status" id="prj_status2" value="2" /> ดำเนินการเสร็จสิ้น &nbsp;
                    <input type="radio" class="flat" name="prj_status" id="prj_status3" value="3" /> ยกเลิก &nbsp;
                  </p>

              </div> -->
                    <?php if ($this->uri->segment(4) != '0' && $this->uri->segment(5) != '') {?>
                      <h4>ข้อมูล</h4>
                      <table class="table table-bordered">

                        <tbody>
                          <tr>
                            <td>โครงการ</td>
                            <td><?=$prj[0]->prj_name;?></td>
                          </tr>
                          <tr>
                            <td>ที่มา</td>
                            <td><?php echo $prj_tree; ?></td>
                          </tr>
                          <tr>
                            <td>ปีงบประมาณ</td>
                            <td><?php echo $this->session->userdata('year') + 543; ?></td>
                          </tr>
                          <tr>
                            <td>สร้างเมื่อ</td>
                            <?php $time = explode(' ', $prj[0]->prj_create);?>
                            <td> <?=$this->mydate->date_eng2thai($prj[0]->prj_create, 543, 'S');?>   (<?php echo @$user_all[$prj[0]->prj_owner]; ?>)</td>
                          </tr>
                          <tr>
                            <td>ปรับปรุงข้อมูลล่าสุด</td>
                            <?php $time = explode(' ', $prj[0]->prj_create);?>
                            <td><?=$this->mydate->date_eng2thai($prj[0]->prj_update, 543, 'S');?>  (<?php echo @$user_all[$prj[0]->prj_owner_update]; ?> )</td>
                          </tr>
                          <tr>
                            <td>สถานะโครงการ</td>
                            <td>
                            <div id="wizard" class="form_wizard wizard_horizontal">
                              <ul class="wizard_steps anchor">
                                <li>
                                  <a href="#step-1" class="<?=(empty($expenses)) ? 'selected' : 'disabled'?>" isdone="1" rel="1">
                                    <span class="step_no">1</span>
                                    <span class="step_descr">
                                      ยังไม่ได้ดำเนินการ
                                    </span>
                                  </a>
                                </li>
                                <?php $expenses_sum = 0;?>
                                  <?php foreach ($expenses as $key => $value) {
    $expenses_sum = ($expenses_sum + $value->expenses_amount_disburse);
}
    ?>
                                <li>
                                  <a href="#step-2" class="<?=(!empty($expenses) && ($prj[0]->budget_log - $expenses_sum) != 0) ? 'selected' : 'disabled'?>" isdone="0" rel="2">
                                    <span class="step_no">2</span>
                                    <span class="step_descr">
                                    อยู่ระหว่างดำเนินการ
                                    </span>
                                  </a>
                                </li>

                                <li>

                                  <a href="#step-3" class="<?=(!empty($expenses) && ($prj[0]->budget_log - $expenses_sum) == 0) ? 'selected' : 'disabled'?>" isdone="0" rel="3">
                                    <span class="step_no">3</span>
                                    <span class="step_descr">
                                    ดำเนินการเสร็จสิ้น
                                    </span>
                                  </a>
                                </li>
                              </ul>
                            </td>
                          </tr>


                        </tbody>
                      </table>


                      <h4>รายการเบิกจ่าย</h4>
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th width="10%">วันที่</th>
                            <th width="50%">รายละเอียด</th>
                            <th width="15%">ผู้ที่เบิกจ่าย</th>
                            <th width="15%">เงินเบิกจ่าย (บาท)</th>
                          </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($expenses as $key => $value) {
        ?>
                    <tr>
                      <td><?php echo $this->mydate->date_eng2thai($value->expenses_date, 543, 'S') ?></td>
                      <td><?php echo $value->expenses_detail; ?></td>
                      <td><?php echo $value->user_firstname . ' ' . $value->user_lastname; ?></td>
                      <td class="text-right"><?php echo number_format($value->expenses_amount_disburse, 2); ?></td>
                    </tr>
                  <?php }?>


                  </tbody>
                </table>
                <div class="row">
                  <div class="col-md-6 col-xs-12 ">
                      <div class="x_panel">
                        <div class="x_title">
                              งบเบิกจ่ายทั้งหมดที่ใช้ไป
                          <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                          <div style="text-align: center; margin-bottom: 17px">
                          <?php
$divv = 0;
    if (!empty($expenses_sum) && !empty($prj[0]->prj_budget_sum)) {
        $divv = (@$expenses_sum * 100) / @$prj[0]->budget_log;
    }?>
                            <span class="chart" data-percent="<?=@$divv;?>">
                                <span class="percent"></span>
                            </span>
                          </div>
                        <span style="float:right"> บาท</span>




                        </div>
                      </div>
                  </div>
                  <div class="col-md-6 col-xs-12  " style="float:right">
                    <table class="table table-bordered">
                      <tbody>
                        <tr>
                          <td>งบประมาณ</td>
                          <td class="text-right"><?=number_format($prj[0]->budget_log, 2);?> บาท</td>
                        </tr>
                        <tr>
                          <td>งบเบิกจ่าย</td>
                          <td class="text-right"><?=number_format($expenses_sum, 2);?> บาท</td>
                        </tr>
                        <tr>
                          <td>รวม</td>
                          <td class="text-right"><?=number_format($prj[0]->budget_log - $expenses_sum, 2);?> บาท</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>


                <h4>ข้อมูลการปรับปรุง</h4>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>อัพเดทเมื่อ</th>
                      <th>จำนวนเงิน (บาท)</th>
                      <th>หมายเหตุ</th>
                      <th>ผู้อัพเดท</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($budget_log_all as $key => $value) {?>
                      <tr>
                        <td><?php echo $this->mydate->date_eng2thai($value->prj_log_date, 543, 'S') ?></td>
                        <td class="text-right"><?=number_format($value->prj_amount, 2);?></td>
                        <td>
                            <?php if (@$value->prj_amount > 0 && $value->prj_name != '') {
        echo 'แปลงงบประมาณมาจาก ' . $value->prj_name;
    } else if (@$value->prj_amount < 0) {
        echo ' ดึงงบประมาณให้ ' . $value->prj_name;
    } else if ($value->prj_name == '') {
        echo 'งบประมาณที่ได้รับ';

    }?>
                        </td>
                        <td>
                            <?php echo @$user_log[$key]->user_firstname . ' ' . @$user_log[$key]->user_lastname; ?>
                        </td>
                      </tr>
                   <?php }?>


                  </tbody>
                </table>

              <?php }?>



            </div>
          </div>
        </div>


          <br>
        </div>
      </div>



    </div>
</div>
