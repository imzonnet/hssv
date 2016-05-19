<table class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th>Mã SV</th>
            <th>Mã Phòng</th>
            <th>Thời gian ĐK</th>
            <th>Chuyển phòng</th>
            <th>Xác Nhận</th>
            <th>Từ Chối</th>
        </tr>
    </thead>
	<tbody>
		<tr>
			<td><?php echo $masv; ?></td>
			<td><?php echo $maphong; ?></td>
			<td><?php echo $ngaydk; ?></td>
			<td><?php echo $chuyenphong; ?></td>
			<td><a href="<?php echo base_url('canbo/xnsvchuyenphong').'/'.$id.'/'.$maphong.'/'.$chuyenphong.'/'.$masv.'/'.$mahk.'/'.$ngaydk.'/'.$macb; ?>">Xác Nhận</a></td>
	    	<td><a href="<?php echo base_url('canbo/tuchoisvchuyenphong').'/'.$maphong;?>">Từ Chối</a></td>
		</tr>
	</tbody>
</table>