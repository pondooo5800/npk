<?php error_reporting(0); ?>
<div class="right_col" role="main">
        <section class="row">
            <div class="col-md-6 col-sm-4 col-xs-4">
                <h3>ทะเบียนคุมผู้ชำระภาษี</h3>
            </div>
            <div class="col-md-6 col-sm-8 col-xs-8 text-right" style="margin-top: 7px;">
                <div class="btn-group">
                    <!-- <button type="button" class="btn btn-success" title="กรองข้อมูล"><i class="glyphicon glyphicon-filter"> </i> ตัวกรอง
                    </button>
                    <button type="button" class="btn btn-success" title="ส่งออกข้อมูล"> <i class="fa fa-upload"> </i> ส่งออกข้อมูล
                    </button> -->
                    <button onclick="window.open('<?php echo base_url('export_report/report_person/'.$id.'?type=pdf'); ?>');" type="button" class="btn btn-success" title="ส่งออก pdf"> <i class="fa fa-file-pdf-o"> </i> ส่งออก pdf
                    </button>
                    <button onclick="window.open('<?php echo base_url('export_report/report_person/'.$id); ?>');" type="button" class="btn btn-success" title="ส่งออก excel"> <i class="fa fa-file-excel-o"> </i> ส่งออก excel
                    </button>
                </div>
            </div>
        </section>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="top: 10px;">
                    <div class="col-xs-12 ">

                          <h5 class="inline text-right">ข้อมูล ณ วันที่ <?php echo $this->mydate->date_eng2thai(date('Y-m-d'), 543, 'S'); ?></h5>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <span style="text-align: center;"><h3>ทะเบียนคุมผู้ชำระภาษี (ผ.ท. 5)</h3></span>
                      <br>
                      <span> ชื่อ - สกุล : ผู้เสียภาษี <?php echo $data['person']['name']; ?></span> <span style="padding-left: 20px;"> รหัสชื่อ : <?php echo $data['person']['code_name']; ?></span>
                      <br>
                      <span> เลขที่ประจำตัวประชาชน/เลขประจำผู้เสียภาษี  <?php echo $data['person']['idcard']; ?></span>
                      <br>
                      <span> ที่อยู่ : บ้านเลขที่ <?php echo $data['person']['address']; ?> หมู่ที่ <?php echo $data['person']['village']; ?> ตำบล หนองป่าครั่ง อำเภอ เมือง จังหวัด เชียงใหม่</span>
                      <br>
                      <span> โทร. <?php echo $data['person']['phone']; ?> </span>
                    </div>

               <div class="x_content">
                 <?php //echo '<pre>'; print_r($data);?>
                 <br>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th colspan="10">ภาษีโรงเรือนและที่ดิน</th>
                          <th colspan="6">ภาษีบำรุงท้องที่</th>
                        </tr>
                        <tr>
                          <th rowspan="2">ประจำปี พ.ศ.</th>
                          <th colspan="3">ภ.ร.ด. 2</th>
                          <th colspan="3">ภ.ร.ด. 8</th>
                          <th colspan="3">ภ.ร.ด. 12</th>
                          <th colspan="3">ภ.บ.ท. 5</th>
                          <th colspan="3">ภ.บ.ท. 11</th>
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

                        </tr>
                        </thead>
                        <tbody>
                        <?php
/**
 * @param $value
 *
 * @return mixed
 */
function chkNo($value)
{
    $data = '';
    if ($value > 0) {
        $data = number_format($value, 2);
    }

    return $data;
}
?>
                        <?php for ($i = 1; $i <= $data['count_rec']; ++$i) {
    if (!empty($data['tax'][8][$i]['notice_estimate']['year']) || !empty($data['tax'][9][$i]['notice_estimate']['year'])) {
        if (!empty($data['tax'][8][$i]['notice_estimate']['year'])) {
            $year = $data['tax'][8][$i]['notice_estimate']['year'] + 543;
        }

        if (!empty($data['tax'][9][$i]['notice_estimate']['year'])) {
            $year = $data['tax'][9][$i]['notice_estimate']['year'] + 543;
        }

        $tax_year8 = $tax_year9 = '';
        if (!empty($data['tax'][8][$i]['notice_estimate']['tax_year'])) {
            $tax_year8 = $data['tax'][8][$i]['notice_estimate']['year'] + 543;
            $tax_year8 = '/'.substr($tax_year8, 2, 2);
        }

        if (!empty($data['tax'][9][$i]['notice_estimate']['tax_year'])) {
            $tax_year9 = $data['tax'][9][$i]['notice_estimate']['year'] + 543;
            $tax_year9 = '/'.substr($tax_year9, 2, 2);
        } ?>
                          <tr>
                            <!--  ภ.ร.ด. 2 -->
                            <td><?php echo $year; ?></td>
                            <td><?php echo @$data['tax'][8][$i]['notice_estimate']['notice_number'].$tax_year8; ?></td>
                            <td><?php echo $this->mydate->date_eng2thai(@$data['tax'][8][$i]['notice_estimate']['notice_date_p2'], 543, 'S'); ?></td>
                            <td><?php echo chkNo(@$data['tax'][8][$i]['notice_estimate']['notice_annual_fee']); ?></td>

                            <!--  ภ.ร.ด. 8 -->
                            <?php
$tax_a = @$data['tax'][8][$i]['notice_estimate']['notice_no'];
        $tax_b = @$data['tax'][8][$i]['notice_estimate']['notice_number'];
        if ($tax_a != '' && $tax_b != '') {
            $tax_ab = @$data['tax'][8][$i]['notice_estimate']['notice_no'].'/'.@$data['tax'][8][$i]['notice_estimate']['notice_number_p8'];
        } else {
            $tax_ab = '';
        } ?>

                            <td><?php echo $tax_ab; ?></td>
                            <td><?php echo $this->mydate->date_eng2thai(@$data['tax'][8][$i]['notice_estimate']['notice_date'], 543, 'S'); ?></td>
                            <td><?php echo chkNo(@$data['tax'][8][$i]['notice_estimate']['notice_estimate']); ?></td>

                            <!--  ภ.ร.ด. 12 -->
                            <td><?php echo @$data['tax'][8][$i]['tax_receive']['receipt_number']; ?></td>
                            <td><?php echo $this->mydate->date_eng2thai(@$data['tax'][8][$i]['tax_receive']['receive_date'], 543, 'S'); ?></td>
                            <td><?php echo chkNo(@$data['tax'][8][$i]['tax_receive']['receive_amount']); ?></td>


                            <!--  ภ.บ.ท. 5 -->
                            <td><?php echo @$data['tax'][9][$i]['notice_estimate']['notice_number']; ?></td>
                            <td><?php echo $this->mydate->date_eng2thai(@$data['tax'][9][$i]['notice_estimate']['notice_date'], 543, 'S'); ?></td>
                            <td><?php echo chkNo(@$data['tax'][9][$i]['notice_estimate']['notice_estimate']); ?></td>

                            <!--  ภ.บ.ท. 11 -->
                            <td><?php echo @$data['tax'][9][$i]['tax_receive']['receipt_number']; ?></td>
                            <td><?php echo $this->mydate->date_eng2thai(@$data['tax'][9][$i]['tax_receive']['receive_date'], 543, 'S'); ?></td>
                            <td><?php echo chkNo(@$data['tax'][9][$i]['tax_receive']['receive_amount']); ?></td>

                          </tr>
                        <?php
    }
}?>
                        </tbody>
                  </table>


                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th colspan="7">ภาษีป้าย</th>
                          <th colspan="7">ค่าธรรมเนียมในอนุญาตต่างๆ</th>
                          <th rowspan="3">ลงลายมือชื่อ ว.ด.ป</th>
                        </tr>
                        <tr>
                          <th rowspan="2">ประจำปี พ.ศ.</th>
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
                          <th>จำนวนเงินภาษี</th>

                          <th>เลขที่รับ</th>
                          <th>วัน เดือน ปี</th>
                          <th>จำนวนเงินภาษี</th>

                          <th>เลขที่</th>
                          <th>วัน เดือน ปี</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php for ($i = 1; $i <= $data['count_rec']; ++$i) {
    if (!empty($data['tax'][10][$i]['notice_estimate']['year'])) {
        $tax_year10 = '';
        if (!empty($data['tax'][10][$i]['notice_estimate']['tax_year'])) {
            $tax_year10 = $data['tax'][10][$i]['notice_estimate']['year'] + 543;
            $tax_year10 = '/'.substr($tax_year10, 2, 2);
        } ?>
                          <tr>
                            <td><?php echo @$data['tax'][10][$i]['notice_estimate']['year'] + 543; ?></td>
                            <!--  ภ.ป. 1 -->
                            <td><?php echo @$data['tax'][10][$i]['notice_estimate']['notice_number'].$tax_year10; ?></td>
                            <td><?php echo $this->mydate->date_eng2thai(@$data['tax'][10][$i]['notice_estimate']['notice_date'], 543, 'S'); ?></td>
                            <td><?php echo chkNo(@$data['tax'][10][$i]['notice_estimate']['notice_estimate']); ?></td>

                            <!--  ภ.ป. 7 -->
                            <td><?php echo @$data['tax'][10][$i]['tax_receive']['receipt_number']; ?></td>
                            <td><?php echo $this->mydate->date_eng2thai(@$data['tax'][10][$i]['tax_receive']['receive_date'], 543, 'S'); ?></td>
                            <td><?php echo chkNo(@$data['tax'][10][$i]['tax_receive']['receive_amount']); ?></td>

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
    }
}?>
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
