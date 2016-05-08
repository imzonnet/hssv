<?php
	if(isset($error)) echo $error;
	else{?>
		<h4><?php echo $nd['TieuDe']; ?></h4>
		<p><?php echo $nd['NoiDung']; ?></p>
		<p><?php echo 'Người gởi: '.$nd['TenCb'].'  Ngày đăng: '.$nd['NgayDangTin']; ?></p>
		<hr>
		<?php
			for($i = 1; $i<=20; $i++){?>
				<i>-</i> <a href='<?php echo base_url('canbo/xemtintuyendung').'/'.$dst[$i]['MaSo'];?>' ><?php echo $dst[$i]['TieuDe']; ?></a></br>
			<?php }
			
		?>
		<hr>
	<?php } 
	?>
