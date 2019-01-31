$(function () {

    //grid tree
    var $tg = $('#tg').treegrid({
        url: domain + 'receive_outside/getOutsideJson',
        rownumbers: false,
        animate: false,
        collapsible: false,
        fitColumns: true,
        showFilterBar:false,
        idField: 'id',
        treeField: 'name',
        onContextMenu: onContextMenu,
        columns: [
            [{
                    title: 'รายการ',
                    field: 'name',
                    width: 50
                },
                {
                    title: 'รหัสบัญชี',
                    field: 'account_id',
                    width: 10
                },
                {
                    field: 'budget',
                    title: 'งบประมาณ (บาท)',
                    width: 15,
                    align: 'right'
                },
                {
                    field: 'tools',
                    title: '&nbsp;',
                    width: 30,
                    align: 'right'
                },
                // {field:'end',title:'End Date',width:80}
            ]
        ],
        onLoadSuccess: function (row) {
            // $(this).treegrid('enableDnd', row ? row.id : null);
        }


    }).treegrid('enableFilter');

    $('#search').on('keyup', function () {

        $tg.treegrid('addFilterRule', {
            field: 'name',
            op: 'contains',
            value: this.value
        }).treegrid('doFilter');

    });


    //add prj data to controller
    $('#btn-submit-out').click(function () {


        if ($("input[name='out_name']").val() == '') {
            alertify.error('กรุณาระบุรายการ');
            $("input[name='out_name']").focus();
            return false;
        }
        if ($("input[name='out_budget']").val() == '') {
            alertify.error('กรุณาระบุจำนวนเงิน');
            $("input[name='out_budget']").focus();
            return false;
        }

        var data = $('#form_out').serializeArray();
        var edit = $('#hidden_out_edit').val();
        var id = $('#hidden_out_id').val();

        $.ajax({
            method: "POST",
            url: domain + 'receive_outside/insertOutside',
            data: {
                data: data,
                edit: edit,
                id: id
            }
        }).done(function (msg) {
            if (msg) {
                $('.creat_out').modal('hide');
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
        window.location.href = domain + 'receive_outside/delOut/' + id + '/' + state;
    });

});



// create project
function outside_add_plan(id, value) {
    $('#hidden_edit').val(false);
    if (value != null) {
        $('#hidden_edit').val(true);
        $('#outside_title').val(value);
    }

    $('#hidden_id').val(id);
    $('.create_plan').modal();
}

function outside_add(id, value) {
    $('#hidden_edit_detail').val(false);
    if (value != null) {
        $('#hidden_edit_detail').val(true);
        $('#outside_select').val(value);
    }
    $('#hidden_id_detail').val(id);
    $('.create_plan_detail').modal();
}

function outside_add_cost(id, value) {

    $('#hidden_edit_cost').val(false);
    if (value != null) {
        $('#hidden_edit_cost').val(true);
        $('#outside_cost').val(value);
    }
    $('#hidden_id_cost').val(id);
    $('.create_plan_cost').modal();

}

//prj create detail
function add_out(value) {

    //clear data
    $("input[type='text']").val('');
    $("#hidden_out_id").val();



    var year = $('.selectpicker').val();
    $('#outside_year').text(parseInt(year) + 543);
    $('#hidden_out_edit').val(false);
    $('#out_year').val(year);
    $('#out_parent').val(value);
    $('.creat_out').modal();
}
//edit prj
function edit_out(value) {
    //clear radio


    var year = $('.selectpicker').val();
    $('#outside_year').text(parseInt(year) + 543);
    $('#hidden_out_edit').val(true);
    $('#out_year').val(year);
    $.ajax({
        method: "POST",
        url: domain + 'receive_outside/getOut',
        data: {
            data: value
        }
    }).success(function (msg) {
        $('#hidden_out_id').val(msg[0]['out_id']);
        $('#out_name').val(msg[0]['out_name']);
        $('#out_code').val(msg[0]['out_code']);
        $('#out_budget').val(msg[0]['out_budget_sum']);
        $('#out_owner').val(msg[0]['out_owner']);
        $('#out_parent').val(msg[0]['out_parent']);

        $('.creat_out').modal();

    })
}

//del all project or prj
function del_out(value, state = '') {
    $('#del_id').val(value);
    $('#del_state').val(state);
    $('.del_out').modal();
}

function pay_out(value){
    window.location.replace(domain + 'receive_outside/' + 'outside_form' + '/' + value);
}

function add_in_out(value){
    window.location.replace(domain + 'receive_outside/' + 'outside_in_form' + '/' + value);
}