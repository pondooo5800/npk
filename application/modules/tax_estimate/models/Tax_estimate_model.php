<?php
class Tax_estimate_model extends CI_Model
{
	public $_dataTax;

	function getTax($parent = 0)
	{
		$year = $this->session->userdata('year');
		$this->db->select('tbl_tax.*,tbl_tax_estimate.tax_estimate');
		$this->db->from('tbl_tax');
		$this->db->join('tbl_tax_estimate', "tbl_tax_estimate.tax_id = tbl_tax.tax_id and tbl_tax_estimate.year_id = '{$year}' ", 'left');
		// $this->db->where('tax_type_input','0');
		$this->db->where('tax_parent_id', $parent);
		$this->db->where('tax_parent_id', $parent);
		$query = $this->db->get();
		foreach ($query->result() as $key => $value) {
			@$this->_dataTax[$value->tax_parent_id][$value->tax_id] = $value;

			$this->getTax($value->tax_id);
		}

		return $this->_dataTax;
	}

	function saveEstimate($year, $input)
	{
		$this->db->where('year_id', $year);
		$this->db->delete('tbl_tax_estimate');

		foreach ($input['estimate_tax'] as $tax_id => $value) {
			$value = str_replace(',', '', $value);
			$this->db->set('year_id', $year);
			$this->db->set('tax_id', $tax_id);
			$this->db->set('tax_estimate', $value);
			$this->db->insert('tbl_tax_estimate');

		}
	}
}