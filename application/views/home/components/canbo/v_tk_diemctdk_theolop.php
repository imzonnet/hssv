<?php 
if($danhsach ==false){ ?>
	<div class="alert">
	    <strong>Không tìm thấy kết quả tìm kiếm cho mã lớp: <?php  echo $malop; ?></strong><br /> 
	</div>
<?php
}
else{?>
<div class="alert">
    <strong>Kết quả tìm kiếm theo mã lớp: <?php  echo $malop; ?></strong><br /> 
</div>
<table class="table table-bordered table-striped ngoaitru">
        	<tr>
	            <th>STT</th>
	            <th>Mã Sinh Viên</th>
	            <th>Họ Tên</th>
	            <th>Ngày Sinh</th>
	            <th>Ngành</th>
	            <th>Ngày 1</th>
	            <th>Ngày 2</th>
	            <th>Ngày 3</th>
	            <th>Ngày 4</th>
	            <th>Ngày 5</th>
	            <th>Ngày 6</th>
       	</tr>
    	<?php
        	$i = 1;
        	foreach($danhsach as $v) {
    	?>
            <tr>
	            <td><?php echo $i; ?></td>
	            <td><?php echo $v['MaSV']; ?></td>
	            <td><?php echo $v['HoTen']; ?></td>
	            <td><?php echo $v['NgaySinh']; ?></td>
	            <td><?php echo $v['Nganh']; ?></td>
                	<?php 
                		$a[] = array ();
			$a = json_decode ($v['Diem'],true);
		?>
	            <td><?php echo $a['ngay1']; ?></td>
	            <td><?php echo $a['ngay2']; ?></td>
	            <td><?php echo $a['ngay3']; ?></td>
	            <td><?php echo $a['ngay4']; ?></td>
	            <td><?php echo $a['ngay5']; ?></td>
	            <td><?php echo $a['ngay6']; ?></td>
            </tr>
    	<?php ++$i; 
    	} ?>
</table>

<?php } ?>