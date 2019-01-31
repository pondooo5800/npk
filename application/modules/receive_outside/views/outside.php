<div class="right_col" role="main">


    <section class="row">
      <div class="col-md-6 col-sm-4 col-xs-4">
          <h3>ระบบบริหารโครงการ</h3>
      </div>
      <div class="col-md-6 col-sm-8 col-xs-8 text-right" style="margin-top: 7px;">
          <div class="btn-group">
          <button  style="width: 130px;" type="button" class="btn btn-success" onclick="add_out()"><i class="fa fa-plus-square"></i> เพิ่มรายการ</button>

          </div>
      </div>

    </section>



    <div class="clearfix"></div>



    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">

            <div class="nav navbar-left panel_toolbox" style="width: 350px !important;">
              <input type="text" class="form-control" id="search" placeholder="ค้นหา">
            </div>
            <br/>

            <div style="margin:20px 0;"></div>
            <table id="tg" class="easyui-treegrid" title="&emsp;รายรับนอกงบประมาณ" style="width:100%;">
            </table>

            <br>
        </div>
      </div>



    </div>
</div>

<!-- start model form -->



<div class="modal fade creat_out" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">เพิ่มรายรับนอกงบประมาณ <span id="outside_year"></span></h4>
      </div>
      <div class="modal-body clearfix">
        <!-- //check edit form -->
        <input  id="hidden_out_id"  name="hidden_out_id"  type="hidden">
        <input  id="hidden_out_edit"  name="hidden_out_edit"  type="hidden">
        <!-- //check edit form -->
        <form class="form-horizontal form-label-left" id="form_out">
          <!-- hidden value -->
          <input  id="out_parent"  name="out_parent"  type="hidden">
          <input  id="out_year"  name="out_year"  type="hidden">
          <div class="form-group">
            <label>รายการ <span style="color:red;">*</span> </label>
            <input class="form-control" id="out_name"  name="out_name" placeholder="ระบุรายการ" type="text">
          </div>
          <div class="form-group">
            <label>รหัสบัญชี</label>
            <input class="form-control" id="out_code"  name="out_code" placeholder="ระบุรหัสบัญชี" type="text">
          </div>

          <div class="form-group">
            <label>จำนวนเงินที่รับ <span style="color:red;">*</span> </label>  </label>
            <input class="form-control numeric" id="out_budget"  name="out_budget" placeholder="ระบุจำนวนเงินที่รับ" type="text">
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="btn-submit-out" class="btn btn-primary">บันทึก</button>
        <button type="button" class="btn btn-warning" data-dismiss="modal">ยกเลิก</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade del_out" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <h4 class="modal-title" id="delmodal">การแจ้งเตือน!</h4>
          </div>


          <div class="modal-body clearfix">
                <h5 align="center">ต้องการลบข้อมูลรายการนี้ใช่หรือไม่</h5>

                <input  id="del_id"  name="del_id" type="hidden">
                <input  id="del_state"  name="del_state" type="hidden">
          </div>

          <div class="modal-footer">
              <button type="button" id="btn-del" class="btn btn-danger"><i class="fa fa-trash"></i> ลบ
              </button>

              <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก
              </button>
          </div>
      </div>
  </div>
</div>
<!-- end modal -->

<style>
.datagrid-header-row {
    visibility: collapse;
}
</style>
