
<div class="right_col" role="main">
            <section class="row">
                  <div class="col-md-6 col-sm-4 col-xs-4">
                      <h3>รายการข้อมูลบันทึกรายรับภาษีอื่น</h3>
                  </div>
                  <div class="col-md-6 col-sm-8 col-xs-8 text-right" style="margin-top: 7px;">
                      <div class="btn-group">
                            <button style="width: 130px;" type="button" onclick="window.location.href='<?php echo base_url('receive/other_tax_add/') ?>'" id="" class="btn btn-success " title="บันทึกรายรับภาษีอื่น">
                                <i class="fa fa-plus-square"></i> บันทึกรายรับ
                            </button>
                      </div>
                  </div>
            </section>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="top: 10px;">
                  <div class="collapse" id="search" class="x_content">
                      <br />
                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                            <div class="form-group">
                              <label class="control-label col-md-4 col-sm-3 col-xs-12" for="type_tax">ประเภทผู้เสียภาษี
                              </label>
                              <div class="col-md-4 col-sm-6 col-xs-12">
                                <select class="form-control" type="text" id="type_tax">
                                  <option>บุคคลธรรมดา</option>
                                  <option>นิติบุคคล</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-4 col-sm-3 col-xs-12" for="id_tax">เลขประจำตัวผู้เสียภาษี
                              </label>
                              <div class="col-md-4 col-sm-6 col-xs-12">
                                <input type="text" id="id_tax" placeholder="1048174650120" class="form-control col-md-7 col-xs-12" data-inputmask="'mask': '9999999999999'" >
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="middle-name" class="control-label col-md-4 col-sm-3 col-xs-12" for="name_tax">ชื่อผู้เสียภาษี</label>
                              <div class="col-md-4 col-sm-6 col-xs-12">
                                <input type="text" id="name_tax" placeholder="สมชาย ใจดี" class="form-control col-md-7 col-xs-12">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-4 col-sm-3 col-xs-12" for="income_tax">หมวดรายได้
                              </label>
                              <div class="col-md-4 col-sm-6 col-xs-12">
                                <select id="first-disabled" class="form-control">
                                <optgroup label = "หมวดภาษีอากร">
                                    <option>ภาษีโรงเรือนและที่ดิน</option>
                                    <option>ภาษีบำรุงท้องที่</option>
                                    <option>ภาษีป้าย</option>
                                </optgroup>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">

                              <div class="col-md-5 col-sm-6 col-xs-12">

                            </div>

                            <div class="form-group">
                              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 text-center">
                                <br>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>&nbsp;ค้นหา</button>
                                <button type="reset"  class="btn btn-warning" ><i class="fa fa-refresh"></i>&nbsp;คืนค่า</button>
                              </div>
                            </div>
                          <div class="ln_solid"></div>
                      </form>
                  </div>

                </div>

                      <div class="x_content">
                        <table id="tax_table" class="table table-striped" style="width:100%">
                            <thead>
                              <tr>
                                      <th style="width: 30px;">ลำดับ</th>
                                      <th>วันที่รับ</th>
                                      <th>หมวดรายได้</th>
                                      <th>จำนวนเงินที่รับ (บาท)</th>
                                      <th style="width: 130px;">เครื่องมือ</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($other_tax as $key => $value) { ?>
                                    <tr>
                                      <td align="center"><?php echo $key + 1; ?></td>
                                      <td align="center"><?php echo $this->mydate->date_eng2thai($value->receive_date, 543, 'S'); ?></td>
                                      <td ><?php echo $value->tax_name; ?></td>
                                      <td align="right"><?php echo number_format($value->receive_amount, 2); ?></td>
                                      <td>
                                        <center>
                                            <div class="btn-group ">
                                                <button type="button" onclick="window.location = '<?php echo base_url('receive/other_tax_edit/') . '/' . $value->receive_id; ?>'" class="btn btn-warning btn-sm" title="แก้ไข">
                                                  แก้ไข
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" data-id="<?php echo $value->receive_id ?>"  data-toggle="modal" data-target="#delpay_modal" title="ลบ">
                                                    ลบ
                                                </button>

                                            </div>
                                        </center>
                                      </td>
                                    </tr>
                                  <?php

                                } ?>



                            <tbody>
                        </table>
                      </div>
                  </div>
                </div>
              </div>


              </div>
            </div>
</div>


          <div class="modal fade" id="delpay_modal" tabindex="-1" role="dialog" aria-labelledby="delmodal" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                    <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="delmodal">การแจ้งเตือน!</h4>
                      </div>


                      <div class="modal-body">
                              <h5 align="center">ต้องการลบข้อมูลรายการนี้ใช่หรือไม่</h5>
                      </div>

                      <div class="modal-footer">
                          <button type="button" id="btn-delpay"  class="btn btn-danger"><i class="fa fa-trash"></i> ลบ
                          </button>

                          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก
                          </button>
                      </div>
                  </div>
              </div>
            </div>
          </div>


<style>
th{
text-align: center;
}
tr.group-start td{
  background-color: #2A3F54;
  color: #fff;
  cursor:pointer;
}
</style>
