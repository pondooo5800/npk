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
                  <th class="text-center">ประมาณการ</th>
                </tr>
              </thead>
              <tbody>
              <?php

              $sum_all = 0;

              foreach ($tax[0] as $key => $value) {
                  $id = 'c'.$key;
                ?>
                <tr>
                  <td><span style="font-weight: bolder;"><?php echo $value->tax_name; ?></span></td>
                  <td id="<?php echo $id;?>" class="numeric text-right" style="font-size: 16px;font-weight: bold"></td>
                </tr>
                <?php
                $sum_p1 = 0;

                foreach ($tax[$value->tax_id] as $key2 => $value2) { ?>
                  <tr>
                    <td><span style="padding-left: 15px;"><?php echo $value2->tax_name; ?></span></td>
                    <td><input onkeyup="cal('<?php echo $id;?>')" type="text" class="<?php echo $id;?> numeric text-right form-control" name="estimate_tax[<?php echo $value2->tax_id ?>]" value="<?php echo $value2->tax_estimate ?>" ></td>
                  </tr>
                <?php
                  $sum_p1+=$value2->tax_estimate;
              } ?>
              <?php

              if($sum_p1>0) {
                $sum_all+=$sum_p1;
              ?>
                <script>$("#c<?php echo $key;?>").html("<?php echo number_format($sum_p1,2);?>");</script>
              <?php
              }


            } ?>

                <tr>
                  <td><span style="padding-left: 15px; font-size: 18px; font-weight: bold">รวม</span></td>
                  <td id="sum_all" class="text-right numeric" style="font-size: 18px;font-weight: bold"><?php echo number_format($sum_all,2);?></td>
                </tr>

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


<script>
function addCommas(n)
{
  var val = Math.round(Number(n) *100) / 100;
  var parts = val.toString().split(".");

  if(parts[1]<10)parts[1]=parts[1]+'0';

  var num = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (parts[1] ? "." + parts[1] : ".00");

  return num;
}

  function cal(node) {
    //console.log($("#"+$(node).data("node")).html());

    var sum = 0;
    $('input.'+node).each(function(index,data){
      if($(data).val() > 0){
        sum = sum+parseFloat($(data).val());
      }else{
        sum = sum+parseFloat(0);
      }
    });

    $('#'+node).html(addCommas(sum));

    sum_all = 0;
    $("input.numeric").each(function(index,data){
        if($(data).val() > 0){
          sum_all = sum_all+parseFloat($(data).val());
        }else{
          sum_all = sum_all+parseFloat(0);
        }

    });
    $("#sum_all").html(addCommas(sum_all));

  }
</script>
