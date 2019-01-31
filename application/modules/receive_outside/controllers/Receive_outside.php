<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Receive_outside extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Receive_outside_model');
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
    }

    public function index()
    {
        $data = array();
        $this->config->set_item('title', 'ข้อมูลบันทึกรายรับ - เทศบาลตำบลหนองป่าครั่ง');
        $data['out_pay'] = $this->Receive_outside_model->getOutPay();
        $this->template->javascript->add('assets/modules/receive_outside/search.js');
        $this->setView('receive_save', $data);
        $this->publish();
    }

    public function outside()
    {

        $data = array();
        $this->config->set_item('title', 'ระบบรายรับนอกงบประมาณ - เทศบาลตำบลหนองป่าครั่ง');
        $this->template->javascript->add('assets/modules/receive_outside/outside.js');
        $this->setView('outside', $data);
        $this->publish();
    }

    // public function outside_prj()
    // {

    //     // $data['title'] = "ระบบบัญชีรายจ่าย";
    //     // $data['subtitle'] = "เทศบาลตำบลหนองป่าครั่ง";
    //     // $data['view_isi'] = "expenditure_prj";

    //     // // $this->load->view('template/template', $data);
    //     $data = array();
    //     $data['outside'] = $this->Receive_outside_model->getOut();
    //     $this->config->set_item('title', 'ระบบบัญชีรายจ่าย - เทศบาลตำบลหนองป่าครั่ง');
    //     $this->template->javascript->add('assets/modules/receive_outside/search.js');
    //     $this->setView('expenditure_prj', $data);
    //     $this->publish();
    // }

    public function getPrj()
    {
        $keyword = $this->input->post('keyword');
        $data['prj'] = $this->Receive_outside_model->getPrjByKeyword($keyword);
        $data['keyword'] = $keyword;

        $this->load->view('table_prj', $data);
    }

    public function search_outside_prj()
    {
        $data = array();
        $this->config->set_item('title', 'ระบบบัญชีรายจ่าย - ค้นหาโครงการ');
        $this->template->javascript->add('assets/modules/receive_outside/search.js');
        $this->setView('search_prj', $data);
        $this->publish();
    }

    // //get prj
    public function getOut()
    {
        $data = $this->input->post('data');
        $status = $this->Receive_outside_model->getOuts($data);
        $this->json_publish($status);
    }

    public function outside_in_form($id, $pay_id = '')
    {
        $data = array();
        $data['out'] = $this->Receive_outside_model->getOut($id);
        $data['out_rec_all'] = $this->Receive_outside_model->getOutRec($id);
        if ($pay_id != '') {
            $data['out_pay'] = $this->Receive_outside_model->getOutPay($id, $pay_id);
        }

        // }
        // print_r($data['out_pay_all']);die();

        $this->config->set_item('title', 'ระบบบัญชีรายจ่าย - เทศบาลตำบลหนองป่าครั่ง');
        $this->template->javascript->add('assets/modules/receive_outside/search.js');
        $this->setView('outside_in_form', $data);
        $this->publish();

    }

    public function outside_form($id, $pay_id = '')
    {

        $data = array();
        $data['out'] = $this->Receive_outside_model->getOut($id);
        $data['out_pay_all'] = $this->Receive_outside_model->getOutPay($id);
        if ($pay_id != '') {
            $data['out_pay'] = $this->Receive_outside_model->getOutPay($id, $pay_id);
        }

        // }
        // print_r($data['out_pay']);die();

        $this->config->set_item('title', 'ระบบบัญชีรายจ่าย - เทศบาลตำบลหนองป่าครั่ง');
        $this->template->javascript->add('assets/modules/receive_outside/search.js');
        $this->setView('outside_form', $data);
        $this->publish();
    }

    // //insert prj
    public function insertOutside()
    {
        $data = array();
        $tmp = $this->input->post('data');
        $id = $this->input->post('id');
        $edit = $this->input->post('edit');

        if ($edit == 'true') {
            foreach ($tmp as $key => $value) {
                $data[$value['name']] = $value['value'];
            }
            $data['out_create'] = date('Y-m-d H:i:s');
            $status = $this->Receive_outside_model->insertOut($data, $id);
        } else {

            foreach ($tmp as $key => $value) {
                $data[$value['name']] = $value['value'];
            }
            $status = $this->Receive_outside_model->insertOut($data, $id);
        }

        $this->json_publish($status);
    }

    // //delete prj
    public function delOut($id, $state = '')
    {
        $this->Receive_outside_model->delOut($id, $state);
        redirect('receive_outside/outside');
    }

    public function saveOutSidePay()
    {
        $data = $this->input->post();
        $data['outside_pay_create'] = $this->mydate->date_thai2eng($data['outside_pay_create'], -543);
        $data['outside_pay_user'] = $_SESSION['user_id'];

        $data['outside_pay_budget'] = floatval(preg_replace('/[^\d.]/', '', $data['outside_pay_budget']));
        $data['outside_pay_tax'] = floatval(preg_replace('/[^\d.]/', '', $data['outside_pay_tax']));
        $data['outside_pay_vat'] = floatval(preg_replace('/[^\d.]/', '', $data['outside_pay_vat']));
        $data['outside_pay_budget_sum'] = floatval(preg_replace('/[^\d.]/', '', $data['outside_pay_budget_sum']));

        $data['outside_pay_amount_disburse'] = floatval(preg_replace('/[^\d.]/', '', $data['outside_pay_amount_disburse']));
        $data['outside_pay_amount_fine'] = floatval(preg_replace('/[^\d.]/', '', $data['outside_pay_amount_fine']));

        $data['outside_detail'] = trim($data['outside_detail']);

        $status = $this->Receive_outside_model->saveOutSidePay($data);

        if (empty($data['outside_pay_id'])) {
            if ($data['outside_pay_tax'] != '') {
                $datas = array();
                //get Tax pay
                $id = $this->Receive_outside_model->getIdTaxPay();
                $out = $this->Receive_outside_model->getOuts($data['outside_id']);

                $datas['outside_id'] = $id->out_id;
                $datas['outside_detail'] = 'หัก ภาษี ณ ที่จ่าย จาก' . $out[0]->out_name;
                $datas['outside_pay_budget'] = $data['outside_pay_tax'];
                $datas['outside_pay_create'] = date('Y-m-d');

                // unset($data['outside_pay_budget_sum']);
                // unset($data['outside_pay_vat']);
                // unset($data['outside_pay_tax']);

                $this->saveOutSideIn($datas, true);
            }
        }
        redirect('receive_outside');
    }

    public function saveOutSideIn($data = array(), $return = false)
    {
        if (empty($data)) {
            $data = $this->input->post();
        }

        $data['outside_pay_create'] = $this->mydate->date_thai2eng($data['outside_pay_create'], -543);
        $data['outside_pay_user'] = $_SESSION['user_id'];

        $data['outside_pay_budget'] = floatval(preg_replace('/[^\d.]/', '', $data['outside_pay_budget']));
        $data['outside_detail'] = trim($data['outside_detail']);

        $status = $this->Receive_outside_model->saveOutSideIn($data);
        if ($return) {
            redirect('receive_outside/outside');
        }

        redirect('receive_outside/outside');

    }

    // //get data project_traing all
    public function getOutsideJson()
    {
        $data = array();
        $out = $this->Receive_outside_model->getOuts();
        // print_r($out);die();
        // $data['total'] = count($out);

        foreach ($out as $key => $value) {

            $data['rows'][$key]['id'] = $value->out_id;
            $data['rows'][$key]['budget'] = number_format($value->out_budget_sum, 2);
            $data['rows'][$key]['account_id'] = $value->out_code;
            $data['rows'][$key]['name'] = $value->out_name;
            $data['rows'][$key]['tools'] = "<div class='btn-group'>";
            if ($value->out_parent != '0') {
                $data['rows'][$key]['_parentId'] = $value->out_parent;

            }
            $data['rows'][$key]['tools'] .= " <button  onclick=" . 'window.location.href="' . base_url('receive_outside/outside_in_form') . '/' . $value->out_id . '"' . " class='btn btn-info btn-sm' type='button'>รับ</button>";
            $data['rows'][$key]['tools'] .= " <button  onclick=" . 'window.location.href="' . base_url('receive_outside/outside_form') . '/' . $value->out_id . '"' . " class='btn btn-default btn-sm' type='button'>จ่าย</button>";
            $data['rows'][$key]['tools'] .= " <button  onClick='add_out(" . $value->out_id . ")' class='btn btn-success btn-sm' type='button'>เพิ่ม</button>
            <button onClick='edit_out(" . $value->out_id . ")' id='outside_edit' class='btn btn-warning btn-sm' type='button'>แก้ไข</button>
            <button onClick='del_out(" . $value->out_id . "," . '"1"' . ")'  id='outside_del' class='btn btn-danger btn-sm' type='button'>ลบ</button></div>";

        }
        $this->json_publish($data);
    }

    public function outSidePayDel($id)
    {
        $this->Receive_outside_model->outSidePayDel($id);
        redirect('receive_outside');
    }

    public function getOutsideAjax()
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
        $results = $this->Receive_outside_model->getOutsideAjax($param);

        $data['draw'] = $param['draw'];
        $data['recordsTotal'] = $results['count'];
        $data['recordsFiltered'] = $results['count_condition'];
        $data['data'] = $results['data'];
        $data['error'] = $results['error_message'];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));

    }

    public function getOutsideNumber()
    {
        $id = $this->input->post('id');
        $result = $this->Receive_outside_model->getOutsideNumber($id);

        $result->outside_date_disburse = $this->mydate->date_db2str($result->outside_date_disburse);
        $this->json_publish($result);
    }

    public function saveOutsideNumber()
    {
        $id = $this->input->post('id');
        $input['outside_number'] = $this->input->post('expenses_number');
        $input['outside_date_disburse'] = $this->input->post('expenses_date_disburse');
        $result = $this->Receive_outside_model->saveOutsideNumber($id, $input);
        $this->json_publish($result);
    }

}
