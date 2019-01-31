<div class="right_col" role="main">
        <section class="row">
                  <div class="col-md-6 col-sm-4 col-xs-4">
                      <h3>รายงานลูกหนี้ค้างชำระ</h3>
                  </div>
                  <div class="col-md-6 col-sm-8 col-xs-8 text-right" style="margin-top: 7px;">
                      <div class="btn-group">
                          <!-- <button type="button" class="btn btn-success" title="กรองข้อมูล"><i class="glyphicon glyphicon-filter"> </i> ตัวกรอง
                          </button> -->
                          <button onclick="window.open('<?php echo base_url('export_report/report_debt?type=pdf');?>');" type="button" class="btn btn-success" title="ส่งออก pdf"> <i class="fa fa-file-pdf-o"> </i> ส่งออก pdf
                          </button>
                          <button onclick="window.open('<?php echo base_url('export_report/report_debt');?>');" type="button" class="btn btn-success" title="ส่งออก excel"> <i class="fa fa-file-excel-o"> </i> ส่งออก excel
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

                
              <div class="col-md-1 col-sm-6 col-xs-12">
              </div>
              <div class="conteiner-fluid ">
                     <div class="row x_content">
                     <div class="col-sm-6">
                    <table class="table table-bordered table-striped">
                        <thead>
                       <tr>
                        <th align="center">หมวดรายได้</th>
                        <th align="center">จำนวนเงิน</th>
                        <th align="center">เงินเพิ่ม</th>
                        <th align="center">รวม</th>
                       </tr>
                      </thead>
                      <tbody>
                      <?php $sum1 = $sum2 = $sum3 = 0;
                      $labels_chart = $datasets = '';
                      foreach ($taxDebt as $key => $value) {
                        // echo("<pre>");
                        // print_r($value);
                        // echo("</pre>");
                        $sum1 += (@$value->notice_estimate - @$value->receive_amount);
                        $sum2 += (@$value->interest);
                        $sum3 += (@$value->notice_estimate - @$value->receive_amount + @$interest);

                        $labels_chart .= $value->tax_name . '||';
                        $datasets .= (@$value->notice_estimate - @$value->receive_amount + @$interest) . '||';
                        ?>
                        <tr>
                          <td><?php echo $value->tax_name ?></td>
                          <td style="text-align: right;"><?php echo number_format(@$value->notice_estimate - @$value->receive_amount, 2) ?></td>
                          <td style="text-align: right;"><?php echo number_format(@$value->interest, 2) ?></td>
                          <td style="text-align: right;"><?php echo number_format(@$value->notice_estimate - @$value->receive_amount + @$value->interest, 2) ?></td>

                        </tr>
                      <?php 
                    }
                    $labels_chart = substr($labels_chart, 0, -2);
                    $datasets = substr($datasets, 0, -2); ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td align="center">รวม</td>
                          <td align="right"><?php echo number_format($sum1, 2); ?></td>
                          <td align="right"><?php echo number_format($sum2, 2); ?></td>
                          <td align="right"><?php echo number_format($sum3, 2); ?></td>
                        </tr>
                      </tfoot>
                    </table>
                    <input type="hidden" id="labels_chart" value="<?php echo $labels_chart; ?>">
                    <input type="hidden" id="datasets" value="<?php echo $datasets; ?>"> 
                </div>  
                    <div class="col-sm-6"></div>
                    <div class="col-md-6 col-sm-12 col-xs-12" style="text-align: right;">
                      <a class="btn btn-success " id="chart_download" download="ChartJpg.jpg" title="ดาวน์โหลด" type="button"><i class="fa fa-file-image-o"></i> ดาวน์โหลด</a>
                    <div >
                    <canvas id="chart_debt"></canvas>
                    </div>
              </div>

                 </div>
                    </div>

              <div class="col-md-1 col-sm-6 col-xs-12">
              </div>
              
               <div class="x_content">
                 <br>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr> 
                            <th colspan="10" >หมวดรายได้ </th>
                                <tr>
                                    <th style="width: 5%; vertical-align: middle;" rowspan="2" data-defaultsign="nospan" >ลำดับ</th>
                                    <th style="width: 15%; vertical-align: middle;" rowspan="2" data-defaultsign="nospan">เลขประจำตัวผู้เสียภาษี</th>
                                    <th style=" width: 20%; vertical-align: middle;" rowspan="2" data-defaultsign="nospan">ชื่อ - สกุล</th>
                                    <th colspan="2" style="text-align: center;">ภาษีโรงเรือนและที่ดิน</th>
                                    <th colspan="2" style="text-align: center;">ภาษีบำรุงท้องที่</th>
                                    <th colspan="2" style="text-align: center;">ภาษีป้าย</th>
                                    <th style="width: 12%; vertical-align: middle;" rowspan="2" data-defaultsign="nospan">รวม</th>
                                </tr>
                       </tr>
                            <tr>
                              <th style="width: 7%;">จำนวนเงิน</th>
                              <th style="width: 7%;">เงินเพิ่ม</th>
                              <th style="width: 7%;">จำนวนเงิน</th>
                              <th style="width: 7%;">เงินเพิ่ม</th>
                              <th style="width: 7%;">จำนวนเงิน</th>
                              <th style="width: 7%;">เงินเพิ่ม</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $int = 1;
                            $sum1 = $sum2 = $sum3 = $sum4 = $sum5 = $sum6 = 0;
                            foreach ($person as $key => $value) {
                              // echo '<pre>';
                              // print_r($value);
                              // echo '</pre>';
                              if ((@$value[8]['notice_estimate'] - @$value[8]['receive_amount']) + (@$value[9]['notice_estimate'] - @$value[9]['receive_amount']) + (@$value[10]['notice_estimate'] - @$value[10]['receive_amount']) + @$value[8]['interest'] + @$value[9]['interest'] + @$value[10]['interest'] > 0) {
                                $sum1 += (@$value[8]['notice_estimate'] - @$value[8]['receive_amount']);
                                $sum2 += (@$value[8]['interest']);

                                $sum3 += (@$value[9]['notice_estimate'] - @$value[9]['receive_amount']);
                                $sum4 += (@$value[9]['interest']);

                                $sum5 += (@$value[10]['notice_estimate'] - @$value[10]['receive_amount']);
                                $sum6 += (@$value[10]['interest']);
                                ?>
                            <tr>
                                <td align="center"><?php echo $int++; ?></td>
                                <td align="center"><?php echo $value['idcard'] ?></td>
                                <td><?php echo $value['name'] ?></td>
                                <td align="right"><?php echo number_format(@$value[8]['notice_estimate'] - @$value[8]['receive_amount'], 2) ?></td>
                                <td align="right"><?php echo number_format(@$value[8]['interest'], 2) ?></td>
                                <td align="right"><?php echo number_format(@$value[9]['notice_estimate'] - @$value[9]['receive_amount'], 2) ?></td>
                                <td align="right"><?php echo number_format(@$value[9]['interest'], 2) ?></td>
                                <td align="right"><?php echo number_format(@$value[10]['notice_estimate'] - @$value[10]['receive_amount'], 2) ?></td>
                                <td align="right"><?php echo number_format(@$value[10]['interest'], 2) ?></td>
                                <td align="right"><?php echo number_format((@$value[8]['notice_estimate'] - @$value[8]['receive_amount']) + (@$value[9]['notice_estimate'] - @$value[9]['receive_amount']) + (@$value[10]['notice_estimate'] - @$value[10]['receive_amount']) + @$value[8]['interest'] + @$value[9]['interest'] + @$value[10]['interest'], 2) ?></td>
                            </tr>
                            <?php 
                          }
                        } ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <td align="center" colspan="3">รวม</td>
                            <td align="right"><?php echo number_format($sum1, 2) ?></td>
                            <td align="right"><?php echo number_format($sum2, 2) ?></td>
                            <td align="right"><?php echo number_format($sum3, 2) ?></td>
                            <td align="right"><?php echo number_format($sum4, 2) ?></td>
                            <td align="right"><?php echo number_format($sum5, 2) ?></td>
                            <td align="right"><?php echo number_format($sum6, 2) ?></td>
                            <td align="right"><?php echo number_format($sum1 + $sum2 + $sum3 + $sum4 + $sum5 + $sum6, 2) ?></td>
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
<style>
th{
    text-align: center;
background-color:#2A3F54;
color: #FFF;
}


</style>
      


