<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();


    }

    public function dashborad()
    {

        $year =  $this->session->userdata('year');
        if ( empty($year) ){
                $this->session->set_userdata('year', date('Y'));
        }

        $data = array();
        $this->config->set_item('title', 'หน้าหลัก - เทศบาลตำบลหนองป่าครั่ง');

        //$this->template->javascript->add('assets/modules/main/js/chart.js');

        //project_manage
        $this->load->model('project_training/project_model');
        $data['sum_project_training'] = $this->project_model->getSumProject();

        $this->load->model('main/main_model');
        $data['sum_pay'] = ($this->main_model->getSumExpenses()+$this->main_model->getSumOutsidePay());

        //estimate
        $data['sum_estimate'] = $this->main_model->getSumEstimate();

        //receive
        $data['sum_receive'] = $this->main_model->getSumReceive()+$this->main_model->getSumOutside();
        $data['sum_receive_balance'] = $data['sum_estimate']-$data['sum_receive'];


        $this->setView('dashboard', $data);
        $this->publish();
    }

    public function updateYear(){
        $data['success'] = false;
        $year = $this->input->post('year');
        if (!empty($year)){
            $this->session->set_userdata('year', $year);
            // $this->config->set_item('year', $year);
            $data['success'] = true;
        }
        $this->json_publish($data);
    }



}
