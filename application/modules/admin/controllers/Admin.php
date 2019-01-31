<?php
defined('BASEPATH') or exit('No direct script access allowed');

class admin extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('service/service_model', 'service');

        $chk = false;
        foreach ($_SESSION['user_permission'] as $key => $chk_permission) :
            if ($chk_permission['app_id'] == 16) :
            $chk = true;
        break;
        endif;
        endforeach;
        if ($chk == false) {
            redirect('main/dashborad');

        }
    }

    function index()
    {
        $data = array();
        $data['year'] = $this->admin_model->getYear();

        $this->config->set_item('title', 'จัดการปีงบประมาณ');
        $this->template->javascript->add('assets/modules/admin/index.js');
        $this->setView('index', $data);
        $this->publish();
    }

    function create_year()
    {
        $maxYear = $this->admin_model->getMaxYear();
        $this->admin_model->create_year($maxYear);

        $this->service->removeProjectYear($maxYear);
        $this->service->duplicate_project($maxYear);
        $this->service->duplicate_estimate($maxYear);
        $this->service->duplicate_estimate_tax($maxYear);

        $this->service->duplicate_outside($maxYear);

        redirect(base_url('admin'));
    }

    function del_year(){
        $year = $this->input->post('year_id');
         //remove budget_log
         $this->service->deletePrjBugdet($year);
         
        $this->admin_model->del_year($year);
       
        redirect(base_url('admin'));
    }

    function import_file()
    {
        $data = array();

        $this->config->set_item('title', 'ระบบนำเข้าข้อมูล');
        $this->setView('import_file', $data);
        $this->publish();
    }

    function getFileData()
    {
        $this->load->library('ImportExcel');
        ini_set('memory_limit', '2048M');
        set_time_limit('1800');

        $file_name = $_FILES['fileToUpload']['name'];
        $type = explode('.', $file_name);
        $type = $type[count($type) - 1];

        if ($type == 'xlsx' || $type == 'xls') {
            $data = $this->importexcel->getData($_FILES['fileToUpload']['tmp_name']);
            $tax_id = $this->input->post('tax_id');

            $this->admin_model->clearTemp($tax_id);
            $this->admin_model->importDataToTemp($tax_id, $data);
            $this->import_data_individual($tax_id);
            if ($tax_id == 8) {
                $this->houseImport();
            } else if ($tax_id == 9) {
                $this->wardImport();
            } else if ($tax_id == 10) {
                $this->labelImport();
            }
        }

        redirect(base_url('admin/import_file'));
    }


    function houseImport()
    {
        $this->load->model('import/import_model');
        $dataTmp = $this->import_model->getTmpHouse();

        // echo '<pre>';
        // print_r($dataTmp);
        foreach ($dataTmp as $key => $value) {
            $provice_id = $this->import_model->getProviceID($value->tmp_province_send);
            $district_id = $this->import_model->getDistrictID($provice_id, $value->tmp_district_send);
            $subdistrict_id_send = $this->import_model->getSubDistrictID($district_id, $value->tmp_subdistrict_send);

            $subdistrict_id = $this->import_model->getSubDistrictID('50010000', $value->tmp_subdistrict);

            $dataTmp[$key]->provice_id_send = $provice_id;
            $dataTmp[$key]->district_id_send = $district_id;
            $dataTmp[$key]->subdistrict_id_send = $subdistrict_id_send;
            $dataTmp[$key]->subdistrict_id = $subdistrict_id;

        }
        $this->import_model->importNoticeHouse($dataTmp);

    }

    function wardImport()
    {
        $this->load->model('import/import_model');
        $dataTmp = $this->import_model->getTmpWard();
        // echo '<pre>';
        // print_r($dataTmp);
        $this->import_model->importNoticeWard($dataTmp);
    }

    function labelImport()
    {
        $this->load->model('import/import_model');
        $dataTmp = $this->import_model->getTmpLabel();
        // echo '<pre>';
        // print_r($dataTmp);
        $this->import_model->importNoticeLabel($dataTmp);
    }

    public function import_data_individual($tax_id)
    {
        //import module
        $this->load->model('import/import_model');
        $this->load->model('receive/receive_model');

        if ($tax_id == 8) {
            $dataTmp = $this->import_model->getTmpHouse();
            foreach ($dataTmp as $key => $value) {
                $provice_id = $this->import_model->getProviceID($value->tmp_province_send);
                $district_id = $this->import_model->getDistrictID($provice_id, $value->tmp_district_send);
                $subdistrict_id = $this->import_model->getSubDistrictID($district_id, $value->tmp_subdistrict_send);

                $dataTmp[$key]->provice_id_send = $provice_id;
                $dataTmp[$key]->district_id_send = $district_id;
                $dataTmp[$key]->subdistrict_id_send = $subdistrict_id;
            }

            //import data to table individual
            $dataImport = array();
            foreach ($dataTmp as $key => $value) {

                if (strlen($value->tmp_Identification) == 12) {
                    $dataImport['individual_type'] = 2;
                } else {
                    $dataImport['individual_type'] = 1;
                }

                $dataImport['individual_prename'] = $value->tmp_prename;
                $dataImport['individual_fullname'] = $value->tmp_firstname . ' ' . $value->tmp_lastname;
                $dataImport['individual_firstname'] = $value->tmp_firstname;
                $dataImport['individual_lastname'] = $value->tmp_lastname;
                $dataImport['individual_number'] = $value->tmp_Identification;
                $dataImport['individual_address'] = $value->tmp_number_send;
                $dataImport['individual_village'] = $value->tmp_village_send;
                $dataImport['individual_subdistrict'] = $value->tmp_subdistrict;
                $dataImport['individual_send_address'] = $value->tmp_number_send;
                $dataImport['individual_send_village'] = $value->tmp_village_send;
                $dataImport['individual_send_road'] = $value->tmp_road_send;
                $dataImport['individual_send_lane'] = $value->tmp_lane_send;
                $dataImport['individual_send_province'] = $value->provice_id_send;
                $dataImport['individual_send_district'] = $value->district_id_send;
                $dataImport['individual_send_subdistrict'] = $value->subdistrict_id_send;
                $dataImport['individual_send_zipcode'] = $value->tmp_zipcode_send;
                $dataImport['individual_business_name'] = $value->tmp_type_business;

                //insert data to table
                if ($this->admin_model->checkIndividual($value->tmp_Identification)) {
                    $status = $this->receive_model->insertDataImport($dataImport);
                }
            }

        } else if ($tax_id == 9) {
            $dataTmp = $this->import_model->getTmpWard();
            foreach ($dataTmp as $key => $value) {
                $provice_id = $this->import_model->getProviceID($value->tmp_province);
                $district_id = $this->import_model->getDistrictID($provice_id, $value->tmp_district);
                $subdistrict_id = $this->import_model->getSubDistrictID($district_id, $value->tmp_subdistrict);

                $dataTmp[$key]->provice_id = $provice_id;
                $dataTmp[$key]->district_id = $district_id;
                $dataTmp[$key]->subdistrict_id = $subdistrict_id;
            }
            // print_r($dataTmp);

            //import data to table individual
            $dataImport = array();
            foreach ($dataTmp as $key => $value) {

                if (strlen($value->tmp_Identification) == 12) {
                    $dataImport['individual_type'] = 2;
                } else {
                    $dataImport['individual_type'] = 1;
                }

                $dataImport['individual_prename'] = $value->tmp_prename;
                $dataImport['individual_fullname'] = $value->tmp_firstname . ' ' . $value->tmp_lastname;
                $dataImport['individual_firstname'] = $value->tmp_firstname;
                $dataImport['individual_lastname'] = $value->tmp_lastname;
                $dataImport['individual_number'] = $value->tmp_Identification;
                $dataImport['individual_address'] = $value->tmp_number;
                $dataImport['individual_village'] = $value->tmp_village;
                $dataImport['individual_road'] = $value->tmp_road;
                $dataImport['individual_lane'] = $value->tmp_lane;
                $dataImport['individual_subdistrict'] = $value->subdistrict_id;
                $dataImport['individual_provice'] = $value->provice_id;
                $dataImport['individual_district'] = $value->district_id;
                $dataImport['individual_zipcode'] = $value->tmp_zipcode;

                //insert data to table
                if ($this->admin_model->checkIndividual($value->tmp_Identification)) {
                    $status = $this->receive_model->insertDataImport($dataImport);
                }

            }
        } else if ($tax_id == 10) {
            $dataTmp = $this->import_model->getTmpLabel();
            foreach ($dataTmp as $key => $value) {
                $provice_id = $this->import_model->getProviceID($value->tmp_province);
                $district_id = $this->import_model->getDistrictID($provice_id, $value->tmp_district);
                $subdistrict_id = $this->import_model->getSubDistrictID($district_id, $value->tmp_subdistrict);

                $dataTmp[$key]->provice_id = $provice_id;
                $dataTmp[$key]->district_id = $district_id;
                $dataTmp[$key]->subdistrict_id = $subdistrict_id;
            }
            // print_r($dataTmp);

            //import data to table individual
            $dataImport = array();
            foreach ($dataTmp as $key => $value) {

                if (strlen($value->tmp_Identification) == 12) {
                    $dataImport['individual_type'] = 2;
                } else {
                    $dataImport['individual_type'] = 1;
                }

                $dataImport['individual_prename'] = $value->tmp_prename;
                $dataImport['individual_fullname'] = $value->tmp_firstname . ' ' . $value->tmp_lastname;
                $dataImport['individual_firstname'] = $value->tmp_firstname;
                $dataImport['individual_lastname'] = $value->tmp_lastname;
                $dataImport['individual_number'] = $value->tmp_Identification;
                $dataImport['individual_address'] = $value->tmp_number;
                $dataImport['individual_village'] = $value->tmp_village;
                $dataImport['individual_road'] = $value->tmp_road;
                $dataImport['individual_lane'] = $value->tmp_lane;
                $dataImport['individual_subdistrict'] = $value->subdistrict_id;
                $dataImport['individual_provice'] = $value->provice_id;
                $dataImport['individual_district'] = $value->district_id;
                $dataImport['individual_zipcode'] = $value->tmp_zipcode;
                $dataImport['individual_business_name'] = $value->tmp_name_store;

                //insert data to table
                if ($this->admin_model->checkIndividual($value->tmp_Identification)) {
                    $status = $this->receive_model->insertDataImport($dataImport);
                }

            }
        }
        
        // change some data to type int

    }


}