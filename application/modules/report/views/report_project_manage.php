<div class="right_col" role="main">
          <section class="row">
                  <div class="col-md-6 col-sm-4 col-xs-4">
                      <h3>รายงานบัญชีรายจ่าย</h3>
                  </div>
                  <?php 
                    $str_export = '';
                    if (!empty($filter_date1)) {  $str_export .= '&filter_date1='.$this->mydate->date_db2str($filter_date1, 543); }
                    if (!empty($filter_date2)) {  $str_export .= '&filter_date2='.$this->mydate->date_db2str($filter_date2, 543); }
                    
                  ?>
                  <div class="col-md-6 col-sm-8 col-xs-8 text-right" style="margin-top: 7px;">
                      <div class="btn-group">
                          <button type="button" class="btn btn-success" title="กรองข้อมูล" data-toggle="modal" data-target="#modal_filter"><i class="glyphicon glyphicon-filter"> </i> ตัวกรอง
                          </button>
                          <button onclick="window.open('<?php echo base_url('export_report/report_projectManage?type=pdf'.$str_export);?>');" type="button" class="btn btn-success" title="ส่งออก pdf"> <i class="fa fa-file-pdf-o"> </i> ส่งออก pdf
                          </button>
                          <button onclick="window.open('<?php echo base_url('export_report/report_projectManage?type=excel'.$str_export);?>');" type="button" class="btn btn-success" title="ส่งออก excel"> <i class="fa fa-file-excel-o"> </i> ส่งออก excel
                          </button>
                      </div>
                  </div>
          </section>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel" style="top: 10px;">
                  

               <div class="x_content">
                 <div style="text-align: center;">
                   <h2>สรุปการใช้จ่ายเงินงบประมาณปี <?php echo $this->session->userdata('year') + 543 ?></h2>
                   <?php if (empty($filter_date1)) { ?>
                   <h5>ข้อมูล ณ วันที่ <?php echo $this->mydate->date_eng2thai(date('Y-m-d'), 543, 'S') ?></h5> 
                   <?php 
                } else { ?>
                   <h5>ข้อมูล ณ วันที่ <?php echo $this->mydate->date_eng2thai($filter_date1, 543, 'S') . ' ถึง ' . $this->mydate->date_eng2thai($filter_date2, 543, 'S') ?></h5> 

                   <?php 
                } ?>
                 </div>
                 <div class="col-xs-12" style="text-align: right;">
                    <a id="chart_download" download="ChartJpg.jpg" type="button" class="btn btn-success" title="ดาวน์โหลด "> <i class="fa fa-file-image-o"> </i> ดาวน์โหลด</a>
                 </div >
                 <canvas id="report_chart" ></canvas>
                 <br>
                 <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>แผนงาน</th>
                          <!-- <th>ประมาณการรายรับ</th> -->
                          <th width="8%">ตั้งไว้</th>
                          <th width="8%">โอนลด</th>
                          <th width="8%">โอนเพิ่ม</th>
                          <th width="8%">รวมถือจ่าย</th>
                          <th width="8%">ใช้ไป</th>
                          <!-- <th width="8%">คาดว่าจะใช้</th> -->
                          <th width="8%">คงเหลือ</th>
                        </tr>
                      </thead>
                      <?= $project; ?>
                  </table>
                </div>
                    
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
</div>

<style>
.table th{
  text-align: center;
background-color:#2A3F54;
color: #FFF;
}


</style>



<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal_filter">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <form method="post" action="<?php echo base_url('report/report_projectManage'); ?>">
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
        <button type="submit" id="btn-submit-plans" class="btn btn-primary">ค้นหา</button>
      </div>
      </form>
    </div>
  </div>
</div>
