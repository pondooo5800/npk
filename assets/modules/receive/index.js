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
    window.location.replace(domain + 'receive/' + 'receive_tax_delete' + '/' + id);
  });


  var table = $('#tax_table').DataTable({
    pageLength: 100,
    serverSide: true,
    processing: true,
    lengthChange: false,
    ajax: {
      url: domain + 'receive/getAjaxReceiveTax',
    },
    "columnDefs": [{
      "name": "",
      "targets": 0
    }, ],


    "order": [
      [1, 'DESC']
    ],
    'columns': [{
        data: 'individual_id',
        "className": "text-center",
        render: function (data, type, row, meta) {
          return meta.row + meta.settings._iDisplayStart + 1;
        },

      },
      {
        data: 'individual_number',
        "className": "text-center",

      },

      {
        data: 'individual_fullname',
        render: function (data, type, row) {
          if (row.individual_prename == null) {
            return row.individual_fullname;
          }
          return row.individual_prename + " " + row.individual_fullname;
        },

      },
      {
        data: 'individual_type',
        render: function (data, type, row) {
          var type = ['', 'บุคคลธรรมดา', 'นิติบุคคล'];
          return type[data];
        }
      },
      {
        data: 'individual_id',
        render: function (data, type, row) {
          var form = '';
          if (row['count_notice'] == 0) {
            form = '<a href=\'' + domain + 'receive/receive_notice/' + '' + row['individual_id'] + '/' + row['tax_id'] + '\'" id="" style="width: 75px;" class="btn btn-info btn-sm" title="เพิ่มการประเมินรายรับ">รอประเมิน</a>';
          } else {
            form = '<a href=\'' + domain + 'receive/receive_notice' + '/' + row['individual_id'] + '/' + row['tax_id'] + '\'" id="" style="width: 75px;" class="btn btn-success btn-sm" title="แก้ไขการประเมินรายรับ" >ประเมินแล้ว</a>';
          }
          var form1 = '';
          if (row['count_notice'] == 0) {
            form1 = '<button type="button" onclick="window.location.href=\'' + domain + 'report/report_person/' + '' + data + '\'" id="edit-individual" class="btn btn-info btn-sm" title="ทะเบียนคุมผู้ชำระภาษี" >ทะเบียน</button>';
          } else {
            form1 = '<button type="button" onclick="window.location.href=\'' + domain + 'report/report_person/' + '' + data + '\'" id="edit-individual" class="btn btn-success btn-sm" title="ทะเบียนคุมผู้ชำระภาษี" >ทะเบียน</button>';
          }

          var btn =
            '<div class="btn-group ">' +
            form +
            form1 +
            '<button type="button" onclick="window.location.href=\'' + domain + 'receive/receive_taxadd_popup/' + '' + data + '\'" id="edit-individual" class="btn btn-warning btn-sm" style="width: 47px;" title="แก้ไข" >แก้ไข</button>' +
            '<button type="button" class="btn btn-danger btn-sm" style="width: 47px;" id="' + data + '" data-id="' + data + '" data-toggle="modal" data-target="#delmodal" title="ลบ" >ลบ</button>' +
            '</div>';
          return btn;
        },
        "className": "text-center",
        orderable: false
      }
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

  //search data 
  $('#search_receive').click(function () {
    table.columns(1).search($('#type_tax').val()).draw();
    table.columns(2).search($('#number_tax').val()).draw();
    table.columns(3).search($('#name_tax').val()).draw();
  });

});

function reset() {
  document.getElementById("demo-form2").reset();

  $('.selectpicker').selectpicker();
  $('.type_tax').selectpicker('val', '0');

}