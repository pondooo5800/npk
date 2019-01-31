<div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="addmodal">จ่าย</h4>
      </div>
      
      
      <div class="modal-body">
        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
            <br>
            <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12 center" for="id_tax">เลขที่ใบเสร็จ
                    </label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <input type="text" placeholder="" id="id_tax" class="form-control col-md-7 col-xs-12">
                        </div>
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="id_tax">เล่มที่ใบเสร็จ
                    </label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <input type="text" placeholder="" id="id_tax" class="form-control col-md-7 col-xs-12">
                        </div>
            </div>
            <div class="form-group" style="margin-bottom: 0px;">
                <label for="second" class="control-label col-md-3 col-sm-3 col-xs-12" for="id_tax">วันที่ชำระ
                </label>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class='input-group date col-md-12 col-xs-12' id='inputdatepicker'>
                            <input type='text' class="form-control datepicker" />
                        </div>                        
                    </div>
                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="id_tax">จำนวนเงินที่ต้องการชำระ
                </label>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <input type="text" placeholder="0.00" id="id_tax" class="form-control col-md-7 col-xs-12">
                    </div>

            </div>

        
            <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_tax">เงินเพิ่ม
                    </label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <input type="text" id="id_tax" value="0.00" class="form-control col-md-7 col-xs-12">
                        </div>
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="id_tax">รวม
                    </label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <input type="text" id="id_tax" value="0.00" class="form-control col-md-7 col-xs-12">
                        </div>

            </div>


            <br>
            <div class="x_content">
                <table class="table table-striped" style="margin-bottom: 0px;">
                    <thead>
                        <tr>
                            <th>ครั้งที่</th>
                            <th>วันที่ชำระ</th>
                            <th>เลขที่</th>
                            <th>เล่มที่</th>
                            <th>หมวดรายได้</th>
                            <th>ชำระแล้ว</th>
                            <th>เงินเพิ่ม</th>
                            <th>รวม</th>
                        </tr>
                    </thead>
                        <tbody>
                            <tr>
                            </tr>
                            <th>ยอดรวม</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tbody>
                </table>
            </div>
        </form>
      </div>

            <div class="modal-footer">
                <button onclick="window.location.replace('<?php echo site_url('receive/receive_tax_pay'); ?>');" type="button" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก
                </button>
                <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก
                </button>
            </div>
</div>
