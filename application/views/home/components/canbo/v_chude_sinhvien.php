<div class="span12">
	<div class="control-group">
		<table class="table table-bordered table-hover table-striped">
		    <thead>
		        <tr>
		            <th>Mã Số</th>
		            <th>Tiêu Đề</th>
		            <th>Người Gởi</th>
		            <th>Thời gian đăng tin</th>
		            <th>Xem</th>
		        </tr>
		    </thead>
		    <tbody>
	        <?php
	        foreach($danhsachchude as $k ){
		    ?>
		        <tr>
		            <td><?php echo $k['MaSo']; ?></td>
		            <td><?php echo $k['TieuDe']; ?></td>
		            <td><?php echo $k['NguoiGoi']; ?></td>
		            <td><?php echo $k['ThoiGianCapNhat']; ?></td>
		            <td>	<a href="<?php echo base_url('canbo/xemyeucausinhvien').'/'.$k['MaSo']; ?>">Xem</a></td>
		        </tr>
		    <?php
		        }
		    ?>
		    </tbody>
		</table>
		<a class="btn btn-info" href="<?php echo base_url('canbo/phanhoisinhvien');?>">Trở lại phản hồi sinh viên</a>
		<div class="pagination">
		    <?php echo $page_link; ?>
		</div>
	</div>
	
</div>