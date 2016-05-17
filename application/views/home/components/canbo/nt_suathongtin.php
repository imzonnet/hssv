<?php
if($error == true){ 
	echo "Không tìm thấy thông tin phù hợp";
}
else{
    if($this->session->flashdata('success_mgs')!=""){
        echo "<div class='alert alert-success' role='alert'><strong>" . $this->session->flashdata('success_mgs') . "</strong></div>";}
    ?>
        <form name="frmInfo"  method="post" class="form-horizontal" id="frmInfo" action="<?php echo base_url().'canbo/suaTTNT/'.$kqtv['MaNT'];?>">

            <table class="table">
                <tr>
                    <td>Mã NT:</td>
                    <td><input readonly type="text" name="mant" value="<?php echo $kqtv['MaNT']; ?>"</td>
                </tr>
                <tr>
                    <td>Tên chủ trọ:</td>
                    <td><input type="text" name="tenchutro" value="<?php echo $kqtv['TenChuTro']; ?>"></td>
                </tr>
                <tr>
                    <td>Địa chỉ:</td>
                    <td>
                        <strong><?php echo $kqtv['DiaChi']['diachi']; ?></strong>
                        <p>
                            <input type="text" name="diachi" value="<?php echo $kqtv['DiaChi']['diachi']; ?>">
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
                    <td>Điện thoại:</td>
                    <td><input type="text" name="dienthoai" value="<?php echo $kqtv['DienThoai']; ?>"></td>
                </tr>
                <tr>
                    <td>Mã học kỳ</td>
                    <td><input readonly type="text" name="mahk" value="<?php echo $kqtv['MaHK']; ?>"></td>
                </tr>
                <tr>
                    <td>Ngày đến</td>
                    <td>
                        <div class="input-prepend datetimepicker" id="datetimepicker1">
                            <span class="add-on">
                              <i class="icon-calendar" data-date-icon="icon-calendar" data-time-icon="icon-time"></i>
                            </span>
                            <input type="text" name="ngayden" value="<?php echo $kqtv['NgayDen']; ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Ngày đi</td>
                    <td>
                        <div class="input-prepend datetimepicker" id="datetimepicker1">
                            <span class="add-on">
                              <i class="icon-calendar" data-date-icon="icon-calendar" data-time-icon="icon-time"></i>
                            </span>
                            <input type="text" name="ngaydi" value="<?php echo $kqtv['NgayDi']; ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <a href="canbo/tksvnt" class="btn btn-danger" onclick="history.go(-1);">Trở lại</a>
                        <input type="submit" value="Cập nhật" name="update_info" class="btn btn-primary"/>
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
                        tenchutro: {
                            required : true,
                        },
                        dienthoai:{
                            minlength: 10,
                        },
                        mahk:{
                            required : true,    
                        }
                        ngayden : {
                            required : true,
                            currentDate: true,
                        },
                        ngaydi : {
                            required : true,
                            currentDate: true,
                        },
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
                        tenchutro : {
                            required : "Không được để trống"
                        },
                        dienthoai: {
                            required : "Không được để trống",
                            number: "Vui lòng kiểm tra lại",
                            minlength: "Vui lòng kiểm tra lại",
                        },
                        mahk : {
                            required : "Không được để trống"
                        },
                        ngayden : {
                            required : "Không được để trống",
                            currentDate: "Ngày đến không hợp lệ"
                        },
                        ngaydi : {
                            required : "Không được để trống",
                            currentDate: "Ngày đi không hợp lệ"
                        },
                        
                       
                    } 
                });
            });
        </script>
<?php } ?>