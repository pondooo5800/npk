<div class="right_col" role="main">
  <section class="row">
      <div class="col-md-12">
          <h3>บันทึกรายรับนอกงบประมาณ: <?php echo @$out[0]->out_name ?></h3>
      </div>
  </section>
  <div class="row">
   <div class="x_content">
     <form method="post" action="<?php echo base_url('receive_outside/saveOutSideIn') ?>" class="form-horizontal form-label-left" >
        <!-- <input type="hidden" name="outside_pay_id" value="<?php echo @$out_pay[0]->outside_pay_id; ?>"> -->
        <input type="hidden" name="outside_id" value="<?php echo (!empty($out[0]->out_id)) ? $out[0]->out_id : ''; ?>">
        <div id="form_tab" class="x_panel">
          <div class="" role="tabpanel" data-example-id="togglable-tabs">
              <!-- <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">บันทึกรายจ่าย</a>
                  </li>
              </ul> -->

              <div id="myTabContent" class="tab-content">
                  <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                      <!-- //data prj  -->
                      <div class="col-md-6 col-xs-12  " style="float:right">

                        <!-- <table class="table table-bordered">
                          <tbody>
                            <tr>
                              <td>งบประมาณที่ได้รับ</td>
                              <td class="text-right"><?php echo number_format(@$out[0]->out_budget_sum, 2) ?> บาท</td>

                            </tr>
                            <tr>
                              <td>งบประมาณรายรับทั้งหมด</td>
                              <td class="text-right"><?php echo number_format(@$out_pay[0]->sum_pay_budget, 2) ?> บาท</td>
                            </tr>
                            <tr>
                              <td>รวม</td>
                              <td class="text-right"><?php echo number_format(@$out[0]->out_budget_sum+@$out[0]->out_budget_sum, 2); ?> บาท</td>
                            </tr>
                          </tbody>
                        </table> -->
                      </div>
                      <div id="step-1">
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">วันที่จัดทำ <span style="color:red">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="outside_pay_create" value="<?php echo (!empty($out_pay[0]->outside_pay_create)) ? $this->mydate->date_db2str($out_pay[0]->outside_pay_create) : date('d/m/') . (date('Y') + 543); ?>" data-provide="datepicker" data-date-language="th-th" class="form-control  datepicker">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">จำนวนเงิน (บาท) <span style="color:red">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="outside_pay_budget" value="<?php echo (!empty($out_pay[0]->outside_pay_budget)) ? $out_pay[0]->outside_pay_budget : ''; ?>" placeholder="" id="outside_pay_budget" class="form-control col-md-7 col-xs-12 numeric text-right">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">รายละเอียด</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea  class="form-control" name="outside_detail"><?php echo (!empty($out_pay[0]->outside_detail)) ? $out_pay[0]->outside_detail : ''; ?></textarea>
                            </div>
                          </div>

                          <br>
                      </div>
                  </div>
              </div>
          </div>
           <div style="text-align: center;">
           <button type="submit" id="btn-submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>
            <button onclick="window.location.replace('<?php echo @$_SERVER['HTTP_REFERER']; ?>');" type="button" class="btn btn-warning"><i class="fa fa-close"></i> ยกเลิก
            </button>
          </div>
      </div>
      </form>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div id="div_table">
        <table class="table table-bordered jambo_table">
          <thead>
            <tr>
              <th class="text-center">วันที่</th>
              <th class="text-center">ผู้บันทึก</th>
              <th class="text-center">รายละเอียด</th>
              <th class="text-right">จำนวนเงิน (บาท)</th>
              <!-- <th>จัดการ</th> -->
            </tr>
          </thead>
          <tbody>
          <?php foreach ($out_rec_all as $key => $value) {?>
            <tr>
              <td><?php echo $this->mydate->date_eng2thai($value->outside_pay_create, '', 'S'); ?></td>
              <td><?php echo $value->user_firstname . ' ' . $value->user_lastname ?></td>
              <td><?php echo $value->outside_detail ?></td>
              <td class="text-right"><?php echo number_format($value->outside_pay_budget, 2); ?></td>

            </tr>
          <?php }?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>



