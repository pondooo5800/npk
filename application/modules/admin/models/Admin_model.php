<?php
class admin_model extends CI_Model
{

    public function getYear()
    {
        $data = array();
        $this->db->select('tbl_year.*,  SUM(tbl_project_manage.prj_budget_sum) as prj_budget');
        $this->db->from('tbl_year');
        $this->db->where('tbl_project_manage.project_parent is null', null, false);
        $this->db->join('tbl_project_manage', 'tbl_project_manage.project_year = tbl_year.year_id', 'left');
        $this->db->group_by('tbl_year.year_id');
        $query = $this->db->get();
        foreach ($query->result() as $key => $value) {
            @$data[$value->year_id]->year_id = $value->year_id;
            @$data[$value->year_id]->year_label = $value->year_label;
            @$data[$value->year_id]->prj_budget = $value->prj_budget;
        }

        $this->db->select('tbl_year.*, SUM(tbl_tax_estimate.tax_estimate) AS tax_estimate');
        $this->db->from('tbl_year');
        $this->db->join('tbl_tax_estimate', 'tbl_tax_estimate.year_id = tbl_year.year_id', 'left');
        $this->db->group_by('tbl_year.year_id');
        $query = $this->db->get();
        foreach ($query->result() as $key => $value) {
            @$data[$value->year_id]->tax_estimate = $value->tax_estimate;
        }

        return $data;
    }

    public function getMaxYear()
    {
        $query = $this->db->from('tbl_year')->order_by('year_id', 'DESC')->limit(1)->get();
        $row = $query->row();

        return $row->year_id;
    }

    public function create_year($year_id)
    {
        $this->db->set('year_id', ($year_id + 1));
        $this->db->set('year_label', ($year_id + 1 + 543));
        $this->db->insert('tbl_year');
    }

    public function clearTemp($tax_id)
    {
        if ($tax_id == 8) {
            $this->db->where('1=1');
            $this->db->delete('tmp_data_house');
        } else if ($tax_id == 9) {
            $this->db->where('1=1');
            $this->db->delete('tmp_data_ward');
        } else if ($tax_id == 10) {
            $this->db->where('1=1');
            $this->db->delete('tmp_data_label');
        }
    }

    public function importDataToTemp($tax_id, $data)
    {
        $count_row = 0;
        foreach ($data as $key => $value) {
            $count_row++;
            if ($tax_id == 8) {
                if ($count_row < 2) {
                    continue;
                }

                $this->db->set('tmp_prename', $value[0][1]);
                $this->db->set('tmp_firstname', $value[0][2]);
                $this->db->set('tmp_lastname', $value[0][3]);
                $this->db->set('tmp_Identification', $value[0][4]);
                $this->db->set('tmp_number', $value[0][5]);
                $this->db->set('tmp_village', $value[0][6]);
                $this->db->set('tmp_subdistrict', $value[0][7]);
                $this->db->set('tmp_number_send', $value[0][8]);
                $this->db->set('tmp_village_send', $value[0][9]);
                $this->db->set('tmp_road_send', $value[0][10]);
                $this->db->set('tmp_lane_send', $value[0][11]);
                $this->db->set('tmp_subdistrict_send', $value[0][12]);
                $this->db->set('tmp_district_send', $value[0][13]);
                $this->db->set('tmp_province_send', $value[0][14]);
                $this->db->set('tmp_zipcode_send', $value[0][15]);
                $this->db->set('tmp_type_business', $value[0][16]);
                $this->db->set('tmp_rec_number_one', $value[0][17]);
                $this->db->set('tmp_tax_one', $value[0][18]);
                $this->db->set('tmp_rec_number_two', $value[0][19]);
                $this->db->set('tmp_tax_two', $value[0][20]);
                $this->db->set('tmp_note', $value[0][21]);
                $this->db->set('tmp_deed_number', $value[0][22]);
                $this->db->set('tmp_box_zone', $value[0][23]);

                $this->db->insert('tmp_data_house');

            } else if ($tax_id == 9) {
                if ($count_row < 3) {
                    continue;
                }

                $this->db->set('tmp_prename', $value[0][2]);
                $this->db->set('tmp_firstname', $value[0][3]);
                $this->db->set('tmp_lastname', $value[0][4]);
                $this->db->set('tmp_Identification', $value[0][5]);
                $this->db->set('tmp_number', $value[0][6]);
                $this->db->set('tmp_village', $value[0][7]);
                $this->db->set('tmp_subdistrict', $value[0][8]);
                $this->db->set('tmp_road', $value[0][9]);
                $this->db->set('tmp_lane', $value[0][10]);
                $this->db->set('tmp_district', $value[0][11]);
                $this->db->set('tmp_province', $value[0][12]);
                $this->db->set('tmp_zipcode', $value[0][13]);
                $this->db->set('tmp_number_survey', $value[0][14]);
                $this->db->set('tmp_moo', $value[0][15]);
                $this->db->set('tmp_farm', $value[0][16]);
                $this->db->set('tmp_work', $value[0][17]);
                $this->db->set('tmp_wa', $value[0][18]);
                $this->db->set('tmp_noname', $value[0][19]);
                $this->db->set('tmp_tax_number', $value[0][20]);
                $this->db->set('tmp_deed_number', $value[0][21]);
                $this->db->set('tmp_note', $value[0][22]);
                $this->db->set('tmp_pay_year_one', $value[0][23]);
                $this->db->set('tmp_add_money', $value[0][24]);
                $this->db->set('tmp_date', $value[0][25]);
                $this->db->set('tmp_sum', $value[0][26]);
                $this->db->set('tmp_number_receipt', $value[0][27]);
                $this->db->set('tmp_left', $value[0][28]);
                $this->db->set('tmp_other_year', $value[0][29]);
                $this->db->set('tmp_value_tax', $value[0][30]);
                $this->db->set('tmp_addnumber_tax', $value[0][31]);
                $this->db->set('tmp_sum_tax', $value[0][32]);
                $this->db->set('tmp_num', $value[0][33]);
                $this->db->set('tmp_date_tax', $value[0][34]);

                $this->db->insert('tmp_data_ward');
            } else if ($tax_id == 10) {
                if ($count_row < 2) {
                    continue;
                }

                $this->db->set('tmp_Identification', $value[0][1]);
                $this->db->set('tmp_prename', $value[0][2]);
                $this->db->set('tmp_firstname', $value[0][3]);
                $this->db->set('tmp_lastname', $value[0][4]);
                $this->db->set('tmp_number', $value[0][5]);
                $this->db->set('tmp_village', $value[0][6]);
                $this->db->set('tmp_road', $value[0][7]);
                $this->db->set('tmp_lane', $value[0][8]);
                $this->db->set('tmp_subdistrict', $value[0][9]);
                $this->db->set('tmp_district', $value[0][10]);
                $this->db->set('tmp_province', $value[0][11]);
                $this->db->set('tmp_zipcode', $value[0][12]);
                $this->db->set('tmp_name_store', $value[0][13]);
                $this->db->set('tmp_rec_number_one', $value[0][14]);
                $this->db->set('tmp_tax_before', $value[0][15]);
                $this->db->set('tmp_rec_number_two', $value[0][16]);
                $this->db->set('tmp_year', $value[0][17]);

                $this->db->insert('tmp_data_label');
            }
        }
    }

    public function checkIndividual($individual_number)
    {
        $this->db->select('individual_id');
        $this->db->where('individual_number', $individual_number);
        $query = $this->db->get('tbl_individual');
        if ($query->num_rows()) {
            return false;
        } else {
            return true;
        }
    }

    public function del_year($year)
    {
        $this->db->where('year_id', $year);
        $this->db->delete('tbl_year');

        $this->db->where('prj_year', $year);
        $this->db->delete('tbl_project');

        $this->db->where('project_year', $year);
        $this->db->delete('tbl_project_manage');

        $this->db->where('year_id', $year);
        $this->db->delete('tax_notice');

        $this->db->where('year_id', $year);
        $this->db->delete('tbl_tax_estimate');

        $this->db->where('year_id', $year);
        $this->db->delete('tax_receive');

        $this->db->where('out_year', $year);
        $this->db->delete('tbl_outside');
    }

}
