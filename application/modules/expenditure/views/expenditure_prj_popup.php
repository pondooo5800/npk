<div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="addmodal">บันทึกโครงการ</h4>
      </div>
      
      
      <div class="modal-body">
        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
          <div class="form-group">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="id_tax">ปีงบประมาณ
                </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control" type="text" id="type_tax">
                    <option>2561</option>
                    <option>2560</option>
                    <option>2559</option>
                    <option>2558</option>
                    <option>2557</option>
                    <option>2556</option>
                  </select>
              </div>
          </div>

          <div class="form-group">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="id_tax">แผนงาน
                </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control" type="text" id="type_tax">
                    <option></option>
                    <option></option>
                    <option></option>
                    <option></option>
                    <option></option>
                    <option></option>
                  </select>
              </div>
          </div>

          <div class="form-group">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="id_tax">ชื่อโครงการ
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="id_tax" class="form-control col-md-7 col-xs-12">
                </div>
          </div>

            <div class="form-group">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="id_tax">งบประมาณ
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="id_tax" class="form-control col-md-7 col-xs-12">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="id_tax">ผู้ที่รับผิดชอบ
                </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control" type="text" id="type_tax">
                    <option>เจ้าหน้าที่</option>
                    <option></option>
                    <option></option>
                  </select>
              </div>
          </div>

          <div class="form-group">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="id_tax">ประเภทโครงการ
                </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control" type="text" id="type_tax">
                        <option>ใหม่</option>
                        <option>ต่อเนื่อง</option>
                  </select>
              </div>
          </div>

          <div class="form-group">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="id_tax">สถานะโครงการ
                </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control" type="text" id="type_tax">
                    <option>ยังไม่ได้ดำเนินการ</option>
                    <option>อยู่ระหว่างดำเนินการ</option>
                    <option>ดำเนินการเสร็จสิ้น</option>
                    <option>ยกเลิก</option>
                  </select>
              </div>
          </div>



          
        </form>
      </div>

      <div class="modal-footer">
          <button onclick="window.location.replace('<?php echo site_url('receive/receive_main'); ?>');" type="button" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก
          </button>

          <button type="button" class="btn btn-warning" data-dismiss="modal"> ยกเลิก
          </button>
    </div>
</div>
