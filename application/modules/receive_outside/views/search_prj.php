
<div class="right_col" role="main">
  <section class="row">
      <div class="col-md-6 col-sm-4 col-xs-4">
          <h3>ค้นหารายการ</h3>
      </div>
  </section>
  <div class="row">
   <div class="x_content">
     <br>
     <div class="col-md-4"></div>
     <div class="col-md-4">
       <div class="input-group">
          <input type="text" id="search" name="search" class="form-control col-md-4 col-xs-12" value="">
          <span class="input-group-btn">
          <button class="btn btn-success" type="button" id="search-btn" style="margin-right: 0px;">
                  <i class="fa fa-search"></i>
              </button>
          </span>
        </div>  
     </div>
     <div class="col-md-4"></div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div id="div_table"></div>
    </div>
  </div>
</div>



<div class="modal fade pay_out" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">โครงการ</h4>
      </div>
      <div class="modal-body clearfix">
        <form class="form-horizontal form-label-left" id="form_plan">
          <!-- hidden value -->
        <input  id="out_id"  name="out_id"  type="hidden">
          <div class="form-group">
            <label>จำนวนเงิน</label>
            <input class="form-control" id="project_title"  name="project_title" placeholder="จำนวนเงิน" type="text">
          </div>
            <div class="form-group" >
                <label>วันที่บันทึก</label>
                <span class="required" style="color:red">*</span>

                <input type="text" name="expenses_date" value="<?php echo date('Y-m-d'); ?>" class="form-control datepicker">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
        <button type="button" id="btn-submit-plans" class="btn btn-primary">บันทึก</button>
      </div>

    </div>
  </div>
</div>


