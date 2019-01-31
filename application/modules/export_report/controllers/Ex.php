<?php
define('WP_DEBUG_DISPLAY', false);
@ini_set('display_errors', 0);
class export_report extends My_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->excel = ($this->input->get('type') == "pdf") ? false : true;
        $this->load->library('ExportExcel');
        $this->load->library('ExportPdf');
        $this->load->model('report/Report_model');

    }

    public function report_yeartoyear()
    {
        $data = array();
        $this->load->model('project_training/project_model');
        $data['project'] = $this->project_model->getProject();
        $prj = array();
        foreach ($data['project'] as $key => $value) {
            $prj[$value->project_id] = $value;
        }

        $project = $this->Report_model->getTreeYeartoYear($prj);

        $content = "<table cellspacing='0' cellpadding='0' width='100%'>
                    <tr><td COLSPAN='4'  ALIGN='center'> รายงานเปรียบเทียบ ยุทธศาสตร์ปี " . ($this->session->userdata('year') + 543 - 1) . " - " . ($this->session->userdata('year') + 543) . "</td></tr>
                    <tr><td COLSPAN='4'  ALIGN='center'> ข้อมูล ณ วันที่ " . $this->mydate->date_eng2thai(date('Y-m-d'), 543, 'S') . "</td></tr>
                  </table>";

        $dataExport[] = array('html' => $content, 'border' => true, 'auto' => true);

        $content = '<table cellspacing="0" cellpadding="0" width="100%" border=1>
                      <thead>
                        <tr>
                          <th rowspan="2">แผนงาน</th>
                          <th colspan="4">ประมาณการงบประมาณ</th>
                        </tr>
                        <tr>
                          <th width="10%">ปี ' . ($this->session->userdata('year') + 543 - 1) . '</th>
                          <th width="10%">ปี ' . ($this->session->userdata('year') + 543) . '</th>
                          <th width="10%">เปลี่ยนแปลง </th>
                          <th width="10%">ยอดต่าง (%) </th>
                        </tr>
                      </thead>' . $project . '
                  </table>
                </div>';

        $dataExport[] = array('html' => $content, 'border' => true, 'auto' => true);

        // echo '<pre>';
        // print_r($dataExport);

        if ($this->excel) {
            $this->exportexcel->exportFhtml($dataExport, 'รายงานเปรียบเทียบ ยุทธศาสตร์ปี.xls');
        } else {
            $this->exportpdf->exportFhtml($dataExport);
        }
    }

    public function report_rec_sum()
    {
        $getrec = $this->Report_model->getrec();

        foreach ($getrec[0] as $key => $title) {
            foreach ($getrec[$title->tax_id] as $key => $title2) {
                @$sum[$title->tax_id]->tax_estimate += $title2->tax_estimate;
                @$sum[$title->tax_id]->receive_amount += $title2->receive_amount;
            }
        }

        $content = '<table cellspacing="0" cellpadding="0" width="100%" border=1>
                      <thead>
                        <tr>
                          <th style="width:40%">รายการ</th>
                          <th style="width:20%">ประมานการรายรับ</th>
                          <th style="width:20%">รายรับจริง</th>
                          <th style="width:20%">+สูง -ต่ำ</th>
                        </tr>
                      </thead>
                      <tbody>';

        $sum1 = $sum2 = 0;
        foreach ($getrec[0] as $key => $title) {
            $diff = $sum[$title->tax_id]->receive_amount - $sum[$title->tax_id]->tax_estimate;
            $color = '';
            if ($diff < 0) {
                $color = 'style="color: red;"';
            }

            $sum1 += $sum[$title->tax_id]->tax_estimate;
            $sum2 += $sum[$title->tax_id]->receive_amount;

            $content .= '<tr>
                            <td style="font-weight:bolder;">' . $title->tax_name . '</td>
                            <td style="font-weight:bolder;text-align:right">' . number_format(@$sum[$title->tax_id]->tax_estimate, 2) . '</td>
                            <td style="font-weight:bolder;text-align:right">' . number_format(@$sum[$title->tax_id]->receive_amount, 2) . '</td>
                            <td style="font-weight:bolder;text-align:right"><span ' . $color . '>' . number_format($diff, 2) . '</span></td>
                          </tr>';
        }
        $diff = $sum2 - $sum1;
        if ($diff < 0) {
            $color = 'style="color: red;"';
        }
        $content .= '</tbody>
                    <tfoot>
                      <tr>
                        <td align="center">รวม</td>
                        <td align="right">' . number_format($sum1, 2) . '</td>
                        <td align="right">' . number_format($sum2, 2) . '</td>
                        <td align="right"><span ' . $color . '>' . number_format($diff, 2) . '</span></td>
                      </tr>
                    </tfoot>
                </table>';

        $dataExport[] = array('html' => $content, 'border' => true, 'auto' => true);

        if ($this->excel) {
            $this->exportexcel->exportFhtml($dataExport, 'รายงานบัญชีรายรับ.xls');
        } else {
            $this->exportpdf->exportFhtml($dataExport);
        }
    }

    public function report_rec()
    {
        $getrec = $this->Report_model->getrec();

        foreach ($getrec[0] as $key => $title) {
            foreach ($getrec[$title->tax_id] as $key => $title2) {
                @$sum[$title->tax_id]->tax_estimate += $title2->tax_estimate;
                @$sum[$title->tax_id]->receive_amount += $title2->receive_amount;
            }
        }

        $content = '<table cellspacing="0" cellpadding="0" width="100%" border=1>
                      <thead>
                        <tr>
                          <th style="width:40%">รายการ</th>
                          <th style="width:20%">ประมานการรายรับ</th>
                          <th style="width:20%">รายรับจริง</th>
                          <th style="width:20%">+สูง -ต่ำ</th>
                        </tr>
                      </thead>
                      <tbody>';

        $sum1 = $sum2 = 0;
        foreach ($getrec[0] as $key => $title) {
            $diff = $sum[$title->tax_id]->receive_amount - $sum[$title->tax_id]->tax_estimate;
            $color = '';
            if ($diff < 0) {
                $color = 'color: red;';
            }

            $sum1 = $sum[$title->tax_id]->tax_estimate;
            $sum2 = $sum[$title->tax_id]->receive_amount;

            $content .= '<tr>
                            <td style="font-weight:bolder;">' . $title->tax_name . '</td>
                            <td style="font-weight:bolder;text-align:right">' . number_format(@$sum[$title->tax_id]->tax_estimate, 2) . '</td>
                            <td style="font-weight:bolder;text-align:right">' . number_format(@$sum[$title->tax_id]->receive_amount, 2) . '</td>
                            <td style="font-weight:bolder;text-align:right;' . $color . '">' . number_format($diff, 2) . '</td>
                          </tr>';

            foreach (@$getrec[$title->tax_id] as $key => $title2) {
                $diff = @$title2->receive_amount-@$title2->tax_estimate;
                $color = '';
                if ($diff < 0) {
                    $color = 'color: red;';
                }

                $content .= '<tr>
                             <td style="padding-left: 10px;">' . $title2->tax_name . '</td>
                             <td style="text-align:right">' . number_format(@$title2->tax_estimate, 2) . '</td>
                             <td style="text-align:right">' . number_format(@$title2->receive_amount, 2) . '</td>
                             <td style="text-align:right; ' . $color . '">' . number_format($diff, 2) . '</td>
                             </tr>';
            }

        }
        $diff = $sum2 - $sum1;
        if ($diff < 0) {
            $color = 'color: red;';
        }

        $content .= '</tbody>
                    <tfoot>
                      <tr>
                        <td align="center">รวม</td>
                        <td align="right">' . number_format($sum1, 2) . '</td>
                        <td align="right">' . number_format($sum2, 2) . '</td>
                        <td align="right" style="' . $color . '">' . number_format($diff, 2) . '</td>
                      </tr>
                    </tfoot>
                </table>';

        $dataExport[] = array('html' => $content, 'border' => true, 'auto' => true);

        // echo '<pre>';
        // print_r($dataExport);

        if ($this->excel) {
            $this->exportexcel->exportFhtml($dataExport, 'รายงานบัญชีรายรับ.xls');
        } else {
            $this->exportpdf->exportFhtml($dataExport);
        }
    }

    public function report_projectManage()
    {
        $data = array();
        $this->load->model('project_training/project_model');
        $data['project'] = $this->project_model->getProject();
        $prj = array();
        foreach ($data['project'] as $key => $value) {
            $prj[$value->project_id] = $value;
        }

        // var_dump($prj[0]);die();
        $post = $this->input->get();
        if (!empty($post)) {
            $this->Report_model->filter_date1 = $this->mydate->date_thai2eng($post['filter_date1'], -543);
            $this->Report_model->filter_date2 = $this->mydate->date_thai2eng($post['filter_date2'], -543);

            $data['filter_date1'] = $this->Report_model->filter_date1;
            $data['filter_date2'] = $this->Report_model->filter_date2;
        }

        $project = $this->Report_model->getTreeProjectManage($prj);

        $content = "<table cellspacing='0' cellpadding='0' width='100%'>
                    <tr><td COLSPAN='7'  ALIGN='center'> สรุปการใช้จ่ายเงินงบประมาณปี " . ($this->session->userdata('year') + 543) . "</td></tr>
                    <tr><td COLSPAN='7'  ALIGN='center'> ข้อมูล ณ วันที่ " . $this->mydate->date_eng2thai(date('Y-m-d'), 543, 'S') . "</td></tr>
                  </table>";

        $dataExport[] = array('html' => $content, 'border' => true, 'auto' => true);

        $content = '<table cellspacing="0" cellpadding="0" width="100%" border=1>
                      <thead>
                        <tr>
                          <th>แผนงาน</th>
                          <th width="8%">ตั้งไว้</th>
                          <th width="8%">โอนลด</th>
                          <th width="8%">โอนเพิ่ม</th>
                          <th width="8%">รวมถือจ่าย</th>
                          <th width="8%">ใช้ไป</th>
                          <th width="8%">คงเหลือ</th>
                        </tr>
                      </thead>' . $project . '
                  </table>';

        $dataExport[] = array('html' => $content, 'border' => true, 'auto' => true);

        // echo '<pre>';
        // print_r($dataExport);

        if ($this->excel) {
            $this->exportexcel->exportFhtml($dataExport, 'รายงานบัญชีรายจ่าย.xls');
        } else {
            $this->exportpdf->exportFhtml($dataExport);
        }
    }

    public function report_debt()
    {
        $data = array();
        $year = $this->session->userdata('year');
        $taxDebt = $this->Report_model->getTaxDebt($year);
        $person = $this->Report_model->getPersonDebt($year);

        $content = "<table cellspacing='0' cellpadding='0' width='100%'>
                    <tr><td COLSPAN='7'  ALIGN='center'> รายงานลูกหนี้ค้างชำระ </td></tr>
                    <tr><td COLSPAN='7'  ALIGN='center'> ข้อมูล ณ วันที่ " . $this->mydate->date_eng2thai(date('Y-m-d'), 543, 'S') . "</td></tr>
                  </table>";

        $dataExport[] = array('html' => $content, 'border' => true, 'auto' => true);

        $content = '<table cellspacing="0" cellpadding="0" width="100%" border=1>
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
                        <tbody>';
        $int = 1;
        $sum1 = $sum2 = $sum3 = $sum4 = $sum5 = $sum6 = 0;
        foreach ($person as $key => $value) {
            if ((@$value[8]['notice_estimate']-@$value[8]['receive_amount']) + (@$value[9]['notice_estimate']-@$value[9]['receive_amount']) + (@$value[10]['notice_estimate']-@$value[10]['receive_amount'])+@$value[8]['interest']+@$value[9]['interest']+@$value[10]['interest'] > 0) {
                $sum1 += (@$value[8]['notice_estimate']-@$value[8]['receive_amount']);
                $sum2 += (@$value[8]['interest']);

                $sum3 += (@$value[9]['notice_estimate']-@$value[9]['receive_amount']);
                $sum4 += (@$value[9]['interest']);

                $sum5 += (@$value[10]['notice_estimate']-@$value[10]['receive_amount']);
                $sum6 += (@$value[10]['interest']);

                $content .= '<tr>
                                <td align="center">' . $int++ . '</td>
                                <td align="center">' . $value['idcard'] . '</td>
                                <td>' . $value['name'] . '</td>
                                <td align="right">' . number_format(@$value[8]['notice_estimate']-@$value[8]['receive_amount'], 2) . '</td>
                                <td align="right">' . number_format(@$value[8]['interest'], 2) . '</td>
                                <td align="right">' . number_format(@$value[9]['notice_estimate']-@$value[9]['receive_amount'], 2) . '</td>
                                <td align="right">' . number_format(@$value[9]['interest'], 2) . '</td>
                                <td align="right">' . number_format(@$value[10]['notice_estimate']-@$value[10]['receive_amount'], 2) . '</td>
                                <td align="right">' . number_format(@$value[10]['interest'], 2) . '</td>
                                <td align="right">' . number_format((@$value[8]['notice_estimate']-@$value[8]['receive_amount']) + (@$value[9]['notice_estimate']-@$value[9]['receive_amount']) + (@$value[10]['notice_estimate']-@$value[10]['receive_amount'])+@$value[8]['interest']+@$value[9]['interest']+@$value[10]['interest'], 2) . '</td>
                            </tr>';
            }
        }
        $content .= '</tbody>
                        <tfoot>
                          <tr>
                            <td align="center" colspan="3">รวม</td>
                            <td align="right">' . number_format($sum1, 2) . '</td>
                            <td align="right">' . number_format($sum2, 2) . '</td>
                            <td align="right">' . number_format($sum3, 2) . '</td>
                            <td align="right">' . number_format($sum4, 2) . '</td>
                            <td align="right">' . number_format($sum5, 2) . '</td>
                            <td align="right">' . number_format($sum6, 2) . '</td>
                            <td align="right">' . number_format($sum1 + $sum2 + $sum3 + $sum4 + $sum5 + $sum6, 2) . '</td>
                          </tr>
                        </tfoot>
                  </table>';

        $dataExport[] = array('html' => $content, 'border' => true, 'auto' => true);

        // echo '<pre>';
        // print_r($dataExport);

        if ($this->excel) {
            $this->exportexcel->exportFhtml($dataExport, 'รายงานลูกหนี้ค้างชำระ.xls');
        } else {
            $this->exportpdf->exportFhtml($dataExport);
        }

    }

    public function report_person_receive()
    {
        $data = array();
        $post = $this->input->get();
        if (!empty($post)) {
            $this->Report_model->filter_date1 = $this->mydate->date_thai2eng($post['filter_date1'], -543);
            $this->Report_model->filter_date2 = $this->mydate->date_thai2eng($post['filter_date2'], -543);

            $data['filter_date1'] = $this->Report_model->filter_date1;
            $data['filter_date2'] = $this->Report_model->filter_date2;

            $data['tax_type'] = $post['tax_type'];
        }

        $content = "<table cellspacing='0' cellpadding='0' width='100%'>
                    <tr><td COLSPAN='7'  ALIGN='center'> รายงานรับชำระภาษี </td></tr>
                    <tr><td COLSPAN='7'  ALIGN='center'> ข้อมูล ณ วันที่ " . $this->mydate->date_eng2thai(date('Y-m-d'), 543, 'S') . "</td></tr>
                  </table>";

        $dataExport[] = array('html' => $content, 'border' => true, 'auto' => true);

        $person = $this->Report_model->getPersonReceive(@$data['tax_type']);

        $content = '<table cellspacing="0" cellpadding="0" width="100%" border=1>
                        <thead>
                          <tr>
                              <th >ลำดับ</th>
                              <th >เลขประจำตัวผู้เสียภาษี</th>
                              <th >ชื่อ - สกุล</th>
                              <th >เลขรับ</th>
                              <th >จำนวนที่จ่าย</th>
                              <th >ภาษี</th>
                              <th>เล่มที่/เลขที่ ใบเสร็จ</th>
                              <th>วันที่ชำระ</th>
                          </tr>
                        </thead>
                        <tbody>';
        $int = 1;
        foreach ($person as $key => $value) {
            $content .= '<tr>
                            <td>' . $int++ . '</td>
                            <td>' . $value->individual_number . '</td>
                            <td>' . $value->individual_prename . $value->individual_fullname . '</td>
                            <td>' . $value->notice_number . '</td>
                            <td align="right">' . number_format($value->receive_amount, 2) . '</td>
                            <td>' . $value->tax_name . '</td>
                            <td>' . $value->receipt_no . '/' . $value->receipt_number . '</td>
                            <td>' . $this->mydate->date_eng2thai($value->receive_date, 543, 'S') . '</td>
                          </tr>';
        }
        $content .= '</tbody>
                        <tfoot>
                        </tfoot>
                  </table>';

        $dataExport[] = array('html' => $content, 'border' => true, 'auto' => true);

        // echo '<pre>';
        // print_r($dataExport);

        if ($this->excel) {
            $this->exportexcel->exportFhtml($dataExport, 'รายงาน.xls');
        } else {
            $this->exportpdf->exportFhtml($dataExport);
        }
    }

    public function report_person($id)
    {
        $data = array();
        $data = $this->Report_model->getPersonTax($id);

        $content = "<table cellspacing='0' cellpadding='0' width='100%'>
                    <tr>
                        <td width='5%'></td>
                        <td COLSPAN='14'  ALIGN='center'> ทะเบียนคุมผู้ชำระภาษี</td>
                        <td width='5%' ALIGN='right'> ผ.ท. 5</td></tr>
                  </table>";

        $dataExport[] = array('html' => $content, 'border' => true, 'auto' => true);

        $content = "<table cellspacing='0' cellpadding='0' width='100%'>
                    <tr>
                        <td width='30%'>ชื่อ - สกุล : ผู้เสียภาษี " . $data['person']['name'] . "</td>
                        <td width='40%'> เลขที่ประจำตัวประชาชน/เลขประจำผู้เสียภาษี " . $data['person']['idcard'] . "</td>
                        <td width='30%'> รหัสชื่อ " . $data['person']['code_name'] . "</td>
                    </tr>
                  </table>";

        $dataExport[] = array('html' => $content, 'border' => true, 'auto' => true);

        $content = "<table cellspacing='0' cellpadding='0' width='100%'>
                    <tr>
                        <td width='70%'>ที่อยู่ : บ้านเลขที่ " . $data['person']['address'] . " หมู่ที่ " . $data['person']['village'] . " ตำบล หนองป่าคลั่ง อำเภอ เมือง จังหวัด เชียงใหม่</td>
                        <td width='30%'> ชื่อนิติบุคคล</td>
                    </tr>
                  </table>";

        $dataExport[] = array('html' => $content, 'border' => true, 'auto' => true);

        $content = "<table cellspacing='0' cellpadding='0' width='100%'>
                    <tr>
                        <td width='20%'></td>
                        <td width='30%' > โทร. " . $data['person']['phone'] . " </td>
                        <td width='30%' > Fax. " . $data['person']['fax'] . " </td>
                        <td width='20%'></td>
                    </tr>
                  </table>";

        $dataExport[] = array('html' => $content, 'border' => true, 'auto' => true);

        $content = '<table cellspacing="0" cellpadding="0" width="100%" border=1>
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
                        <tbody>';

        for ($i = 1; $i <= $data['count_rec']; $i++) {
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
                    $tax_year8 = '/' . substr($tax_year8, 2, 2);
                }

                if (!empty($data['tax'][9][$i]['notice_estimate']['tax_year'])) {
                    $tax_year9 = $data['tax'][9][$i]['notice_estimate']['year'] + 543;
                    $tax_year9 = '/' . substr($tax_year9, 2, 2);
                }

                $content .= '<tr>
                            <td>' . $year . '</td>
                            <td>' . @$data['tax'][8][$i]['notice_estimate']['notice_number_p2'] . $tax_year8 . '</td>
                            <td>' . $this->mydate->date_eng2thai(@$data['tax'][8][$i]['notice_estimate']['notice_date_p2'], 543, 'S') . '</td>
                            <td>' . number_format(@$data['tax'][8][$i]['notice_estimate']['notice_annual_fee'], 2) . '</td>

                            <td>' . @$data['tax'][8][$i]['notice_estimate']['notice_no'] . '/' . @$data['tax'][8][$i]['notice_estimate']['notice_number'] . '</td>
                            <td>' . $this->mydate->date_eng2thai(@$data['tax'][8][$i]['notice_estimate']['notice_date'], 543, 'S') . '</td>
                            <td>' . number_format(@$data['tax'][8][$i]['notice_estimate']['notice_estimate'], 2) . '</td>

                            <td>' . @$data['tax'][8][$i]['tax_receive']['receipt_number'] . '</td>
                            <td>' . $this->mydate->date_eng2thai(@$data['tax'][8][$i]['tax_receive']['receive_date'], 543, 'S') . '</td>
                            <td>' . number_format(@$data['tax'][8][$i]['tax_receive']['receive_amount'], 2) . '</td>

                            <td>' . @$data['tax'][9][$i]['notice_estimate']['notice_number'] . '</td>
                            <td>' . $this->mydate->date_eng2thai(@$data['tax'][9][$i]['notice_estimate']['notice_date'], 543, 'S') . '</td>
                            <td>' . number_format(@$data['tax'][9][$i]['notice_estimate']['notice_estimate'], 2) . '</td>

                            <td>' . @$data['tax'][9][$i]['tax_receive']['receipt_number'] . '</td>
                            <td>' . $this->mydate->date_eng2thai(@$data['tax'][9][$i]['tax_receive']['receive_date'], 543, 'S') . '</td>
                            <td>' . number_format(@$data['tax'][9][$i]['tax_receive']['receive_amount'], 2) . '</td>

                          </tr>';
            }
        }

        $content .= '
                        <tr>
                          <td>&nbsp;</td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                        </tbody>
                  </table><pagebreak />';

        $dataExport[] = array('html' => $content, 'border' => true, 'auto' => true);

        $content = "<table cellspacing='0' cellpadding='0' width='100%'>
                    <tr>
                        <td width='5%'></td>
                        <td COLSPAN='14'  ALIGN='center'> </td>
                        <td width='5%' ALIGN='right'> ผ.ท. 5</td></tr>
                  </table>";

        $dataExport[] = array('html' => $content, 'border' => true, 'auto' => true);

        $content = '<table cellspacing="0" cellpadding="0" width="100%" border=1>
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
                        <tbody>';

        for ($i = 1; $i <= $data['count_rec']; $i++) {
            if (!empty($data['tax'][10][$i]['notice_estimate']['year'])) {
                $tax_year10 = '';
                if (!empty($data['tax'][10][$i]['notice_estimate']['tax_year'])) {
                    $tax_year10 = $data['tax'][10][$i]['notice_estimate']['year'] + 543;
                    $tax_year10 = '/' . substr($tax_year10, 2, 2);
                }

                $content .= '<tr>
                            <td>' . (@$data['tax'][10][$i]['notice_estimate']['year'] + 543) . '</td>
                            <td>' . @$data['tax'][10][$i]['notice_estimate']['notice_number'] . $tax_year10 . '</td>
                            <td>' . $this->mydate->date_eng2thai(@$data['tax'][10][$i]['notice_estimate']['notice_date'], 543, 'S') . '</td>
                            <td>' . number_format(@$data['tax'][10][$i]['notice_estimate']['notice_estimate'], 2) . '</td>

                            <td>' . @$data['tax'][10][$i]['tax_receive']['receipt_number'] . '</td>
                            <td>' . $this->mydate->date_eng2thai(@$data['tax'][10][$i]['tax_receive']['receive_date'], 543, 'S') . '</td>
                            <td>' . number_format(@$data['tax'][10][$i]['tax_receive']['receive_amount'], 2) . '</td>

                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr>';
            }
        }

        $content .= '
                        <tr>
                          <td>&nbsp;</td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                    </tbody>
                  </table>';

        $dataExport[] = array('html' => $content, 'border' => true, 'auto' => true);

        // echo '<pre>';
        // print_r($dataExport);

        if ($this->excel) {
            $this->exportexcel->exportFhtml($dataExport, 'รายงาน.xls');
        } else {
            $this->exportpdf->exportFhtml($dataExport, 'A4-L');
        }

    }

    public function report_month()
    {
        $year = $this->session->userdata('year');
        $data = $this->Report_model->getPayMonth($year);
        $monthname = array(10 => "ตุลาคม", 11 => "พฤศจิกายน", 12 => "ธันวาคม", 1 => "มกราคม", 2 => "กุมภาพันธ์", 3 => "มีนาคม", 4 => "เมษายน", 5 => "พฤษภาคม", 6 => "มิถุนายน", 7 => "กรกฎาคม", 8 => "สิงหาคม", 9 => "กันยายน");

        $content = "<table cellspacing='0' cellpadding='0' width='100%'>
                    <tr>
                        <td width='100%' align='center'>รายงานค่าใช้จ่ายจำแนกรายเดือน ปีงบประมาณ " . ($this->session->userdata('year') + 543) . "</td>
                      <tr>
                      <tr>
                        <td width='100%' align='center'>ข้อมูล ณ วันที่ " . $this->mydate->date_eng2thai(date('Y-m-d'), 543, 'S') . "</td>
                      </tr>
                  </table>";

        $dataExport[] = array('html' => $content, 'border' => true, 'auto' => true);

        $content = '<table cellspacing="0" cellpadding="0" width="100%" border=1>
                    <thead>
                      <tr>
                        <th>เดือน</th>
                        <th width="30%">ค่าใช้จ่าย</th>
                      </tr>
                    </thead>
                    <tbody>';
        $sum = 0;
        foreach ($monthname as $key => $value) {
            $sum += @$data[$key];
            $content .= '<tr>
                        <td>' . $value . '</td>
                        <td align="right">' . number_format(@$data[$key], 2) . '</td>
                      </tr>';
        }
        $content .= '</tbody>
                    <tfoot>
                      <tr>
                        <td align="center">รวม</td>
                        <td align="right">' . number_format($sum, 2) . '</td>
                      </tr>
                    </tfoot>
                  </table>';

        $dataExport[] = array('html' => $content, 'border' => true, 'auto' => true);

        // echo '<pre>';
        // print_r($dataExport);

        if ($this->excel) {
            $this->exportexcel->exportFhtml($dataExport, 'รายงาน.xls');
        } else {
            $this->exportpdf->exportFhtml($dataExport);
        }
    }

    public function usereEsimate()
    {
        $this->load->model('receive/Receive_model');
        $data = $this->Receive_model->read_dashborad();
        // print_r($data);die();

        $content = "<table cellspacing='0' cellpadding='0' width='100%'>
            <tr><td COLSPAN='7'  ALIGN='center'> รายงานการประเมินภาษี </td></tr>
            <tr><td COLSPAN='7'  ALIGN='center'> ข้อมูล ณ วันที่ " . $this->mydate->date_eng2thai(date('Y-m-d'), 543, 'S') . "</td></tr>
        </table>";

        $content .= ' <table cellspacing="0" cellpadding="0" border="1" style="width:100%">
            <thead>
              <tr>
                <th >ลำดับ</th>
                <th>เลขที่รับ/ปี</th>
                <th >เลขประจำตัวผู้เสียภาษี</th>
                <th >ชื่อผู้เสียภาษี</th>
                <th>หมวดรายได้</th>
                <th >จำนวนเงินภาษี (บาท)</th>
                <th>เงินเพิ่ม (บาท)</th>
                <th>คงเหลือ (บาท)</th>
              </tr>
            </thead>
            <tbody>';
        foreach ($data as $key => $value) {
            $content .= '
            <tr>
              <td>' . ($key + 1) . '</td>
              <td>' . $value['notice_number'] . '/' . ($value['year_id'] + 543) . '</td>
              <td>' . $value['individual_number'] . '</td>
              <td>' . $value['individual_fullname'] . '</td>
              <td>' . $value['tax_name'] . '</td>
              <td>' . number_format($value['sum(notice_estimate)'], 2) . '</td>
              <td>' . number_format($value['sum(notice_estimate)'], 2) . '</td>
              <td>' . number_format($value['sum(notice_estimate)'], 2) . '</td>
            </tr>';
        }

        $content .= '  </tbody>
                    </table>';

        $dataExport[] = array('html' => $content, 'border' => true, 'auto' => true);
        if ($this->excel) {
            $this->exportexcel->exportFhtml($dataExport, 'รายงานผู้ประเมิน.xls');
        } else {
            $this->exportpdf->exportFhtml($dataExport);
        }
    }
}
