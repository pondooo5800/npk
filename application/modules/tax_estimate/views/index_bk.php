<div class="right_col" role="main">
  <section class="row">
          <div class="col-md-6 col-sm-4 col-xs-4">
              <h3>ประมาณการรายรับ</h3>
          </div>
  </section>
  <div class="row">
   <div class="x_content">
     <div class="x_panel">
     <br>
     
     <form method="post" action="<?php echo base_url('tax_estimate/saveEstimate') ?>">
          <table class="table table-bordered jambo_table">
              <thead>
                <tr>
                  <th width="80%">หมวดรายได้</th>
                  <th>ประมาณการ</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($tax[0] as $key => $value) { ?>
                <tr>
                  <td><span style="font-weight: bolder;"><?php echo $value->tax_name; ?></span></td>
                  <td></td>
                </tr>
                <?php foreach ($tax[$value->tax_id] as $key => $value2) { ?>
                  <tr>
                    <td><span style="padding-left: 15px;"><?php echo $value2->tax_name; ?></span></td>
                    <td><input type="text" class="numeric text-right form-control" name="estimate_tax[<?php echo $value2->tax_id ?>]" value="<?php echo $value2->tax_estimate ?>" ></td>
                  </tr>
                <?php 
              } ?>
              <?php 
            } ?>
              </tbody>
            </table>

              <div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3 text-center">
                    <button type="submit" value="Submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก
                    </button>
                    <button onclick="window.location.replace('<?php echo site_url('main/dashborad'); ?>');" type="button" class="btn btn-warning"><i class="fa fa-close"></i> ยกเลิก
                    </button>
              </div>
          
    
    </from>
    </div>

    </div>
  </div>
</div>



