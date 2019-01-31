
<div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>บันทึกรายรับภาษีอื่น</h3>
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

                                <?php echo form_open('receive/update_other_tax') ?>
                                        <div class="form-horizontal form-label-left">
                                                <input type="hidden" name="receive_id"  value="<?php echo $other_tax[0]['receive_id'] ?>">

                                                <div class="form-group">
                                                    <label class="control-label col-md-4 col-sm-3 col-xs-12">
                                                        เลขที่ใบเสร็จ <span class="required" style="color:red">*</span>
                                                    </label>
                                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                                        <input type="text" name="receipt_no" value="<?php echo $other_tax[0]['receipt_no'] ?>" placeholder="ระบุเลขที่ใบเสร็จ" class="form-control col-md-7 col-xs-12">
                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4 col-sm-3 col-xs-12">
                                                        เล่มที่ใบเสร็จ <span class="required" style="color:red">*</span>
                                                    </label>
                                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                                        <input type="text" name="receipt_number" value="<?php echo $other_tax[0]['receipt_number'] ?>" placeholder="ระบุเล่มที่ใบเสร็จ" class="form-control col-md-7 col-xs-12">
                                                        </div>
                                                </div>

                                                <div class="form-group">
                                                            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first">
                                                            หมวดรายได้ <span class="required" style="color:red">*</span>
                                                            </label>
                                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                                    <select id="colorselector" name="tax_id" class="form-control selectpicker" data-hide-disabled="true" data-live-search="true" >
                                                                        <optgroup label="หมวดภาษีจัดสรร">
                                                                            <?php foreach ($tax_allocate as $key) : ?>

                                                                                <?php if ($other_tax[0]['tax_id'] == $key['tax_id']) : ?>
                                                                                    <option  selected value="<?php echo $key['tax_id'] ?>"><?php echo $key['tax_name'] ?></option>
                                                                                <?php else : ?>
                                                                                    <option  value="<?php echo $key['tax_id'] ?>"><?php echo $key['tax_name'] ?></option>
                                                                                <?php endif; ?>

                                                                            <?php endforeach; ?>
                                                                        </optgroup>
                                                                        <optgroup label="หมวดค่าธรรมเนียม ค่าปรับ และใบอนุญาต">
                                                                            <?php foreach ($tax_fine as $key) : ?>

                                                                                <?php if ($other_tax[0]['tax_id'] == $key['tax_id']) : ?>
                                                                                    <option  selected value="<?php echo $key['tax_id'] ?>"><?php echo $key['tax_name'] ?></option>
                                                                                <?php else : ?>
                                                                                    <option  value="<?php echo $key['tax_id'] ?>"><?php echo $key['tax_name'] ?></option>
                                                                                <?php endif; ?>

                                                                            <?php endforeach; ?>
                                                                        </optgroup>
                                                                        <optgroup label="หมวดรายได้จากทรัพย์สิน">
                                                                            <?php foreach ($tax_asset as $key) : ?>

                                                                                <?php if ($other_tax[0]['tax_id'] == $key['tax_id']) : ?>
                                                                                    <option  selected value="<?php echo $key['tax_id'] ?>"><?php echo $key['tax_name'] ?></option>
                                                                                <?php else : ?>
                                                                                    <option  value="<?php echo $key['tax_id'] ?>"><?php echo $key['tax_name'] ?></option>
                                                                                <?php endif; ?>

                                                                            <?php endforeach; ?>
                                                                        </optgroup>
                                                                        <optgroup label="หมวดรายได้สาธารณูปโภคและสาธารณสุขฯ">
                                                                            <?php foreach ($tax_health as $key) : ?>

                                                                                <?php if ($other_tax[0]['tax_id'] == $key['tax_id']) : ?>
                                                                                    <option  selected value="<?php echo $key['tax_id'] ?>"><?php echo $key['tax_name'] ?></option>
                                                                                <?php else : ?>
                                                                                    <option  value="<?php echo $key['tax_id'] ?>"><?php echo $key['tax_name'] ?></option>
                                                                                <?php endif; ?>

                                                                            <?php endforeach; ?>
                                                                        </optgroup>
                                                                        <optgroup label="หมวดรายได้เบ็ดเตล็ด">
                                                                            <?php foreach ($tax_miscellaneous as $key) : ?>

                                                                                <?php if ($other_tax[0]['tax_id'] == $key['tax_id']) : ?>
                                                                                    <option  selected value="<?php echo $key['tax_id'] ?>"><?php echo $key['tax_name'] ?></option>
                                                                                <?php else : ?>
                                                                                    <option  value="<?php echo $key['tax_id'] ?>"><?php echo $key['tax_name'] ?></option>
                                                                                <?php endif; ?>

                                                                            <?php endforeach; ?>

                                                                        </optgroup>
                                                                        <optgroup label="หมวดเงินอุดหนุน">
                                                                            <?php foreach ($tax_subsidy as $key) : ?>

                                                                                <?php if ($other_tax[0]['tax_id'] == $key['tax_id']) : ?>
                                                                                    <option  selected value="<?php echo $key['tax_id'] ?>"><?php echo $key['tax_name'] ?></option>
                                                                                <?php else : ?>
                                                                                    <option  value="<?php echo $key['tax_id'] ?>"><?php echo $key['tax_name'] ?></option>
                                                                                <?php endif; ?>

                                                                            <?php endforeach; ?>
                                                                        </optgroup>
                                                                    </select>
                                                                </div>
                                                </div>

                                                <div class="form-group" style="margin-bottom: 0px;">
                                                        <label for="second" class="control-label col-md-4 col-sm-3 col-xs-12" for="">
                                                        วันที่รับ <span class="required" style="color:red">*</span>
                                                        </label>
                                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                                        <div class='input-group date col-md-12 col-xs-12'>
                                                            <input type='text' name="receive_date" value="<?php echo $this->mydate->date_db2str($other_tax[0]['receive_date'], 543); ?>"data-provide="datepicker" data-date-language="th-th" class="form-control datepicker" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-4 col-sm-3 col-xs-12" >เลขที่ประจำตัวประชาชน/เลขที่นิติบุคคล ผู้ที่ชำระภาษี</label>
                                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                                        <input type="text" name="individual_number" value="<?php echo $other_tax[0]['individual_number'] ?>" placeholder="เลขที่ประจำตัวประชาชน/เลขที่นิติบุคคล" class="form-control col-md-7 col-xs-12">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4 col-sm-3 col-xs-12" >ชื่อผู้ที่ชำระภาษี</label>
                                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                                        <input type="text" name="individual_name" value="<?php echo $other_tax[0]['individual_name'] ?>" placeholder="ชื่อผู้ที่ชำระภาษี" class="form-control col-md-7 col-xs-12">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-4 col-sm-3 col-xs-12">
                                                    จำนวนภาษี <span class="required" style="color:red">*</span>
                                                    </label>
                                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                                        <input type="text" name="receive_amount" value="<?php echo $other_tax[0]['receive_amount'] ?>" placeholder="0.00" class="numeric form-control col-md-7 col-xs-12">
                                                        </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-4 col-sm-3 col-xs-12" >ผู้รับเงิน</label>
                                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                                        <select id="receive_user_selector" name="receive_user" class="form-control selectpicker" data-hide-disabled="true" data-live-search="true" >
                                                            <option value="">ผู้รับเงิน</option>
                                                          <?php foreach ($receive_user as $key => $value) { ?>
                                                              <option value="<?php echo $value->user_id; ?>" <?php echo (($value->user_id == $other_tax[0]['receive_user']) ? 'selected' : '') ?>><?php echo $value->prename_th . $value->user_firstname . ' ' . $value->user_lastname; ?></option>
                                                              <?php

                                                            } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <hr>

                                                <div class="form-group">
                                                    <div class="text-center">
                                                        <button type="submit" id="btn-submit" value="Submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก
                                                        </button>

                                                        <button onclick="window.location.replace('<?php echo site_url('receive/other_tax'); ?>');" type="button" class="btn btn-warning"><i class="fa fa-close"></i> ยกเลิก
                                                        </button>
                                                    </div>
                                                </div>
                                        </div>

                                <?php echo form_close('') ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>


<script>
// check potection expenditure in
	$('#btn-submit').click(function(){

		if ($("input[name='receipt_no']").val() == '') {
			alertify.error('กรุณาระบุ เลขที่ใบเสร็จ');
			$("input[name='receipt_no']").focus();
			return false;
		}
		if ($("input[name='receipt_number']").val() == '') {
			alertify.error('กรุณาระบุ เล่มที่ใบเสร็จ');
			$("input[name='receipt_number']").focus();
			return false;
        }
        if ($("input[name='tax_id']").val() == '') {
			alertify.error('กรุณา เลือกหมดรายได้');
			$("input[name='tax_id']").focus();
			return false;
        }
        if ($("input[name='receive_date']").val() == '') {
			alertify.error('กรุณาระบุ วันที่รับ');
			$("input[name='receive_date']").focus();
			return false;
        }
        if ($("input[name='receive_amount']").val() == '') {
			alertify.error('กรุณาระบุ จำนวนภาษี');
			$("input[name='receive_amount']").focus();
			return false;
		}
    });
</script>
