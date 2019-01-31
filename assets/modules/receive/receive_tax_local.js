$(function () {
    // //load id to modal
    $('#delmodal').on('show.bs.modal', function (e) {
        var data = $(e.relatedTarget).data();
        $(this).find('#btn-del').attr('del', data.id);
    });

    // check delete on click
    $('#btn-del').on('click', function (e) {
        e.preventDefault();

        var id = $(this).attr('del');
        window.location.replace(domain + 'receive/' + 'receive_local_delete' + '/' + id);
    });

    var table = $('#tax_table').DataTable({
        pageLength: 100,
        serverSide: true,
        processing: true,
        lengthChange: false,
        ajax: {
            url: domain + 'receive/getAjaxReceived_tax_local',
        },
        "columnDefs": [{
            "name": "",
            "targets": 0
        }, ],

        "order": [
            [0, 'desc'],
        ],
        'columns': [{
                data: 'receive_id',
                "className": "text-center",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },

            },
            {
                data: 'receive_date',
                "className": "text-center",
            },
            {
                data: 'receipt_no',
                render: function (data, type, row) {
                    return row.receipt_no + "/" + row.receipt_number;
                },
                "className": "text-center",
            },
            {
                data: 'individual_fullname',
                render: function (data, type, row) {
                    return row.individual_fullname;
                },

            },
            {
                data: 'amount',
                "className": "text-center",
            },
            {
                data: 'interest',
                "className": "text-center",
            },
            {
                data: 'receive_amount',
                "className": "text-center",
            },


            {
                data: 'receive_id',
                render: function (data, type, row) {
                    var btn =
                        '<div class="btn-group ">' +
                        // '<button type="button" onclick="window.location.href=\'' + domain + '' + '' + data + '\'" id="" class="btn btn-success btn-sm " title="พิมพ์ใบแจ้งการประเมิน" style="width: 47px;">พิมพ์</button>' +
                        // '<button type="button" onclick="window.location.href=\'' + domain + 'receive/receive_tax_pay/' + '' + data + '\'" id="notice-id" class="btn btn-success btn-sm" title="จ่ายภาษี" style="width: 47px;">จ่าย</button>' +
                        '<button type="button" onclick="window.location.href=\'' + domain + 'receive/receive_tax_pay_edit_local/' + '' + row['individual_id'] + '/' + row['tax_id'] + '/' + data + '\'" id="edit-notice" class="btn btn-warning btn-sm" title="แก้ไข">แก้ไข</button>' +
                        '<button type="button" class="btn btn-danger btn-sm " id="' + data + '" data-id="' + data + '" data-toggle="modal" data-target="#delmodal" title="ลบ" style="width: 47px;">ลบ</button>'
                    '</div>';
                    return btn;
                },
                "className": "text-center",
                orderable: false
            },
        ],
        // "bSort": false,
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


});