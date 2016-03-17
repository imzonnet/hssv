<?php
    if($error == '1')
        echo "<script>alert('Cập nhật địa chỉ ngoại trú thành công');location.href='sinhvien/dsngoaitru';</script>";
    elseif($error == '-1')
        echo "<div class='alert alert-info'>Thông tin nhập không hợp lệ! Vui lòng kiểm tra lại</div>";
?>

<div class="span6">
    <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>sinhvien/editngoaitru/edit/<?php echo $nt['MaNT']; ?>" id="ngoaitru">
                        
        <div class="control-group">
            <label class="control-label" for="ten">Tên chủ trọ <i class="icon-star-empty"></i></label>
            <div class="controls">
                <input type="hidden" name="ten" id="ten" value="<?php echo isset($nt['TenChuTro']) ? $nt['TenChuTro'] : null; ?>" />
                <?php echo isset($nt['TenChuTro']) ? $nt['TenChuTro'] : null; ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Số điện thoại <i class="icon-star-empty"></i> </label>
            <div class="controls">
                <input type="hidden" name="sodt"  id="sodt" value="<?php echo isset($nt['DienThoai']) ? $nt['DienThoai'] : null; ?>"/>
                <?php echo isset($nt['DienThoai']) ? $nt['DienThoai'] : null; ?>
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="diachi">Địa chỉ ngoại trú <i class="icon-star-empty"></i></label>
            <div class="controls">
                <input type="hidden" name="diachi" id="diachi" value="<?php echo isset($nt['DiaChi']) ? $nt['DiaChi'] : null; ?>" />
                <?php echo isset($nt['DiaChi']) ? $nt['DiaChi'] : null; ?>
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="quan">Quận <i class="icon-star-empty"></i></label>
            <div class="controls">
                <input type="hidden" name="quan" id="quan" value="<?php echo isset($nt['maquan']) ? $nt['maquan'] : null; ?>" />
                <?php echo isset($nt['tquan']) ? $nt['tquan'] : null; ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="phuong">Phường <i class="icon-star-empty"></i></label>
            <div class="controls">
                <input type="hidden" name="phuong" id="phuong" value="<?php echo isset($nt['maphuong']) ? $nt['maphuong'] : null; ?>" />
                <?php echo isset($nt['tphuong']) ? $nt['tphuong'] : null; ?>
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="ngayden">Ngày đến <i class="icon-star-empty"></i></label>
            <div class="controls" >
                <input readonly="readonly" type="hidden" name="ngayden" id="ngayden" value="<?php echo isset($nt['NgayDen']) ? $nt['NgayDen'] : null; ?>" />
                <?php echo isset($nt['NgayDen']) ? $nt['NgayDen'] : null; ?>
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="ngaydi">Ngày đi</label>
            <div class="controls">
                <div id="datetimepicker2" class="controls input-prepend datetimepicker">
                    <span class="add-on">
                      <i data-time-icon="icon-time" data-date-icon="icon-calendar" class="icon-calendar"></i>
                    </span>
                    <input type="text" name="ngaydi" id="ngaydi" placeholder="2013-12-12" value="<?php echo isset($nt['NgayDi']) ? $nt['NgayDi'] : null; ?>"/>
                </div>
            </div>
        </div>
        
        <div class="control-group">
            <div class="controls">
                <a href="sinhvien/dsngoaitru" class="btn btn-inverse">Trở về</a>
                <button type="submit" class="btn btn-primary" name="update" id="update" value="ok">Cập nhật</button>
            </div>
        </div>
    </form>
</div>
<div class="span5 alert alert-success">
Mọi thông tin địa chỉ ngoại trụ này không thể chính sửa.<br />
Sinh viên chỉ được phép cập nhật <strong>Ngày Đi</strong><br />
    Sau khi sinh viên cập nhật <strong>Ngày Đi</strong> thì sẽ <b>không được chỉnh sửa nữa.</b>
    Nếu có gì sai sau này SV tự chịu trách nhiệm<br />
    
    
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#quan').change(function(){
            var quan = $('#quan').val();
            $.ajax({
                type: 'GET',
                url: '<?php echo site_url(); ?>sinhvien/ajaxPhuong/'+quan,
                success: function(data) {
                    $('#phuong').html('<i class="icon-refresh"></i>');
                    $('#phuong').show().html(data);
                }
            });
        });
        $().ready(function() {
            $("#ngoaitru").validate( {
                rules: {
        			ten: {
        				required: true,
        				minlength: 5
        			},
                    diachi: {
                        required: true,
                    },
        			sodt: {
        				required: true,
        				number: true,
                        minlength: 9,
                        maxlength: 12
        			},
                    quan: {
                        selectcheck: true  
                    },
                    phuong: {
                        selectcheck: true   
                    },
                    ngayden: {
                        required: true,
                        date: true,
                        currentDate: true
                    },
                    ngaydi: {
                        date: true,
                        greaterStart: "#ngayden",
                        currentDate: true
                    }
        		},
        		messages: {
        			ten: "Vui lòng nhập họ tên đầy dủ",
        			sodt: {
                        required: 'Bạn phải nhập số điện thoại',
                        number: 'Số điện thoại không hợp lệ',
                        minlength: 'Số điện thoại không hợp lệ',
                        maxlength: 'Số điện thoại không hợp lệ'
                    },
                    diachi: "Vui lòng nhập địa chỉ",
                    ngayden: "Vui lòng nhập đầy đủ",
                    quan: "Vui lòng chọn 'Quận'",
                    phuong: "Vui lòng chọn 'Phường'",
                    ngaydi: {
                        greaterStart: "Không được nhỏ hơn ngày đến",
                        currentDate: "Không được lớn hơn ngày hiện tại"
                    }
        		}
            }); 
        });
        jQuery.validator.addMethod('selectcheck', function (value) {
            return (value != '0');
        });
        jQuery.validator.addMethod("greaterStart", function (value, element, params) {
            return this.optional(element) || new Date(value) > new Date($(params).val());
        });
        jQuery.validator.addMethod("currentDate", function (value) {
            return new Date(value) <= new Date();
        });
    });
</script>
