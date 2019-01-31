
<div class="right_col" role="main">
            <section class="row">
                  <div class="col-md-8 col-sm-4 col-xs-4">
                      <h3>ข้อมูลรายรับภาษีบำรุงท้องที่</h3>
                  </div>
                  <div class="col-md-4 col-sm-8 col-xs-8 text-right" style="margin-top: 7px;">
                      <div class="btn-group">
                        <button style="width: 130px;" onclick="window.location.replace('receive/search_tax_local');" type="button" class="btn btn-success" title="ชำระภาษี"><i class="fa fa-paypal"></i> ชำระภาษี
                        </button>
                      </div>
                  </div>
            </section>

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel" style="top: 10px;">     

                        <div class="x_content">
                            <table id="tax_table" class="table table-striped" style="width:100%">
                                <thead>
                                  <tr>
                                    <th style="width:5%">ลำดับ</th>
                                    <th style="width:10%">วันที่ชำระ</th>
                                    <th style="width:9%">เลขที่/เล่มที่ใบเสร็จ</th>
                                    <th style="width:18%">ชื่อผู้เสียภาษี</th>
                                    <th style="width:10%">จำนวนเงินภาษี (บาท)</th>
                                    <th style="width:10%">เงินเพิ่ม (บาท)</th>
                                    <th style="width:10%">จำนวนเงินที่ชำระ (บาท)</th>
                                    <th style="width:15%">เครื่องมือ</th>
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
                              <h5 align="center">ต้องการลบข้อมูลรายการนี้ใช่หรือไม่</h5>
                      </div>

                      <div class="modal-footer">
                          <button type="button" id="btn-del"  class="btn btn-danger"><i class="fa fa-trash"></i> ลบ
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
.dataTables_filter, .dataTables_info { display: none; }
</style>
