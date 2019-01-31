<div class="right_col" role="main">
          <section class="row">
                  <div class="col-md-6 col-sm-4 col-xs-4">
                      <h3>รายงานค่าใช้จ่ายจำแนกรายเดือน</h3>
                  </div>
                  <div class="col-md-6 col-sm-8 col-xs-8 text-right" style="margin-top: 7px;">
                      <div class="btn-group">
                          <button onclick="window.open('<?php echo base_url('export_report/report_month?type=pdf');?>');" type="button" class="btn btn-success" title="ส่งออก pdf"> <i class="fa fa-file-pdf-o"> </i> ส่งออก pdf
                          </button>
                          <button onclick="window.open('<?php echo base_url('export_report/report_month');?>');" type="button" class="btn btn-success" title="ส่งออก excel"> <i class="fa fa-file-excel-o"> </i> ส่งออก excel
                          </button>
                      </div>
                  </div>
          </section>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel" style="top: 10px;">
                  
               <?php $monthname = array( 10=>"ตุลาคม",11=>"พฤศจิกายน",12=>"ธันวาคม",1=>"มกราคม",2=>"กุมภาพันธ์",3=>"มีนาคม",4=>"เมษายน",5=>"พฤษภาคม",6=>"มิถุนายน", 7=>"กรกฎาคม",8=>"สิงหาคม",9=>"กันยายน");?>
               <div class="x_content">
                 <div style="text-align: center;">
                   <h2>รายงานค่าใช้จ่ายจำแนกรายเดือน ปีงบประมาณ <?php echo $this->session->userdata('year') + 543 ?></h2>
                   <h5>ข้อมูล ณ วันที่ <?php echo $this->mydate->date_eng2thai(date('Y-m-d'), 543, 'S') ?></h5> 
                 </div>
                 <div class="col-xs-12" style="text-align: right;">
                    <a id="chart_download" download="ChartJpg.jpg" type="button" class="btn btn-success" title="ดาวน์โหลด "> <i class="fa fa-file-image-o"> </i> ดาวน์โหลด</a>
                 </div >
                 <canvas id="report_chart" ></canvas>
                 <br>
                 <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>เดือน</th>
                        <th width="30%">ค่าใช้จ่าย</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $labels_chart = $datasets1 = '';
                        $sum =0;
                        foreach ($monthname as $key => $value) { 
                        $labels_chart .= $value.'||';
                        $datasets1 .= @$data[$key].'||';
                        $sum += @$data[$key];
                      ?>
                      <tr>
                        <td><?php echo $value?></td>
                        <td align="right"><?php echo number_format(@$data[$key],2)?></td>
                      </tr>
                    <?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td align="center">รวม</td>
                        <td align="right"><?php echo number_format($sum,2)?></td>
                      </tr>
                    </tfoot>
                  </table>
                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
</div>

<input type="hidden" id="labels_chart" value="<?php echo $labels_chart?>">
<input type="hidden" id="datasets1" value="<?php echo $datasets1?>">

<style>
.table th{
  text-align: center;
background-color:#2A3F54;
color: #FFF;
}


</style>

