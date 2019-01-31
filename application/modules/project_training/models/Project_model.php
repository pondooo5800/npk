<?php
ini_set('memory_limit', '-1');
class project_model extends CI_Model
{
    protected $data_budget = ['', 'งบบุคลากร', 'งบดำเนินงาน', 'งบลงทุน', 'งบเงินอุดหนุน', 'งบกลาง'];
    protected $data_cost = [
        '', 'เงินเดือน (ฝ่ายการเมือง)', 'เงินเดือน (ฝ่ายประจำ)', 'ค่าตอบแทน', 'ค่าใช้สอย', 'ค่าวัสดุ', 'ค่าสาธารณูปโภค',
        'ค่าครุภัณฑ์', 'ค่าที่ดินและสิ่งก่อสร้าง', 'เงินอุดหนุน', 'งบกลาง',
    ];

    public function getProject($id = '')
    {
        if (!empty($id)) {
            $this->db->where('project_id', $id);
        }
        $this->db->where('project_year', $this->session->userdata('year'));
        $query = $this->db->get('tbl_project_manage');
        return $query->result();
    }
    public function getPrj($id = '', $old_year = false)
    {
        if (!empty($id)) {
            $this->db->where('tbl_project.prj_id', $id);
        }
        if ($old_year) {
            $year = (int) $this->session->userdata('year') - 1;
        } else {
            $year = $this->session->userdata('year');
        }
        $this->db->select('tbl_project.*,sum(tbl_prj_budget_log.prj_amount) as budget_log');
        $this->db->from('tbl_project');
        $this->db->where('tbl_project.prj_year', $year);
        $this->db->where('tbl_project.prj_active', '1');
        $this->db->join('tbl_prj_budget_log', 'tbl_project.prj_id = tbl_prj_budget_log.prj_id', 'left');
        $this->db->group_by('tbl_project.prj_id');
        $query = $this->db->get();
        return $query->result();
    }
    public function getPrjArray()
    {

        $this->db->where('prj_year', $this->session->userdata('year'));
        $this->db->where('prj_active', '1');
        $query = $this->db->get('tbl_project');
        $data = array();
        foreach ($query->result() as $key => $value) {
            $data[$value->prj_id] = $value;
        }
        return $data;
    }

    public function getBudget($id = '')
    {
        $this->db->select('prj_budget_sum');
        $this->db->where('prj_id', $id);
        return $this->db->get('tbl_project')->row();

    }

    public function insertProject($data)
    {
        //check  last id project and prj
        $last_id_project = $this->db->select('project_id')
            ->order_by('project_id', 'desc')
            ->limit(1)->get('tbl_project_manage')->row('project_id');
        $last_id_prj = $this->db->select('prj_id')
            ->order_by('prj_id', 'desc')
            ->limit(1)->get('tbl_project')->row('prj_id');

        if ($last_id_project > $last_id_prj) {
            $data['project_id'] = $last_id_project + 1;
            return $this->db->insert('tbl_project_manage', $data);
        } else {
            $data['project_id'] = $last_id_prj + 1;
            return $this->db->insert('tbl_project_manage', $data);
        }
    }

    public function editProject($id, $data)
    {
        if (!empty($id)) {
            $this->db->where('project_id', $id);
            return $this->db->update('tbl_project_manage', $data);
        }

    }

    public function delPrj($id, $state)
    {
        if (!empty($state)) {
            //update  budget all

            //delete convet  budget
            $convert = $this->getBudgetLog($id, '2');
            if (!empty($convert)) {
                foreach ($convert as $key => $value) {
                    $this->delPrjConvert($value->prj_budget_id);
                }
            }

            $parent = $this->getPrj($id);

            $parent = $parent[0]->prj_parent;
            // $data['prj_owner_update'] = $_SESSION['user_id'];
            // $data['prj_active'] = '0';

            // remove log prj budget and parent id
            // $query = $this->db->query("SELECT prj_budget_id  FROM tbl_prj_budget_logห  WHERE prj_budget_type = 2 AND prj_id = " . $id);
            // foreach ($query->result() as $key => $value) {
            //     print_r($value);
            //     // $this->db->where('prj_budget_parent', $value->prj_budget_id);
            //     //  $this->db->delete('tbl_prj_budget_log');
            // }
            // die();

            $this->db->where('project_id', $id);
            $this->db->delete('tbl_expenses');

            $this->db->where('prj_id', $id);
            $this->db->delete('tbl_prj_budget_log');

            //remove log prj
            $this->db->where('prj_id', $id);
            $this->db->delete('tbl_project_log');

            $this->db->where('prj_id', $id);
            $this->db->delete('tbl_project');

            $data = $this->updateBudget($parent);
            return true;
            //clear data log is n't active
            // $this->db->where('state', '0');
            // return $this->db->delete('tbl_project_log');
        } else {
            $parent = $this->getProject($id);
            $parent = $parent[0]->project_parent;
            // $data['prj_owner_update'] = $_SESSION['user_id'];
            // $data['prj_active'] = '0';
            $this->db->where('project_id', $id);
            $this->db->delete('tbl_project_manage');
            if ($parent != '') {
                $data = $this->updateBudget($parent);
            }

            return true;
        }

    }
    public function delPrjConvert($id)
    {
        $log_budget = $this->getBudgetLogById($id);
        // print_r($log_budget);die();
        if (!empty($log_budget)) {
            $budget = $this->getBudget($log_budget->prj_ref_id);

            $budget_update['prj_budget_sum'] = $budget->prj_budget_sum + $log_budget->prj_amount;
            $this->project_model->insertPrj($budget_update, $log_budget->prj_ref_id);

            $this->db->where('prj_budget_parent', $log_budget->prj_budget_id);
            $this->db->delete('tbl_prj_budget_log');

            $this->db->where('prj_budget_id', $id);
            $this->db->delete('tbl_prj_budget_log');

        }

        return true;
    }

    public function insertPrj($data, $id = '')
    {

        if (!empty($id)) {
            $this->db->where('prj_id', $id);
            $this->db->update('tbl_project', $data);

            //update  budget all
            $parent = $this->getPrj($id);
            if (!empty($parent[0]->prj_parent)) {
                $data = $this->updateBudget($parent[0]->prj_parent);
            }

            return true;
        }
        //check  last id project and prj
        $last_id_project = $this->db->select('project_id')
            ->order_by('project_id', 'desc')
            ->limit(1)->get('tbl_project_manage')->row('project_id');
        $last_id_prj = $this->db->select('prj_id')
            ->order_by('prj_id', 'desc')
            ->limit(1)->get('tbl_project')->row('prj_id');

        if ($last_id_project > $last_id_prj) {
            $data['prj_id'] = $last_id_project + 1;

        } else {
            $data['prj_id'] = $last_id_prj + 1;

        }
        $data['prj_owner_update'] = $_SESSION['user_id'];
        // $parent = $this->getPrj($data['prj_parent']);
        $this->db->insert('tbl_project', $data);
      
        $this->updateBudget($data['prj_parent']);
        return $data['prj_id'];

    }

    public function setLogBudget($data, $data_id = array(), $type = '', $ref = false)
    {
        if ($data['prj_amount'] != 0) {
            if (!empty($data_id['id'])) {

                $data['prj_budget_status'] = '0';
                $this->db->where('prj_id', $data_id['id']);
                if ($data_id['ref'] != '') {
                    $this->db->where('prj_ref_id', $data_id['ref']);
                }

                // if ($ref){
                //     $this->db->where('prj_ref_id',$id);
                // }
                $this->db->where('prj_budget_type', $type);
                return $this->db->update('tbl_prj_budget_log', $data);
            }
            $query = $this->db->query('SELECT prj_budget_id  FROM tbl_prj_budget_log  WHERE prj_id = ' . $data['prj_id']);
            if ($query->num_rows() > 0) {
            } else {
                $data['prj_budget_status'] = '1';
            }

            $data['prj_log_date'] = date('Y-m-d');
            $this->db->insert('tbl_prj_budget_log', $data);
            return $this->db->insert_id();

        }
        return true;

    }

    public function getState()
    {
        $this->db->select('state');
        return @$this->db->get('tbl_project')->row()->state;
    }

    public function updateState($state)
    {
        if ($state == 'false') {
            return $this->db->query("UPDATE tbl_project SET state = '1'");
        } else {
            return $this->db->query("UPDATE tbl_project SET state = '0'");
        }

    }

    public function getUser()
    {
        return $this->db->get('usrm_user')->result();
    }

    //updatee budget data project or prj
    public function updateBudget($id = '', $parent = '')
    {
        //sum budget data
        if (!empty($parent)) {
            $id = $parent;
            // echo $id;die();
            $query = $this->db->query('SELECT SUM(T2.prj_budget_sum) as num FROM tbl_project_manage T2 WHERE T2.project_parent = ' . $id);
        } else {
            $query = $this->db->query("SELECT SUM(T2.prj_budget_sum) as num FROM tbl_project T2 WHERE prj_active = '1' and T2.prj_parent = " . $id);
        }

        $data['prj_budget_sum'] = @$query->row()->num;
        //update budget to prj_id
        //find prj or project
        $query = $this->db->query('SELECT prj_id  FROM tbl_project  WHERE prj_id = ' . $id);

        if ($query->num_rows() > 0) {
            $this->db->where('prj_id', $id);
            $this->db->update('tbl_project', $data);
            //get parent id
            $parent = $this->getPrj($id);
            if (!empty($parent[0]->prj_parent)) {
                $this->updateBudget($parent[0]->prj_parent);
            } else {
                return false;
            }

        } else { //update budget to project
            $this->db->where('project_id', $id);
            $this->db->update('tbl_project_manage', $data);
            //get parent id
            $parent = $this->getProject($id);
            if (!empty($parent[0]->project_parent)) {
                $this->updateBudget('', $parent[0]->project_parent);
            } else {
                return false;
            }

        }
    }

    public function getTreeProjectManage($project)
    {
        $ul = '';
        foreach ($project as $key => $value) {

            if (empty($value->project_parent)) {
                $ul .= '<tbody>';
                $ul .= '<tr><td><b>' . $value->project_title . '</b></td>
                        <td align="right">' . number_format($value->prj_budget) . '</td>
                        <td></td><td></td></tr>';
                $ul .= $this->getTreeChildProject($value->project_id);
                $ul .= '</tbody>';
            }

        }

        return $ul;
    }

    public function getTreeChildProject($parent = '0', &$ul = '', $tab = '')
    {
        //tab data
        $tab = '&emsp;&emsp;' . $tab;

        $this->db->where('project_parent', $parent);
        $query = $this->db->get('tbl_project_manage');
        foreach ($query->result() as $key => $row) {

            $ul .= '<tr>';
            if (@$row->project_level == 3) {
                $ul .= "<td>{$tab}" . $this->data_budget[$row->project_title] . "</td>";
            } else if (@$row->project_level == 4) {
                $ul .= "<td>{$tab}" . $this->data_cost[$row->project_title] . "</td>";
            } else {
                $ul .= "<td>{$tab}" . $row->project_title . "</td>";
            }

            $ul .= "<td align='right'>" . number_format($row->prj_budget) . "</td>";
            $ul .= "<td></td>";
            $ul .= "<td></td>";
            $ul .= '</tr>';

            $this->getTreeChildProject(@$row->project_id, $ul, $tab);
        }

        return $ul;
    }

    //sum budget project_manage
    public function getSumProject()
    {
        $year = $this->session->userdata('year');
        $query = $this->db->query('select sum(prj_budget_sum) as budget from tbl_project_manage where project_parent is null and project_year = ' . $year);
        return $query->row()->budget;
    }

    //get tree prj title
    public function getTitleTree($parent = '', &$data = array())
    {
        $this->db->select('*');
        $this->db->where('project_id', $parent);
        $this->db->where('project_year', $this->session->userdata('year'));
        $this->db->from('tbl_project_manage');
        $query = $this->db->get();
        foreach ($query->result() as $key => $value) {

            $data[$value->project_id] = $value->project_title;
            $this->getTitleTree($value->project_parent, $data);
        }
        return $data;
    }
    public function getTitleTreeChild($id = '', &$data = array())
    {
        $this->db->select('*');
        $this->db->where('prj_id', $id);
        $this->db->where('prj_year', $this->session->userdata('year'));
        $this->db->from('tbl_project');
        $query = $this->db->get();
        foreach ($query->result() as $key => $value) {
            $cout = $this->db->query('select prj_id from tbl_project where prj_id = ' . $value->prj_parent)->num_rows();

            if ($cout > 0) {
                $data[$value->prj_id] = $value->prj_name;
                $this->getTitleTreeChild($value->prj_parent, $data);
            } else {
                $data[$value->prj_id] = $value->prj_name;
                $this->getTitleTree($value->prj_parent, $data);
            }

        }

        return $data;
    }

    public function searchPrj($data)
    {
        $this->db->select('tbl_project.*,sum(tbl_expenses.expenses_amount_disburse) as budget');
        $this->db->from('tbl_project');
        $this->db->where('prj_year', $this->session->userdata('year'));
        $this->db->like('prj_name', $data);
        $this->db->where('prj_active', '1');
        $this->db->join('tbl_expenses', 'tbl_expenses.project_id = tbl_project.prj_id', 'left');
        $this->db->group_by(array("prj_id", "prj_name"));
        $query = $this->db->get();
        return $query->result();

    }

    public function getPrjSelect($data)
    {
        $this->db->select('tbl_project.*,sum(tbl_expenses.expenses_amount_disburse) as expenses_amount_result');
        $this->db->from('tbl_project');
        $this->db->where('prj_year', $this->session->userdata('year'));
        $this->db->where('prj_id', $data);
        $this->db->join('tbl_expenses', 'tbl_expenses.project_id = tbl_project.prj_id', 'left');
        $this->db->group_by('prj_id');
        $query = $this->db->get();
        return $query->result();

    }

    public function getBudgetLog($id, $type = '')
    {
        $this->db->select('tbl_prj_budget_log.* , tbl_project.prj_name,tbl_project.prj_parent');
        if (!empty($type)) {
            $this->db->where('prj_budget_type', $type);
            $this->db->where('prj_budget_parent is not null', null, false);
        }
        $this->db->from('tbl_prj_budget_log');
        $this->db->where('prj_amount != 0', null, false);
        $this->db->where('tbl_prj_budget_log.prj_id', $id);
        $this->db->join('tbl_project', 'tbl_project.prj_id = tbl_prj_budget_log.prj_ref_id', 'left');
        $this->db->join('tbl_project_log', 'tbl_project_log.prj_id = tbl_project.prj_ref_id', 'left');

        return $this->db->get()->result();
    }

    public function getLastBudgetLog($id)
    {
        $this->db->where('prj_id', $id);
        $this->db->where('prj_budget_type', '2');
        $this->db->order_by('prj_budget_id', "desc")->limit(1);
        return $this->db->get('tbl_prj_budget_log')->row();
    }

    public function getBudgetLogNotNagative($id, $type = '')
    {
        $this->db->select('tbl_prj_budget_log.* , tbl_project.prj_name,tbl_project.prj_parent,tbl_project.prj_budget_sum,sum(tbl_expenses.expenses_amount_disburse) as budget');
        if (!empty($type)) {
            $this->db->where('tbl_prj_budget_log.prj_budget_type', $type);
            $this->db->where('prj_budget_parent is not null', null, false);
        }
        $this->db->from('tbl_prj_budget_log');
        // $this->db->where('prj_amount > 0', null, false);
        $this->db->where('tbl_prj_budget_log.prj_id', $id);
        $this->db->join('tbl_project', 'tbl_project.prj_id = tbl_prj_budget_log.prj_ref_id', 'left');
        $this->db->join('tbl_expenses', 'tbl_expenses.project_id = tbl_project.prj_id', 'left');
        $this->db->group_by('tbl_project.prj_id');
        return $this->db->get()->result();
    }

    public function getBudgetLogById($id)
    {

        $this->db->where('prj_budget_id', $id);
        return $this->db->get('tbl_prj_budget_log')->row();
    }

    public function getPrjLog($id)
    {

        $this->db->select('tbl_project_log.prj_update,usrm_user.user_firstname,usrm_user.user_lastname');
        $this->db->from('tbl_project_log');
        $this->db->where('tbl_project_log.prj_id', $id);
        $this->db->join('usrm_user', 'usrm_user.user_id = tbl_project_log.prj_owner_update');
        $query = $this->db->get();
        return $query->result();
    }

    public function getUserAll()
    {
        $val = $this->db->get('usrm_user')->result();
        $data = array();
        foreach ($val as $key => $value) {

            $data[$value->user_id] = $value->user_firstname . ' ' . $value->user_lastname;
        }
        return $data;

    }

}
