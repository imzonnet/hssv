<div class="alert">
    <strong>Ghi chú:</strong><br />
    Lựa chọn một trong các tiêu chi sau để tìm kiếm. <br />
    <b>Tìm kiếm theo thông tin Sinh Viên</b>
    <br /><b>Tìm kiếm theo danh sách lớp sinh hoạt</b>
    <br /><b>Tìm kiếm theo địa chỉ nội trú</b>
</div>
<form id="frmSearchSV" name="frmSearchSV" method="post" class="form-horizontal" action="<?php echo base_url('canbo/timKiemTheoThongTinSv'); ?>/">
    <div class="control-group">
        <label class="control-label">
            Sinh Viên:
        </label>
        <div class="controls">
            <p>
            <select name="tc">
                <option value="0">--Lựa chọn--</option>
                <option value="1">Mã sinh viên</option>
                <option value="2">Họ tên sinh viên</option>
            </select>
            </p>
            <p><input type="text" name="txtsv" value="" placeholder="nội dung tìm kiếm" /></p>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <input type="submit" name="searchsvnoitru" value="Tìm kiếm" class="btn btn-primary" />
        </div>
    </div>
</form>
<form id="frmSearchLop" name="frmSearchLop" method="post" class="form-horizontal" action="<?php echo base_url('canbo/timKiemTheoLopSinhHoat'); ?>/">
    <div class="control-group">
        <label class="control-label">
            Lớp sinh hoạt
        </label>
        <div class="controls">
            <p>
            <select name="malop">
                <?php
                    foreach($lopsh as $k => $v){
                        echo '<option value="'.$v['MaLop'].'">'.$v['MaLop'].'</option>';
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

<script type="text/javascript">
    $(document).ready(function(){
        $('#phuong').hide();
        $('#quan').change(function(){
            var quan = $('#quan').val();
            $.ajax({
                type: 'GET',
                url: '<?php echo site_url(); ?>canbo/ajaxPhuong/'+quan,
                success: function(data) {
                    $('#phuong').html('<i class="icon-refresh"></i>');
                    $('#phuong').show().html(data);
                }
            });
        });
        $('#frmSearchSV').validate({
            rules : {
                tc : { 
                    required : true,
                    selectcheck: true
                },
                txtsv : {
                    required : true,
                    minlength : 3,
                    checkType: true
                }
            },
            messages : {
                tc : {
                    required: "Vui lòng chọn",
                    selectcheck : "Vui lòng chọn tiêu chí để tìm kiếm"
                },
                txtsv : {
                    required: "Không được để trống",
                    minlength: "Nội dung quá ngắn, ít nhất 3 ký tự",
                    checkType: 'Hehehehehe'
                }
            }
        });
        $('#frmSearchAdd').validate({
            rules : {
                quan : { 
                    required : true,
                    selectcheck: true
                }
            },
            messages : {
                quan : {
                    required: "Vui lòng chọn",
                    selectcheck : "Vui lòng chọn địa chỉ Quận"
                }
            }
        })
        jQuery.validator.addMethod('selectcheck', function (value) {
            return (value != '0');
        });
        jQuery.validator.addMethod('checkType', function(value,element, params){
            if($(params).val() == '1') return this.optional(element) || $.isNumber(value);       
        });
    });
</script>