<script src="<?php echo base_url(); ?>/assets/plugins/gauge.js/dist/gauge.min.js"></script>
        
    <div class="right_col" role="main">
          <br />
            <div class="x_panel">
              <div class="x_title">
              <h2><i class="fa fa-shirtsinbulk"></i> งบประมาณรายจ่าย</h2></span>
                <div class="clearfix"></div>
              </div>
              <div class="col-md-8 col-sm-8 col-xs-8">

                <div class="row">
                  <div class="col-md-6 col-sm-4 col-xs-4">
                        <h4>กรอบงบประมาณ</h4>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-4 text-right">
                        <h3 class=""><?php echo number_format($sum_project_training, 2); ?></h3>
                  </div>
                  <div class="col-md-2 col-sm-4 col-xs-4">
                        <h4>บาท</h4>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-sm-4 col-xs-4">
                        <h4>งบประมาณที่เบิกจ่าย</h4>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-4 text-right">
                        <h3 class=""><?php echo number_format($sum_pay, 2); ?></h3>
                  </div>
                  <div class="col-md-2 col-sm-4 col-xs-4">
                        <h4>บาท</h4>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-sm-4 col-xs-4">
                        <h4>งบประมาณเหลือจ่าย</h4>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-4 text-right">
                        <h3 class="green"><?php echo number_format($sum_project_training - $sum_pay, 2); ?></h3>
                  </div>
                  <div class="col-md-2 col-sm-4 col-xs-4">
                        <h4>บาท</h4>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-4 col-xs-4 text-center">
                <div >
                        <h4>ร้อยละความก้าวหน้าในการเบิกจ่าย</h4>
                        <canvas width="200" height="120" id="gauge_01" class="" style="width: 200px; height: 120px;"></canvas>
                        <div style="color:#000;"><b><?php echo @number_format(($sum_pay / $sum_project_training) * 100, 2); ?>%</b></dev>
                </div>
                <script>
                  var opts = {
                  angle: 0, // The span of the gauge arc
                  lineWidth: 0.4, // The line thickness
                  radiusScale: 2, // Relative radius
                  pointer: {
                    length: 0.8, // // Relative to gauge radius
                    strokeWidth: 0.035, // The thickness
                    color: '#000000' // Fill color
                  },
                  limitMax: true,     // If false, max value increases automatically if value > maxValue
                  limitMin: true,     // If true, the min value of the gauge will be fixed
                  };
                  var target = document.getElementById('gauge_01'); // your canvas element
                  var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
                  gauge.maxValue = <?php echo intval($sum_project_training); ?>; // set max gauge value
                  gauge.setMinValue(0);  // Prefer setter over gauge.minValue = 0
                  gauge.animationSpeed = 52; // set animation speed (32 is default value)
                  gauge.set(<?php echo (intval($sum_pay)) ? intval($sum_pay) : 0.1; ?>); // set actual value
                </script>
              </div>
            </div>
          </div>

          <div class="x_panel">
              <div class="x_title">
              <h2><i class="fa fa-shirtsinbulk"></i> รายรับ</h2></span>
                <div class="clearfix"></div>
              </div>
              <div class="col-md-8 col-sm-8 col-xs-8">

                <div class="row">
                  <div class="col-md-6 col-sm-4 col-xs-4">
                        <h4>ประมาณการรายรับ</h4>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-4 text-right">
                        <h3 class=""><?php echo number_format($sum_estimate, 2); ?></h3>
                  </div>
                  <div class="col-md-2 col-sm-4 col-xs-4">
                        <h4>บาท</h4>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-sm-4 col-xs-4">
                        <h4>รายรับจริง</h4>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-4 text-right">
                        <h3 class=""><?php echo number_format($sum_receive, 2); ?></h3>
                  </div>
                  <div class="col-md-2 col-sm-4 col-xs-4">
                        <h4>บาท</h4>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-sm-4 col-xs-4">
                        <h4>รายรับคงเหลือที่ต้องจัดเก็บ</h4>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-4 text-right">
                        <h3 class="red"><?php echo number_format($sum_receive_balance, 2); ?></h3>
                  </div>
                  <div class="col-md-2 col-sm-4 col-xs-4">
                        <h4>บาท</h4>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-4 col-xs-4 text-center">
                <div >
                        <h4>ร้อยละความก้าวหน้าในการจัดเก็บภาษี</h4>
                        <canvas width="200" height="120" id="gauge_02" class="" style="width: 200px; height: 120px;"></canvas>
                        <div style="color:#000;"><b><?php echo @number_format(($sum_receive / $sum_estimate) * 100, 2); ?>%</b></dev>
                </div>
                <script>
                var opts = {
                angle: 0, // The span of the gauge arc
                lineWidth: 0.4, // The line thickness
                radiusScale: 2, // Relative radius
                pointer: {
                  length: 0.8, // // Relative to gauge radius
                  strokeWidth: 0.035, // The thickness
                  color: '#000000' // Fill color
                },
                limitMax: true,     // If false, max value increases automatically if value > maxValue
                limitMin: true,     // If true, the min value of the gauge will be fixed
                };
                var target = document.getElementById('gauge_02'); // your canvas element
                var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
                gauge.maxValue = <?php echo intval($sum_estimate); ?>; // set max gauge value
                gauge.setMinValue(0);  // Prefer setter over gauge.minValue = 0
                gauge.animationSpeed = 52; // set animation speed (32 is default value)
                gauge.set(<?php echo (intval($sum_receive)) ? intval($sum_receive) : 0.1; ?>); // set actual value
                </script>
              </div>
            </div>
          </div>
        </div>
    </div>