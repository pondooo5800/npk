<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Receive extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Receive_model');


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
    public function receive_notice_delete()
    {
        $input['status_note_del'] = $this->input->post('data');
        $input['notice_number'] = $this->input->post('id');
        $input['status'] = $this->input->post('status');

        $this->Receive_model->update_del_notice($input);
        redirect(base_url('receive/receive_dashborad'));

    }

    //delete receive_edit_delete
    public function receive_edit_delete_local($id, $individual_id, $tax_id)
    {
        $this->Receive_model->del_receive_edit_local($id, $individual_id, $tax_id);
        redirect(base_url('receive/receive_notice/' . $individual_id . '/' . $tax_id));
    }
    public function receive_edit_delete_label($id, $individual_id, $tax_id)
    {
        $this->Receive_model->del_receive_edit_label($id, $individual_id, $tax_id);
        redirect(base_url('receive/receive_notice/' . $individual_id . '/' . $tax_id));
    }
    public function receive_edit_delete_house($id, $individual_id, $tax_id)
    {
        $this->Receive_model->del_receive_edit_house($id, $individual_id, $tax_id);
        redirect(base_url('receive/receive_notice/' . $individual_id . '/' . $tax_id));
    }


    public function receive_notice($id = '', $tax_id)
    {

        $data = array();

        if (!empty($id)) {
            $data['notice'] = $this->Receive_model->getNoticeAll($id);

            foreach ($data['notice'] as $key => $notice) {
                $data['tax_notice'][$notice->tax_id][] = $notice;
            }
        }
        $data['tax_notice_read'] = $this->Receive_model->read_receive($id);
        $data['read_address'] = $this->Receive_model->read_address($id);

        $data['tax_notice_id'] = $this->Receive_model->getNoticeAll($id);
        $data['tax_id'] = $tax_id;

        $data['individual_subdistrict'] = $this->Receive_model->address($data['read_address'][0]['individual_subdistrict']);
        $data['individual_district'] = $this->Receive_model->address($data['read_address'][0]['individual_district']);
        $data['individual_provice'] = $this->Receive_model->address($data['read_address'][0]['individual_provice']);


        $query = $this->db->query("SELECT * FROM tbl_operation");
        $data['operation'] = $query->result();

        $query = $this->db->query("SELECT * FROM tbl_year");
        $data['years'] = $query->result();

        $query = $this->db->query("SELECT * FROM tbl_banner");
        $data['banner'] = $query->result();

        $query = $this->db->query("SELECT * FROM tbl_tax_year ORDER BY tax_year_id DESC");
        $data['tax_years'] = $query->result();


        $this->template->javascript->add('assets/modules/receive/alert_receive_add.js');
        $this->template->javascript->add('assets/modules/receive/receive_edit.js');


        $this->config->set_item('title', 'บันทึกรายการประเมิน - เทศบาลตำบลหนองป่าครั่ง');
        $this->setView('receive_edit', $data);
        $this->publish();

    }


    public function receive_notice_update($id = '')
    {
        $data = array();
        $input = $this->input->post();

        foreach ($input['notice_number'] as $k => $value) {
            if (!empty($input['notice_number'][0][0])) {
                $form_key = 0;
                foreach ($input['notice_estimate'][$form_key] as $key => $v) {
                    @$data[$form_key][$key]['notice_id'] = $input['notice_id'][$form_key][$key];
                    $data[$form_key][$key]['individual_id'] = $input['individual_id'][$form_key][0];
                    $data[$form_key][$key]['tax_id'] = 8;
                    $data[$form_key][$key]['total_estimate'] = str_replace(',', '', $input['total_estimate'][$form_key][0]);
                    $data[$form_key][$key]['tax_interest'] = str_replace(',', '', $input['tax_interest'][$form_key][0]);
                    $data[$form_key][$key]['sum_amount_tax'] = str_replace(',', '', $input['sum_amount_tax'][$form_key][0]);


                    $data[$form_key][$key]['notice_number'] = $input['notice_number'][$form_key][0];
                    $data[$form_key][$key]['notice_no'] = $input['notice_no'][$form_key][0];
                    $data[$form_key][$key]['notice_number_p8'] = $input['notice_number_p8'][$form_key][0];
                    $data[$form_key][$key]['notice_date'] = $this->mydate->date_thai2eng($input['notice_date'][$form_key][0], -543);
                    $data[$form_key][$key]['notice_date_p2'] = $this->mydate->date_thai2eng($input['notice_date_p2'][$form_key][0], -543);
                    $data[$form_key][$key]['notice_amount'] = str_replace(',', '', $input['notice_amount'][$form_key][0]);

                    // --- $form_key $key ----//
                    $data[$form_key][$key]['notice_address_number'] = $input['notice_address_number'][$form_key][$key];
                    $data[$form_key][$key]['land_deed_number'] = $input['land_deed_number'][$form_key][$key];
                    if(!empty($input['noice_name_operation_other'][$form_key][$key])){
                      $data[$form_key][$key]['noice_name_operation_other'] = $input['noice_name_operation_other'][$form_key][$key];
                    }
                    else{
                      $data[$form_key][$key]['noice_name_operation_other'] = "";
                    }
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
                    @$data[$form_key][$key]['notice_id'] = $input['notice_id'][$form_key][$key];
                    $data[$form_key][$key]['individual_id'] = $input['individual_id'][$form_key][0];
                    $data[$form_key][$key]['tax_id'] = 9;
                    $data[$form_key][$key]['total_estimate'] = str_replace(',', '', $input['total_estimate'][$form_key][0]);
                    $data[$form_key][$key]['tax_interest'] = str_replace(',', '', $input['tax_interest'][$form_key][0]);
                    $data[$form_key][$key]['sum_amount_tax'] = str_replace(',', '', $input['sum_amount_tax'][$form_key][0]);


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
                    @$data[$form_key][$key]['notice_id'] = $input['notice_id'][$form_key][$key];
                    $data[$form_key][$key]['individual_id'] = $input['individual_id'][$form_key][0];
                    $data[$form_key][$key]['tax_id'] = 10;
                    $data[$form_key][$key]['total_estimate'] = str_replace(',', '', $input['total_estimate'][$form_key][0]);
                    $data[$form_key][$key]['tax_interest'] = str_replace(',', '', $input['tax_interest'][$form_key][0]);
                    $data[$form_key][$key]['sum_amount_tax'] = str_replace(',', '', $input['sum_amount_tax'][$form_key][0]);


                    $data[$form_key][$key]['notice_number'] = $input['notice_number'][$form_key][0];
                    $data[$form_key][$key]['notice_date'] = $this->mydate->date_thai2eng($input['notice_date'][$form_key][0], -543);
                    $data[$form_key][$key]['banner_amount'] = str_replace(',', '', $input['banner_amount'][$form_key][0]);
                    $data[$form_key][$key]['tax_year'] = $input['tax_year'][$form_key][0];


                        // --- $form_key $key ----//
                    $data[$form_key][$key]['notice_mark'] = $input['notice_mark'][$form_key][$key];
                    @$data[$form_key][$key]['noice_name_operation'] = $input['noice_name_operation'][$form_key][$key];
                    $data[$form_key][$key]['banner_type'] = $input['banner_type'][$form_key][$key];
                    $data[$form_key][$key]['notice_address_subdistrict'] = 50011300;
                    $data[$form_key][$key]['banner_width'] = str_replace(',', '', $input['banner_width'][$form_key][$key]);
                    $data[$form_key][$key]['banner_heigth'] = str_replace(',', '', $input['banner_heigth'][$form_key][$key]);
                    $data[$form_key][$key]['notice_estimate'] = str_replace(',', '', $input['notice_estimate'][$form_key][$key]);
                    if($k==2){
                      $upload_path = './assets/uploads/images/banner/';
                      if(!empty($input['banner_image'.$key])){
                        $upload_imgae[$key] = $this->upload_image('banner_image' . $key, $upload_path);
                        $data[$form_key][$key]['banner_image'] = $upload_imgae[$key]['target_name'];
                      }
                    }
                }
            }
        }
        foreach (@$input["delete"] as $delete) {
          $this->Receive_model->del_receive_edit_label($delete, $input['individual_id'][$form_key][0], $data[$form_key][$key]['tax_id']);
        }
        foreach ($data as $form_key => $val_data) {
            foreach ($data[$form_key] as $key => $value) {

                if (isset($data[$form_key][$key]['notice_id'])) {
                    if ((@$upload_imgae[$key]['target_name'] != '')) {
                        $year = $this->session->userdata('year');
						#echo '<hr>';
						echo 'update year<br>';
						#print_r($value);
                          $this->Receive_model->updateNotice($year, $value);

                    } else {
                        unset($value['banner_image']);
						#echo '<hr>';
						#echo 'update banner_image<br>';
                        $year = $this->session->userdata('year');
						#print_r($value);
                          $this->Receive_model->updateNotice($year, $value);
                    }
                } else {
						echo '<hr>';
					#echo 'insert<br>';
                    $year = $this->session->userdata('year');
					#print_r($value);
                    $this->Receive_model->insertNoticeFormUpdate($year, $value);
                }
            }
        }
 
        //$this->Receive_model->del_receive_edit_label($id, $individual_id, $tax_id);

        redirect(base_url('receive/receive_dashborad'));
    }

    public function upload_image($image_name, $upload_path = '')
    {
        $target_file = basename($_FILES[$image_name]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image

        // Check file size
        if ($_FILES[$image_name]["size"] > 5000000) {
            $message = "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $message = "Sorry, your file was not uploaded.";
            $target_file_name="";
        // if everything is ok, try to upload file
        } else {
            $target_file_name = time() . '_' . rand() . '.' . $imageFileType;
            if (move_uploaded_file($_FILES[$image_name]["tmp_name"], $upload_path . $target_file_name)) {
                $message = "The file " . $target_file_name . " has been uploaded.";
            } else {
                $message = "Sorry, there was an error uploading your file.";
                $uploadOk = 0;
            }
        }
        $output = array('message' => $message, 'status' => $uploadOk, 'target_name' => $target_file_name);
        return $output;


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
        $this->template->javascript->add('assets/modules/receive/other_tax.js');

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
        $sql_user = "SELECT
                    usrm_user.user_id,
                     std_prename.prename_th,
                     usrm_user.user_firstname,
                     usrm_user.user_lastname
                    FROM usrm_user INNER JOIN std_prename ON usrm_user.user_prename = std_prename.pren_id
                    ";
        $receive_user = $this->db->query($sql_user);

        $data['tax_allocate'] = $tax_allocate->result_array();
        $data['tax_fine'] = $tax_fine->result_array();
        $data['tax_asset'] = $tax_asset->result_array();
        $data['tax_health'] = $tax_health->result_array();
        $data['tax_miscellaneous'] = $tax_miscellaneous->result_array();
        $data['tax_subsidy'] = $tax_subsidy->result_array();
        $data['receive_user'] = $receive_user->result();


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
        $sql_user = "SELECT
                    usrm_user.user_id,
                	   std_prename.prename_th,
                	   usrm_user.user_firstname,
                	   usrm_user.user_lastname
                    FROM usrm_user INNER JOIN std_prename ON usrm_user.user_prename = std_prename.pren_id
                    ";
        $receive_user = $this->db->query($sql_user);

        $data['tax_allocate'] = $tax_allocate->result();
        $data['tax_fine'] = $tax_fine->result();
        $data['tax_asset'] = $tax_asset->result();
        $data['tax_health'] = $tax_health->result();
        $data['tax_miscellaneous'] = $tax_miscellaneous->result();
        $data['tax_subsidy'] = $tax_subsidy->result();
        $data['receive_user'] = $receive_user->result();

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


        //load js
        $this->template->javascript->add('assets/modules/receive/alert_receive_tax.js');
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
                $data['code_name'] = $this->input->post('code_name')[$key];
                $data['individual_number'] = $this->input->post('individual_number')[$key];
                $data['individual_prename'] = $this->input->post('individual_prename')[$key];
                $data['individual_fullname'] = $this->input->post('individual_firstname')[$key] . ' ' . $this->input->post('individual_lastname')[$key];
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
        //$results_1 = $this->Receive_model->getNoticeTax(217);
        //echo 'results_1' . $results_1[0]->count_notice;
        /*echo "<pre>";
        print_r($results);
        echo "</pre>";*/


        $data['draw'] = $param['draw'];
        $data['recordsTotal'] = $results['count'];
        $data['recordsFiltered'] = $results['count_condition'];
        $data['data'] = $results['data'];
        $data['error'] = $results['error_message'];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }


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
        if ($this->input->get("columns")) {
            foreach ($this->input->get("columns") as $key => $value) {
                $filter[] = $value['search']['value'];
            }
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
        $tax_id = $this->uri->segment(4);
        $receive_id = $this->uri->segment(5);

        $query = $this->Receive_model->get_receive_pay($id, $tax_id);
        $query2 = $this->Receive_model->get_house_pay($id);

        $data = array();
        $data['tax_notice'] = $query;
        $data['tax_receive'] = $query2;
        $data['tabel_pay'] = $this->Receive_model->tabel_pay_house($id, $receive_id);
        $data['individual_subdistrict'] = $this->Receive_model->address($data['tax_notice'][0]['individual_subdistrict']);
        $data['individual_district'] = $this->Receive_model->address($data['tax_notice'][0]['individual_district']);
        $data['individual_provice'] = $this->Receive_model->address($data['tax_notice'][0]['individual_provice']);

        $this->config->set_item('title', 'ชำระภาษี - เทศบาลตำบลหนองป่าครั่ง');
        $this->template->javascript->add('assets/modules/receive/tax_pay.js');
        $this->setView('receive_tax_pay_add_house', $data);
        $this->publish();
    }

    function recieve_tax_add_house()
    {
        $input = $this->input->post();

        $date = explode('/', $input['receive_date']);
        $input['receive_date'] = ($date[2] - 543) . $date[1] . $date[0];

        $value = str_replace(',', '', $this->input->post('amount'));
        $input['amount'] = $value;


        $value = str_replace(',', '', $this->input->post('receive_amount'));
        $input['receive_amount'] = $value;

        $value = str_replace(',', '', $this->input->post('interest'));
        $input['interest'] = $value;

        $value = str_replace(',', '', $this->input->post('sum_amount'));
        $input['sum_amount'] = $value;

        $value = str_replace(',', '', $this->input->post('balance'));
        $input['balance'] = $value;

        $year = $this->session->userdata('year');
        $this->Receive_model->recieve_tax_add($year, $input);
        redirect(base_url('receive/receive_save_house/'));

    }

    function receive_tax_pay_edit_house()
    {
        $id = $this->uri->segment(3);
        $tax_id = $this->uri->segment(4);
        $receive_id = $this->uri->segment(5);
        $query = $this->Receive_model->get_receive_pay($id, $tax_id);
        $query2 = $this->Receive_model->get_house_pay($id);


        $data = array();
        $data['tax_notice'] = $query;
        $data['tax_receive'] = $query2;
        $data['tax_pay'] = $this->Receive_model->read_Tax_House($id, $receive_id);
		
		
        $data['tax_tabel_pay'] = $this->Receive_model->read_Tax_House_Pay($id, $receive_id);
        $data['tabel_pay'] = $this->Receive_model->tabel_pay_house($id, $receive_id);
        $data['individual_subdistrict'] = $this->Receive_model->address($data['tax_notice'][0]['individual_subdistrict']);
        $data['individual_district'] = $this->Receive_model->address($data['tax_notice'][0]['individual_district']);
        $data['individual_provice'] = $this->Receive_model->address($data['tax_notice'][0]['individual_provice']);

 

        $this->config->set_item('title', 'ชำระภาษี - เทศบาลตำบลหนองป่าครั่ง');
        $this->template->javascript->add('assets/modules/receive/tax_pay.js');
        $this->setView('receive_tax_pay_edit_house', $data);
        $this->publish();
    }

    function recieve_tax_update_house()
    {
        $input = $this->input->post();
        $date = explode('/', $input['receive_date']);
        $input['receive_date'] = ($date[2] - 543) . $date[1] . $date[0];

        $value = str_replace(',', '', $this->input->post('amount'));
        $input['amount'] = $value;


        $value = str_replace(',', '', $this->input->post('receive_amount'));
        $input['receive_amount'] = $value;

        $value = str_replace(',', '', $this->input->post('interest'));
        $input['interest'] = $value;

        $value = str_replace(',', '', $this->input->post('sum_amount'));
        $input['sum_amount'] = $value;

        $value = str_replace(',', '', $this->input->post('balance'));
        $input['balance'] = $value;

        $year = $this->session->userdata('year');
        $this->Receive_model->updateReceiveTax($year, $input);
        redirect(base_url('receive/receive_save_house'));

    }


    function receive_tax_pay_add_local()
    {
        $id = $this->uri->segment(3);
        $tax_id = $this->uri->segment(4);
        $receive_id = $this->uri->segment(5);
        $query = $this->Receive_model->get_receive_pay($id, $tax_id);
        $query2 = $this->Receive_model->get_local_pay($id);
        $query3 = $this->Receive_model->tabel_pay_local($id, $receive_id);



        $data = array();
        $data['tax_notice'] = $query;
        $data['tax_receive'] = $query2;
        $data['tabel_pay'] = $query3;
        $data['individual_subdistrict'] = $this->Receive_model->address($data['tax_notice'][0]['individual_subdistrict']);
        $data['individual_district'] = $this->Receive_model->address($data['tax_notice'][0]['individual_district']);
        $data['individual_provice'] = $this->Receive_model->address($data['tax_notice'][0]['individual_provice']);




        $query = $this->db->query("SELECT * FROM tbl_tax_year ORDER BY tax_year_id DESC");
        $data['tax_years'] = $query->result();


        $this->config->set_item('title', 'ชำระภาษี - เทศบาลตำบลหนองป่าครั่ง');
        $this->template->javascript->add('assets/modules/receive/tax_pay.js');
        $this->setView('receive_tax_pay_add_local', $data);
        $this->publish();
    }

    function recieve_tax_add_local()
    {
        $input = $this->input->post();
        $date = explode('/', $input['receive_date']);
        $input['receive_date'] = ($date[2] - 543) . $date[1] . $date[0];

        $value = str_replace(',', '', $this->input->post('amount'));
        $input['amount'] = $value;


        $value = str_replace(',', '', $this->input->post('receive_amount'));
        $input['receive_amount'] = $value;

        $value = str_replace(',', '', $this->input->post('interest'));
        $input['interest'] = $value;

        $value = str_replace(',', '', $this->input->post('sum_amount'));
        $input['sum_amount'] = $value;

        $value = str_replace(',', '', $this->input->post('balance'));
        $input['balance'] = $value;


        $year = $this->session->userdata('year');
        $this->Receive_model->recieve_tax_add($year, $input);
        redirect(base_url('receive/receive_save_local/'));
    }

    function receive_tax_pay_edit_local()
    {
        $id = $this->uri->segment(3);
        $tax_id = $this->uri->segment(4);
        $receive_id = $this->uri->segment(5);

        $query = $this->Receive_model->get_receive_pay($id, $tax_id);
        $query2 = $this->Receive_model->get_local_pay($id);

		 
        $data = array();
        $data['tax_notice'] = $query;
        $data['tax_receive'] = $query2;
        $data['tax_pay'] = $this->Receive_model->read_Tax_Local($id, $receive_id);
		
	#	$dat = $this->Receive_model->read_Tax_Local($id, $receive_id);; 
		 
        $data['tax_tabel_pay'] = $this->Receive_model->read_Tax_Local_Pay($id, $receive_id);
        $data['tabel_pay'] = $this->Receive_model->tabel_pay_local($id, $receive_id);
        $data['individual_subdistrict'] = $this->Receive_model->address($data['tax_notice'][0]['individual_subdistrict']);
        $data['individual_district'] = $this->Receive_model->address($data['tax_notice'][0]['individual_district']);
        $data['individual_provice'] = $this->Receive_model->address($data['tax_notice'][0]['individual_provice']);


        $query = $this->db->query("SELECT * FROM tbl_tax_year ORDER BY tax_year_id DESC");
        $data['tax_years'] = $query->result();




        $this->config->set_item('title', 'ชำระภาษี - เทศบาลตำบลหนองป่าครั่ง');
        $this->template->javascript->add('assets/modules/receive/tax_pay.js');
        $this->setView('receive_tax_pay_edit_local', $data);
        $this->publish();
    }

    function recieve_tax_update_local()
    {
        $input = $this->input->post();
        $date = explode('/', $input['receive_date']);
        $input['receive_date'] = ($date[2] - 543) . $date[1] . $date[0];

        $value = str_replace(',', '', $this->input->post('amount'));
        $input['amount'] = $value;


        $value = str_replace(',', '', $this->input->post('receive_amount'));
        $input['receive_amount'] = $value;

        $value = str_replace(',', '', $this->input->post('interest'));
        $input['interest'] = $value;

        $value = str_replace(',', '', $this->input->post('sum_amount'));
        $input['sum_amount'] = $value;

        $value = str_replace(',', '', $this->input->post('balance'));
        $input['balance'] = $value;

        $year = $this->session->userdata('year');
        $this->Receive_model->updateReceiveTax($year, $input);
        redirect(base_url('receive/receive_save_local'));

    }



    function receive_tax_pay_add_label()
    {
        $id = $this->uri->segment(3);
        $tax_id = $this->uri->segment(4);
        $receive_id = $this->uri->segment(5);

        $query = $this->Receive_model->get_receive_pay($id, $tax_id);
        $query2 = $this->Receive_model->get_label_pay($id);


        $data = array();
        $data['tax_notice'] = $query;
        $data['tax_receive'] = $query2;
        $data['tabel_pay'] = $this->Receive_model->tabel_pay_label($id, $receive_id);
        $data['individual_subdistrict'] = $this->Receive_model->address($data['tax_notice'][0]['individual_subdistrict']);
        $data['individual_district'] = $this->Receive_model->address($data['tax_notice'][0]['individual_district']);
        $data['individual_provice'] = $this->Receive_model->address($data['tax_notice'][0]['individual_provice']);



        $this->config->set_item('title', 'ชำระภาษี - เทศบาลตำบลหนองป่าครั่ง');
        $this->template->javascript->add('assets/modules/receive/tax_pay.js');
        $this->setView('receive_tax_pay_add_label', $data);
        $this->publish();
    }

    function recieve_tax_add_label()
    {
        $input = $this->input->post();

        $date = explode('/', $input['receive_date']);
        $input['receive_date'] = ($date[2] - 543) . $date[1] . $date[0];

        $value = str_replace(',', '', $this->input->post('amount'));
        $input['amount'] = $value;


        $value = str_replace(',', '', $this->input->post('receive_amount'));
        $input['receive_amount'] = $value;

        $value = str_replace(',', '', $this->input->post('interest'));
        $input['interest'] = $value;

        $value = str_replace(',', '', $this->input->post('sum_amount'));
        $input['sum_amount'] = $value;

        $value = str_replace(',', '', $this->input->post('balance'));
        $input['balance'] = $value;

        $year = $this->session->userdata('year');
        $this->Receive_model->recieve_tax_add($year, $input);
        redirect(base_url('receive/receive_save_label/'));
    }

    function receive_tax_pay_edit_label()
    {
        $id = $this->uri->segment(3);
        $tax_id = $this->uri->segment(4);
        $receive_id = $this->uri->segment(5);

        $query = $this->Receive_model->get_receive_pay($id, $tax_id);
        $query2 = $this->Receive_model->get_label_pay($id);


        $data = array();
        $data['tax_notice'] = $query;
        $data['tax_receive'] = $query2;
        $data['tax_pay'] = $this->Receive_model->read_Tax_Label($id, $receive_id);
        $data['tax_tabel_pay'] = $this->Receive_model->read_Tax_Label_Pay($id, $receive_id);
        $data['tabel_pay'] = $this->Receive_model->tabel_pay_label($id, $receive_id);
        $data['individual_subdistrict'] = $this->Receive_model->address($data['tax_notice'][0]['individual_subdistrict']);
        $data['individual_district'] = $this->Receive_model->address($data['tax_notice'][0]['individual_district']);
        $data['individual_provice'] = $this->Receive_model->address($data['tax_notice'][0]['individual_provice']);



        $this->config->set_item('title', 'ชำระภาษี - เทศบาลตำบลหนองป่าครั่ง');
        $this->template->javascript->add('assets/modules/receive/tax_pay.js');
        $this->setView('receive_tax_pay_edit_label', $data);
        $this->publish();
    }

    function recieve_tax_update_label()
    {
        $input = $this->input->post();
        $date = explode('/', $input['receive_date']);
        $input['receive_date'] = ($date[2] - 543) . $date[1] . $date[0];

        $value = str_replace(',', '', $this->input->post('amount'));
        $input['amount'] = $value;


        $value = str_replace(',', '', $this->input->post('receive_amount'));
        $input['receive_amount'] = $value;

        $value = str_replace(',', '', $this->input->post('interest'));
        $input['interest'] = $value;

        $value = str_replace(',', '', $this->input->post('sum_amount'));
        $input['sum_amount'] = $value;

        $value = str_replace(',', '', $this->input->post('balance'));
        $input['balance'] = $value;

        $year = $this->session->userdata('year');
        $this->Receive_model->updateReceiveTax($year, $input);
        redirect(base_url('receive/receive_save_label'));

    }




    //get data tax alert
    public function getalert()
    {
        $data = $this->input->post('data');
        $result['data'] = $this->Receive_model->getAlert($data);
        $this->load->view('tax_alert', $result);

    }

    public function savealert()
    {
        $data['alert_date'] = $this->mydate->date_thai2eng($this->input->post('data'));
        $data['notice_id'] = $this->input->post('notice');
        $data['agent_id'] = $_SESSION['user_id'];
        //check alert No.
        $number = $this->Receive_model->getAlert($data['notice_id']);
        $data['alert_order'] = (count($number) + 1);
        $result['id'] = $this->Receive_model->saveAlert($data);
        $result['id'] = $data['notice_id'];
        $this->output->set_content_type('application/json')->set_output(json_encode($result));

    }

    public function delAlert()
    {
        $id = $this->input->post('id');
        $result['id'] = $this->input->post('notice');

        $status = $this->Receive_model->delAlert($id);
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

    public function checkDupIndividual()
    {
        $data = $this->input->post('data');
        $result = $this->Receive_model->checkDupIndividual($data);
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

}

    // public function receive_add($id = '')
    // {
    //     $data = array();

    //     $id = $this->uri->segment(3);
    //     // $query = $this->Receive_model->get_notic_one($id);
    //     // $data['tax_notice'] = $query;

    //     $data['tax_notice'] = $this->Receive_model->read_receive($id);

    //     $query = $this->db->query("SELECT * FROM tbl_operation");
    //     $data['operation'] = $query->result();

    //     $query = $this->db->query("SELECT * FROM tbl_year");
    //     $data['years'] = $query->result();

    //     $query = $this->db->query("SELECT * FROM tbl_tax_year ORDER BY tax_year_id DESC");
    //     $data['tax_years'] = $query->result();


    //     $query = $this->db->query("SELECT * FROM tbl_banner");
    //     $data['banner'] = $query->result();

    //     $this->template->javascript->add('assets/modules/receive/alert_receive_add.js');
    //     $this->config->set_item('title', 'หน้าหลัก - เทศบาลตำบลหนองป่าครั่ง');
    //     $this->setView('receive_add', $data);
    //     $this->publish();
    // }

    // public function receive_notice_save($id = '')
    // {
    //     $data = array();
    //     $input = $this->input->post();

    //     foreach ($input['notice_number'] as $k => $value) {
    //         for ($form_key = 0; $form_key < 3; $form_key++) {
    //             if (!empty($input['notice_number'][0][0])) {
    //                 if ($form_key == 0) {
    //                     foreach ($input['notice_estimate'][0] as $key => $v) {
    //                         $data[$form_key][$key]['individual_id'] = $input['individual_id'][$form_key][0];
    //                         $data[$form_key][$key]['tax_id'] = 8;
    //                         $data[$form_key][$key]['total_estimate'] = str_replace(',', '', $input['total_estimate'][$form_key][0]);
    //                         $data[$form_key][$key]['tax_interest'] = str_replace(',', '', $input['tax_interest'][$form_key][0]);
    //                         $data[$form_key][$key]['sum_amount_tax'] = str_replace(',', '', $input['sum_amount_tax'][$form_key][0]);



    //                         $data[$form_key][$key]['notice_number'] = $input['notice_number'][$form_key][0];
    //                         $data[$form_key][$key]['notice_no'] = $input['notice_no'][$form_key][0];
    //                         $data[$form_key][$key]['notice_number_p2'] = $input['notice_number_p2'][$form_key][0];
    //                         $data[$form_key][$key]['notice_date'] = $this->mydate->date_thai2eng($input['notice_date'][$form_key][0], -543);
    //                         $data[$form_key][$key]['notice_date_p2'] = $this->mydate->date_thai2eng($input['notice_date_p2'][$form_key][0], -543);
    //                         $data[$form_key][$key]['notice_amount'] = str_replace(',', '', $input['notice_amount'][$form_key][0]);

    //                 // --- $form_key $key ----//
    //                         $data[$form_key][$key]['land_deed_number'] = $input['land_deed_number'][$form_key][$key];
    //                         $data[$form_key][$key]['noice_name_operation_other'] = $input['noice_name_operation_other'][$form_key][$key];
    //                         $data[$form_key][$key]['notice_address_number'] = $input['notice_address_number'][$form_key][$key];
    //                         $data[$form_key][$key]['notice_address_moo'] = $input['notice_address_moo'][$form_key][$key];
    //                         $data[$form_key][$key]['notice_address_subdistrict'] = 50011300;
    //                         $data[$form_key][$key]['notice_estimate'] = str_replace(',', '', $input['notice_estimate'][$form_key][$key]);
    //                         $data[$form_key][$key]['tax_year'] = $input['tax_year'][$form_key][$key];
    //                         $data[$form_key][$key]['noice_type_operation'] = $input['noice_type_operation'][$form_key][$key];
    //                         $data[$form_key][$key]['noice_name_operation'] = $input['noice_name_operation'][$form_key][$key];
    //                         $data[$form_key][$key]['notice_annual_fee'] = str_replace(',', '', $input['notice_annual_fee'][$form_key][$key]);

    //                     }
    //                 }

    //             }
    //             if (!empty($input['notice_number'][1][0])) {
    //                 if ($form_key == 1) {
    //                     foreach ($input['notice_estimate'][1] as $key => $v) {
    //                         $data[$form_key][$key]['individual_id'] = $input['individual_id'][$form_key][0];
    //                         $data[$form_key][$key]['tax_id'] = 9;
    //                         $data[$form_key][$key]['tax_interest'] = str_replace(',', '', $input['tax_interest'][$form_key][0]);
    //                         $data[$form_key][$key]['sum_amount_tax'] = str_replace(',', '', $input['sum_amount_tax'][$form_key][0]);



    //                         $data[$form_key][$key]['notice_number'] = $input['notice_number'][$form_key][0];
    //                         $data[$form_key][$key]['notice_date_p5'] = $this->mydate->date_thai2eng($input['notice_date_p5'][$form_key][0], -543);
    //                         $data[$form_key][$key]['notice_date'] = $this->mydate->date_thai2eng($input['notice_date'][$form_key][0], -543);
    //                         $data[$form_key][$key]['land_amount'] = str_replace(',', '', $input['land_amount'][$form_key][0]);

    //                 // --- $form_key $key ----//
    //                         $data[$form_key][$key]['land_deed_number'] = $input['land_deed_number'][$form_key][$key];
    //                         $data[$form_key][$key]['notice_mark'] = $input['notice_mark'][$form_key][$key];


    //                         $data[$form_key][$key]['notice_address_moo'] = $input['notice_address_moo'][$form_key][$key];
    //                         $data[$form_key][$key]['notice_address_subdistrict'] = 50011300;
    //                         $data[$form_key][$key]['land_rai'] = str_replace(',', '', $input['land_rai'][$form_key][$key]);
    //                         $data[$form_key][$key]['land_ngan'] = str_replace(',', '', $input['land_ngan'][$form_key][$key]);
    //                         $data[$form_key][$key]['land_wa'] = str_replace(',', '', $input['land_wa'][$form_key][$key]);
    //                         $data[$form_key][$key]['land_tax'] = str_replace(',', '', $input['land_tax'][$form_key][$key]);
    //                         $data[$form_key][$key]['notice_estimate'] = str_replace(',', '', $input['notice_estimate'][$form_key][$key]);
    //                         $data[$form_key][$key]['tax_year'] = $input['tax_year'][$form_key][$key];
    //                         $data[$form_key][$key]['tax_local_year'] = $input['tax_local_year'][$form_key][$key];
    //                     }
    //                 }
    //             }
    //             if (!empty($input['notice_number'][2][0])) {
    //                 if ($form_key == 2) {
    //                     foreach ($input['notice_estimate'][2] as $key => $v) {
    //                         $data[$form_key][$key]['individual_id'] = $input['individual_id'][$form_key][0];
    //                         $data[$form_key][$key]['tax_id'] = 10;
    //                         $data[$form_key][$key]['tax_interest'] = str_replace(',', '', $input['tax_interest'][$form_key][0]);
    //                         $data[$form_key][$key]['sum_amount_tax'] = str_replace(',', '', $input['sum_amount_tax'][$form_key][0]);


    //                         $data[$form_key][$key]['notice_number'] = $input['notice_number'][$form_key][0];
    //                         $data[$form_key][$key]['notice_date'] = $this->mydate->date_thai2eng($input['notice_date'][$form_key][0], -543);
    //                         $data[$form_key][$key]['banner_amount'] = str_replace(',', '', $input['banner_amount'][$form_key][0]);
    //                         @$data[$form_key][$key]['tax_year'] = $input['tax_year'][$form_key][0];


    //                     // --- $form_key $key ----//

    //                 // $data[$form_key][$key]['ban'] = $input['ban'][$form_key][$key];
    //                         $data[$form_key][$key]['notice_mark'] = $input['notice_mark'][$form_key][$key];
    //                         $data[$form_key][$key]['noice_name_operation'] = $input['noice_name_operation'][$form_key][$key];
    //                         $data[$form_key][$key]['banner_type'] = $input['banner_type'][$form_key][$key];
    //                         $data[$form_key][$key]['notice_address_subdistrict'] = 50011300;
    //                         $data[$form_key][$key]['banner_width'] = str_replace(',', '', $input['banner_width'][$form_key][$key]);
    //                         $data[$form_key][$key]['banner_heigth'] = str_replace(',', '', $input['banner_heigth'][$form_key][$key]);
    //                         $data[$form_key][$key]['notice_estimate'] = str_replace(',', '', $input['notice_estimate'][$form_key][$key]);

    //                         // $config['upload_path'] = './assets/';
    //                         // $config['allowed_types'] = '*';
    //                         // $this->load->library('upload', $config);
    //                         // $this->upload->do_upload('file_name');
    //                         // $up_file_name = $this->upload->data();
    //                         // $data = array('banner_image' => $up_file_name['file_name']);
    //                     }
    //                 }

    //             }
    //         }
    //     }
    //     $year = $this->session->userdata('year');
    //     $this->Receive_model->insertNotice($year, $data);
    //     redirect(base_url('receive/receive_dashborad'));

    //     // echo '<pre>';
    //     // print_r($data);
    //     // exit;
    // }
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
