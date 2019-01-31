<?php
session_start();
ini_set('memory_limit', '1024m');
//
//$timeo_start = microtime(true);
//ini_set("memory_limit","128");

//==============================================================
//==============================================================
//==============================================================
//https://master.cmss-otcsc.com/competency_master/report/report_vitayaall.php?xsiteid=cmss_master
  $url=stripslashes($_REQUEST['HtmlFile']);//
  
  if($_REQUEST['Orientation']=="P"){
	  $format='A4';//$_REQUEST['Format']."-".$_REQUEST['Orientation'];
  }else{
 	 $format=$_REQUEST['Format']."-".$_REQUEST['Orientation'];
  }
  $mgl=($mgl!="")?$mgl:"18";
  $mgr=($mgr!="")?$mgr:"18";
  $mgt=($mgt!="")?$mgt:"18";
  $mgb=($mgb!="")?$mgb:"18";
  $mgh=($mgh!="")?$mgh:"18";
  $mgf=($mgf!="")?$mgf:"0";
  
 // $filename=stripslashes($_REQUEST['filename']);//
  //echo  $url;
  //die();

include("mpdf.php");
include("html2pdf.pdflog.php");
$mpdf=new mPDF('utf-8',$format,"","",$mgl,$mgr,$mgt,$mgb,$mgh,$mgf);  
$mpdf->SetAutoFont(AUTOFONT_THAIVIET);	
$mpdf->mirrorMargins = 1;
$mpdf->allow_output_buffering = true;
$mpdf->displayDefaultOrientation = true;
$mpdf->SetDisplayMode('fullpage');

if($_REQUEST['Addlog']==1){
	$code=new pdflog();
	$code->user=$_REQUEST['Tmpuser'];
	$code->siteid=$_REQUEST['Siteid'];
	$Appname=$_REQUEST['Appname'];
	
	
	if($_REQUEST['Showcode']){
		$gcode=$code->getCode($Appname);
		$mpdf->SetWatermarkText("$gcode");
		$mpdf->showWatermarkText = true;
		$mpdf->watermark_code=true;
		$path=$code->download_path;
		$save=1;
	}
}



if($footer){
	$mpdf->setFooter('{PAGENO} of {nbpg} pages||{PAGENO} of {nbpg} pages') ;
}else{
	$mpdf->setFooter('');
}

$mpdf->LoadWriteHTML($url);
if($save){
		$mpdf->Output($path); 
		header("Location: $path");
}else{
	if($dowload){
		$mpdf->Output('cmss.pdf','D'); 
	}else{
		$mpdf->Output(); 
	}
}
exit;
//==============================================================
//==============================================================
//==============================================================


?>