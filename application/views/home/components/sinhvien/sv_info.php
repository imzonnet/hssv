<?php  
    if(isset($this->session->userdata['status'])){
        echo "<p style='color:red'>Bạn chưa cập nhật thông tin nội trú, hãy hoàn thành nó trước tiên</p>";
    }
?>
<form name="frmInfo" id="frmInfo" action="<?php echo base_url();?>sinhvien/updateinfo" method="post" class="form-horizontal">

    <table class="table">
        <tr>
            <td>Mã sinh viên:</td>
            <td><?php echo $sv_id; ?></td>
        </tr>
        <tr>
            <td>Họ và Tên:</td>
            <td><?php echo $sv_name; ?></td>
        </tr>
        <tr>
            <td>Ngày sinh:</td>
            <td><?php echo $sv->ngaysinh; ?></td>
        </tr>
        <tr>
            <td>Ngày nhập học:</td>
            <td><?php echo $sv->ngaynhaphoc; ?></td>
        </tr>
        <tr>
            <td>Nơi sinh:</td>
            <td>
                <strong><?php echo $sv->diachi.' - '.$diachi; ?></strong>
                <p>
                    <input type="text" name="diachi" value="<?php echo $sv->diachi; ?>" />
                </p>
                <p>
                    <select name="tinh" id="tinh">
                        <?php echo $tinh; ?>
                    </select>
                </p>
                <p>    <select name="quan" id="quan">
                        <?php echo $quan; ?>
                    </select>
                </p>
                <p>
                    <select name="phuong" id="phuong">
                        <?php echo $phuong; ?>
                    </select><br />
                </p>
            </td>
        </tr>
        
        <tr>
            <td>Số CMND:</td>
            <td><input type="text" name="cmnd" value="<?php echo $sv->cmnd; ?>" /></td>
        </tr> 
        <tr>
            <td>Ngày cấp:</td>
            <td>
                <div class="input-prepend datetimepicker" id="datetimepicker1">
                    <span class="add-on">
                      <i class="icon-calendar" data-date-icon="icon-calendar" data-time-icon="icon-time"></i>
                    </span>
                    <input type="text" id="ngaycap" name="ngaycap" class="span12" value="<?php echo $sv->ngaycap; ?>" />
                </div>
            </td>
        </tr>
        <tr>
            <td>Nơi cấp:</td>
            <td>
                <input type="text" name="noicap" value="<?php echo $sv->noicap; ?>" />
            </td>
        </tr>
        <tr>
            <td>Họ và Tên Cha:</td>
            <td>
                <input type="text" name="hotencha" value="<?php echo $sv->hotencha; ?>" />
            </td>
        </tr>
        <tr>
            <td>Nghề nghiệp cha:</td>
            <td>
                <input type="text" name="manghecha" value="<?php echo $sv->manghecha; ?>" />
            </td>
        </tr>
        <tr>
            <td>Họ và Tên Mẹ:</td>
            <td>
                <input type="text" name="hotenme" value="<?php echo $sv->hotenme; ?>" />
            </td>
        </tr>
        <tr>
            <td>Nghề nghiệp mẹ:</td>
            <td>
                <input type="text" name="mangheme" value="<?php echo $sv->mangheme; ?>" />
            </td>
        </tr>
        <tr class="alert">
            <td>Đối tượng chính sách:</td>
            <td>
                Sinh viên vui lòng cập nhật <a href="sinhvien/doituong">tại đây</a>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                Vui lòng nhập đúng thông tin cá nhân<br />
                Mọi thông tin sẽ được sử dụng cho các giấy tờ của sinh viên<br />
                <strong>Nếu thông tin có gì sai sót thì sinh viên chịu mọi trách nhiệm! </strong>
            </td>
        </tr>
        <tr>
            <td>
                
            </td>
            <td>
                <input type="submit" value="Cập nhật" name="update" class="btn btn-primary"/>
            </td>
        </tr>
    </table>
</form>

<script type="text/javascript">
    $(document).ready(function(){
        
        $('#tinh').change(function(){
            var tinh = $('#tinh').val();
            $('#phuong').html("");
            $.ajax({
                type: 'GET',
                url: '<?php echo site_url(); ?>sinhvien/ajaxQuan/'+tinh,
                success: function(data) {
                    $('#quan').html(data);
                }
            });
        });
        
        $('#quan').change(function(){
            var quan = $('#quan').val();
            $.ajax({
                type: 'GET',
                url: '<?php echo site_url(); ?>sinhvien/ajaxPhuong/'+quan,
                success: function(data) {
                    $('#phuong').html(data);
                }
            });
        });
        jQuery.validator.addMethod("currentDate", function (value) {
            return new Date(value) <= new Date();
        });
        jQuery.validator.addMethod('selectcheck', function (value) {
            return (value != '0');
        });
        $('#frmInfo').validate({
            rules : {
                tinh:{
                    required : true,
                    selectcheck : true
                },
                quan: {
                    required : true,
                    selectcheck : true
                },
                phuong: {
                    required : true,
                    selectcheck : true
                },
                cmnd: {
                    required : true,
                    number: true,
                    minlength: 9,
                    maxlength: 12,
                },
                ngaycap : {
                    required : true,
                    currentDate: true
                },
                noicap : {
                    required : true
                },
                hotencha : {
                    required : true
                },
                hotenme : {
                    required : true
                },
                manghecha : {
                    required : true
                },
                mangheme : {
                    required : true
                }
            },
            messages : {
                tinh:{
                    required : "Không được để trống",
                    selectcheck : "Vui lòng chọn Tỉnh"
                },
                quan: {
                    required : "Không được để trống",
                    selectcheck : "Vui lòng chọn Quận"
                },
                phuong: {
                    required : "Không được để trống",
                    selectcheck : "Vui lòng chọn Phường"
                },
                cmnd: {
                    required : "Không được để trống",
                    number: "Vui lòng kiểm tra lại",
                    minlength: "Vui lòng kiểm tra lại",
                    maxlength: "Vui lòng kiểm tra lại",
                },
                ngaycap : {
                    required : "Không được để trống",
                    currentDate: "Ngày cấp không hợp lệ"
                },
                noicap : {
                    required : "Không được để trống"
                },
                hotencha : {
                    required : "Không được để trống"
                },
                hotenme : {
                    required : "Không được để trống"
                },
                manghecha : {
                    required : "Không được để trống"
                },
                mangheme : {
                    required : "Không được để trống"
                }
            } 
        });
    });
</script>