
<div class="right_col" role="main">
  <section class="row">
      <div class="col-md-12">
          <h3>บันทึกรายจ่ายนอกงบประมาณ: <?php echo @$out[0]->out_name ?></h3>
      </div>
  </section>
  <div class="row">
   <div class="x_content">
     <form method="post" action="<?php echo base_url('receive_outside/saveOutSidePay') ?>" >
        <input type="hidden" name="outside_pay_id" value="<?php echo @$out_pay[0]->outside_pay_id; ?>">
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

                        <table class="table table-bordered">
                          <tbody>
                            <tr>
                              <td>งบประมาณที่ได้รับ</td>
                              <td class="text-right"><?php echo number_format(@$out[0]->out_budget_sum, 2) ?> บาท</td>

                            </tr>
                            <tr>
                              <td>งบเบิกจ่ายทั้งหมด</td>
                              <td class="text-right"><?php echo number_format(@$out[0]->budget, 2) ?> บาท</td>
                            </tr>
                            <tr>
                              <td>รวมเหลือจ่าย</td>
                              <td class="text-right"><?php echo number_format(@$out[0]->out_budget_sum-@$out[0]->budget, 2); ?> บาท</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div id="step-1">
                              <div class="form-group" >
                                  <div class="row">
                                      <div class="col-md-4 col-sm-6 col-xs-12">
                                          <div class="form-group" >
                                              <label>วันที่จัดทำ</label>
                                              <span  style="color:red">*</span>

                                              <input type="text" name="outside_pay_create" value="<?php echo (!empty($out_pay[0]->outside_pay_create)) ? $this->mydate->date_db2str($out_pay[0]->outside_pay_create, 543) : date('d/m/') . (date('Y') + 543); ?>" data-provide="datepicker" data-date-language="th-th" class="form-control datepicker">
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-2">
                                          <div class="form-group" style="margin-bottom: 0px;">
                                            <table class="table table-bordered jambo_table">
                                              <tr>
                                                <th width="70%" >รายการ  <span  style="color:red">*</span></th>
                                                <th width="30%" class="text-right">จำนวนเงิน (บาท)</th>
                                              </tr>
                                              <tbody>
                                                <tr>
                                                  <td>ระบุจำนวน</td>
                                                  <td ><input type="text" name="outside_pay_budget" value="<?php echo (!empty($out_pay[0]->outside_pay_budget)) ? $out_pay[0]->outside_pay_budget : ''; ?>" placeholder="" id="outside_pay_budget" class="form-control col-md-7 col-xs-12 numeric text-right"></td>
                                                </tr>

                                                <tr>
                                                  <td><span style="text-decoration: underline;">บวก</span> ภาษีมูลค่าเพิ่ม &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <span class="text-right" style="">

                                                        <label>
                                                          <input  id="amount_vat" type="checkbox" <?php echo (!empty($out_pay[0]->outside_pay_vat)) ? 'checked' : ''; ?> class="flat" >
                                                        </label>
                                                        <input id="outside_pay_vat_val" style="width:40px;text-align: center;" type="text" value="7"> %
                                                    </span>
                                                  </td>
                                                  <td><input type="text" name="outside_pay_vat" value="<?php echo (!empty($out_pay[0]->outside_pay_vat)) ? $out_pay[0]->outside_pay_vat : ''; ?>" placeholder="" id="outside_pay_vat" class="form-control col-md-7 col-xs-12 numeric text-right"></td>
                                                </tr>

                                                <tr>
                                                    <td> <span>จำนวนเงินที่ขอเบิกทั้งสิ้น</span></td>
                                                    <td><input type="text" name="outside_pay_amount_disburse" value="<?php echo (!empty($out_pay[0]->outside_pay_amount_disburse)) ? $out_pay[0]->outside_pay_amount_disburse : ''; ?>" placeholder="" id="outside_pay_amount_disburse" class="form-control col-md-7 col-xs-12 numeric text-right"></td>
                                                </tr>

                                                <tr>
                                                  <td><span style="text-decoration: underline;">หัก</span> ภาษีหัก ณ ที่จ่าย &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <span class="text-right" style="">

                                                      <label>
                                                        <input type="checkbox" id="amount_tax" <?php echo (!empty($out_pay[0]->outside_pay_tax)) ? 'checked' : ''; ?>  class="flat" >
                                                      </label>
                                                      <input id="outside_pay_tax_val" style="width:40px;text-align: center;" type="text" value="1"> %
                                                    </span>
                                                  </td>
                                                  <td><input type="text" name="outside_pay_tax" value="<?php echo (!empty($out_pay[0]->outside_pay_tax)) ? $out_pay[0]->outside_pay_tax : ''; ?>" placeholder="" id="outside_pay_tax" class="form-control col-md-7 col-xs-12 numeric text-right"></td>
                                                </tr>
                                                <tr>
                                                    <td><span>ค่าปรับ</span></td>
                                                    <td><input type="text" name="outside_pay_amount_fine" value="<?php echo (!empty($out_pay[0]->outside_pay_amount_fine)) ? $out_pay[0]->outside_pay_amount_fine : ''; ?>" placeholder="" id="outside_pay_amount_fine" class="form-control col-md-7 col-xs-12 numeric text-right"></td>
                                                  </tr>
                                                <tr >
                                                  <td>จำนวนเงินที่จ่ายสุทธิ</td>
                                                  <td><input type="text" name="outside_pay_budget_sum" value="<?php echo (!empty($out_pay[0]->outside_pay_budget_sum)) ? $out_pay[0]->outside_pay_budget_sum : ''; ?>" placeholder="" id="outside_pay_budget_sum" class="form-control col-md-7 col-xs-12 numeric text-right"></td>
                                                </tr>

                                              </tbody>
                                            </table>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-2">
                                          <div class="form-group" style="margin-bottom: 0px;">

                                              <label for="middle-name"> รายละเอียด
                                              </label>
                                              <div>
                                                 <textarea  class="form-control" name="outside_detail"><?php echo (!empty($out_pay[0]->outside_detail)) ? $out_pay[0]->outside_detail : ''; ?></textarea>

                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          <br>
                      </div>
                  </div>
              </div>
          </div>
           <div style="text-align: center;">
            <button type="submit" id="btn-submit_pay" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>
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
              <th class="text-center">ผู้เบิกจ่าย</th>
              <th class="text-center">รายละเอียด</th>
              <th class="text-right">จำนวนเงิน (บาท)</th>
              <!-- <th>จัดการ</th> -->
            </tr>
          </thead>
          <tbody>
          <?php foreach ($out_pay_all as $key => $value) {?>
            <tr>
              <td><?php echo $this->mydate->date_eng2thai($value->outside_pay_create, 543, 'S'); ?></td>
              <td><?php echo $value->user_firstname . ' ' . $value->user_lastname ?></td>
              <td><?php echo $value->outside_detail ?></td>
              <td class="text-right"><?php echo number_format($value->outside_pay_budget_sum, 2); ?></td>

            </tr>
          <?php
}?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>



