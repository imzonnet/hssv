<div class="span7">
    <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>sinhvien/editngoaitru/delete/<?php echo $nt['MaNT']; ?>" id="ngoaitru">
                        
        <div class="control-group">
            <label class="control-label" for="ten">Tên chủ trọ <i class="icon-star-empty"></i></label>
            <div class="controls">
                <?php echo isset($nt['TenChuTro']) ? $nt['TenChuTro'] : null; ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Số điện thoại <i class="icon-star-empty"></i> </label>
            <div class="controls">
                <?php echo isset($nt['DienThoai']) ? $nt['DienThoai'] : null; ?>
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="diachi">Địa chỉ ngoại trú <i class="icon-star-empty"></i></label>
            <div class="controls">
                <?php echo isset($nt['DiaChi']) ? $nt['DiaChi'] : null; ?>
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="quan">Quận <i class="icon-star-empty"></i></label>
            <div class="controls">
                <?php echo isset($ds_quan) ? $ds_quan : null; ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="phuong">Phường <i class="icon-star-empty"></i></label>
            <div class="controls">
                <?php echo isset($ds_phuong) ? $ds_phuong : null; ?> 
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="ngayden">Ngày đến <i class="icon-star-empty"></i></label>
            <div class="controls">
                 <?php echo isset($nt['NgayDen']) ? $nt['NgayDen'] : null; ?>
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="ngaydi">Ngày đi</label>
            <div class="controls">
                <?php echo isset($nt['NgayDi']) ? $nt['NgayDi'] : null; ?>
            </div>
        </div>
        
        <div class="control-group">
            <div class="controls">
                <a href="sinhvien/dsngoaitru" class="btn btn-inverse">Trở về</a>
                <button type="submit" class="btn btn-danger" name="delete" id="delete" value="ok">Xóa địa chỉ</button>
            </div>
        </div>
    </form>
</div>
<div class="span4 alert alert-info">
    Vui lòng điền đầy đủ các mục có dấu <i class="icon-star-empty"></i>
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
                        date: true
                    },
                    ngaydi: {
                        date: true,
                        greaterStart: "#ngayden"
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
                    ngaydi: "Không được nhỏ hơn ngày đến"
        		}
            }); 
        });
        jQuery.validator.addMethod('selectcheck', function (value) {
            return (value != '0');
        });
        jQuery.validator.addMethod("greaterStart", function (value, element, params) {
            return this.optional(element) || new Date(value) > new Date($(params).val());
        },'Must be greater than start date.');
    });
</script>
