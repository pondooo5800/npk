<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tax_estimate extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Tax_estimate_model', 'estimate_model');

        $chk = false;
        foreach ($_SESSION['user_permission'] as $key => $chk_permission) :
            if ($chk_permission['app_id'] == 1) :
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

        $data['tax'] = $this->estimate_model->getTax();
        $this->config->set_item('title', 'ระบบบัญชีรายรับ - บันทึกประมานการ ภาษี');
        $this->setView('index', $data);
        $this->publish();
    }

    function saveEstimate()
    {
        $input = $this->input->post();

        $year = $this->session->userdata('year');
        $this->estimate_model->saveEstimate($year, $input);

        redirect(base_url('tax_estimate'));
    }

}
