var tab = 1;
$('#tab1').click(function () {
    tab = 1;
});
$('#tab2').click(function () {
    tab = 2;
});

// check potection expenditure in
$('#btn-submit').click(function () {
    // // tax_id= 8
    if (tab == 1) {
        if ($("input[name='individual_number[0]']").val() == '') {
            alertify.error('กรุณาระบุ เลขประจำตัวผู้เสียภาษี');
            $("input[name='individual_number[0]']").focus();
            return false;
        }
        if (document.getElementById("tab_1").value.length < 10 || document.getElementById("tab_1").value.length > 13) {
            alertify.error('กรุณาระบุ เลขประจำตัวผู้เสียภาษี 10 หรือ 13 หลัก');
            return false;
        }

        if ($("input[name='individual_firstname[0]']").val() == '') {
            alertify.error('กรุณาระบุ ชื่อ');
            $("input[name='individual_firstname[0]']").focus();
            return false;
        }
        if ($("input[name='individual_lastname[0]']").val() == '') {
            alertify.error('กรุณาระบุ นามสกุล');
            $("input[name='individual_lastname[0]']").focus();
            return false;
        }
        if ($("input[name='individual_address[0]']").val() == '') {
            alertify.error('กรุณาระบุ เลขที่บ้าน');
            $("input[name='individual_address[0]']").focus();
            return false;
        }
        if ($("input[name='individual_village[0]']").val() == '') {
            alertify.error('กรุณาระบุ หมู่');
            $("input[name='individual_village[0]']").focus();
            return false;
        }
        if ($("input[name='individual_zipcode[0]']").val() == '') {
            alertify.error('กรุณาระบุ รหัสไปรษณีย์');
            $("input[name='individual_zipcode[0]']").focus();
            return false;
        }

    }

    if (tab == 2) {
        if ($("input[name='individual_number[1]']").val() == '') {
            alertify.error('กรุณาระบุ เลขประจำตัวผู้เสียภาษี');
            $("input[name='individual_number[1]']").focus();
            return false;
        }
        if (document.getElementById("tab_2").value.length < 10 || document.getElementById("tab_2").value.length > 13) {
            alertify.error('กรุณาระบุ เลขประจำตัวผู้เสียภาษี 10 หรือ 13 หลัก');
            return false;
        }
        if ($("input[name='individual_firstname[1]']").val() == '') {
            alertify.error('กรุณาระบุ ชื่อบริษัท');
            $("input[name='individual_firstname[1]']").focus();
            return false;
        }
        if ($("input[name='individual_address[1]']").val() == '') {
            alertify.error('กรุณาระบุ เลขที่บ้าน');
            $("input[name='individual_address[1]']").focus();
            return false;
        }
        if ($("input[name='individual_village[1]']").val() == '') {
            alertify.error('กรุณาระบุ หมู่');
            $("input[name='individual_village[1]']").focus();
            return false;
        }
        if ($("input[name='individual_zipcode[1]']").val() == '') {
            alertify.error('กรุณาระบุ รหัสไปรษณีย์');
            $("input[name='individual_zipcode[1]']").focus();
            return false;
        }


    }


});