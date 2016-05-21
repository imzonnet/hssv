<?php
if($mg_error == true){
	echo "Phòng không có sinh viên đăng ký</br>"; ?>
	<a class="btn btn-danger" href="<?php echo base_url().'canbo/timkiemsvnhanh'; ?>">Trở lại</a>
<?php 	
}
else{ ?>

<table class="table table-bordered table-hover table-striped">
    <thead>
    	<tr>
    		<th>Mã Phòng: <?php echo $maphong; ?></th>
    	</tr>
        <tr>
            <th>STT</th>
            <th>Mã sinh viên</th>
            <th>Mã học kỳ</th>
            <th>Ngày đăng ký</th>
            <th>Ngày xác nhận</th>
            <th>Trạng Thái</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $i = 1;
        foreach($kqtk as $k => $v){
    ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $v['MaSV']; ?></td>
            <td><?php echo $v['MaHK']; ?></td>
            <td><?php echo $v['NgayDK']; ?></td>
            <td><?php echo $v['NgayXN']; ?></td>
            <td>
            	<?php 
            		if($v['TrangThai']=="chuaxn"){ ?>
            			<a class="btn btn-primary" href="<?php echo base_url('canbo/svDkPhong/'.$kqtk[0]['Id'].'/'.$kqtk[0]['MaPhong'].'/'.$kqtk[0]['MaSV']);?>">Xác nhận</a>

            		<?php }
            		else{
            			$str = $v['GhiChu'];
            			$sub = substr($str,0, 9);

            			if($sub == "chochuyen"){ 
            				$arr = explode(":", $v['GhiChu']);
            				$maphongchuyen = $arr[1];
            				?>
            				
            				<a class="btn btn-primary" href="<?php echo base_url('canbo/svdkchuyenphong/'.$v['MaSV'].'/'.$v['MaPhong'].'/'.$v['NgayDK']).'/'.$maphongchuyen.'/'.$v['Id'].'/'.$v['MaHK'].'/'.$cb_id;?>">Chuyển phòng</a>
            			<?php }
            			else{
            				echo "Đã xác nhận";	
            			}
            		}
            		// echo $v['GhiChu']; 
            	?>
            	
            </td>
        </tr>
    <?php
            $i++;
        }
    ?>
    </tbody>
</table>
<a class="btn btn-danger" href="<?php echo base_url().'canbo/timkiemsvnhanh'; ?>">Trở lại</a>
<?php } ?>
