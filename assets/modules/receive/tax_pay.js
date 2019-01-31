$(document).ready(function () {
    $("input.cal").keyup(function () {
        var amount = $("input[name=amount]").val();
        var interest = $("input[name=interest]").val();
        var sum_amount = (amount * 1) + (interest * 1);
        var receive_amount = $("input[name=receive_amount]").val();


        var balance = (sum_amount * 1) - (receive_amount * 1);


        $("input[name=sum_amount]").val(sum_amount);
        $("input[name=balance]").val(balance);

        if ((receive_amount * 1) > (sum_amount * 1)) {
            alertify.error('จำนวนเงินมากกว่าที่ต้องชำระ');
            document.getElementById("interest").value;
            document.getElementById("receive_amount").value = '';
            document.getElementById("balance").value = '';
        }
        // if(document.getElementById("balance").value*1==''){
        // document.getElementById("#btn-submit").disabled = true;
        // }else{
        // document.getElementById("#btn-submit").disabled = false;
        // }

    });

});

$('#btn-submit').click(function () {

    if ($("input[name='receipt_no']").val() == '') {
        alertify.error('กรุณาระบุ เลขที่ใบเสร็จ');
        $("input[name='receipt_no']").focus();
        return false;
    }
    if ($("input[name='receipt_number']").val() == '') {
        alertify.error('กรุณาระบุ เล่มที่ใบเสร็จ');
        $("input[name='receipt_number']").focus();
        return false;
    }
    if ($("input[name='receive_date']").val() == '') {
        alertify.error('กรุณาระบุ วันที่รับ');
        $("input[name='receive_date']").focus();
        return false;
    }
    if ($("input[name='receive_amount']").val() == '') {
        alertify.error('กรุณาระบุ จำนวนภาษี');
        $("input[name='receive_amount']").focus();
        return false;
    }

});