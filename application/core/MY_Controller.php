<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sanitkeawtawan
 * Date: 2/22/13 AD
 * Time: 11:25 AM
 * To change this template use File | Settings | File Templates.
 */
class MY_Controller extends  CI_Controller
{/**
 * The name of the module that this controller instance actually belongs to.
 *
 * @var string
 */
    public $module;

    /**
     * The name of the controller class for the current class instance.
     *
     * @var string
     */
    public $controller;

    /**
     * The name of the method for the current request.
     *
     * @var string
     */
    public $method;

    /**
     * Load and set data for some common used libraries.
     */
    public function __construct()
    {
        parent::__construct();

        $this->template->set_template($this->config->item('template'));
        $this->packets->template=$this->template;
        $this->packets->initial();
    }
    public function norobots(){
        $this->template->meta->add('robots','noindex,nofollow','meta');
    }

    function genMetaTag($setting=array()){
        //$setting กรณีมีการ config เอง
        //meta
        $array=$this->config->item('meta');
        if(isset($setting['meta'])){
            $array=$this->extend($this->config->item('meta'),$setting['meta']);
        }
        foreach($array as $index=>$val){
            $this->template->meta->add($index,$val,'meta');
        }
        if(isset($setting['title'])){
            $this->template->title =$setting['title'] ;
        }else{
            $this->template->title =$this->config->item('title') ;
        }
        //http-equiv
        $array=$this->config->item('http-equiv');
        if(isset($setting['http-equiv'])){
            $array=$this->extend($this->config->item('http-equiv'),$setting['http-equiv']);
        }
        foreach($array as $index=>$val){
            $this->template->meta->add($index,$val,'http-equiv');
        }

        //link
        $array=$this->config->item('link');
        if(isset($setting['link'])){
            $array=$this->extend($this->config->item('link'),$setting['link']);
        }
        foreach($array as $index=>$val){
            $this->template->meta->add($index,$val,'link');
        }

        //property
        $array=$this->config->item('property');
        if(isset($setting['property'])){
            $array=$this->extend($this->config->item('property'),$setting['property']);
        }
        foreach($array as $index=>$val){
            $this->template->meta->add($index,$val,'property');
        }

        //fbtag
        $array=$this->config->item('fbtag');
        if(isset($setting['fbtag'])){
            $array=$this->extend($this->config->item('fbtag'),$setting['fbtag']);
        }
        foreach($array as $index=>$val){
            $this->template->meta->add($index,$val,'property');
        }
    }
    private  function extend($base = array(), $replacements = array()) {
        if (!function_exists('array_replace_recursive'))
        {
            function array_replace_recursive($array, $array1)
            {
                if (function_exists('recurse')){
                    recurse($array, $array1);
                }else{
                    function recurse($array, $array1)
                    {
                        foreach ($array1 as $key => $value)
                        {
                            // create new key in $array, if it is empty or not an array
                            if (!isset($array[$key]) || (isset($array[$key]) && !is_array($array[$key])))
                            {
                                $array[$key] = array();
                            }

                            // overwrite the value in the base array
                            if (is_array($value))
                            {
                                $value = recurse($array[$key], $value);
                            }
                            $array[$key] = $value;
                        }
                        return $array;
                    }
                }


                // handle the arguments, merge one by one
                $args = func_get_args();
                $array = $args[0];
                if (!is_array($array))
                {
                    return $array;
                }
                for ($i = 1; $i < count($args); $i++)
                {
                    if (is_array($args[$i]))
                    {
                        $array = recurse($array, $args[$i]);
                    }
                }
                return $array;
            }
        }
        $base = ! is_array($base) ? array() : $base;
        $replacements = ! is_array($replacements) ? array() : $replacements;
        return array_replace_recursive($base, $replacements);
    }


    function setView($name='',$data=array()){
        $this->template->content->view($name,$data);
    }
    function publish(){
        $this->template->publish();
    }
    function json_publish($data){
        header('Content-Type: application/json; charset=utf-8');
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
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
    public function goto404(){
        redirect(base_url('page404'));
        exit;
    }

}
/**
 * Returns the CodeIgniter object.
 *
 * Example: ci()->db->get('table');
 *
 * @return \CI_Controller
 */
function ci()
{
    return get_instance();
}
