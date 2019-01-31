<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Service extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('service_model');

    }

    function duplicate_project($year){
        // $this->service_model->duplicate_project($year);
    }

    function duplicate_estimate($year){
    	// $this->service_model->duplicate_estimate($year);
    }
}

    
