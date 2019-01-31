<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class budget_year
{

    public function check_year()
    {
        $ci = &get_instance();
        $year = $ci->session->userdata('year');
        if (empty($year)) {
            $ci->session->set_userdata('year', date('Y'));
        }

    }

}
