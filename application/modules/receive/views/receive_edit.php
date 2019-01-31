<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>บันทึกรายการ</h3>
                <?php
if ($tax_id == 8) {
    $tab = 1;
} elseif ($tax_id == 9) {
    $tab = 2;
} elseif ($tax_id == 10) {
    $tab = 3;
} else {
    $tab = 1;
}
?>
                <script>
                    var tab = <?php echo $tab; ?> ;
                </script>
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
                                    <form id="notice-form" method="post" action="<?php echo base_url('receive/receive_notice_update'); ?>" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                                            <div id="form_tab" class="x_panel">
                                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                                            <li role="presentation" class="<?php echo ($tax_id == '8') ? 'active' : ''; ?>"><a href="#tab_content1" role="tab" id="tab1" data-toggle="tab" aria-expanded="true">ภาษีโรงเรือนและที่ดิน</a>
                                                            </li>
                                                            <li role="presentation" class="<?php echo ($tax_id == '9') ? 'active' : ''; ?>"><a href="#tab_content2" role="tab" id="tab2" data-toggle="tab" aria-expanded="false">ภาษีบำรุงท้องที่</a>
                                                            </li>
                                                            <li role="presentation" class="<?php echo ($tax_id == '10') ? 'active' : ''; ?>"><a href="#tab_content3" role="tab" id="tab3" data-toggle="tab" aria-expanded="false">ภาษีป้าย</a>
                                                            </li>
                                                        </ul>
                                                        <br>
                                                        <div class=row>
                                                            <div class="form-group">
                                                                <label class="control col-md-2" >ผู้เสียภาษี :</label>
                                                                <div class="control col-md-3">
                                                                    <p><?php echo $tax_notice_read[0]->individual_prename.' '.$tax_notice_read[0]->individual_fullname; ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control col-md-2" >รหัสชื่อ :</label>
                                                                <div class="control col-md-3">
                                                                    <p><?php echo $tax_notice_read[0]->code_name; ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control col-md-2" >เลขประจำตัวผู้เสียภาษี :</label>
                                                                <div class="control col-md-3">
                                                                    <p><?php echo $tax_notice_read[0]->individual_number; ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control col-md-2" >ประเภทผู้เสียภาษี :</label>
                                                                <div class="control col-md-3">
                                                                    <p><?php echo $tax_notice_read[0]->tax_type_name; ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control col-md-2" >ที่อยู่ :</label>
                                                                <div class="control col-md-6">
                                                                    <p><?php echo $tax_notice_read[0]->individual_address.' '.'หมู่'.' '.$tax_notice_read[0]->individual_village.' '.' ตำบล'.@$individual_subdistrict[0]['area_name_th'].' '.' อำเภอ'.@$individual_district[0]['area_name_th'].' '.' จังหวัด'.@$individual_provice[0]['area_name_th']; ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control col-md-2" >เบอร์โทรศัพท์ :</label>
                                                                <div class="control col-md-3">
                                                                    <p><?php echo $tax_notice_read[0]->individual_phone; ?></p>
                                                                </div>
                                                            </div>
                                                </div>
                                                <hr>

                                                    <div id="myTabContent" class="tab-content">
                                                        <?php if (!empty($tax_notice[8])) {
    ?>
                                                                <div role="tabpanel" class="tab-pane fade <?php echo ($tax_id == '8') ? 'active in' : ''; ?> " id="tab_content1" aria-labelledby="tab1">
                                                                    <div id="step-1">
                                                                        <br>
                                                                            <h2 class="StepTitle">บันทึกข้อมูลภาษีโรงเรือนและที่ดิน</h2>
                                                                                <div class="form-group" style="margin-bottom: 0px;">
                                                                                    <label class="control-label col-md-4 col-sm-3 col-xs-12" for="id_tax">
                                                                                        จำนวนข้อมูลภาษีโรงเรือนและที่ดิน
                                                                                    </label>
                                                                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                                                                            <div class="input-group">



               <input type="text"  id="num_one" class="num_one_edit total_num_one_edit form-control col-md-4 col-xs-12 tab1_value" name="notice_amount[0][]"value="<?php echo @$tax_notice_id[0]->notice_amount; ?>" onKeyUp="if(this.value*1!=this.value) this.value='' ;">
                                                                                                <input type="hidden"  id="num_total_edit" class="num_one_edit form-control col-md-4 col-xs-12" name="notice_amount[0][]"value="<?php echo @$tax_notice_id[0]->notice_amount; ?>" onKeyUp="if(this.value*1!=this.value) this.value='' ;">

                                                                                                <input type="hidden"  class="individual_id form-control col-md-4 col-xs-12" name="individual_id[0][]" value="<?php echo @$tax_notice_read[0]->individual_id; ?>" >
                                                                                                <span class="input-group-btn">
                                                                                                    <button class="btn btn-success" type="button" id="addNum_one" style="margin-right: 0px;">
                                                                                                        <i class="fa fa-plus-square"></i>
                                                                                                    </button>
                                                                                                </span>
                                                                                            </div>
                                                                                        </div>
                                                                                </div>
                                                                                <hr>

                                                                            <?php

    $tax_count = 0;
    foreach ($tax_notice[8] as $key => $notice) {
        ++$tax_count; ?>
                                                                                    <input type="hidden" class="tax_id" value="<?php echo $notice->tax_id; ?>">
                                                                                    <input type="hidden" name="notice_id[0][]" value="<?php echo @$notice->notice_id; ?>" >
                                                                                    <input type="hidden" id="notice<?php echo $tax_count; ?>" value="<?php echo @$notice->notice_id; ?>" >

                                                                            <div id="button_one<?php echo $tax_count; ?>" class="tax-tab-1">

                                                                                    <section class="row">
                                                                                        <div class="col-md-6 col-sm-4 col-xs-4">
                                                                                            <h2 class="StepTitle">ภาษีโรงเรือนและที่ดิน <?php echo $tax_count; ?> </h2>
                                                                                        </div>
                                                                                        <div class="col-md-6 col-sm-8 col-xs-8 text-right" style="margin-top: 7px;">
                                                                                            <div class="btn-group">
                                                                                                <button class="btn btn-danger btn-sm" type="button" style="margin-right: 0px;" title="ลบ" data-name="<?php echo $key; ?>" data-id="<?php echo $notice->notice_id; ?>"  data-toggle="modal" data-target="#delpay_modal_house">
                                                                                                    <i class="fa fa-minus-square"></i>
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </section>

                                                                                        <?php if ($tax_count == 1) {
            ?>
                                                                                                    <div class="row">
                                                                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                                                    <div class="form-group">
                                                                                                                            <label >วันที่รับ ภ.ร.ด. 2</label>
                                                                                                                            <span class="required" style="color:red">*</span>
                                                                                                                            <input type='text' name="notice_date_p2[0][]" id="notice_date_p2" value="<?php echo $this->mydate->date_db2str($notice->notice_date_p2, 543); ?>"data-provide="datepicker" data-date-language="th-th" class="form-control datepicker" />
                                                                                                                    </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                                                <div class="form-group">
                                                                                                                    <label> เลขที่รับ ภ.ร.ด. 2</label>
                                                                                                                    <span class="required" style="color:red">*</span>
                                                                                                                    <div>
                                                                                                                        <input type="text" name="notice_number[0][]" value="<?php echo @$notice->notice_number; ?>" placeholder="ระบุเลขที่ ภ.ร.ด. 2" class="form-control col-md7 col-sx-12">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                    </div>

                                                                                                    <div class="row">
                                                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                                                <div class="form-group">
                                                                                                                    <label > วันที่ประเมิน ภ.ร.ด. 8</label>
                                                                                                                    <span class="required" style="color:red">*</span>
                                                                                                                    <input type='text' name="notice_date[0][]" id="notice_date_p8" value="<?php echo $this->mydate->date_db2str($notice->notice_date, 543); ?>"data-provide="datepicker" data-date-language="th-th" class="form-control datepicker" />
                                                                                                                </div>
                                                                                                        </div>

                                                                                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                                                    <div class="form-group">
                                                                                                                        <label for="middle-name" class=""> เลขที่รับ ภ.ร.ด. 8
                                                                                                                            <span class="required" style="color:red">*</span>
                                                                                                                        </label>
                                                                                                                        <div >
                                                                                                                            <input type="text" name="notice_number_p8[0][]" value="<?php echo @$notice->notice_number_p8; ?>" placeholder="ระบุเลขที่ ภ.ร.ด. 8" id="notice_number_p8" class="form-control col-md-7 col-xs-12">
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>

                                                                                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                                                    <div class="form-group" >
                                                                                                                            <label for="middle-name" > เล่มที่รับ ภ.ร.ด. 8
                                                                                                                                <span class="required" style="color:red">*</span>
                                                                                                                            </label>
                                                                                                                            <div >
                                                                                                                                 <input type="text" name="notice_no[0][]" value="<?php echo @$notice->notice_no; ?>" placeholder="ระบุเล่มที่ ภ.ร.ด. 8" id="notice_no" class="form-control col-md-7 col-xs-12">
                                                                                                                            </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                    </div>


                                                                                            <?php
        } //if tax_count
        ?>
                                                                                                    <div class="row">
                                                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                                                    <div class="form-group">
                                                                                                                        <label  > เลขที่โฉนด</label>
                                                                                                                        <div >
                                                                                                                            <input type="text" name="land_deed_number[0][]" value="<?php echo @$notice->land_deed_number; ?>" placeholder="ระบุเลขที่โฉนด" id="land_deed_number" class="form-control col-md-7 col-xs-12" >
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                        </div>

                                                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                                            <div class="form-group">
                                                                                                                <label  > ประกอบกิจการ
                                                                                                                </label>
                                                                                                                <div >
                                                                                                                    <select class="form-control" name="noice_type_operation[0][]"  id="<?php echo $tax_count; ?>" onchange="business(this)" type="text">
                                                                                                                        <?php foreach ($operation as $value): ?>

                                                                                                                            <?php if ($notice->noice_type_operation == $value->noice_operation_id): ?>
                                                                                                                                <option  selected value="<?php echo $value->noice_operation_id; ?>"><?php echo $value->noice_operation_name; ?></option>
                                                                                                                            <?php else: ?>
                                                                                                                                <option value="<?php echo $value->noice_operation_id; ?>"><?php echo $value->noice_operation_name; ?></option>
                                                                                                                            <?php endif; ?>

                                                                                                                        <?php endforeach; ?>
                                                                                                                    </select>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                                                <div class="form-group" >
                                                                                                                    <label for="middle-name" > ประเภทกิจการ
                                                                                                                    </label>
                                                                                                                    <div >
                                                                                                                        <input type="text" name="noice_name_operation_other[0][]" id="type_business<?php echo $tax_count; ?>" <?php echo $notice->noice_type_operation == 4 ? "value='$notice->noice_name_operation_other'" : 'disabled'; ?> placeholder="ระบุประเภทกิจการ" class="select cls-select form-control col-md-7 col-xs-12" >
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                        </div>

                                                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                                                <div class="form-group" >
                                                                                                                    <label for="middle-name" > ชื่อสถานประกอบการค้าหรือกิจการอื่น
                                                                                                                    </label>
                                                                                                                    <div >
                                                                                                                        <input type="text" name="noice_name_operation[0][]"  value="<?php echo @$notice->noice_name_operation; ?>" placeholder="ระบุชื่อสถานประกอบการค้าหรือกิจการอื่น" id="noice_name_operation" class="form-control col-md-7 col-xs-12">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                    <div class="row">
                                                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                                            <div class="form-group">
                                                                                                                <label  > เลขที่
                                                                                                                </label>
                                                                                                                <div >
                                                                                                                    <input type="text" name="notice_address_number[0][]" value="<?php echo @$notice->notice_address_number; ?>" placeholder="ที่อยู่โรงเรือน/สิ่งปลูกสร้าง" id="notice_address_number" class="form-control col-md-7 col-xs-12" >
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>

                                                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                                                <div class="form-group" >
                                                                                                                    <label> หมู่ที่
                                                                                                                    </label>
                                                                                                                    <div >
                                                                                                                        <input type="text" name="notice_address_moo[0][]" value="<?php echo @$notice->notice_address_moo; ?>" placeholder="หมู่ที่อยู่โรงเรือน/สิ่งปลูกสร้าง" id="notice_address_moo" class="form-control col-md-7 col-xs-12">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                        </div>

                                                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                                            <div class="form-group">

                                                                                                                <label  > ตำบล
                                                                                                                </label>
                                                                                                                <div >
                                                                                                                    <input type="text" name="notice_address_subdistrict[0][]" value="หนองป่าครั่ง" disabled  id="notice_address_subdistrict" class="form-control col-md-7 col-xs-12" >
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                    <div class="row">
                                                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                                                <div class="form-group">

                                                                                                                    <label for="middle-name" > ค่ารายปี
                                                                                                                    <span class="required" style="color:red">*</span>
                                                                                                                    </label>
                                                                                                                    <div >
                                                                                                                        <input type="text" name="notice_annual_fee[0][]" value="<?php echo @$notice->notice_annual_fee; ?>" onkeyup="calculate_estimate_house(this,<?php echo $key; ?>)" id="notice_estimate_house<?php echo $key; ?>" class="notice_estimate_house<?php echo $key; ?> form-control col-md-7 col-xs-12 numeric text-right">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                        </div>

                                                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                                                <div class="form-group">
                                                                                                                        <label  > จำนวนภาษีที่ประเมิน
                                                                                                                        <span class="required" style="color:red">*</span>
                                                                                                                        </label>
                                                                                                                        <div >
                                                                                                                            <input type="text" name="notice_estimate[0][]" value="<?php echo @$notice->notice_estimate; ?>" onkeyup="calculate(<?php echo $key; ?>)" id="estimate<?php echo $key; ?>" class="estimate<?php echo $key; ?> form-control col-md-7 col-xs-12 numeric text-right" >
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </div>

                                                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                                            <div class="form-group">
                                                                                                                <label  > ประจำปีภาษี
                                                                                                                        <span class="required" style="color:red">*</span>
                                                                                                                </label>
                                                                                                                <select class="form-control" name="tax_year[0][]">


                                                                                                                            <?php foreach ($tax_years as $value): ?>

                                                                                                                                <?php if ($notice->tax_year == $value->tax_year_id): ?>
                                                                                                                                    <option  selected value="<?php echo $value->tax_year_id; ?>">พ.ศ. <?php echo $value->tax_year_label; ?></option>
                                                                                                                                <?php else: ?>
                                                                                                                                    <option value="<?php echo $value->tax_year_id; ?>">พ.ศ. <?php echo $value->tax_year_label; ?></option>
                                                                                                                                <?php endif; ?>

                                                                                                                            <?php endforeach; ?>
                                                                                                                 </select>
                                                                                                            </div>
                                                                                                            <br>

                                                                                                        </div>
                                                                                                    </div>

                                                                                    </div>
                                                                                    <hr>
                                                                                <?php
    } // if for

    ?>
                                                                            <div class="row">
                                                                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                                                                        <div class="form-group">
                                                                                            <div id="targetDiv1"></div>
                                                                                        </div>
                                                                                </div>
                                                                            </div>
                                                                            <input type="hidden" value="<?php echo $tax_count; ?>" id="count1">
                                                                            <hr>

                                                                            <div class="row">
                                                                                <div class="col-md-12 col-sm-6 col-xs-12">
                                                                                        <div class="form-group">
                                                                                            <h2 class="StepTitle">รวมค่าภาษีโรงเรือนและที่ดิน </h2>
                                                                                        </div>
                                                                                </div>
                                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                            <div class="form-group">
                                                                                                <label  > จำนวนภาษีที่ประเมิน
                                                                                                </label>
                                                                                                <div >
                                                                                                    <input type="text" readonly name="total_estimate[0][]" value="<?php echo @$notice->total_estimate; ?>" onkeyup="calculate(0)" class="total_estimate form-control col-md-7 col-xs-12 numeric text-right" >
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                            <div class="form-group">
                                                                                                <label  > ค่าปรับ
                                                                                                </label>
                                                                                                <div >
                                                                                                    <input type="text" name="tax_interest[0][]" value="<?php echo @$notice->tax_interest; ?>" onkeyup="calculate(0)" class="interest_house form-control col-md-7 col-xs-12 numeric text-right" >
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                            <div class="form-group">
                                                                                                <label  > จำนวนเงินภาษี/ค่าปรับ
                                                                                                </label>
                                                                                                <div >
                                                                                                    <input type="text" readonly name="sum_amount_tax[0][]" value="<?php echo @$notice->sum_amount_tax; ?>" onkeyup="calculate(0)" class="total form-control col-md-7 col-xs-12 numeric text-right" >
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                            </div>
                                                                            <br>
                                                                    </div>
                                                                </div>
                                                        <?php
} else {
        ?>
                                                        <div role="tabpanel" class="tab-pane fade <?php echo ($tax_id == '8') ? 'active in' : ''; ?> " id="tab_content1" aria-labelledby="tab1">
                                                            <br>
                                                            <div id="step-1">
                                                                    <h2 class="StepTitle">บันทึกข้อมูลภาษีโรงเรือนและที่ดิน</h2>
                                                                        <div class="form-group" style="margin-bottom: 0px;">
                                                                                <label class="control-label col-md-4 col-sm-3 col-xs-12" >
                                                                                จำนวนข้อมูลภาษีโรงเรือนและที่ดิน
                                                                                </label>
                                                                                <div class="col-md-4 col-sm-6 col-xs-12">
                                                                                    <div class="input-group">
                                                                                    <input type="text" id="num_one" name="notice_amount[0][]" class="num_one form-control col-md-4 col-xs-12" value="1" onKeyUp="if(this.value*1!=this.value) this.value='' ;">
                                                                                    <input type="hidden" name="individual_id[0][]" value="<?php echo @$tax_notice_read[0]->individual_id; ?>">
                                                                                    <span class="input-group-btn">
                                                                                        <button class="btn btn-success" type="button" id="addNum_one" style="margin-right: 0px;">
                                                                                            <i class="fa fa-plus-square"></i>
                                                                                        </button>
                                                                                    </span>
                                                                                    </div>
                                                                                </div>
                                                                        </div>
                                                                        <hr>
                                                                        <h2 class="StepTitle">ภาษีโรงเรือนและที่ดิน </h2>

                                                                        <div class="row">
                                                                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                            <div class="form-group">
                                                                                                    <label >วันที่รับ ภ.ร.ด. 2</label>
                                                                                                    <span class="required" style="color:red">*</span>
                                                                                                    <input type='text' name="notice_date_p2[0][]" value="<?php echo date('d/m/').(date('Y') + 543); ?>" data-provide="datepicker" data-date-language="th-th" class="form-control datepicker" />
                                                                                            </div>
                                                                                    </div>

                                                                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                        <div class="form-group">

                                                                                            <label> เลขที่รับ ภ.ร.ด. 2</label>
                                                                                            <span class="required" style="color:red">*</span>
                                                                                            <div>
                                                                                                <input type="text" name="notice_number[0][]" placeholder="ระบุเลขที่ ภ.ร.ด. 2" class="form-control col-md7 col-sx-12">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                    <div class="form-group">
                                                                                                    <label > วันที่ประเมิน ภ.ร.ด. 8</label>
                                                                                                    <span class="required" style="color:red">*</span>
                                                                                                    <input type='text' name="notice_date[0][]" value="<?php echo date('d/m/').(date('Y') + 543); ?>" data-provide="datepicker" data-date-language="th-th" class="form-control datepicker" />
                                                                                    </div>
                                                                            </div>

                                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                        <div class="form-group">

                                                                                            <label for="middle-name" class="" for="name"> เลขที่รับ ภ.ร.ด. 8
                                                                                            <span class="required" style="color:red">*</span>
                                                                                            </label>
                                                                                                <div >
                                                                                                    <input type="text" name="notice_number_p8[0][]" placeholder="ระบุเลขที่ ภ.ร.ด. 8" class="form-control col-md-7 col-xs-12">
                                                                                                </div>
                                                                                        </div>
                                                                                    </div>
                                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                        <div class="form-group" >

                                                                                            <label for="middle-name" > เล่มที่รับ ภ.ร.ด. 8
                                                                                            <span class="required" style="color:red">*</span>
                                                                                            </label>
                                                                                            <div >
                                                                                                <input type="text" name="notice_no[0][]" placeholder="ระบุเล่มที่ ภ.ร.ด. 8" class="form-control col-md-7 col-xs-12">
                                                                                            </div>
                                                                                        </div>
                                                                            </div>

                                                                        </div>

                                                                        <div class="row">
                                                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                            <div class="form-group">

                                                                                                <label  > เลขที่โฉนด
                                                                                                </label>
                                                                                                <div >
                                                                                                    <input type="text" name="land_deed_number[0][]" placeholder="ระบุเลขที่โฉนด" class="form-control col-md-7 col-xs-12" >
                                                                                                </div>
                                                                                            </div>
                                                                                </div>

                                                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                    <div class="form-group">
                                                                                        <label  > ประกอบกิจการ
                                                                                        </label>
                                                                                        <div >
                                                                                            <select class="form-control" name="noice_type_operation[0][]" id="1" onchange="business(this)">
                                                                                                <?php foreach ($operation as $key => $value) {
            ?>
                                                                                                    <option value="<?=$value->noice_operation_id; ?>"><?=$value->noice_operation_name; ?></option>
                                                                                                    <?php
        } ?>
                                                                                            </select>

                                                                                                <!-- <select onclick="select()" class="cls-select form-control" name="noice_type_operation[0][]">
                                                                                                    <option value="0">หอพัก</option>
                                                                                                    <option value="1">ร้านค้า</option>
                                                                                                    <option value="2">บ้านเช่า</option>
                                                                                                    <option value="3">อาคารให้เช่า</option>
                                                                                                    <option value="4">อื่นๆ</option>
                                                                                                </select>
 -->
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                        <div class="form-group" >
                                                                                            <label for="middle-name" > ประเภทกิจการ
                                                                                            </label>
                                                                                            <div >
                                                                                                <input type="text" name="noice_name_operation_other[0][]" id="type_business1" placeholder="ระบุประเภทกิจการ" disabled class="select cls-select form-control col-md-7 col-xs-12">
                                                                                            </div>
                                                                                        </div>
                                                                                </div>

                                                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                        <div class="form-group" >
                                                                                            <label for="middle-name" > ชื่อสถานประกอบการค้าหรือกิจการอื่น
                                                                                            </label>
                                                                                            <div >
                                                                                                <input type="text" name="noice_name_operation[0][]" placeholder="ระบุชื่อสถานประกอบการค้าหรือกิจการอื่น" class="form-control col-md-7 col-xs-12">
                                                                                            </div>
                                                                                        </div>
                                                                                </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label  > เลขที่
                                                                                    </label>
                                                                                    <div >
                                                                                        <input type="text" name="notice_address_number[0][]" placeholder="ที่อยู่โรงเรือน/สิ่งปลูกสร้าง" class="form-control col-md-7 col-xs-12" >
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                    <div class="form-group" >

                                                                                        <label> หมู่ที่
                                                                                        </label>
                                                                                        <div >
                                                                                            <input type="text" name="notice_address_moo[0][]" placeholder="หมู่ที่อยู่โรงเรือน/สิ่งปลูกสร้าง" class="form-control col-md-7 col-xs-12">
                                                                                        </div>
                                                                                    </div>
                                                                            </div>

                                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                <div class="form-group">

                                                                                    <label  > ตำบล
                                                                                    </label>
                                                                                    <div >
                                                                                        <input type="text" name="notice_address_subdistrict[0][]" value="หนองป่าครั่ง" disabled  class="form-control col-md-7 col-xs-12" >
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                    <div class="form-group">

                                                                                        <label for="middle-name" > ค่ารายปี
                                                                                        <span class="required" style="color:red">*</span>
                                                                                        </label>
                                                                                        <div >
                                                                                            <input type="text" name="notice_annual_fee[0][]"  onkeyup="calculate_estimate_house(this,0)"  id="notice_estimate_house0" class="notice_estimate_house0 form-control col-md-7 col-xs-12 numeric text-right">
                                                                                        </div>
                                                                                    </div>
                                                                            </div>

                                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                    <div class="form-group">
                                                                                            <label  > จำนวนภาษีที่ประเมิน
                                                                                            <span class="required" style="color:red">*</span>
                                                                                            </label>
                                                                                            <div >
                                                                                                <input type="text" name="notice_estimate[0][]"  onkeyup="calculate(0)" id="estimate0" class="estimate0 form-control col-md-7 col-xs-12 numeric text-right" >
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                        <div class="form-group">
                                                                                            <label  > ประจำปีภาษี
                                                                                            <span class="required" style="color:red">*</span>
                                                                                            </label>
                                                                                            <select class="form-control" name="tax_year[0][]" >
                                                                                                <?php foreach ($tax_years as $key => $value) {
            ?>
                                                                                                    <option value="<?=$value->tax_year_id; ?>">พ.ศ. <?=$value->tax_year_label; ?></option>
                                                                                                    <?php
        } ?>
                                                                                            </select>
                                                                                        <div >
                                                                                    </div>
                                                                            </div>
                                                                        </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-12 col-sm-6 col-xs-12">
                                                                                    <div class="form-group">
                                                                                        <div id="targetDiv1"></div>
                                                                                    </div>
                                                                            </div>
                                                                        </div>
                                                                        <input type="hidden" value="1" id="count1">
                                                                        <br>
                                                                        <hr>
                                                                        <div class="row">
                                                                                <div class="col-md-12 col-sm-6 col-xs-12">
                                                                                        <div class="form-group">
                                                                                            <h2 class="StepTitle">รวมค่าภาษีโรงเรือนและที่ดิน </h2>
                                                                                        </div>
                                                                                </div>
                                                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                        <div class="form-group">
                                                                                            <label  > จำนวนภาษีที่ประเมิน
                                                                                            </label>
                                                                                            <div >
                                                                                                <input type="number" readonly name="total_estimate[0][]" onkeyup="calculate(0)" class="total_estimate form-control col-md-7 col-xs-12 numeric text-right" >
                                                                                            </div>
                                                                                        </div>
                                                                                </div>

                                                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                    <div class="form-group">
                                                                                        <label  > ค่าปรับ
                                                                                        </label>
                                                                                        <div >
                                                                                            <input type="text" name="tax_interest[0][]" onkeyup="calculate(0)" class="interest_house form-control col-md-7 col-xs-12 numeric text-right" >
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                    <div class="form-group">
                                                                                        <label  > จำนวนเงินภาษี/ค่าปรับ
                                                                                        </label>
                                                                                        <div >
                                                                                            <input type="text" readonly name="sum_amount_tax[0][]" onkeyup="calculate(0)" class="total form-control col-md-7 col-xs-12 numeric text-right">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>


                                                                            </div>

                                                                <br/>

                                                            </div>
                                                            </div>
                                                        <?php
    } // if empty
?>
                                                     <?php if (!empty($tax_notice[9])) {
    ?>
                                                                <div role="tabpanel" class="tab-pane fade <?php echo ($tax_id == '9') ? 'active in' : ''; ?> " id="tab_content2" aria-labelledby="tab2">
                                                                    <div id="step-2">
                                                                    <br>
                                                                        <h2 class="StepTitle">บันทึกข้อมูลภาษีบำรุงท้องที่</h2>
                                                                                <div class="form-group" style="margin-bottom: 0px;">
                                                                                        <label class="control-label col-md-4 col-sm-3 col-xs-12">
                                                                                        จำนวนข้อมูลภาษีบำรุงท้องที่
                                                                                        </label>
                                                                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                                                                            <div class="input-group">

                                <input type="text" id="num_two" name="land_amount[1][]" class="num_two total_num_two_edit form-control col-md-4 col-xs-12 tab2_value" value="<?php echo @$tax_notice_id[1]->land_amount; ?>" onKeyUp="if(this.value*1!=this.value) this.value='' ;">
                                                                                            <input type="hidden" id="num_total_edit_two" name="land_amount[1][]" class="num_two form-control col-md-4 col-xs-12 tab2_value" value="<?php echo @$tax_notice_id[1]->land_amount; ?>" onKeyUp="if(this.value*1!=this.value) this.value='' ;">

                                                                                            <input type="hidden"  class="individual_id form-control col-md-4 col-xs-12" name="individual_id[1][]" value="<?php echo @$tax_notice_read[0]->individual_id; ?>" >

                                                                                            <span class="input-group-btn">
                                                                                                <button class="btn btn-success" type="button" id="addNum_two" style="margin-right: 0px;">
                                                                                                    <i class="fa fa-plus-square"></i>
                                                                                                </button>
                                                                                            </span>
                                                                                            </div>
                                                                                        </div>
                                                                                </div>
                                                                                <hr>

                                                                            <?php
$tax_count = 0;
    foreach ($tax_notice[9] as $key => $notice) {
        ++$tax_count; ?>
                                                                                 <input type="hidden" class="tax_id" value="<?php echo $notice->tax_id; ?>">
                                                                                 <input type="hidden" name="notice_id[1][]" value="<?php echo @$notice->notice_id; ?>" >
                                                                                <!-- <input type="hidden" name="notice_id[1][]" value="<?php echo @$notice->notice_id; ?>" >-->
                                                                                 <input type="hidden" id="notice<?php echo $tax_count; ?>" value="<?php echo @$notice->notice_id; ?>" >
                                                                        <div id="button_two<?php echo $tax_count; ?>" class="tax-tab-2">
                                                                                    <section class="row">
                                                                                        <div class="col-md-6 col-sm-4 col-xs-4">
                                                                                            <h2 class="StepTitle">ภาษีบำรุงท้องที่ <?php echo $tax_count; ?></h2>
                                                                                        </div>
                                                                                        <div class="col-md-6 col-sm-8 col-xs-8 text-right" style="margin-top: 7px;">
                                                                                            <div class="btn-group">
                                                                                                <button class="btn btn-danger btn-sm" type="button" style="margin-right: 0px;" title="ลบ" data-name="<?php echo $key; ?>" data-id="<?php echo $notice->notice_id; ?>"  data-toggle="modal" data-target="#delpay_modal_local">
                                                                                                    <i class="fa fa-minus-square"></i>
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </section>

                                                                                    <?php if ($tax_count == 1) {
            ?>
                                                                                    <div class="row">
                                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                                <div class="form-group" >

                                                                                                        <label >วันที่ประเมิน<span class="required" style="color:red"> *</span></label>
                                                                                                        <input type='text' name="notice_date[1][]"  value="<?php echo $this->mydate->date_db2str($notice->notice_date, 543); ?>"data-provide="datepicker" data-date-language="th-th" class="form-control datepicker" />
                                                                                                </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="row">
                                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                                <div class="form-group" >
                                                                                                        <label >วันที่สำรวจ ภ.บ.ท. 5<span class="required" style="color:red"> *</span></label>
                                                                                                        <input type='text' name="notice_date_p5[1][]" value="<?php echo $this->mydate->date_db2str($notice->notice_date_p5, 543); ?>"data-provide="datepicker" data-date-language="th-th" class="form-control datepicker" />
                                                                                                </div>
                                                                                        </div>
                                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                                <div class="form-group" >
                                                                                                    <label > เลขที่สำรวจ ภ.บ.ท. 5<span class="required" style="color:red"> *</span>
                                                                                                    </label>
                                                                                                <div >
                                                                                                    <input type="text" name="notice_number[1][]" value="<?php echo @$notice->notice_number; ?>" placeholder="ระบุเลขเลขที่สำรวจ ภ.บ.ท. 5" class="form-control col-md-7 col-xs-12">
                                                                                                </div>
                                                                                                </div>
                                                                                        </div>

                                                                                    </div>


                                                                                    <?php
        } // if tax_count?>
                                                                                <div class="row">
                                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                            <div class="form-group" >
                                                                                                <label  > เลขที่โฉนด
                                                                                                </label>
                                                                                                <div >
                                                                                                    <input type="text" name="land_deed_number[1][]" value="<?php echo @$notice->land_deed_number; ?>" placeholder="ระบุเลขที่โฉนด" class="form-control col-md-7 col-xs-12" >
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                            <div class="form-group" >
                                                                                                <label  > จุดสังเกต
                                                                                                </label>
                                                                                                <div >
                                                                                                    <input type="text" name="notice_mark[1][]" value="<?php echo @$notice->notice_mark; ?>" placeholder="ระบุจุดสังเกต" class="form-control col-md-7 col-xs-12" >
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                            <div class="form-group" >
                                                                                                <label for="middle-name" class="" for="name"> หมู่ที่
                                                                                                </label>
                                                                                                <div >
                                                                                                    <input type="text" name="notice_address_moo[1][]" value="<?php echo @$notice->notice_address_moo; ?>" placeholder="หมู่ที่อยู่ที่ตั้งที่ดิน" class="form-control col-md-7 col-xs-12">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                            <div class="form-group" >
                                                                                                <label  > ตำบล
                                                                                                </label>
                                                                                                    <div >
                                                                                                        <input type="text" name="notice_address_subdistrict[1][]" value="หนองป่าครั่ง" disabled class="form-control col-md-7 col-xs-12" >
                                                                                                    </div>
                                                                                            </div>
                                                                                        </div>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                        <div class="form-group" >

                                                                                            <label  > เนื้อที่ดิน (ไร่) <span class="required" style="color:red"> *</span>
                                                                                            </label>
                                                                                                <div >
                                                                                                    <input type="text" name="land_rai[1][]" value="<?php echo @$notice->land_rai; ?>" placeholder="ระบุเนื้อที่ดิน (ไร่)" onkeyup="land(<?php echo $key; ?>)" class="land_rai<?php echo $key; ?> form-control col-md-7 col-xs-12">
                                                                                                </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                        <div class="form-group" >

                                                                                            <label  > เนื้อที่ดิน (งาน) <span class="required" style="color:red"> *</span>
                                                                                            </label>
                                                                                                <div >
                                                                                                    <input type="text" name="land_ngan[1][]" value="<?php echo @$notice->land_ngan; ?>" placeholder="ระบุเนื้อที่ดิน (งาน)" onkeyup="land(<?php echo $key; ?>)" class="land_ngan<?php echo $key; ?> form-control col-md-7 col-xs-12">
                                                                                                </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                        <div class="form-group" >

                                                                                            <label  > เนื้อที่ดิน (วา) <span class="required" style="color:red"> *</span>
                                                                                            </label>
                                                                                                <div >
                                                                                                    <input type="text" name="land_wa[1][]" value="<?php echo @$notice->land_wa; ?>" placeholder="ระบุเนื้อที่ดิน (วา)" onkeyup="land(<?php echo $key; ?>)" class="land_wa<?php echo $key; ?> form-control col-md-7 col-xs-12">
                                                                                                </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <div class="row">
                                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                            <div class="form-group" style="margin-bottom: 0px;">

                                                                                            <label for="middle-name" class="" for="name"> เนื้อที่ดินที่ต้องชำระภาษี<span class="required" style="color:red"> *</span>
                                                                                            </label>
                                                                                            <div >
                                                                                                <input type="text" name="land_tax[1][]" value="<?php echo @$notice->land_tax; ?>"  onkeyup="land(<?php echo $key; ?>)" class="total_land<?php echo $key; ?> form-control col-md-7 col-xs-12">
                                                                                            </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                                <div class="form-group" style="margin-bottom: 0px;">
                                                                                                    <label  > จำนวนภาษีที่ประเมิน <span class="required" style="color:red"> *</span>
                                                                                                    </label>
                                                                                                        <div >
                                                                                                            <input type="text" name="notice_estimate[1][]" value="<?php echo @$notice->notice_estimate; ?>" onkeyup="calculate_1(<?php echo $key; ?>)"  class="notice_estimate_local<?php echo $key; ?> form-control col-md-7 col-xs-12 numeric text-right">
                                                                                                        </div>
                                                                                                </div>
                                                                                        </div>


                                                                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                                                                            <div class="form-group" style="margin-bottom: 0px;">

                                                                                                <label  > ชำระภาษีบำรุงท้องที่ปี  <span class="required" style="color:red"> *</span>
                                                                                                </label>
                                                                                                    <div >
                                                                                                        <div class="col-md-5 col-sm-6 col-xs-12" style="padding-left: 0px;">

                                                                                                            <select class="form-control" name="tax_year[1][]" type="text"  id="<?php echo $tax_count; ?>" onchange="auto_year(this)">
                                                                                                                <?php foreach ($tax_years as $key => $value) {
            ?>
                                                                                                                        <option value="<?=$value->tax_year_id; ?>" <?php if ($notice->tax_year == $value->tax_year_id) {
                echo 'selected';
            } ?>>พ.ศ. <?=$value->tax_year_label; ?></option>
                                                                                                                    <?php
        } ?>
                                                                                                            </select>
                                                                                                        </div>
                                                                                                        <div class="col-md-2 col-sm-6 col-xs-12" align="center"><label>ถึง</label></div>
                                                                                                        <div class="col-md-5 col-sm-6 col-xs-12" style="padding-right: 0px;">
                                                                                                            <select class="form-control" name="tax_local_year[1][]" id="local_year<?php echo $tax_count; ?>" type="text" >
                                                                                                            <?php foreach ($tax_years as $key => $value) {
            ?>

                                                                                                                    <option value="<?=$value->tax_year_id; ?>" <?php if ($notice->tax_local_year == $value->tax_year_id) {
                echo 'selected';
            } ?>>พ.ศ. <?=$value->tax_year_label; ?></option>

                                                                                                                    <?php
        } ?>
                                                                                                                </select>
                                                                                                        </div>
                                                                                                    </div>
                                                                                            </div>
                                                                                            <br>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            <hr>
                                                                        </div>
                                                                        <?php
    } // if for?>
                                                                     <div class="row">
                                                                                <div class="col-md-12 col-sm-6 col-xs-12">
                                                                                        <div class="form-group">
                                                                                            <div id="targetDiv2"></div>
                                                                                        </div>
                                                                                </div>
                                                                     </div>
                                                                     <input type="hidden" value="<?php echo $tax_count; ?>" id="count2">
                                                                        <hr>
                                                                    <div class="row">
                                                                            <div class="col-md-12 col-sm-6 col-xs-12">
                                                                                    <div class="form-group">
                                                                                        <h2 class="StepTitle">รวมค่าภาษีบำรุงท้องที่ </h2>
                                                                                    </div>
                                                                            </div>
                                                                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                            <div class="form-group">
                                                                                                <label  > จำนวนภาษีที่ประเมิน
                                                                                                </label>
                                                                                                <div >
                                                                                                    <input type="text" readonly name="total_estimate[1][]" value="<?php echo @$notice->total_estimate; ?>" onkeyup="calculate_1()" class="total_estimate_local form-control col-md-7 col-xs-12 numeric text-right" >
                                                                                                </div>
                                                                                            </div>
                                                                                    </div>

                                                                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                        <div class="form-group">
                                                                                            <label  > เงินเพิ่ม
                                                                                            </label>
                                                                                            <div >
                                                                                                <input type="text" name="tax_interest[1][]" value="<?php echo @$notice->tax_interest; ?>" onkeyup="calculate_1()" class="interest_local form-control col-md-7 col-xs-12 numeric text-right" >
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                        <div class="form-group">
                                                                                            <label  > จำนวนเงินภาษี/เงินเพิ่ม
                                                                                            </label>
                                                                                            <div >
                                                                                                <input type="text" readonly name="sum_amount_tax[1][]" value="<?php echo @$notice->sum_amount_tax; ?>" onkeyup="calculate_1()" class="total_local form-control col-md-7 col-xs-12 numeric text-right">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                        </div>
                                                                </div>
                                                                </div>
                                                     <?php
} else {
        ?>
                                                    <div role="tabpanel" class="tab-pane fade <?php echo ($tax_id == '9') ? 'active in' : ''; ?> " id="tab_content2" aria-labelledby="tab2">
                                                        <div id="step-2">
                                                        <br>
                                                                <h2 class="StepTitle">บันทึกข้อมูลภาษีบำรุงท้องที่</h2>
                                                                    <div class="form-group" style="margin-bottom: 0px;">
                                                                            <label class="control-label col-md-4 col-sm-3 col-xs-12">
                                                                            จำนวนข้อมูลภาษีบำรุงท้องที่
                                                                            </label>
                                                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                                                <div class="input-group">
                                                                                <input type="text" id="num_two" name="land_amount[1][]" class="num_two form-control col-md-4 col-xs-12" value="1" onKeyUp="if(this.value*1!=this.value) this.value='' ;">
                                                                                <input type="hidden"  class="form-control col-md-4 col-xs-12" name="individual_id[1][]" value="<?php echo @$tax_notice_read[0]->individual_id; ?>" >
                                                                                <span class="input-group-btn">
                                                                                    <button class="btn btn-success" type="button" id="addNum_two" style="margin-right: 0px;">
                                                                                        <i class="fa fa-plus-square"></i>
                                                                                    </button>
                                                                                </span>
                                                                                </div>
                                                                            </div>
                                                                    </div>
                                                                    <hr>
                                                                    <h2 class="StepTitle">ภาษีบำรุงท้องที่ </h2>
                                                                        <div class="row">
                                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                    <div class="form-group" >

                                                                                            <label >วันที่ประเมิน<span class="required" style="color:red"> *</span></label>
                                                                                            <input type='text' name="notice_date[1][]" value="<?php echo date('d/m/').(date('Y') + 543); ?>" data-provide="datepicker" data-date-language="th-th" class="form-control datepicker" />
                                                                                    </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">

                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                    <div class="form-group" >

                                                                                            <label >วันที่สำรวจ ภ.บ.ท. 5<span class="required" style="color:red"> *</span></label>
                                                                                            <input type='text' name="notice_date_p5[1][]" value="<?php echo date('d/m/').(date('Y') + 543); ?>" data-provide="datepicker" data-date-language="th-th" class="form-control datepicker" />
                                                                                    </div>
                                                                            </div>
                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                <div class="form-group" >

                                                                                <label for="middle-name" class="" for="name"> เลขที่สำรวจ ภ.บ.ท. 5<span class="required" style="color:red"> *</span>
                                                                                </label>
                                                                                <div >
                                                                                    <input type="text" name="notice_number[1][]" placeholder="ระบุเลขเลขที่สำรวจ ภ.บ.ท. 5" class="form-control col-md-7 col-xs-12">
                                                                                </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>

                                                                        <div class="row">
                                                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                        <div class="form-group" >

                                                                                            <label  > เลขที่โฉนด
                                                                                            </label>
                                                                                            <div >

                                                                                                <input type="text" name="land_deed_number[1][]" placeholder="ระบุเลขที่โฉนด" class="form-control col-md-7 col-xs-12" >
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                        <div class="form-group" >
                                                                                            <label  > จุดสังเกต
                                                                                            </label>
                                                                                            <div >
                                                                                                <input type="text" name="notice_mark[1][]" placeholder="ระบุจุดสังเกต" class="form-control col-md-7 col-xs-12" >
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                        <div class="form-group" >

                                                                                        <label for="middle-name" class="" for="name"> หมู่ที่
                                                                                        </label>
                                                                                        <div >
                                                                                            <input type="text" name="notice_address_moo[1][]" placeholder="หมู่ที่อยู่ที่ตั้งที่ดิน" class="form-control col-md-7 col-xs-12">
                                                                                        </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                        <div class="form-group" >

                                                                                            <label  > ตำบล
                                                                                            </label>
                                                                                                <div >
                                                                                                    <input type="text" name="notice_address_subdistrict[1][]" value="หนองป่าครั่ง" disabled class="form-control col-md-7 col-xs-12" >
                                                                                                </div>
                                                                                        </div>
                                                                                    </div>
                                                                            </div>
                                                                        <div class="row">
                                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                <div class="form-group" >

                                                                                    <label  > เนื้อที่ดิน (ไร่) <span class="required" style="color:red"> *</span>
                                                                                    </label>
                                                                                        <div >
                                                                                            <input type="text" name="land_rai[1][]" placeholder="ระบุเนื้อที่ดิน (ไร่)" onkeyup="land(0)" class="land_rai0 form-control col-md-7 col-xs-12">
                                                                                        </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                <div class="form-group" >

                                                                                    <label  > เนื้อที่ดิน (งาน) <span class="required" style="color:red"> *</span>
                                                                                    </label>
                                                                                        <div >
                                                                                            <input type="text" name="land_ngan[1][]" placeholder="ระบุเนื้อที่ดิน (งาน)" onkeyup="land(0)" class="land_ngan0 form-control col-md-7 col-xs-12">
                                                                                        </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                <div class="form-group" >

                                                                                    <label  > เนื้อที่ดิน (วา) <span class="required" style="color:red"> *</span>
                                                                                    </label>
                                                                                        <div >
                                                                                            <input type="text" name="land_wa[1][]" placeholder="ระบุเนื้อที่ดิน (วา)" onkeyup="land(0)" class="land_wa0 form-control col-md-7 col-xs-12">
                                                                                        </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    <div class="form-group">
                                                                        <div class="row">
                                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                <div class="form-group" style="margin-bottom: 0px;">

                                                                                <label for="middle-name" class="" for="name"> เนื้อที่ดินที่ต้องชำระภาษี<span class="required" style="color:red"> *</span>
                                                                                </label>
                                                                                <div >
                                                                                    <input type="text" name="land_tax[1][]"  onkeyup="land(0)" class="total_land0 form-control col-md-7 col-xs-12">
                                                                                </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                    <div class="form-group" style="margin-bottom: 0px;">
                                                                                        <label  > จำนวนภาษีที่ประเมิน <span class="required" style="color:red"> *</span>
                                                                                        </label>
                                                                                            <div >
                                                                                                <input type="text" name="notice_estimate[1][]" onkeyup="calculate_1(0)"  class="notice_estimate_local0 form-control col-md-7 col-xs-12 numeric text-right">
                                                                                            </div>
                                                                                    </div>
                                                                            </div>


                                                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                                                <div class="form-group" style="margin-bottom: 0px;">

                                                                                    <label  > ชำระภาษีบำรุงท้องที่ปี  <span class="required" style="color:red"> *</span>
                                                                                    </label>
                                                                                        <div >
                                                                                            <div class="col-md-5 col-sm-6 col-xs-12" style="padding-left: 0px;">
                                                                                                <select class="form-control" name="tax_year[1][]" type="text"  id="1" onchange="auto_year(this)">
                                                                                                    <?php foreach ($tax_years as $key => $value) {
            ?>
                                                                                                        <option value="<?=$value->tax_year_id; ?>" <?php if (date('Y') == $value->tax_year_id) {
                echo 'selected';
            } ?>>พ.ศ. <?=$value->tax_year_label; ?></option>
                                                                                                        <?php
        } ?>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-md-2 col-sm-6 col-xs-12" align="center"><label>ถึง</label></div>
                                                                                            <div class="col-md-5 col-sm-6 col-xs-12" style="padding-right: 0px;">
                                                                                                <select class="form-control" name="tax_local_year[1][]" id="local_year1" type="text" >
                                                                                                    <?php foreach ($tax_years as $key => $value) {
            ?>
                                                                                                        <option value="<?=$value->tax_year_id; ?>" <?php if ((date('Y') + 3) == $value->tax_year_id) {
                echo 'selected';
            } ?>>พ.ศ. <?=$value->tax_year_label; ?></option>
                                                                                                        <?php
        } ?>
                                                                                                    </select>
                                                                                            </div>
                                                                                        </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12 col-sm-6 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <div id="targetDiv2"></div>
                                                                                </div>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" value="1" id="count2">
                                                                    <br>
                                                                    <hr>
                                                                    <div class="row">
                                                                            <div class="col-md-12 col-sm-6 col-xs-12">
                                                                                    <div class="form-group">
                                                                                        <h2 class="StepTitle">รวมค่าภาษีบำรุงท้องที่ </h2>
                                                                                    </div>
                                                                            </div>
                                                                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                            <div class="form-group">
                                                                                                <label  > จำนวนภาษีที่ประเมิน
                                                                                                </label>
                                                                                                <div >
                                                                                                    <input type="text" readonly name="total_estimate[1][]" onkeyup="calculate_1()" class="total_estimate_local form-control col-md-7 col-xs-12 numeric text-right" >
                                                                                                </div>
                                                                                            </div>
                                                                                    </div>

                                                                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                        <div class="form-group">
                                                                                            <label  > เงินเพิ่ม
                                                                                            </label>
                                                                                            <div >
                                                                                                <input type="text" name="tax_interest[1][]" onkeyup="calculate_1()" class="interest_local form-control col-md-7 col-xs-12 numeric text-right" >
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                        <div class="form-group">
                                                                                            <label  > จำนวนเงินภาษี/เงินเพิ่ม
                                                                                            </label>
                                                                                            <div >
                                                                                                <input type="text" readonly name="sum_amount_tax[1][]" onkeyup="calculate_1()" class="total_local form-control col-md-7 col-xs-12 numeric text-right">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                        </div>



                                                            <br/>

                                                        </div>
                                                        </div>
                                                    <?php
    } // if empty
?>

                                                    <?php if (!empty($tax_notice[10])) {
    ?>
                                                        <div role="tabpanel" class="tab-pane fade <?php echo ($tax_id == '10') ? 'active in' : ''; ?> " id="tab_content3" aria-labelledby="tab3">
                                                            <div id="step-3">
                                                            <br>
                                                                    <h2 class="StepTitle">บันทึกข้อมูลภาษีป้าย</h2>
                                                                        <div class="form-group" style="margin-bottom: 0px;">
                                                                                <label class="control-label col-md-4 col-sm-3 col-xs-12" >
                                                                                จำนวนข้อมูลภาษีป้าย
                                                                                </label>
                                                                                <div class="col-md-4 col-sm-6 col-xs-12">
                                                                                    <div class="input-group">

                                                                                    <input type="text" id="num_three" name="banner_amount[2][]" value="<?php echo @$tax_notice_id[2]->banner_amount; ?>"class="form-control total_num_three_edit col-md-4 col-xs-12 tab3_value" onKeyUp="if(this.value*1!=this.value) this.value='' ;">
                                                                                    <input type="hidden" id="num_total_edit_three" name="banner_amount[2][]" value="<?php echo @$tax_notice_id[0]->banner_amount; ?>"class="form-control col-md-4 col-xs-12 tab3_value" onKeyUp="if(this.value*1!=this.value) this.value='' ;">

                                                                                    <input type="hidden"  class="individual_id form-control col-md-4 col-xs-12" name="individual_id[2][]" value="<?php echo @$tax_notice_read[0]->individual_id; ?>" >
                                                                                    <span class="input-group-btn">
                                                                                    <button class="btn btn-success" type="button" id="addNum_three" style="margin-right: 0px;">
                                                                                            <i class="fa fa-plus-square"></i>
                                                                                        </button>
                                                                                    </span>
                                                                                    </div>
                                                                                </div>
                                                                        </div>
                                                                        <hr>




                                                                        <?php
$tax_count = 0;
    foreach ($tax_notice[10] as $key_label => $notice) {
        ++$tax_count; ?>
                                                                             <input type="hidden" class="tax_id" value="<?php echo $notice->tax_id; ?>">
                                                                             <input type="hidden" name="notice_id[2][]" value="<?php echo @$notice->notice_id; ?>" >
                                                                             <input type="hidden" id="notice<?php echo $tax_count; ?>" value="<?php echo @$notice->notice_id; ?>" >
                                                                        <div id="button_three<?php echo $tax_count; ?>"  class="tax-tab-3">

                                                                                <section class="row">
                                                                                        <div class="col-md-6 col-sm-4 col-xs-4">
                                                                                            <h2 class="StepTitle">ภาษีป้าย <?php echo $tax_count; ?></h2>
                                                                                        </div>
                                                                                        <div class="col-md-6 col-sm-8 col-xs-8 text-right" style="margin-top: 7px;">
                                                                                            <div class="btn-group">
                                                                                                <button class="btn btn-danger btn-sm" type="button" style="margin-right: 0px;" title="ลบ" data-name="<?php echo $key; ?>" data-id="<?php echo $notice->notice_id; ?>"  data-toggle="modal" data-target="#delpay_modal_label">
                                                                                                    <i class="fa fa-minus-square"></i>
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                </section>
                                                                                    <?php if ($tax_count == 1) {
            ?>
                                                                                    <div class="form-group" style="margin-bottom: 0px;" >
                                                                                        <div class="row">
                                                                                            <div class="col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 10px;">
                                                                                                    <div class="form-group" style="margin-bottom: 0px;">

                                                                                                        <label >วันที่ประเมิน<span class="required" style="color:red"> *</span></label>
                                                                                                        <input type='text' name="notice_date[2][]" value="<?php echo $this->mydate->date_db2str($notice->notice_date, 543); ?>"data-provide="datepicker" data-date-language="th-th" class="form-control datepicker" />
                                                                                                    </div>
                                                                                            </div>
                                                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                                <div class="form-group" style="margin-bottom: 0px;">
                                                                                                    <label for="middle-name" class="" for="name"> เลขที่รับ ภ.ป.1<span class="required" style="color:red"> *</span>
                                                                                                    </label>
                                                                                                    <div >
                                                                                                        <input type="text" name="notice_number[2][]" value="<?php echo @$notice->notice_number; ?>" placeholder="ระบุเลขที่รับ ภ.ป.1" class="form-control col-md-7 col-xs-12">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-3 col-sm-6 col-xs-12" >
                                                                                                    <div class="form-group">
                                                                                                        <label  > ประจำปีภาษี <span class="required" style="color:red"> *</span>
                                                                                                        </label>

                                                                                                        <select class="form-control" name="tax_year[2][]" type="text">
                                                                                                        <?php foreach ($tax_years as $value): ?>

                                                                                                            <?php if ($notice->tax_year == $value->tax_year_id): ?>
                                                                                                                <option  selected value="<?php echo $value->tax_year_id; ?>">พ.ศ. <?php echo $value->tax_year_label; ?></option>
                                                                                                            <?php else: ?>
                                                                                                                <option value="<?php echo $value->tax_year_id; ?>">พ.ศ. <?php echo $value->tax_year_label; ?></option>
                                                                                                            <?php endif; ?>

                                                                                                        <?php endforeach; ?>
                                                                                                        </select>
                                                                                                    </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <?php
        } //tax_count?>
                                                                                <div class="row">
                                                                                    <div class="col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 10px;">
                                                                                        <div class="form-group" style="margin-bottom: 0px;" >
                                                                                            <label  > จุดสังเกต
                                                                                            </label>
                                                                                            <div >
                                                                                                <input type="text" name="notice_mark[2][]" value="<?php echo @$notice->notice_mark; ?>" placeholder="ระบุจุดสังเกต" class="form-control col-md-7 col-xs-12" >
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-3 col-sm-6 col-xs-12" >
                                                                                            <div class="form-group">
                                                                                                <label  > ตำบล
                                                                                                </label>
                                                                                                    <div >
                                                                                                        <input type="text" name="notice_address_subdistrict[2][]" value="หนองป่าครั่ง" disabled  class="form-control col-md-7 col-xs-12" >
                                                                                                    </div>
                                                                                            </div>
                                                                                    </div>
                                                                                    <div class="col-md-3 col-sm-6 col-xs-12" >
                                                                                                    <div class="form-group">

                                                                                                        <label  > ชื่อสถานประกอบการค้าหรือกิจการอื่น
                                                                                                        </label>
                                                                                                            <div >
                                                                                                                <input type="text" name="noice_name_operation[2][]" value="<?php echo @$notice->noice_name_operation; ?>" placeholder="ระบุชื่อสถานประกอบการค้าหรือกิจการอื่น " class="form-control col-md-7 col-xs-12" >
                                                                                                            </div>
                                                                                                    </div>
                                                                                            </div>
                                                                                            <br>
                                                                                </div>
                                                                                <div class="row">
                                                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                                <div class="form-group">
                                                                                                    <label  > ประเภทป้าย <span class="required" style="color:red"> *</span>
                                                                                                    </label>
                                                                                                    <div >
                                                                                                        <select class="form-control" name="banner_type[2][]" type="text" >
                                                                                                            <?php foreach ($banner as $key => $value) {
            ?>
                                                                                                                <?php if ($notice->banner_type == $value->banner_id): ?>
                                                                                                                    <option  selected value="<?=$value->banner_id; ?>"><?=$value->banner_name; ?></option>
                                                                                                                <?php else: ?>
                                                                                                                <option value="<?=$value->banner_id; ?>"><?=$value->banner_name; ?></option>
                                                                                                                <?php endif; ?>
                                                                                                                    <?php
        } ?>
                                                                                                        </select>

                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                                <label > ความกว้าง<span class="required" style="color:red"> *</span>
                                                                                                </label>
                                                                                                <div >
                                                                                                    <input type="text" name="banner_width[2][]" value="<?php echo @$notice->banner_width; ?>" placeholder="ระบุความกว้าง"  class="form-control col-md-7 col-xs-12">
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                                <label  > ความสูง <span class="required" style="color:red"> *</span>
                                                                                                </label>
                                                                                                <div>
                                                                                                    <input type="text" name="banner_heigth[2][]" value="<?php echo @$notice->banner_heigth; ?>" placeholder="ระบุความสูง" class="form-control col-md-7 col-xs-12">
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col-md-3 col-sm-6 col-xs-12">

                                                                                                <label  > จำนวนภาษีที่ประเมิน <span class="required" style="color:red"> *</span>
                                                                                                </label>
                                                                                                <div>
                                                                                                    <input type="text" name="notice_estimate[2][]" value="<?php echo @$notice->notice_estimate; ?>" onkeyup="calculate_2(<?php echo $key_label; ?>)" class="notice_estimate_label<?php echo $key_label; ?> form-control col-md-7 col-xs-12  numeric text-right">
                                                                                                </div>
                                                                                            </div>


                                                                                        </div>

                                                                                        <div class="row">
                                                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                                <div class="form-group">
                                                                                                <input type="hidden" name="old_image" value="<?php echo $notice->banner_image; ?>">
                                                                                                    <label>อัปโหลดรูปภาพ</label>
                                                                                                        <div class="input-group">
                                                                                                            <span class="input-group-btn">
                                                                                                                <span class="btn btn-success btn-file">
                                                                                                                อัปโหลด <input type="file" name="banner_image<?php echo $key_label; ?>" multiple id="imgInp_<?php echo $key_label; ?>" class="imgInp">
                                                                                                                </span>
                                                                                                            </span>
                                                                                                            <input type="text" name="banner_image<?php echo $key_label; ?>" value="<?php echo @$notice->banner_image; ?>" class="form-control" readonly>
                                                                                                        </div>
                                                                                                        <?php
if (($notice->banner_image) != '' and file_exists('assets/uploads/images/banner/'.$notice->banner_image)) {
            ?>
                                                                                                                <img id="img-upload_<?php echo $key_label; ?>" class="img-upload post_images" src="<?php echo base_url().'/assets/uploads/images/banner/'.$notice->banner_image; ?>">
                                                                                                        <?php
        } ?>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    <hr>

                                                                            </div>

                                                                            <?php
    } // if for?>
                                                                       <div class="row">
                                                                                            <div class="col-md-12 col-sm-6 col-xs-12">
                                                                                                    <div class="form-group">
                                                                                                        <div id="targetDiv3"></div>
                                                                                                    </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <input type="hidden" value="<?php echo $tax_count; ?>" id="count3">
                                                                                    <hr>
                                                                        <div class="row">
                                                                                <div class="col-md-12 col-sm-6 col-xs-12">
                                                                                        <div class="form-group">
                                                                                            <h2 class="StepTitle">รวมค่าภาษีป้าย </h2>
                                                                                        </div>
                                                                                </div>
                                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                                <div class="form-group">
                                                                                                    <label  > จำนวนภาษีที่ประเมิน
                                                                                                    </label>
                                                                                                    <div >
                                                                                                        <input type="text" readonly name="total_estimate[2][]" value="<?php echo @$notice->total_estimate; ?>" onkeyup="calculate_2()" class="total_estimate_label form-control col-md-7 col-xs-12 numeric text-right" >
                                                                                                    </div>
                                                                                                </div>
                                                                                        </div>
                                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                            <div class="form-group">
                                                                                                <label  > เงินเพิ่ม
                                                                                                </label>
                                                                                                <div >
                                                                                                    <input type="text" name="tax_interest[2][]" value="<?php echo @$notice->tax_interest; ?>" onkeyup="calculate_2()" class="interest_label form-control col-md-7 col-xs-12 numeric text-right" >
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                            <div class="form-group">
                                                                                                <label  > จำนวนเงินภาษี/เงินเพิ่ม
                                                                                                </label>
                                                                                                <div >
                                                                                                    <input type="text" readonly name="sum_amount_tax[2][]" value="<?php echo @$notice->sum_amount_tax; ?>" onkeyup="calculate_2()" class="total_label form-control col-md-7 col-xs-12 numeric text-right">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                            </div>

                                                                    </div>
                                                                </div>
                                                     <?php
} else {
        ?>
                                                        <div role="tabpanel" class="tab-pane fade <?php echo ($tax_id == '10') ? 'active in' : ''; ?> " id="tab_content3" aria-labelledby="tab3">
                                                            <div id="step-3">
                                                            <br>
                                                                    <h2 class="StepTitle">บันทึกข้อมูลภาษีป้าย</h2>
                                                                        <div class="form-group" style="margin-bottom: 0px;">
                                                                                <label class="control-label col-md-4 col-sm-3 col-xs-12" >
                                                                                จำนวนข้อมูลภาษีป้าย
                                                                                </label>
                                                                                <div class="col-md-4 col-sm-6 col-xs-12">
                                                                                    <div class="input-group">
                                                                                    <input type="text" id="num_three" name="banner_amount[2][]" class="num_three form-control col-md-4 col-xs-12" value="1" onKeyUp="if(this.value*1!=this.value) this.value='' ;">

                                                                                    <input type="hidden"  class="form-control col-md-4 col-xs-12" name="individual_id[2][]" value="<?php echo @$tax_notice_read[0]->individual_id; ?>" >
                                                                                    <span class="input-group-btn">
                                                                                    <button class="btn btn-success" type="button" id="addNum_three" style="margin-right: 0px;">
                                                                                            <i class="fa fa-plus-square"></i>
                                                                                        </button>
                                                                                    </span>
                                                                                    </div>
                                                                                </div>
                                                                        </div>
                                                                        <hr>
                                                                        <h2 class="StepTitle">ภาษีป้าย </h2>
                                                                        <div class="form-group" style="margin-bottom: 0px;" >
                                                                            <div class="row">
                                                                                <div class="col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 10px;">
                                                                                        <div class="form-group" style="margin-bottom: 0px;">

                                                                                            <label >วันที่ประเมิน<span class="required" style="color:red"> *</span></label>
                                                                                            <input type='text' name="notice_date[2][]" value="<?php echo date('d/m/').(date('Y') + 543); ?>" data-provide="datepicker" data-date-language="th-th" class="form-control datepicker" />
                                                                                        </div>
                                                                                </div>
                                                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                    <div class="form-group" style="margin-bottom: 0px;">
                                                                                        <label for="middle-name" class="" for="name"> เลขที่รับ ภ.ป.1<span class="required" style="color:red"> *</span>
                                                                                        </label>
                                                                                        <div >
                                                                                            <input type="text" name="notice_number[2][]" placeholder="ระบุเลขที่รับ ภ.ป.1" class="form-control col-md-7 col-xs-12">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-3 col-sm-6 col-xs-12" >
                                                                                                    <div class="form-group">

                                                                                                        <label  > ประจำปีภาษี <span class="required" style="color:red"> *</span>
                                                                                                        </label>
                                                                                                        <select class="form-control" name="tax_year[2][]" >
                                                                                                            <?php foreach ($tax_years as $key => $value) {
            ?>
                                                                                                                <option value="<?=$value->tax_year_id; ?>">พ.ศ. <?=$value->tax_year_label; ?></option>
                                                                                                                <?php
        } ?>
                                                                                                        </select>
                                                                                                    </div>
                                                                                            </div>



                                                                            </div>
                                                                        </div>

                                                                                    <div class="row">
                                                                                            <div class="col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 10px;">
                                                                                                <div class="form-group" style="margin-bottom: 0px;" >
                                                                                                    <label  > จุดสังเกต
                                                                                                    </label>
                                                                                                    <div >
                                                                                                        <input type="text" name="notice_mark[2][]" placeholder="ระบุจุดสังเกต" class="form-control col-md-7 col-xs-12" >
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-3 col-sm-6 col-xs-12" >
                                                                                                    <div class="form-group">

                                                                                                        <label  > ตำบล
                                                                                                        </label>
                                                                                                            <div >
                                                                                                                <input type="text" name="notice_address_subdistrict[2][]" value="หนองป่าครั่ง" disabled  class="form-control col-md-7 col-xs-12" >
                                                                                                            </div>
                                                                                                    </div>
                                                                                            </div>

                                                                                            <div class="col-md-3 col-sm-6 col-xs-12" >
                                                                                                    <div class="form-group">

                                                                                                        <label  > ชื่อสถานประกอบการค้าหรือกิจการอื่น
                                                                                                        </label>
                                                                                                            <div >
                                                                                                                <input type="text" name="noice_name_operation[2][]" placeholder="ระบุชื่อสถานประกอบการค้าหรือกิจการอื่น " class="form-control col-md-7 col-xs-12" >
                                                                                                            </div>
                                                                                                    </div>
                                                                                            </div>



                                                                                    </div>



                                                                                <div class="row">
                                                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                                <div class="form-group">
                                                                                                    <label  > ประเภทป้าย <span class="required" style="color:red"> *</span>
                                                                                                    </label>
                                                                                                    <div >
                                                                                                        <select class="form-control" name="banner_type[2][]" type="text" >
                                                                                                            <?php foreach ($banner as $key => $value) {
            ?>
                                                                                                                <option value="<?=$value->banner_id; ?>"><?=$value->banner_name; ?></option>
                                                                                                                <?php
        } ?>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                                <label > ความกว้าง <span class="required" style="color:red"> *</span>
                                                                                                </label>
                                                                                                <div >
                                                                                                    <input type="text" name="banner_width[2][]" placeholder="ระบุความกว้าง"  class="form-control col-md-7 col-xs-12">
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                                <label  > ความสูง <span class="required" style="color:red"> *</span>
                                                                                                </label>
                                                                                                <div>
                                                                                                    <input type="text" name="banner_heigth[2][]" placeholder="ระบุความสูง" class="form-control col-md-7 col-xs-12">
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col-md-3 col-sm-6 col-xs-12">

                                                                                                <label  > จำนวนภาษีที่ประเมิน <span class="required" style="color:red"> *</span>
                                                                                                </label>
                                                                                                <div>
                                                                                                    <input type="text" name="notice_estimate[2][]" onkeyup="calculate_2(0)"  class="notice_estimate_label0 form-control col-md-7 col-xs-12 numeric text-right">
                                                                                                </div>
                                                                                            </div>


                                                                                            </div>
                                                                                </div>


                                                                                    <div class="row">
                                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                            <div class="form-group">
                                                                                                <label>อัปโหลดรูปภาพ</label>
                                                                                                    <div class="input-group">
                                                                                                        <span class="input-group-btn">
                                                                                                            <span class="btn btn-success btn-file">
                                                                                                              อัปโหลด <input type="file" name="banner_image0" multiple id="imgInp_0" class="imgInp">
                                                                                                            </span>
                                                                                                        </span>
                                                                                                        <input type="text" name="banner_image0" value="" class="form-control" readonly>
                                                                                                    </div>
                                                                                                    <img class="img-upload" id="img-upload_0"/>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                        <div class="form-group">
                                                                            <div class="col-md-12 col-sm-6 col-xs-12" style="padding-left: 0px;">
                                                                                    <div class="form-group">
                                                                                        <div id="targetDiv3"></div>
                                                                                    </div>
                                                                            </div>
                                                                        </div>
                                                                            <input type="hidden" value="1" id="count3">
                                                                        <br>
                                                                        <hr>
                                                                        <div class="row">
                                                                            <div class="col-md-12 col-sm-6 col-xs-12">
                                                                                    <div class="form-group">
                                                                                        <h2 class="StepTitle">รวมค่าภาษีป้าย </h2>
                                                                                    </div>
                                                                            </div>
                                                                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                            <div class="form-group">
                                                                                                <label  > จำนวนภาษีที่ประเมิน
                                                                                                </label>
                                                                                                <div >
                                                                                                    <input type="text" readonly name="total_estimate[2][]" onkeyup="calculate_2()" class="total_estimate_label form-control col-md-7 col-xs-12 numeric text-right" >
                                                                                                </div>
                                                                                            </div>
                                                                                    </div>

                                                                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                        <div class="form-group">
                                                                                            <label  > เงินเพิ่ม
                                                                                            </label>
                                                                                            <div >
                                                                                                <input type="text" name="tax_interest[2][]" onkeyup="calculate_2()" class="interest_label form-control col-md-7 col-xs-12 numeric text-right" >
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                        <div class="form-group">
                                                                                            <label  > จำนวนเงินภาษี/เงินเพิ่ม
                                                                                            </label>
                                                                                            <div >
                                                                                                <input type="text" readonly name="sum_amount_tax[2][]" onkeyup="calculate_2()" class="total_label form-control col-md-7 col-xs-12 numeric text-right">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                        </div>



                                                                <br/>
                                                            </div>
                                                            </div>


                                                        </div>
                                                        <?php
    } // if empty
?>

                                                 </div>






                                                <div class="ln_solid"></div>
                                                            <div class="form-group">
                                                                <div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3 text-center">
                                                                    <button type="submit" value="Submit" id="btn-submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก
                                                                    </button>
                                                                    <button onclick="window.location.replace('<?php echo site_url('receive/receive_dashborad'); ?>');" type="button" class="btn btn-warning"><i class="fa fa-close"></i> ยกเลิก
                                                                    </button>
                                                                </div>
                                                            </div>
                                                </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
</div>
</div>

<style>
.btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}

.img-upload{
    width: 100%;
}
</style>

<!-- <script>
  $(function() {
    $('.cls-select').change(function() {

      if ($(this).val() === '4') {
        $('.cls-select:gt(' + $('.cls-select').index($(this)) + ')').val('').prop('disabled', false)
        console.log("1");

      } else {
        $('#select').prop('disabled', true);
      }
    });

  })

</script> -->

<script>



function setScript(){
    auto_setformat();

        $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
        });

        $('.btn-file :file').on('fileselect', function(event, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = label;

            if( input.length ) {
                input.val(log);
            } else {
                if( log ) alert(log);
            }

        });
        function readURL(input,id=0) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#img-upload_'+id).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(".imgInp").change(function(){
            var form_id = this.id;
            var id = form_id.split('_');
            readURL(this,id[1]);
        });
}
        function business(e) {
          if(e.value == 4){
              document.getElementById("type_business"+e.id).disabled = false;
          }
          else{
            document.getElementById("type_business"+e.id).disabled = true;
          }
        }
        function auto_year(e){
          var year = Number(e.value)+3 ;
          document.getElementById("local_year"+e.id).value = year;
        }
        function select(id) {

        $('.cls-select').change(function() {

        if ($(this).val() === '4') {
        $('.cls-select:gt(' + $('.cls-select').index($(this)) + ')').val('').prop('disabled', false)
        console.log("1");

        } else {
            $('.select').prop('disabled', true);
        }
        });
        }

        $(document).ready( function() {
            setScript();

        });
</script>


<script>
    function house(id) {
        group = '<div id="button_one'+id+'"  class="tax-tab-1">' + // create group template
                '<hr/>'+
                '<br>'+
                    '<section class="row">'+
                        '<div class="col-md-6 col-sm-4 col-xs-4">'+
                            '<h2 class="StepTitle">ภาษีโรงเรือนและที่ดิน </h2>'+
                        '</div>'+
                        '<div class="col-md-6 col-sm-8 col-xs-8 text-right" style="margin-top: 7px;">'+
                            '<div class="btn-group">'+
                                '<button class="btn btn-danger btn-sm " onclick="remove_tab_house('+(id-1)+')" title="ลบ" type="button" style="margin-right: 0px;">'+
                                    '<i class="fa fa-minus-square"></i>'+
                                '</button>'+
                            '</div>'+
                        '</div>'+
                    '</section>'+
                                '<div class="row">'+

                                    '<div class="col-md-3 col-sm-6 col-xs-12">'+
                                                '<div class="form-group" >'+
                                                    '<label  > เลขที่โฉนด</label>'+
                                                    '<div >'+
                                                        '<input type="text" name="land_deed_number[0][]" placeholder="ระบุเลขที่โฉนด" class="form-control col-md-7 col-xs-12" >'+
                                                    '</div>'+
                                                '</div>'+
                                                '</div>'+

                                        '<div class="col-md-3 col-sm-6 col-xs-12">'+
                                            '<div class="form-group">'+
                                            ' <label  > ประกอบกิจการ'+
                                                '</label>'+
                                                '<div >'+
                                                        '<select class="form-control" name="noice_type_operation[0][]"  id="'+id+'" onchange="business(this)">'+
                                                            '<?php foreach ($operation as $key => $value) {
    ?>'+
                                                                '<option value="<?=$value->noice_operation_id; ?>"><?=$value->noice_operation_name; ?></option>'+
                                                                '<?php
}?>'+
                                                        '</select>'+
                                            ' </div>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col-md-3 col-sm-6 col-xs-12 ">'+
                                                        '<div class="form-group" >'+
                                                            '<label for="middle-name" > ประเภทกิจการ'+
                                                            '</label>'+
                                                            '<div >'+
                                                                '<input type="text" name="noice_name_operation_other[0][]" id="type_business'+id+'" placeholder="ระบุประเภทกิจการ" class="select cls-select form-control col-md-7 col-xs-12" disabled>'+
                                                            '</div>'+
                                                        '</div>'+
                                                '</div>'+
                                        '<div class="col-md-3 col-sm-6 col-xs-12">'+
                                                '<div class="form-group" style="margin-bottom: 0px;">'+
                                                    '<label for="middle-name" > ชื่อสถานประกอบการค้าหรือกิจการอื่น'+
                                                    '</label>'+
                                                    '<div >'+
                                                        '<input type="text"  name="noice_name_operation[0][]" placeholder="ระบุชื่อสถานประกอบการค้าหรือกิจการอื่น" class="form-control col-md-7 col-xs-12">'+
                                                    '</div>'+
                                                '</div>'+
                                        '</div>'+
                                '</div>'+

                                '<div class="row">'+
                                            '<div class="col-md-3 col-sm-6 col-xs-12">'+
                                                '<div class="form-group">'+
                                                    '<label  > เลขที่</label>'+
                                                    '<div >'+
                                                        '<input type="text" name="notice_address_number[0][]" placeholder="ที่อยู่โรงเรือน/สิ่งปลูกสร้าง" class="form-control col-md-7 col-xs-12" >'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+

                                            '<div class="col-md-3 col-sm-6 col-xs-12">'+
                                            '        <div class="form-group" >'+
                                            '          <label for="middle-name" class="" for="last_name"> หมู่ที่'+
                                            '          </label>'+
                                            '          <div >'+
                                            '              <input type="text" name="notice_address_moo[0][]" placeholder="หมู่ที่อยู่โรงเรือน/สิ่งปลูกสร้าง" class="form-control col-md-7 col-xs-12">'+
                                            '          </div>'+
                                            '      </div>'+
                                            '</div>'+

                                            '<div class="col-md-3 col-sm-6 col-xs-12">'+
                                            '  <div class="form-group">'+
                                            '    <label  > ตำบล'+
                                            '    </label>'+
                                            '    <div >'+
                                            '        <input type="text" name="notice_address_subdistrict[0][]" value="หนองป่าครั่ง" disabled  class="form-control col-md-7 col-xs-12" >'+
                                            '    </div>'+
                                            '  </div>'+
                                            '</div>'+
                                ' </div>'+



                                '<div class="row">'+
                                        '<div class="col-md-3 col-sm-6 col-xs-12">'+
                                                    '<div class="form-group" style="margin-bottom: 0px;">'+
                                                        '<label for="middle-name" > ค่ารายปี'+
                                                        '<span class="required" style="color:red"> *</span>'+
                                                    ' </label>'+
                                                        '<div >'+
                                                            '<input type="text" name="notice_annual_fee[0][]" onkeyup="calculate_estimate_house(this,'+(id-1)+')" id="notice_estimate_house'+(id-1)+'" class="notice_estimate_house'+(id-1)+' form-control col-md-7 col-xs-12 numeric text-right" >'+
                                                        '</div>'+
                                                    '</div>'+
                                        '</div>'+

                                '          <div class="col-md-3 col-sm-6 col-xs-12">'+
                                                '<div class="form-group">'+
                                                            '<label  > จำนวนภาษีที่ประเมิน'+
                                                            '<span class="required" style="color:red"> *</span>'+
                                                            '</label>'+
                                                            '<div >'+
                                                                '<input type="text" name="notice_estimate[0][]" onkeyup="calculate('+(id-1)+')" id="estimate'+(id-1)+'" class="estimate'+(id-1)+' form-control col-md-7 col-xs-12 numeric text-right" >'+
                                                            '</div>'+
                                                        '</div>'+
                                                    '</div>'+
                                '          <div class="col-md-3 col-sm-6 col-xs-12">'+
                                '              <div class="form-group">'+
                                '                <label  > ประจำปีภาษี'+
                                '                <span class="required" style="color:red"> *</span>'+
                                '                </label>'+
                                '                <div >'+
                                                        '<select class="form-control" name="tax_year[0][]" >'+
                                                        '<?php foreach ($tax_years as $key => $value) {
        ?>'+
                                                                    '<option value="<?=$value->tax_year_id; ?>">พ.ศ. <?=$value->tax_year_label; ?></option>'+
                                                                    '<?php
    }?>'+
                                                        '</select>'+
                                '                </div>'+
                                '              </div>'+
                                '          </div>'+
                                '</div>'+
                        ' </div>';

                        return group;

    }


        $(function(){
                        $('#addNum_one').bind('click',function(){
                          //
                          var n = document.getElementById("num_one").value; // number of groups to add
                          var count = document.getElementById("count1").value;

                          if(Number(n) > Number(count)){
                            var diff = n-count;
                            for(i=1;i<=diff;i++){
                              count = Number(count)+1;
                              var groups = house(count);
                              $('#targetDiv1').append(groups);
                              document.getElementById("count1").value = count;
                            }
                          }
                          else if(Number(n) < Number(count)){
                            for(i=count;i>n;i--){
                              document.getElementById("button_one"+i).remove();
                              if( document.getElementById("notice"+i)){
                                var notice = document.getElementById("notice"+i).value;
                                var groups = '<input type="hidden" name="delete[]" value="'+ notice +'">';
                                $('#targetDiv1').append(groups);
                              }
                            }
                            document.getElementById("count1").value = n;
                            calculate(0);
                          }
                          setScript();
                    });

        });


        function local(id) {
                 group = '<div id="button_two'+id+'" class="tax-tab-2">' +
                             '<hr/>'+
                             '<br>'+
                                '<section class="row">'+
                                    '<div class="col-md-6 col-sm-4 col-xs-4">'+
                                        '<h2 class="StepTitle">ภาษีบำรุงท้องที่ </h2>'+
                                    '</div>'+
                                    '<div class="col-md-6 col-sm-8 col-xs-8 text-right" style="margin-top: 7px;">'+
                                        '<div class="btn-group">'+
                                            '<button class="btn btn-danger btn-sm " onclick="remove_tab_local('+(id-1)+')" title="ลบ" type="button" style="margin-right: 0px;">'+
                                                '<i class="fa fa-minus-square"></i>'+
                                            '</button>'+
                                        '</div>'+
                                    '</div>'+
                                '</section>'+

                                                 '<div class="row">'+
                                                         '<div class="col-md-3 col-sm-6 col-xs-12">'+
                                                         '<div class="form-group" >'+
                                                             '<label  > เลขที่โฉนด</label>'+
                                                             '<div >'+
                                                                 '<input type="text" name="land_deed_number[1][]"  placeholder="ระบุเลขที่โฉนด" class="form-control col-md-7 col-xs-12" >'+
                                                             '</div>'+
                                                         '</div>'+
                                                         '</div>'+
                                                     '<div class="col-md-3 col-sm-6 col-xs-12">'+
                                                         '<div class="form-group">'+
                                                         ' <label  > จุดสังเกต'+
                                                             '</label>'+
                                                             '<div >'+
                                                                     '<input type="text" name="notice_mark[1][]" placeholder="ระบุจุดสังเกต" class="form-control col-md-7 col-xs-12" >'+
                                                         ' </div>'+
                                                         '</div>'+
                                                     '</div>'+
                                                     '<div class="col-md-3 col-sm-6 col-xs-12">'+
                                                             '<div class="form-group" style="margin-bottom: 0px;">'+
                                                                 '<label for="middle-name" > หมู่ที่'+
                                                                 '</label>'+
                                                                 '<div >'+
                                                                     '<input type="text" name="notice_address_moo[1][]" placeholder="หมู่ที่ตั้งที่ดิน" class="form-control col-md-7 col-xs-12">'+
                                                                 '</div>'+
                                                             '</div>'+
                                                     '</div>'+
                                                     '<div class="col-md-3 col-sm-6 col-xs-12">'+
                                                             '<div class="form-group" style="margin-bottom: 0px;">'+
                                                                 '<label for="middle-name" > ตำบล'+
                                                                 '</label>'+
                                                                 '<div >'+
                                                                 ' <input type="text" name="notice_address_subdistrict[1][]" value="หนองป่าครั่ง" disabled  class="form-control col-md-7 col-xs-12" >'+
                                                                 '</div>'+
                                                             '</div>'+
                                                     '</div>'+
                                             '</div>'+
                                             '<div class="row">'+
                                                     '<div class="col-md-3 col-sm-6 col-xs-12">'+
                                                         '<div class="form-group">'+
                                                         ' <label  > เนื้อที่ดิน (ไร่)'+
                                                         ' <span class="required" style="color:red"> *</span>'+
                                                             '</label>'+
                                                             '<div >'+
                                                                 '<input type="text" name="land_rai[1][]" placeholder="ระบุเนื้อที่ดิน (ไร่)" onkeyup="land('+id+')" class="land_rai'+id+' form-control col-md-7 col-xs-12">'+
                                                         ' </div>'+
                                                         '</div>'+
                                                     '</div>'+
                                                     '<div class="col-md-3 col-sm-6 col-xs-12">'+
                                                             '<div class="form-group" style="margin-bottom: 0px;">'+
                                                                 '<label for="middle-name" > เนื้อที่ดิน (งาน)'+
                                                                 ' <span class="required" style="color:red"> *</span>'+
                                                                 '</label>'+
                                                                 '<div >'+
                                                                     '<input type="text" name="land_ngan[1][]" placeholder="ระบุเนื้อที่ดิน (งาน)" onkeyup="land('+id+')" class="land_ngan'+id+' form-control col-md-7 col-xs-12">'+
                                                                 '</div>'+
                                                             '</div>'+
                                                     '</div>'+
                                                     '<div class="col-md-3 col-sm-6 col-xs-12">'+
                                                             '<div class="form-group" style="margin-bottom: 0px;">'+
                                                                 '<label for="middle-name" > เนื้อที่ดิน (วา)'+
                                                                 ' <span class="required" style="color:red"> *</span>'+
                                                                 '</label>'+
                                                                 '<div >'+
                                                                     '<input type="text" name="land_wa[1][]" placeholder="ระบุเนื้อที่ดิน (วา)" onkeyup="land('+id+')" class="land_wa'+id+' form-control col-md-7 col-xs-12">'+
                                                                 '</div>'+
                                                             '</div>'+
                                                     '</div>'+
                                             '</div>'+

                                             '<div class="row">'+
                                                     '<div class="col-md-3 col-sm-6 col-xs-12">'+
                                                         '<div class="form-group">'+
                                                         ' <label  > เนื้อที่ดินที่ต้องชำระภาษี'+
                                                         ' <span class="required" style="color:red"> *</span>'+
                                                             '</label>'+
                                                             '<div >'+
                                                                 '<input type="text" name="land_tax[1][]"  onkeyup="land('+id+')" class="total_land'+id+' form-control col-md-7 col-xs-12">'+
                                                         ' </div>'+
                                                         '</div>'+
                                                     '</div>'+
                                                     '<div class="col-md-3 col-sm-6 col-xs-12">'+
                                                             '<div class="form-group" style="margin-bottom: 0px;">'+
                                                                 '<label for="middle-name" > จำนวนภาษีที่ประเมิน'+
                                                                     ' <span class="required" style="color:red"> *</span>'+
                                                                 '</label>'+
                                                                 '<div >'+
                                                                     '<input type="text" name="notice_estimate[1][]" onkeyup="calculate_1('+(id-1)+')"  class="notice_estimate_local'+(id-1)+' form-control col-md-7 col-xs-12 numeric text-right">'+
                                                                 '</div>'+
                                                             '</div>'+
                                                     '</div>'+
                                                     '<div class="col-md-4 col-sm-6 col-xs-12">'+
                                                             '<div class="form-group" style="margin-bottom: 0px;">'+
                                                                 '<label for="middle-name" > ชำระภาษีบำรุงท้องที่ปี'+
                                                                 ' <span class="required" style="color:red"> *</span>'+
                                                                 '</label>'+
                                                                 '<div >'+
                                                                             '<div class="col-md-5 col-sm-6 col-xs-12" style="padding-left: 0px;">'+
                                                                                 '<select class="form-control" name="tax_year[1][]" type="text" id="'+id+'" onchange="auto_year(this)">'+
                                                                                 '<?php foreach ($tax_years as $key => $value) {
        ?>'+
                                                                                     '<option value="<?=$value->tax_year_id; ?>"  <?php if (date('Y') == $value->tax_year_id) {
            echo 'selected';
        } ?>>พ.ศ. <?=$value->tax_year_label; ?></option>'+
                                                                                 ' <?php
    }?>'+
                                                                             ' </select>'+
                                                                             '</div>'+
                                                                             '<div class="col-md-2 col-sm-6 col-xs-12" align="center"><label>ถึง</label></div>'+
                                                                             '<div class="col-md-5 col-sm-6 col-xs-12" style="padding-right: 0px;">'+
                                                                                 '<select class="form-control" name="tax_local_year[1][]" id="local_year'+id+'" type="text" >'+
                                                                                     '<?php foreach ($tax_years as $key => $value) {
        ?>'+
                                                                                     '<option value="<?=$value->tax_year_id; ?>" <?php if ((date('Y') + 3) == $value->tax_year_id) {
            echo 'selected';
        } ?>>พ.ศ. <?=$value->tax_year_label; ?></option>'+
                                                                                 ' <?php
    }?>'+
                                                                                     '</select>'+
                                                                             '</div>'+
                                                                 '<div >'+

                                                                 '</div>'+
                                                             '</div>'+
                                                     '</div>'+
                                             '</div>'+
                                             '</div>'+
                                     ' </div>';

                                 return group;
        }

            $(function(){
                            $('#addNum_two').bind('click',function(){
                              //
                              var n = document.getElementById("num_two").value; // number of groups to add
                              var count = document.getElementById("count2").value;

                              if(Number(n) > Number(count)){
                                var diff = n-count;
                                for(i=1;i<=diff;i++){
                                  count = Number(count)+1;
                                  var groups = local(count);
                                  $('#targetDiv2').append(groups);
                                  document.getElementById("count2").value = count;
                                }
                              }
                              else if(Number(n) < Number(count)){
                                for(i=count;i>n;i--){
                                  document.getElementById("button_two"+i).remove();
                                  if( document.getElementById("notice"+i)){
                                    var notice = document.getElementById("notice"+i).value;
                                    var groups = '<input type="hidden" name="delete[]" value="'+ notice +'">';
                                    $('#targetDiv2').append(groups);
                                  }
                                }
                                document.getElementById("count2").value = n;
                                calculate_1(0);
                              }
                              setScript();
                        });
            });

            function label(id) {
                group = '<div id="button_three'+id+'"  class="tax-tab-3">' +
                 '<hr/>'+
                 '<br>'+
                 '<section class="row">'+
                     '<div class="col-md-6 col-sm-4 col-xs-4">'+
                        '<h2 class="StepTitle">ภาษีป้าย </h2>'+
                     '</div>'+
                     '<div class="col-md-6 col-sm-8 col-xs-8 text-right" style="margin-top: 7px;">'+
                         '<div class="btn-group">'+
                             '<button class="btn btn-danger btn-sm " onclick="remove_tab_label('+(id-1)+')" title="ลบ" type="button" style="margin-right: 0px;">'+
                                 '<i class="fa fa-minus-square"></i>'+
                             '</button>'+
                         '</div>'+
                     '</div>'+
                 '</section>'+
                     '<div class="row">'+

                     '<div class="col-md-3 col-sm-6 col-xs-12">'+
                                 '<div class="form-group" >'+
                                     '<label  > จุดสังเกต</label>'+
                                         '<div >'+
                                             '<input type="text" name="notice_mark[2][]" placeholder="ระบุจุดสังเกต" class="form-control col-md-7 col-xs-12" >'+
                                             '</div>'+
                                 '</div>'+
                             '</div>'+

                         '<div class="col-md-3 col-sm-6 col-xs-12">'+
                                 '<div class="form-group" >'+
                                     '<label  > ตำบล</label>'+
                                         '<div >'+
                                             '<input type="text" name="notice_address_subdistrict[2][]" value="หนองป่าครั่ง" disabled  class="form-control col-md-7 col-xs-12" >'+
                                             '</div>'+
                                 '</div>'+
                             '</div>'+
'<div class="col-md-3 col-sm-6 col-xs-12">'+
		'<div class="form-group" >'+
			'<label for="middle-name" > ชื่อสถานประกอบการค้าหรือกิจการอื่น</label>'+
			'<div >'+
				'<input type="text" name="noice_name_operation[0][]"  value="" placeholder="ระบุชื่อสถานประกอบการค้าหรือกิจการอื่น" id="noice_name_operation" class="form-control col-md-7 col-xs-12">'+
			'</div>'+
	   '</div>'+
'</div>'+


                         '<div class="col-md-3 col-sm-6 col-xs-12">'+
                         '<div class="form-group" >'+
                         '</div>'+
                         '</div>'+


                     ' </div>'+

                         '<div class="col-md-3 col-sm-6 col-xs-12" style="padding-left: 0px;">'+
                                 '<div class="form-group" >'+
                                     '<label  > ประเภทป้าย</label>'+
                                     '<span class="required" style="color:red"> *</span>'+
                                         '<div >'+
                                         '<select class="form-control" name="banner_type[2][]" type="text" >'+
                                                     '<?php foreach ($banner as $key => $value) {
        ?>'+
                                                         '<option value="<?=$value->banner_id; ?>"><?=$value->banner_name; ?></option>'+
                                                         '<?php
    }?>'+
                                             '</select>'+                                                                '</div>'+
                                 '</div>'+
                             '</div>'+


                         '<div class="col-md-3 col-sm-6 col-xs-12">'+
                                 '<div class="form-group" >'+
                                     '<label  > ความกว้าง</label>'+
                                     '<span class="required" style="color:red"> *</span>'+
                                         '<div >'+
                                             '<input type="text" name="banner_width[2][]" placeholder="ระบุความกว้าง" class="form-control col-md-7 col-xs-12">'+
                                             '</div>'+
                                 '</div>'+
                             '</div>'+

                             '<div class="col-md-3 col-sm-6 col-xs-12">'+
                                 '<div class="form-group" >'+
                                     '<label  > ความสูง</label>'+
                                     '<span class="required" style="color:red"> *</span>'+
                                         '<div >'+
                                         '<input type="text" name="banner_heigth[2][]" placeholder=ระบุความสูง class="form-control col-md-7 col-xs-12">'+
                                         '</div>'+
                                 '</div>'+
                             '</div>'+

                             '<div class="col-md-3 col-sm-6 col-xs-12">'+
                                 '<div class="form-group" >'+
                                     '<label  > จำนวนภาษีที่ประเมิน</label>'+
                                     '<span class="required" style="color:red"> *</span>'+
                                         '<div >'+
                                         '<input type="text" name="notice_estimate[2][]" onkeyup="calculate_2('+(id-1)+')"  class="notice_estimate_label'+(id-1)+' form-control col-md-7 col-xs-12 numeric text-right">'+
                                         '</div>'+
                                 '</div>'+
                             '</div>'+


                     '<div class="row">'+
                             '<div class="col-md-3 col-sm-6 col-xs-12">'+
                                 '<div class="form-group">'+
                                     '<label>อัปโหลดรูปภาพ</label>'+
                                         '<div class="input-group">'+
                                             '<span class="input-group-btn">'+
                                                 '<span class="btn btn-success btn-file">'+
                                                 'อัปโหลด <input type="file" name="banner_image'+(id-1)+'" id="imgInp_'+id+'" class="imgInp">'+
                                                 '</span>'+
                                             '</span>'+
                                             '  <input type="text" name="banner_image'+(id-1)+'" value="" class="form-control" readonly>'+
                                         '</div>'+
                                     '<img class="img-upload" id="img-upload_'+id+'"/>'+
                                 '</div>'+
                         '</div>'+
                     '</div>'+
                ' </div>';

                return group;
            }

                $(function(){
                        $('#addNum_three').bind('click',function(){
                        //
                        var n = document.getElementById("num_three").value; // number of groups to add
                        var count = document.getElementById("count3").value;

                        if(Number(n) > Number(count)){
                          var diff = n-count;
                          for(i=1;i<=diff;i++){
                            count = Number(count)+1;
                            var groups = label(count);
                            $('#targetDiv3').append(groups);
                            document.getElementById("count3").value = count;
                          }
                        }
                        else if(Number(n) < Number(count)){
                          for(i=count;i>n;i--){
                            document.getElementById("button_three"+i).remove();
                            if( document.getElementById("notice"+i)){
                              var notice = document.getElementById("notice"+i).value;
                              var groups = '<input type="hidden" name="delete[]" value="'+ notice +'">';
                              $('#targetDiv3').append(groups);
                            }
                          }
                          document.getElementById("count3").value = n;
                          calculate_2(0);
                        }
                        setScript();
                    });
                });
</script>

<!-- Modal Popup -->
        <div class="modal fade" id="delpay_modal_local" tabindex="-1" role="dialog" aria-labelledby="delmodal_local" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                    <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="delmodal_local">การแจ้งเตือน!</h4>
                      </div>


                      <div class="modal-body">
                              <h5 align="center">ต้องการลบข้อมูลรายการนี้ใช่หรือไม่</h5>
                      </div>

                      <div class="modal-footer">
                          <button type="button" id="btn-delpay_local"  class="btn btn-danger"><i class="fa fa-trash"></i> ลบ
                          </button>

                          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก
                          </button>
                      </div>
                  </div>
              </div>
            </div>
        </div>

<!-- Modal Popup -->
        <div class="modal fade" id="delpay_modal_label" tabindex="-1" role="dialog" aria-labelledby="delmodal_label" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                    <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="delmodal_label">การแจ้งเตือน!</h4>
                      </div>


                      <div class="modal-body">
                              <h5 align="center">ต้องการลบข้อมูลรายการนี้ใช่หรือไม่</h5>
                      </div>

                      <div class="modal-footer">
                          <button type="button" id="btn-delpay_label"  class="btn btn-danger"><i class="fa fa-trash"></i> ลบ
                          </button>

                          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก
                          </button>
                      </div>
                  </div>
              </div>
            </div>
        </div>

<!-- Modal Popup -->
<div class="modal fade" id="delpay_modal_house" tabindex="-1" role="dialog" aria-labelledby="delmodal_house" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                    <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="delmodal_house">การแจ้งเตือน!</h4>
                      </div>


                      <div class="modal-body">
                              <h5 align="center">ต้องการลบข้อมูลรายการนี้ใช่หรือไม่</h5>
                      </div>

                      <div class="modal-footer">
                          <button type="button" id="btn-delpay_house"  class="btn btn-danger"><i class="fa fa-trash"></i> ลบ
                          </button>

                          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก
                          </button>
                      </div>
                  </div>
              </div>
            </div>
        </div>
<script>
var tab3 = $(".tax-tab-3").length;
$(".tab3_value").val(tab3);

var tab2 = $(".tax-tab-2").length;
$(".tab2_value").val(tab2);

var tab1 = $(".tax-tab-1").length;
$(".tab1_value").val(tab1);
</script>