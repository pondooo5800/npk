<?php
session_start();
class pdflog{
	 private $_code='';
	 private $_pre_code='';
	 private $_db='competency_system';
	 public  $user;
	 public $db_pass='2010cmss';
	 public $db_user='cmss';
	 public $db_ip='61.19.255.74';
	 public $insert_ip='';
	 public $insert_path='';
	 public $siteid='';
	 public $download_path='';
	 function __construct(){
	 	mysql_connect($this->db_ip,$this->db_user,$this->db_pass) or die("Could not connect: " . mysql_error());
		mysql_select_db($this->_db) or die("Could not select database: " .mysql_error());
	 } 
	 
	 public function getCode($appname='RAISE_SALARY'){
	 	if($appname=='RAISE_SALARY'){
			
			$code=$this->genRaiseCode();
			$this->_pre_code=$this->getDBCode();
			$this->_code=$code.str_repeat('0',8-strlen($this->_pre_code)).$this->_pre_code;
			$this->insert_path="/var/www/html/up_salary/pdf_download/$this->_code".'.pdf';
			$this->download_path="../up_salary/pdf_download/$this->_code".'.pdf';
		}
		$this->saveDBCode($appname);
		return $this->_code;
	 }
	 
	 private function genRaiseCode(){
	 	return date('dmY');
	 }
	 
	 private function saveDBCode($appname){
		 	$this->insert_ip=$_SERVER['REMOTE_ADDR'];
			$insert="insert into 	log_download_pdf(precode, `code`, appname, site, ip, `user`, path)";
			$insert.="values ('".$this->_pre_code."','".$this->_code."', '".$appname."', '".$this->siteid."', '".$this->insert_ip."','".$this->user."', '".$this->insert_path.		"')";
			mysql_db_query($this->_db,$insert)or die(mysql_error());
			
	 }
	 
	 private function getDBCode(){
		$precode=1;
	 	$sql="SELECT max(ifnull(log_download_pdf.precode,0)) as maxcode FROM log_download_pdf";
		$result=mysql_db_query('competency_system',$sql);
		$row=mysql_fetch_assoc($result);
		if($row[maxcode]>0){
			$precode=$row[maxcode]+1;
		}
		return $precode;
	 }
}


?>