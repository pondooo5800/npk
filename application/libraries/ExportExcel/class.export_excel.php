<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sanitkeawtawan
 * Date: 6/14/12 AD
 * Time: 11:45 AM
 * To change this template use File | Settings | File Templates.
 */

//
require_once 'PHPExcel.php';
class export_excel{
	var $irow=1;
    var $icol=1;
	private $fname;

	private $objPHPExcel;
	private $styleThinBlackBorderOutline;
	function export_excel(){
		$this->objPHPExcel = new PHPExcel();
		$this->objPHPExcel->setActiveSheetIndex(0);
		$this->init();
	}
	function init(){
	$this->styleThinBlackBorderOutline = array(
	'borders' => array(
		'outline' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array('argb' => 'FF000000'),
		),
	),
);
	}

	function writedata($text,$type,$prop,$border=false){
	 $cell=$this->getIntToChar($this->icol).$this->irow;
	 $cell2=$cell;
	 $this->objPHPExcel->getActiveSheet()->setCellValue($cell,$text);
     $this->objPHPExcel->getActiveSheet()->getStyle("$cell:$cell2")->getFont()->setName('TH SarabunPSK')->setSize(16);
   //  $this->objPHPExcel->getActiveSheet()->getColumnDimension($this->getIntToChar($this->icol))->setAutoSize(true);
         if(@$prop['ROWSPAN']>0||@$prop['COLSPAN']>0){
			$last_row=(@$prop['ROWSPAN']>0)?$prop['ROWSPAN']+$this->irow-1:$this->irow;
            $last_col=(@$prop['COLSPAN']>0)?$prop['COLSPAN']+$this->icol-1:$this->icol;
			$cell2=$this->getIntToChar($last_col).$last_row;
         	$this->objPHPExcel->getActiveSheet()->mergeCells("$cell:$cell2");
        }
    if($border){
        $this->objPHPExcel->getActiveSheet()->getStyle("$cell:$cell2")->applyFromArray($this->styleThinBlackBorderOutline);
    }

	$lines = preg_split( "/\r\n?|\n/", $text );
	if(count($lines)>1){
		$this->objPHPExcel->getActiveSheet()->getStyle("$cell:$cell2")->getAlignment()->setWrapText(true);
		}
	
	
	//$this->objPHPExcel->getActiveSheet()->getColumnDimension($this->getIntToChar($this->icol))->setAutoSize(true);
	
	if($type=="TH"){// header
      $style_format_V=PHPExcel_Style_Alignment::VERTICAL_CENTER;
	  $style_format_H=PHPExcel_Style_Alignment::HORIZONTAL_CENTER;
      if(@$prop['ALIGN']=="CENTER"){
          $style_format_H=PHPExcel_Style_Alignment::VERTICAL_CENTER;
       }elseif(@$prop['ALIGN']=="LEFT"){
          $style_format_H=PHPExcel_Style_Alignment::HORIZONTAL_LEFT;
      }elseif(@$prop['ALIGN']=="RIGHT"){
          $style_format_H=PHPExcel_Style_Alignment::HORIZONTAL_RIGHT;
      }
	   $this->objPHPExcel->getActiveSheet()->getStyle("$cell:$cell2")->getAlignment()->setHorizontal($style_format_H);
       $this->objPHPExcel->getActiveSheet()->getStyle("$cell:$cell2")->getAlignment()->setVertical($style_format_V);
	   $this->objPHPExcel->getActiveSheet()->getStyle("$cell:$cell2")->getFont()->setBold(true);
	  // $this->objPHPExcel->getActiveSheet()->getStyle("$cell:$cell2")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
      // $this->objPHPExcel->getActiveSheet()->getStyle("$cell:$cell2")->getFill()->getStartColor()->setARGB('FF808080');
	  
     }else{
      $style_format_V=PHPExcel_Style_Alignment::VERTICAL_CENTER;
	  $style_format_H=PHPExcel_Style_Alignment::HORIZONTAL_LEFT;
      if(@ $prop['ALIGN']=="CENTER"){
          $style_format_H=PHPExcel_Style_Alignment::HORIZONTAL_CENTER;
       }elseif(@$prop['ALIGN']=="LEFT"){
          $style_format_H=PHPExcel_Style_Alignment::HORIZONTAL_LEFT;
      }elseif(@$prop['ALIGN']=="RIGHT"){

          $style_format_H=PHPExcel_Style_Alignment::HORIZONTAL_RIGHT;
      }

	   $this->objPHPExcel->getActiveSheet()->getStyle("$cell:$cell2")->getAlignment()->setHorizontal($style_format_H);
       $this->objPHPExcel->getActiveSheet()->getStyle("$cell:$cell2")->getAlignment()->setVertical($style_format_V);
     }
		
	}
	 function export($xlsname='',$path="",$download=''){
         $xlsname = $path.$xlsname;
         $xlsname = str_replace('uploads-export','xsl',$xlsname);
		 $this->fname=$xlsname;
         $rndsname=($xlsname)?$xlsname : $path.$this->GenFilename(10,date('ymd')).'.xls';
	 	 $objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel2007');
    	 $objWriter->save($rndsname);
        if($download=="D"){
            if($this->using_ie()){
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Content-Type: application/force-download");
                header("Content-Type: application/octet-stream");
                header("Content-Type: application/download");
                header("Content-Disposition: attachment; filename={$rndsname};");
                header("Content-Transfer-Encoding: binary ");
                header("Content-Length: ".filesize($rndsname));
                readfile($rndsname);
                unlink($rndsname);
            }else{
                header("Content-Type: application/x-msexcel; name=\"$rndsname\"");
                header("Content-Disposition: inline; filename=\"$rndsname\"");
                $fh=fopen($rndsname, "rb");
                fpassthru($fh);
                unlink($rndsname);
            }
        }
	 }
    private function GenFilename($length=5,$prename=""){
        $template = "1234567890abcdefghijklmnopqrstuvwxyz";
        settype($length, "integer");
        settype($rndstring, "string");
        settype($a, "integer");
        settype($b, "integer");

        for ($a = 0; $a <= $length; $a++){
            $b = mt_rand(0, strlen($template) - 1);
            $rndstring .= $template[$b];
        }
        return $prename.$rndstring;
    }
	private function using_ie(){
    		$u_agent = $_SERVER['HTTP_USER_AGENT'];
    		$ub = false;
    		if(preg_match('/MSIE/i',$u_agent)) {
    			$ub = true;
    		}
    		return $ub;
    	}
	private function getIntToChar($num){
    			$strCell =array("","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
    			$numTemp=intval($num);
    			$str="";
                $div=floor($numTemp/26);
                $mod=($numTemp%26);
                $str=$strCell[$div].$strCell[$mod];
                return $str;
    	}
}