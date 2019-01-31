<?php
class main_model extends CI_Model
{
    //sum budget project_manage
    public function getSumProject()
    {
        $year = $this->session->userdata('year');
        $query = $this->db->query('select sum(prj_budget_sum) as budget from tbl_project_manage where project_parent is null and project_year = ' . $year);
        return $query->row()->budget;
    }


    //sum budget expenses
    public function getSumExpenses()
    {
        $year = $this->session->userdata('year');
        $sql = "SELECT prj.year_id, SUM(tbl_expenses.expenses_amount_result) AS budget
                FROM prj INNER JOIN tbl_expenses ON prj.prj_id = tbl_expenses.project_id
                WHERE prj.year_id='".$year."' ";
        $query = $this->db->query($sql);
        return $query->row()->budget;
    }

    //sum budget outsidePay
    public function getSumOutsidePay()
    {
        $year = $this->session->userdata('year');
        $sql = "SELECT tbl_outside.out_year,
                SUM(tbl_outside_pay.outside_pay_budget_sum) AS budget
                FROM tbl_outside
                INNER JOIN tbl_outside_pay ON tbl_outside.out_id = tbl_outside_pay.outside_id
                WHERE tbl_outside.out_year='".$year."' ";
        $query = $this->db->query($sql);
        return $query->row()->budget;
    }

    //sum budget estimate
    public function getSumEstimate()
    {
        $year = $this->session->userdata('year');
        $sql = "SELECT tbl_tax_estimate.year_id,
                SUM(tbl_tax_estimate.tax_estimate) AS budget
                FROM tbl_tax_estimate
                WHERE tbl_tax_estimate.year_id='".$year."' ";
        $query = $this->db->query($sql);
        return $query->row()->budget;
    }

    //sum receive
    public function getSumReceive()
    {
        $year = $this->session->userdata('year');
        $sql = "SELECT tax_receive.year_id,
                tax_notice.status,
                SUM(tax_receive.receive_amount) AS budget
                FROM tax_receive
                LEFT JOIN tax_notice ON tax_notice.notice_id = tax_receive.notice_id
                WHERE tax_receive.year_id='".$year."'
                AND tax_notice.status = 'active'";
        $query = $this->db->query($sql);
        return $query->row()->budget;
    }

    //sum budget outside
    public function getSumOutside()
    {
        $year = $this->session->userdata('year');
        $sql = "SELECT tbl_outside.out_year,
                SUM(tbl_outside.out_budget_sum) AS budget
                FROM tbl_outside
                WHERE tbl_outside.out_year='".$year."' ";
        $query = $this->db->query($sql);
        return $query->row()->budget;
    }


}
?>
