<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sanitkeawtawan
 * Date: 6/14/12 AD
 * Time: 11:45 AM
 * To change this template use File | Settings | File Templates.
 */

require_once("class.export_excel.php");
class html2excel extends export_excel
{
    public $html='';
    public $UTF8=1;
    public $qote="'";
    public $rowstart=1;
    public function loadhtml(){
        $table=array();
        $tr=array();
        $td=array();
        $array_tag=array('TH'=>'th','TD'=>'td');
	    $in=0;
        $irow=1;
                if (preg_match_all('/<tr([^>]*)>(.*?)<\/tr>/ism',$this->html,$tr)) {
                    foreach ($tr[0] as $in_tr=>$data_tr){//tr
                        $row_his=0;
                        $icol=0;

						//===========================
						foreach($array_tag as $tagid=>$tag){
						$th=array();
                        if (preg_match_all('/<'.$tag.'([^>]*)>(.*?)<\/'.$tag.'>/ism',$data_tr,$th)) {
                            $col=0;
                            $col_his=0;

                            foreach ($th[0] as $in_th=>$data_th){//td
                                $col++;
                                   if($irow>1){
                                      while(isset($table[$in][$irow][$col])){
                                          $col++;
                                     }
                                   }
                                $result=array();
                                $prop=$this->getproperty($th[1][$in_th]);
                                $result['row']=$irow;
                                $result['col']=$col;
                                $result['type']="$tagid";
                                $result['text']=$this->removetag($th[2][$in_th]);
                                $result['property']=$prop;
                                $col_his=@(int) $prop['COLSPAN'];
                                $table[$in][$irow][$col]=$result; 
                                if(isset($prop['ROWSPAN'])&&isset($prop['COLSPAN'])){
                                    for($i=0;$i<(int)$prop['ROWSPAN'];$i++){
                                        for($j=0;$j<(int)$prop['COLSPAN'];$j++){
                                            //$xcol=($j%$prop['COLSPAN']);
                                            if(!is_array($table[$in][$irow+$i][$col+$j])){
                                             $table[$in][$irow+$i][$col+$j]=$result['text'];
                                            }
                                        }
                                    }
                                }else{
                                    if(@(int)$prop['ROWSPAN']>0){
                                        for($i=1;$i<(int)$prop['ROWSPAN'];$i++){
                                            if(!isset($table[$in][$irow+$i][$col])){
                                                $table[$in][$irow+$i][$col]=$result['text'];
                                            }

                                        }
                                    }

                                    if(@(int)$prop['COLSPAN']>0){
                                        for($j=1;$j<(int)$prop['COLSPAN'];$j++){
                                            if(!isset($table[$in][$irow][$col+$j])){
                                             $table[$in][$irow][$col+$j]=$result['text'];
                                            }
                                        }
                                    }

                                }
								
                                $col=($col_his>0)?($col_his)+$col-1:$col;
                            }
                          }
						
						}//tag
						

                       $irow++;

                    }
                 }
        return $table;
    }
    private function removetag($content){
		$content=trim($content);
		$content= preg_replace('#<br\s*/?>#', "\r\n", $content);
        $content= preg_replace('/<[^>]*>/', '', $content);
		$content=str_replace('&nbsp;',' ',  $content);
		if($content!=""){
			if(substr($content,0,1)=="0"){
					$content=" ".$content;
			}
		}
        return $content;
    }
    public function getproperty($result){
        $mm=array();
        $pro=array();
        $result=strtoupper($result);
        if($this->qote=="'"){
            if (preg_match_all( "/ALIGN=[\'](.*?)[\']/ism",$result,$mm)) {//COLSPAN
                foreach ($mm[1] as $in=>$val){//td
                    $pro['ALIGN']=$val;

                }
            }
            if (preg_match_all( "/COLSPAN=[\'](.*?)[\']/ism",$result,$mm)) {//COLSPAN
                foreach ($mm[1] as $in=>$val){//td
                    $pro['COLSPAN']=$val;

                }
            }
            if (preg_match_all( "/ROWSPAN=[\'](.*?)[\']/ism",$result,$mm)) {//ROWSPAN
                foreach ($mm[1] as $in=>$val){//td
                    $pro['ROWSPAN']=$val;

                }
            }
        }else{
            if (preg_match_all( '/ALIGN=[\"](.*?)[\"]/ism',$result,$mm)) {//COLSPAN
                foreach ($mm[1] as $in=>$val){//td
                    $pro['ALIGN']=$val;

                }
            }
            if (preg_match_all( '/COLSPAN=[\"](.*?)[\"]/ism',$result,$mm)) {//COLSPAN
                foreach ($mm[1] as $in=>$val){//td
                    $pro['COLSPAN']=$val;

                }
            }
            if (preg_match_all( '/ROWSPAN=[\"](.*?)[\"]/ism',$result,$mm)) {//ROWSPAN
                foreach ($mm[1] as $in=>$val){//td
                    $pro['ROWSPAN']=$val;

                }
            }
        }

    return $pro;
}
    public function setcaption($caption){
            $this->caption=$caption;
    }

    function addData($data,$border=false){
        foreach ($data as $tblid=>$table){
            foreach ($table as $rowid=>$row){
                foreach ($row as $colid=>$col){
                    if(is_array($col)){
                        $this->icol=$col['col'];
                        $this->irow=$this->rowstart;
                        if($this->UTF8){
                            self::writedata( $col['text'],$col['type'],$col['property'],$border);
                        }else{
                            self::writedata(iconv('TIS-620','UTF-8', $col['text']),$col['type'],$col['property'],$border);

                        }
                    }
                }
                $this->rowstart++;
            }

        }

    }
    public  function Output($filename,$path="",$action=""){
        self::export($filename,$path,$action);
    }
}
