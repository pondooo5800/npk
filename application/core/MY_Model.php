<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by JetBrains PhpStorm.
 * User: sanitkeawtawan
 * Date: 2/22/13 AD
 * Time: 11:15 AM
 */
class MY_Model extends  CI_Model{

    public function __construct() {
        parent::__construct();
    }
    public function _sussess($message='',$values="",$code="0"){
        return array(
            'error'=>false,
            'code'=>$code,
            'message'=>$message,
            'values'=>$values,
        );
    }
    public function _error($message='',$values="",$code="0"){
        return array(
            'error'=>true,
            'code'=>$code,
            'message'=>$message,
            'values'=>$values,
        );
    }


}
