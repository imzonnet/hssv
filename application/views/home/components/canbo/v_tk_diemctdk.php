<div class="alert">
    <strong>Ghi chú:</strong><br />
    Lựa chọn một trong các tiêu chi sau để tìm kiếm. <br />
</div>
<form id="frmSearchSV" name="frmSearchSV" method="get" class="form-horizontal" action="<?php echo base_url('canbo/timdiemctdktheoma'); ?>">
    <div class="control-group">
        <label class="control-label">
            Mã Sinh Viên:
        </label>
        <div class="controls">
            <p><input type="text" name="txtmasv" value="" placeholder="Nhập mã sinh viên" /></p>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <input type="submit" name="searchmasv" value="Tìm kiếm" class="btn btn-primary" />
        </div>
    </div>
</form>
<form id="frmSearchLop" name="frmSearchLop" method="get" class="form-horizontal" action="<?php echo base_url('canbo/timdiemctdktheolop'); ?>">
    <div class="control-group">
        <label class="control-label">
            Lớp chính trị
        </label>
        <div class="controls">
            <p>
            <select name="malop">
                <?php
                    foreach($dslopct as $k => $v){
                        echo '<option value="'.$v['LopCT'].'">'.$v['LopCT'].'</option>';
                    }
                ?>
            </select>
            </p>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <input type="submit" name="search" value="Tìm kiếm" class="btn btn-primary" />
        </div>
    </div>
</form>
<script>
$().ready(function(){
    $('#frmSearchSV').validate({
        rules : {
            txtmasv: {
                required : true,
                number: true, 
                minlength: 12,
                maxlength: 12
            }
        }, 
        messages : {
            txtmasv: {
                required: "Không được để trống",
                number: "Sai định dạng",
                minlength : "Không hợp lệ",
                maxlength : "Không hợp lệ"
            }
        }
    });
</script>