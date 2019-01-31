<?php

class export extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->excel = ($this->input->get('type') == 'pdf') ? false : true;
        $this->load->library('ExportExcel');
        $this->load->library('ExportPdf');
        $this->load->model('export_model');
        ini_set('memory_limit', '128M');
    }

    public function gat1($tax_id = '', $id = '')
    {
        $gat1 = $this->export_model->getTaxNotice($tax_id, $id);
        $date = explode('-', $gat1['notice_date']);

        $budget_sum = 0;
        $tax_interest_sum = 0;

        foreach ($gat1['detail'] as $key => $value) {
            $budget_sum = $budget_sum + $value['notice_estimate'];
            $tax_interest_sum = $tax_interest_sum + $value['tax_interest'];
        }

        $budget = explode('.', $budget_sum);
        if ($budget[0] == '') {
            $budget[0] = '-';
        }
        if ($budget[1] == '') {
            $budget[1] = '0';
        }

        $tax_interest = explode('.', $tax_interest_sum);
        $sum = $budget[0] + $tax_interest[0];
        $sum_str = $budget[1] + $tax_interest[1];
        if ($tax_interest[0] == '') {
            $tax_interest[0] = '-';
        }
        if ($tax_interest[1] == '') {
            $tax_interest[1] = '-';
        }

        $content = '
        <style>
          table {
              border-collapse: collapse;
              font-family: "thsarabun";
              font-size:16px;
          }

        </style>
        <table border="0" style="width:100%;" >

            <tr>
              <td colspan="3" style="text-align: right;" >26-30-02</td>
            </tr>
            <tr>
              <td style="width: 250px"><b>ภ.ป. ๓</b><br><b>หนังสือแจ้งการประเมิน</b><br></td>
              <td style="text-align: center;"> <img src="assets/images/unnamed.jpg" style="width: 100px;">  </td>
            </tr>
            <tr>
              <td style="width: 25%">
                    ที่ ชม. ๕๔๙๐๒/...............
              </td>
              <td>&nbsp;</td>
              <td style="text-align: right; ">เทศบาลตำบลหนองป่าครั่ง<br>อ.เมือง จ.เชียงใหม่ ๕๐๐๐๐ </td >
            </tr>

            <tr>
            <br>
              <td colspan="3"><br>เรื่อง  แจ้งการประเมิน'.$gat1['tax_name'].'<br> เรียน '.' '.' '.$gat1['individual_prename'].$gat1['individual_fullname'].'</td>
            </tr>
            <tr>
              <td colspan="3" style="text-align: center;"><br>
              ตามที่ท่านได้ยื่นแบบแสดงรายการ'.' '.' '.$gat1['tax_name'].' ไว้ตามแบบ ภ.ป. ๑
              เลขรับที่'.' '.'    '.$this->mydate->conv_th_digit($gat1['notice_number']).'/'.''.'    '.$this->mydate->conv_th_digit($gat1['tax_year'] + 543).'
            </tr>
            <tr>
              <td colspan="3" style="width:20%;">
              ลงวันที่'.' '.$this->mydate->conv_th_digit($date[2]).' เดือน '.$this->mydate->getMonthname($date[1] * 1).' พ.ศ. '.$this->mydate->conv_th_digit($date[0] + 543).'   ไว้ นั้น
            </tr>
            <tr>
              <td colspan="3" style="text-align: center;"><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;บัดนี้ พนักงานเจ้าหน้าที่ได้ทำการประเมินเสร็จแล้ว เป็นเงิน

              '.' '.' '.$gat1['tax_name'].'  '.'  '.' '.$this->mydate->conv_th_digit(number_format($budget[0])).' บาท'.' '.' '.$this->mydate->conv_th_digit(number_format($budget[1])).' สตางค์ </p>
            </tr>
            <tr>
              <td colspan="3" style="width:10px;">
              <p>และเงินเพิ่ม '.$this->mydate->conv_th_digit(number_format($tax_interest[0])).' บาท '.$this->mydate->conv_th_digit(number_format($tax_interest[1])).' สตางค์ รวมทั้งสิ้นเป็นเงิน '.$this->mydate->conv_th_digit(number_format($sum)).' บาท '.$this->mydate->conv_th_digit(number_format($sum_str)).' สตางค์ </p>
            </tr>
            <tr>
              <td colspan="3" style="width:10px;text-align: center;"><br>
              โปรดนำเงินจำนวนดังกล่าวไปชำระภายใน ๑๕ วัน นับตั้งแต่วันที่ได้รับหนังสือนี้
              หากพ้นกำหนดจะต้องเสียเงินเพิ่มตามกฏหมาย
            </tr>
            <tr>
            <td></td>
            <td style="width:10px;"></td>
            <td style="text-align: center;"><br><br><br><br>  ขอแสดงความนับถือ (อย่างสูง)
            <br><br>................................................................ <br>(................................................................) <br> พนักงานเจ้าหน้าที่ </td>
          </tr>
          <tr>
            <td colspan="3" style="text-align: center;"><br><b><u>ใบรับ ภ.ป.๓</u></b></td>
          </tr>
          <tr>
            <td colspan="3" style="text-align: left;"><br><br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้า.....................................................................อยู่บ้านเลขที่......................................................ตรอก........................................................<br><br>
            ซอย...........................................ถนน...........................................หมู่ที่......................................................................ตำบล......................................... <br><br>
            อำเภอ....................................................................................จังหวัด...................................................เกี่ยวข้องเป็น................................................... <br/><br/>
            กับเจ้าของป้าย ได้รับ ภ.ป.๓ ที่.............../๒๕........................... ลงวันที่............................เดือน.................................................................................<br/><br>
            พ.ศ. ๒๕...................ไว้แล้ว แต่วันที่...........................................พ.ศ...........................................
            <br/><br/><br/><br/>
            </td>
          </tr>
          <tr>
          <td colspan="3" style="text-align: center;">
            ลงชื่อ...................................................ผู้รับ ลงชื่อ...................................................ผู้ส่ง
            </td>
          </tr>
          </table>';

        $dataExport[] = array('html' => $content, 'border' => true, 'auto' => true);

        $this->exportpdf->exportFhtml($dataExport);
    }

    public function gat2($tax_id = '', $id = '')
    {
        $data = $this->export_model->getTaxNotice($tax_id, $id);
        $detail = $this->export_model->getTaxNoticeHouse($data);
        // print_r($detail);die();
        $date = explode('-', $data['notice_date']);
        $content = '<style>
                      table {
                          border-collapse: collapse;
                          font-family: "thsarabun";
                          font-size:16px;
                      }

                    </style>
        <table border="0" style="width:100%;border-style: none;" >
        <tr>
          <td  style="width: 300px;" ><b>ภ.ร.ด. ๘</b></td>
          <td  style="  border-left: 1px solid black;" rowspan="12" ></td>
          <td  style="text-align: right;" rowspan="12" >
            <table border="0" style="width:100%;border-style: none;" >
              <tr>
                <td style="text-align: left;"><b>&nbsp;ภ.ร.ด. ๘</b></td>
                <td style="text-align: center;"><h3>ใบแจ้งรายการประเมิน ตามมาตรา ๒๔ แห่ง</h3></td>
              </tr>
              <tr>
                <td style="text-align: left;">&nbsp;เล่มที่ '.$this->mydate->conv_th_digit($data['notice_no']).'</td>
                <td style="text-align: center;"><h3>พระราชบัญญัติภาษีโรงเรือนและที่ดิน พ.ศ. ๒๔๗๕</h3></td>
              </tr>
              <tr>
                <td style="text-align: left;">&nbsp;เลขที่ '.$this->mydate->conv_th_digit($data['notice_number_p8']).'</td>
                <td style="text-align: center;">___________________________</td>
              </tr>
              <tr>
                <td style="text-align: center;"><br></td>
                <td style="text-align: center;"></td>
              </tr>
              <tr>
                <td style="text-align: left;" colspan="3">
                  <pre>&nbsp;ภ.ร.ด ๒ เลขประจำตำบลที่ '.$this->mydate->conv_th_digit($data['notice_number']).'/'.$this->mydate->conv_th_digit($data['tax_year'] + 543).'  เทศบาลตำบลหนองป่าครั่ง                                       วันที่ '.$this->mydate->conv_th_digit($date[2]).' เดือน '.$this->mydate->getMonthname($date[1] * 1).' พ.ศ. '.$this->mydate->conv_th_digit($date[0] + 543).'

                  แจ้งความมายัง '.$data['individual_prename'].$data['individual_fullname'].'                                          ผู้รับประเมินภาษีโรงเรือน จำนวน พ.ศ. ...............

                  ด้วยพนักงานเจ้าหน้าที่เห็นสมควรกำหนดค่ารายปีและค่าภาษีที่พึ่งชำระสำหรับทรัพย์สินของท่าน ดังแจ้งต่อไปนี้
                  </pre></td>

              </tr>
              <tr>
                <td style="text-align: right; " colspan="4" >
                  <table border="1" style="text-align: center;width:100%; " >
                    <tr>
                      <th rowspan="2" width="20%">ทรัพย์สิน</th>
                      <th rowspan="2" width="10%">เลขสำมะโนครัว</th>
                      <th rowspan="2" width="10%">ตำบล หรือ ถนน</th>
                      <th colspan="2" width="20%">ค่ารายปี</th>
                      <th colspan="2" width="20%">ค่าภาษี</th>
                      <th rowspan="2" width="10%" style="border-right-color: white;">หมายเหตุ</th>
                    </tr>

                    <tr>
                      <td style="text-align:center">บาท</td>
                      <td style="text-align:center">สต.</td>
                      <td style="text-align:center">บาท</td>
                      <td style="text-align:center">สต.</td>
                    </tr>
                    ';
        $sum_year = 0;
        $sum_tax = 0;
        foreach ($detail as $key => $value) {
            $sum_year = $sum_year + $value['notice_annual_fee'];

            $sum_tax = $sum_tax + $value['notice_estimate'];
            $es = str_replace(',', '', number_format($value['notice_estimate'], 2));
            //$value['notice_annual_fee'] = explode('.', $value['notice_annual_fee']);
            $value['notice_estimate'] = explode('.', $es);

            $es2 = str_replace(',', '', number_format($value['notice_annual_fee'], 2));
            $value['notice_annual_fee'] = explode('.', $es2);

            $content .= '<tr style="text-align: left; font-size:14px">
                      <td style="font-size:14px">'.$value['noice_operation_name'].' '.$this->mydate->conv_th_digit($value['number']).' หลัง'.'</td>
                      <td style="font-size:14px">'.$this->mydate->conv_th_digit($value['notice_address_number']).'</td>
                      <td style="font-size:14px">ต.หนองป่าครั่ง อ.เมือง จ.เชียงใหม่</td>
                      <td style="font-size:14px"> '.$this->mydate->conv_th_digit(number_format($value['notice_annual_fee'][0]), 2).'</td>
                      <td style="font-size:14px"> '.$this->mydate->conv_th_digit(number_format($value['notice_annual_fee'][1]), 2).'</td>
                      <td style="font-size:14px"> '.$this->mydate->conv_th_digit(number_format($value['notice_estimate'][0]), 2).'</td>
                      <td style="font-size:14px"> '.$this->mydate->conv_th_digit(number_format($value['notice_estimate'][1]), 2).'</td>
                      <td style="border-right-color: white;"></td>
                      </tr>';
        }

        $sum_years = explode('.', $sum_year);
        $sum_taxs = explode('.', $sum_tax);

        $content .= '<tr >
                      <td colspan="2" style="border-left:none;border-bottom:none;"></td>
                      <td style="font-size:14px">รวม</td>
                      <td style="font-size:14px">'.$this->mydate->conv_th_digit(number_format($sum_years[0]), 2).'</td>
                      <td style="font-size:14px">'.$this->mydate->conv_th_digit(number_format($sum_years[1]), 2).'</td>
                      <td style="font-size:14px">'.$this->mydate->conv_th_digit(number_format($sum_taxs[0]), 2).'</td>
                      <td style="font-size:14px">'.$this->mydate->conv_th_digit(number_format($sum_taxs[1]), 2).'</td>
                      <td style="border-right-color: white;"></td>
                    </tr>
                  </table>
                  <br>
                  <br>

                </td>
              </tr>
              <tr>

                <td style="text-align: left;" colspan="3">
                  <pre>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ขอให้ท่านนำเงินไปชำระต่อ สำนักงานเทศบาลตำบลหนองป่าครั่ง ภายใน ๓๐ วัน นับตั้งแต่วันที่รับใบแจ้งการประเมินนี้<br>
                  ..................... ถ้ามิได้ชำระตามกำหนด จะต้องเสียเงินเพิ่มมาตรา ๔๓ หากผู้รับประเมินไม่พอใจในการประเมิน ให้ยืนคำร้องขอให้พิจารณาการ<br>
                  ประเมินใหม่ภายในเวลา ๑๕ วัน นับตั้งแต่วันที่ได้รับแจ้ง
                  </pre>
                </td>
              </tr>
              <tr><td>&nbsp;</td></tr>
              <tr><td>&nbsp;</td></tr>
              <tr><td>&nbsp;</td></tr>
              <tr><td>&nbsp;</td></tr>
              <tr><td>&nbsp;</td></tr>
              <tr><td>&nbsp;</td></tr>
              <tr>
                <td style="text-align: right;" colspan="3">
                (ลงชื่อ)......................................................................
                </td>
              </tr>

            </table>
          </td>

        </tr>

        <tr >
          <td  >แบบแจ้งรายการประเมิน<br><br>
               ตามมาตรา ๒๔ สำหรับภาษีโรงเรือน<br><br>
               คำนวณ พ.ศ. ..............<br><br>
               เล่มที่  '.$this->mydate->conv_th_digit($data['notice_no']).'  เลขที่  '.$this->mydate->conv_th_digit($data['notice_number_p8']).'<br><br>
               ภ.ร.ด. ๒ เลขประจำตำบลที่ '.$this->mydate->conv_th_digit($data['notice_number']).'/'.$this->mydate->conv_th_digit($data['tax_year'] + 543).'<br><br>
               เทศบาลตำบลหนองป่าครั่ง<br><br>
               ถึง '.$data['individual_prename'].$data['individual_fullname'].'
          </td>
        </tr>
        <tr>
          <td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รายการทรัพย์สิน</b></td>
        </tr>
        <tr>
          <td   >';

        foreach ($detail as $key => $value) {
            $content .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$this->mydate->conv_th_digit($key + 1).'. '.$value['noice_operation_name'].' '.$this->mydate->conv_th_digit($value['number']).' หลัง<br/>';
        }

        $content .= '</td>
        </tr>
        <tr><td>&nbsp;</td></tr>

        <tr>
          <td  style="text-align: left;" ><b>ค่ารายปี     &nbsp;&nbsp;&nbsp;&nbsp;'.$this->mydate->conv_th_digit(number_format($sum_year), 2).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    บาท</td>
        </b></tr>
        <tr>
          <td  style="text-align: left;" ><b>ค่าภาษี     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$this->mydate->conv_th_digit(number_format($sum_tax), 2).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     บาท</td>
        </b></tr>
      </table>';
        $dataExport[] = array('html' => $content, 'border' => true, 'auto' => true);

        $this->exportpdf->exportFhtml($dataExport, 'A4-L');
    }

    public function gat3($tax_id = '', $id = '')
    {
        $gat3 = $this->export_model->getTaxNotice($tax_id, $id);
        $data = $this->export_model->getTaxNoticeGat3($gat3);

        $subdistrict = $this->export_model->getAddressNameById($gat3['individual_subdistrict']);
        // print_r($subdistrict);die();
        $district = $this->export_model->getAddressNameById($gat3['individual_district']);
        $province = $this->export_model->getAddressNameById($gat3['individual_provice']);

        // $date = explode('-', $gat1['notice_date']);
        $budget = explode('.', $data['notice_estimate']);
        if ($budget[0] == '') {
            $budget[0] = '-';
        }
        if ($budget[1] == '') {
            $budget[1] = '0';
        }

        // $tax_interest  = explode('.',$gat['tax_interest']);
        // $sum = $budget[0] + $tax_interest[0];
        // $sum_str = $budget[1] + $tax_interest[1];
        // if ($tax_interest[0] == ''){
        //   $tax_interest[0] = '-';
        // }
        // if ($tax_interest[1] == ''){
        //   $tax_interest[1] = '-';
        // }

        $content = '
          <style>

              table {
                  border-collapse: collapse;
                  font-family: "thsarabun";
                  font-size:16px;
              }

            hr{
              border: none;
              height: 2px;
              /* Set the hr color */
              color: #333; /* old IE */
              background-color: #333; /* Modern Browsers */
            }
          </style>
          <br>
          <table border="0" width="100%">
          <tbody>
            <tr>
              <td colspan="4" style="text-align: center;"><h3>ภ.บ.ท. ๕</h3></td>
            </tr>
            <tr>
              <td colspan="4" style="text-align: center;"><h3>(ท่อนนี้มอบให้เจ้าของที่ดิน)</h3></td>
            </tr>
            <tr >
                <td width="40%"></td>
                <td width="40%"><hr></td>
                <td width="40%"></td>
            </tr>
          </tbody>
          </table>
          <table border="0" width="100%" >
            <tbody>
              <tr >
                  <td rowspan=20 width="10%"></td>
                  <td width="60%"><br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ที่ดินตั้งอยู่หน่วยที่&nbsp;&nbsp;............................................................<br><br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เลขสำรวจที่&nbsp;&nbsp;&nbsp;'.$this->mydate->conv_th_digit($gat3['notice_number']).'<br><br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;หมู่ที่&nbsp;&nbsp;&nbsp;&nbsp;'.$this->mydate->conv_th_digit($gat3['notice_address_moo']).'&nbsp;&nbsp;&nbsp;ตำบลหนองป่าครั่ง<br><br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;อำเภอเมืองเชียงใหม่&nbsp;&nbsp;&nbsp;จังหวัดเชียงใหม่
                  </td>
              </tr>
              <tr>
                  <td ><br/></td>
              </tr>
              <tr>
                  <td><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชื่อเจ้าของที่ดิน&nbsp;'.$gat3['individual_prename'].' '.$gat3['individual_firstname'].' '.$gat3['individual_lastname'].'<br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;อยู่บ้านเลขที่&nbsp;&nbsp;&nbsp;'.$this->mydate->conv_th_digit($gat3['individual_address']).'&nbsp;&nbsp;&nbsp;หมู่ที่&nbsp;&nbsp;&nbsp;&nbsp;'.$this->mydate->conv_th_digit($gat3['individual_village']).'
                    &nbsp;&nbsp;&nbsp;ตำบล'.$subdistrict['area_name_th'].'<br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;อำเภอ'.$district['area_name_th'].'&nbsp;&nbsp;&nbsp;จังหวัด'.$province['area_name_th'].'
              </tr>
              <tr >
                  <td><br>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชื่อผู้ถือกรรมสิทธิ์ร่วม&nbsp;............................................................</td>
              </tr>
              <tr >
                  <td><br>  </td>
              </tr>
              <tr >
                  <td><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เนื้อที่ดินทั้งหมด&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$this->mydate->conv_th_digit($data['land_rai']).' ไร่&nbsp;&nbsp;&nbsp;&nbsp;'.$this->mydate->conv_th_digit($data['land_ngan']).' งาน&nbsp;&nbsp;&nbsp;&nbsp;'.$this->mydate->conv_th_digit($data['land_wa']).' วา <br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เนื้อที่ดินที่ต้องชำระภาษี&nbsp;&nbsp;&nbsp;&nbsp;'.$this->mydate->conv_th_digit($data['land_rai']).' ไร่&nbsp;&nbsp;&nbsp;&nbsp;'.$this->mydate->conv_th_digit($data['land_ngan']).' งาน&nbsp;&nbsp;&nbsp;&nbsp;'.$this->mydate->conv_th_digit($data['land_wa']).' วา <br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รวมเงินภาษีที่ต้องชำระ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$this->mydate->conv_th_digit(number_format($budget[0])).' &nbsp;&nbsp;&nbsp;&nbsp;บาท &nbsp;&nbsp;&nbsp;&nbsp;'.$this->mydate->conv_th_digit($budget[1]).'&nbsp;&nbsp;&nbsp;&nbsp;สต. <br><br>

                    </td>
              </tr>
              <tr >
                    <td><br><br><br><br><br></td>
                </tr>
              </tbody>
            </table>
            <table border="0" width="100%" style="text-align:center;">
              <tbody>
                <tr >
                  <td ><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ลงชื่อ......................................................................เจ้าพนักงานประเมิน</td>
                </tr>
                <tr >
                  <td ><br>(................................................................)</td>
                </tr>
                <tr >
                  <td ><br>วันที่................................ / ....................... / ......................</td>
                </tr>

                <tr >
                    <td><br><br><br><br><br><br><br>  </td>
                </tr>
                <tr >
                  <td ><br><b>โปรดเก็บรักษาไว้ให้ดี และนำมาด้วยทุกครั้ง ที่ท่านติดต่อชำระภาษีบำรุงท้องที่</b></td>
                </tr>
              </tbody>
            </table>';

        $dataExport[] = array('html' => $content, 'border' => true, 'auto' => true);

        $this->exportpdf->exportFhtml($dataExport);
    }

    public function alert_tax($id = '')
    {
        $data = $this->export_model->getTaxNoticeAlert($id);
        $subdistrict = $this->export_model->getAddressNameById($data['individual_subdistrict']);
        // print_r($data);die();
        $district = $this->export_model->getAddressNameById($data['individual_district']);
        $province = $this->export_model->getAddressNameById($data['individual_provice']);
        // print_r($data);die();
        $content = '
      <style>
        table {
            border-collapse: collapse;
            font-family: "thsarabun";
            font-size:20px;
        }
        .table-child{
          border-collapse: collapse;
          font-family: "thsarabun";
          font-size:20px;
        }
        th{

          font-weight: normal;
        }

      </style>

      <table border="0" style="width:100%; " >
        <tr>
          <td colspan=3 style="text-align:center;"><img src="assets/images/logo_alert.jpg" style="width: 80px;"> </td>
        </tr>
        <tr>';
        if ($data['alert_order'] != 3) {
            $content .= '<td colspan=3 style="text-align:left;">หนังสือแจ้งเตือนครั้งที่ '.$this->mydate->conv_th_digit($data['alert_order']).'</td>';
        } else {
            $content .= '<td colspan=3 style="text-align:left;">หนังสือแจ้งเตือนครั้งสุดท้าย</td>';
        }
        $content .= '</tr>
        <tr>
          <td style="text-align:left; width:100px;">ที่ ชม.๕๔๙๐๒/.............</td>
          <td  style="text-align:right;">สำนักงาน เทศบาลตำบลหนองป่าครั่ง<br/>
              อำเภอเมือง จังหวัดเชียงใหม่
          </td>
        </tr>
        <tr>
          <td colspan=3 style="text-align:right;"><br/>
              วันที่ '.$this->mydate->conv_th_digit($this->mydate->date_eng2thai($data['alert_date'])).'
          </td>
        </tr>
        <tr>
          <td colspan=2 style="width:370px;">
            เรื่อง ให้ไปชำระเงินค่า'.$data['tax_name'].'
          </td>
        </tr>
        <tr>
          <td colspan=2>
             เรียน '.$data['individual_prename'].' '.$data['individual_fullname'].'
          </td>
        </tr>
        <tr>
          <td colspan=3>';
        if ($data['alert_order'] == 1) {
            if ($data['tax_name'] == 'ภาษีบำรุงท้องที่') {
                $define_date = '๓๐ วัน';
                $content .= 'อ้างอิง ใบแจ้งรายการประเมิน '.$data['tax_name'].' เลขที่ '.$this->mydate->conv_th_digit($data['notice_number']).' ลงวันที่ '.$this->mydate->conv_th_digit($this->mydate->date_eng2thai($data['notice_date']));
            } elseif ($data['tax_name'] == 'ภาษีป้าย') {
                $define_date = '๑๕ วัน';
                $content .= 'อ้างอิง ใบแจ้งรายการประเมิน '.$data['tax_name'].' เลขที่ '.$this->mydate->conv_th_digit($data['notice_number']).' ลงวันที่ '.$this->mydate->conv_th_digit($this->mydate->date_eng2thai($data['notice_date']));
            } elseif ($data['tax_name'] == 'ภาษีโรงเรือนและที่ดิน') {
                $define_date = '๓๐ วัน';
                $content .= 'อ้างอิง ใบแจ้งรายการประเมิน '.$data['tax_name'].' เลขที่ '.$this->mydate->conv_th_digit($data['notice_number']).' เล่มที่ '.$this->mydate->conv_th_digit($data['notice_no']).' ลงวันที่ '.$this->mydate->conv_th_digit($this->mydate->date_eng2thai($data['alert_date']));
            }
        } else {
            if ($data['tax_name'] == 'ภาษีบำรุงท้องที่') {
                $define_date = '๓๐ วัน';
            } elseif ($data['tax_name'] == 'ภาษีป้าย') {
                $define_date = '๑๕ วัน';
            } elseif ($data['tax_name'] == 'ภาษีโรงเรือนและที่ดิน') {
                $define_date = '๓๐ วัน';
            }
            $content .= 'อ้างอิง หนังสือที่ ชม.๕๔๙๐๒ / .............. ลงวันที่ ...................... ';
        }

        $content .= '</td>
        </tr>';

        if ($data['alert_order'] != 3) {
            $content .= '<tr>
          <td colspan=3><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            ตามหนังสือที่อ้างถึงปรากฏว่าท่านได้ค้างชำระภาษี '.$data['tax_name'].' เทศบาล ตำบลหนองป่าครั่ง ดังมีรายละเอียดต่อไปนี้
          </td>
        </tr>
        <tr>
          <td colspan=3 style="text-align:center;">
            <table class="table-child" border="1" style="width:100%; ">
            <tr>
              <th width="150px">ประจำปีภาษี</th>
              <th width="150px">ค่าภาษี</th>
              <th width="150px">เงินเพิ่ม</th>
              <th width="150px">รวมเป็นเงิน</th>
            </tr>';
            $sum_result = 0;
            foreach ($data['detail'] as $key => $value) {
                $sum = $value['notice_estimate'] + $value['tax_interest'];
                $sum_result = $sum_result + $sum;
                $content .= '<tr>
                  <td style="text-align:center;">'.$this->mydate->conv_th_digit($value['tax_year'] + 543).'</td>
                  <td style="text-align:right;">'.$this->mydate->conv_th_digit(number_format($value['notice_estimate'], 2)).'</td>
                  <td style="text-align:right;">'.$this->mydate->conv_th_digit(number_format($value['tax_interest'], 2)).'</td>
                  <td style="text-align:right;">'.$this->mydate->conv_th_digit(number_format($sum, 2)).'</td>
                </tr>';
            }

            $content .= '<tr>
              <td colspan="2" style="border-left:none;border-bottom:none;"></td>
              <td style="text-align:center;">รวม
              </td>
              <td style="text-align:right;">'.$this->mydate->conv_th_digit(number_format($sum_result, 2)).'</td>
            </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td colspan=3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            รวมเป็นเงินค่าภาษีและเงินเพิ่มทั้งสิ้น '.$this->mydate->conv_th_digit(number_format($sum_result, 2)).' บาท ('.$this->Convert($sum_result).')
          </td>
        </tr>
        <tr>
          <td colspan=3><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           บัดนี้ ได้ล่วงเลยกำหนดเวลาที่ท่านจะต้องชำระค่าภาษีและเงินเพิ่มข้างต้นแล้วแต่ท่านยังมิได้ชำระแต่อย่าง ใด  จึงขอแจ้งให้ท่านนำเงินค่าภาษีและเงินเพิ่ม จำนวนดังระบุข้างต้นไปชำระที่ ฝ่ายพัฒนารายได้ กองคลัง
          สำนักงานเทศบาล ตำบลหนองป่าครั่ง จังหวัด เชียงใหม่ ภายในกำหนด ';
            $content .= $define_date.'นับตั้งแต่วันที่ได้รับหนังสือฉบับนี้ หากพ้นกำหนดนี้แล้วสำนักงาน เทศบาลตำบลหนองป่าครั่ง จำต้องดำเนินการยืดทรัพย์สินของท่าน
          นำขายทอดตลาดเพื่อชำระค่าภาษีที่ค้างข้างต้นตาม กฎหมายต่อไป
          </td>
        </tr>
        <tr>';
            $content .= '<td colspan=3><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            จึงเรียนเตือนมาเพื่อชำระหนี้ค่าภาษีดังกล่าวข้างต้นให้เสร็จสิ้นไปด้วย
          </td>
        </tr>';
        } else {
            $sum_result = 0;
            foreach ($data['detail'] as $key => $value) {
                $sum = $value['notice_estimate'] + $value['tax_interest'];
                $sum_result = $sum_result + $sum;
            }

            $content .= '<tr>
          <td colspan=3><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            ตามหนังสือที่อ้างถึงปรากฏว่าท่านได้ค้างชำระภาษี '.$data['tax_name'].' ที่อยู่ '.$this->mydate->conv_th_digit($data['individual_address']).' หมู่ '.$this->mydate->conv_th_digit($data['individual_village']).' ตำบล '.$subdistrict['area_name_th'].' อำเภอ '.$district['area_name_th'].' จังหวัด '.$province['area_name_th'].' '.$this->mydate->conv_th_digit($data['individual_zipcode']).
            '</td>
        </tr>

        <tr>
          <td colspan=3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            รวมเป็นเงินค่าภาษีและเงินเพิ่มทั้งสิน '.$this->mydate->conv_th_digit(number_format($sum_result, 2)).' บาท ('.$this->Convert($sum_result).') นั้น
          </td>
        </tr>
        <tr>
          <td colspan=3><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           บัดนี้ ได้ล่วงเลยกำหนดเวลากำหนดดังกล่าวแล้ว จึงขอเตือนท่านนำเงินค่าภาษีไปชำระที่ ฝ่ายพัฒนารายได้ กองคลัง
          สำนักงาน เทศบาลตำบลหนองป่าครั่ง จังหวัด เชียงใหม่ ภายในกำหนด ';
            $content .= '๑๕ วัน'.'หากพ้นกำหนดนี้แล้ว สำนักงาน เทศบาลตำบลหนองป่าครั่ง จำต้องดำเนินการยืดทรัพย์สินของท่านทันที
          </td>
        </tr>
        <tr>';
            $content .= '<td colspan=3><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              จึงเรียนมาเพื่อโปรดไปชำระหนี้ค่าภาษีดังกล่าวข้างต้นให้เสร็จสิ้นโดยเร็ว
            </td>
          </tr>';
        }

        $content .= '<tr>
          <td colspan=3 style="text-align:center"><br/>
                ขอแสดงความนับถือ<br/><br/>
                (ลงชื่อ).........................................................<br/>
                (นายชฏิลพงษ์ จำเดิมเผด็จศึก)<br/>
                ตำแหน่ง เจ้าพนักงานประเมิน
          </td>
        </tr>
        <tr>
          <td colspan=3>
            ฝ่ายพัฒนารายได้  กองคลัง<br/>
            โทรศัพท์ ๐-๕๓๘๕-๐๔๒๑ ต่อ ๑๑๕<br/>
            โทรศัพท์ ๐-๕๓๘๕-๑๖๔๖

          </td>
        </tr>';

        $content .= '<tr>
                    <td colspan=3>
                      <u><b>หมายเหตุ</b></u> เพื่อความสะดวกในการชำระเงิน ขอให้ท่านนำหนังสือเตือนนี้ไปแสดงด้วย<br/>


                    </td>
                  </tr>';

        $content .= '</table>


      ';

        $dataExport[] = array('html' => $content, 'border' => true, 'auto' => true);

        $this->exportpdf->exportFhtml($dataExport);
    }

    public function Convert($amount_number)
    {
        $amount_number = number_format($amount_number, 2, '.', '');
        $pt = strpos($amount_number, '.');
        $number = $fraction = '';
        if ($pt === false) {
            $number = $amount_number;
        } else {
            $number = substr($amount_number, 0, $pt);
            $fraction = substr($amount_number, $pt + 1);
        }

        $ret = '';
        $baht = $this->ReadNumber($number);
        if ($baht != '') {
            $ret .= $baht.'บาท';
        }

        $satang = $this->ReadNumber($fraction);
        if ($satang != '') {
            $ret .= $satang.'สตางค์';
        } else {
            $ret .= '';
        }

        return $ret;
    }

    public function ReadNumber($number)
    {
        $position_call = array('แสน', 'หมื่น', 'พัน', 'ร้อย', 'สิบ', '');
        $number_call = array('', 'หนึ่ง', 'สอง', 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด', 'แปด', 'เก้า');
        $number = $number + 0;
        $ret = '';
        if ($number == 0) {
            return $ret;
        }

        if ($number > 1000000) {
            $ret .= $this->ReadNumber(intval($number / 1000000)).'ล้าน';
            $number = intval(fmod($number, 1000000));
        }

        $divider = 100000;
        $pos = 0;
        while ($number > 0) {
            $d = intval($number / $divider);
            $ret .= (($divider == 10) && ($d == 2)) ? 'ยี่' :
            ((($divider == 10) && ($d == 1)) ? '' :
                ((($divider == 1) && ($d == 1) && ($ret != '')) ? 'เอ็ด' : $number_call[$d]));
            $ret .= ($d ? $position_call[$pos] : '');
            $number = $number % $divider;
            $divider = $divider / 10;
            ++$pos;
        }

        return $ret;
    }
}
