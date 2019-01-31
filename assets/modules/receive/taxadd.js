$(function(){

      $('#province').select2();
      $('#district').select2();
      $('#subdistrict').select2();
  
      $('#province_send').select2();
      $('#district_send').select2();
      $('#subdistrict_send').select2();
  
      $('#province_1').select2();
      $('#district_1').select2();
      $('#subdistrict_1').select2();
      $('#province_send_1').select2();
      $('#district_send_1').select2();
      $('#subdistrict_send_1').select2();
  
      //check add adress
    //   create tab1
      $("input[name=individual_adr_1]").on("ifChanged", function() {

        if ($("#individual_adr_12").is(":checked")) {
            $( "#individualadd_tab1" ).toggle(true);
        }else{
            $( "#individualadd_tab1" ).toggle(false);
        }
      });
    //   create tab2
      $("input[name=individual_adr_2]").on("ifChanged", function() {
    
        if ($("#individual_adr_22").is(":checked")) {
            $( "#individualadd_tab2" ).toggle(true);
        }else{
            $( "#individualadd_tab2" ).toggle(false);
        }
      });
    //   edit tab1
      $("input[name=individual_adr]").on("ifChanged", function() {
    
        if ($("#individual_adr2").is(":checked")) {
            $( "#individual_tab1" ).toggle(true);
        }else{
            $( "#individual_tab1" ).toggle(false);
        }
      });
    //   edit tab2
    
    $("input[name=individual_adr1]").on("ifChanged", function() {

    if ($("#individual_adr12").is(":checked")) {
        $( "#individual_tab2" ).toggle(true);
    }else{
        $( "#individual_tab2" ).toggle(false);
    }
    });
   
      
      
      
    
        function clearData(){
        
          $('input').val('');
          $('select').val('');
          return true;
        }
  
  
        //check address new 
     
  
      
  
  
        //get data district or sub district 1
        $('body').on('change',"select[name='individual_provice[0]']",function(e){
          e.preventDefault();
          var data = $("select[name='individual_provice[0]']").val();
            $.ajax({
                  'type':'POST',
                  'url':domain+'receive/getDistrict',
                  'cache':false,
                  'data':{province:data},
                  'success':function(html){
                      $("select[name='individual_district[0]']").html(html);
                  }
            });
            return false;
        });
        $('body').on('change',"select[name='individual_district[0]']",function(e){
          e.preventDefault();
          var data = $("select[name='individual_district[0]']").val();
            $.ajax({
                  'type':'POST',
                  'url':domain+'receive/getSubDistrict',
                  'cache':false,
                  'data':{district:data},
                  'success':function(html){
                      $("select[name='individual_subdistrict[0]']").html(html);
                  }
            });
            return false;
        });
        $('body').on('change',"select[name='individual_send_province[0]']",function(e){
          e.preventDefault();
          var data = $("select[name='individual_send_province[0]']").val();
            $.ajax({
                  'type':'POST',
                  'url':domain+'receive/getDistrict',
                  'cache':false,
                  'data':{province:data},
                  'success':function(html){
                      $("select[name='individual_send_district[0]']").html(html);
                  }
            });
            return false;
        });
        $('body').on('change',"select[name='individual_send_district[0]']",function(e){
          e.preventDefault();
          var data = $("select[name='individual_send_district[0]']").val();
            $.ajax({
                  'type':'POST',
                  'url':domain+'receive/getSubDistrict',
                  'cache':false,
                  'data':{district:data},
                  'success':function(html){
                      $("select[name='individual_send_subdistrict[0]']").html(html);
                  }
            });
            return false;
        });
        
        //get data district or sub district 2
  
        $('body').on('change',"select[name='individual_provice[1]']",function(e){
        
          e.preventDefault();
          var data = $("select[name='individual_provice[1]']").val();
            $.ajax({
                  'type':'POST',
                  'url':domain+'receive/getDistrict',
                  'cache':false,
                  'data':{province:data},
                  'success':function(html){
                      $("select[name='individual_district[1]']").html(html);
                  }
            });
            return false;
        });
        $('body').on('change',"select[name='individual_district[1]']",function(e){
          e.preventDefault();
          var data = $("select[name='individual_district[1]']").val();
            $.ajax({
                  'type':'POST',
                  'url':domain+'receive/getSubDistrict',
                  'cache':false,
                  'data':{district:data},
                  'success':function(html){
                      $("select[name='individual_subdistrict[1]']").html(html);
                  }
            });
            return false;
        });
        $('body').on('change',"select[name='individual_send_province[1]']",function(e){
          e.preventDefault();
          var data = $("select[name='individual_send_province[1]']").val();
            $.ajax({
                  'type':'POST',
                  'url':domain+'receive/getDistrict',
                  'cache':false,
                  'data':{province:data},
                  'success':function(html){
                      $("select[name='individual_send_district[1]']").html(html);
                  }
            });
            return false;
        });
        $('body').on('change',"select[name='individual_send_district[1]']",function(e){
          e.preventDefault();
          var data = $("select[name='individual_send_district[1]']").val();
            $.ajax({
                  'type':'POST',
                  'url':domain+'receive/getSubDistrict',
                  'cache':false,
                  'data':{district:data},
                  'success':function(html){
                      $("select[name='individual_send_subdistrict[1]']").html(html);
                  }
            });
            return false;
        });


        //potection form
        $('#tab_1').blur(function(){
            var data = $('#tab_1').val();
            $.ajax({
                'type':'POST',
                'url':domain+'receive/checkDupIndividual',
                'cache':false,
                'data':{data:data},
                'success':function(data){
                    if (data){
                        alertify.error('เลขประจำตัวผู้เสียภาษีมีผู้อื่นใช้แล้ว');
                        $("#tab_1").val('');
                        $("#tab_1").focus();
                        return false;
                    }
                }
          });
        });
        $('#tab_2').blur(function(){
            var data = $('#tab_2').val();
            $.ajax({
                'type':'POST',
                'url':domain+'receive/checkDupIndividual',
                'cache':false,
                'data':{data:data},
                'success':function(data){
                    if (data){
                        alertify.error('เลขประจำตัวผู้เสียภาษีมีผู้อื่นใช้แล้ว');
                        $("#tab_2").val('');
                        $("#tab_2").focus();
                        return false;
                    }
                }
          });
        });
       
  
    
});
