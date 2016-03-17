<div>
	<ul>
		<li><b>Thông tin sinh viên</b></li>
		<li></li>
		<li>Mã Sinh Viên: <?php echo $thongtinsv[0]['MaSV']; ?></li>
		<li>Họ Tên: <?php echo $thongtinsv[0]['HoTen']; ?></li>
		<li>Ngày Sinh: <?php echo $thongtinsv[0]['NgaySinh']; ?></li>
		<li>CMND: <?php echo $thongtinsv[0]['CMND']; ?></li>
		<li>Lớp: <?php echo $thongtinsv[0]['MaLop']; ?></li>
		<li>Niên Khóa: <?php echo $thongtinsv[0]['KhoaHoc']; ?></li>
	
	</ul>
	<div class="span12">
		<form action="<?php echo base_url('canbo/xacNhanSvDkPhong'); ?>" method="post" accept-charset="uft-8">
			<label><b> Ghi chú </b></label>
			<label>
			<input type="hidden" value="<?php echo $id; ?>" name="id">
			<input type="hidden" value="<?php echo $MaPhong; ?>" name="maphong">
			<textarea name="ghichu" style="min-width:500px;min-height:200px"></textarea>
			</label>
			<input type="submit" class="btn btn-primary" value="Đồng ý" name="xacnhan">
			<button class="btn btn-danger" onclick="history.go(-1);">Trở lại</button>
		</form>
	</div>
</div>