<form action="<?php echo base_url('sinhvien/dangtinphanhoi'); ?>" method="post" accept-charset="uft-8">
	<label>Tiêu đề</label>
	<input type="text" name="tieude">
	<label>Nội Dung</label>
	<textarea name="txtnd" style="min-width:825px;min-height:150px"></textarea>
	<input type="submit" class="btn btn-primary" value="Đồng ý" name="dangtin">
	<button class="btn btn-danger" onclick="history.go(-1);">Trở lại</button>
</form>