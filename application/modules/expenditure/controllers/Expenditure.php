<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Expenditure extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('expenditure_model');
        $this->load->model('project_training/project_model');

        $chk = false;
        foreach ($_SESSION['user_permission'] as $key => $chk_permission):
            if ($chk_permission['app_id'] == 6):
                $chk = true;
                break;
            endif;
        endforeach;
        if ($chk == false) {
            redirect('main/dashborad');
        }

        // $this->project_training->ggg();

    }
    public function expenditure_menu()
    {
        $data = array();
        $this->config->set_item('title', 'บันทึกรายจ่าย - เทศบาลตำบลหนองป่าครั่ง');
        $this->setView('expenditure_menu', $data);
        $this->publish();
    }

    public function expenditure_prj()
    {
        // $data['title'] = "ระบบบัญชีรายจ่าย";
        // $data['subtitle'] = "เทศบาลตำบลหนองป่าครั่ง";
        // $data['view_isi'] = "expenditure_prj";

        // $this->load->view('template/template', $data);
        $data = array();
        $year = $this->session->userdata('year');
        // $data['expenditure'] = $this->expenditure_model->getExpenditure($year);
        $this->config->set_item('title', 'ระบบบัญชีรายจ่าย - เทศบาลตำบลหนองป่าครั่ง');
        $this->template->javascript->add('assets/modules/expenditure/search.js');
        $this->setView('expenditure_prj', $data);
        $this->publish();
    }

    public function getAjaxExpenditure()
    {
        $order_index = $this->input->get('order[0][column]');
        $param['page_size'] = $this->input->get('length');
        $param['start'] = $this->input->get('start');
        $param['draw'] = $this->input->get('draw');
        $param['keyword'] = trim($this->input->get('search[value]'));
        $param['column'] = $this->input->get("columns[{$order_index}][data]");
        $param['dir'] = $this->input->get('order[0][dir]');
        //check filter data
        $filter = array();
        foreach ($this->input->get("columns") as $key => $value) {
            $filter[] = $value['search']['value'];
        }
        $param['filter'] = $filter;
        $results = $this->expenditure_model->getAjaxExpenditure($param);

        $data['draw'] = $param['draw'];
        $data['recordsTotal'] = $results['count'];
        $data['recordsFiltered'] = $results['count_condition'];
        $data['data'] = $results['data'];
        $data['error'] = $results['error_message'];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function search_prj()
    {
        $data = array();
        $this->config->set_item('title', 'ระบบบัญชีรายจ่าย - ค้นหาโครงการ');
        $this->template->javascript->add('assets/modules/expenditure/search.js');
        $this->setView('search_prj', $data);
        $this->publish();
    }

    public function getPrj()
    {

        $keyword = $this->input->post('keyword');
        $data['prj'] = $this->expenditure_model->getPrjByKeyword($keyword);

        $this->load->model('report/Report_model');

        foreach ($data['prj'] as $key => $value) {
            $prj_id_array = $this->Report_model->getPrjParent($value->prj_id);

            // echo ($prj_id_array[$cout-1]).'<br>';
            $tree = $this->getLastArrayPrj($prj_id_array[0]);
            // print_r($tree);
            end($tree);
            $keys = key($tree);
            // print_r($tree);die();

            $name_tree = $this->getLastNamePrj($keys);
            if (end($name_tree) != '' && !is_numeric(end($name_tree))) {
                $data['prj'][$key]->prj_name = $data['prj'][$key]->prj_name . '<span style="color:#169F85">(' . end($name_tree) . ')</span>';
            } else {
                unset($data['prj'][$key]);
            }
        }

        $data['keyword'] = $keyword;

        $this->load->view('table_prj', $data);
    }

    public function expenditure_form($project_id = '', $expenses = '')
    {
        $data = array();
        if ($project_id == '') {
            redirect(base_url('expenditure/search_prj'));
        }

        $this->config->set_item('title', 'ระบบบัญชีรายจ่าย - บันทึกการเบิกจ่าย');
        $data['prj'] = $this->expenditure_model->getPrjById($project_id);
        $data['expenses_all'] = $this->expenditure_model->getPrjExpenses($project_id);
        // print_r($data['prj']);die();
        if ($expenses != '') {
            $data['expenses'] = $this->expenditure_model->getPrjExpenses($project_id, $expenses);

        }

        $data['project_id'] = $project_id;
        $this->template->javascript->add('assets/modules/expenditure/form.js');
        $this->setView('expenditure_form', $data);
        $this->publish();
    }

    public function saveExpenditure()
    {
        $this->load->model('receive_outside/Receive_outside_model');
        $input = $this->input->post();

        $this->expenditure_model->saveExpenditure($input);

        // tax insert
        // print_r($input);die();
        if (empty($input['expenses_id'])) {
            $data = array();
            if ($input['expenses_amount_tax'] != '' && $input['expenses_amount_tax'] != '0') {
                $id = $this->Receive_outside_model->getIdTaxPay();

                $prj = $this->expenditure_model->getPrjById($input['project_id']);

                $data['outside_id'] = $id->out_id;
                $data['outside_detail'] = 'หัก ภาษี ณ ที่จ่าย จาก โครงการ' . $prj->prj_name;
                $data['outside_pay_budget'] = floatval(preg_replace('/[^\d.]/', '', $input['expenses_amount_tax']));
                $data['outside_pay_create'] = $this->mydate->date_thai2eng($input['expenses_date'], -543);
                $data['outside_pay_user'] = $_SESSION['user_id'];
                $status = $this->Receive_outside_model->saveOutSideIn($data);

            }

            // if ($input['expenses_amount_fine'] != '' && $input['expenses_amount_fine'] != '0') {
            //     $datas = array();
            //     $year = $this->session->userdata('year');
            //     $datas['sum_amount'] = floatval(preg_replace('/[^\d.]/', '', $input['expenses_amount_fine']));
            //     $datas['receive_date'] = $this->mydate->date_thai2eng($input['expenses_date'], -543);
            //     unset($data['outside_detail']);
            //     // print_r($datas);die();
            //     $this->expenditure_model->insertOtherTax($year, $datas);

            // }
        }
        // die();
        redirect(base_url('expenditure/expenditure_prj'));

    }

    public function expenditure_del($id)
    {
        $this->expenditure_model->expenditure_del($id);
        redirect(base_url('expenditure/expenditure_prj'));
    }

    public function getExpenditureNumber()
    {
        $id = $this->input->post('id');
        $result = $this->expenditure_model->getExpenditureNumber($id);

        $result->expenses_date_disburse = $this->mydate->date_db2str($result->expenses_date_disburse);
        $this->json_publish($result);
    }

    public function saveExpenditureNumber()
    {
        $id = $this->input->post('id');
        $input['expenses_number'] = $this->input->post('expenses_number');
        $input['expenses_date_disburse'] = $this->input->post('expenses_date_disburse');
        $result = $this->expenditure_model->saveExpenditureNumber($id, $input);
        $this->json_publish($result);
    }

    //get last index prj
    public function getLastArrayPrj($parent = '')
    {

        $data_budget = ['', 'งบบุคลากร', 'งบดำเนินงาน', 'งบลงทุน', 'งบเงินอุดหนุน', 'งบกลาง'];
        $data_cost = [
            '', 'เงินเดือน (ฝ่ายการเมือง)', 'เงินเดือน (ฝ่ายประจำ)', 'ค่าตอบแทน', 'ค่าใช้สอย', 'ค่าวัสดุ', 'ค่าสาธารณูปโภค',
            'ค่าครุภัณฑ์', 'ค่าที่ดินและสิ่งก่อสร้าง', 'เงินอุดหนุน', 'งบกลาง',
        ];

        $tree = $this->project_model->getTitleTreeChild($parent);

        // $num = 0;
        // foreach ($tree as $key => $value) {
        //     if ($num == 0) {
        //         $tree[$key] = $data_cost[$tree[$key]];
        //     }

        //     if ($num == 1) {
        //         $tree[$key] = $data_budget[$tree[$key]];
        //     }

        //     $num++;
        // }
        // if (empty($tree)) {
        //     print_r($tree);
        //     // $tree = $this->project_model->getTitleTree($parent);

        //     // $num = 0;
        //     // foreach ($tree as $key => $value) {
        //     //     if ($num == 1) {
        //     //         $tree[$key] = $data_cost[$tree[$key]];
        //     //     }

        //     //     if ($num == 2) {
        //     //         $tree[$key] = $data_budget[$tree[$key]];
        //     //     }

        //     //     $num++;
        //     // }
        // }
        return $tree;
    }
    public function getLastNamePrj($parent = '')
    {

        $tree = $this->project_model->getTitleTree($parent);

        return $tree;
    }

}
