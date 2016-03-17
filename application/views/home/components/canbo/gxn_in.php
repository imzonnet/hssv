<script type="text/javascript">
    $(document).ready(function(){
        $('#gxn').validate({
            rules: {
                'masv': {
                    required: true,
                    minlength: 11,
                    maxlength: 12
                },
                'lgiay[]': {
                    required: true
                }
            },
            messages: {
                'masv': "* Mã sinh viên không hợp lệ",
                'lgiay[]': '* Vui lòng chọn loại giấy'
            },
            errorLabelContainer: '#message-box'
        });
    });
</script>
<div id="message-box" class="alert alert-error" style="display:none;">

</div>
<form action="<?php echo base_url();?>canbo/checkyccgxn" method="post" class="form-horizontal" id="gxn">
    <div class="control-group">
        <label class="control-label" for="masv">Mã Sinh Viên</label>
        <div class="controls">
            <input type="text" name="masv" id="masv" placeholder="111250532137" size="12" />
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Mã Học Kỳ</label>
        <div class="controls">
            <label class="checkbox"><input type="hidden" name="mhk" value="<?php echo $mahk; ?>"/> <?php echo $mahk; ?></label>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Loại giấy</label>
        <div class="controls loaigiay">
        <?php
            foreach($listGXN as $k) :
        ?>
            <label class="checkbox">
                <input type="checkbox" name="lgiay[]" value="<?php echo $k['MaLG']; ?>" /> <?php echo $k['TenLG']; ?>
            </label>
        <?php endforeach; ?>
        </div>
    </div>
    <div class="control-group">
        <div class="controls"><input type="submit" class="btn" name="send" id="send" value="Xác nhận" /></div>
    </div>
</form>
