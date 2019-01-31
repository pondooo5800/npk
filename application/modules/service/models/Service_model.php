<?php
class service_model extends CI_Model
{

	function removeProjectYear($year){
		$this->db->where('project_year',$year+1);
		$this->db->delete('tbl_project_manage');

		$this->db->where('prj_year',$year+1);
		$this->db->delete('tbl_project');
		
		$this->db->where('out_year',$year+1);
    	$this->db->delete('tbl_outside');
	}

	function duplicate_project($year,$parent=''){
		$data_insert = array();
		$this->db->select('*');
		$this->db->from('tbl_project_manage');
		$this->db->where('project_year',$year);
		if($parent){
			$this->db->where('project_parent',$parent);	
		}else{
			$this->db->where('project_parent is null');
		}
		$query = $this->db->get();
		foreach ($query->result_array() as $key => $value) {
			$data_insert['project_id'] = $this->getLastProjectID();
			$data_insert['project_parent'] = $this->getNextYearManageID($value['project_parent']);
			$data_insert['project_year'] = $year+1;
			$data_insert['project_level'] = $value['project_level'];
			$data_insert['project_title'] = $value['project_title'];
			$data_insert['prj_budget_sum'] = $value['prj_budget_sum'];
			$data_insert['project_ref_id'] = $value['project_id'];

			$this->db->insert('tbl_project_manage',$data_insert);

			$this->duplicate_project($year,$value['project_id']);

			$this->duplicate_prj($year,$value['project_id'],$data_insert['project_id']);
		}
	}

	function duplicate_prj($year,$parent='',$prj_parent=''){
		$data_insert = array();
		$this->db->select('*');
		$this->db->from('tbl_project');
		$this->db->where('prj_year',$year);
		$this->db->where('prj_parent',$parent);
		$query = $this->db->get();
		foreach ($query->result_array() as $key => $value) {
			$data_insert['prj_id'] = $this->getLastProjectID();
			if($prj_parent){
				$data_insert['prj_parent'] = $prj_parent;
			}else{
				$data_insert['prj_parent'] = $this->getNextYearID($value['prj_parent']);
			}
			$data_insert['prj_year'] = $year+1;
			$data_insert['prj_name'] = $value['prj_name'];
			$data_insert['prj_budget'] = $value['prj_budget'];
			$data_insert['prj_budget_sum'] = $value['prj_budget_sum'];
			$data_insert['prj_owner'] = $value['prj_owner'];
			// $data_insert['prj_status'] = 0;
			$data_insert['prj_type'] = '1';
			$data_insert['prj_create'] = date('Y-m-d');
			$data_insert['prj_ref_id'] = $value['prj_id'];

			$this->db->insert('tbl_project',$data_insert);


			$data_log_insert = array();
			$data_log_insert['prj_budget_parent'] = 0;
			$data_log_insert['prj_id'] = $data_insert['prj_id'];
			$data_log_insert['prj_budget_type'] = '1';
			$data_log_insert['prj_amount'] = $value['prj_budget_sum'];
			$data_log_insert['prj_log_date'] = date('Y-m-d');
			$data_log_insert['prj_budget_status'] = '1';
			$this->db->insert('tbl_prj_budget_log',$data_log_insert);

			$this->duplicate_prj($year,$value['prj_id']);
		}
	}

	function getLastProjectID(){
		$last_id_project = $this->db->select('project_id')
            ->order_by('project_id', 'desc')
            ->limit(1)->get('tbl_project_manage')->row('project_id');
        $last_id_prj = $this->db->select('prj_id')
            ->order_by('prj_id', 'desc')
            ->limit(1)->get('tbl_project')->row('prj_id');

        if ($last_id_project > $last_id_prj) {
            return $last_id_project + 1;
        } else {
            return $last_id_prj + 1;
        }
	}

	function getNextYearManageID($id){
		if($id){
			$this->db->select('project_id');
			$this->db->where('project_ref_id',$id);
			$query = $this->db->get('tbl_project_manage');
			$row = $query->row();

			return $row->project_id;
		}else{
			return null;
		}
		
	}

	function getNextYearID($id){
		if($id){
			$this->db->select('prj_id');
			$this->db->where('prj_parent',$id);
			$query = $this->db->get('tbl_project');
			$row = $query->row();

			return $row->prj_id;
		}else{
			return null;
		}
	}

	function duplicate_estimate($year){
		$this->db->where('year_id',$year+1);
    	$this->db->delete('tax_notice');

        $this->db->select('*');
        $this->db->from('tax_notice');
        $this->db->where('year_id',$year);
        $query = $this->db->get();
        foreach ($query->result_array() as $key => $value) {
        	$data_insert = $value;
        	unset($data_insert['notice_id']);

        	$data_insert['year_id'] = $year+1;

        	$this->db->insert('tax_notice',$data_insert);
        }
    }

    function duplicate_estimate_tax($year){
    	$this->db->where('year_id',$year+1);
    	$this->db->delete('tbl_tax_estimate');

        $this->db->select('*');
        $this->db->from('tbl_tax_estimate');
        $this->db->where('year_id',$year);
        $query = $this->db->get();
        foreach ($query->result_array() as $key => $value) {
        	$data_insert = $value;
        	$data_insert['year_id'] = $year+1;

        	$this->db->insert('tbl_tax_estimate',$data_insert);
        }
	}
	
	// outside rec
	function duplicate_outside($year,$parent=0,$id = 0){

        $this->db->select('*');
        $this->db->from('tbl_outside');
		$this->db->where('out_year',$year);
		$this->db->where('out_parent',$parent);
		$query = $this->db->get();
		// echo '<pre>';
		// print_r($query->result_array());die();
        foreach ($query->result_array() as $key => $value) {
        	$data_insert = $value;
			unset($data_insert['out_id']);
			unset($data_insert['out_create']);
			unset($data_insert['out_update']);

			$data_insert['out_year'] = $year+1;
			$data_insert['out_create'] = date('Y-m-d');

			if($parent){
				$data_insert['out_parent'] = $id;
			}else{
				$data_insert['out_parent'] = 0;
			}

			$this->db->insert('tbl_outside',$data_insert);
			if(!$parent){
				$id = $this->db->insert_id();
			}
			$this->duplicate_outside($year,$value['out_id'],$id);
        }
	}

	// delete prj budget log
	public function deletePrjBugdet($year){
		$this->db->where('prj_year',$year);
		$query = $this->db->get('tbl_project')->result();
		foreach ($query as $key => $value) {
			$this->db->where('prj_id',$value->prj_id);
			$this->db->delete('tbl_prj_budget_log');
		}

	}

	


}