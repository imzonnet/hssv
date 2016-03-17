<?php
class mnoitru extends CI_Model{

	public function __construct(){
		parent::__construct();
	}
	/*************************************************************************************
                                        Noi Tru
	*************************************************************************************/
	/**
	 * Danh sach sinh vien noi tru
	 * 
	 **/
	public function dssvnoitru(){
		$matinh =48;
		$sql="select sinhvien.MaSV, sinhvien.HoTen,sinhvien.MaLop, phuong.TenPhuong, quan.TenQuan from sinhvien,phuong,quan,tinh where sinhvien.MaPhuong = phuong.MaPhuong and phuong.MaQuan = quan.MaQuan and quan.MaTinh = tinh.MaTinh and tinh.MaTinh='$matinh'";
		$query = $this->db->query($sql);
		if($query->result_array() >0 ){
			return $query->result_array();
		}
		return false;
	}

	public function timSvNoiTru($tc, $nd, $limit = false, $offset = 0){
		$matinh =48;
		$sql="select sinhvien.MaSV, sinhvien.HoTen,sinhvien.MaLop, phuong.TenPhuong, quan.TenQuan from sinhvien,phuong,quan,tinh where sinhvien.MaPhuong = phuong.MaPhuong and phuong.MaQuan = quan.MaQuan and quan.MaTinh = tinh.MaTinh and tinh.MaTinh='$matinh'";
		if($tc == 1) $sql .= " AND sinhvien.MaSV = '$nd'";
		else   $sql .= " AND sinhvien.HoTen Like '%$nd%'";
		$offset = $offset > 0 ? $offset : 0;
		if($limit) $sql .= " limit $offset,$limit";
		$rs = $this->db->query($sql);
		if($rs->num_rows()>0) return $rs->result_array();
		else return false;
	}
	 /**
	 * Tim kiem danh sach noi tru theo lop sinh hoạt
	 * 
	 */
	public function timKiemLopNoiTru($malop, $limit = false, $offset = 0)
	{
		$matinh =48;
		$sql="select sinhvien.MaSV, sinhvien.HoTen,sinhvien.MaLop, phuong.TenPhuong, quan.TenQuan from sinhvien,phuong,quan,tinh where sinhvien.MaPhuong = phuong.MaPhuong and phuong.MaQuan = quan.MaQuan and quan.MaTinh = tinh.MaTinh and tinh.MaTinh='$matinh' and sinhvien.MaLop ='$malop'";
		$offset = $offset > 0 ? $offset : 0;
		if($limit) $sql .= "limit $offset,$limit";
		$rs = $this->db->query($sql);
		if($rs->num_rows()>0) return $rs->result_array();
		else return false;
	}
	 /**
	 * sinh vien phan hoi
	 * 
	 */
	public function count_all_dsphanhoi(){
		$sql="select * from thongtinphanhoi where MaSoCha =0";
		$rs=$this->db->query($sql);
		$row= $rs->num_rows();
		if($row>0) return $row;
		else return false;
	}

	public function dsphanhoi($limit = false,$offset =0){
		$sql="select tt.MaSo,tt.TieuDe, tt.NoiDung,tt.NguoiGoi, tt.MaSoCha,tt.ThoiGianCapNhat,tt.TrangThai,sv.HoTen from thongtinphanhoi tt  join sinhvien sv on tt.NguoiGoi = sv.MaSV where tt.MaSoCha='0' order by ThoiGianCapNhat desc ";
		$offset = $offset > 0 ? $offset : 0;
		if($limit) $sql .= "limit $offset,$limit";
		$rs = $this->db->query($sql);
		if($rs->num_rows()>0) return $rs->result_array();
		else return false;
	}
	public function xemtinphanhoi($matin){
		$sql="select tt.MaSo,tt.TieuDe, tt.NoiDung,tt.NguoiGoi, tt.MaSoCha,tt.ThoiGianCapNhat,tt.TrangThai,sv.HoTen from thongtinphanhoi tt  join sinhvien sv on tt.NguoiGoi = sv.MaSV where tt.MaSo='$matin'";
		$rs= $this->db->query($sql);
		if($rs->num_rows()>0) return $rs->result_array();
		else return false;
	}
	public function traloiphanhoi($matin){
		$sql="select tt.MaSo,tt.TieuDe, tt.NoiDung,tt.NguoiGoi, tt.MaSoCha,tt.ThoiGianCapNhat,tt.TrangThai, cb.TenCB,sv.HoTen from thongtinphanhoi tt left join canbo cb on tt.NguoiGoi = cb.MaCB left join sinhvien sv on tt.NguoiGoi = sv.MaSV where tt.MaSoCha='$matin'";
		$rs= $this->db->query($sql);
		if($rs->num_rows()>0) return $rs->result_array();
		else return false;
	}
	public function updatephanhoi($tieude,$noidung,$nguoigoi,$parentid,$timeupdate){
		$data = array(
			'TieuDe' => $tieude,
			'NoiDung' => $noidung,
			'NguoiGoi' => $nguoigoi,
			'MaSoCha' => $parentid,
			'ThoiGianCapNhat' => $timeupdate,
		);
		$this->db->insert('thongtinphanhoi',$data);
	}
	public function insertphanhoi($tieude,$noidung,$nguoigoi){
		$ngayinsert = $this->my_auth->setDate();
		$data = array(
			'TieuDe' => $tieude,
			'NoiDung' => $noidung,
			'NguoiGoi' => $nguoigoi,
			'MaSoCha' =>'null',
			'ThoiGianCapNhat' => $ngayinsert
		);
		$this->db->insert('thongtinphanhoi',$data);
	}

	public function gioihansltincuasinhvien($masv){
		$this->db->where('NguoiGoi',$masv);
		$this->db->where('MaSoCha',0);
		$this->db->where('TrangThai',0);
		$rs=$this->db->get('thongtinphanhoi');
		$row= $rs->num_rows();
		if($row<3) return false;
		else return true;
		
	}
	public function capnhatblsinhvien(){
		
	}
	public function gioihanslblcuasinhvien($masv,$matin){
		$sql="select * from thongtinphanhoi where NguoiGoi='$masv' and MaSoCha='$matin' and TrangThai=0";
		$rs=$this->db->query($sql);
		$row= $rs->num_rows();
		if($row< 5) return false;
		else return true;
	}
	public function count_all_phanhoi_sinhvien($masv){
		$this->db->where('NguoiGoi',$masv);
		$rs=$this->db->get('thongtinphanhoi');
		return $rs->num_rows();
	}
	public function phanhoicuasinhvien($limit = false, $offset=0,$masv){
		$sql="select * from thongtinphanhoi where NguoiGoi= $masv ";
		$offset = $offset > 0 ? $offset : 0;
		if($limit) $sql .= "limit $offset,$limit";
		$rs = $this->db->query($sql);
		if($rs->num_rows()>0) return $rs->result_array();
		else return false;
	}
	 /**
	 * Can bo phan hoi
	 * 
	 */
	public function soluongyeucau(){
	 	$this->db->where('MaSoCha','0');
	 	$this->db->where('TrangThai','0');
	 	$rs=$this->db->get('thongtinphanhoi');
	 	return $rs->num_rows();
	 }
	public function soluongphanhoi(){
		$this->db->where('MaSoCha !=','0');
	 	$this->db->where('TrangThai','0');
	 	$rs=$this->db->get('thongtinphanhoi');
	 	return $rs->num_rows();	
	}
	public function danhsachyeucau($limit = false,$offset =0){
	 	$sql="select * from thongtinphanhoi where MaSoCha =0 and TrangThai =0 ";
		$offset = $offset > 0 ? $offset : 0;
		if($limit) $sql .= "limit $offset,$limit";
		$rs = $this->db->query($sql);
		if($rs->num_rows()>0) return $rs->result_array();
		else return false;
	}
	public function cbphanhoi($tieude,$noidung,$nguoigoi,$parentid){
		$ngayinsert = $this->my_auth->setDate();
		$data = array(
			'TieuDe' => $tieude,
			'NoiDung' => $noidung,
			'NguoiGoi' => $nguoigoi,
			'MaSoCha' => $parentid,
			'ThoiGianCapNhat' => $ngayinsert,
		);
		$this->db->insert('thongtinphanhoi',$data);
	}
	public function updatematin($matin){
		$data = array(
			'TrangThai' => '1'
		);
		$this->db->where('MaSo',$matin);
		$this->db->update('thongtinphanhoi',$data);
	}
	public function danhsachsinhvientraloi($limit = false,$offset =0){
		$sql="select * from thongtinphanhoi where MaSoCha!=0 and TrangThai =0 ";
		$offset = $offset > 0 ? $offset : 0;
		if($limit) $sql .= "limit $offset,$limit";
		$rs = $this->db->query($sql);
		if($rs->num_rows()>0) return $rs->result_array();
		else return false;
	}
	public function soluongchudedcnoiden(){
		$sql="select TieuDe from thongtinphanhoi  where MaSoCha !=0 and TrangThai=0 group by MaSoCha ";
		$rs=$this->db->query($sql);
		return $rs->num_rows();
	}
	public function chudedcnoiden($limit = false,$offset =0){
		$sql="select * from thongtinphanhoi  where MaSoCha =0 group by MaSoCha ";
		$offset = $offset > 0 ? $offset : 0;
		if($limit) $sql .= "limit $offset,$limit";
		$rs = $this->db->query($sql);
		if($rs->num_rows()>0) return $rs->result_array();
		else return false;
	}
}