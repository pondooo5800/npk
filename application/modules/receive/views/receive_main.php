<div class="right_col" role="main">
          
            <div class="page-title">
              <div class="title_left">
                <h3>รายการการประเมินรายรับ</h3>
              </div>
            </div>

              <br>
              <br>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                        <div class="col-xs-12 text-right">
                            <button type="button" class="btn btn-success"  data-toggle="collapse" data-target="#search" title="ค้นหา"><i class="fa fa-search"></i>
                            </button>
                            <button onclick="window.location.replace('receive_add');" type="button" class="btn btn-success" title="เพิ่มรายการ"> <i class="fa fa-plus-square" ></i>
                            </button>
                            <button onclick="window.location.replace('');" type="button" class="btn btn-success" title="ทำซ้ำข้อมูล"><i class="glyphicon glyphicon-duplicate"></i>
                            </button>
                            <button onclick="window.location.replace('');" type="button" class="btn btn-success" title="นำเข้าข้อมูล"><i class="fa fa-download"></i>
                            </button>
                            <button onclick="window.location.replace('');" type="button" class="btn btn-success" title="พิมพ์ใบแจ้งรายการการประเมิน"><i class="glyphicon glyphicon-print"></i>
                            </button>
                        </div>
                    <div class="clearfix"></div>
                  </div>
                  
                  <div class="collapse" id="search" class="x_content">
                      <br />
                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                            <div class="form-group">
                              <label class="control-label col-md-4 col-sm-3 col-xs-12" for="type_tax">ประเภทผู้เสียภาษี
                              </label>
                              <div class="col-md-5 col-sm-6 col-xs-12">
                                <select class="form-control" type="text" id="type_tax">
                                  <option>บุคคลธรรมดา</option>
                                  <option>นิติบุคคล</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-4 col-sm-3 col-xs-12" for="id_tax">เลขประจำตัวผู้เสียภาษี
                              </label>
                              <div class="col-md-5 col-sm-6 col-xs-12">
                                <input type="text" id="id_tax" placeholder="4371239640692" class="form-control col-md-7 col-xs-12">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="middle-name" class="control-label col-md-4 col-sm-3 col-xs-12" for="name_tax">ชื่อผู้เสียภาษี</label>
                              <div class="col-md-5 col-sm-6 col-xs-12">
                                <input type="text" id="name_tax" placeholder="สมชาย ใจดี" class="form-control col-md-7 col-xs-12">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-4 col-sm-3 col-xs-12" for="income_tax">หมวดรายได้
                              </label>
                              <div class="col-md-5 col-sm-6 col-xs-12">
                                <select id="first-disabled" class="selectpicker form-control" data-hide-disabled="true" data-live-search="true">

                                  <optgroup label="หมวดภาษีอากร">
                                    <option>ภาษีโรงเรือนและที่ดิน</option>
                                    <option>ภาษีบำรุงท้องที่</option>
                                    <option>ภาษีป้าย</option>
                                    <option>ภาษีสรรพสามิต</option>
                                    <option>ภาษีสุรา</option>
                                    <option>ภาษีและค่าธรรมเนียมรถยนต์และล้อเลื่อน</option>
                                    <option>ภาษีมูลค่าเพิ่ม 1 ใน 9</option>
                                    <option>ภาษีมูลค่าเพิ่ม พรบ.กำหนดแผน</option>
                                    <option>ภาษีธุรกิจเฉพาะ</option>
                                    <option>ค่าธรรมเนียมจดทะเบียนสิทธิและนิติกรรม</option>
                                    <option>ค่าภาคหลวงปิโตรเลียม</option>
                                    <option>ค่าภาคหลวงธรรมเนียมป่าไม้และสิ่งประดิษฐ์</option>
                                    <option>ค่าภาคหลวงแร่</option>
                                  </optgroup>
                                  <optgroup label="หมวดค่าธรรมเนียม ค่าปรับ และใบอนุญาต">
                                    <option>ค่าธรรมเนียมเกี่ยวกับการควบคุมอาคาร</option>
                                    <option>ค่าปรับผู้ทำผิดกฎจราจร</option>
                                    <option>ค่าธรรมเนียมเกี่ยวกับสาธารณสุข</option>
                                    <option>ค่าใบอนุญาตเกี่ยวกับการควบคุมอาคาร</option>
                                    <option>ค่าปรับการผิดสัญญา</option>
                                    <option>ค่าธรรมเนียมและรักษาคุณภาพสิ่งแวดล้อม</option>
                                    <option>ค่าธรรมเนียมทางวิ่งและที่จอดรถยนต์</option>
                                    <option>ค่าธรรมเนียมใบอนุญาตการพนัน</option>
                                    <option>ค่าอนุญาตใช้น้ำบาดาล</option>>
                                    <option>ค่าธรรมเนียมเกี่ยวกับการทะเบียนราษฎร์</option>
                                    <option>ค่าปรับและค่าธรรมเนียมอื่นๆ</option>
                                    <option>ค่าใบอนุญาตขายสุรา</option>
                                    <option>ค่าใบอนุญาตตั้งโรงงาน</option>
                                    <option>ค่าใบอนุญาตอื่นๆ</option>
                                  </optgroup>
                                  <optgroup label="หมวดรายได้จากทรัพย์สิน">
                                    <option>ดอกเบี้ยเงินฝากธนาคาร</option>
                                    <option>ค่าเช่าและบริการสถานที่</option>
                                  </optgroup>
                                  <optgroup label="หมวดรายได้สาธารณูปโภคและสาธารณสุขฯ">
                                    <option>รายได้จากสาธารณูปโภคอื่น</option>
                                    <option>งานแพทย์แผนไทย</option>
                                    <option>งานโรงพยาบาล</option>
                                  </optgroup>
                                  <optgroup label="หมวดรายได้เบ็ดเตล็ด">
                                    <option>ค่าขายแบบแปลน</option>
                                    <option>คำบำรุงศูนย์พัฒนาเด็ก</option>
                                    <option>รายได้เบ็ดเตล็ด</option>
                                  </optgroup>
                                  <optgroup label="หมวดเงินอุดหนุน">
                                    <option>เงินอุดหนุนทั่วไป (เงินอุดหนุนตามอำนาจหน้าที่ฯ)</option>
                                    <option>เงินอุดหนุนทั่วไประบุวัตถุประสงค์/เฉพาะกิจ</option>
                                  </optgroup>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              
                              <div class="col-md-5 col-sm-6 col-xs-12">
                                
                            </div>
                            
                            <div class="form-group">
                              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 text-center">
                                <br>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>&nbsp;ค้นหา</button>
                                <button type="reset"  class="btn btn-warning" ><i class="fa fa-refresh"></i>&nbsp;คืนค่า</button>
                              </div>
                            </div>
                          <div class="ln_solid"></div>
                      </form>
                  </div>

                </div>


                 <div class="x_content">
                    <table id="myTable" class="display" style="width:100%">                        
                        <thead>
                          <tr>
                            <th style="width: 30px;">ลำดับ</th>
                            <th >เลขประจำตัวผู้เสียภาษี</th>
                            <th>ชื่อผู้เสียภาษี</th>
                            <th>ประเภทผู้เสียภาษี</th>
                            <th>หมวดรายได้</th>
                            <th>จำนวนเงินที่ประเมิน (บาท)</th>
                            <th style="width: 120px;">เครื่องมือ</th>
                          </tr>
                        </thead>
                        <tbody>
                        <tr>
                          <td align="center">1</td>
                          <td align="center">8396269419703</td> 
                          <td>สมชาย ใจดี</td>
                          <td>บุคคลธรรมดา</td>
                          <td>ภาษีป้าย</td>
                          <td align="right">1,600.00</td>
                          <td>
                            <center>
                                <div class="btn-group ">
                                    <button type="button" class="btn btn-success btn-sm" title="พิมพ์ใบแจ้งรายการการประเมิน">
                                        <i class="glyphicon glyphicon-print"></i>
                                    </button>
                                    <button type="button" class="btn btn-success btn-sm" title="แก้ไข">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#delmodal" title="ลบ">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </button>
                                </div>
                            </center>               
                          </td>
                        </tr>

                        <tr>
                          <td align="center" align="center">2</td>
                          <td align="center">4010791379607</td> 
                          <td>พงษ์ศัก คงมา</td>
                          <td>นิติบุคคล</td>
                          <td>ภาษีโรงเรือนและที่ดิน</td>
                          <td align="right">3,400.00</td>
                          <td>
                            <center>
                                <div class="btn-group ">
                                    <button type="button" class="btn btn-success btn-sm" title="พิมพ์ใบแจ้งรายการการประเมิน">
                                        <i class="glyphicon glyphicon-print"></i>
                                    </button>
                                    <button type="button" class="btn btn-success btn-sm" title="แก้ไข">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#delmodal" title="ลบ">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </button>
                                </div>
                            </center>               
                          </td>
                        </tr>

                        <tr>
                          <td align="center">3</td>
                          <td align="center">1756043006342</td> 
                          <td>สมบูรณ์ เอื้ออัชฌาสัย</td>
                          <td>บุคคลธรรมดา</td>
                          <td>ภาษีบำรุงท้องที่</td>
                          <td align="right">400.00</td>
                          <td>
                            <center>
                                <div class="btn-group ">
                                    <button type="button" class="btn btn-success btn-sm" title="พิมพ์ใบแจ้งรายการการประเมิน">
                                        <i class="glyphicon glyphicon-print"></i>
                                    </button>
                                    <button type="button" class="btn btn-success btn-sm" title="แก้ไข">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#delmodal" title="ลบ">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </button>
                                </div>
                            </center>               
                          </td>
                        </tr>

                        <tr>
                          <td align="center">4</td>
                          <td align="center">9983696322119</td> 
                          <td>ชูศักดิ์ เกียรติเฉลิมคุณ</td>
                          <td>นิติบุคคล</td>
                          <td>ภาษีโรงเรือนและที่ดิน</td>
                          <td align="right">3,400.00</td>
                          <td>
                            <center>
                                <div class="btn-group ">
                                    <button type="button" class="btn btn-success btn-sm" title="พิมพ์ใบแจ้งรายการการประเมิน">
                                        <i class="glyphicon glyphicon-print"></i>
                                    </button>
                                    <button type="button" class="btn btn-success btn-sm" title="แก้ไข">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#delmodal" title="ลบ">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </button>
                                </div>
                            </center>               
                          </td>
                        </tr>

                        <tr>
                          <td align="center">5</td>
                          <td align="center">7872035432812</td> 
                          <td>ดำรงค์ ปคุณวานิช</td>
                          <td>บุคคลธรรมดา</td>
                          <td>ภาษีป้าย</td>
                          <td align="right">1,600.00</td>
                          <td>
                            <center>
                                <div class="btn-group ">
                                    <button type="button" class="btn btn-success btn-sm" title="พิมพ์ใบแจ้งรายการการประเมิน">
                                        <i class="glyphicon glyphicon-print"></i>
                                    </button>
                                    <button type="button" class="btn btn-success btn-sm" title="แก้ไข">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#delmodal" title="ลบ">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </button>
                                </div>
                            </center>               
                          </td>
                        </tr>

                        <tr>
                          <td align="center">6</td>
                          <td align="center">3899846161597</td> 
                          <td>พรมภิราช พันธุ์ยุลา</td>
                          <td>นิติบุคคล</td>
                          <td>ภาษีบำรุงท้องที่</td>
                          <td align="right">1,600.00</td>
                          <td>
                            <center>
                                <div class="btn-group ">
                                    <button type="button" class="btn btn-success btn-sm" title="พิมพ์ใบแจ้งรายการการประเมิน">
                                        <i class="glyphicon glyphicon-print"></i>
                                    </button>
                                    <button type="button" class="btn btn-success btn-sm" title="แก้ไข">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#delmodal" title="ลบ">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </button>
                                </div>
                            </center>               
                          </td>
                        </tr>

                        <tr>
                          <td  align="center">7</td>
                          <td align="center">1853922756311</td> 
                          <td>ทรงพล อาริยวัฒน์</td>
                          <td>นิติบุคคล</td>
                          <td>ภาษีป้าย</td>
                          <td align="right">2,000.00</td>
                          <td>
                            <center>
                                <div class="btn-group ">
                                    <button type="button" class="btn btn-success btn-sm" title="พิมพ์ใบแจ้งรายการการประเมิน">
                                        <i class="glyphicon glyphicon-print"></i>
                                    </button>
                                    <button type="button" class="btn btn-success btn-sm" title="แก้ไข">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#delmodal" title="ลบ">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </button>
                                </div>
                            </center>               
                          </td>
                        </tr>

                        <tr>
                          <td  align="center">8</td>
                          <td align="center">1347035378265</td> 
                          <td>เพชร ยินดีรัมย์</td>
                          <td>บุคคลธรรมดา</td>
                          <td>ภาษีโรงเรือนและที่ดิน</td>
                          <td align="right">1,000.00</td>
                          <td>
                            <center>
                                <div class="btn-group ">
                                    <button type="button" class="btn btn-success btn-sm" title="พิมพ์ใบแจ้งรายการการประเมิน">
                                        <i class="glyphicon glyphicon-print"></i>
                                    </button>
                                    <button type="button" class="btn btn-success btn-sm" title="แก้ไข">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#delmodal" title="ลบ">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </button>
                                </div>
                            </center>               
                          </td>
                        </tr>

                        <tr>
                          <td  align="center">9</td>
                          <td align="center">9585701591998</td> 
                          <td>บจ.ตวงศิริโฮลดิ้ง จำกัด</td>
                          <td>นิติบุคคล</td>
                          <td>ภาษีโรงเรือนและที่ดิน</td>
                          <td align="right">3,000.00</td>
                          <td>
                            <center>
                                <div class="btn-group ">
                                    <button type="button" class="btn btn-success btn-sm" title="พิมพ์ใบแจ้งรายการการประเมิน">
                                        <i class="glyphicon glyphicon-print"></i>
                                    </button>
                                    <button type="button" class="btn btn-success btn-sm" title="แก้ไข">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#delmodal" title="ลบ">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </button>
                                </div>
                            </center>               
                          </td>
                        </tr>

                         <tr>
                          <td  align="center">10</td>
                          <td align="center">4475486542975</td> 
                          <td>บจ.ห้างทองอรุณชัย จำกัด</td>
                          <td>นิติบุคคล</td>
                          <td>ภาษีป้าย</td>
                          <td align="right">1,000.00</td>
                          <td>
                            <center>
                                <div class="btn-group ">
                                    <button type="button" class="btn btn-success btn-sm" title="พิมพ์ใบแจ้งรายการการประเมิน">
                                        <i class="glyphicon glyphicon-print"></i>
                                    </button>
                                    <button type="button" class="btn btn-success btn-sm" title="แก้ไข">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#delmodal" title="ลบ">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </button>
                                </div>
                            </center>               
                          </td>
                        </tr>
                        <tbody>
                      </table>
                  </div>

                    </div>
                  </div>
                </div>

              </div>
            </div>
</div>

        <!-- Modal Popup -->
          <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="addmodal" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <?php $this->load->view('receive/receive_mainadd_popup.php'); ?>
            </div>
          </div>
          
          <div class="modal fade" id="delmodal" tabindex="-1" role="dialog" aria-labelledby="delmodal" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <?php $this->load->view('receive/del_popup.php'); ?>
            </div>
          </div>



<style>
th{
  text-align: center;
}
</style>
        


