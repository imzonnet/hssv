Có <strong><?php echo $soluongyeucau; ?> </strong> yêu cầu được gởi lên từ sinh viên - 
<?php 
if($soluongyeucau <=0){
	echo "<a>Danh sách</a></br>";	
}
else{?>
	<a href="<?php echo base_url('canbo/yeucausinhvien');?>">Danh sách</a></br>
<?php } ?>
<!--  row 2 -->
Có <strong><?php echo $soluongphanhoi; ?> </strong>  - 
<?php if($soluongphanhoi <=0){
	echo "<a>trả lời</a></br>";
}
else{?>
	<a href="<?php echo base_url('canbo/sinhvientraloi');?>"> trả lời </a>đến từ sinh viên trong <?php echo '<strong>'.$soluongchudedcnoiden.'</strong>'; ?> <?php if($soluongchudedcnoiden<=0){echo "<a>bài viết</a>";} else{ ?>
		<a href="<?php echo base_url('canbo/chudedcnoiden');?>"> bài viết </a>
		<?php }?>được nói đến.
<?php } ?>



