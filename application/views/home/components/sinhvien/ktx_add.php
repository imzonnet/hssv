<?php
if(isset($message_daxn)){
	echo"<div class='span12'><p>".$message_daxn."</p></div>";
?>
	<table class="table table-bordered table-hover table-striped">
		<thead>
		    <tr>
		        <th>Mã phòng</th>
		        <th>Học Kỳ</th>
		        <th>Ngày Đk</th>
		        <th>Ngày Xác Nhận</th>
		        <th>Ghi chú</th>
		    </tr>
		</thead>
		<tbody>
		<?php
		    foreach($data as $k){
		?>
		    <tr>
		        <td><?php echo $k['MaPhong']; ?></td>
		        <td><?php echo $k['MaHK']; ?></td>
		        <td><?php echo $k['NgayDK']; ?></td>
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
		    }
		?>
		</tbody>
	</table>
<?php
}
elseif(isset($message_chuaxn)){
	echo"<div class='span12'><p>".$message_chuaxn."</p></div>";
?>
	</br><p>Bạn có thể nhấn để <a href="<?php echo base_url('sinhvien/svHuyDkPhong')?>">hủy đăng ký phòng</a></p>
<?php
}
	else{
	
	?>
	
	<!-- Tình trạng đăng ký phòng ký túc xá -->
	<div class="span12">
		<h5>Tình trạng đăng ký phòng ký túc xá</h5>
		<table class="table table-bordered table-hover table-striped">
		    <thead>
		        <tr>
		            <th>Mã phòng</th>
		            <th>Loại phòng</th>
		            <th>Số lượng</th>
		            <th>Hiện đang ở</th>
		            <th>Đang đăng ký</th>
		            <th>Đăng ký</th>
		        </tr>
		    </thead>
		    <tbody>
		    <?php
		        foreach($dsphong as $k){
		    ?>
		        <tr>
		            <td><?php echo $k['MaPhong']; ?></td>
		            <td><?php 
		                      if($k['LoaiPhong']==1)
		                                echo "Nam"; 
		                            else
		                                echo "Nữ";
		                        ?>
		        </td>
		            <td><?php echo $k['SoLuong']; ?></td>
		            <td><?php echo $k['HienDangO']; ?></td>
		            <td><?php echo $k['SoLuongDK']; ?></td>
		            <td>
		            <?php
		            	if($k['LoaiPhong'] == $sex[0]['GioiTinh'] && $k['slot'] > 0){ ?>
		            		<a href="<?php echo base_url('sinhvien/svDkPhong').'/'.$k['MaPhong']; ?>"  id="<?php echo $k['MaPhong']; ?>">Đăng ký</a></td><?php
		            	}
		                               
		            ?>
		            </td>
		        </tr>
		    <?php
		        }
		    ?>
		    </tbody>
		</table>
	</div>	
	<!-- end Tình trạng đăng ký phòng ký túc xá -->
	<!-- luu y -->
	<div class="span12">
		<p><i class="icon-star-empty"></i><strong>Sinh viên lưu ý:</strong> Mã phòng gồm 3 chữ số, chữ số đầu tiên là tầng và 2 số sau là phòng.</p>
	</div>
	<!-- end luu y -->
	<!-- Select box phong duoc dang ky -->
	
	
	<?php
	} 

?>