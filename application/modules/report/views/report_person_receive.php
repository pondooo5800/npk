<div class="right_col" role="main">
        <section class="row">
                  <div class="col-md-6 col-sm-4 col-xs-4">
                      <h3>รายงานรับชำระภาษี</h3>
                  </div>
                  <?php 
                    $str_export = '';
                    if (!empty($filter_date1)) {  $str_export .= '&filter_date1='.$this->mydate->date_db2str($filter_date1, 543); }
                    if (!empty($filter_date2)) {  $str_export .= '&filter_date2='.$this->mydate->date_db2str($filter_date2, 543); }
                    if (!empty($tax_type)) {  $str_export .= '&tax_type='.$tax_type; }
                  ?>
                  <div class="col-md-6 col-sm-8 col-xs-8 text-right" style="margin-top: 7px;">
                      <div class="btn-group">
                          <button type="button" class="btn btn-success" title="กรองข้อมูล" data-toggle="modal" data-target="#modal_filter"><i class="glyphicon glyphicon-filter"> </i> ตัวกรอง
                          </button>
                          <button onclick="window.open('<?php echo base_url('export_report/report_person_receive?type=pdf'.$str_export);?>');" type="button" class="btn btn-success" title="ส่งออก pdf"> <i class="fa fa-file-pdf-o"> </i> ส่งออก pdf
                          </button>
                          <button onclick="window.open('<?php echo base_url('export_report/report_person_receive?type=excel'.$str_export);?>');" type="button" class="btn btn-success" title="ส่งออก excel"> <i class="fa fa-file-excel-o"> </i> ส่งออก excel
                          </button>
                      </div>
                  </div>
        </section>          
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="top: 10px;">
                    <div class="col-xs-12 ">
                          <h5 class="inline text-right">ข้อมูล ณ วันที่ <?php echo $this->mydate->date_eng2thai(date('Y-m-d'), 543, 'S') ?></h5> 
                    </div>

              
              <div class="conteiner-fluid ">
                     
              
               <div class="x_content">
                <div style="text-align: center;">
                   <h2>รายงานรับชำระภาษี <?php if(!empty($tax_type)){ echo @$tax[$tax_type]->tax_name; }?></h2>
                   <?php if (empty($filter_date1)) { ?>
                   <h5>ข้อมูล ณ วันที่ <?php echo $this->mydate->date_eng2thai(date('Y-m-d'), 543, 'S') ?></h5> 
                   <?php 
                } else { ?>
                   <h5>ข้อมูล ณ วันที่ <?php echo $this->mydate->date_eng2thai($filter_date1, 543, 'S') . ' ถึง ' . $this->mydate->date_eng2thai($filter_date2, 543, 'S') ?></h5> 

                   <?php 
                } ?>
                 </div>
                 <br>
                    <table class="table table-bordered table-striped">
                        <thead>
                          <tr>
                              <th >ลำดับ</th>
                              <th >เลขประจำตัวผู้เสียภาษี</th>
                              <th >ชื่อ - สกุล</th>
                              <th >เลขรับ</th>
                              <!-- <th >วันที่</th> -->
                              <th >ภาษี</th>
                              <th>เล่มที่/เลขที่ ใบเสร็จ</th>
                              <th >จำนวนที่จ่าย</th>
                              <th>วันที่ชำระ</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $int =1;
                            foreach ($person as $key => $value) { ?>
                            <tr>
                              <td><?php echo $int++;?></td>
                              <td><?php echo $value->individual_number;?></td>
                              <td><?php echo $value->individual_prename.$value->individual_fullname;?></td>
                              <td><?php echo $value->notice_number;?></td>
                              
                              <!-- <td></td> -->
                              <td><?php echo $value->tax_name;?></td>
                              <td><?php echo $value->receipt_no.'/'.$value->receipt_number;?></td>
                              <td align="right"><?php echo number_format($value->receive_amount,2);?></td>
                              <td><?php echo $this->mydate->date_eng2thai($value->receive_date,543,'S');?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                        <tfoot>
                        </tfoot>
                  </table>
                </div>
                    
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
</div>
<style>
.table-striped th{
    text-align: center;
background-color:#2A3F54;
color: #FFF;
}


</style>


<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal_filter">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <form method="post" action="<?php echo base_url('report/report_person_receive'); ?>">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">กรองข้อมูล</h4>
      </div>
      <div class="modal-body clearfix">
       <div class="row">
         <div class="col-md-12">
           <label>ข้อมูลวันที่</label> 
           <input type="text" name="filter_date1" value="<?php if (!empty($filter_date1)) {
                                                          echo $this->mydate->date_db2str($filter_date1, 543);
                                                        } ?>" data-provide="datepicker" data-date-language="th-th" class="form-control datepicker">
         </div>
       </div>
       <div class="row" style="margin-top: 5px;">
        <div class="col-md-12">
          <label>ถึง วันที่</label>
            <input type="text" name="filter_date2" value="<?php if (!empty($filter_date2)) {
                                                            echo $this->mydate->date_db2str($filter_date2, 543);
                                                          } ?>" data-provide="datepicker" data-date-language="th-th" class="form-control datepicker">
         </div>
       </div>
       <div class="row" style="margin-top: 5px;">
        <div class="col-md-12">
          <label>ประเภทภาษี</label>
            <select class="form-control" name="tax_type">
              <option value="">ทั้งหมด</option>
            <?php foreach ($tax as $key => $value) {
                $sel = '';
                if($value->tax_id == @$tax_type){
                  $sel = 'selected="selected"';
                }
             ?>
              <option <?php echo $sel;?> value="<?php echo $value->tax_id?>"><?php echo $value->tax_name;?></option>
            <?php } ?>
            </select>
         </div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
        <button type="submit" id="btn-submit-plans" class="btn btn-primary">ค้นหา</button>
      </div>
      </form>
    </div>
  </div>
</div>
      


