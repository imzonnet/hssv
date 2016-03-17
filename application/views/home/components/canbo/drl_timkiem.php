
<form name="frmSearch" method="post" class="form-horizontal" action="<?php echo base_url('canbo/ketquadrllsh'); ?>/">
    <div class="control-group">
        <label class="control-label">
            Lớp sinh hoạt:
        </label>
        <div class="controls">
            <select name="lopsh">
                <?php
                    foreach($ds_lop as $k => $v)
                    {
                        echo '<option value="'.$v['MaLop'].'">'.$v['MaLop'].'</option>';
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">
            Học kỳ:
        </label>
        <div class="controls">
            <select name="mahk" class="span2">
                <?php
                    foreach($ds_hk as $k => $v)
                    {
                        echo '<option value="'.$v['MaHK'].'">'.$v['MaHK'].'</option>';
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <input type="submit" name="search" value="Tìm kiếm" class="btn btn-primary" />
        </div>
    </div>
</form>

<form id='frmSearchSV' name="frmSearchSV" method="post" class="form-horizontal" action="<?php echo base_url('canbo/ketquadrlsv'); ?>/">
    <div class="control-group">
        <label class="control-label">
            Mã sinh viên
        </label>
        <div class="controls">
            <input type="text" name="masv" value="" placeholder="Nhập mã sinh viên" />
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
			masv : {
				required : true,
				number: true, 
				minlength: 12,
				maxlength: 12
			}
		}, 
		messages : {
			masv : {
				required: "Không được để trống",
				number: "Sai định dạng",
				minlength : "Không hợp lệ",
				maxlength : "Không hợp lệ"
			}
		}
	});
	
});

</script>