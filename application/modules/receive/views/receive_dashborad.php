
<div class="right_col" role="main">
            <section class="row">
                  <div class="col-md-6 col-sm-4 col-xs-4">
                      <h3>การชำระภาษี</h3>
                  </div>
                  <div class="col-md-6 col-sm-8 col-xs-8 text-right" style="margin-top: 7px;">
                      <div class="btn-group">
                            <button style="width: 115px;" type="button" class="btn btn-success"  data-toggle="collapse" data-target="#search" title="ค้นหา"><i class="fa fa-search"> </i> ค้นหา
                            </button>
                            <button style="width: 115px;" onclick="window.open('<?php echo base_url('export_report/usereEsimate') . '?type=pdf'; ?>')"  type="button" class="btn btn-success" title="ส่งออก PDF"> <i class="fa fa-file-pdf-o"> </i> ส่งออก pdf
                            </button>
                            <button style="width: 115px;"  onclick="window.open('<?php echo base_url('export_report/usereEsimate'); ?>')"  type="button" class="btn btn-success" title="ส่งออก Excel"> <i class="fa fa-file-excel-o" aria-hidden="true"></i> ส่งออก excel
                            </button>
                      </div>
                  </div>
            </section>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="top: 10px;">
                  <div class="collapse" id="search" class="x_content">
                    <br />
                    <form id="form_reset" data-parsley-validate class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="type_tax">ประเภทผู้เสียภาษี
                        </label>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <select class="type_tax selectpicker form-control" type="text" id="type_tax">
                            <option value="0">ทั้งหมด</option>
                            <option value="1">บุคคลธรรมดา</option>
                            <option value="2">นิติบุคคล</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="id_tax">เลขประจำตัวผู้เสียภาษี
                        </label>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <input type="text" name="number_tax" id="number_tax" placeholder="เลขประจำตัว 10 หรือ 13 หลัก" class="form-control col-md-4 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-4 col-sm-3 col-xs-12" for="name_tax">ชื่อผู้เสียภาษี</label>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <input type="text" id="name_tax" placeholder="ระบุชื่อผู้เสียภาษี" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                              <label class="control-label col-md-4 col-sm-3 col-xs-12" for="tax_type_id">หมวดรายได้
                              </label>
                              <div class="col-md-4 col-sm-6 col-xs-12">
                                <select class="tax_type_id selectpicker form-control" type="text" id="tax_type_id">
                                        <option value="0">ทั้งหมด</option>
                                        <option value="ภาษีโรงเรือนและที่ดิน">ภาษีโรงเรือนและที่ดิน</option>
                                        <option value="ภาษีบำรุงท้องที่">ภาษีบำรุงท้องที่</option>
                                        <option value="ภาษีป้าย">ภาษีป้าย</option>
                                </select>
                              </div>
                        </div>
                        <div class="form-group">
                              <label class="control-label col-md-4 col-sm-3 col-xs-12">รายการ
                              </label>
                              <div class="col-md-4 col-sm-6 col-xs-12">
                                <select class="tax_del selectpicker form-control" type="text" id="tax_del">
                                        <option value="All">ทั้งหมด</option>
                                        <option selected value="Active">รายการที่ประเมิน</option>
                                        <option value="Inactive">รายการที่ถูกลบ</option>
                                </select>
                              </div>
                        </div>


                      <div class="ln_solid"></div>
                    </form>
                    <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 text-center">
                            <button type="submit" id="search_receive" class="btn btn-primary"><i class="fa fa-search"></i>&nbsp;ค้นหา</button>
                            <button type="reset"  id="resetForm" onclick="reset()" class="btn btn-warning" ><i class="fa fa-refresh"></i>&nbsp;คืนค่า</button>
                          </div>
                    </div>
                </div>
                 <div class="x_content">
                 <br>
                    <table id="tax_table" class="table table-striped" style="width:100%">
                        <thead>
                          <tr>
                            <th style="width:5%">ลำดับ</th>
                            <th style="width:9%">เลขที่รับ/ปี</th>
                            <th style="width:10%">เลขประจำตัวผู้เสียภาษี</th>
                            <th style="width:16%">ชื่อผู้เสียภาษี</th>
                            <th style="width:10%">หมวดรายได้</th>
                            <th style="width:8%">จำนวนเงินภาษี (บาท)</th>
                            <th style="width:8%">เงินเพิ่ม (บาท)</th>
                            <th style="width:8%">คงเหลือ (บาท)</th>
                            <th >เครื่องมือ</th>
                          </tr>
                        </thead>
                        <tbody>

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
<div class="modal fade" id="delmodal" tabindex="-1" role="dialog" aria-labelledby="delmodal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="delmodal">การแจ้งเตือน!</h4>
            </div>


            <div class="modal-body">
                    <h5>ต้องการลบข้อมูลรายการนี้ใช่หรือไม่</h5>
                    <hr>
                    <label >หมายเหตุ<span class="required" style="color:red"> *</span></label>
                    <br>
                    <textarea name="status_note_del" id="status_note_del" cols="30" rows="3" class="form-contorl" style="width:265px"></textarea>
                    <input type="hidden" name="status" value="Inactive">
            </div>

            <div class="modal-footer">
                <button type="submit"  id="btn-del" class="btn btn-danger"><i class="fa fa-trash"></i> ลบ
                </button>

                <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก
                </button>
            </div>
        </div>
    </div>
  </div>
</div>

<!-- tax aleart -->
<div class="modal fade bs-example-modal-lg" id="alertmodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">พิมพ์ใบแจ้งเตือน</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-right" for="first-name">วันที่แจ้งเตือน<span style="color:red"> *</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="hidden" id="alert_notice" name="alert_notice" value="" >
                <input type="text" name="alert_date" value="<?php echo date('d/m/') . (date('Y') + 543); ?>" data-provide="datepicker" data-date-language="th-th" class="form-control datepicker">
            </div>
             <button type="button" class="btn btn-primary btn-sm" id="alert-btn">บันทึก</button>
          </div>
        </div>
        <hr>
        <div class="row" id="list_alert">
        </div>


      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-primary">บันทึก</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button> -->

      </div>

    </div>
  </div>
</div>



<style>
th{
text-align: center;
}
.dataTables_filter, .dataTables_info { display: none; }
</style>

