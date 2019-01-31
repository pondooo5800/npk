$(function(){


    // jambo_table

    //load id to modal
    $('#delmodal').on('show.bs.modal', function (e) {
        var data = $(e.relatedTarget).data();
        $(this).find('#btn-del').attr('del', data.id);
    });

    // check delete on click
    $('#btn-del').on('click', function (e) {
        e.preventDefault();
        var id = $(this).attr('del');
        window.location.replace(domain + 'expenditure/' + 'expenditure_del' + '/' + id);
    });

    //load id to modal
    $('#paymodal').on('show.bs.modal', function (e) {
        var data = $(e.relatedTarget).data();
        $(this).find('#btn-pay').attr('pay', data.id);

        $.ajax({
            method: "POST",
            url: domain + 'expenditure/getExpenditureNumber',
            data: {
                id : data.id,
            }
        }).success(function (msg) {
        
            $("input[name='expenses_number']").val(msg.expenses_number);
            $("input[name='expenses_date_disburse']").val(msg.expenses_date_disburse);
            
        });
    });

    // check pay on click
    $('#btn-pay').on('click', function (e) {
        e.preventDefault();
        var id = $(this).attr('pay');
        var number = $("input[name='expenses_number']").val();
        if (number == ''){
            alertify.error('กรุณาระบุเลขที่เช๊ค');
            return false;
        }
        var date = $("input[name='expenses_date_disburse']").val();
        if (date == ''){
            alertify.error('กรุณาระบุวันที่ลงเช๊ค');
            return false;
        }
        $.ajax({
            method: "POST",
            url: domain + 'expenditure/saveExpenditureNumber',
            data: {
                id : id,
                expenses_number : number,
                expenses_date_disburse : date
            }
        }).success(function (msg) {
            if (msg)
                window.location.reload();
        });
    });

	$('#search-btn').click(function(){
		$.ajax({
            method: "POST",
            url: domain + 'expenditure/getPrj',
            data: {
                keyword: $('#search').val(),
            }
        }).done(function (msg) {
            if (msg) {
            	console.log(msg);
            	$('#div_table').html(msg);
            }
        });

    });
    
    var collapsedGroups = {};
    var table = $('#table_expenditure').DataTable({
        pageLength: 100,
        serverSide: true,
        processing: true,
        lengthChange: false,
        ajax: {
          url: domain + 'expenditure/getAjaxExpenditure',
        },
        orderFixed: [0, 'DESC'],
        rowGroup: {
            dataSrc: "expenses_date_disburse",
            startRender: function (rows, group) {
               var collapsed = !!collapsedGroups[group];
   
               rows.nodes().each(function (r) {
                   r.style.display = collapsed ? 'none' : '';
               });    
   
               // Add category name to the <tr>. NOTE: Hardcoded colspan
               return $('<tr/>')
                   .append('<td colspan="7">' + group + '</td>')
                   .attr('data-name', group)
                //    .addClass('tess')
                   .toggleClass('collapsed', collapsed);
           }
        },
        // "columnDefs": [{
        //   "name": "",
        //   "targets": 0
        // }, ],
    
    
        // "order": [
        //   [2, 'DESC']
        // ],
        'columns': [{
            data: 'expenses_date_disburse',
            "className": "text-center",
            // render: function (data, type, row, meta) {
            //   return meta.row + meta.settings._iDisplayStart + 1;
            // },
    
          },
          {
            data: 'expenses_number',
            "className": "text-center",
          },
          {
            data: 'expenses_date',
            "className": "text-center",
          },
          {
            data: 'prj_name',
            "className": "text-left",
          },
    
          {
            data: 'expenses_amount_disburse',
            "className": "text-right",
          },
          {
            data: 'user_firstname',
            render: function (data, type, row) {
                return data +' '+row['user_lastname'];
            }
          },
          {
            data: 'expenses_id',
            render: function (data, type, row) {
              var btn =
                '<div class="btn-group ">' +
                '<button type="button" data-toggle="modal" data-target="#paymodal" data-id="'+data+'" class="btn btn-default btn-sm" title="เช๊ค">เลขเช๊ค</button>'+
                '<button type="button" onclick="window.location.href=\'' + domain + 'expenditure/expenditure_form/' + '' + row['project_id'] +'/'+data+ '\'"  class="btn btn-warning btn-sm"  title="แก้ไข" >แก้ไข</button>' +
                '<button type="button" class="btn btn-danger btn-sm"  id="' + data + '" data-id="' + data + '" data-toggle="modal" data-target="#delmodal" title="ลบ" >ลบ</button>' +
                '</div>';
              return btn;
            },
            "className": "text-center",
            orderable: false
          },
          
        ],
        // "bSort" : false,
        "bLengthChange": false,
        "bFilter": true,
        "responsive": true,
        "language": {
          "sProcessing": "กำลังดำเนินการ...",
          "sLengthMenu": "แสดง _MENU_ แถว",
          "sZeroRecords": "ไม่พบข้อมูล",
          // "sInfo":         "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว / รายการทั้งหมด จำนวน _TOTAL_ รายการ (แบ่งออกเป็น _PAGES_ หน้า หน้าละ 50 รายการ)",
          "sInfo": "รายการทั้งหมด จำนวน _TOTAL_ รายการ (แบ่งออกเป็น _PAGES_ หน้า หน้าละ 25 รายการ)",
          // "sInfoEmpty":    "แสดง 0 ถึง 0 จาก 0 แถว",
          "sInfoEmpty": "รายการทั้งหมด จำนวน 0 รายการ (แบ่งออกเป็น _PAGES_ หน้า หน้าละ 25 รายการ)",
          // "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
          "sInfoFiltered": "",
          "sInfoPostFix": "",
          "sSearch": "ค้นหา: ",
          "sUrl": "",
          "oPaginate": {
            "sFirst": '<i class="fa fa-step-backward" style="font-size: 12px;" aria-hidden="true"></i>',
            "sPrevious": '<i class="fa fa-backward" style="font-size: 12px;" aria-hidden="true"></i>',
            "sNext": '<i class="fa fa-forward" style="font-size: 12px;" aria-hidden="true"></i>',
            "sLast": '<i class="fa fa-step-forward" style="font-size: 12px;" aria-hidden="true"></i>'
          }
        }
    
    
    
      });
    
      table.on('click', 'tr.group-start', function () {
            var name = $(this).data('name');
            collapsedGroups[name] = !collapsedGroups[name];
            table.draw();
        });
      //search data 
      $('#search_pay').click(function () {

        table.columns(3).search($('#tax_name').val()).draw();
        table.columns(0).search($('#check_date_tax').val()).draw();
        table.columns(1).search($('#number_tax').val()).draw();
        table.columns(2).search($('#pay_date_tax').val()).draw();
      });

});