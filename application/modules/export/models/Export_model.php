<?php

class export_model extends CI_Model
{

    public function getTaxNotice($tax_id, $id)
    {

        $this->db->select('tax_notice.*,tbl_individual.*,tbl_tax_type.*,tbl_tax.*');
        $this->db->from('tax_notice');
        $this->db->join('tbl_individual', 'tbl_individual.individual_id = tax_notice.individual_id');
        $this->db->join('tbl_tax_type', 'tbl_tax_type.tax_type_id = tbl_individual.individual_type');
        $this->db->join('tbl_tax', 'tbl_tax.tax_id = tax_notice.tax_id', 'left');
        $this->db->where('tax_notice.notice_id', $id);
        $this->db->where('tax_notice.tax_id', $tax_id);

        $query = $this->db->get();
        $data = $query->row_array();

        $data['detail'] = $this->getNoticeSum($data['tax_id'], $data['individual_id']);
        // print_r ($data['detail']);
        // echo $this->db->last_query();

        return $data;
    }
    public function getNoticeSum($tax_id, $individual_id)
    {
        $this->db->select('*');
        $this->db->from('tax_notice');

        $this->db->where('tax_id', $tax_id);
        $this->db->where('individual_id', $individual_id);
        $this->db->where('year_id', $this->session->userdata('year'));

        $query = $this->db->get();

        return $query->result_array();
    }

    public function getTaxNoticeHouse($data = array())
    {

        $this->db->select(' count(tax_notice.tax_id) as number ,
                            sum(tax_notice.notice_estimate) as notice_estimate ,
                            sum(tax_notice.notice_annual_fee) as notice_annual_fee ,
                            tbl_operation.noice_operation_name,
                            GROUP_CONCAT(
                                DISTINCT CONCAT(tax_notice.notice_address_number," หมู่ ",tax_notice.notice_address_moo)
                                SEPARATOR "<br/>"
                              )  as notice_address_number');
        $this->db->from('tax_notice');
        // $this->db->where('year_id', $data['year_id']);
        // $this->db->where('tax_year',$data['tax_year']);
        $this->db->where('tax_id', $data['tax_id']);
        $this->db->where('individual_id', $data['individual_id']);
        $this->db->where('year_id', $this->session->userdata('year'));
        $this->db->join('tbl_operation', 'tbl_operation.noice_operation_id = tax_notice.noice_type_operation', 'left');
        $this->db->group_by('tbl_operation.noice_operation_id');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function getTaxNoticeGat3($data)
    {
        $this->db->select('
                sum(tax_notice.notice_estimate) as notice_estimate ,
                sum(tax_notice.land_rai) as land_rai ,
                sum(tax_notice.land_ngan) as land_ngan ,
                sum(tax_notice.land_wa) as land_wa ,
        ');
        $this->db->from('tax_notice');

        $this->db->where('year_id', $this->session->userdata('year'));
        $this->db->where('tax_id', $data['tax_id']);
        $this->db->where('individual_id', $data['individual_id']);
        $this->db->group_by('tax_id');
        
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getAddressNameById($code_id)
    {
        $this->db->select('area_name_th');
        $this->db->where('area_code', $code_id);
        return $this->db->get('std_area')->row_array();

    }

    public function getTaxNoticeAlert($id)
    {
        $this->db->select('tax_notice.*,tbl_individual.*,tbl_tax_type.*,tbl_tax.*,tax_alert.alert_order,tax_alert.alert_date,tax_alert.alert_id');
        $this->db->from('tax_notice');
        $this->db->join('tbl_individual', 'tbl_individual.individual_id = tax_notice.individual_id');
        $this->db->join('tbl_tax_type', 'tbl_tax_type.tax_type_id = tbl_individual.individual_type');
        $this->db->join('tbl_tax', 'tbl_tax.tax_id = tax_notice.tax_id', 'left');
        $this->db->join('tax_alert', 'tax_alert.notice_id = tax_notice.notice_id');
        $this->db->where('alert_id', $id);
        $query = $this->db->get();
        $data = $query->row_array();
        $data['detail'] = $this->getNoticeAlertDetail($data['tax_id'], $data['individual_id']);
        return $data;
    }

    public function getNoticeAlertDetail($tax_id, $individual_id)
    {
        $this->db->select('*');
        $this->db->from('tax_notice');
        $this->db->where('tax_id', $tax_id);
        $this->db->where('individual_id', $individual_id);
        $this->db->where('year_id', $this->session->userdata('year'));

        
        $query = $this->db->get();
        return $query->result_array();
    }

}
