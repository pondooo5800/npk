 //load id to modal
 $('#delpay_modal').on('show.bs.modal', function (e) {
     var data = $(e.relatedTarget).data();
     $(this).find('#btn-delpay').attr('del', data.id);
 });

 // check delete on click
 $('#btn-delpay').on('click', function (e) {

     e.preventDefault();
     var id = $(this).attr('del');
     window.location.replace(domain + 'receive/' + 'receive_other_delete' + '/' + id);
 });


 $(function () {
     //load id to modal
     $('#delmodal').on('show.bs.modal', function (e) {
         var data = $(e.relatedTarget).data();
         $(this).find('#btn-del').attr('del', data.id);
     });

     // check delete on click
     $('#btn-del').on('click', function (e) {
         e.preventDefault();

         var id = $(this).attr('del');
         window.location.replace(domain + 'receive/' + 'receive_other_delete' + '/' + id);
     });

     var collapsedGroups = {};
     var table = $('#tax_table').DataTable({
         //  pageLength: 100,
         //  serverSide: true,
         //  processing: true,
         //  lengthChange: false,
         //  ajax: {
         //      url: domain + 'receive/getAjaxOtherTax',
         //  },
         //  "columnDefs": [{
         //      "name": "",
         //      "targets": 0
         //  }, ],
         //  'columns': [{
         //          data: 'receive_id',
         //          "className": "text-center",
         //          render: function (data, type, row, meta) {
         //              return meta.row + meta.settings._iDisplayStart + 1;
         //          },

         //      },
         //      {
         //          data: 'receive_date',
         //          "className": "text-center",
         //      },

         //      {
         //          data: 'tax_name'
         //      },
         //      {
         //          data: 'receive_amount',
         //          "className": "text-right",
         //      },
         //      {
         //          data: 'receive_id',
         //          render: function (data, type, row) {
         //              var btn =
         //                  '<div class="btn-group ">' +
         //                  '<button type="button" onclick="window.location.href=\'' + domain + 'receive/other_tax_edit/' + '' + data + '\'" id="edit-receive" class="btn btn-warning btn-sm" title="แก้ไข" style="width: 47px;">แก้ไข</button>' +
         //                  '<button type="button" class="btn btn-danger btn-sm " id="' + data + '" data-id="' + data + '" data-toggle="modal" data-target="#delmodal" title="ลบ" style="width: 47px;">ลบ</button>'
         //              '</div>';
         //              return btn;
         //          },
         //          "className": "text-center",
         //          orderable: false
         //      }
         //  ],
         // "bSort" : false,
         orderFixed: [0, 'ASC'],
         rowGroup: {
             dataSrc: 1,
             startRender: function (rows, group) {
                var collapsed = !!collapsedGroups[group];
    
                rows.nodes().each(function (r) {
                    r.style.display = collapsed ? 'none' : '';
                });    
    
                // Add category name to the <tr>. NOTE: Hardcoded colspan
                return $('<tr/>')
                    .append('<td colspan="5">' + group + '</td>')
                    .attr('data-name', group)
                    .toggleClass('collapsed', collapsed);
            }
         },
         "bLengthChange": false,
         "bFilter": true,
         "responsive": true,
         "searching": false,
         "info": false,
         "language": {
             "sProcessing": "กำลังดำเนินการ...",
             "sLengthMenu": "แสดง _MENU_ แถว",
             "sZeroRecords": "ไม่พบข้อมูล",
             // "sInfo":         "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว / รายการทั้งหมด จำนวน _TOTAL_ รายการ (แบ่งออกเป็น _PAGES_ หน้า หน้าละ 50 รายการ)",
             //  "sInfo": "รายการทั้งหมด จำนวน _TOTAL_ รายการ (แบ่งออกเป็น _PAGES_ หน้า หน้าละ 25 รายการ)",
             // "sInfoEmpty":    "แสดง 0 ถึง 0 จาก 0 แถว",
             //  "sInfoEmpty": "รายการทั้งหมด จำนวน 0 รายการ (แบ่งออกเป็น _PAGES_ หน้า หน้าละ 25 รายการ)",
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
     //  $('#search_receive').click(function () {
     //      table.columns(1).search($('#type_tax').val()).draw();
     //      table.columns(2).search($('#number_tax').val()).draw();
     //      table.columns(3).search($('#name_tax').val()).draw();
     //  });

 });