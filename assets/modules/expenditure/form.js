$(function () {
	
	$('#amount_vat').on("ifChanged",function () {

		var expenses_amount = $('#expenses_amount').val();
		expenses_amount = parseFloat(expenses_amount.replace(/,/g,''));


		var expenses_amount_vat = 0;
		var expenses_amount_tax = 0;
		if ($('input#amount_vat').is(':checked')) {
			vat = $('#amount_vat_val').val();
			expenses_amount_vat = expenses_amount * vat / 100;
			$('#expenses_amount_vat').prop('disabled', false);
			$('#amount_vat_val').prop('disabled', false);
		}else{
			$('#expenses_amount_vat').prop('disabled', true);
			$('#amount_vat_val').prop('disabled', true);
		}
		if ($('input#amount_tax').is(':checked')) {
			tax = $('#amount_tax_val').val();
			expenses_amount_tax = expenses_amount * tax / 100;
		}

		$('#expenses_amount_vat').val(expenses_amount_vat);
		$('#expenses_amount_disburse').val(expenses_amount + expenses_amount_vat);
		$('#expenses_amount_tax').val(expenses_amount_tax);
		$('#expenses_amount_result').val(expenses_amount + expenses_amount_vat - expenses_amount_tax);
	});

	$('#amount_tax').on("ifChanged",function () {

		var expenses_amount = $('#expenses_amount').val();
		expenses_amount = parseFloat(expenses_amount.replace(/,/g,''));


		var expenses_amount_vat = 0;
		var expenses_amount_tax = 0;
		if ($('input#amount_vat').is(':checked')) {
			vat = $('#amount_vat_val').val();
			expenses_amount_vat = expenses_amount * vat / 100;
		}
	
		if ($('input#amount_tax').is(':checked')) {
			tax = $('#amount_tax_val').val();
			expenses_amount_tax = expenses_amount * tax / 100;
			$('#expenses_amount_tax').prop('disabled', false);
			$('#amount_tax_val').prop('disabled', false);
		}
		else{
			$('#expenses_amount_tax').prop('disabled', true);
			$('#amount_tax_val').prop('disabled', true);
		}
		var expenses_amount_fine = $('#expenses_amount_disburse').val();
		expenses_amount_fine = parseFloat(expenses_amount_fine.replace(/,/g,''));

		$('#expenses_amount_vat').val(expenses_amount_vat);
		$('#expenses_amount_disburse').val(expenses_amount + expenses_amount_vat);
		$('#expenses_amount_tax').val(expenses_amount_tax);

		$('#expenses_amount_result').val(expenses_amount + expenses_amount_vat - expenses_amount_tax);
	});

	$('#expenses_amount').keyup(function () {
		var expenses_amount = this.value;
		expenses_amount = parseFloat(expenses_amount.replace(/,/g,''));


		var expenses_amount_vat = 0;
		var expenses_amount_tax = 0;
		if ($('input#amount_vat').is(':checked')) {
			vat = $('#amount_vat_val').val();
			expenses_amount_vat = expenses_amount * vat / 100;
		}
		if ($('input#amount_tax').is(':checked')) {
			tax = $('#amount_tax_val').val();
			expenses_amount_tax = expenses_amount * tax / 100;
		}

		$('#expenses_amount_vat').val(expenses_amount_vat);
		$('#expenses_amount_disburse').val(expenses_amount + expenses_amount_vat);
		$('#expenses_amount_tax').val(expenses_amount_tax);
		$('#expenses_amount_result').val(expenses_amount + expenses_amount_vat - expenses_amount_tax);
	});

	$('#expenses_amount_disburse').keyup(function () {
		var expenses_amount_disburse = this.value;
		expenses_amount_disburse = parseFloat(expenses_amount_disburse.replace(/,/g,''));

		var expenses_amount_vat = 0;
		var expenses_amount_tax = 0;
		if ($('input#amount_vat').is(':checked')) {
			vat = $('#amount_vat_val').val();
			expenses_amount_vat = expenses_amount_disburse * vat / 107;
		}
		var expenses_amount = expenses_amount_disburse - expenses_amount_vat;
		if ($('input#amount_tax').is(':checked')) {
			tax = $('#amount_tax_val').val();
			expenses_amount_tax = expenses_amount * tax / 100;
		}


		// var expenses_amount_vat = expenses_amount_disburse*7/107;

		// var expenses_amount_tax = expenses_amount*1/100;

		$('#expenses_amount').val(expenses_amount);
		$('#expenses_amount_vat').val(expenses_amount_vat);
		$('#expenses_amount_tax').val(expenses_amount_tax);
		$('#expenses_amount_result').val(expenses_amount + expenses_amount_vat - expenses_amount_tax);
	});

	$('#amount_vat_val').keyup(function () {
		var expenses_amount = $('#expenses_amount').val();
		expenses_amount = parseFloat(expenses_amount.replace(/,/g,''));


		var expenses_amount_vat = 0;
		var expenses_amount_tax = 0;
		if ($('input#amount_vat').is(':checked')) {
			vat = $('#amount_vat_val').val();
			expenses_amount_vat = expenses_amount * vat / 100;
		}
		if ($('input#amount_tax').is(':checked')) {
			tax = $('#amount_tax_val').val();
			expenses_amount_tax = expenses_amount * tax / 100;
		}

		$('#expenses_amount_vat').val(expenses_amount_vat);
		$('#expenses_amount_disburse').val(expenses_amount + expenses_amount_vat);
		$('#expenses_amount_tax').val(expenses_amount_tax);
		$('#expenses_amount_result').val(expenses_amount + expenses_amount_vat - expenses_amount_tax);
	});

	$('#amount_tax_val').keyup(function () {
		var expenses_amount = $('#expenses_amount').val();
		expenses_amount = parseFloat(expenses_amount.replace(/,/g,''));


		var expenses_amount_vat = 0;
		var expenses_amount_tax = 0;
		if ($('input#amount_vat').is(':checked')) {
			vat = $('#amount_vat_val').val();
			expenses_amount_vat = expenses_amount * vat / 100;
		}
		if ($('input#amount_tax').is(':checked')) {
			tax = $('#amount_tax_val').val();
			expenses_amount_tax = expenses_amount * tax / 100;
		}

		var expenses_amount_fine = $('#expenses_amount_fine').val();
		expenses_amount_fine = parseFloat(expenses_amount_fine.replace(/,/g,''));

		$('#expenses_amount_vat').val(expenses_amount_vat);
		$('#expenses_amount_disburse').val(expenses_amount + expenses_amount_vat);
		$('#expenses_amount_tax').val(expenses_amount_tax);
		$('#expenses_amount_result').val(expenses_amount + expenses_amount_vat - expenses_amount_tax - expenses_amount_fine);
	});

	$('#expenses_amount_fine').keyup(function () {
		var expenses_amount_fine = this.value;
		expenses_amount_fine = parseFloat(expenses_amount_fine.replace(/,/g,''));

		var expenses_amount = $('#expenses_amount').val();
		expenses_amount = parseFloat(expenses_amount.replace(/,/g,''));

		var expenses_amount_vat = 0;
		var expenses_amount_tax = 0;
		if ($('input#amount_vat').is(':checked')) {
			expenses_amount_vat = $('#expenses_amount_vat').val();
			expenses_amount_vat = parseFloat(expenses_amount_vat.replace(/,/g,''));
		}

		if ($('input#amount_tax').is(':checked')) {
			expenses_amount_tax = $('#expenses_amount_tax').val();
			expenses_amount_tax = parseFloat(expenses_amount_tax.replace(/,/g,''));
		}

		// var expenses_amount_vat = $('#expenses_amount_vat').val();
		// expenses_amount_vat = parseFloat(expenses_amount_vat.replace(',',''));

		var expenses_amount_disburse = $('#expenses_amount_disburse').val();
		expenses_amount_disburse = parseFloat(expenses_amount_disburse.replace(/,/g,''));

		// var expenses_amount_tax = $('#expenses_amount_tax').val();
		// console.log(expenses_amount_disburse)
		// console.log(expenses_amount_tax)
		// console.log(expenses_amount_fine)
		if (expenses_amount_fine) {
			$('#expenses_amount_result').val(expenses_amount_disburse - expenses_amount_tax - expenses_amount_fine);
		} else {
			$('#expenses_amount_result').val(expenses_amount + expenses_amount_vat - expenses_amount_tax);
		}
	});

	///vat and tax keyup
	$('#expenses_amount_vat').keyup(function () {
		var expenses_amount = $('#expenses_amount').val();
		
		expenses_amount = parseFloat(expenses_amount.replace(/,/g,''));

		var expenses_amount_vat = parseFloat(this.value);

		// var expenses_amount_vat = 0;
		var expenses_amount_tax = 0;
		// if ($('input#amount_vat').is(':checked')) {
		// 	vat = $('#amount_vat_val').val();
		// expenses_amount_vat = expenses_amount * vat / 100;
		// }
		if ($('input#amount_tax').is(':checked')) {
			tax = $('#amount_tax_val').val();
			expenses_amount_tax = expenses_amount * tax / 100;
		}

		// $('#expenses_amount_vat').val(expenses_amount_vat);
		$('#expenses_amount_disburse').val(expenses_amount + expenses_amount_vat);
		$('#expenses_amount_tax').val(expenses_amount_tax);
		$('#expenses_amount_result').val(expenses_amount + expenses_amount_vat - expenses_amount_tax);
	});
	$('#expenses_amount_tax').keyup(function () {
		var expenses_amount = $('#expenses_amount').val();
		
		expenses_amount = parseFloat(expenses_amount.replace(/,/g,''));

		var expenses_amount_tax = parseFloat(this.value);

		// var expenses_amount_vat = 0;
		// var expenses_amount_tax = 0;
		if ($('input#amount_vat').is(':checked')) {
			vat = $('#amount_vat_val').val();
			expenses_amount_vat = expenses_amount * vat / 100;
		}
		// if ($('input#amount_tax').is(':checked')) {
		// 	tax = $('#amount_tax_val').val();
		// 	expenses_amount_tax = expenses_amount * tax / 100;
		// }

		$('#expenses_amount_vat').val(expenses_amount_vat);
		$('#expenses_amount_disburse').val(expenses_amount + expenses_amount_vat);
		// $('#expenses_amount_tax').val(expenses_amount_tax);
		$('#expenses_amount_result').val(expenses_amount + expenses_amount_vat - expenses_amount_tax);
	});


	// check potection expenditure in
	$('#btn-submit').click(function(){

		if ($("input[name='expenses_date']").val() == '') {
			alertify.error('กรุณาระบุวันที่จัดทำ');
			$("input[name='expenses_date']").focus();
			return false;
		}
		if ($("input[name='expenses_amount']").val() == '') {
			alertify.error('กรุณาระบุจำนวนเงิน');
			$("input[name='expenses_amount']").focus();
			return false;
		}
	});


});