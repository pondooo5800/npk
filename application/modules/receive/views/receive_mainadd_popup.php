<div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="addmodal">บันทึกรายการ</h4>
      </div>
      
      
      <div class="modal-body">
        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
          <div class="form-group">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="id_tax">ปีงบประมาณ
                </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control" type="text" id="type_tax">
                    <option>2562</option>
                    <option>2561</option>
                    <option>2560</option>
                    <option>2559</option>
                  </select>
              </div>
          </div>

          <div class="form-group">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="id_tax">ผู้เสียภาษี
                </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="input-group">
                      <input type="text" class="form-control col-md-4 col-xs-12">
                          <span class="input-group-btn">
                              <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#detail" style="margin-right: 0px;">
                                  <i class="fa fa-search"></i>
                              </button>
                          </span>
                  </div>
              </div>
          </div>

          <div class="collapse" id="detail">
                <div class="form-group">
                      <label class="control-label col-md-4 col-sm-3 col-xs-12" for="id_tax">เลขประจำตัวผู้เสียภาษี
                      </label>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <p class="form-control-static">xxxxxxxxxxxxx</p>
                    </div>
                </div>

                <div class="form-group">
                      <label class="control-label col-md-4 col-sm-3 col-xs-12" for="id_tax">ประเภทผู้เสียภาษี
                      </label>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <p class="form-control-static">บุคคลธรรมดา</p>
                    </div>
                </div>
           </div>
           <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first">หมวดรายได้
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="colorselector" class="selectpicker form-control" data-hide-disabled="true" data-live-search="true">
                            <optgroup label="หมวดภาษีอากร">
                              <option value="property">ภาษีโรงเรือนและที่ดิน</option>
                              <option value="local">ภาษีบำรุงท้องที่</option>
                              <option value="label">ภาษีป้าย</option>
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
                        <label for="second" class="control-label col-md-4 col-sm-3 col-xs-12" for="id_tax">วันที่ประเมิน
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                              <div class='input-group date' id='myDatepicker'>
                                  <input type='text' class="form-control" />
                                  <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                  </span>
                              </div>                        
                          </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="id_tax">เล่มที่
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="id_tax" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="id_tax">เลขที่
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="id_tax" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

            <div class="form-group type-value" id="property" >
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="id_tax">ประเภทโรงเรือนหรือสิ่งปลูกสร้าง
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" type="text" id="type_tax">
                                  <option>ตึก</option>
                                  <option>เรือน</option>
                                  <option>โรง</option>
                                  <option>ตึกแถว</option>
                                  <option>โรงเรือนแถว</option>
                                  <option>แพ</option>
                                  <option>อื่นๆ</option>
                              </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="id_tax">(หลัง)
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" id="id_tax" class="form-control col-md-7 col-xs-12">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="id_tax">(ห้อง)
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" id="id_tax" class="form-control col-md-7 col-xs-12">
                            </div>
                          </div>
            </div>

                      
            <div class="form-group type-value" id="local" style="display:none">
                          <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="id_tax">เนื้อที่ดิน (ไร่)
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" id="id_tax" class="form-control col-md-7 col-xs-12">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="id_tax">เนื้อที่ดิน (งาน)
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" id="id_tax" class="form-control col-md-7 col-xs-12">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="id_tax">เนื้อที่ดิน (วา)
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" id="id_tax" class="form-control col-md-7 col-xs-12">
                            </div>
                          </div>
            </div>

            <div class="form-group type-value" id="label" style="display:none">
                          <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="id_tax">ประเภทป้าย
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <select class="form-control" type="text" id="type_tax">
                                    <option>มีอักษรไทยล้วน</option>
                                    <option>มีอักษรไทยปนอักษรต่างประเทศหรือเครื่องหมาย</option>
                                    <option>ป้ายที่ไม่มีอักษรไทย</option>
                                </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="id_tax">จำนวนป้าย
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" id="id_tax" class="form-control col-md-7 col-xs-12">
                            </div>
                          </div>
            </div>

            <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="id_tax">ภาษีที่ต้องชำระ
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="id_tax" class="form-control col-md-7 col-xs-12">
                        </div>
            </div>

          
        </form>
      </div>

      <div class="modal-footer">
          <button onclick="window.location.replace('<?php echo site_url('receive/receive_main'); ?>');" type="button" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก
          </button>

          <button type="button" class="btn btn-warning" data-dismiss="modal"> ยกเลิก
          </button>
    </div>
</div>
