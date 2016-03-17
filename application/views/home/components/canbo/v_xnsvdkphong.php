<?php 
	if(isset($mesage_susscess)){
		echo $mesage_susscess;?>
		</br><a href="<?php echo base_url()?>canbo/dsSvDkMotPhong/<?php echo $_POST['maphong']; ?>">Quay lại danh sách</a>
	<?php
	}
	else{
		echo $mesage_error;?>
		</br><a href="<?php echo base_url()?>canbo/dsSvDkMotPhong/<?php echo $_POST['maphong']; ?>">Quay lại danh sách</a>
		<?php
	}
 ?>