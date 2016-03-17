<?php 
if(isset($mesage)){
	switch ($mesage) {
		case 'chuadkphong':
			echo "Bạn không đủ điều kiện để thực hiện thao tác này";
			break;
		case 'dadkchuyen':
			echo "Bạn đã đăng ký chuyển phòng!";
			break;
		case 'chuyenthanhcong':
			echo "Bạn đã đăng ký chuyển phòng thành công, vui lòng đợi cán bộ phê duyệt!";
			break;
		case 'chuyenthatbai':
			echo "Đăng ký chuyển phòng thất bại, vui lòng thử lại!";
			break;
		
	}
}
else{
?>
	<div class="span7">
		<div class="control-group">
			<input type="hidden" id="maphongdango" value="<?php echo $maphong[0]['MaPhong']; ?>">
		        	<label class="control-label" for="phong">Chọn phòng cần chuyển:</label>

		        	<div class="controls">
		        	
			            <select name="phong">
				          <?php 
					foreach ($dsphong as $key => $v) {
						echo '<option name="code" >'.$v['MaPhong'].'</option>';
					}
				          ?>	
				</select>
		       	 </div>
			<div class="control-group">
				<div class="controls">
					<a href="<?php echo base_url('sinhvien/chuyenPhong'); ?>" class="btn btn-primary" id="code">Xác Nhận</a>
			    		<a href="sinhvien" class="btn btn-inverse">Hủy bỏ</a>
				</div>
			</div>
	    	</div>
	</div>
	<script type="text/javascript" charset="utf-8" async defer>
		$(document).ready(function(){
			$("#code").click(function(){
				var iscode = $("option:selected").val();
				var maphongdango = $("#maphongdango").val();
				if(iscode == maphongdango){
					alert('Bạn đã chọn phòng mình đang ở');
				}
				else{
					$("#code").attr("href", "<?php echo base_url('sinhvien/dkChuyenPhong').'/'; ?>"+iscode);
				}
			});
    		});
	</script>
<?php	
}	
?>