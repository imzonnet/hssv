<?php
	if(isset($mg_errror)){
		echo "Không tìm thấy sinh viên</br>"; ?>
		<a class="btn btn-danger" href="<?php echo base_url().'canbo/timkiemsvnhanh'; ?>">Trở lại</a>
	<?php
	}
	else{ ?>

	
	<table class="table table-bordered table-hover table-striped">
		<tr>
			<th>Mã sinh viên</th>
			<th>Mã phòng</th>
			<th>Mã học kỳ</th>
			<th>Ngày đăng ký</th>
			<th>Xác nhận</th>
		</tr>
		<tr>
			<td><?php echo $kqtk[0]['MaSV']; ?></td>
			<td><?php echo $kqtk[0]['MaPhong']; ?></td>
			<td><?php echo $kqtk[0]['MaHK']; ?></td>
			<td><?php echo $kqtk[0]['NgayDK']; ?></td>
			<td>
				<?php 
				if($status == 0){
					echo "Đã xác nhận";
				}
				else{
					if($status == 1){ ?>
						<a class="btn btn-primary" href="<?php echo base_url('canbo/svDkPhong/'.$kqtk[0]['Id'].'/'.$kqtk[0]['MaPhong'].'/'.$kqtk[0]['MaSV']);?>">Xác nhận</a>	
				<?php
					}
					if($status == -1){ ?>
						<a class="btn btn-primary" href="<?php echo base_url('canbo/svdkchuyenphong/'.$kqtk[0]['MaSV'].'/'.$kqtk[0]['MaPhong'].'/'.$kqtk[0]['NgayDK']).'/'.$maphongchuyen.'/'.$kqtk[0]['Id'].'/'.$kqtk[0]['MaHK'].'/'.$cb_id;?>">Chuyển phòng</a>
					<?php 
					}
				} 
				?>
				
			</td>
		</tr>
	</table>
	<a class="btn btn-danger" href="<?php echo base_url().'canbo/timkiemsvnhanh'; ?>">Trở lại</a>
	<?php } ?>