<?php

class Report_model extends CI_Model
{
    public $_dataTax;
    protected $data_budget = ['', 'งบบุคลากร', 'งบดำเนินงาน', 'งบลงทุน', 'งบเงินอุดหนุน', 'งบกลาง'];
    protected $data_cost = [
        '', 'เงินเดือน (ฝ่ายการเมือง)', 'เงินเดือน (ฝ่ายประจำ)', 'ค่าตอบแทน', 'ค่าใช้สอย', 'ค่าวัสดุ', 'ค่าสาธารณูปโภค',
        'ค่าครุภัณฑ์', 'ค่าที่ดินและสิ่งก่อสร้าง', 'เงินอุดหนุน', 'งบกลาง',
    ];

    public $filter_date1;
    public $filter_date2;

    public function getReport_rec_All()
    {
        $query = $this->db->get('tax_receive');

        return $query->result();
    }

    public function getTaxDebt($year)
    {
        $data = array();
        $this->db->select('tbl_tax.*,
                           tax_notice.*,
                           SUM(notice_estimate) AS notice_estimate,
                           SUM(tax_interest) AS tax_interest');
        $this->db->from('tbl_tax');
        $this->db->JOIN('tax_notice', 'tbl_tax.tax_id= tax_notice.tax_id', 'left');
        $this->db->where('tax_notice.year_id', $year);
        $this->db->where('tax_notice.status = ', 'active');

        $this->db->GROUP_BY('tbl_tax.tax_id');

        $query = $this->db->get();

        foreach ($query->result() as $key => $value) {
            // echo("<pre>");
            // print_r($value);
            // echo("</pre>");
            @$data[$value->tax_id]->tax_name = $value->tax_name;
            @$data[$value->tax_id]->notice_estimate = $value->notice_estimate;
            @$data[$value->tax_id]->interest = $value->tax_interest;
        }

        $this->db->select('tbl_tax.*,
                           SUM(receive_amount) AS receive_amount,
                           SUM(interest) as interest');
        $this->db->from('tbl_tax');
        $this->db->JOIN('tax_notice', 'tbl_tax.tax_id= tax_notice.tax_id');
        $this->db->JOIN('tax_receive', 'tax_notice.notice_id= tax_receive.notice_id');
        $this->db->where('tbl_tax.tax_parent_id', 1);
        $this->db->where('tax_notice.year_id', $year);
        $this->db->where('tax_notice.status = ', 'active');

        $this->db->GROUP_BY('tbl_tax.tax_id');

        $query = $this->db->get();
        foreach ($query->result() as $key => $value) {
            @$data[$value->tax_id]->receive_amount = $value->receive_amount;
            if ($value->interest) {
                @$data[$value->tax_id]->interest = $value->interest;
            }
        }

        return $data;
    }

    public function getPersonDebt($year)
    {
        $data = array();
        $this->db->select('tbl_tax.*, tbl_individual.*,
                            SUM(notice_estimate) AS notice_estimate,
                            SUM(tax_interest) AS tax_interest');
        $this->db->from('tbl_tax');
        $this->db->JOIN('tax_notice', 'tbl_tax.tax_id= tax_notice.tax_id');
        $this->db->join('tbl_individual', 'tbl_individual.individual_id = tax_notice.individual_id', 'left');
        $this->db->where('tbl_tax.tax_parent_id', 1);
        $this->db->where('tax_notice.year_id', $year);
        $this->db->where('tax_notice.status = ', 'active');

        $this->db->GROUP_BY('tbl_individual.individual_id,tbl_tax.tax_id');
        // $this->db->having('notice_estimate > receive_amount');
        $query = $this->db->get();
        foreach ($query->result() as $key => $value) {
            @$data[$value->individual_id]['name'] = $value->individual_firstname.' '.$value->individual_lastname;
            @$data[$value->individual_id]['idcard'] = $value->individual_number;

            @$data[$value->individual_id][$value->tax_id]['notice_estimate'] = $value->notice_estimate;
            @$data[$value->individual_id][$value->tax_id]['interest'] = $value->tax_interest;
        }

        $this->db->select('tbl_tax.*, tax_receive.individual_id,
                            SUM(receive_amount) AS receive_amount,
                            SUM(interest) as interest');
        $this->db->from('tbl_tax');
        $this->db->JOIN('tax_receive', 'tbl_tax.tax_id= tax_receive.tax_id', 'left');
        $this->db->where('tbl_tax.tax_parent_id', 1);
        $this->db->where('tax_receive.year_id', $year);
        $this->db->GROUP_BY('tax_receive.individual_id,tbl_tax.tax_id');
        // $this->db->having('notice_estimate > receive_amount');
        $query = $this->db->get();
        foreach ($query->result() as $key => $value) {
            @$data[$value->individual_id][$value->tax_id]['receive_amount'] = $value->receive_amount;
            if ($value->interest) {
                @$data[$value->individual_id][$value->tax_id]['interest'] = $value->interest;
            }
        }

        return $data;
    }

    /*




    (
            SELECT	SUM(receive_amount)	FROM	`tax_receive`
            LEFT JOIN `tax_notice` ON `tax_receive`.`notice_id` = `tax_notice`.`notice_id`
            WHERE		`tax_receive`.tax_id = `tbl_tax`.`tax_id` AND `tax_receive`.`year_id` = '$year'  AND `tax_notice`.`status` = 'Active'
        )AS receive_amount,

    */

    public function getrec($parent = 0)
    {
        $year = $this->session->userdata('year');
        $this->db->select("tbl_tax.*,tax_notice.status,

        (   SELECT SUM(tr2.receive_amount) FROM `tax_receive` as tr2 WHERE  tr2.tax_id = `tbl_tax`.`tax_id` AND `tr2`.`year_id` = '$year'
     )
    AS receive_amount,
        SUM(tbl_tax_estimate.tax_estimate) as tax_estimate");
        $this->db->from('tbl_tax');
        //$this->db->join('tax_receive', "tbl_tax.tax_id= tax_receive.tax_id and tax_receive.year_id = '{$year}'", 'left');
        $this->db->join('tbl_tax_estimate', "tbl_tax_estimate.tax_id = tbl_tax.tax_id and tbl_tax_estimate.year_id = '{$year}' ", 'left');
        $this->db->JOIN('tax_notice', 'tbl_tax.tax_id= tax_notice.tax_id', 'left');
        $this->db->where('tax_parent_id', $parent);
        $this->db->where('tbl_tax.tax_id != ', '1');

        $this->db->GROUP_BY('tbl_tax.tax_id');
        $query = $this->db->get();
        //echo $this->db->last_query();
        // echo '<hr>';

        foreach ($query->result() as $key => $value) {
            @$this->_dataTax[$value->tax_parent_id][$value->tax_id] = $value;
            $this->getrec($value->tax_id);
            // echo "<pre>";
            // print_r($value);
            // echo "</pre>";
        }

        return $this->_dataTax;
    }

    public function getTax1($parent = 0)
    {
        $year = $this->session->userdata('year');
        $this->db->select('tbl_tax.*,tbl_tax_estimate.tax_estimate');
        $this->db->from('tbl_tax');
        $this->db->join('tbl_tax_estimate', "tbl_tax_estimate.tax_id = tbl_tax.tax_id and tbl_tax_estimate.year_id = '{$year}' ", 'left');
        $this->db->where('tax_parent_id', $parent);
        $query = $this->db->get();
        foreach ($query->result() as $key => $value) {
            @$this->_dataTax[$value->tax_parent_id][$value->tax_id] = $value;

            $this->getTax1($value->tax_id);
        }

        return $this->_dataTax;
    }

    public function getPersonTax($id)
    {
        $data = array();
        $year = $this->session->userdata('year');
        $this->db->select('tbl_tax.*,
                            tbl_individual.*,
                            tax_notice.*');
        $this->db->from('tbl_individual');
        // $this->db->join('tax_receive','tax_notice.notice_id= tax_receive.notice_id','left');
        $this->db->join('tax_notice', 'tbl_individual.individual_id = tax_notice.individual_id', 'left');
        $this->db->join('tbl_tax', "tbl_tax.tax_id= tax_notice.tax_id AND tbl_tax.tax_parent_id = 1 AND tax_notice.year_id = {$year}", 'left');
        //$this->db->join('tbl_tax', "tbl_tax.tax_id= tax_notice.tax_id AND tbl_tax.tax_parent_id = 1 AND tax_notice.tax_year = {$year}", 'left');
        // $this->db->where('tbl_tax.tax_parent_id',1);
        $this->db->where('tbl_individual.individual_id', $id);
        $this->db->where('tax_notice.year_id', $year);
        $this->db->where('tax_notice.status', 'active');
        // $this->db->GROUP_BY('tbl_individual.individual_id,tbl_tax.tax_id,tax_notice.tax_year,tax_notice.notice_id');
        // $this->db->having('notice_estimate > receive_amount');
        $query = $this->db->get();

        $count_tax1 = $count_tax2 = $count_tax3 = 0;
        foreach ($query->result() as $key => $value) {
            $tax_type = $value->tax_id;
            $this->db->select('receive_date,receipt_number,SUM(tax_receive.receive_amount) as receive_amount');
            $this->db->from('tax_receive');
            // $this->db->where('tax_receive.notice_id', $value->notice_id);
            $this->db->where('tax_receive.individual_id', $value->individual_id);
            $this->db->where('tax_receive.year_id', $year);
            $this->db->where('tax_receive.tax_id', $tax_type);
            // $this->db->where('tax_receive.status', 'active');
            $query_re = $this->db->get();
            //echo $this->db->last_query();
            $row_re = $query_re->row();

            @$data['person']['name'] = $value->individual_firstname.' '.$value->individual_lastname;
            @$data['person']['idcard'] = $value->individual_number;
            @$data['person']['address'] = $value->individual_address;
            @$data['person']['village'] = $value->individual_village;
            @$data['person']['phone'] = $value->individual_phone;
            @$data['person']['fax'] = '';
            @$data['person']['code_name'] = $value->code_name;

            if ($value->tax_id == 8) {
                ++$count_tax1;
                $count_tax = $count_tax1;
            } elseif ($value->tax_id == 9) {
                ++$count_tax2;
                $count_tax = $count_tax2;
            } elseif ($value->tax_id == 10) {
                ++$count_tax3;
                $count_tax = $count_tax3;
            }

            @$data['tax'][$value->tax_id][$count_tax]['notice_estimate']['year'] = $value->year_id;
            @$data['tax'][$value->tax_id][$count_tax]['notice_estimate']['tax_year'] = $value->tax_year;
            @$data['tax'][$value->tax_id][$count_tax]['notice_estimate']['notice_number_p2'] = $value->notice_number_p2;
            @$data['tax'][$value->tax_id][$count_tax]['notice_estimate']['notice_number_p8'] = $value->notice_number_p8;
            @$data['tax'][$value->tax_id][$count_tax]['notice_estimate']['notice_date_p2'] = $value->notice_date_p2;
            @$data['tax'][$value->tax_id][$count_tax]['notice_estimate']['notice_estimate'] = $value->notice_estimate;
            @$data['tax'][$value->tax_id][$count_tax]['notice_estimate']['notice_date'] = $value->notice_date;
            @$data['tax'][$value->tax_id][$count_tax]['notice_estimate']['notice_number'] = $value->notice_number;
            @$data['tax'][$value->tax_id][$count_tax]['notice_estimate']['notice_no'] = $value->notice_no;
            @$data['tax'][$value->tax_id][$count_tax]['notice_estimate']['notice_date_p5'] = $value->notice_date_p5;
            @$data['tax'][$value->tax_id][$count_tax]['notice_estimate']['notice_annual_fee'] = $value->notice_annual_fee;

            @$data['tax'][$value->tax_id][$count_tax]['tax_receive']['receive_date'] = $row_re->receive_date;
            @$data['tax'][$value->tax_id][$count_tax]['tax_receive']['receive_amount'] = $row_re->receive_amount;
            @$data['tax'][$value->tax_id][$count_tax]['tax_receive']['receipt_number'] = $row_re->receipt_number;

            $cc = array($count_tax1, $count_tax2, $count_tax3);
            $cc = max($cc);

            $data['count_rec'] = $cc;
        }

        return $data;
    }

    /// PROJECT ///

    public function getTreeProjectManage($project)
    {
        $ul = '';
        $labels_chart = $datasets1 = $datasets2 = '';
        foreach ($project as $key => $value) {
            if (empty($value->project_parent)) {
                $prj_id_array = $this->getAllPrjID($value->project_id);
                $budget = $this->getSumBudgetPrj($prj_id_array);

                $labels_chart .= $value->project_title.'||';
                $datasets1 .= $budget['prj_budget'].'||';
                $datasets2 .= $budget['expenses_amount'].'||';

                $ul .= '<tbody>';
                $ul .= '<tr><td><b>'.$value->project_title.'</b></td>
                        <td align="right">'.number_format($budget['prj_budget'], 2).'</td>
                        <td align="right">'.number_format($budget['amount_minus'], 2).'</td>
                        <td align="right">'.number_format($budget['amount_plus'], 2).'</td>
                        <td align="right">'.number_format($budget['prj_budget'] + $budget['prj_amount'], 2).'</td>
                        <td align="right">'.number_format($budget['expenses_amount'], 2).'</td>

                        <td align="right">'.number_format($budget['prj_budget'] + $budget['prj_amount'] - $budget['expenses_amount'], 2).'</td>
                        </tr>';
                $ul .= $this->getTreeChildProject($value->project_id);
                $ul .= '</tbody>';
            }
        }

        $ul .= ' <input type="hidden" id="labels_chart" value="'.$labels_chart.'">
                    <input type="hidden" id="datasets1" value="'.$datasets1.'">
                    <input type="hidden" id="datasets2" value="'.$datasets2.'">';

        return $ul;
    }

    public function getTreeChildProject($parent = '0', &$ul = '', $tab = 0)
    {
        //tab data
        ++$tab;
        $padding = $tab * 20;

        $this->db->where('project_parent', $parent);
        $query = $this->db->get('tbl_project_manage');
        foreach ($query->result() as $key => $row) {
            $prj_id_array = $this->getAllPrjID($row->project_id);
            $budget = $this->getSumBudgetPrj($prj_id_array);

            $ul .= '<tr>';
            if (@$row->project_level == 3) {
                $ul .= "<td style='padding-left:".$padding."px'>".$this->data_budget[$row->project_title].'</td>';
            } elseif (@$row->project_level == 4) {
                $ul .= "<td style='padding-left:".$padding."px'>".$this->data_cost[$row->project_title].'</td>';
            } else {
                $ul .= "<td style='padding-left:".$padding."px'>".$row->project_title.'</td>';
            }

            $ul .= "<td align='right'>".number_format($budget['prj_budget'], 2).'</td>';
            $ul .= "<td align='right'>".@number_format($budget['amount_minus'], 2).'</td>';
            $ul .= "<td align='right'>".@number_format($budget['amount_plus'], 2).'</td>';
            $ul .= "<td align='right'>".@number_format($budget['prj_budget'] + $budget['prj_amount'], 2).'</td>';
            $ul .= "<td align='right'>".@number_format($budget['expenses_amount'], 2).'</td>';
            // $ul .= "<td align='right'>-</td>";
            $ul .= "<td align='right'>".@number_format($budget['prj_budget'] + $budget['prj_amount'] - $budget['expenses_amount'], 2).'</td>';
            $ul .= '</tr>';

            $this->getTreeChildTblProject($row->project_id, $ul, $tab);
            $this->getTreeChildProject(@$row->project_id, $ul, $tab);
        }

        return $ul;
    }

    public function getTreeChildTblProject($parent, &$ul = '', $tab = '')
    {
        //tab data
        ++$tab;
        $padding = $tab * 20;

        $this->db->where('prj_parent', $parent);
        $query = $this->db->get('tbl_project');
        foreach ($query->result() as $key => $row) {
            $prj_id_array = $this->getPrjParent($row->prj_id);
            $budget = $this->getSumBudgetPrj($prj_id_array);

            $ul .= '<tr>';
            $ul .= "<td style='padding-left:".$padding."px'>".$row->prj_name.'</td>';
            $ul .= "<td align='right'>".number_format($budget['prj_budget'], 2).'</td>';
            $ul .= "<td align='right'>".@number_format($budget['amount_minus'], 2).'</td>';
            $ul .= "<td align='right'>".@number_format($budget['amount_plus'], 2).'</td>';
            $ul .= "<td align='right'>".@number_format($budget['prj_budget'] + $budget['prj_amount'], 2).'</td>';
            $ul .= "<td align='right'>".@number_format($budget['expenses_amount'], 2).'</td>';
            // $ul .= "<td align='right'>-</td>";
            $ul .= "<td align='right'>".@number_format($budget['prj_budget'] + $budget['prj_amount'] - $budget['expenses_amount'], 2).'</td>';
            $ul .= '</tr>';

            $this->getTreeChildTblProject(@$row->prj_id, $ul, $tab);
        }

        return $ul;
    }

    public function getAllPrjManageID($project_id, &$PrjManage = array())
    {
        $PrjManage[] = $project_id;
        $this->db->select('project_id');
        $this->db->from('tbl_project_manage');
        $this->db->where('project_parent', $project_id);
        $query = $this->db->get();
        foreach ($query->result() as $key => $value) {
            $this->getAllPrjManageID($value->project_id, $PrjManage);
        }

        return $PrjManage;
    }

    public function getPrjParent($project_id, &$prjID = array())
    {
        $prjID[] = $project_id;
        $this->db->select('prj_id');
        $this->db->from('tbl_project');
        $this->db->where('prj_parent', $project_id);
        $query = $this->db->get();
        foreach ($query->result() as $key => $value) {
            // $prjID[] = $value->prj_id;
            $this->getPrjParent($value->prj_id, $prjID);
        }

        return $prjID;
    }

    public function getAllPrjID($project_id, &$prj_id_array = array())
    {
        $manage_id = $this->getAllPrjManageID($project_id);
        foreach ($manage_id as $key => $value) {
            $prj_id_array = $this->getPrjParent($value, $prj_id_array);
        }

        return $prj_id_array;
    }

    public function getSumBudgetPrj($project_id)
    {
        // echo '<pre>';
        // print_r($project_id);
        // echo '</pre>';

        $budget = array();
        $budget['prj_budget'] = 0;
        $budget['prj_amount'] = 0;
        $budget['amount_plus'] = 0;
        $budget['amount_minus'] = 0;
        $budget['expenses_amount'] = 0;
        if (!empty($project_id)) {
            $this->db->select(' SUM(tbl_project.prj_budget) as prj_budget, ');
            $this->db->from('tbl_project');
            $this->db->where_in('tbl_project.prj_id ', $project_id);
            $this->db->where('tbl_project.prj_active', '1');

            $query_prj = $this->db->get();
            $prj = $query_prj->row();

            $this->db->select(' SUM(tbl_project.prj_budget) as prj_budget,
                                SUM(prj_amount) as prj_amount,
                               SUM(IF(prj_amount > 0 , prj_amount,0)) as amount_plus,
                               SUM(IF(prj_amount < 0 , prj_amount,0)) as amount_minus');
            $this->db->from('tbl_project');
            $this->db->join('tbl_prj_budget_log', 'tbl_prj_budget_log.prj_id = tbl_project.prj_id', 'left');
            $this->db->where_in('tbl_project.prj_id ', $project_id);
            $this->db->where('tbl_project.prj_active ', '1');
            $this->db->where('tbl_prj_budget_log.prj_budget_status', '0');
            if ($this->filter_date1 != '' && $this->filter_date2 != '') {
                $this->db->where('tbl_prj_budget_log.prj_log_date >=', $this->filter_date1);
                $this->db->where('tbl_prj_budget_log.prj_log_date <=', $this->filter_date2);
            }
            $query_prj = $this->db->get();
            $prj_log = $query_prj->row();

            $this->db->select('SUM(expenses_amount_result) as expenses_amount');
            $this->db->from('tbl_expenses');
            $this->db->join('tbl_project', 'tbl_project.prj_id = tbl_expenses.project_id');
            $this->db->where_in('tbl_project.prj_id ', $project_id);
            $this->db->where('tbl_project.prj_active ', '1');
            if ($this->filter_date1 != '' && $this->filter_date2 != '') {
                $this->db->where('tbl_expenses.expenses_date >=', $this->filter_date1);
                $this->db->where('tbl_expenses.expenses_date <=', $this->filter_date2);
            }
            $query_exp = $this->db->get();
            $exp = $query_exp->row();

            $budget['prj_budget'] = $prj->prj_budget;
            $budget['prj_amount'] = $prj_log->prj_amount;
            $budget['amount_plus'] = $prj_log->amount_plus;
            $budget['amount_minus'] = $prj_log->amount_minus;
            $budget['expenses_amount'] = $exp->expenses_amount;
        }

        return $budget;
    }

    // function updateLogPrj(){
    //     $query = $this->db->get('tbl_project');
    //     foreach ($query->result_array() as $key => $value) {
    //         $this->db->set('prj_budget_sum',$value['prj_budget']);
    //         $this->db->where('prj_id',$value['prj_id']);
    //         $this->db->update('tbl_project');

    //         $this->db->set('prj_amount',$value['prj_budget']);
    //         $this->db->set('prj_id',$value['prj_id']);
    //         $this->db->set('prj_budget_type',1);
    //         $this->db->insert('tbl_prj_budget_log');
    //     }
    // }

    public function getTreeYeartoYear($project)
    {
        $ul = '';
        foreach ($project as $key => $value) {
            if (empty($value->project_parent)) {
                $this->db->select('prj_budget_sum');
                $this->db->where('project_id', $value->project_ref_id);
                $query_ref = $this->db->get('tbl_project_manage');
                $ref = $query_ref->row();

                $ul .= '<tbody>';
                $ul .= '<tr><td><b>'.$value->project_title.'</b></td>
                        <td align="right">'.number_format(@$ref->prj_budget_sum, 2).'</td>
                        <td align="right">'.number_format($value->prj_budget_sum, 2).'</td>
                        <td align="right">'.number_format($value->prj_budget_sum - @$ref->prj_budget_sum, 2).'</td>';
                if (@$ref->prj_budget_sum > 0) {
                    $ul .= '<td align="right">'.number_format(($value->prj_budget_sum - @$ref->prj_budget_sum) / @$ref->prj_budget_sum * 100, 2).' %</td>
                        </tr>';
                } else {
                    $ul .= "<td align='right'> 0%</td>";
                }

                $ul .= $this->getTreeChildProjectYear($value->project_id);
                $ul .= '</tbody>';
            }
        }

        return $ul;
    }

    public function getTreeChildProjectYear($parent = '0', &$ul = '', $tab = '0')
    {
        //tab data
        ++$tab;
        $padding = $tab * 20;

        $this->db->where('project_parent', $parent);
        $query = $this->db->get('tbl_project_manage');
        foreach ($query->result() as $key => $row) {
            $this->db->select('prj_budget_sum');
            $this->db->where('project_id', $row->project_ref_id);
            $query_ref = $this->db->get('tbl_project_manage');
            $ref = $query_ref->row();

            $ul .= '<tr>';
            if (@$row->project_level == 3) {
                $ul .= "<td style='padding-left:".$padding."px'>".$this->data_budget[$row->project_title].'</td>';
            } elseif (@$row->project_level == 4) {
                $ul .= "<td style='padding-left:".$padding."px'>".$this->data_cost[$row->project_title].'</td>';
            } else {
                $ul .= "<td style='padding-left:".$padding."px'>".$row->project_title.'</td>';
            }

            $ul .= "<td align='right'>".number_format(@$ref->prj_budget_sum, 2).'</td>';
            $ul .= "<td align='right'>".number_format($row->prj_budget_sum, 2).'</td>';
            $ul .= "<td align='right'>".number_format($row->prj_budget_sum - @$ref->prj_budget_sum, 2).'</td>';
            if (!empty($ref->prj_budget_sum) && @$ref->prj_budget_sum > 0) {
                $ul .= "<td align='right'>".number_format(($row->prj_budget_sum - @$ref->prj_budget_sum) / @$ref->prj_budget_sum * 100, 2).' %</td>';
            } else {
                $ul .= "<td align='right'> 0%</td>";
            }

            $ul .= '</tr>';

            $this->getTreeChildProjectYear(@$row->project_id, $ul, $tab);

            $this->getTreeChildPrjYear(@$row->project_id, $ul, $tab);
        }

        return $ul;
    }

    public function getTreeChildPrjYear($parent = '0', &$ul = '', $tab = '')
    {
        //tab data
        ++$tab;
        $padding = $tab * 20;

        $this->db->where('prj_parent', $parent);
        $this->db->where('prj_active', '1');
        $query = $this->db->get('tbl_project');
        foreach ($query->result() as $key => $row) {
            $this->db->select('prj_budget_sum');
            $this->db->where('prj_id', $row->prj_ref_id);
            $query_ref = $this->db->get('tbl_project');
            $ref = $query_ref->row();

            $ul .= '<tr>';
            $ul .= "<td style='padding-left:".$padding."px'>".$row->prj_name.'</td>';
            $ul .= "<td align='right'>".number_format(@$ref->prj_budget_sum, 2).'</td>';
            $ul .= "<td align='right'>".number_format($row->prj_budget_sum, 2).'</td>';
            $ul .= "<td align='right'>".number_format($row->prj_budget_sum - @$ref->prj_budget_sum, 2).'</td>';
            if (!empty($ref->prj_budget_sum) && @$ref->prj_budget_sum > 0 && $row->prj_budget_sum > 0) {
                $ul .= "<td align='right'>".number_format(($row->prj_budget_sum - @$ref->prj_budget_sum) / $ref->prj_budget_sum * 100, 2).' %</td>';
            } else {
                $ul .= "<td align='right'> 0%</td>";
            }

            $ul .= '</tr>';

            $this->getTreeChildPrjYear(@$row->prj_id, $ul, $tab);
        }

        return $ul;
    }

    public function getPersonReceive($tax_type = '')
    {
        $data = array();
        $year = $this->session->userdata('year');

        $this->db->select('tax_receive.*,tax_notice.*,tbl_individual.*,tbl_tax.tax_name');
        $this->db->from('tax_receive');
        $this->db->join('tbl_tax', 'tbl_tax.tax_id = tax_receive.tax_id');
        $this->db->join('tax_notice', 'tax_notice.notice_id = tax_receive.notice_id');
        $this->db->join('tbl_individual', 'tbl_individual.individual_id = tax_receive.individual_id');
        $this->db->where('tax_receive.year_id', $year);
        $this->db->where('tax_notice.status = ', 'active');

        if ($tax_type != '') {
            $this->db->where('tax_receive.tax_id', $tax_type);
        }

        if ($this->filter_date1 != '' && $this->filter_date2 != '') {
            $this->db->where('tax_receive.receive_date >=', $this->filter_date1);
            $this->db->where('tax_receive.receive_date <=', $this->filter_date2);
        }

        $query = $this->db->get();

        return $query->result();
    }

    public function getTaxType()
    {
        $data = array();
        $this->db->select('*');
        $this->db->from('tbl_tax');
        $this->db->where('tax_parent_id', 1);
        $get = $this->db->get();
        foreach ($get->result() as $key => $value) {
            $data[$value->tax_id] = $value;
        }

        return $data;
    }

    public function getPayMonth($year)
    {
        $data = array();
        $this->db->select('SUM(expenses_amount_result) as expenses_amount, MONTH(expenses_date) as M');
        $this->db->from('tbl_expenses');
        $this->db->join('tbl_project', 'tbl_project.prj_id = tbl_expenses.project_id');
        $this->db->where('tbl_project.prj_active ', '1');
        $this->db->where('tbl_project.prj_year', $year);
        $this->db->GROUP_BY('M');
        $query = $this->db->get();

        foreach ($query->result() as $key => $value) {
            $data[$value->M] = $value->expenses_amount;
        }

        return $data;
    }
}
