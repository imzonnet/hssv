<?php
if(isset($mesage)){
	echo $mesage;
}
else{
?>

<div class="span12" style="color:red")>Bạn chắc chắn muốn hủy bỏ đăng ký phòng chứ ?</div>
<div class="control-group">
	<div class="controls">
		<a href="<?php echo base_url('sinhvien/svHuyDkPhong').'/yes'; ?>" class="btn btn-primary">Xác Nhận</a>
    		<a href="<?php echo base_url('sinhvien/dsPhongTrong'); ?>" class="btn btn-inverse">Quay lại</a>
	</div>
</div>
<?php } ?>