<?php
if($dsphanhoi == false){
	echo "Bạn chưa đăng phản hồi nào</br></br>";
?>
<a href="<?php echo base_url('sinhvien/dangtinphanhoi'); ?>" class="btn btn-primary">Thêm phản hồi</a>	
<hr>
<?php	
}
else{
	foreach ($dsphanhoi as $k => $v) { ?>
		<div class="studentFeedBack">
			<p class="highlight_text"><?php echo $v['TieuDe']; ?></p>
			<p><?php echo ($v['NoiDung']); ?> </p>
			<p class="feedback_time"><?php echo 'Cập nhật: '.$v['ThoiGianCapNhat'] ?></p>
		</div> 

<?php } ?>
<a href="<?php echo base_url('sinhvien/dangtinphanhoi'); ?>" class="btn btn-primary">Thêm phản hồi</a>	
	<div class="pagination">
		    <?php echo $page_link; ?>
	</div>
<?php

}
?>