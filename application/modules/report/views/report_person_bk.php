
<div class="right_col" role="main" style="width: 2000px;">
        <section class="row">
                  <div class="col-md-6 col-sm-4 col-xs-4">
                      <h3>รายงานลูกหนี้ค้างชำระ</h3>
                  </div>
                  <div class="col-md-6 col-sm-8 col-xs-8 text-right" style="margin-top: 7px;">
                      <div class="btn-group">
                          <!-- <button type="button" class="btn btn-success" title="กรองข้อมูล"><i class="glyphicon glyphicon-filter"> </i> ตัวกรอง
                          </button>
                          <button type="button" class="btn btn-success" title="ส่งออกข้อมูล"> <i class="fa fa-upload"> </i> ส่งออกข้อมูล
                          </button> -->
                          <button type="button" class="btn btn-success" title="พิมพ์"> <i class="glyphicon glyphicon-print"> </i> พิมพ์
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
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <span style="text-align: center;"><h3>ทะเบียนคุมผู้ชำระภาษี</h3></span>
                      <br>
                      <span> ชื่อ - สกุล : ผู้เสียภาษี <?php echo $data['person']['name'] ?></span>
                      <br>
                      <span> เลขที่ประจำตัวประชาชน/เลขประจำผู้เสียภาษี  <?php echo $data['person']['idcard'] ?></span>
                      <br>
                      <span> ที่อยู่ : บ้านเลขที่ <?php echo $data['person']['address'] ?> หมู่ที่ <?php echo $data['person']['village'] ?> ตำบล หนองป่าคลั่ง อำเภอ เมือง จังหวัด เชียงใหม่</span>
                      <br>
                      <span> โทร. <?php echo $data['person']['phone'] ?> </span>
                    </div>
              
               <div class="x_content">
                 <?php //echo '<pre>'; print_r($data);?> 
                 <br>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th colspan="10">ภาษีโรงเรือนและที่ดิน</th>
                          <th colspan="6">ภาษีบำรุงท้องที่</th>
                          <th colspan="6">ภาษีป้าย</th>
                          <th colspan="7">ค่าธรรมเนียมในอนุญาตต่างๆ</th>
                          <th rowspan="3">ลงลายมือชื่อ ว.ด.ป</th>
                        </tr> 
                        <tr>
                          <th rowspan="2">ประจำปี พ.ศ.</th>
                          <th colspan="3">ภ.ร.ด. 2</th>
                          <th colspan="3">ภ.ร.ด. 8</th>
                          <th colspan="3">ภ.ร.ด. 12</th>
                          <th colspan="3">ภ.บ.ท. 5</th>
                          <th colspan="3">ภ.บ.ท. 11</th>
                          <th colspan="3">ภ.ป. 1</th>
                          <th colspan="3">ภ.ป. 7</th>
                          <th colspan="2">คำร้อง</th>
                          <th rowspan="2">ประเภท</th>
                          <th rowspan="2">ใบอนุญาต เล่มที่/เลขที่</th>
                          <th rowspan="2">วัน เดือน ปี</th>
                          <th rowspan="2">จำนวนเงิน</th>
                          <th rowspan="2">หมายเหตุ</th>
                        </tr>
                        <tr>
                          <th>เลขที่รับ</th>
                          <th>วัน เดือน ปี</th>
                          <th>ค่ารายปี</th>

                          <th>เล่มที่/เลขที่</th>
                          <th>วัน เดือน ปี</th>
                          <th>จำนวนเงินภาษี</th>

                          <th>เล่มที่/เลขที่</th>
                          <th>วัน เดือน ปี</th>
                          <th>จำนวนเงินภาษี</th>

                          <th>เลขที่สำรวจ</th>
                          <th>วัน เดือน ปี</th>
                          <th>จำนวนเงินภาษี</th>

                          <th>เลขที่สำรวจ</th>
                          <th>วัน เดือน ปี</th>
                          <th>จำนวนเงินภาษี</th>

                          <th>เลขที่รับ</th>
                          <th>วัน เดือน ปี</th>
                          <th>จำนวนเงินภาษี</th>

                          <th>เลขที่รับ</th>
                          <th>วัน เดือน ปี</th>
                          <th>จำนวนเงินภาษี</th>

                          <th>เลขที่</th>
                          <th>วัน เดือน ปี</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php for ($i = 1; $i <= $data['count_rec']; $i++) { ?>
                          <tr>
                            <!--  ภ.ร.ด. 2 -->
                            <td><?php echo (@$data['tax'][8][$i]['notice_estimate']['year'] + 543) ?></td>
                            <td><?php echo @$data['tax'][8][$i]['notice_estimate']['notice_number_p2'] ?></td>
                            <td><?php echo $this->mydate->date_eng2thai(@$data['tax'][8][$i]['notice_estimate']['notice_date_p2'], 543, 'S') ?></td>
                            <td><?php echo number_format(@$data['tax'][8][$i]['notice_estimate']['notice_annual_fee'], 2) ?></td>

                            <!--  ภ.ร.ด. 8 -->
                            <td><?php echo @$data['tax'][8][$i]['notice_estimate']['notice_no'] . '/' . @$data['tax'][8][$i]['notice_estimate']['notice_number'] ?></td>
                            <td><?php echo $this->mydate->date_eng2thai(@$data['tax'][8][$i]['notice_estimate']['notice_date'], 543, 'S') ?></td>
                            <td><?php echo number_format(@$data['tax'][8][$i]['notice_estimate']['notice_estimate'], 2) ?></td>

                            <!--  ภ.ร.ด. 12 -->
                            <td><?php echo @$data['tax'][8][$i]['tax_receive']['receipt_number'] ?></td>
                            <td><?php echo $this->mydate->date_eng2thai(@$data['tax'][8][$i]['tax_receive']['receive_date'], 543, 'S') ?></td>
                            <td><?php echo number_format(@$data['tax'][8][$i]['tax_receive']['receive_amount'], 2) ?></td>

                            <!--  ภ.บ.ท. 5 -->
                            <td><?php echo @$data['tax'][9][$i]['notice_estimate']['notice_number'] ?></td>
                            <td><?php echo $this->mydate->date_eng2thai(@$data['tax'][9][$i]['notice_estimate']['notice_date'], 543, 'S') ?></td>
                            <td><?php echo number_format(@$data['tax'][9][$i]['notice_estimate']['notice_estimate'], 2) ?></td>

                            <!--  ภ.บ.ท. 11 -->
                            <td><?php echo @$data['tax'][9][$i]['tax_receive']['receipt_number'] ?></td>
                            <td><?php echo $this->mydate->date_eng2thai(@$data['tax'][9][$i]['tax_receive']['receive_date'], 543, 'S') ?></td>
                            <td><?php echo number_format(@$data['tax'][9][$i]['tax_receive']['receive_amount'], 2) ?></td>

                            <!--  ภ.ป. 1 -->
                            <td><?php echo @$data['tax'][10][$i]['notice_estimate']['notice_number'] ?></td>
                            <td><?php echo $this->mydate->date_eng2thai(@$data['tax'][10][$i]['notice_estimate']['notice_date'], 543, 'S') ?></td>
                            <td><?php echo number_format(@$data['tax'][10][$i]['notice_estimate']['notice_estimate'], 2) ?></td>

                            <!--  ภ.ป. 7 -->
                            <td><?php echo @$data['tax'][10][$i]['tax_receive']['receipt_number'] ?></td>
                            <td><?php echo $this->mydate->date_eng2thai(@$data['tax'][10][$i]['tax_receive']['receive_date'], 543, 'S') ?></td>
                            <td><?php echo number_format(@$data['tax'][10][$i]['tax_receive']['receive_amount'], 2) ?></td>

                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr>
                        <?php 
                      } ?>
                        </tbody>
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
      


