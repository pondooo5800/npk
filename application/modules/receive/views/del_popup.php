    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="delmodal">การแจ้งเตือน!</h4>
            </div>
            
            
            <div class="modal-body">
                    <h5 align="center">ต้องการลบข้อมูลรายการนี้ใช่หรือไม่</h5>
            </div>

            <div class="modal-footer">
                <button type="button" id="btn-del" class="btn btn-danger"><i class="fa fa-trash"></i> ลบ
                </button>

                <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก
                </button>
            </div>
        </div>
    </div>

<script type="text/javascript">
    var domain='<?php echo base_url(); ?>/';
</script>
<script type="text/javascript">
 setTimeout(function(){
  $(document).ready(function(){
   $('#btn_delete').on('click',function(){
     
       var id = $(this).attr("data-id");
        console.log(id);return false;
       window.location.replace(domain+'receive/'+'receive_tax_delete'+'/'+id);
   });
    // onclick=" 
  });
}, 500);
    
</script>