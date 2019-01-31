
<div class="right_col" role="main">
            <section class="row">
                  <div class="col-md-6 col-sm-4 col-xs-4">
                      <h3>ระบบบัญชีรายจ่ายนอกงบประมาณ</h3>
                  </div>
                  <div class="col-md-6 col-sm-8 col-xs-8 text-right" style="margin-top: 7px;">
                      <div class="btn-group">
                        <button style="width: 115px;" type="button" class="btn btn-success"  data-toggle="collapse" data-target="#search" title="ค้นหา"><i class="fa fa-search"></i> ค้นหา
                        </button>
                        <button style="width: 115px;" onclick="window.location.replace('receive_outside/search_outside_prj');" type="button" class="btn btn-success" title="ชำระภาษี"><i class="fa fa-paypal"></i> เบิกจ่าย
                        </button>
                      </div>
                  </div>
            </section>


          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">

                <div class="collapse" id="search" class="x_content">
                  <br />
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                    <div class="form-group">
                      <label class="control-label col-md-4 col-sm-3 col-xs-12" for="id_tax">วันที่ชำระ
                      </label>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                          <input type="text" name="outside_date" id="outside_date" placeholder="" data-provide="datepicker" data-date-language="th-th" class="form-control col-md-4 col-xs-12 datepicker" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="middle-name" class="control-label col-md-4 col-sm-3 col-xs-12" for="name_tax">รายการ</label>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <input type="text" id="outside_name" placeholder="" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="middle-name" class="control-label col-md-4 col-sm-3 col-xs-12" for="name_tax">รายละเอียด</label>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <input type="text" id="outside_detail" placeholder="" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <div class="ln_solid"></div>
                  </form>

                  <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 text-center">
                          <br>
                          <button type="submit" id="search_pay" class="btn btn-primary"><i class="fa fa-search"></i>&nbsp;ค้นหา</button>
                          <button type="reset"  class="btn btn-warning" ><i class="fa fa-refresh"></i>&nbsp;คืนค่า</button>
                        </div>
                  </div>
                </div>
              <!-- <br/><br/> -->
               <div class="x_content">
                  <table  class="table table-striped" id="table_outside_pay" style="width:100%">
                    <thead>
                      <tr>
                        <th width="10%">วันที่ลงเช๊ค</th>
                        <th width="15%">เลขที่เช็ค/ฎีกา</th>
                        <th>วันที่ชำระ</th>
                        <th>รายการ</th>
                        <th>รายละเอียด</th>
                        <th>จำนวนเงินที่เบิกจ่าย (บาท)</th>
                        <th>ผู้ดำเนินการ</th>
                        <th style="width: 20%;">เครื่องมือ</th>
                      </tr>
                    </thead>
                    <tbody>
                    <!-- <?php foreach ($out_pay as $key => $value) {?>
                         <tr>
                          <td align="center"><?php echo $this->mydate->date_eng2thai($value->outside_pay_create, 543, 'S') ?></td>
                          <td align="center"><?php echo $value->out_name; ?></td>

                          <td><?php echo $value->outside_detail; ?></td>
                          <td align="right"><?php echo number_format($value->outside_pay_budget_sum, 2); ?></td>
                          <td align="center"><?php echo $value->user_firstname . ' ' . $value->user_lastname; ?></td>
                          <td>
                            <center>
                                <div class="btn-group ">
                                    <button type="button" onclick="window.location = '<?php echo base_url('receive_outside/outside_form') . '/' . $value->outside_id . '/' . $value->outside_pay_id; ?>'" class="btn btn-warning btn-sm" title="แก้ไข">
                                       แก้ไข
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-id="<?php echo $value->outside_pay_id ?>"  data-toggle="modal" data-target="#delpay_modal" title="ลบ">
                                        ลบ
                                    </button>
                                </div>
                            </center>
                          </td>
                        </tr>
                      <?php
}?> -->
                    <tbody>
                  </table>
                </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>



        <!-- Modal Popup -->
          <div class="modal fade" id="delpay_modal" tabindex="-1" role="dialog" aria-labelledby="delpay_modal" aria-hidden="true">
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


<!-- Modal Popup -->

<div class="modal fade" id="paymodal" tabindex="-1" role="dialog" aria-labelledby="paymodal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-dialog modal-sm">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                  </button>
                  <h4 class="modal-title" id="delmodal">บันทึก เลขที่เช็ค/วันที่เช๊ค</h4>
              </div>

              <div class="modal-body">
              <div class="row">
                <div class="col-sm-12">
                  <label> เลขที่เช๊ค</label><span style="color:red">*</span>
                  <input type="text" name="expenses_number" class="form-control">
                </div>
              </div>
              <br/>
              <div class="row">
                <div class="col-sm-12">
                  <label> วันที่ลงเช๊ค</label><span style="color:red">*</span>
                  <input type="text" name="expenses_date_disburse" value="<?php echo date('d/m/') . (date('Y') + 543); ?>" data-provide="datepicker" data-date-language="th-th" class="form-control datepicker">
                </div>
              </div>


              </div>

              <div class="modal-footer">
                  <button type="button" id="btn-outsidepay"  class="btn btn-primary"></i> บันทึก
                  </button>

                  <button type="button" class="btn btn-default" data-dismiss="modal"></i> ยกเลิก
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

  .dataTables_filter, .dataTables_info { display: none; }
  tr.group-start td{
    background-color: #2A3F54;
    color: #fff;
    cursor:pointer;
  }

</style>

