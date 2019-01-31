<table class="table">
    <thead>
    <tr>
        <th width="10%">ครั้งที่</th>
        <th width="50%"  >วันที่แจ้งเตือน</th>
        <th width="30%" >&nbsp;</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $key => $value) {?>
        <tr>
            <th scope="row"><?=$value->alert_order;?></th>
            <td class="text-center"><?=$this->mydate->date_eng2thai($value->alert_date, '', 'S');?></td>
            <td class="text-left"><div class="btn-group">
                    <a class="btn btn-info btn-sm" target="_blank" href='<?php echo base_url('export/alert_tax') . '/' . $value->alert_id; ?>' type="button">พิมพ์</a>
                    <a class="btn btn-danger  btn-sm" onclick="delAlert(<?php echo $value->alert_id . ',' . $value->notice_id; ?>)" type="button">ลบ</a>
                </div>
            </td>
        </tr>
    <?php }?>


    </tbody>
</table>