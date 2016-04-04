<?php
	if(isset($error)) echo $error;
	else{?>
		<h4><?php echo $nd[0]['TieuDe']; ?></h4>
		<p><?php echo $nd[0]['NoiDung']; ?></p>
		<p><?php echo 'Người gởi: '.$nd[0]['TenCb'].'  Ngày đăng: '.$nd[0]['NgayDangTin']; ?></p>
		<hr>
		<?php
			for($i = 1; $i<=20; $i++){?>
				<i>-</i> <a href='<?php echo base_url('canbo/xemtintuyendung').'/'.$dst[$i]['MaSo'];?>' ><?php echo $dst[$i]['TieuDe']; ?></a></br>
			<?php }
			
		?>
		<hr>
	<?php } 
	?>
