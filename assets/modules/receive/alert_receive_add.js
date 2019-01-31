$('#tab1').click(function () {
    tab = 1;
});
$('#tab2').click(function () {
    tab = 2;
});
$('#tab3').click(function () {
    tab = 3;
});
// check potection expenditure in
$('#btn-submit').click(function () {
    // // tax_id= 8
    if (tab == 1) {
        if ($("input[name='notice_date_p2[0][]']").val() == '') {
            alertify.error('กรุณาระบุ วันที่รับ ภ.ร.ด. 2');
            $("input[name='notice_date_p2[0][]']").focus();
            return false;
        }
        if ($("input[name='notice_number[0][]']").val() == '') {
            alertify.error('กรุณาระบุ เลขที่รับ ภ.ร.ด. 2');
            $("input[name='notice_number[0][]']").focus();
            return false;
        }
        if ($("input[name='notice_date[0][]']").val() == '') {
            alertify.error('กรุณาระบุ วันที่ประเมิน ภ.ร.ด. 8');
            $("input[name='notice_date[0][]']").focus();
            return false;
        }
        if ($("input[name='notice_number_p8[0][]']").val() == '') {
            alertify.error('กรุณาระบุ เลขที่รับ ภ.ร.ด. 8');
            $("input[name='notice_number_p8[0][]']").focus();
            return false;
        }
        if ($("input[name='notice_no[0][]']").val() == '') {
            alertify.error('กรุณาระบุ เล่มที่รับ ภ.ร.ด. 8');
            $("input[name='notice_no[0][]']").focus();
            return false;
        }
        if ($("input[name='notice_annual_fee[0][]']").val() == '') {
            alertify.error('กรุณาระบุ ค่ารายปี');
            $("input[name='notice_annual_fee[0][]']").focus();
            return false;
        }

        if ($("input[name='notice_estimate[0][]']").val() == '') {
            alertify.error('กรุณาระบุ จำนวนภาษีที่ประเมิน');
            $("input[name='notice_estimate[0][]']").focus();
            return false;
        }
        if ($("input[name='tax_year[0][]']").val() == '') {
            alertify.error('กรุณาเลือก ปีภาษี');
            $("input[name='tax_year[0][]']").focus();
            return false;
        }
    }
    if (tab == 2) {
        if ($("input[name='notice_date[1][]']").val() == '') {
            alertify.error('กรุณาระบุ วันที่ประเมิน');

            $("input[name='notice_date[1][]']").focus();
            return false;
        }
        if ($("input[name='notice_date_p5[1][]']").val() == '') {
            alertify.error('กรุณาระบุ วันที่สำรวจ ภ.บ.ท. 5');
            $("input[name='notice_date_p5[1][]']").focus();
            return false;
        }
        if ($("input[name='notice_number[1][]']").val() == '') {
            alertify.error('กรุณาระบุ เลขที่สำรวจ ภ.บ.ท. 5');
            $("input[name='notice_number[1][]']").focus();
            return false;
        }
        if ($("input[name='land_rai[1][]']").val() == '') {
            alertify.error('กรุณาระบุ เนื้อที่ดิน (ไร่)');
            $("input[name='land_rai[1][]']").focus();
            return false;
        }
        if ($("input[name='land_ngan[1][]']").val() == '') {
            alertify.error('กรุณาระบุ เนื้อที่ดิน (งาน)');
            $("input[name='land_ngan[1][]']").focus();
            return false;
        }
        if ($("input[name='land_wa[1][]']").val() == '') {
            alertify.error('กรุณาระบุ เนื้อที่ดิน (วา)');
            $("input[name='land_wa[1][]']").focus();
            return false;
        }
        if ($("input[name='land_tax[1][]']").val() == '') {
            alertify.error('กรุณาระบุ เนื้อที่ดินที่ต้องชำระภาษี');
            $("input[name='land_tax[1][]']").focus();
            return false;
        }
        if ($("input[name='notice_estimate[1][]']").val() == '') {
            alertify.error('กรุณาระบุ จำนวนภาษีที่ประเมิน');
            $("input[name='notice_estimate[1][]']").focus();
            return false;
        }

    }
    if (tab == 3) {
        if ($("input[name='notice_number[2][]']").val() == '') {
            alertify.error('กรุณาระบุ เลขที่รับ ภ.ป.1');
            $("input[name='notice_number[2][]']").focus();
            return false;
        }
        if ($("input[name='banner_width[2][]']").val() == '') {
            alertify.error('กรุณาระบุ ความกว้างของป้าย');
            $("input[name='banner_width[2][]']").focus();
            return false;
        }
        if ($("input[name='banner_heigth[2][]']").val() == '') {
            alertify.error('กรุณาระบุ ความสูงของป้าย');
            $("input[name='banner_heigth[2][]']").focus();
            return false;
        }
        if ($("input[name='notice_estimate[2][]']").val() == '') {
            alertify.error('กรุณาระบุ จำนวนภาษีที่ประเมิน');
            $("input[name='notice_estimate[2][]']").focus();
            return false;
        }

    }



});