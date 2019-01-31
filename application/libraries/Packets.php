<?php
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 2/27/14 AD
 * Time: 5:40 PM
 */

class Packets {
    public $template;
    private $_ci;
    private $temp=array();
    private $listpackets=array();
    public function __construct()
    {
        $this->_ci = & get_instance();
    }

    function initial(){

    }

    public function  install($packetsName=""){
        //print_r(ENVIRONMENT);
        $this->temp=array();
        $rootPath=$this->getRootPath();
        if(array_key_exists($packetsName,$this->listpackets)){
            if(array_key_exists('css',$this->listpackets[$packetsName])){
                // กรณีที่ไม่ใช่ mode development
                if(ENVIRONMENT!="development"){
                    $css_content = "/* created : " . date("YY:MM:dd") . "*/";
                    $outputFile = $packetsName ;

                    $lessfile = $rootPath."assets/less/".$outputFile.".less";
                    $cssfile_real = $rootPath."assets/css/compressed/".$outputFile.".min.css";
                    $cssfile = "assets/css/compressed/".$outputFile.".min.css";
                    if(!file_exists($cssfile_real)){
                        foreach($this->listpackets[$packetsName]['css'] as $css){
                            $css_content .= file_get_contents($css);
                        }
                        @file_put_contents($lessfile,$css_content);
                        $less = $this->_ci->lessphp->object();
                        $less->setFormatter("compressed");
                        try {
                            $this->_ci->lessphp->object()->checkedCompile($lessfile,$cssfile_real);
                        } catch (Exception $ex) {
                            echo "lessphp fatal error: ".$ex->getMessage();
                        }
                    }
                    if($this->template){
                        $this->template->stylesheet->add($cssfile);
                    }
                } else {
                    if(array_key_exists('css',$this->listpackets[$packetsName])){
                        foreach($this->listpackets[$packetsName]['css'] as $css){
                            if($this->template){
                                $this->template->stylesheet->add($css);
                            }
                        }
                    }
                }
            }

            if(array_key_exists('js',$this->listpackets[$packetsName])){
                // กรณีที่ไม่ใช่ mode development
                if(ENVIRONMENT!="development"){
                    $js_content = "/* created : " . date("YY:MM:dd") . "*/";
                    $jsfile_real = $rootPath."assets/js/compressed/".$outputFile.".js";
                    $jsfile = "assets/js/compressed/".$outputFile.".min.js";
                    $outputFile = $packetsName ;
                    $lessfile = $rootPath."assets/less/".$outputFile.".js";
                    if(!file_exists($jsfile_real)){
                        foreach($this->listpackets[$packetsName]['js'] as $js){
                            $js_content .= file_get_contents($js);
                        }
                        @file_put_contents($jsfile,$js_content);
                    }
                    if($this->template){
                        $this->template->javascript->add($jsfile);
                    }
                } else {
                    if(array_key_exists('js',$this->listpackets[$packetsName])){
                        foreach($this->listpackets[$packetsName]['js'] as $js){
                            if($this->template){
                                $this->template->javascript->add($js);
                            }
                        }
                    }
                }
            }


//            if(array_key_exists('js',$this->listpackets[$packetsName])){
//                foreach($this->listpackets[$packetsName]['js'] as $js){
//                    if($this->template){
//                        $this->template->javascript->add($js);
//                    }
//                }
//            }
        }
        return $this->temp;
    }

    private function genurl($url){
        if (!stristr($url, 'http://') && !stristr($url, 'https://') && substr($url, 0, 2) != '//') {
            $url = $this->_ci->config->item('base_url') . $url;
        }
        return $url;
    }
    private function getRootPath(){
        $str="";
        $str=str_replace("index.php","",$_SERVER['SCRIPT_FILENAME']);
        $str=str_replace("index.html","",$str);
        return $str;
    }
} 