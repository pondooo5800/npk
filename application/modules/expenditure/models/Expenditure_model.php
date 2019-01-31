<?php
class expenditure_model extends CI_Model
{

    public function getPrjByKeyword($keyword)
    {
        $this->db->select('tbl_project.*,sum(tbl_expenses.expenses_amount_disburse) as expenses_amount_disburse');
        $this->db->from('tbl_project');
        $this->db->like('prj_name', $keyword);
        $this->db->where('prj_active', '1');
        $this->db->where('prj_year', $this->session->userdata('year'));
        $this->db->join('tbl_expenses', 'tbl_expenses.project_id = tbl_project.prj_id', 'left');
        $this->db->group_by('prj_name,prj_parent');
        $query = $this->db->get();

        return $query->result();
    }

    public function getPrjById($project_id)
    {
        $this->db->select('p.*,sum(tbl_prj_budget_log.prj_amount) as budget_log,
		(select sum(e.expenses_amount_disburse)  from tbl_expenses  e where e.project_id = p.prj_id) as expenses
		');
        $this->db->from('tbl_project p');
        $this->db->where('p.prj_id', $project_id);
        // $this->db->join('tbl_expenses','tbl_expenses.project_id = tbl_project.prj_id ','left');
        $this->db->join('tbl_prj_budget_log', 'p.prj_id = tbl_prj_budget_log.prj_id', 'left');
        $this->db->group_by('p.prj_id');
        $query = $this->db->get();

        return $query->row();
    }

    public function getPrjExpenses($project_id = '', $expenses_id = '')
    {
        $this->db->select('*');
        $this->db->from('tbl_expenses');
        $this->db->like('project_id', $project_id);
        $this->db->join('usrm_user', 'usrm_user.user_id = tbl_expenses.user_id');
        if (!empty($expenses_id)) {
            $this->db->where('expenses_id', $expenses_id);
        }

        $query = $this->db->get();

        return $query->result();
    }

    public function getPrjExpensesByPrj($project_id = '', $expenses_id = '')
    {
        $this->db->select('*,usrm_user.user_firstname,usrm_user.user_lastname');
        $this->db->from('tbl_expenses');
        $this->db->where('project_id', $project_id);
        $this->db->join('usrm_user', 'usrm_user.user_id = tbl_expenses.user_id');
        if (!empty($expenses_id)) {
            $this->db->where('expenses_id', $expenses_id);
        }

        $query = $this->db->get();

        return $query->result();
    }

    public function saveExpenditure($input)
    {
        $input['expenses_date'] = $this->mydate->date_thai2eng($input['expenses_date'], -543);
        $input['expenses_amount'] = str_replace(',', '', $input['expenses_amount']);
        $input['expenses_amount_vat'] = str_replace(',', '', $input['expenses_amount_vat']);
        $input['expenses_amount_disburse'] = str_replace(',', '', $input['expenses_amount_disburse']);
        $input['expenses_amount_tax'] = str_replace(',', '', $input['expenses_amount_tax']);
        $input['expenses_amount_fine'] = str_replace(',', '', $input['expenses_amount_fine']);
        $input['expenses_amount_result'] = str_replace(',', '', $input['expenses_amount_result']);
        $input['user_id'] = $_SESSION['user_id'];
        if (!empty($input['expenses_id'])) {
            $id = $input['expenses_id'];
            unset($input['expenses_id']);
            $this->db->where('expenses_id', $id);
            return $this->db->update('tbl_expenses', $input);
        }

        return $this->db->insert('tbl_expenses', $input);
    }

    public function getExpenditure($year)
    {
        $this->db->select('tbl_expenses.*, tbl_project.prj_name,usrm_user.user_firstname,usrm_user.user_lastname');
        $this->db->from('tbl_expenses');
        $this->db->join('tbl_project', 'tbl_project.prj_id = tbl_expenses.project_id');
        $this->db->join('usrm_user', 'usrm_user.user_id = tbl_expenses.user_id');
        $this->db->where('prj_year', $year);
        $this->db->order_by('expenses_id DESC', 'expenses_date_disburse DESC');
        $query = $this->db->get();

        return $query->result();
    }

    public function expenditure_del($id)
    {
        $this->db->where('expenses_id', $id);
        return $this->db->delete('tbl_expenses');
    }

    public function getExpenditureNumber($id)
    {
        return $this->db->query("SELECT * FROM tbl_expenses WHERE expenses_id = " . $id)->row();
    }

    public function saveExpenditureNumber($id, $input)
    {
        $expenses = $this->db->query("SELECT expenses_amount_fine FROM tbl_expenses WHERE expenses_id = " . $id)->row();
        if ($expenses->expenses_amount_fine > 0) {
            $datas = array();
            $year = $this->session->userdata('year');
            $datas['sum_amount'] = $expenses->expenses_amount_fine;
            $date_tmp = explode('/', $input['expenses_date_disburse']);
            $datas['receive_date'] = ($date_tmp[2]-543).'-'.$date_tmp[1].'-'.$date_tmp[0];
            $this->insertOtherTax($year, $datas);
        }
        $input['expenses_date_disburse'] = $this->mydate->date_thai2eng($input['expenses_date_disburse']);
        $this->db->where('expenses_id', $id);
        return $this->db->update('tbl_expenses', $input);

    }

    //other_tax_add
    public function insertOtherTax($year, $input)
    {

        $tax_id = $this->db->query("SELECT tax_id FROM tbl_tax WHERE tax_parent_id = '3' AND  tax_name LIKE '%ค่าปรับการผิดสัญญา%'")->row();

        $input['tax_id'] = $tax_id->tax_id;
        $this->db->where('year_id', $year);
        $this->db->set('year_id', $year);
        $this->db->set('sum_amount', $input['sum_amount']);
        $this->db->set('receive_date', $input['receive_date']);
        $this->db->insert('tax_receive', $input);

    }

    //ajax index
    public function getAjaxExpenditure($param)
    {
        $keyword = $param['keyword'];
        $this->db->select('*');

        $condition = "1=1";

        if (!empty($param['filter'])) {
            $filter = $param['filter'];
            // print_r($filter);die();

            if (!empty($filter[0])) {
                $this->db->like('expenses_date_disburse', $this->mydate->date_thai2eng($filter[0]));
            }
            if (!empty($filter[1])) {
                $this->db->like('expenses_number', $filter[1]);
            }
            if (!empty($filter[2])) {
                $this->db->like('expenses_date', $this->mydate->date_thai2eng($filter[2], -543));
            }
            if (!empty($filter[3])) {
                $this->db->like('tbl_project.prj_name', $filter[3]);
            }

        }

        $this->db->select('tbl_expenses.*, tbl_project.prj_name,usrm_user.user_firstname,usrm_user.user_lastname');
        $this->db->from('tbl_expenses');
        $this->db->join('tbl_project', 'tbl_project.prj_id = tbl_expenses.project_id');
        $this->db->join('usrm_user', 'usrm_user.user_id = tbl_expenses.user_id');
        $this->db->where('prj_year', $this->session->userdata('year'));
        $this->db->where($condition);
        $this->db->limit($param['page_size'], $param['start']);
        $this->db->order_by($param['column'], $param['dir']);

        $query = $this->db->get();
        // $this->db->order_by('expenses_id DESC','expenses_date_disburse DESC');
        $data = array();
        if ($query->num_rows() > 0) {

            foreach ($query->result_array() as $key => $row) {
                if ($row['expenses_date_disburse'] == '') {
                    $row['expenses_date_disburse'] = '&nbsp;';
                } else {
                    $row['expenses_date_disburse'] = $this->mydate->date_eng2thai($row['expenses_date_disburse'], 'S');
                }

                // echo $row['expenses_date'];die();
                $row['expenses_date'] = $this->mydate->date_eng2thai($row['expenses_date'], 543, 'S');

                $row['expenses_amount_disburse'] = number_format($row['expenses_amount_disburse'], 2);
                $data[] = $row;
            }
        }

        $count_condition = $this->db->from('tbl_expenses')->where($condition)->count_all_results();
        $count = $this->db->from('tbl_expenses')->count_all_results();
        $result = array('count' => $count, 'count_condition' => $count_condition, 'data' => $data, 'error_message' => '');
        return $result;

    }

}
