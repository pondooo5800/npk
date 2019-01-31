$(function () {

    //grid tree
    var $tg = $('#tg').treegrid({
        url: domain + 'project_training/getProjectJson',
        rownumbers: false,
        animate: false,
        collapsible: false,
        fitColumns: true,
        idField: 'id',
        showFilterBar:false,
        treeField: 'name',
        onContextMenu: onContextMenu,
        columns: [
            [{
                    title: 'แผนงาน',
                    field: 'name',
                    width: 60
                },
                {
                    field: 'budget',
                    title: 'กรอบงบประมาณ (บาท)',
                    width: 15,
                    align: 'right'
                },
                {
                    field: 'tools',
                    title: '&nbsp;',
                    width: 25,
                    align: 'right'
                },
                // {field:'end',title:'End Date',width:80}
            ]
        ],
        onLoadSuccess: function (row) {
            // $(this).treegrid('enableDnd', row ? row.id : null);
        }


    }).treegrid('enableFilter', [{
            field: 'name',
            type: 'text',
        },
        {
            field: 'budget',
            type: 'text',
            options: {
                precision: 1
            },
        },
        {
            field: 'tools',
            type: 'label',
        }
    ]);


    $('#search').on('keyup', function () {

        $tg.treegrid('addFilterRule', {
            field: 'name',
            op: 'contains',
            value: this.value
        }).treegrid('doFilter');

    });

    //color header
    // var header = $('.panel-header');
    // header.css('background', 'RGB(42, 63, 84)');


    //add plan data
    $('#btn-submit-plans').click(function () {

        if ($('#project_title').val() == '') {
            alertify.error('กรุณาระบุแผนงาน/งาน');
            $("#project_title").focus();
            return false;
        }
        var data = $('#project_title').val();
        var id = $('#hidden_id').val();
        var edit = $('#hidden_edit').val();
        $.ajax({
            method: "POST",
            url: domain + 'project_training/insertProjectPlan',
            data: {
                data: data,
                id: id,
                edit: edit
            }
        }).done(function (msg) {
            if (msg) {
                $('.create_plan').modal('hide');
                $('#tg').treegrid('reload');
            }
        })
    });
    //end plan
    //add plan data
    $('#btn-submit-plan').click(function () {

        if ($('#project_select').val() == '') { 
            alertify.error('กรุณาระบุ ประเภทงบ');
            $("#project_select").focus();
            return false;
        }
        var data = $('#project_select').val();
        var id = $('#hidden_id_detail').val();
        var level = $('#hidden_level').val();
        var edit = $('#hidden_edit_detail').val();
        $.ajax({
            method: "POST",
            url: domain + 'project_training/insertProjectPlan',
            data: {
                data: data,
                id: id,
                level: level,
                edit: edit
            }
        }).done(function (msg) {
            if (msg) {
                $('.create_plan_detail').modal('hide');
                $('#tg').treegrid('reload');
            }
        })
    });
    //end plan

    //add plan data
    $('#btn-submit-cost').click(function () {

        if ($('#project_cost').val() == '') {
            alertify.error('กรุณาระบุ หมวด/ลักษณะ');
            $("#project_cost").focus();
            return false;
        }
        var data = $('#project_cost').val();
        var id = $('#hidden_id_cost').val();
        var level = $('#hidden_lv').val();
        var edit = $('#hidden_edit_cost').val();

        $.ajax({
            method: "POST",
            url: domain + 'project_training/insertProjectPlan',
            data: {
                data: data,
                id: id,
                level: level,
                edit: edit
            }
        }).done(function (msg) {
            if (msg) {
                $('.create_plan_cost').modal('hide');
                $('#tg').treegrid('reload');
            }
        })
    });
    //end plan


    //add prj data to controller
    $('#btn-submit-prj').click(function () {

        if ($('#prj_name').val() == '') {
            return false;
        }
        var data = $('#form_prj').serializeArray();
        var edit = $('#hidden_prj_edit').val();
        var id = $('#hidden_prj_id').val();

        $.ajax({
            method: "POST",
            url: domain + 'project_training/insertProject',
            data: {
                data: data,
                edit: edit,
                id: id
            }
        }).done(function (msg) {
            if (msg) {
                $('.creat_prj').modal('hide');
                $('#tg').treegrid('reload');
            }

            // window.location.href = domain+'project_training/project';
        })
    });
    //end plan

    //del project or 
    $('#btn-del').click(function () {
        var id = $('#del_id').val();
        var state = $('#del_state').val();
        window.location.href = domain + 'project_training/delPrj/' + id + '/' + state;
    });


    // project state
    $('input.js-switch').change(function () {
        if ($(this).is(':checked')) {

            $.ajax({
                method: "POST",
                url: domain + 'project_training/updateState',
                data: {
                    data: false
                },
                success: function (response) {
                    // you will get response from your php page (what you echo or print)                 

                },
            })

        } else {

            $.ajax({
                method: "POST",
                url: domain + 'project_training/updateState',
                data: {
                    data: true
                },
                success: function (response) {
                    // you will get response from your php page (what you echo or print)                 
                    // console.log(response)
                },
            })

        }

    });


});



// create project
function project_add_plan(id, value) {
    $('#hidden_edit').val(false);
    if (value != null) {
        $('#hidden_edit').val(true);
        $('#project_title').val(value);
    }

    $('#hidden_id').val(id);
    $('.create_plan').modal();
}

function project_add(id, value) {
    $('#hidden_edit_detail').val(false);
    if (value != null) {
        $('#hidden_edit_detail').val(true);
        $('#project_select').val(value);
    }
    $('#hidden_id_detail').val(id);
    $('.create_plan_detail').modal();
}

function project_add_cost(id, value) {

    $('#hidden_edit_cost').val(false);
    if (value != null) {
        $('#hidden_edit_cost').val(true);
        $('#project_cost').val(value);
    }
    $('#hidden_id_cost').val(id);
    $('.create_plan_cost').modal();

}

//prj create detail
function add_prj(parent,value) {
  
    if (value == undefined)
        value = '0';

    //clear data
    window.location = domain+'project_training/prjAdd/'+parent+'/'+value; 
    // $("input[type='text']").val('');
    // $(".flat").parents('div').removeClass('checked');


    // var year = $('.selectpicker').val();
    // $('#project_year').text(parseInt(year) + 543);
    // $('#hidden_prj_edit').val(false);
    // $('#prj_year').val(year);
    // $('#prj_parent').val(value);
    // $('.creat_prj').modal();
}

function pay_prj(value){
    window.location = domain+'expenditure/expenditure_form/'+value;  
}
//edit prj
function edit_prj(parent,value) {

    if (value == undefined)
    value = '0';

    //clear data
    window.location = domain+'project_training/prjAdd/'+parent+'/'+value+'/edit'; 
    //clear radio
    // $(".flat").parents('div').removeClass('checked');

    // var year = $('.selectpicker').val();
    // $('#project_year').text(parseInt(year) + 543);
    // $('#hidden_prj_edit').val(true);
    // $('#prj_year').val(year);
    // $.ajax({
    //     method: "POST",
    //     url: domain + 'project_training/getPrj',
    //     data: {
    //         data: value
    //     }
    // }).success(function (msg) {
    //     $('#hidden_prj_id').val(msg[0]['prj_id']);
    //     $('#prj_name').val(msg[0]['prj_name']);
    //     $('#prj_budget').val(msg[0]['prj_budget']);
    //     $('#prj_owner').val(msg[0]['prj_owner']);
    //     $('#prj_parent').val(msg[0]['prj_parent']);

    //     $("input[name='prj_status']").each(function (index) {
    //         if ($(this).val() == msg[0]['prj_status']) {
    //             $('#prj_status' + index).prop("checked", true);
    //             $('#prj_status' + index).parents('div').addClass('checked');
    //         }
    //     });
    //     $("input[name='prj_type']").each(function (index) {
    //         if ($(this).val() == msg[0]['prj_type']) {
    //             $('#prj_type' + index).prop("checked", true);
    //             $('#prj_type' + index).parents('div').addClass('checked');
    //         }
    //     });

    //     $('.creat_prj').modal();

    // })
}

//del all project or prj
function del_prj(value, state = '') {
    $('#del_id').val(value);
    $('#del_state').val(state);
    $('.del_prj').modal();
}

