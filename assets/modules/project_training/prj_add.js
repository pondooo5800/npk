$(function () {

    var cloneIndex = $(".outside_clone").length;

    function clone(){
        $(this).parents(".outside_clone").clone()
            .appendTo("#budget_outside")
            .attr("id", "outside" +  cloneIndex)
            .find("*")

            .on('click', '#add_outside', clone)
            .on('click', 'button.remove', remove);
        cloneIndex++;
    }
    function remove(){
        $(this).parents(".clonedInput").remove();
    }
    $("#add_outside").on("click", clone);

    // $("button.remove").on("click", remove);

    //end clone

    $('#prj_type_connect').select2();

    if ($('#prj_budget_inside').is(':checked')){
        $('#budget_inside').toggle(true);
    }else{
        $('#budget_inside').toggle(false);
    }

    $("#prj_budget_inside").on("ifChanged", function(){
        if ($('#prj_budget_inside').is(':checked')){
            $('#budget_inside').toggle(true);
        }else{
            $('#budget_inside').toggle(false);
        }
     
    });

    // $("#prj_budget_outside").on("ifChanged", function(){
    //     if ($('#prj_budget_outside').is(':checked')){
    //         $('#budget_outside').toggle(true);
    //     }else{
    //         $('#budget_outside').toggle(false);
    //     }
     
    // });
    if ($('#prj_budget_convert').is(':checked')){
        $('#budget_convert').toggle(true);
    }else{
        $('#budget_convert').toggle(false);
    }
    $("#prj_budget_convert").on("ifChanged", function(){
        if ($('#prj_budget_convert').is(':checked')){
            $('#budget_convert').toggle(true);
        }else{
            $('#budget_convert').toggle(false);
        }
     
    });


    if ($('#prj_type1').is(':checked')){
        $('#type_connect').toggle(true);
    }else{
        $('#type_connect').toggle(false);
    }
    $("#prj_type1").on("ifChanged", function(){
        if ($('#prj_type1').is(':checked')){
            $('#type_connect').toggle(true);
        }else{
            $('#type_connect').toggle(false);
        }
     
    });



    $('#search_convert').click(function(){
        $('.show-search').toggle(true);
        $("#table_search").empty();
        var data = $("#val_budget_convert").val();
        var id = $("input[name='prj_id']").val();
        // if (data == ''){
        //     return false;
        // }
        //call ajax to search
        $.ajax({
            method: "POST",
            url: domain + 'project_training/searchPrj',
            data: {
                data: data,
                id : id
            },
            success: function (response) {
                // console.log(response)
                var html;
                $.each(response, function(i, word) {
                    html += '<tr data-id="'+word['prj_id']+'">';
                    // html += '<td >' +    i + '</td>';
                    html += '<td class="text-left">' +    word['prj_name'] + '</td>';
                    html += '<td>' +    word['prj_budget'] + '</td>';
                    html += '<td class="numeric">' +    word['budget'] + '</td>';
                    if (word['budget'] > '0.00')
                        html += '<td>' +'<div class=""><button onclick=getSelect(this,'+word['prj_id']+') class="btn btn-warning select_prj btn-sm"  type="button">เลือก</button></div>' + '</td>';
                    else
                        html += '<td>' +'<div class=""><button disabled="disabled" onclick=getSelect(this,'+word['prj_id']+') class="btn btn-warning select_prj btn-sm"  type="button">เลือก</button></div>' + '</td>';
                    html += '</tr>';

                });
                // console.log(html)
                $('#table_search').append(html);
                // you will get response from your php page (what you echo or print)                 

            },
        })
        
        // $('#table_search').append('<tr><td >' + " wdw" + '</td><td >' + " wdw" + '</td><td >' + " wdw" + '</td></tr>');
    })

    //update budget
    updateBudgetConvert();

    $('.budget_item').on('blur', function() { 
        updateBudgetConvert();
    });


    //check protection data submit
    $('#btn-submit').click(function(){
        var prj_name = $("input[name='prj_name']").val();
        if (prj_name == ''){
            alertify.error('กรุณาระบุ ชื่อโครงการ ');
            $("input[name='prj_name']").focus();
            return false;
        }
        var prj_budget_inside = $("input[name='prj_budget_inside']").val();
        if (prj_budget_inside == ''){
            alertify.error('กรุณาเลือก กรอบงบประมาณ ');
            $("input[name='prj_budget_inside']").focus();
            return false;
        }
        var prj_budget = $("input[name='prj_budget']").val();
        if (prj_budget == ''){
            alertify.error('กรุณาระบุ งบประมาณที่ได้รับ  ');
            $("input[name='prj_budget']").focus();
            return false;
        }
        var prj_type = $("input[name='prj_type']").val();
        if (prj_type == ''){
            alertify.error('กรุณาเลือก ประเภทโครงการ ');
            $("input[name='prj_name']").focus();
            return false;
        }
        if ($('#prj_type1').is(':checked')){
            var prj_type_connect = $("select[name='prj_type_connect']").val();
            if (prj_type_connect == ''){
                alertify.error('กรุณาเลือกโครงการ ');
                $("select[name='prj_type_connect']").focus();
                return false;
            }
        }

        let status = false;
        $(".budget_item").each(function() {  // find budget convert
            
            if (this.value == ''){
                alertify.error('กรุณาระบุ งบประมาณที่ต้องการ ');
                $("input[name='"+this.name+"']").focus();
                status = true;
                return false;
             
            }
           
        });
        if (status)
            return false;
       

       
    });

  

    // $('#add_outside').click(function(){
    //     alert('asd');
    // });

    
    
    
    // $('#prj_budget_inside').click(function(){
    //     alert('asd');
    // })


});

function updateBudgetConvert(){
      //sum convert budget
      var budget = 0 ;
      $(".budget_item").each(function(index, elem){
          if ( $(elem).val() != '')
            budget = parseFloat(budget)+parseFloat($(elem).val());
      });
      $('#budget_convert_sum').val(budget) ;
}

function getSelect(tmp ,data){

    var search = data;
    $(".table-search tr ").filter(function() {
        return $(this).attr("data-id") == search;
    }).css('color','red');

    // $("#table_select").empty();
    $.ajax({
        method: "POST",
        url: domain + 'project_training/getPrjSelect',
        data: {
            data: data
        },
        success: function (response) {
            // console.log(response)
            var html;
            $.each(response, function(i, word) {
                html += '<tr data-select="'+word['prj_id']+'">';
                html += '<div class="row"><td class="text-left">' ;
                html += '<span class="col-sm-7">'+word['prj_name']+'<span style="color:#169F85">('+word['tree']+')</span>'+'<br/> งบเหลือจ่าย ' +word['expenses_amount_result']+' บาท'+'</span>';
                html += '<span class="col-sm-3"><input class="form-control numeric budget_item text-right" onkeyup="integerInRange(this,'+word['expenses_number']+')" name="prj_select['+word['prj_id']+']" type="text"></span>';
                html += '<span class="col-sm-1">บาท</span>';
                html += '<div class="btn-group col-sm-1"><button onclick=delSelect('+word['prj_id']+') class="btn btn-danger btn-sm" type="button">ลบ</button></div>';
                html += '</td></div>';
                html += '</tr>';
              
            });
           
            setTimeout(function(){
                $('.numeric').number( true, 2 );
                $('.budget_item').on('blur', function() { 
                    updateBudgetConvert();
                });

                
                // $(".budget_item").mask("9-9999-99999-99-9");
             }, 1000);
            // // console.log(html)
             $('#table_select ').append(html);
            
            // you will get response from your php page (what you echo or print)                 

        },
    })
}

function integerInRange(val,val_max){
    var value = val.value;
    value = parseFloat(value.replace(/,/g, ''));

    if(value > val_max)
    {
        // document.getElementById(name).value = "100";
        $("input[name='"+val.name+"']").val('');
        alertify.error('กรุณากรอก งบเหลือจ่ายไม่เกินจำนวน ');
        return false;
    }
}

function delSelect(value){


    var edit = $("input[name='edit']").val();
    
    if (edit){
        $.ajax({
            method: "POST",
            url: domain + 'project_training/delPrjConvert',
            data: {
                data: value
            },
            success: function (response) {
                $("tr[data-select='" + value + "'] ").remove();
                $(".table-search tr ").filter(function() {
                    return $(this).attr("data-id") == value;
                }).css('color','#73879C');
            
                updateBudgetConvert();
            }
    
        });
    }else{
        $("tr[data-select='" + value + "'] ").remove();
        $(".table-search tr ").filter(function() {
            return $(this).attr("data-id") == value;
        }).css('color','#73879C');
    
        updateBudgetConvert();
    }
   

  
    
}


