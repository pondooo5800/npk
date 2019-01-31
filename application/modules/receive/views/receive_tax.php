<div class="right_col" role="main">
          
          <section class="row">
                  <div class="col-md-8 col-sm-4 col-xs-4">
                      <h3>ข้อมูลผู้เสียภาษี</h3>
                  </div>
                  <div class="col-md-4 col-sm-8 col-xs-8 text-right" style="margin-top: 7px;">
                      <div class="btn-group">
                        <button style="width: 115px;" type="button" class="btn btn-success"  data-toggle="collapse" data-target="#search" title="ค้นหา"><i class="fa fa-search"></i> ค้นหา
                          </button>
                          <button style="width: 115px;" onclick="window.location.replace('receive_taxadd_popup');" type="button" class="btn btn-success" title="เพิ่มข้อมูล"> <i class="fa fa-plus-square" ></i> เพิ่มข้อมูล
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
  
                    <div class="ln_solid"></div>
                  </form>
                  
                  <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 text-center">
                          <button type="submit" id="search_receive" class="btn btn-primary"><i class="fa fa-search"></i>&nbsp;ค้นหา</button>
                          <button type="reset"  onclick="reset()" class="btn btn-warning" ><i class="fa fa-refresh"></i>&nbsp;คืนค่า</button>

                        </div>
                  </div>
                </div>

               <div class="x_content">
               <br>
                  <table id="tax_table" class="table table-striped" style="width:100%">
                      <thead>
                        <tr>
                          <th  width="5%">ลำดับ</th>
                          <th  width="30%">เลขประจำตัวผู้เสียภาษี</th>
                          <th  width="30%">ชื่อผู้เสียภาษี</th>
                          <th  width="10%">ประเภทผู้เสียภาษี</th>
                          <th  width="25%">เครื่องมือ</th>
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




      

