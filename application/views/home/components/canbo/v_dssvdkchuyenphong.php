<?php
if(isset($tuchoichuyenphong)){
	echo $tuchoichuyenphong.'</br>';
	?><a href="<?php echo base_url('canbo/dsdkchuyenphong');?>">Quay lại danh sách</a>
	<?php
}
elseif(isset($mesage_susscess)){
	echo $mesage_susscess.'</br>';
	?><a href="<?php echo base_url('canbo/dsdkchuyenphong');?>">Quay lại danh sách</a>
	<?php
}
elseif(isset($mesage_error)){
	echo $mesage_error.'</br>';
	?><a href="<?php echo base_url('canbo/dsdkchuyenphong');?>">Quay lại danh sách</a>
	<?php
	}
	elseif($danhsach == false){
		echo "Không có sinh viên đăng ký chuyển phòng";
	}
		else{
		?>
		<table class="table table-bordered table-hover table-striped">
		    <thead>
		        <tr>
		            <th>STT</th>
		            <th>Mã SV</th>
		            <th>Mã Phòng</th>
		            <th>Thời gian ĐK</th>
		            <th>Chuyển phòng</th>
		            <th>Xác Nhận</th>
		            <th>Từ Chối</th>
		        </tr>
		    </thead>
		    	<tbody>
		        	<?php
		        	$i = 1;
		        	foreach($danhsach as $v){
			    ?>
			        <tr>
			            <td><?php echo $i; ?></td>
			            <td><?php echo $v['MaSV']; ?></td>
			            <td><?php echo $v['MaPhong']; ?></td>
			            <td><?php echo $v['NgayDK']; ?></td>
			            <td><?php 
			            	$arr= explode(':',$v['GhiChu']); 
			            	echo $arr[1];
			            	?>
			            </td>
			            <td><a href="<?php echo base_url('canbo/xnsvchuyenphong').'/'.$v['Id'].'/'.$v['MaPhong'].'/'.$arr[1].'/'.$v['MaSV'].'/'.$v['MaHK'].'/'.$v['NgayDK'].'/'.$cb_id; ?>">Xác Nhận</a></td>
			            <td><a href="<?php echo base_url('canbo/tuchoisvchuyenphong').'/'.$v['Id'];?>">Từ Chối</a></td>
			        </tr>
			    <?php
			            $i++;
			        }
			    ?>
			</tbody>
		</table>
		<?php	
	}
?>