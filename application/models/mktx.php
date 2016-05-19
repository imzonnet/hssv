<?php
class Mktx extends CI_Model{
	public function __construct(){
	        parent::__construct();
	}
	public function dsDkPhong($number,$offset){
	    	$query = $this->db->get_where('sinhvien_phong',array('TrangThai' => 'chuaxn' ), $number, $offset);
	    	if($query->num_rows()>0){
	    		return $query->result_array();	
	    	}
	        	else
	        		return false;
	}

	public function thongtinsv($id){

	    $this->db->select("MaSV,HoTen,NgaySinh,CMND,MaLop,KhoaHoc");
		$this->db->where("MaSV",$id);
		$query=$this->db->get("sinhvien");
		return $query->result_array();
	}
	
	// Xác nhận sinh viên đăng ký phòng
	public function XnDkPhong($cb_id,$id,$ghichu){
	    	$ngayxn = $this->my_auth->setDate();
	    	$data = array(
	    		'TrangThai' =>'daxn',
	    		'NgayXN' => $ngayxn,
	    		'NguoiXN' => $cb_id,
	    		'GhiChu' =>$ghichu
	    	);
	    	$this->db->where('id',$id);
	    	$this->db->update('sinhvien_phong',$data);
	    	if($this->db->affected_rows()>0)
	    		return true;
	    	return false;
	}
	
	public function soLuongDkMotPhong($maphong){
	    	$sql="SELECT count(MaPhong) from sinhvien_phong where MaPhong = $maphong";
	    	$query = $this->db->query($sql);
	    	return $query;
	}

	public function layMaHk(){
		$sql="SELECT max(id),MaHK FROM hocky";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $key =>$v){
			return $v['MaHK'];
		}
	}
	// Cập nhật số lượng hiện đang ở
	public function updateSlSvOPhong($maphong,$trangthai){
		$this->db->select("SoLuong,HienDangO");
		$query =$this->db->get_where('ktx_phong',array('MaPhong' => $maphong));
		$rs = $query->result_array();
		if(isset($trangthai)){
			if($trangthai=='tang'){
				if($rs[0]['SoLuong']>$rs[0]['HienDangO'] && $rs[0]['HienDangO'] >=0 ){
					$sql="update ktx_phong set HienDangO=HienDangO +1 where MaPhong=$maphong";
					$query=$this->db->query($sql);
					return true;
				}		
			}
			elseif($trangthai='giam'){
				if($rs[0]['SoLuong']>=$rs[0]['HienDangO'] && $rs[0]['HienDangO'] >0 ){
					$sql="update ktx_phong set HienDangO=HienDangO - 1 where MaPhong=$maphong";
					$query=$this->db->query($sql);
					return true;
				}
			}
		}
		return false;
	}
     	
	public function count_all(){
		$this->db->like('TrangThai','chuaxn');
		$this->db->from('sinhvien_phong');
    		return $this->db->count_all_results(); 
	}
	// đếm tất cả record chưa xác nhận của 1 phòng
	public function count_all_table($maphong){
		$this->db->like('TrangThai','chuaxn');
		$this->db->from('sinhvien_phong');
		$this->db->where('MaPhong',$maphong);
    		return $this->db->count_all_results(); 
	}
	//lay thong tin tat ca cac phong
	public function getKtxPhong(){
		$data = array();
		$query=$this->db->get('ktx_phong');
		foreach($query->result_array() as $k => $v ) {
			$data[$k] = $v;
			$data[$k]['SoLuongDK'] = $this->demSoSvDKPhong($v['MaPhong']);
		}
		return $data;
	}
	// tim sinh vien o ktx theo masv
	public function find_data_MaSV($masv){
		$data = array(
			'MaSV' => $masv,
			'TrangThai' =>'daxn',
			'TrangThai' =>'chuaxn'
		);
		$sql = "select * from sinhvien_phong where MaSV=$masv and TrangThai = 'daxn' or MaSV=$masv and TrangThai='chuaxn'";
		$query= $this->db->query($sql);
	    if($query->num_rows()>0){
	    	return $query->result_array();	
	    }
	    else
	    	return false;
	}
	public function getMaphong(){
		$this->db->select('MaPhong');
		$query = $this->db->get('ktx_phong');
		if($query->num_rows()>0)
			return $query->result_array();
		else
			return false;
	}
	// lấy thông tin cac sinh viên trong một phòng
	public function getDsSvOMotPhong($maphong){
		$this->db->select("sinhvien.MaSV,HoTen,NgaySinh,GioiTinh,MaLop,KhoaHoc, NgayDK");
		$this->db->from('sinhvien');
		$this->db->join('sinhvien_phong','sinhvien.MaSV = sinhvien_phong.MaSV');
		$this->db->where('sinhvien_phong.MaPhong',$maphong);
		$this->db->where('sinhvien_phong.TrangThai','daxn');
		$query =$this->db->get();
		return $query ->result_array();
	}
	// xem danh sách sinh viên đang đăng ký 1 phòng
	public function getDsSvDkMotPhong($number,$offset,$maphong){
	        	if(!$offset){
	        		$offset= 0;
	        	}
	        	$sql="select Id, MaSV,MaHK,NgayDK from sinhvien_phong where MaPhong=$maphong and TrangThai ='chuaxn' limit $offset,$number";
	        	$query= $this->db->query($sql);
	        	if($query->num_rows()>0){
	    		return $query->result_array();	
	    	}
	        	else
	        		return false;
	        	
	}

	public function demSoSvDKPhong($maphong) {
		$query =$this->db->query("Select count(Id) as SoLuong from sinhvien_phong where MaPhong={$maphong} and TrangThai ='chuaxn'");
		if( $query->num_rows() > 0 ) {
			$row = $query->row();
			return $row->SoLuong;
		}
		return 0;
	}
	public function ftuChoiSvDkPhong($cb_id,$id,$noidung){
		$data = array(
			'NguoiXN' =>$cb_id,
			'TrangThai' =>'tuchoi',
			'GhiChu' =>$noidung,
			'NgayXN'=> $this->my_auth->setDate(),
		);
		$this->db->where("Id",$id);
		$this->db->update("sinhvien_phong",$data);
	}
	// lấy danh sách sinh viên đăng ký chuyển phòng
	 public function layDsSvDkChuyenPhong(){
	 	$sql="SELECT Id,MaSV,MaPhong,MaHK,NgayDK,GhiChu FROM `sinhvien_phong` WHERE TrangThai='daxn' and GhiChu like '%chochuyen%'";
	 	$query=$this->db->query($sql);
	 	if($query->num_rows>0){
	 		return $query->result_array();
	 	}
	 	else
	 		return false;
	 }
	 // Cập nhật trạng thái phòng cũ khi xác nhận sinh viên chuyển phòng
	 public function capnhattrangthaiphongcu($id,$maphongmoi){
	 	$data = array(
	 		'TrangThai'=>'dachuyen',
	 		'GhiChu' =>'dachuyen:'.$maphongmoi,
	 		);
	 	$this->db->where('Id',$id);
	 	$this->db->update('sinhvien_phong',$data);
	 	return true;
	 }
	 // xác nhận sinh viên chuyển phòng
	 public function xnsvdkchuyenphong($id,$maphongcu,$maphongmoi,$masv,$mahk,$ngaydk,$macb){
	 	$a=$this->updateSlSvOPhong($maphongcu,$trangthai='giam');
	 	$b=$this->updateSlSvOPhong($maphongmoi,$trangthai='tang');
	 	$c=$this->capnhattrangthaiphongcu($id,$maphongmoi);
	 	if($a==true&& $b==true&& $c ==true){
		 	$data = array(
		 		'MaPhong' => $maphongmoi,
		 		'MaSV' => $masv,
		 		'MaHK' =>$mahk,
		 		'TrangThai' =>'daxn',
		 		'NgayDK' =>$ngaydk,
		 		'NgayXN' => $this->my_auth->setDate(),
		 		'NguoiXN' => $macb
		 		);
		 	$this->db->insert('sinhvien_phong',$data);
		 	return true;
	 	}
	 	else
	 		return false;
	 }
	 // Từ chối sinh viên chuyển phòng
	 public function tcsvchuyenphong($id){
	 	$data = array(
	 		'GhiChu' =>NULL,
	 		);
	 	$this->db->where('Id',$id);
	 	$this->db->update('sinhvien_phong',$data);
	 }
	// lay thong tin cua mot madk phong
	public function ds($id){
		$this->db->where('Id',$id);
		$query = $this->db->get('sinhvien_phong');
		if($query->num_rows>0){
	 		return $query->result_array();
	 	}
	 	else
	 		return false;
	}

	/***********************************************************************
		Sinh viên
	**********************************************************************/
	// số lượng sinh viên đã đăng ký một phòng
	public function laySlDaDkMotPhong($maphong){
		$query=$this->db->get_where('sinhvien_phong',array('TrangThai'=>'chuaxn','MaPhong' =>$maphong));
		if($query->num_rows()>=0){
			return $query->num_rows();
		}
		return fasle;

	}
	// số lượng sinh viên đã ở một phòng
	public function laySlSvOMotPhong($maphong){
		$query=$this->db->get_where('sinhvien_phong',array('TrangThai'=>'daxn','MaPhong' =>$maphong));
		if($query->num_rows()>0){
			return $query->num_rows();
		}
		return fasle;
	}
	// danh sách các phòng
	public function dsPhong(){
	    	$sql="select MaPhong,SoLuong,HienDangO from ktx_phong";
	    	$query= $this->db->query($sql);
	    	if($query->num_rows()>0){
	    		return $query->result_array();
	    	}
	        	else
	        		return false;
	}
	
	// danh sách các phòng trống sv có thể đăng ký
	public function danhSachPhongTrong(){
		$data=array();
	        	$query=$this->db->get('ktx_phong');
	        	foreach ($query->result_array() as $k => $v) {
	        		$data[$k] = $v;
	        		$data[$k]['slot']= $v['SoLuong'] - ($v['HienDangO'] + $this->laySlDaDkMotPhong($v['MaPhong']) );
	        		$data[$k]['SoLuongDK'] = $this->demSoSvDKPhong($v['MaPhong']);
	        	}
	        	return $data;
	}

	// lấy Id đăng ký lần cuối của sv
	public function svDkLanCuoi($masv){
		$this->db->select('Max(Id) as maxid');
		$this->db->from('sinhvien_phong');
		$this->db->where('MaSV',$masv);
		$query=$this->db->get();
		$rs = $query->result_array();
		if(empty($rs)){
			return false;
		}
		else
			return $rs;		
	}
	// lấy MaPhong đăng ký lần cuối của sv

	public function svMaPhongLanCuoi($id){
		$this->db->select('MaPhong');
		$this->db->from('sinhvien_phong');
		$this->db->where('Id',$id);
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result_array();
		}
		else{
			return false;
		}
	}
	// kiểm tra tình trạng đăng ký phòng của một sinh viên
	public function svTinhTrangDKP($masv){
		$maxid = $this->svDkLanCuoi($masv);
		$id= $maxid[0]['maxid'];
		if(is_null($id)){
			return -1;
		}
		else{
			$sql="select TrangThai from sinhvien_phong where MaSV=$masv and Id=$id";
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				$rs = $query->result_array();
				if($rs[0]['TrangThai']=='daxn'){
					return 0;
				}
				elseif($rs[0]['TrangThai']=='chuaxn'){
					return 1;
				}
				elseif($rs[0]['TrangThai'] == 'tuchoi'){
					return -1;
				}
			}
			else
				return -1;
		}
	}

	// thông tin đăng ký phòng của 1 sinh viên
	public function svTinhTrangPhongKTX($masv){
		$this->db->where('MaSV',$masv);
		$this->db->where('TrangThai','daxn');
		$query=$this->db->get('sinhvien_phong');
		if($query->num_rows()>0){
			return $query->result_array();
		}

	}
	// Sinh viên đăng ký phòng
	public function svDkPhong($masv,$maphong,$mahk){
		$data = array(
			'MaSV' => $masv,
			'MaPhong' => $maphong,
			'MaHK' => $mahk,
			'NgayDK'=> $this->my_auth->setDate(),
		);
		$query=$this->db->insert('sinhvien_phong',$data);
	}
	// lịch sử đăng ký phòng
	public function flsDkPhong($masv){
		$this->db->where('MaSV',$masv);
		$query=$this->db->get('sinhvien_phong');
		if($query->num_rows>0){
			return $query->result_array();
		}
		else
			return 0;

	}
	// check sinh viên đã đăng ký chuyển phòng
	public function checkSvDaDkChuyenPhong($id){
		if($id==NULL){
			return false;
		}
		else{
			$sql="select GhiChu from sinhvien_phong where Id=$id";
			$query=$this->db->query($sql);
			$rs = $query->result_array();
			$tinhtrang=explode(':',$rs[0]['GhiChu']);
			if($tinhtrang[0]=='chochuyen'){
				return true;
			}
			else
				return false;
		}
	}
	//sinh viên đăng ký chuyển phòng
	public function svDkChuyenPhong($maphong,$id){
		$data = array(
			'GhiChu' =>'chochuyen:'.$maphong,
		);
		$this->db->where('Id',$id);
		$query=$this->db->update('sinhvien_phong',$data);
		return $query;
	}
	// check ton tai id
	public function checkToExist($id){
		$sql="SELECT Id FROM sinhvien_phong where Id='$id' and TrangThai='chuaxn' ";
		$query = $this->db->query($sql);
		if($query->result_array() >0){
			return true;
		}
		return false;
	}
	// check gioi tinh 
	public function checkSex($masv){
		$sql="SELECT GioiTinh FROM sinhvien where MaSV=$masv ";
		$query = $this->db->query($sql);
		if($query->result_array() >0){
			return $query->result_array();
		}
		return false;	
	}
	
 }