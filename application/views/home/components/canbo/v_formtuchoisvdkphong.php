
<?php 
	if(isset($message_susscess)){
		echo '<p>'.$message_susscess.'</p>';
	?>
	<a href="<?php echo base_url('canbo/dsSvDkMotPhong').'/'.$maphong; ?>">Quay lại danh sách</a>
	<?php
	}
	elseif(isset($message_error)){

		echo '<p>'.$message_error.'</p>';?>
	<?php
	}
	else{ 
?>
	<div class="span12">
		<form action="<?php echo base_url('canbo/tuChoiSvDkPhong').'/'.$id.'/'.$maphong; ?>" method="post" accept-charset="uft-8">
			<label>
			<textarea name="noidungtuchoi" style="min-width:500px;min-height:200px" placeholder="Nguyên nhân từ chối" default=not null></textarea>
			</label>
			<input type="submit" class="btn btn-primary" value="Đồng ý" name="ok">
			<button class="btn btn-danger" onclick="history.go(-1);">Trở lại</button>
		</form>
	</div>
<?php
	}
?>