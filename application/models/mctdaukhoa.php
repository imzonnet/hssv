<?php
class mctdaukhoa extends CI_Model{
	private $tb;
	public function __construct(){
		parent::__construct();
		$this->tb = 'diemchinhtri';
	}

	public function addchinhtridaukhoa($masv,$bienlaiso,$diem,$lop){
		$data = array(
			'MaSV' =>$masv,
			'BienLaiSo' =>$bienlaiso,
			'Diem' =>$diem,
			'LopCT' =>$lop,
		);
		$this->db->insert($this->tb,$data);
	}
	public function checkchinhtridaukhoa($bienlaiso){
		$query  = $this->db->get_where($this->tb,array('BienLaiSo' => $bienlaiso));
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
		$this->db->update($this->tb,$data);
	}
	public function laydslopchinhtri(){
		$this->db->distinct();
		$this->db->select('LopCT');
		$rs = $this->db->get($this->tb);
		if($rs->num_rows()>0){
			return $rs->result_array();
		}
		return false;
	}
	public function timdsdiemchinhtritheolop($malop){
		$rs = $this->db->query("SELECT sv.MaSV, sv.HoTen, sv.NgaySinh, dct.LopCT, dct.Diem, dct.BienLaiSo, ng.TenNganh
					FROM sinhvien AS sv , diemchinhtri AS dct, nganh AS ng ,lop
					WHERE sv.MaSV = dct.MaSV AND sv.MaLop = lop.MaLop AND lop.MaNganh = ng.MaNganh AND dct.LopCT = '{$malop}'");
		if($rs->num_rows()>0)
			return $rs->result_array();
		else
			return false;
	}
	public function timdiemchinhtritheomasv($masv){
		$rs = $this->db->query("SELECT sv.MaSV, sv.HoTen, sv.NgaySinh, dct.LopCT, dct.Diem, dct.BienLaiSo, ng.TenNganh
					FROM sinhvien AS sv , diemchinhtri AS dct, nganh AS ng ,lop
					WHERE sv.MaSV = dct.MaSV AND sv.MaLop = lop.MaLop AND lop.MaNganh = ng.MaNganh AND dct.MaSV = '{$masv}'");
		if($rs->num_rows()>0)
			return $rs->result_array();
		else
			return false;	
	}
	public function thongkediemctdk($limit = false,$offset =0){
		$sql="select * from {$this->tb} ";
		$offset = $offset > 0 ? $offset : 0;
		if($limit) $sql .= "limit $offset,$limit";
		$rs = $this->db->query($sql);
		if($rs->num_rows()>0) return $rs->result_array();
		else return false;
	}
	public function laythongkediemctdk(){
		$rs=$this->db->get($this->tb);
		if($rs->num_rows()>0) return $rs->result_array();
		else return false;
	}
	public function all_count_table_chinhtri(){
		$rs=$this->db->get($this->tb);
		return $rs->num_rows();
	}
}