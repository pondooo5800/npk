<?php defined('BASEPATH') or exit('No direct script access allowed');

class import extends MY_Controller{

	public function index()
	{
		$this->load->model('import_model');
		$dataTmp = $this->import_model->getTmpHouse();

		echo '<pre>';
		// print_r($dataTmp);
		foreach ($dataTmp as $key => $value) {
			$provice_id = $this->import_model->getProviceID($value->tmp_province_send);
			$district_id = $this->import_model->getDistrictID($provice_id,$value->tmp_district_send);
			$subdistrict_id_send = $this->import_model->getSubDistrictID($district_id,$value->tmp_subdistrict_send);

			$subdistrict_id = $this->import_model->getSubDistrictID('50010000',$value->tmp_subdistrict);

			$dataTmp[$key]->provice_id_send = $provice_id;
			$dataTmp[$key]->district_id_send = $district_id;
			$dataTmp[$key]->subdistrict_id_send = $subdistrict_id_send;
			$dataTmp[$key]->subdistrict_id = $subdistrict_id;

		}
		$this->import_model->importNoticeHouse($dataTmp);
		
	}

	function label(){
		$this->load->model('import_model');
		$dataTmp = $this->import_model->getTmpLabel();
		echo '<pre>';
		print_r($dataTmp);
		$this->import_model->importNoticeLabel($dataTmp);
	}

	function ward(){
		$this->load->model('import_model');
		$dataTmp = $this->import_model->getTmpWard();
		echo '<pre>';
		print_r($dataTmp);
		$this->import_model->importNoticeWard($dataTmp);
	}


}