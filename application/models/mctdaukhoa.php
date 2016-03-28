<?php
class mctdaukhoa extends CI_Model{
	public function __construct(){
		parent::__construct();
	}

	public function addchinhtridaukhoa($masv,$hoten,$ngaysinh,$nganh,$diem,$lop){
		$data = array(
			'MaSV' =>$masv,
			'HoTen' =>$hoten,
			'NgaySinh' =>$ngaysinh,
			'Nganh' =>$nganh,
			'Diem' =>$diem,
			'Lop' =>$lop,
		);
		$this->db->update('chinhtridaukhoa',$data);
	}

}
?>