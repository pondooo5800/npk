
<div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="addmodal">เบิกจ่าย</h4>
      </div>
      
      
      <div class="modal-body">
        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
        <div class="form-group col-md-1 ">
        </div>
            <div class="form-group col-md-10">
                    <div class="easyui-panel" style="padding: 10px; width: 460px;" id='easyui'>
                      <botton onclick='getSelected()'>get</botton>
                        <ul class="easyui-tree" id="tt">
                            <li>
                                <span>แผนงาน / โครงการ</span>
                                <ul>
                                    <li data-options="state:'closed'">
                                        <span>แผนงานส่งเสริมคุณภาพสิ่งแวดล้อม</span>
                                        <ul>
                                            <li class="li_project" id="li_1" data-id='1'>
                                                <span>โครงการวิเคราะห์นโยบายและแผน</span>
                                            </li>
                                            <li class="li_project" id="li_2" data-id='2'>
                                                <span>โครงการจัดทำงบประมาณ</span>
                                            </li>
                                            <li class="li_project" id="li_3" data-id='3'>
                                                <span>โครงการวิจัยและประเมินผล</span>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <span>แผนงานอ่างเก็บน้ำสวนสาธารณะ</span>
                                        <ul>
                                            <li class="li_project" id="li_4" data-id='4'>
                                                <span>โครงการวิเคราะห์นโยบายและแผน</span>
                                            </li>
                                            <li class="li_project" id="li_5" data-id='5'>
                                                <span>โครงการจัดทำงบประมาณ</span>
                                            </li>
                                            <li class="li_project" id="li_6" data-id='6'>
                                                <span>โครงการวิจัยและประเมินผล</span>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>แผนงานจัดการขยะมูลฝอยแบบบูรณาการสามระบบ</li>
                                    <li>แผนงานการบริหารทรัพยากรบุคคล</li>
                                    <li>แผนงานอุโมงค์ลดโลกร้อน</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
            </div>

            <div class="form-group col-md-1 ">
            </div>
            <div class="form-group" style="margin-bottom: 0px;" style="display: none;" id="project_selected">
                    <label for="second" class="control-label col-md-5 col-sm-3 col-xs-12" for="id_tax">โครงการ
                    </label>
                        <div class="col-md-5 col-sm-6 col-xs-12">
                            <span id="span_project"></span>  
                            <input type="hidden" name="project_id" value="">                  
                        </div>
            </div>
        
            <div class="form-group" style="margin-bottom: 0px;">
                    <label for="second" class="control-label col-md-5 col-sm-3 col-xs-12" for="id_tax">วันที่เบิกจ่าย
                    </label>
                        <div class="col-md-5 col-sm-6 col-xs-12">
                            <div class='input-group date col-md-12 col-xs-12' id='inputdatepicker'>
                                  <input type='text' class="form-control datepicker" />
                            </div>                       
                        </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-5 col-sm-3 col-xs-12" for="id_tax">เลขที่เช็ค / ฎีกา
                </label>
                <div class="col-md-5 col-sm-6 col-xs-12">
                    <input type="text" placeholder="56030011132010000017" id="id_tax" class="form-control col-md-7 col-xs-12">
                </div>
          </div>

          <div class="form-group">
                <label class="control-label col-md-5 col-sm-3 col-xs-12" for="id_tax">จำนวนเงินที่เบิกจ่าย
                </label>
                <div class="col-md-5 col-sm-6 col-xs-12">
                    <input type="text" placeholder="0.00" id="id_tax" class="form-control col-md-7 col-xs-12">
                </div>
          </div>

          <div class="form-group">
                <label class="control-label col-md-5 col-sm-3 col-xs-12" for="id_tax">ผู้ดำเนินการ
                </label>
              <div class="col-md-5 col-sm-6 col-xs-12">
                    <input type="text" placeholder="ไพโรจน์ สุริยะ" id="id_tax" class="form-control col-md-7 col-xs-12">   
              </div>
          </div>
          
        </form>
      </div>

      <div class="modal-footer">
          <button onclick="window.location.replace('<?php echo site_url('expenditure/expenditure_prj'); ?>');" type="button" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก
          </button>

          <button type="button" class="btn btn-warning" data-dismiss="modal"> ยกเลิก
          </button>
    </div>
</div>

<script type="text/javascript">
    function getSelected(){
            var node = $('#tt').tree('getSelected');
            if (node){
                var s = node.text;
                if (node.attributes){
                    s += ","+node.attributes.p1+","+node.attributes.p2;
                }

                // alert(s);
                $('#easyui').hide();

                s += "<span id='change_project'> x </span>";

                $('#span_project').html(s);
                $('#project_selected').show();

                setChangeBtn();
            }
        }

    function setChangeBtn(){
      $('#change_project').click(function(){
          $('#easyui').show();
          $('#span_project').html('');
          $('#project_selected').hide();    
      });
    }

      
</script>
