<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Receive extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Receive_model');

    }


    public function receive_menu()
    {
        $data = array();
        $this->config->set_item('title', 'บันทึกรายรับ - เทศบาลตำบลหนองป่าครั่ง');
        $this->setView('receive_menu', $data);
        $this->publish();
    }

    public function receive_dashborad()
    {
        $data = array();
        $this->config->set_item('title', 'ข้อมูลการประเมินรายรับ - เทศบาลตำบลหนองป่าครั่ง');
        $this->setView('receive_dashborad', $data);
        //load js//
        //import input mark
        $this->template->javascript->add('assets/plugins/gentelella-master/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js');
        $this->template->javascript->add('assets/modules/receive/receive_dashborad.js');
        $this->publish();
    }

    //delete notice
    public function receive_notice_delete($id)
    {
        $this->Receive_model->del_notice($id);
        redirect(base_url('receive/receive_dashborad'));

    }


    public function receive_add($id = '')
    {
        $data = array();

        $id = $this->uri->segment(3);
        $query = $this->Receive_model->get_notic_one($id);
        $query2 = $this->Receive_model->get_receive_notice($id);
        foreach ($query2 as $key => $value) {
            list($y, $m, $d) = explode('-', $value['receive_date']);
            $query2[$key]['receive_date'] = "{$d}/{$m}/" . ($y + 543);
        }
        // print_r($query);

        $data = array();
        $data['tax_notice'] = $query;
        $data['tax_receive'] = $query2;



        $this->config->set_item('title', 'หน้าหลัก - เทศบาลตำบลหนองป่าครั่ง');

        $data['tax_notice'] = $this->Receive_model->read_receive($id);

        $query = $this->db->query("SELECT * FROM tbl_operation");
        $data['operation'] = $query->result();

        $query = $this->db->query("SELECT * FROM tbl_year");
        $data['years'] = $query->result();

        $query = $this->db->query("SELECT * FROM tbl_tax_year ORDER BY tax_year_id DESC");
        $data['tax_years'] = $query->result();


        $query = $this->db->query("SELECT * FROM tbl_banner");
        $data['banner'] = $query->result();

        $this->template->javascript->add('assets/modules/receive/alert_receive_add.js');
        $this->setView('receive_add', $data);
        $this->publish();
    }

    public function receive_notice($id = '', $tax_id)
    {
        $data = array();

        if (!empty($id)) {
            $data['notice'] = $this->Receive_model->getNoticeAll($id);

            foreach ($data['notice'] as $key => $notice) {
                $data['tax_notice'][$notice->tax_id][] = $notice;
            }
            // echo ("<pre>");
            // print_r($data['tax_notice']);
            // echo ("</pre>");

        }
        $data['tax_notice_read'] = $this->Receive_model->read_receive($id);
        $data['tax_notice_id'] = $this->Receive_model->getNoticeAll($id);
        $data['tax_id'] = $tax_id;

        $query = $this->db->query("SELECT * FROM tbl_operation");
        $data['operation'] = $query->result();

        $query = $this->db->query("SELECT * FROM tbl_year");
        $data['years'] = $query->result();

        $query = $this->db->query("SELECT * FROM tbl_banner");
        $data['banner'] = $query->result();

        $query = $this->db->query("SELECT * FROM tbl_tax_year ORDER BY tax_year_id DESC");
        $data['tax_years'] = $query->result();




        $this->config->set_item('title', 'หน้าหลัก - เทศบาลตำบลหนองป่าครั่ง');
        $this->setView('receive_edit', $data);
        $this->publish();

    }

    public function receive_notice_save($id = '')
    {
        $data = array();
        $input = $this->input->post();
        // echo '<pre>';
        // print_r($input);

        foreach ($input['notice_number'] as $k => $value) {
            if (!empty($input['notice_number'][0][0])) {
                $form_key = 0;
                foreach ($input['notice_estimate'][$form_key] as $key => $v) {
                    $data[$form_key][$key]['individual_id'] = $input['individual_id'][$form_key][0];
                    $data[$form_key][$key]['tax_id'] = 8;

                    $data[$form_key][$key]['notice_number'] = $input['notice_number'][$form_key][0];
                    $data[$form_key][$key]['notice_no'] = $input['notice_no'][$form_key][0];
                    $data[$form_key][$key]['notice_number_p2'] = $input['notice_number_p2'][$form_key][0];
                    $data[$form_key][$key]['notice_date'] = $this->mydate->date_thai2eng($input['notice_date'][$form_key][0], -543);
                    $data[$form_key][$key]['notice_date_p2'] = $this->mydate->date_thai2eng($input['notice_date_p2'][$form_key][0], -543);
                    $data[$form_key][$key]['notice_amount'] = str_replace(',', '', $input['notice_amount'][$form_key][0]);

                    // --- $form_key $key ----//
                    $data[$form_key][$key]['land_deed_number'] = $input['land_deed_number'][$form_key][$key];
                    $data[$form_key][$key]['noice_name_operation_other'] = $input['noice_name_operation_other'][$form_key][$key];
                    $data[$form_key][$key]['notice_address_number'] = $input['notice_address_number'][$form_key][$key];
                    $data[$form_key][$key]['notice_address_moo'] = $input['notice_address_moo'][$form_key][$key];
                    $data[$form_key][$key]['notice_address_subdistrict'] = 50011300;
                    $data[$form_key][$key]['notice_estimate'] = str_replace(',', '', $input['notice_estimate'][$form_key][$key]);
                    $data[$form_key][$key]['tax_year'] = $input['tax_year'][$form_key][$key];
                    $data[$form_key][$key]['noice_type_operation'] = $input['noice_type_operation'][$form_key][$key];
                    $data[$form_key][$key]['noice_name_operation'] = $input['noice_name_operation'][$form_key][$key];
                    $data[$form_key][$key]['notice_annual_fee'] = str_replace(',', '', $input['notice_annual_fee'][$form_key][$key]);

                }

            } else if (!empty($input['notice_number'][1][0])) {
                $form_key = 1;
                foreach ($input['notice_estimate'][$form_key] as $key => $v) {
                    $data[$form_key][$key]['individual_id'] = $input['individual_id'][$form_key][0];
                    $data[$form_key][$key]['tax_id'] = 9;
                    $data[$form_key][$key]['tax_interest'] = $input['tax_interest'][$form_key][0];


                    $data[$form_key][$key]['notice_number'] = $input['notice_number'][$form_key][0];
                    $data[$form_key][$key]['notice_date_p5'] = $this->mydate->date_thai2eng($input['notice_date_p5'][$form_key][0], -543);
                    $data[$form_key][$key]['notice_date'] = $this->mydate->date_thai2eng($input['notice_date'][$form_key][0], -543);
                    $data[$form_key][$key]['land_amount'] = str_replace(',', '', $input['land_amount'][$form_key][0]);

                    // --- $form_key $key ----//
                    $data[$form_key][$key]['land_deed_number'] = $input['land_deed_number'][$form_key][$key];
                    $data[$form_key][$key]['notice_mark'] = $input['notice_mark'][$form_key][$key];


                    $data[$form_key][$key]['notice_address_moo'] = $input['notice_address_moo'][$form_key][$key];
                    $data[$form_key][$key]['notice_address_subdistrict'] = 50011300;
                    $data[$form_key][$key]['land_rai'] = str_replace(',', '', $input['land_rai'][$form_key][$key]);
                    $data[$form_key][$key]['land_ngan'] = str_replace(',', '', $input['land_ngan'][$form_key][$key]);
                    $data[$form_key][$key]['land_wa'] = str_replace(',', '', $input['land_wa'][$form_key][$key]);
                    $data[$form_key][$key]['land_tax'] = str_replace(',', '', $input['land_tax'][$form_key][$key]);
                    $data[$form_key][$key]['notice_estimate'] = str_replace(',', '', $input['notice_estimate'][$form_key][$key]);
                    $data[$form_key][$key]['tax_year'] = $input['tax_year'][$form_key][$key];
                    $data[$form_key][$key]['tax_local_year'] = $input['tax_local_year'][$form_key][$key];
                }
            } else if (!empty($input['notice_number'][2][0])) {
                $form_key = 2;
                foreach ($input['notice_estimate'][$form_key] as $key => $v) {
                    $data[$form_key][$key]['individual_id'] = $input['individual_id'][$form_key][0];
                    $data[$form_key][$key]['tax_id'] = 10;

                    $data[$form_key][$key]['notice_number'] = $input['notice_number'][$form_key][0];
                    $data[$form_key][$key]['notice_date'] = $this->mydate->date_thai2eng($input['notice_date'][$form_key][0], -543);
                    $data[$form_key][$key]['banner_amount'] = str_replace(',', '', $input['banner_amount'][$form_key][0]);
                    $data[$form_key][$key]['tax_year'] = $input['tax_year'][$form_key][0];
    
    
                        // --- $form_key $key ----//

                    // $data[$form_key][$key]['ban'] = $input['ban'][$form_key][$key];
                    $data[$form_key][$key]['notice_mark'] = $input['notice_mark'][$form_key][$key];
                    $data[$form_key][$key]['noice_name_operation'] = $input['noice_name_operation'][$form_key][$key];
                    $data[$form_key][$key]['banner_type'] = $input['banner_type'][$form_key][$key];
                    $data[$form_key][$key]['notice_address_subdistrict'] = 50011300;
                    $data[$form_key][$key]['banner_width'] = str_replace(',', '', $input['banner_width'][$form_key][$key]);
                    $data[$form_key][$key]['banner_heigth'] = str_replace(',', '', $input['banner_heigth'][$form_key][$key]);
                    $data[$form_key][$key]['notice_estimate'] = str_replace(',', '', $input['notice_estimate'][$form_key][$key]);

                    $upload_path = APPPATH . '../assets/images/banner/';
                    if (!file_exists($upload_path)) mkdir($upload_path);
                    if (!$_FILES) redirect(base_url('receive/receive_dashborad'));
                    $this->load->library('upload', [
                        'upload_path' => $upload_path,
                        'allowed_types' => 'jpg|png'
                    ]);
                    if ($this->upload->do_upload('file')) {
                        $year = $this->session->userdata('year');
                        $this->Receive_model->insertNotice($year, $data);
                        redirect(base_url('receive/receive_dashborad'));

                    }



                }

            }
        }
        $year = $this->session->userdata('year');
        $this->Receive_model->insertNotice($year, $data);
        redirect(base_url('receive/receive_dashborad'));
        // echo '<pre>';
        // print_r($data);
        // exit;



    }

    public function receive_notice_update($id = '')
    {
        $data = array();
        $input = $this->input->post();
        // echo '<pre>';
        // print_r($input);

        foreach ($input['notice_number'] as $k => $value) {
            if (!empty($input['notice_number'][0][0])) {
                $form_key = 0;
                foreach ($input['notice_estimate'][$form_key] as $key => $v) {
                    $data[$form_key][$key]['notice_id'] = $input['notice_id'][$form_key][$key];

                    $data[$form_key][$key]['individual_id'] = $input['individual_id'][$form_key][0];
                    $data[$form_key][$key]['tax_id'] = 8;

                    $data[$form_key][$key]['notice_number'] = $input['notice_number'][$form_key][0];
                    $data[$form_key][$key]['notice_no'] = $input['notice_no'][$form_key][0];
                    $data[$form_key][$key]['notice_number_p2'] = $input['notice_number_p2'][$form_key][0];
                    $data[$form_key][$key]['notice_date'] = $this->mydate->date_thai2eng($input['notice_date'][$form_key][0], -543);
                    $data[$form_key][$key]['notice_date_p2'] = $this->mydate->date_thai2eng($input['notice_date_p2'][$form_key][0], -543);
                    $data[$form_key][$key]['notice_amount'] = str_replace(',', '', $input['notice_amount'][$form_key][0]);

                    // --- $form_key $key ----//
                    $data[$form_key][$key]['notice_address_number'] = $input['notice_address_number'][$form_key][$key];
                    $data[$form_key][$key]['land_deed_number'] = $input['land_deed_number'][$form_key][$key];
                    $data[$form_key][$key]['noice_name_operation_other'] = $input['noice_name_operation_other'][$form_key][$key];
                    $data[$form_key][$key]['notice_address_moo'] = $input['notice_address_moo'][$form_key][$key];
                    $data[$form_key][$key]['notice_address_subdistrict'] = 50011300;
                    $data[$form_key][$key]['notice_estimate'] = str_replace(',', '', $input['notice_estimate'][$form_key][$key]);
                    $data[$form_key][$key]['tax_year'] = $input['tax_year'][$form_key][$key];
                    $data[$form_key][$key]['noice_type_operation'] = $input['noice_type_operation'][$form_key][$key];
                    $data[$form_key][$key]['noice_name_operation'] = $input['noice_name_operation'][$form_key][$key];
                    $data[$form_key][$key]['notice_annual_fee'] = str_replace(',', '', $input['notice_annual_fee'][$form_key][$key]);

                }

            }
            if (!empty($input['notice_number'][1][0])) {
                $form_key = 1;
                foreach ($input['notice_estimate'][$form_key] as $key => $v) {
                    $data[$form_key][$key]['notice_id'] = $input['notice_id'][$form_key][$key];
                    $data[$form_key][$key]['individual_id'] = $input['individual_id'][$form_key][0];
                    $data[$form_key][$key]['tax_id'] = 9;

                    $data[$form_key][$key]['notice_number'] = $input['notice_number'][$form_key][0];
                    $data[$form_key][$key]['notice_date_p5'] = $this->mydate->date_thai2eng($input['notice_date_p5'][$form_key][0], -543);
                    $data[$form_key][$key]['notice_date'] = $this->mydate->date_thai2eng($input['notice_date'][$form_key][0], -543);
                    $data[$form_key][$key]['land_amount'] = str_replace(',', '', $input['land_amount'][$form_key][0]);

                    // --- $form_key $key ----//
                    $data[$form_key][$key]['land_deed_number'] = $input['land_deed_number'][$form_key][$key];
                    $data[$form_key][$key]['notice_mark'] = $input['notice_mark'][$form_key][$key];


                    $data[$form_key][$key]['notice_address_moo'] = $input['notice_address_moo'][$form_key][$key];
                    $data[$form_key][$key]['notice_address_subdistrict'] = 50011300;
                    $data[$form_key][$key]['land_rai'] = str_replace(',', '', $input['land_rai'][$form_key][$key]);
                    $data[$form_key][$key]['land_ngan'] = str_replace(',', '', $input['land_ngan'][$form_key][$key]);
                    $data[$form_key][$key]['land_wa'] = str_replace(',', '', $input['land_wa'][$form_key][$key]);
                    $data[$form_key][$key]['land_tax'] = str_replace(',', '', $input['land_tax'][$form_key][$key]);
                    $data[$form_key][$key]['notice_estimate'] = str_replace(',', '', $input['notice_estimate'][$form_key][$key]);
                    $data[$form_key][$key]['tax_year'] = $input['tax_year'][$form_key][$key];
                    $data[$form_key][$key]['tax_local_year'] = $input['tax_local_year'][$form_key][$key];
                }
            }
            if (!empty($input['notice_number'][2][0])) {
                $form_key = 2;
                foreach ($input['notice_estimate'][$form_key] as $key => $v) {
                    $data[$form_key][$key]['notice_id'] = $input['notice_id'][$form_key][$key];
                    $data[$form_key][$key]['individual_id'] = $input['individual_id'][$form_key][0];
                    $data[$form_key][$key]['tax_id'] = 10;

                    $data[$form_key][$key]['notice_number'] = $input['notice_number'][$form_key][0];
                    $data[$form_key][$key]['notice_date'] = $this->mydate->date_thai2eng($input['notice_date'][$form_key][0], -543);
                    $data[$form_key][$key]['banner_amount'] = str_replace(',', '', $input['banner_amount'][$form_key][0]);
                    $data[$form_key][$key]['tax_year'] = $input['tax_year'][$form_key][0];
    
    
                        // --- $form_key $key ----//
                    $data[$form_key][$key]['notice_mark'] = $input['notice_mark'][$form_key][$key];
                    $data[$form_key][$key]['noice_name_operation'] = $input['noice_name_operation'][$form_key][$key];
                    $data[$form_key][$key]['banner_type'] = $input['banner_type'][$form_key][$key];
                    $data[$form_key][$key]['notice_address_subdistrict'] = 50011300;
                    $data[$form_key][$key]['banner_width'] = str_replace(',', '', $input['banner_width'][$form_key][$key]);
                    $data[$form_key][$key]['banner_heigth'] = str_replace(',', '', $input['banner_heigth'][$form_key][$key]);
                    $data[$form_key][$key]['notice_estimate'] = str_replace(',', '', $input['notice_estimate'][$form_key][$key]);
                }

            }

        }
        foreach ($data as $form_key => $val_data) {
            foreach ($data[$form_key] as $key => $value) {
                // echo "------form " . $form_key . "------<br>";
                // echo '<pre>';
                // print_r($value);
                // echo '</pre>';

                if (($data[$form_key][$key]['notice_id'] != '')) {
                    $year = $this->session->userdata('year');
                    $this->Receive_model->updateNotice($year, $value);
                } else {
                        // echo ($form_key . ':' . $data[$form_key][$key]['notice_id']);
                    $year = $this->session->userdata('year');
                    $this->Receive_model->insertNoticeFormUpdate($year, $value);
                }

            }
        }




        redirect(base_url('receive/receive_dashborad'));

        // echo '<pre>';
        // print_r($data);
        // print_r($input);
        // exit;


    }



    public function receive_tax()
    {
        $data = array();
        //load mudule
        $data['individual'] = $this->Receive_model->read_receive();

        $this->config->set_item('title', 'ข้อมูลผู้เสียภาษี - เทศบาลตำบลหนองป่าครั่ง');
        $this->setView('receive_tax', $data);
         //load js
        //import input mark
        $this->template->javascript->add('assets/plugins/gentelella-master/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js');
        $this->template->javascript->add('assets/modules/receive/index.js');
        $this->publish();
    }


    //////////////////////////////// other_tax //////////////////////////

    public function other_tax()
    {
        $data = array();

        $year = $this->session->userdata('year');
        $data['other_tax'] = $this->Receive_model->getOtherTaxAll($year);
        $this->config->set_item('title', 'รายรับภาษีอื่น - เทศบาลตำบลหนองป่าครั่ง');
        // $this->template->javascript->add('assets/modules/receive/other_tax.js');
        $this->setView('other_tax', $data);
        $this->publish();
    }

    public function insert_other_tax()
    {
        $input = $this->input->post();

        $date = explode('/', $input['receive_date']);
        $input['receive_date'] = ($date[2] - 543) . $date[1] . $date[0];

        $value = str_replace(',', '', $this->input->post('receive_amount'));
        $input['receive_amount'] = $value;

        $year = $this->session->userdata('year');

        $this->Receive_model->insertOtherTax($year, $input);
        redirect(base_url('receive/other_tax'));
    }


    public function other_tax_edit($id = '')
    {
        $data = array();
        $data['other_tax'] = $this->Receive_model->read_OtherTax_update($id);


        $tax_allocate = $this->db->query("SELECT * FROM tbl_tax WHERE tax_parent_id = '2' ORDER BY tax_name");
        $tax_fine = $this->db->query("SELECT * FROM tbl_tax WHERE tax_parent_id = '3' ORDER BY tax_name");
        $tax_asset = $this->db->query("SELECT * FROM tbl_tax WHERE tax_parent_id = '4' ORDER BY tax_name");
        $tax_health = $this->db->query("SELECT * FROM tbl_tax WHERE tax_parent_id = '5' ORDER BY tax_name");
        $tax_miscellaneous = $this->db->query("SELECT * FROM tbl_tax WHERE tax_parent_id = '6' ORDER BY tax_name");
        $tax_subsidy = $this->db->query("SELECT * FROM tbl_tax WHERE tax_parent_id = '7' ORDER BY tax_name");


        $data['tax_allocate'] = $tax_allocate->result_array();
        $data['tax_fine'] = $tax_fine->result_array();
        $data['tax_asset'] = $tax_asset->result_array();
        $data['tax_health'] = $tax_health->result_array();
        $data['tax_miscellaneous'] = $tax_miscellaneous->result_array();
        $data['tax_subsidy'] = $tax_subsidy->result_array();


        $this->config->set_item('title', 'บันทึกรายรับภาษีอื่น - เทศบาลตำบลหนองป่าครั่ง');
        $this->setView('other_tax_edit', $data);
        $this->publish();

    }


    public function other_tax_add()
    {
        $data = array();

        $tax_allocate = $this->db->query("SELECT * FROM tbl_tax WHERE tax_parent_id = '2' ORDER BY tax_name");
        $tax_fine = $this->db->query("SELECT * FROM tbl_tax WHERE tax_parent_id = '3' ORDER BY tax_name");
        $tax_asset = $this->db->query("SELECT * FROM tbl_tax WHERE tax_parent_id = '4' ORDER BY tax_name");
        $tax_health = $this->db->query("SELECT * FROM tbl_tax WHERE tax_parent_id = '5' ORDER BY tax_name");
        $tax_miscellaneous = $this->db->query("SELECT * FROM tbl_tax WHERE tax_parent_id = '6' ORDER BY tax_name");
        $tax_subsidy = $this->db->query("SELECT * FROM tbl_tax WHERE tax_parent_id = '7' ORDER BY tax_name");

        $data['tax_allocate'] = $tax_allocate->result();
        $data['tax_fine'] = $tax_fine->result();
        $data['tax_asset'] = $tax_asset->result();
        $data['tax_health'] = $tax_health->result();
        $data['tax_miscellaneous'] = $tax_miscellaneous->result();
        $data['tax_subsidy'] = $tax_subsidy->result();

        $this->config->set_item('title', 'บันทึกรายรับภาษีอื่น - เทศบาลตำบลหนองป่าครั่ง');
        $this->setView('other_tax_add', $data);
        $this->publish();


    }

    //update other_tax
    public function update_other_tax()
    {
        $input = $this->input->post();
        $date = explode('/', $input['receive_date']);
        $input['receive_date'] = ($date[2] - 543) . $date[1] . $date[0];

        $value = str_replace(',', '', $this->input->post('receive_amount'));
        $input['receive_amount'] = $value;


        $year = $this->session->userdata('year');
        $this->Receive_model->updateOtherTax($year, $input);
        redirect(base_url('receive/other_tax'));
    }


    //delete other_tax
    public function receive_other_delete($id)
    {
        $this->Receive_model->del_other($id);
        redirect(base_url('receive/other_tax'));

    }
    

    


    //form individual
    public function receive_taxadd_popup($id = '')
    {
        $data = array();

        if (!empty($id)) {
            $data['individual'] = $this->Receive_model->read_receive($id);
            $amphur = substr($data['individual'][0]->individual_provice, 0, 2);
            $data['amphur'] = array();
            if ($amphur) {
                $query = $this->db->query("SELECT area_code,area_name_th FROM std_area WHERE area_type = 'Amphur' AND area_code LIKE '{$amphur}%' ");
                $data['amphur'] = $query->result();
            }


            $tambon = substr($data['individual'][0]->individual_district, 0, 4);
            $data['tambon'] = array();
            if ($tambon) {
                $query = $this->db->query("SELECT area_code,area_name_th FROM std_area WHERE area_type = 'Tambon' AND area_code LIKE '{$tambon}%'  ");
                $data['tambon'] = $query->result();
            }

            $amphur = substr($data['individual'][0]->individual_send_province, 0, 2);
            $data['send_amphur'] = array();
            if ($amphur) {
                $query = $this->db->query("SELECT area_code,area_name_th FROM std_area WHERE area_type = 'Amphur' AND area_code LIKE '{$amphur}%'  ");
                $data['send_amphur'] = $query->result();
            }


            $tambon = substr($data['individual'][0]->individual_send_district, 0, 4);
            $data['send_tambon'] = array();
            if ($tambon) {
                $query = $this->db->query("SELECT area_code,area_name_th FROM std_area WHERE area_type = 'Tambon' AND area_code LIKE '{$tambon}%'  ");
                $data['send_tambon'] = $query->result();
            }


        }

        $this->config->set_item('title', 'หน้าหลัก - เทศบาลตำบลหนองป่าครั่ง');

        // query get prename
        $query = $this->db->query("SELECT * FROM std_prename WHERE pren_status = 'Active'");
        $data['prename'] = $query->result();
        // query get prename
        $query = $this->db->query("SELECT area_code,area_name_th FROM std_area WHERE area_type = 'Province' ORDER BY area_name_th ");
        $data['province'] = $query->result();



        $this->template->stylesheet->add('assets/plugins/select2/dist/css/select2.css');
        $this->template->javascript->add('assets/plugins/select2/dist/js/select2.js');

        //import smartwizard
        $this->template->javascript->add('assets/plugins/gentelella-master/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js');
        //import input mark
        $this->template->javascript->add('assets/plugins/gentelella-master/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js');

        //load js
        $this->template->javascript->add('assets/modules/receive/taxadd.js');
        $this->setView('receive_taxadd_popup', $data);
        $this->publish();

    }

    //add or edit individual to db
    public function receive_taxadd_popup_save($id = '')
    {
        // check data individual tpye

        $data = array();

        $check_num = $this->input->post('individual_number');
        foreach ($check_num as $key => $value) {
            if (!empty($this->input->post('individual_number')[$key])) {
                $data['individual_type'] = $key + 1;
                $data['individual_number'] = $this->input->post('individual_number')[$key];
                $data['individual_prename'] = $this->input->post('individual_prename')[$key];
                $data['individual_fullname'] = $this->input->post('individual_firstname')[$key] . '' . $this->input->post('individual_lastname')[$key];
                $data['individual_firstname'] = $this->input->post('individual_firstname')[$key];
                $data['individual_lastname'] = $this->input->post('individual_lastname')[$key];
                $data['individual_address'] = $this->input->post('individual_address')[$key];
                $data['individual_village'] = $this->input->post('individual_village')[$key];
                $data['individual_road'] = $this->input->post('individual_road')[$key];
                $data['individual_lane'] = $this->input->post('individual_lane')[$key];
                $data['individual_provice'] = $this->input->post('individual_provice')[$key];
                $data['individual_district'] = $this->input->post('individual_district')[$key];
                $data['individual_subdistrict'] = $this->input->post('individual_subdistrict')[$key];
                $data['individual_zipcode'] = $this->input->post('individual_zipcode')[$key];

                $data['individual_send_address'] = $this->input->post('individual_send_address')[$key];
                $data['individual_send_village'] = $this->input->post('individual_send_village')[$key];
                $data['individual_send_road'] = $this->input->post('individual_send_road')[$key];
                $data['individual_send_lane'] = $this->input->post('individual_send_lane')[$key];
                $data['individual_send_province'] = $this->input->post('individual_send_province')[$key];
                $data['individual_send_district'] = $this->input->post('individual_send_district')[$key];
                $data['individual_send_subdistrict'] = $this->input->post('individual_send_subdistrict')[$key];
                $data['individual_send_zipcode'] = $this->input->post('individual_send_zipcode')[$key];
                $data['individual_phone'] = $this->input->post('individual_phone')[$key];
                $data['individual_business_name'] = $this->input->post('individual_business_name')[$key];

                //insert data individual
                if (!empty($id)) {
                    $status = $this->Receive_model->insertIndividual($data, $id);
                } else {
                    $status = $this->Receive_model->insertIndividual($data);
                }

            }
        }
        redirect(base_url('receive/receive_tax'));


    }

    //delete individual
    public function receive_tax_delete($id)
    {
        $this->Receive_model->del_individual($id);
        redirect(base_url('receive/receive_tax'));

    }

    public function receive_tax_pay()
    {
        $notice_number = '';
        $individual_number = '';
        $input = $this->input->post();
        if (!empty($input)) {
            $notice_number = $this->input->post('notice_number');
            $individual_number = $this->input->post('individual_number');
        }
  
    // print_r($this->input->post());
        $query = $this->Receive_model->receive_tax_pay($notice_number, $individual_number);

        $data = array();
        $data['receive_tax_pay'] = $query;
        
    //import input mark
        $this->template->javascript->add('assets/plugins/gentelella-master/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js');
        $this->config->set_item('title', 'หน้าหลัก - เทศบาลตำบลหนองป่าครั่ง');
        $this->setView('receive_tax_pay', $data);
        $this->publish();
    }

    public function search_tax_house()
    {
        $data = array();
        $this->config->set_item('title', 'ระบบบัญชีรายจ่าย - ค้นหาโครงการ');
        $this->template->javascript->add('assets/modules/receive/search_house.js');
        $this->setView('search_tax_house', $data);
        $this->publish();
    }

    public function getHouse()
    {
        $keyword = $this->input->post('keyword');
        $data['receive'] = $this->Receive_model->getTaxByKeywordHouse($keyword);
        $data['keyword'] = $keyword;


        $this->load->view('table_receive_house', $data);
    }



    public function receive_save_house()
    {
        $data = array();
        $this->template->javascript->add('assets/modules/receive/receive_tax_house.js');
        $this->config->set_item('title', 'ข้อมูลบันทึกรายรับ - เทศบาลตำบลหนองป่าครั่ง');
        $this->setView('receive_save_house', $data);
        $this->publish();
    }

        //delete Tax_house
    public function receive_house_delete($id)
    {
        $this->Receive_model->del_other($id);
        redirect(base_url('receive/receive_save_house'));

    }

    public function search_tax_local()
    {
        $data = array();
        $this->config->set_item('title', 'ระบบบัญชีรายจ่าย - ค้นหาโครงการ');
        $this->template->javascript->add('assets/modules/receive/search_local.js');
        $this->setView('search_tax_local', $data);
        $this->publish();
    }

    public function getLocal()
    {
        $keyword = $this->input->post('keyword');
        $data['receive'] = $this->Receive_model->getTaxByKeywordLocal($keyword);
        $data['keyword'] = $keyword;

        $this->load->view('table_receive_local', $data);
    }


    public function receive_save_local()
    {
        $data = array();
        $this->template->javascript->add('assets/modules/receive/receive_tax_local.js');
        $this->config->set_item('title', 'ข้อมูลบันทึกรายรับ - เทศบาลตำบลหนองป่าครั่ง');
        $this->setView('receive_save_local', $data);
        $this->publish();
    }

        //delete Tax_house
    public function receive_local_delete($id)
    {
        $this->Receive_model->del_other($id);
        redirect(base_url('receive/receive_save_local'));

    }

    public function search_tax_label()
    {
        $data = array();
        $this->config->set_item('title', 'ระบบบัญชีรายจ่าย - ค้นหาโครงการ');
        $this->template->javascript->add('assets/modules/receive/search_label.js');
        $this->setView('search_tax_label', $data);
        $this->publish();
    }

    public function getLabel()
    {
        $keyword = $this->input->post('keyword');
        $data['receive'] = $this->Receive_model->getTaxByKeywordLabel($keyword);
        $data['keyword'] = $keyword;

        $this->load->view('table_receive_label.php', $data);
    }



    public function receive_save_label()
    {
        $data = array();
        $this->template->javascript->add('assets/modules/receive/receive_tax_label.js');
        $this->config->set_item('title', 'ข้อมูลบันทึกรายรับ - เทศบาลตำบลหนองป่าครั่ง');
        $this->setView('receive_save_label', $data);
        $this->publish();
    }

        //delete Tax_house
    public function receive_label_delete($id)
    {
        $this->Receive_model->del_other($id);
        redirect(base_url('receive/receive_save_label'));

    }


    




    //get data json district
    public function getDistrict()
    {
        $province = $this->input->post('province');
        if (!empty($province)) {
            $province = substr($province, 0, 2);
            $query = $this->db->query("SELECT area_code,area_name_th FROM std_area WHERE area_type = 'Amphur' AND area_code LIKE '{$province}%' ");

            echo '<option value="">เลือก</option>';
            foreach ($query->result() as $value) {
                echo '<option value="' . $value->area_code . '">' . $value->area_name_th . '</option>';
            }

        }
        return false;
    }

    //get data json subdistrict
    public function getSubDistrict()
    {
        $district = $this->input->post('district');
        if (!empty($district)) {
            $district = substr($district, 0, 4);
            $query = $this->db->query("SELECT area_code,area_name_th FROM std_area WHERE area_type = 'Tambon' AND area_code LIKE '{$district}%' ");
            // if(!empty($query->result())){
            echo '<option value="">เลือก</option>';
            foreach ($query->result() as $value) {
                echo '<option value="' . $value->area_code . '">' . $value->area_name_th . '</option>';
            }
            // }else{
            //     return false;
            // }
        }
        return false;

    }

    public function getAjaxReceiveTax()
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
        $results = $this->Receive_model->getRecieveTaxAjax($param);

        $data['draw'] = $param['draw'];
        $data['recordsTotal'] = $results['count'];
        $data['recordsFiltered'] = $results['count_condition'];
        $data['data'] = $results['data'];
        $data['error'] = $results['error_message'];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
  //   import users to table indevidual form data house
  //   public function import_data_house(){
  //       //import module
  //       $this->load->model('import/import_model');
  //       $this->load->model('receive_model');

		// $dataTmp = $this->import_model->getTmpHouse();
  //       // change some data to type int
		// foreach ($dataTmp as $key => $value) {
		// 	$provice_id = $this->import_model->getProviceID($value->tmp_province_send);
		// 	$district_id = $this->import_model->getDistrictID($provice_id,$value->tmp_district_send);
		// 	$subdistrict_id = $this->import_model->getSubDistrictID($district_id,$value->tmp_subdistrict_send);

		// 	$dataTmp[$key]->provice_id_send = $provice_id;
		// 	$dataTmp[$key]->district_id_send = $district_id;
		// 	$dataTmp[$key]->subdistrict_id_send = $subdistrict_id;
  //       }

  //       //import data to table individual
  //       $dataImport = array();
  //       foreach ($dataTmp as $key => $value) {

  //           if (strlen($value->tmp_Identification) == 12){
  //               $dataImport['individual_type'] = 2;
  //           }else{
  //               $dataImport['individual_type'] = 1;
  //           }

  //           $dataImport['individual_prename'] = $value->tmp_prename;
  //           $dataImport['individual_fullname'] = $value->tmp_firstname .' '. $value->tmp_lastname;
  //           $dataImport['individual_firstname'] = $value->tmp_firstname;
  //           $dataImport['individual_lastname'] = $value->tmp_lastname;
  //           $dataImport['individual_number'] = $value->tmp_Identification;
  //           $dataImport['individual_address'] = $value->tmp_number;
  //           $dataImport['individual_village'] = $value->tmp_village;
  //           $dataImport['individual_subdistrict'] = $value->tmp_subdistrict;
  //           $dataImport['individual_send_address'] = $value->tmp_number_send;
  //           $dataImport['individual_send_village'] = $value->tmp_village_send;
  //           $dataImport['individual_send_road'] = $value->tmp_road_send;
  //           $dataImport['individual_send_lane'] = $value->tmp_lane_send;
  //           $dataImport['individual_send_province'] = $value->provice_id_send;
  //           $dataImport['individual_send_district'] = $value->district_id_send;
  //           $dataImport['individual_send_subdistrict'] = $value->subdistrict_id_send;
  //           $dataImport['individual_send_zipcode'] = $value->tmp_zipcode_send;
  //           $dataImport['individual_business_name'] = $value->tmp_type_business;

  //           //insert data to table
  //           $status = $this->receive_model->insertData($dataImport);

  //       }
  //       echo $status ;
  //           die();


  //   }

    public function import_data_label()
    {
        //import module
        $this->load->model('import/import_model');
        $this->load->model('receive_model');

        $dataTmp = $this->import_model->getTmpLabel();
        echo '<pre>';
        // change some data to type int
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
            $status = $this->receive_model->insertData($dataImport);

        }
        // echo $status ;
        //     die();


    }

    public function import_data_ward()
    {
        //import module
        $this->load->model('import/import_model');
        $this->load->model('receive_model');

        $dataTmp = $this->import_model->getTmpWard();
        echo '<pre>';
        // change some data to type int
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
            $status = $this->receive_model->insertData($dataImport);

        }
        echo $status;
        die();
    }

    public function outside()
    {

        $data = array();
        $this->config->set_item('title', 'ระบบรายรับนอกงบประมาณ - เทศบาลตำบลหนองป่าครั่ง');
        $this->template->javascript->add('assets/modules/receive/outside.js');
        $this->setView('outside', $data);
        $this->publish();
    }

    // //get prj
    public function getOut()
    {
        $data = $this->input->post('data');
        $status = $this->Outside_model->getOut($data);
        $this->json_publish($status);
    }

    // //insert project manage
    public function insertOutsidePlan()
    {

        $data = array();
        $id = $this->input->post('id');
        $hidden_level = $this->input->post('level');
        $edit = $this->input->post('edit');

        // $data['project_create'] = date('Y-m-d H:i:s');
        if ($edit == 'false') {


            if (!empty($id)) {
                $data['outside_parent'] = $id;
                $data['outside_level'] = 2;
            } else {
                $data['outside_level'] = 1;
            }
            if (!empty($hidden_level)) {
                $data['outside_level'] = $hidden_level;
            }

            $data['outside_title'] = $this->input->post('data');

            $status = $this->Outside_model->insertOutside($data);
        } else {

            $data['outside_title'] = $this->input->post('data');
            $status = $this->Outside_model->editOutside($id, $data);
        }


        $this->json_publish($status);
    }

    // //insert prj
    public function insertOutside()
    {
        $data = array();
        $tmp = $this->input->post('data');
        $id = $this->input->post('id');
        $edit = $this->input->post('edit');
        if ($edit == 'false') {
            foreach ($tmp as $key => $value) {
                $data[$value['name']] = $value['value'];
            }
            $data['out_create'] = date('Y-m-d H:i:s');

        } else {

            foreach ($tmp as $key => $value) {
                $data[$value['name']] = $value['value'];
            }
            $status = $this->Outside_model->insertOut($data, $id);
        }



        $this->json_publish($status);
    }

    // //delete prj
    public function delOut($id, $state = '')
    {
        $this->Outside_model->delOut($id, $state);
        redirect('receive/outside');
    }


    // //get data project_traing all
    public function getOutsideJson()
    {
        $data = array();
        $data_budget = ['', 'งบบุคลากร', 'งบดำเนินงาน', 'งบลงทุน', 'งบเงินอุดหนุน', 'งบกลาง'];
        $data_cost = [
            '', 'เงินเดือน (ฝ่ายการเมือง)', 'เงินเดือน (ฝ่ายประจำ)', 'ค่าตอบแทน', 'ค่าใช้สอย', 'ค่าวัสดุ', 'ค่าสาธารณูปโภค',
            'ค่าครุภัณฑ์', 'ค่าที่ดินและสิ่งก่อสร้าง', 'เงินอุดหนุน', 'งบกลาง'
        ];
        $values = $this->Outside_model->getOutside();
        $data['total'] = count($values);

        foreach ($values as $key => $value) {
            $data['rows'][$key]['id'] = $value->outside_id;
            $data['rows'][$key]['budget'] = '';
            $data['rows'][$key]['name'] = $value->outside_title;

            switch ($value->outside_level) {
                case '1':
                    $data['rows'][$key]['tools'] = "
                    <button  onClick='add_out(" . $value->outside_id . ")' class='btn btn-success' type='button'><i class='fa fa-plus'></i></button>
                    <button  onClick='outside_add_plan(" . $value->outside_id . "," . '"' . $value->outside_title . '"' . ")' id='outside_edit' class='btn btn-warning' type='button'><i class='fa fa-edit'></i></button>
                    <button  onClick='del_out(" . $value->outside_id . ")' id='outside_del' class='btn btn-danger' type='button'><i class='fa fa-trash'></i></button>";
                    break;
                case '2':
                    $data['rows'][$key]['tools'] = "
                    <button  onClick='outside_add(" . $value->outside_id . ")' class='btn btn-success' type='button'><i class='fa fa-plus'></i></button>
                    <button  onClick='outside_add_plan(" . $value->outside_id . "," . '"' . $value->outside_title . '"' . ")' id='outside_edit' class='btn btn-warning' type='button'><i class='fa fa-edit'></i></button>
                    <button  onClick='del_out(" . $value->outside_id . ")' id='outside_del' class='btn btn-danger' type='button'><i class='fa fa-trash'></i></button>";
                    break;
                case '3':
                    $data['rows'][$key]['name'] = $data_budget[$value->outside_title];

                    $data['rows'][$key]['tools'] = "
                    <button  onClick='outside_add_cost(" . $value->outside_id . ")' class='btn btn-success' type='button'><i class='fa fa-plus'></i></button>
                    <button  onClick='outside_add(" . $value->outside_id . "," . '"' . $value->outside_title . '"' . ")' id='outside_edit' class='btn btn-warning' type='button'><i class='fa fa-edit'></i></button>
                    <button  onClick='del_out(" . $value->outside_id . ")' id='outside_del' class='btn btn-danger' type='button'><i class='fa fa-trash'></i></button>";
                    break;

                default:
                    $data['rows'][$key]['name'] = $data_cost[$value->outside_title];

                    $data['rows'][$key]['tools'] = "
                    <button  onClick='add_out(" . $value->outside_id . ")' class='btn btn-success' type='button'><i class='fa fa-plus'></i></button>
                    <button  onClick='outside_add_cost(" . $value->outside_id . "," . '"' . $value->outside_title . '"' . ")' id='outside_edit' class='btn btn-warning' type='button'><i class='fa fa-edit'></i></button>
                    <button onClick='del_out(" . $value->outside_id . ")' id='outside_del' class='btn btn-danger' type='button'><i class='fa fa-trash'></i></button>";

                    break;
            }


            $data['rows'][$key]['_parentId'] = $value->outside_parent;


        }

        $out = $this->Outside_model->getOut();
        foreach ($out as $key => $value) {
            $data['rows'][$data['total'] + $key]['id'] = $value->out_id;
            $data['rows'][$data['total'] + $key]['budget'] = number_format($value->out_budget);
            $data['rows'][$data['total'] + $key]['name'] = "<p style='color:#73899f;'>" . $value->out_name . '</p>';
            $data['rows'][$data['total'] + $key]['tools'] = "
            <button  onClick='add_out(" . $value->out_id . ")' class='btn btn-success' type='button'><i class='fa fa-plus'></i></button>
            <button onClick='edit_out(" . $value->out_id . ")' id='outside_edit' class='btn btn-warning' type='button'><i class='fa fa-edit'></i></button>
            <button onClick='del_out(" . $value->out_id . "," . '"1"' . ")'  id='outside_del' class='btn btn-danger' type='button'><i class='fa fa-trash'></i></button>";
            $data['rows'][$data['total'] + $key]['_parentId'] = $value->out_parent;
            // $data['rows'][$data['total']+$key]['iconCls'] = 'icon-ok';

        }

        $this->json_publish($data);
    }

    public function getAjaxReceivedashborad()
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
        $results = $this->Receive_model->getRecieveDashboradAjax($param);

        $data['draw'] = $param['draw'];
        $data['recordsTotal'] = $results['count'];
        $data['recordsFiltered'] = $results['count_condition'];
        $data['data'] = $results['data'];
        $data['error'] = $results['error_message'];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function getAjaxReceived_tax_house()
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
        $results = $this->Receive_model->getRecieveTaxHouseAjax($param);

        $data['draw'] = $param['draw'];
        $data['recordsTotal'] = $results['count'];
        $data['recordsFiltered'] = $results['count_condition'];
        $data['data'] = $results['data'];
        $data['error'] = $results['error_message'];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function getAjaxReceived_tax_local()
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
        $results = $this->Receive_model->getRecieveTaxLocalAjax($param);

        $data['draw'] = $param['draw'];
        $data['recordsTotal'] = $results['count'];
        $data['recordsFiltered'] = $results['count_condition'];
        $data['data'] = $results['data'];
        $data['error'] = $results['error_message'];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }


    public function getAjaxReceived_tax_label()
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
        $results = $this->Receive_model->getRecieveTaxLabelAjax($param);

        $data['draw'] = $param['draw'];
        $data['recordsTotal'] = $results['count'];
        $data['recordsFiltered'] = $results['count_condition'];
        $data['data'] = $results['data'];
        $data['error'] = $results['error_message'];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function getAjaxOtherTax()
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
        $results = $this->Receive_model->getAjaxOtherTaxAjax($param);

        $data['draw'] = $param['draw'];
        $data['recordsTotal'] = $results['count'];
        $data['recordsFiltered'] = $results['count_condition'];
        $data['data'] = $results['data'];
        $data['error'] = $results['error_message'];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    function receive_tax_pay_add_house()
    {
        $id = $this->uri->segment(3);
        $query = $this->Receive_model->get_notic_one($id);
        $query2 = $this->Receive_model->get_receive_notice($id);
        foreach ($query2 as $key => $value) {
            list($y, $m, $d) = explode('-', $value['receive_date']);
            $query2[$key]['receive_date'] = "{$d}/{$m}/" . ($y + 543);
        }
        // print_r($query);

        $data = array();
        $data['tax_notice'] = $query;
        $data['tax_receive'] = $query2;

        $this->config->set_item('title', 'ชำระภาษี - เทศบาลตำบลหนองป่าครั่ง');
        $this->setView('receive_tax_pay_add_house', $data);
        $this->publish();
    }

    function recieve_tax_add_house()
    {
        $input = $this->input->post();
        list($d, $m, $y) = explode('/', $input['receive_date']);
        $y = $y - 543;
        $input['receive_date'] = "{$y}/{$m}/{$d}";
        // print_r($input);
        $year = $this->session->userdata('year');
        $this->Receive_model->recieve_tax_add($year, $input);
        redirect(base_url('receive/receive_save_house/'));
    }

    function receive_tax_pay_add_local()
    {
        $id = $this->uri->segment(3);
        $query = $this->Receive_model->get_notic_one($id);
        $query2 = $this->Receive_model->get_receive_notice($id);
        foreach ($query2 as $key => $value) {
            list($y, $m, $d) = explode('-', $value['receive_date']);
            $query2[$key]['receive_date'] = "{$d}/{$m}/" . ($y + 543);
        }
        // print_r($query);

        $data = array();
        $data['tax_notice'] = $query;
        $data['tax_receive'] = $query2;

        $this->config->set_item('title', 'ชำระภาษี - เทศบาลตำบลหนองป่าครั่ง');
        $this->setView('receive_tax_pay_add_local', $data);
        $this->publish();
    }

    function recieve_tax_add_local()
    {
        $input = $this->input->post();
        list($d, $m, $y) = explode('/', $input['receive_date']);
        $y = $y - 543;
        $input['receive_date'] = "{$y}/{$m}/{$d}";
        // print_r($input);
        $year = $this->session->userdata('year');
        $this->Receive_model->recieve_tax_add($year, $input);
        redirect(base_url('receive/receive_save_local/'));
    }

    function receive_tax_pay_add_label()
    {
        $id = $this->uri->segment(3);
        $query = $this->Receive_model->get_notic_one($id);
        $query2 = $this->Receive_model->get_receive_notice($id);
        foreach ($query2 as $key => $value) {
            list($y, $m, $d) = explode('-', $value['receive_date']);
            $query2[$key]['receive_date'] = "{$d}/{$m}/" . ($y + 543);
        }
        // print_r($query);

        $data = array();
        $data['tax_notice'] = $query;
        $data['tax_receive'] = $query2;

        $this->config->set_item('title', 'ชำระภาษี - เทศบาลตำบลหนองป่าครั่ง');
        $this->setView('receive_tax_pay_add_label', $data);
        $this->publish();
    }

    function recieve_tax_add_label()
    {
        $input = $this->input->post();
        list($d, $m, $y) = explode('/', $input['receive_date']);
        $y = $y - 543;
        $input['receive_date'] = "{$y}/{$m}/{$d}";
        // print_r($input);
        $year = $this->session->userdata('year');
        $this->Receive_model->recieve_tax_add($year, $input);
        redirect(base_url('receive/receive_save_label/'));
    }




}
