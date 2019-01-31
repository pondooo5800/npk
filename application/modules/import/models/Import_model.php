<?php defined('BASEPATH') OR exit('No direct script access allowed');

class import_model extends MY_Model
{

	function getTmpHouse(){
		$query = $this->db->get('tmp_data_house');
		return $query->result();
	}	

	function getProviceID($name){
		$this->db->where('area_name_th',$name);
		$this->db->where('area_type','Province');
		$query = $this->db->get('std_area');
		if($query->num_rows()){
			$row = $query->row();
			return $row->area_code;
		}else{
			return null;
		}
		
	}

	function getDistrictID($provice,$name){
		$provice = substr($provice, 0,1);
		$this->db->where('area_name_th',$name);
		$this->db->where('area_type','Amphur');
		$this->db->where(" area_code LIKE '{$provice}%' ");
		$query = $this->db->get('std_area');
		if($query->num_rows()){
			$row = $query->row();
			return $row->area_code;
		}else{
			return null;
		}
	}

	function getSubDistrictID($district,$name){
		$district = substr($district, 0,3);
		$this->db->where('area_name_th',$name);
		$this->db->where('area_type','Tambon');
		$this->db->where(" area_code LIKE '{$district}%' ");
		$query = $this->db->get('std_area');
		if($query->num_rows()){
			$row = $query->row();
			return $row->area_code;
		}else{
			return null;
		}
	}

	function getIndividual_id($number){
		$this->db->where('individual_number',$number);
		$query = $this->db->get('tbl_individual');
		if($query->num_rows()){
			$row = $query->row();
			return $row->individual_id;
		}else{
			return null;
		}
	}


	function importNoticeHouse($dataTmp){
		$num_all= $num_insert = 0;
		foreach ($dataTmp as $key => $value) {
			$num_all++;
			if($value->tmp_Identification!=''){
				if($this->getIndividual_id($value->tmp_Identification)){
					$tmp_rec_number_one = explode('/', $value->tmp_rec_number_one);
					$this->db->set('tax_year',$this->session->userdata('year'));
					$this->db->set('year_id',$this->session->userdata('year'));
					$this->db->set('tax_id',8);
					$this->db->set('individual_id',$this->getIndividual_id($value->tmp_Identification));
					$this->db->set('notice_number',@$tmp_rec_number_one[0]);
					$this->db->set('notice_no',@$tmp_rec_number_one[1]);
					$this->db->set('notice_estimate',$value->tmp_tax_one);
					$this->db->set('notice_address_number',$value->tmp_number);
					$this->db->set('notice_address_moo',$value->tmp_village);
					$this->db->set('notice_address_subdistrict',$value->subdistrict_id);
					$this->db->insert('tax_notice');
					$num_insert++;
				}
				
			}
		}

		echo 'All: '.$num_all.' / '.$num_insert.'<br>';
	}


	function getTmpLabel(){
		$query = $this->db->get('tmp_data_label');
		return $query->result();
	}

	function importNoticeLabel($dataTmp){
		$num_all= $num_insert = 0;
		foreach ($dataTmp as $key => $value) {
			$num_all++;
			if($value->tmp_Identification!=''){
				if($this->getIndividual_id($value->tmp_Identification)){
					$tmp_rec_number_one = explode('/', $value->tmp_rec_number_one);
					$this->db->set('tax_year',$this->session->userdata('year'));
					$this->db->set('year_id',$this->session->userdata('year'));
					$this->db->set('tax_id',10);
					$this->db->set('individual_id',$this->getIndividual_id($value->tmp_Identification));
					$this->db->set('notice_number',@$tmp_rec_number_one[0]);
					$this->db->set('notice_no',@$tmp_rec_number_one[1]);
					$this->db->set('notice_estimate',$value->tmp_tax_before);
					$this->db->insert('tax_notice');
					$num_insert++;
				}
				
			}
		}
	}

	function getTmpWard(){
		$query = $this->db->get('tmp_data_ward');
		return $query->result();
	}

	function importNoticeWard($dataTmp){
		$num_all= $num_insert = 0;
		foreach ($dataTmp as $key => $value) {
			$num_all++;
			if($value->tmp_Identification!=''){
				if($this->getIndividual_id($value->tmp_Identification)){
					$tmp_rec_number_one = explode('/', $value->tmp_number_receipt);
					$this->db->set('tax_year',$this->session->userdata('year'));
					$this->db->set('year_id',$this->session->userdata('year'));
					$this->db->set('tax_id',9);
					$this->db->set('individual_id',$this->getIndividual_id($value->tmp_Identification));
					$this->db->set('notice_number',@$tmp_rec_number_one[0]);
					$this->db->set('notice_no',@$tmp_rec_number_one[1]);
					$this->db->set('notice_estimate',$value->tmp_sum_tax);
					$this->db->set('notice_address_number',$value->tmp_number);
					$this->db->set('land_deed_number',$value->tmp_deed_number);
					$this->db->set('land_rai',$value->tmp_farm);
					$this->db->set('land_ngan',$value->tmp_work);
					$this->db->set('land_wa',$value->tmp_wa);
					$this->db->set('land_tax',$value->tmp_tax_number);
					$this->db->insert('tax_notice');
					$num_insert++;
				}
				
			}
		}

		echo 'All: '.$num_all.' / '.$num_insert.'<br>';
	}
}