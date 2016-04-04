<?php
class mctdaukhoa extends CI_Model{
	public function __construct(){
		parent::__construct();
	}

	public function addchinhtridaukhoa($masv,$bienlaiso,$hoten,$ngaysinh,$nganh,$diem,$lop){
		$data = array(
			'MaSV' =>$masv,
			'BienLaiSo' =>$bienlaiso,
			'HoTen' =>$hoten,
			'NgaySinh' =>$ngaysinh,
			'Nganh' =>$nganh,
			'Diem' =>$diem,
			'Lop' =>$lop,
		);
		$this->db->insert('chinhtridaukhoa',$data);
	}
	public function checkchinhtridaukhoa($bienlaiso){
		$query  = $this->db->get_where('chinhtridaukhoa',array('BienLaiSo' => $bienlaiso));
		if($query->num_rows()>0)
			return true;
		else
			return false;
	}
	public function updatechinhtridaukhoa($mabienlai,$diem){
		$data = array(
			'Diem' => $diem
		);
		$this->db->where('BienLaiSo',$mabienlai);
		$this->db->update('chinhtridaukhoa',$data);
	}
	public function laydslopchinhtri(){
		$this->db->distinct();
		$this->db->select('Lop');
		$rs = $this->db->get('chinhtridaukhoa');
		if($rs->num_rows()>0){
			return $rs->result_array();
		}
		return false;
	}
	public function timdsdiemchinhtritheolop($malop){
		$this->db->where('Lop',$malop);
		$rs = $this->db->get('chinhtridaukhoa');
		if($rs->num_rows()>0)
			return $rs->result_array();
		else
			return false;
	}
	public function timdiemchinhtritheomasv($masv){
		$this->db->where('MaSV',$masv);
		$rs = $this->db->get('chinhtridaukhoa');
		if($rs->num_rows()>0)
			return $rs->result_array();
		else
			return false;	
	}
	public function thongkediemctdk($limit = false,$offset =0){
		$sql="select * from chinhtridaukhoa ";
		$offset = $offset > 0 ? $offset : 0;
		if($limit) $sql .= "limit $offset,$limit";
		$rs = $this->db->query($sql);
		if($rs->num_rows()>0) return $rs->result_array();
		else return false;
	}
	public function laythongkediemctdk(){
		$rs=$this->db->get('chinhtridaukhoa');
		if($rs->num_rows()>0) return $rs->result_array();
		else return false;
	}
	public function all_count_table_chinhtri(){
		$rs=$this->db->get('chinhtridaukhoa');
		return $rs->num_rows();
	}
}
?>