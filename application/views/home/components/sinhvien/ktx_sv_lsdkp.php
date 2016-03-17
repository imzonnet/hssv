<?php
if($data == 0){
	echo "Bạn chưa đăng ký phòng.";
}
else{
?>
	<div class="span12">
	<table class="table table-bordered table-hover table-striped">
		<thead>
		    <tr>
		    	<th>STT</th>
		        	<th>Mã phòng</th>
		        	<th>Học Kỳ</th>
		        	<th>Ngày Đk</th>
		        	<th>Trạng Thái</th>
		        	<th>Ngày Xác Nhận</th>
		        	<th>Ghi Chú</th>
		    </tr>
		</thead>
		<tbody>
		<?php
			$i=1;
		   	foreach($data as $k){
		?>
		    <tr>
		    	<td><?php echo $i; ?></td>
		        	<td><?php echo $k['MaPhong']; ?></td>
		        	<td><?php echo $k['MaHK']; ?></td>
		        	<td><?php echo $k['NgayDK']; ?></td>
		        	<td><?php
		        		switch($k['TrangThai']){
		        			case 'chuaxn':
		        				echo "Chưa Xác Nhận";
		        				break;
		        			case 'daxn':
		        				echo "Đã Xác Nhận";
		        				break;
		        			case 'tuchoi':
		        				echo "Bị từ chối";
		        				break;
		        			case 'dachuyen':
		        				echo "Chuyển phòng";
		        				break;

		        		}
		        		?>
		        	</td>
		        	<td><?php echo $k['NgayXN']; ?></td>
		        	<td><?php
		        		$arr=explode(':',$k['GhiChu']);
		        		if($arr[0] =='chochuyen'){
		        			echo 'Chờ xác nhận chuyển phòng: '.$arr[1];
		        		}
		        		else{
		        			if($arr[0] == 'dachuyen'){
		        				echo 'Đã chuyển';
		        			}
		        			else
		        				echo $k['GhiChu'];
		        		}
		        	 	?>
		        	 </td>
		    </tr>
		<?php
			$i++;
		    }
		?>
		</tbody>
	</table>
</div>
<?php
}
?>