<?php
    if(isset($error))
     echo "<div class='alert alert-danger'>$error</div>";
?>
<form action="<?php echo base_url('canbo/xemdsctdk'); ?>" id="frmEx" name="frmEx" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Chọn tập tin</label>
        <div class="controls">
            <input type="file" name="fex" value="" class="box" />
        </div>
    </div>
    
    <div class="control-group">
        <div class="controls"><input type="submit" class="btn btn-primary" name="upload" value="Thêm File " /></div>
    </div>
</form>
<div class="box">
    Vui lòng kiểm tra file trước khi upload!<br />
    <a href="upload/chinhtri/chinhtridaukhoa.xls" >Download File Chính Trị Đầu Khóa mẫu</a>
</div>
<script>
$(document).ready(function(){
    $('#frmEx').validate({
        rules : {
            fex : {required: true}
        },
        messages : {
            fex: "Vui lòng chọn tập tin"
        }
    })
});
</script>