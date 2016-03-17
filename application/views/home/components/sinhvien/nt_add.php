<?php
    if($error == '1')
        echo "<div class='alert alert-success'>Đã thêm địa chỉ ngoại trú thành công!<br /> <a href='sinhvien/dsngoaitru'>Xem danh sách địa chỉ ngoại trú</a></div>";
    else {
        if($error == '-1')
            echo "<div class='alert alert-info'>Trong thời gian này bạn đang ở tại 1 địa chỉ ngoại trú! Vui lòng kiểm tra lại</div>";
        elseif($error == '-2') echo "<div class='alert alert-error'>Vui lòng kiểm tra lại thông tin vừa nhập!</div>";
?>
<div class="span7">
    <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>sinhvien/vaddngoaitru" id="ngoaitru">
                        
        <div class="control-group">
            <label class="control-label" for="ten">Tên chủ trọ <i class="icon-star-empty"></i></label>
            <div class="controls">
                <input type="text" name="ten" id="ten" placeholder="Nguyễn Đức Anh" value="<?php echo isset($_POST['ten']) ? $_POST['ten'] : null; ?>" />
            </div>
            
        </div>
        <div class="control-group">
            <label class="control-label">Số điện thoại <i class="icon-star-empty"></i> </label>
            <div class="controls">
                <input type="text" name="sodt"  id="sodt" placeholder="0987987987" value="<?php echo isset($_POST['sodt']) ? $_POST['sodt'] : null; ?>"/>
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="diachi">Địa chỉ ngoại trú <i class="icon-star-empty"></i></label>
            <div class="controls">
                <input type="text" name="diachi" id="diachi" placeholder="48 Cao Thắng" value="<?php echo isset($_POST['diachi']) ? $_POST['diachi'] : null; ?>" />
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="quan">Quận <i class="icon-star-empty"></i></label>
            <div class="controls">
                <select name="quan" id="quan">
                    <?php echo isset($ds_quan) ? $ds_quan : '<option value="0"></option>'; ?>
                </select>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="phuong">Phường <i class="icon-star-empty"></i></label>
            <div class="controls">
                <select name="phuong" id="phuong">
                    <?php echo isset($ds_phuong) ? $ds_phuong : '<option value="0"></option>'; ?>
                </select>
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="ngayden">Ngày đến <i class="icon-star-empty"></i></label>
            <div class="controls">
                <div id="datetimepicker1" class="controls input-prepend datetimepicker">
                    <span class="add-on">
                      <i data-time-icon="icon-time" data-date-icon="icon-calendar" class="icon-calendar"></i>
                    </span>
                    <input type="text" name="ngayden" id="ngayden" value="<?php echo isset($_POST['ngayden']) ? $_POST['ngayden'] : null; ?>" placeholder="2013-12-12" />
                </div>
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="ngaydi">Ngày đi</label>
            <div class="controls">
                <div id="datetimepicker2" class="controls input-prepend datetimepicker">
                    <span class="add-on">
                      <i data-time-icon="icon-time" data-date-icon="icon-calendar" class="icon-calendar"></i>
                    </span>
                    <input type="text" name="ngaydi" id="ngaydi" placeholder="2013-12-12" value="<?php echo isset($_POST['ngaydi']) ? $_POST['ngaydi'] : null; ?>"/>
                </div>
            </div>
        </div>
        
        <div class="control-group">
            <div class="controls">
                <a href="sinhvien/dsngoaitru" class="btn btn-inverse">Hủy bỏ</a>
                <button type="submit" class="btn btn-primary" name="add" id="add" value="ok">Thêm địa chỉ</button>
            </div>
        </div>
    </form>
</div>
<div class="span4 alert alert-info">
    Vui lòng điền đầy đủ các mục có dấu <i class="icon-star-empty"></i><br />
    - Nêu đang ở tại địa chỉ này thì <b>Ngày đi</b> có thể bỏ qua và cập nhật sau!
</div>
<?php     
    }
?>
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
                        ngaydi: true
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
                    ngayden: {
                        required: "Vui lòng chọn ngày đến",
                        currentDate: "Ngày không được lớn ngày hiện tại",
                        date: "Ngày tháng không hợp lệ"
                    },
                    quan: "Vui lòng chọn 'Quận'",
                    phuong: "Vui lòng chọn 'Phường'",
                    ngaydi: {
                        date: "Ngày tháng không hợp lệ",
                        greaterStart: "Không được nhỏ hơn ngày đến",
                        ngaydi: "Ngày đi không được lớn hơn ngày hiện tại"
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
        jQuery.validator.addMethod("ngaydi", function (value) {
            if(value=="") return true;
            else return new Date(value) <= new Date();
        });
    });
</script>
