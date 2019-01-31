<div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>แก้ไขรายการรายรับ</h3>
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
                            <br />

                                <?php echo form_open('Receive/update_Outside') ?>
                                        <div class="form-horizontal form-label-left">

                                                <div class="form-group">
                                                    <label class="control-label col-md-4 col-sm-3 col-xs-12">
                                                        รายการรายรับนอกงบประมาณ <span class="required" style="color:red">*</span>
                                                    </label>
                                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                                        <input type="text" name="outside_name" value="<?php echo $outside_tax_edit[0]['outside_name'] ?>"  class="form-control col-md-7 col-xs-12">
                                                        </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-4 col-sm-3 col-xs-12">
                                                        รหัสบัญชี <span class="required" style="color:red">*</span>
                                                    </label>
                                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                                        <input type="text" name="outside_number" value="<?php echo $outside_tax_edit[0]['outside_number'] ?>"  class="form-control col-md-7 col-xs-12">
                                                        </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-4 col-sm-3 col-xs-12">
                                                        เดบิท <span class="required" style="color:red">*</span>
                                                    </label>
                                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                                        <input type="text" name="outside_debit" value="<?php echo $outside_tax_edit[0]['outside_debit'] ?>"  class="form-control col-md-7 col-xs-12">
                                                        </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-4 col-sm-3 col-xs-12">
                                                        เครดิต <span class="required" style="color:red">*</span>
                                                    </label>
                                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                                        <input type="text" name="outside_credit" value="<?php echo $outside_tax_edit[0]['outside_credit'] ?>"  class="form-control col-md-7 col-xs-12">
                                                        </div>
                                                </div>


                                                <hr>

                                                <div class="form-group">
                                                    <div class="text-center">
                                                        <button type="submit" value="Submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก
                                                        </button>
                                                        
                                                        <button onclick="window.location.replace('<?php echo site_url('receive/outside'); ?>');" type="button" class="btn btn-warning"><i class="fa fa-close"></i> ยกเลิก
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


