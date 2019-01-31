<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{

    public function index()
    {
        $data['title'] = "ระบบจัดการข้อมูล";
        $data['subtitle'] = "เทศบาลตำบลหนองป่าครั่ง";
        $data['view_isi'] = "dashboard_view";

        $this->load->view('template/template', $data);
    }


}
