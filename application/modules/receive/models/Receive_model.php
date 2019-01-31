<?php

class Receive_model extends CI_Model
{
    public function read_receive($id = '')
    {
        if (!empty($id)) {
            $this->db->where('individual_id', $id);
        }
        $this->db->select('tbl_individual.*,tbl_tax_type.*,std_area.*');
        $this->db->from('tbl_individual');
        $this->db->join('tbl_tax_type', 'tbl_tax_type.tax_type_id = tbl_individual.individual_type', 'left');
        $this->db->join('std_area', 'std_area.area_code = tbl_individual.individual_subdistrict', 'left');

        $query = $this->db->get();

        return $query->result();
    }

    public function read_address($id = '')
    {
        if (!empty($id)) {
            $this->db->where('individual_id', $id);
        }
        $this->db->select('tbl_individual.*,tbl_tax_type.*,std_area.*');
        $this->db->from('tbl_individual');
        $this->db->join('tbl_tax_type', 'tbl_tax_type.tax_type_id = tbl_individual.individual_type', 'left');
        $this->db->join('std_area', 'std_area.area_code = tbl_individual.individual_subdistrict', 'left');

        $query = $this->db->get();

        return $query->result_array();
    }

    public function read_dashborad()
    {
        $this->db->select('tax_notice.*,tax_receive.*,sum(tax_receive.interest) as total_interest,tbl_individual.*,tbl_tax_type.*,tbl_tax.*,sum(notice_estimate),(select sum(receive_amount) from tax_receive where tax_notice.notice_id = tax_receive.notice_id) as tax_amount');
        $this->db->from('tax_notice');
        $this->db->where('tax_notice.year_id', $this->session->userdata('year'));
        $this->db->where('tax_notice.status = ', 'active');

        $this->db->join('tbl_individual', 'tbl_individual.individual_id = tax_notice.individual_id', 'left');
        $this->db->join('tbl_tax_type', 'tbl_tax_type.tax_type_id = tbl_individual.individual_type', 'left');
        $this->db->join('tbl_tax', 'tbl_tax.tax_id = tax_notice.tax_id', 'left');
        $this->db->join('tax_receive', 'tax_receive.notice_id = tax_notice.notice_id', 'left');

        $this->db->group_by('tax_notice.notice_number');
        $this->db->group_by('tax_notice.tax_id');
        $this->db->group_by('tax_notice.individual_id');

        $query = $this->db->get();

        return $query->result_array();
    }

    ////////////// Tax_Notice //////////////
    public function getNoticeAll($id = '')
    {
        if (!empty($id)) {
            $this->db->where('individual_id', $id)
                ->where('year_id', $this->session->userdata('year'))
                ->where('status = ', 'Active')
                ->order_by('notice_id');
        }
        $query = $this->db->get('tax_notice');

        return $query->result();
    }

    public function insertNotice($year, $data)
    {
        foreach ($data as $value) {
            foreach ($value as $insert) {
                $this->db->where('year_id', $year);
                $this->db->set('year_id', $year);
                $this->db->insert('tax_notice', $insert);
            }
        }
    }

    public function insertNoticeFormUpdate($year, $data)
    {
        // $this->db->where('year_id', $year);
        $this->db->set('year_id', $year);
        $this->db->insert('tax_notice', $data);
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
    }

    public function updateNotice($year, $data)
    {
        $this->db->where('notice_id', $data['notice_id']);
        $this->db->where('year_id', $year);
        $this->db->set('year_id', $year);
        $this->db->update('tax_notice', $data);
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
    }

    public function update_del_notice($input)
    {
        $this->db->where('notice_number', $input['notice_number']);
        $this->db->update('tax_notice', $input);
    }

    ///////////////////////////////////////////////////

    public function insertDataImport($data)
    {
        return $this->db->insert('tbl_individual', $data);
    }

    //get individual all
    public function getIndividualAll()
    {
        $query = $this->db->get('tbl_individual');

        return $query->result();
    }

    //insert data individual
    public function insertIndividual($data, $id = '')
    {
        if (!empty($id)) {
            $this->db->where('individual_id', $id);

            return $this->db->update('tbl_individual', $data);
        }

        return $this->db->insert('tbl_individual', $data);
    }

    //delelte data individual
    public function del_individual($id)
    {
        $this->db->where('individual_id', $id);

        return $this->db->delete('tbl_individual');
    }

    //other tax
    public function getOtherTaxAll()
    {
        $this->db->select('tax_receive.*,tbl_individual.*,tbl_tax.*');
        $this->db->from('tax_receive');
        $this->db->join('tbl_individual', 'tbl_individual.individual_id = tax_receive.individual_id', 'left');
        $this->db->join('tbl_tax', 'tbl_tax.tax_id = tax_receive.tax_id', 'left');
        $this->db->where('tax_receive.year_id', $this->session->userdata('year'));
        $this->db->where('tbl_tax.tax_id!= 8');
        $this->db->where('tbl_tax.tax_id!= 9');
        $this->db->where('tbl_tax.tax_id!= 10');
        $query = $this->db->get();

        return $query->result();
    }

    //other_tax_add
    public function insertOtherTax($year, $input)
    {
        $this->db->where('year_id', $year);
        $this->db->set('year_id', $year);
        $this->db->insert('tax_receive', $input);
    }

    //other_tax_update

    public function read_OtherTax_update($id)
    {
        return $this->db
            ->where('receive_id', $id)
            ->get('tax_receive')
            ->result_array();
    }

    public function updateOtherTax($year, $input)
    {
        $this->db
            ->where('receive_id', $input['receive_id'])
            ->where('year_id', $year)
            ->set('year_id', $year)
            ->update('tax_receive', $input);
    }

    public function del_other($id)
    {
        $this->db->where('receive_id', $id);

        return $this->db->delete('tax_receive');
    }

    public function del_receive_edit_local($id, $individual_id, $tax_id)
    {
        $this->db->where('notice_id', $id);
        $result = $this->db->delete('tax_notice');

        $data_update = $this->update_receive_edit($individual_id, $tax_id);
        $input['land_amount'] = $data_update->land_amount - 1;
        $input['total_estimate'] = $data_update->total_estimate;
        $input['sum_amount_tax'] = $data_update->total_estimate + $data_update->tax_interest;
        $this->db
            ->where('individual_id', $individual_id)
            ->where('tax_id', $tax_id)
            ->where('year_id', $this->session->userdata('year'))
            ->update('tax_notice', $input);
        // echo $this->db->last_query();
        // exit;
    }

    public function del_receive_edit_label($id, $individual_id, $tax_id)
    {
        $this->db->where('notice_id', $id);
        $result = $this->db->delete('tax_notice');

        $data_update = $this->update_receive_edit($individual_id, $tax_id);
        $input['banner_amount'] = $data_update->banner_amount - 1;
        $input['total_estimate'] = $data_update->total_estimate;
        $input['sum_amount_tax'] = $data_update->total_estimate + $data_update->tax_interest;
        $this->db
            ->where('individual_id', $individual_id)
            ->where('tax_id', $tax_id)
            ->where('year_id', $this->session->userdata('year'))
            ->update('tax_notice', $input);
    }

    public function del_receive_edit_house($id, $individual_id, $tax_id)
    {
        $this->db->where('notice_id', $id);
        $result = $this->db->delete('tax_notice');

        $data_update = $this->update_receive_edit($individual_id, $tax_id);
        $input['notice_amount'] = $data_update->notice_amount - 1;
        $input['total_estimate'] = $data_update->total_estimate;
        $input['sum_amount_tax'] = $data_update->total_estimate + $data_update->tax_interest;
        $this->db
            ->where('individual_id', $individual_id)
            ->where('tax_id', $tax_id)
            ->where('year_id', $this->session->userdata('year'))
            ->update('tax_notice', $input);
    }

    public function update_receive_edit($individual_id, $tax_id)
    {
        $this->db->select('sum(tax_notice.notice_estimate) as total_estimate , tax_notice.tax_interest,tax_notice.land_amount,tax_notice.banner_amount,tax_notice.notice_amount');
        $this->db->from('tax_notice');
        $this->db->where("tax_notice.year_id = '".$this->session->userdata('year')."' AND
                            tax_notice.tax_id = '".$tax_id."' AND
                            tax_notice.individual_id = '".$individual_id."' AND
                            tax_notice.`status` = 'active'");
        $query = $this->db->get();

        $data_row = $query->result();

        return $data_row[0];
    }

    ////outside///
    public function insert_outside($input)
    {
        $this->db->insert('outside_tax', $input);
    }

    public function getOutside()
    {
        $query = $this->db->get('outside_tax');

        return $query->result();
    }

    public function updateOutside($input)
    {
        return $this->db
            ->where('outside_id', $input['outside_id'])
            ->update('outside_tax', $input);
    }

    public function read_Outside_update($id)
    {
        return $this->db
            ->where('outside_id', $id)
            ->get('outside_tax')
            ->result_array();
    }

    public function receive_tax_pay($notice_number, $individual_number)
    {
        $this->db->select('tax_notice.*,(select sum(receive_amount)-tax_notice.notice_estimate from tax_receive where tax_notice.notice_id = tax_receive.notice_id) as tax_estimate,(select sum(receive_amount) from tax_receive where tax_notice.notice_id = tax_receive.notice_id) as tax_amount,(select sum(interest) from tax_receive where tax_notice.notice_id = tax_receive.notice_id) as tax_interest,tbl_individual.*,tbl_tax_type.*,tbl_tax.*');

        $this->db->where('tax_notice.notice_number', $notice_number);
        $this->db->where('tbl_individual.individual_number', $individual_number);

        $this->db->from('tax_notice');
        $this->db->join('tbl_individual', 'tbl_individual.individual_id = tax_notice.individual_id', 'left');
        $this->db->join('tbl_tax_type', 'tbl_tax_type.tax_type_id = tbl_individual.individual_type', 'left');
        $this->db->join('tbl_tax', 'tbl_tax.tax_id = tax_notice.tax_id', 'left');

        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_notic_one($id)
    {
        $this->db->select('tax_notice.*,std_area.*,sum(tax_notice.notice_estimate ) as tax_estimate,(select sum(receive_amount) from tax_receive where tax_notice.notice_id = tax_receive.notice_id) as tax_amount,(select sum(interest) from tax_receive where tax_notice.notice_id = tax_receive.notice_id) as tax_interest,tbl_individual.*,tbl_tax_type.*,tbl_tax.*');
        $this->db->where('tax_notice.individual_id', $id);
        $this->db->from('tax_notice');
        $this->db->join('tbl_individual', 'tbl_individual.individual_id = tax_notice.individual_id', 'left');
        $this->db->join('tbl_tax_type', 'tbl_tax_type.tax_type_id = tbl_individual.individual_type', 'left');
        $this->db->join('tbl_tax', 'tbl_tax.tax_id = tax_notice.tax_id', 'left');
        $this->db->join('std_area', 'std_area.area_code = tbl_individual.individual_subdistrict', 'left');
        // $this->db->join('std_area', 'std_area.area_code = tbl_individual.individual_district', 'left');
        // $this->db->join('std_area', 'std_area.area_code = tbl_individual.individual_provice', 'left');

        $query = $this->db->get();
        // echo $this->db->last_query();

        return $query->result_array();
    }

    public function get_receive_pay($id, $tax_id)
    {
        $this->db->select('tax_notice.*,std_area.*,sum(tax_notice.notice_estimate ) as tax_estimate,(select sum(receive_amount) from tax_receive where tax_notice.notice_id = tax_receive.notice_id) as tax_amount,(select sum(interest) from tax_receive where tax_notice.notice_id = tax_receive.notice_id) as tax_interest,tbl_individual.*,tbl_tax_type.*,tbl_tax.*');
        $this->db->where('tax_notice.individual_id', $id);
        $this->db->where('tax_notice.tax_id', $tax_id);
        $this->db->where('tax_notice.status = ', 'active');
        $this->db->where('tax_notice.year_id', $this->session->userdata('year'));

        $this->db->from('tax_notice');
        $this->db->join('tbl_individual', 'tbl_individual.individual_id = tax_notice.individual_id', 'left');
        $this->db->join('tbl_tax_type', 'tbl_tax_type.tax_type_id = tbl_individual.individual_type', 'left');
        $this->db->join('tbl_tax', 'tbl_tax.tax_id = tax_notice.tax_id', 'left');
        $this->db->join('std_area', 'std_area.area_code = tbl_individual.individual_subdistrict', 'left');
        $this->db->group_by('tax_notice.notice_id');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_house_pay($id)
    {
        return $this->db

            ->select('tax_receive.*,tbl_tax.*,tax_notice.*,tbl_individual.*,tbl_tax_type.*,std_area.*')
            ->from('tax_receive')
            ->where('tax_receive.year_id', $this->session->userdata('year'))
            ->where('tax_receive.individual_id', $id)
            ->where('tax_receive.tax_id = ', '8')
            ->where('tax_notice.status = ', 'active')
            ->join('tbl_tax', 'tbl_tax.tax_id = tax_receive.tax_id', 'left')
            ->join('tbl_individual', 'tbl_individual.individual_id = tax_receive.individual_id', 'left')
            ->join('tbl_tax_type', 'tbl_tax_type.tax_type_id = tbl_individual.individual_type', 'left')
            ->join('std_area', 'std_area.area_code = tbl_individual.individual_subdistrict', 'left')
            ->join('tax_notice', 'tax_notice.notice_id = tax_receive.notice_id', 'left')
            ->order_by('tax_receive.receive_id', 'ASC')

            ->get()
            ->result_array();
    }

    public function get_local_pay($id)
    {
        return $this->db

            ->select('tax_receive.*,tbl_tax.*,tax_notice.*,tbl_individual.*,tbl_tax_type.*,std_area.*')
            ->from('tax_receive')
            ->where('tax_receive.year_id', $this->session->userdata('year'))
            ->where('tax_receive.individual_id', $id)
            ->where('tax_receive.tax_id = ', '9')
            ->where('tax_notice.status = ', 'active')
            ->join('tbl_tax', 'tbl_tax.tax_id = tax_receive.tax_id', 'left')
            ->join('tbl_individual', 'tbl_individual.individual_id = tax_receive.individual_id', 'left')
            ->join('tbl_tax_type', 'tbl_tax_type.tax_type_id = tbl_individual.individual_type', 'left')
            ->join('std_area', 'std_area.area_code = tbl_individual.individual_subdistrict', 'left')
            ->join('tax_notice', 'tax_notice.notice_id = tax_receive.notice_id', 'left')
            ->order_by('tax_receive.receive_id', 'ASC')

            ->get()
            ->result_array();
    }

    public function get_label_pay($id)
    {
        return $this->db

            ->select('tax_receive.*,tbl_tax.*,tax_notice.*,tbl_individual.*,tbl_tax_type.*,std_area.*')
            ->from('tax_receive')
            ->where('tax_receive.year_id', $this->session->userdata('year'))
            ->where('tax_receive.individual_id', $id)
            ->where('tax_receive.tax_id = ', '10')
            ->where('tax_notice.status = ', 'active')
            ->join('tbl_tax', 'tbl_tax.tax_id = tax_receive.tax_id', 'left')
            ->join('tbl_individual', 'tbl_individual.individual_id = tax_receive.individual_id', 'left')
            ->join('tbl_tax_type', 'tbl_tax_type.tax_type_id = tbl_individual.individual_type', 'left')
            ->join('std_area', 'std_area.area_code = tbl_individual.individual_subdistrict', 'left')
            ->join('tax_notice', 'tax_notice.notice_id = tax_receive.notice_id', 'left')
            ->order_by('tax_receive.receive_id', 'ASC')

            ->get()
            ->result_array();
    }

    public function read_Tax_House($id, $receive_id)
    {
        return $this->db
            ->select('tax_receive.*,tbl_tax.*,tbl_individual.*,tbl_tax_type.*,std_area.*')
            ->from('tax_receive')
            ->where('tax_receive.year_id', $this->session->userdata('year'))
            ->where('tax_receive.individual_id', $id)
            ->where('tax_receive.tax_id = 8')
            ->where('tax_receive.receive_id', $receive_id)
            ->join('tbl_tax', 'tbl_tax.tax_id = tax_receive.tax_id', 'left')
            ->join('tbl_individual', 'tbl_individual.individual_id = tax_receive.individual_id', 'left')
            ->join('tbl_tax_type', 'tbl_tax_type.tax_type_id = tbl_individual.individual_type', 'left')
            ->join('std_area', 'std_area.area_code = tbl_individual.individual_subdistrict', 'left')
            ->get()
            ->result_array();
    }

    public function read_Tax_House_Pay($id, $receive_id)
    {
        return $this->db
            ->select('tax_receive.*,tax_notice.*,tbl_tax.*,tbl_individual.*,tbl_tax_type.*,std_area.*')
            ->from('tax_receive')
            ->where('tax_receive.year_id', $this->session->userdata('year'))
            ->where('tax_receive.individual_id', $id)
            ->where('tax_receive.tax_id = 8')
            ->where('tax_notice.status = ', 'active')
            ->join('tbl_tax', 'tbl_tax.tax_id = tax_receive.tax_id', 'left')
            ->join('tbl_individual', 'tbl_individual.individual_id = tax_receive.individual_id', 'left')
            ->join('tbl_tax_type', 'tbl_tax_type.tax_type_id = tbl_individual.individual_type', 'left')
            ->join('std_area', 'std_area.area_code = tbl_individual.individual_subdistrict', 'left')
            ->join('tax_notice', 'tax_notice.notice_id = tax_receive.notice_id', 'left')

            ->get()
            ->result_array();
    }

    public function tabel_pay_house($id, $receive_id)
    {
        return $this->db
            ->select('tax_receive.*,tax_notice.*,
                    sum(tax_receive.amount) as total_amount,
                    sum(tax_receive.interest) as total_interest,
                    sum(tax_receive.receive_amount) as total_receive_amount,
                    sum(tax_receive.balance) as total_balance')
            ->from('tax_receive')
            ->where('tax_receive.year_id', $this->session->userdata('year'))
            ->where('tax_notice.status = ', 'active')
            ->where('tax_receive.individual_id', $id)
            ->where('tax_receive.tax_id = 8')
            ->join('tax_notice', 'tax_notice.notice_id = tax_receive.notice_id', 'left')
            ->order_by('tax_receive.receive_id', 'ASC')
            ->get()
            ->result_array();
    }

    public function read_Tax_Local($id, $receive_id)
    {
        return $this->db
            ->select('tax_receive.*,tbl_tax.*,tbl_individual.*,tbl_tax_type.*,std_area.*')
            ->from('tax_receive')
            ->where('tax_receive.year_id', $this->session->userdata('year'))
            ->where('tax_receive.individual_id', $id)
            ->where('tax_receive.tax_id = 9')
            ->where('tax_receive.receive_id', $receive_id)
            ->join('tbl_tax', 'tbl_tax.tax_id = tax_receive.tax_id', 'left')
            ->join('tbl_individual', 'tbl_individual.individual_id = tax_receive.individual_id', 'left')
            ->join('tbl_tax_type', 'tbl_tax_type.tax_type_id = tbl_individual.individual_type', 'left')
            ->join('std_area', 'std_area.area_code = tbl_individual.individual_subdistrict', 'left')
            ->get()
            ->result_array();
    }

    public function read_Tax_Local_Pay($id, $receive_id)
    {
        return $this->db
            ->select('tax_receive.*,tbl_tax.*,tbl_individual.*,tbl_tax_type.*,std_area.*')
            ->from('tax_receive')
            ->where('tax_receive.year_id', $this->session->userdata('year'))
            ->where('tax_receive.individual_id', $id)
            ->where('tax_receive.tax_id = 9')
            ->join('tbl_tax', 'tbl_tax.tax_id = tax_receive.tax_id', 'left')
            ->join('tbl_individual', 'tbl_individual.individual_id = tax_receive.individual_id', 'left')
            ->join('tbl_tax_type', 'tbl_tax_type.tax_type_id = tbl_individual.individual_type', 'left')
            ->join('std_area', 'std_area.area_code = tbl_individual.individual_subdistrict', 'left')
            ->get()
            ->result_array();
    }

    public function tabel_pay_local($id, $receive_id)
    {
        return $this->db
            ->select('tax_receive.*,tax_notice.*,
                    sum(tax_receive.amount) as total_amount,
                    sum(tax_receive.interest) as total_interest,
                    sum(tax_receive.receive_amount) as total_receive_amount,
                    sum(tax_receive.balance) as total_balance')
            ->from('tax_receive')
            ->where('tax_receive.year_id', $this->session->userdata('year'))
            ->where('tax_receive.individual_id', $id)
            ->where('tax_receive.tax_id = 9')
            ->where('tax_notice.status = ', 'active')
            ->join('tax_notice', 'tax_notice.notice_id = tax_receive.notice_id', 'left')

            ->order_by('tax_receive.receive_id', 'ASC')
            ->get()
            ->result_array();
    }

    public function read_Tax_Label($id, $receive_id)
    {
        return $this->db
            ->select('tax_receive.*,tbl_tax.*,tbl_individual.*,tbl_tax_type.*,std_area.*')
            ->from('tax_receive')
            ->where('tax_receive.year_id', $this->session->userdata('year'))
            ->where('tax_receive.individual_id', $id)
            ->where('tax_receive.tax_id = 10')
            ->where('tax_receive.receive_id', $receive_id)
            ->join('tbl_tax', 'tbl_tax.tax_id = tax_receive.tax_id', 'left')
            ->join('tbl_individual', 'tbl_individual.individual_id = tax_receive.individual_id', 'left')
            ->join('tbl_tax_type', 'tbl_tax_type.tax_type_id = tbl_individual.individual_type', 'left')
            ->join('std_area', 'std_area.area_code = tbl_individual.individual_subdistrict', 'left')

            ->get()
            ->result_array();
    }

    public function read_Tax_Label_Pay($id, $receive_id)
    {
        return $this->db
            ->select('tax_receive.*,tbl_tax.*,tbl_individual.*,tbl_tax_type.*,std_area.*')
            ->from('tax_receive')
            ->where('tax_receive.year_id', $this->session->userdata('year'))
            ->where('tax_receive.individual_id', $id)
            ->where('tax_receive.tax_id = 10')
            ->join('tbl_tax', 'tbl_tax.tax_id = tax_receive.tax_id', 'left')
            ->join('tbl_individual', 'tbl_individual.individual_id = tax_receive.individual_id', 'left')
            ->join('tbl_tax_type', 'tbl_tax_type.tax_type_id = tbl_individual.individual_type', 'left')
            ->join('std_area', 'std_area.area_code = tbl_individual.individual_subdistrict', 'left')
            ->get()
            ->result_array();
    }

    public function tabel_pay_label($id, $receive_id)
    {
        return $this->db
            ->select('tax_receive.*,tax_notice.*,
                    sum(tax_receive.amount) as total_amount,
                    sum(tax_receive.interest) as total_interest,
                    sum(tax_receive.receive_amount) as total_receive_amount,
                    sum(tax_receive.balance) as total_balance')
            ->from('tax_receive')
            ->where('tax_receive.year_id', $this->session->userdata('year'))
            ->where('tax_receive.individual_id', $id)
            ->where('tax_receive.tax_id = 10')
            ->where('tax_notice.status = ', 'active')
            ->join('tax_notice', 'tax_notice.notice_id = tax_receive.notice_id', 'left')

            ->order_by('tax_receive.receive_id', 'ASC')
            ->get()
            ->result_array();
    }

    public function updateReceiveTax($year, $input)
    {
        return $this->db
            ->where('receive_id', $input['receive_id'])
            ->where('year_id', $year)
            ->set('year_id', $year)
            ->update('tax_receive', $input);
    }

    public function recieve_tax_add($year, $input)
    {
        $this->db
            ->where('year_id', $year)
            ->set('year_id', $year)
            ->insert('tax_receive', $input);
    }

    public function getTaxByKeywordHouse($keyword)
    {
        $year = $this->session->userdata('year');
        $this->db->select('tax_notice.*,
                            sum(notice_estimate) as sum_notice_estimate,
                            (select sum(receive_amount)-tax_notice.notice_estimate from tax_receive where tax_notice.notice_id = tax_receive.notice_id AND    tax_receive.year_id='.$year.') as tax_estimate,
                            (select sum(receive_amount) from tax_receive where
                            tax_receive.individual_id=`tax_notice`.`individual_id` AND tax_receive.tax_id=tax_notice.tax_id
                            AND    tax_receive.year_id='.$year.'
                           ) as tax_amount,
                            (select sum(interest) from tax_receive where tax_notice.notice_id = tax_receive.notice_id AND    tax_receive.year_id='.$year.') as tax_interest,
                            tbl_individual.*,
                            tbl_tax_type.*,
                            tbl_tax.*');

        $this->db->from('tax_notice');
        $this->db->where('tax_notice.year_id', $this->session->userdata('year'));
        $this->db->where('tax_notice.status = ', 'active');
        $this->db->where('tbl_tax.tax_id = 8');
        $this->db->where("(`notice_number` LIKE '%".$keyword."%' ESCAPE '!'
                            OR `individual_number` LIKE '%".$keyword."%' ESCAPE '!'
                            OR `individual_fullname` LIKE '%".$keyword."%' ESCAPE '!')");
        $this->db->join('tbl_individual', 'tbl_individual.individual_id = tax_notice.individual_id', 'left');
        $this->db->join('tbl_tax_type', 'tbl_tax_type.tax_type_id = tbl_individual.individual_type', 'left');
        $this->db->join('tbl_tax', 'tbl_tax.tax_id = tax_notice.tax_id', 'left');
        $this->db->group_by('notice_number', 'tax_id');
        $this->db->group_by('tax_notice.individual_id');

        $query = $this->db->get();

        return $query->result_array();
    }

    public function getTaxByKeywordLocal($keyword)
    {
        $year = $this->session->userdata('year');

        $this->db->select('tax_notice.*,
                            sum(notice_estimate) as sum_notice_estimate,
                            (select sum(receive_amount)-tax_notice.notice_estimate from tax_receive where tax_notice.notice_id = tax_receive.notice_id AND    tax_receive.year_id='.$year.') as tax_estimate,
                            (select sum(receive_amount) from tax_receive where
                            tax_receive.individual_id=`tax_notice`.`individual_id` AND tax_receive.tax_id=tax_notice.tax_id
                            AND    tax_receive.year_id='.$year.'
                        ) as tax_amount,
                            (select sum(interest) from tax_receive where tax_notice.notice_id = tax_receive.notice_id AND    tax_receive.year_id='.$year.') as tax_interest,
                            tbl_individual.*,
                            tbl_tax_type.*,
                            tbl_tax.*');

        $this->db->from('tax_notice');
        $this->db->where('tax_notice.year_id', $this->session->userdata('year'));
        $this->db->where('tax_notice.status = ', 'active');
        $this->db->where('tbl_tax.tax_id = 9');
        $this->db->where("(`notice_number` LIKE '%".$keyword."%' ESCAPE '!'
                            OR `individual_number` LIKE '%".$keyword."%' ESCAPE '!'
                            OR `individual_fullname` LIKE '%".$keyword."%' ESCAPE '!')");
        $this->db->join('tbl_individual', 'tbl_individual.individual_id = tax_notice.individual_id', 'left');
        $this->db->join('tbl_tax_type', 'tbl_tax_type.tax_type_id = tbl_individual.individual_type', 'left');
        $this->db->join('tbl_tax', 'tbl_tax.tax_id = tax_notice.tax_id', 'left');
        $this->db->group_by('notice_number', 'tax_id');
        $this->db->group_by('tax_notice.individual_id');

        $query = $this->db->get();

        return $query->result_array();
    }

    public function getTaxByKeywordLabel($keyword)
    {
        $year = $this->session->userdata('year');

        $this->db->select('tax_notice.*,
                            sum(notice_estimate) as sum_notice_estimate,
                            (select sum(receive_amount)-tax_notice.notice_estimate from tax_receive where tax_notice.notice_id = tax_receive.notice_id AND    tax_receive.year_id='.$year.') as tax_estimate,
                            (select sum(receive_amount) from tax_receive where
                            tax_receive.individual_id=`tax_notice`.`individual_id` AND tax_receive.tax_id=tax_notice.tax_id
                            AND    tax_receive.year_id='.$year.'
                        ) as tax_amount,
                            (select sum(interest) from tax_receive where tax_notice.notice_id = tax_receive.notice_id AND    tax_receive.year_id='.$year.') as tax_interest,
                            tbl_individual.*,
                            tbl_tax_type.*,
                            tbl_tax.*');
        $this->db->from('tax_notice');
        $this->db->where('tax_notice.year_id', $this->session->userdata('year'));
        $this->db->where('tax_notice.status = ', 'active');
        $this->db->where('tbl_tax.tax_id = 10');
        $this->db->where("(`notice_number` LIKE '%".$keyword."%' ESCAPE '!'
                            OR `individual_number` LIKE '%".$keyword."%' ESCAPE '!'
                            OR `individual_fullname` LIKE '%".$keyword."%' ESCAPE '!')");
        $this->db->join('tbl_individual', 'tbl_individual.individual_id = tax_notice.individual_id', 'left');
        $this->db->join('tbl_tax_type', 'tbl_tax_type.tax_type_id = tbl_individual.individual_type', 'left');
        $this->db->join('tbl_tax', 'tbl_tax.tax_id = tax_notice.tax_id', 'left');
        $this->db->group_by('notice_number', 'tax_id');
        $this->db->group_by('tax_notice.individual_id');

        $query = $this->db->get();

        return $query->result_array();
    }

    ///// Ajax ////////
    public function getRecieveTaxAjax($param)
    {
        $keyword = $param['keyword'];
        $this->db->select('*');

        $condition = '1=1';

        if (!empty($param['filter'])) {
            $filter = $param['filter'];
            if (!empty($filter[1])) {
                $this->db->like('individual_type', $filter[1]);
            }
            if (!empty($filter[2])) {
                $this->db->like('individual_number', $filter[2]);
            }
            if (!empty($filter[3])) {
                $this->db->like('individual_fullname', $filter[3]);
            }
        }

        // $this->db->select('tax_notice.*,count(tax_notice.notice_id) as count_notice,tbl_individual.*');
        // $this->db->from('tbl_individual');
        // $this->db->where('tax_notice.year_id', $this->session->userdata('year'));
        // $this->db->join('tax_notice', 'tax_notice.individual_id = tbl_individual.individual_id', 'Rgiht');

        $this->db->where($condition);

        $this->db->limit($param['page_size'], $param['start']);
        $this->db->order_by($param['column'], $param['dir']);

        $query = $this->db->get('tbl_individual');
        // echo $this->db->last_query();
        $data = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $key => $row) {
                $results_1 = $this->getNoticeTax($row['individual_id']);
                $row['count_notice'] = $results_1[0]->count_notice;
                $row['tax_id'] = 8;
                $data[] = $row;
            }
        }

        $count_condition = $this->db->from('tbl_individual')->where($condition)->count_all_results();
        $count = $this->db->from('tbl_individual')->count_all_results();
        $result = array('count' => $count, 'count_condition' => $count_condition, 'data' => $data, 'error_message' => '');

        return $result;
    }

    public function getNoticeTax($id)
    {
        $this->db->select('count(tax_notice.notice_id) as count_notice');
        $this->db->from('tbl_individual');
        $this->db->join('tax_notice', 'tax_notice.individual_id = tbl_individual.individual_id', 'Rgiht');
        $this->db->where('tax_notice.year_id', $this->session->userdata('year'));
        $this->db->where('tbl_individual.individual_id', $id);
        $this->db->where('status = ', 'Active');
        $query = $this->db->get();

        return $query->result();
    }

    public function getRecieveDashboradAjax($param)
    {
        $keyword = $param['keyword'];
        $this->db->select('*');

        $condition = '1=1';

        if (!empty($param['filter'])) {
            $filter = $param['filter'];
            if (!empty($filter[1])) {
                $this->db->like('individual_type', $filter[1]);
            }
            if (!empty($filter[2])) {
                $this->db->like('tbl_individual.individual_number', $filter[2]);
            }
            if (!empty($filter[3])) {
                $this->db->like('individual_fullname', $filter[3]);
            }
            if (!empty($filter[4])) {
                $this->db->like('tax_name', $filter[4]);
            }
            if (!empty($filter[5]) && $filter[5] != '') {
                if ($filter[5] == 'All') {
                    $this->db->like('status', 'Active');
                } else {
                    $this->db->where('status = ', $filter[5]);
                }
            } else {
                $this->db->where('status = ', 'Active');
            }
        } else {
            $this->db->where('status = ', 'Active');
        }
        $this->db->select('tax_notice.*,tax_notice.notice_id as id,tax_receive.*,tbl_individual.individual_number as tbl_individual_individual_number,tbl_individual.*,tbl_tax_type.*,tbl_tax.*,sum(notice_estimate) as sum_notice_estimate,(select sum(receive_amount) from tax_receive where tax_notice.notice_id = tax_receive.notice_id) as tax_amount,(select sum(interest) from tax_receive where tax_notice.notice_id = tax_receive.notice_id) as tax_interest');
        $this->db->from('tax_notice');
        $this->db->where($condition);
        $this->db->where('tax_notice.year_id', $this->session->userdata('year'));
        $this->db->join('tbl_individual', 'tbl_individual.individual_id = tax_notice.individual_id', 'left');
        $this->db->join('tax_receive', 'tax_receive.notice_id = tax_notice.notice_id', 'left');

        $this->db->join('tbl_tax_type', 'tbl_tax_type.tax_type_id = tbl_individual.individual_type', 'left');
        $this->db->join('tbl_tax', 'tbl_tax.tax_id = tax_notice.tax_id', 'left');

        $this->db->group_by('tax_notice.notice_number');
        $this->db->group_by('tax_notice.tax_id');
        $this->db->group_by('tax_notice.individual_id');

        $this->db->limit($param['page_size'], $param['start']);
        $this->db->order_by($param['column'], $param['dir']);

        $query = $this->db->get();

        // echo $this->db->last_query();
        // echo "<hr>";

        $data = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $key => $row) {
                $row['tax_year'] = ($row['tax_year'] + 543);
                $row['sum_amount_tax'] = number_format($row['sum_amount_tax'], 2);
                $value = str_replace(',', '', $row['sum_amount_tax']);
                $row['sum'] = $value;

                $row['tax_interest'] = number_format($row['tax_interest'], 2);
                $value = str_replace(',', '', $row['tax_interest']);
                $row['interest'] = $value;

                $row['tax_amount'] = number_format($row['tax_amount'], 2);
                $value = str_replace(',', '', $row['tax_amount']);
                $row['amount'] = $value;

                $row['t_bal'] = $row['sum'] + $row['interest'] - $row['amount'];
                $row['tax_balance'] = number_format($row['t_bal'], 2);
                $data[] = $row;
            }
        }

        $count_condition = $this->db->from('tax_notice')->where($condition)->count_all_results();
        $count = $this->db->from('tax_notice')->count_all_results();
        $result = array('count' => $count, 'count_condition' => $count_condition, 'data' => $data, 'error_message' => '');

        return $result;
    }

    public function getAjaxOtherTaxAjax($param)
    {
        $keyword = $param['keyword'];
        $this->db->select('*');

        $condition = '1=1';

        $this->db->where($condition);
        $this->db->limit($param['page_size'], $param['start']);
        $this->db->order_by($param['column'], $param['dir']);

        $this->db->select('tax_receive.*,tbl_individual.*,tbl_tax.*');
        $this->db->from('tax_receive');
        $this->db->join('tbl_individual', 'tbl_individual.individual_id = tax_receive.individual_id', 'left');
        $this->db->join('tbl_tax', 'tbl_tax.tax_id = tax_receive.tax_id', 'left');
        $this->db->where('tax_receive.year_id', $this->session->userdata('year'));
        $this->db->where('tbl_tax.tax_id!= 8');
        $this->db->where('tbl_tax.tax_id!= 9');
        $this->db->where('tbl_tax.tax_id!= 10');
        $query = $this->db->get();

        $data = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $key => $row) {
                $row['receive_amount'] = number_format($row['receive_amount'], 2);

                $date = explode('-', $row['receive_date']);
                $row['receive_date'] = $date[2].'/'.$date[1].'/'.($date[0] + 543);

                $data[] = $row;
            }
        }

        if (!empty($param['filter'])) {
            $filter = $param['filter'];
            if (!empty($filter[1])) {
                $this->db->like('individual_type', $filter[1]);
            }
            if (!empty($filter[2])) {
                $this->db->like('individual_number', $filter[2]);
            }
            if (!empty($filter[3])) {
                $this->db->like('individual_fullname', $filter[3]);
            }
            if (!empty($filter[4])) {
                $this->db->like('tax_name', $filter[4]);
            }
        }

        $count_condition = $this->db->from('tax_receive')->where($condition)->count_all_results();
        $count = $this->db->from('tax_receive')->count_all_results();
        $result = array('count' => $count, 'count_condition' => $count_condition, 'data' => $data, 'error_message' => '');

        return $result;
    }

    public function getRecieveTaxHouseAjax($param)
    {
        $keyword = $param['keyword'];
        $this->db->select('*');

        $condition = '1=1';

        // if (!empty($param['filter'])) {
        //     $filter = $param['filter'];
        //     if (!empty($filter[1])) {
        //         $this->db->like('individual_type', $filter[1]);
        //     }
        //     if (!empty($filter[2])) {
        //         $this->db->like('individual_number', $filter[2]);
        //     }
        //     if (!empty($filter[3])) {
        //         $this->db->like('individual_fullname', $filter[3]);
        //     }
        //     if (!empty($filter[4])) {
        //         $this->db->like('tax_name', $filter[4]);
        //     }

        // }

        $this->db->where($condition);
        $this->db->limit($param['page_size'], $param['start']);
        $this->db->order_by($param['column'], $param['dir']);

        $this->db->select('tax_receive.*,tax_notice.*,tbl_individual.*,');
        $this->db->from('tax_receive');
        $this->db->where('tax_receive.tax_id= 8');
        $this->db->where('tax_notice.status = ', 'active');
        $this->db->where('tax_receive.year_id', $this->session->userdata('year'));
        $this->db->join('tbl_individual', 'tbl_individual.individual_id = tax_receive.individual_id', 'left');
        $this->db->join('tax_notice', 'tax_notice.notice_id = tax_receive.notice_id', 'left');

        // $this->db->join('tbl_individual', 'tbl_individual.individual_id = tax_receive.individual_id', 'left');

        // $this->db->join('tbl_tax', 'tbl_tax.tax_id = tax_receive.tax_id', 'left');
        // $this->db->join('tax_notice', 'tax_notice.notice_id = tax_receive.notice_id', 'left');

        // $this->db->where('tax_receive.year_id', $this->session->userdata('year'));
        // $this->db->where('tbl_tax.tax_id= 8');

        $query = $this->db->get();
        $data = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $key => $row) {
                $row['receive_amount'] = number_format($row['receive_amount'], 2);
                $row['amount'] = number_format($row['amount'], 2);
                $row['interest'] = number_format($row['interest'], 2);

                $row['receive_date'] = $this->mydate->date_eng2thai($row['receive_date'], 543, 'S');

                $data[] = $row;
            }
        }
        $count_condition = $this->db->from('tax_receive')->where($condition)->count_all_results();
        $count = $this->db->from('tax_receive')->count_all_results();
        $result = array('count' => $count, 'count_condition' => $count_condition, 'data' => $data, 'error_message' => '');

        return $result;
    }

    public function getRecieveTaxLocalAjax($param)
    {
        $keyword = $param['keyword'];
        $this->db->select('*');

        $condition = '1=1';

        // if (!empty($param['filter'])) {
        //     $filter = $param['filter'];
        //     if (!empty($filter[1])) {
        //         $this->db->like('individual_type', $filter[1]);
        //     }
        //     if (!empty($filter[2])) {
        //         $this->db->like('individual_number', $filter[2]);
        //     }
        //     if (!empty($filter[3])) {
        //         $this->db->like('individual_fullname', $filter[3]);
        //     }
        //     if (!empty($filter[4])) {
        //         $this->db->like('tax_name', $filter[4]);
        //     }

        // }

        $this->db->where($condition);
        $this->db->limit($param['page_size'], $param['start']);
        $this->db->order_by($param['column'], $param['dir']);

        $this->db->select('tax_receive.*,tax_notice.*,tbl_individual.*,');
        $this->db->from('tax_receive');
        $this->db->where('tax_receive.tax_id= 9');
        $this->db->where('tax_notice.status = ', 'active');
        $this->db->where('tax_receive.year_id', $this->session->userdata('year'));

        $this->db->join('tax_notice', 'tax_notice.notice_id = tax_receive.notice_id', 'left');
        $this->db->join('tbl_individual', 'tbl_individual.individual_id = tax_receive.individual_id', 'left');

        $query = $this->db->get();
        $data = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $key => $row) {
                $row['receive_amount'] = number_format($row['receive_amount'], 2);
                $row['amount'] = number_format($row['amount'], 2);
                $row['interest'] = number_format($row['interest'], 2);

                $row['receive_date'] = $this->mydate->date_eng2thai($row['receive_date'], 543, 'S');

                $data[] = $row;
            }
        }
        $count_condition = $this->db->from('tax_receive')->where($condition)->count_all_results();
        $count = $this->db->from('tax_receive')->count_all_results();
        $result = array('count' => $count, 'count_condition' => $count_condition, 'data' => $data, 'error_message' => '');

        return $result;
    }

    public function getRecieveTaxLabelAjax($param)
    {
        $keyword = $param['keyword'];
        $this->db->select('*');

        $condition = '1=1';

        // if (!empty($param['filter'])) {
        //     $filter = $param['filter'];
        //     if (!empty($filter[1])) {
        //         $this->db->like('individual_type', $filter[1]);
        //     }
        //     if (!empty($filter[2])) {
        //         $this->db->like('individual_number', $filter[2]);
        //     }
        //     if (!empty($filter[3])) {
        //         $this->db->like('individual_fullname', $filter[3]);
        //     }
        //     if (!empty($filter[4])) {
        //         $this->db->like('tax_name', $filter[4]);
        //     }

        // }

        $this->db->where($condition);
        $this->db->limit($param['page_size'], $param['start']);
        $this->db->order_by($param['column'], $param['dir']);

        $this->db->select('tax_receive.*,tbl_individual.*,tbl_tax.*,tax_notice.*');
        $this->db->from('tax_receive');
        $this->db->join('tbl_individual', 'tbl_individual.individual_id = tax_receive.individual_id', 'left');
        $this->db->join('tbl_tax', 'tbl_tax.tax_id = tax_receive.tax_id', 'left');
        $this->db->join('tax_notice', 'tax_notice.notice_id = tax_receive.notice_id', 'left');

        $this->db->where('tax_receive.year_id', $this->session->userdata('year'));
        $this->db->where('tax_notice.status = ', 'active');
        $this->db->where('tax_receive.tax_id= 10');

        $query = $this->db->get();
        $data = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $key => $row) {
                $row['receive_amount'] = number_format($row['receive_amount'], 2);
                $row['amount'] = number_format($row['amount'], 2);
                $row['interest'] = number_format($row['interest'], 2);

                $row['receive_date'] = $this->mydate->date_eng2thai($row['receive_date'], 543, 'S');

                $data[] = $row;
            }
        }
        $count_condition = $this->db->from('tax_receive')->where($condition)->count_all_results();
        $count = $this->db->from('tax_receive')->count_all_results();
        $result = array('count' => $count, 'count_condition' => $count_condition, 'data' => $data, 'error_message' => '');

        return $result;
    }

    public function address($code_id)
    {
        $this->db->select('area_name_th');
        $this->db->where('area_code', $code_id);

        return $this->db->get('std_area')->result_array();
    }

    public function getAlert($data)
    {
        $this->db->where('notice_id', $data);
        $this->db->order_by('alert_order', 'ASC');

        return $this->db->get('tax_alert')->result();
    }

    public function saveAlert($data)
    {
        $this->db->insert('tax_alert', $data);

        return $this->db->insert_id();
    }

    public function delAlert($id)
    {
        $result = $this->db->query('SELECT *  FROM tax_alert  WHERE alert_id = '.$id)->row();
        if ($result->alert_id != '') {
            // delete alert id
            $this->db->where('alert_id', $id);
            $this->db->delete('tax_alert');

            //get max value and update order alert
            $data = $this->db->query(' SELECT * FROM tax_alert ORDER BY alert_id DESC LIMIT 0, 1')->row();
            if ($data->alert_id != '') {
                $this->db->set('alert_order', $result->alert_order);
                $this->db->where('alert_id', $data->alert_id);
                $this->db->update('tax_alert');
            }
        }

        return true;
    }

    public function checkDupIndividual($input)
    {
        $this->db->where('individual_number', $input);
        $query = $this->db->get('tbl_individual');
        if ($query->num_rows() > 0) {
            return true;
        }

        return false;
    }

    public function checkDupNotice_Number($input)
    {
        $this->db->where('notice_number', $input);
        $query = $this->db->get('tax_notice');
        if ($query->num_rows() > 0) {
            return true;
        }

        return false;
    }
}
