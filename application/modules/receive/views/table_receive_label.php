<br>
<div class="panel">
<table class="table table-bordered jambo_table">
	<thead>
		<tr>
			<th style="text-align: center;" width="8%">เลขที่รับ/ปี</th>
			<th style="text-align: center;" width="20%">เลขประจำตัวผู้เสียภาษี</th>
			<th style="text-align: center;" width="20%">ชื่อผู้เสียภาษี</th>
			<th style="text-align: center;" width="10%">จำนวนเงินภาษี (บาท)</th>
			<th style="text-align: center;" width="10%">เงินเพิ่ม (บาท)</th>
			<th style="text-align: center;" width="10%">ชำระแล้ว (บาท)</th>
			<th style="text-align: center;" width="10%">คงเหลือ (บาท)</th>
			<th style="text-align: center;" width="10%">เครื่องมือ</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($receive as $key => $value) { ?>
		<tr>
			<td style="text-align: center;"><?php echo str_replace($keyword, '<span style="color: red;">' . $keyword . '</span>', $value['notice_number']); ?>/<?php echo $value['tax_year'] + 543 ?></td>
			<td style="text-align: center;"><?php echo str_replace($keyword, '<span style="color: red;">' . $keyword . '</span>', $value['individual_number']); ?></td>
			<td ><?php echo str_replace($keyword, '<span style="color: red;">' . $keyword . '</span>', $value['individual_fullname']); ?></td>
			<td style="text-align: right;"><?php echo number_format($value['sum_amount_tax'], 2); ?></td>
			<td style="text-align: right;"><?php echo number_format($value['tax_interest'], 2); ?></td>
			<td style="text-align: right;"><?php echo number_format($value['tax_amount'], 2); ?></td>
			<td style="text-align: right;"><?php echo number_format($value['sum_amount_tax'] + $value['tax_interest'] - $value['tax_amount'], 2); ?></td>
			<td style="text-align: center;">
			<?php if (($value['sum_amount_tax'] + $value['tax_interest'] - $value['tax_amount']) > 0) : ?>
                 <a title="จ่าย" class="btn btn-success btn-sm" href="<?php echo base_url('receive/receive_tax_pay_add_label/' . $value['individual_id'] . '/' . $value['tax_id']) ?>">ชำระภาษี</a>
			<?php endif; ?>
			</td>

			
			
			<!-- <td style="text-align: center;"><button class="btn btn-success btn-sm" type="button" onclick="window.location.href='<?php echo base_url('receive/receive_tax_pay_add_label/' . $value['notice_id']) ?>'">ชำระภาษี</i></button></td> -->
		</tr>
	<?php 
} ?>
	</tbody>
</table>
</div>
<br>
