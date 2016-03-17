<?php

class MSinhVien extends CI_Model
{
    private $tb;
    public $masv;
    protected $matkhau;
    public $hoten;
    public $ngaysinh;
    public $gioitinh;
    public $cmnd;
    public $ngaycap;
    public $noicap;
    public $diachi;
    public $maphuong;
    public $hotencha;
    public $manghecha;
    public $hotenme;
    public $mangheme;
    public $doituong;
    public $ngaynhaphoc;
    public $ngayketthuc;
    public $khoahoc;
    public $malop;
    public $tinhtrang;
    public $hedaotao;
    public $tennganh;
    public $tenkhoa;
    
    public function __construct()
    {
        parent::__construct();
        $this->tb = "sinhvien";
        
    }
    
    public function setInfo($id) 
    {
        if(!$this->getInfo($id,1)) return false;
        
        $data = $this->getInfo($id,1);
        
        $this->masv         = $data['MaSV'];
        $this->matkhau      = $data['MatKhau'];
        $this->hoten        = $data['HoTen'];
        $this->ngaysinh     = $data['NgaySinh'];
        $this->gioitinh     = $data['GioiTinh']==0?"Nữ":"Nam";
        $this->cmnd         = $data['CMND'];
        $this->ngaycap      = $data['NgayCap'];
        $this->noicap       = $data['NoiCap'];
        $this->diachi       = $data['DiaChi'];
        $this->maphuong     = $data['MaPhuong'];
        $this->hotencha     = $data['HoTenCha'];
        $this->manghecha    = $data['MaNgheCha'];
        $this->hotenme      = $data['HoTenMe'];
        $this->mangheme     = $data['MaNgheMe'];
        $this->doituong     = explode(',',$data['DoiTuong']);
        $this->ngaynhaphoc  = $data['NgayNhapHoc'];
        $this->ngayketthuc  = $data['NgayKetThuc'];
        $this->khoahoc      = $data['KhoaHoc'];
        $this->malop        = $data['MaLop'];
        $this->tinhtrang    = $data['TinhTrang'];
        $this->hedaotao     = $data['TenHDT'];
        $this->tennganh     = $data['TenNganh'];
        $this->tenkhoa      = $data['TenKhoa'];
        return $this;
    }
    
    public function getInfo($id)
    {
        
        $sql = "SELECT sv.MaSV, sv.MatKhau, sv.HoTen, sv.NgaySinh, sv.GioiTinh, sv.CMND, 
                        sv.NgayCap, sv.NoiCap, sv.DiaChi, sv.MaPhuong, sv.HoTenCha,
                		sv.MaNgheCha, sv.HoTenMe,	sv.MaNgheMe, sv.DoiTuong, sv.NgayNhapHoc, 
                        sv.NgayKetThuc, sv.KhoaHoc, sv.MaLop, sv.TinhTrang, n.TenNganh, h.TenHDT, k.TenKhoa
                FROM sinhvien AS sv, lop AS l, nganh AS n, hedaotao AS h, khoa AS k
                WHERE sv.MaLop = l.MaLop AND l.MaNganh = n.MaNganh AND l.MaDaoTao = h.MaDaoTao AND n.MaKhoa = k.MaKhoa AND
                    sv.masv = '$id'";
        $rs = $this->db->query($sql);
        if($rs->num_rows()>0) {
            return $rs->row_array();
        } else {
            return false;
        }
    }
    public function getMatKhau()
    {
        return $this->matkhau;
    }
    /**
     * Check account and login
     * @Param: $user, $pass, $table(0:`canbo`, 1:`sinhvien`) 
     * @Return: array()
     **/ 
    public function checkLogin($user, $pass)
    {
        if(strlen($pass)!=32 || strlen($user) < 5) return false;        
        $sql = "SELECT * FROM ". $this->tb ." WHERE masv = '$user' and matkhau='$pass'";
        $rs = $this->db->query($sql);
        if($rs->num_rows()>0) {
            return $rs->row_array();
        } else {
            return false;
        } 
    }
    /**
     * Trang thái của SV
     * @param $masv
     * @return {1: Bình thường} {-1: Bỏ học} {0: Bảo Lưu} {2: Tốt nghiệp}
     **/
    public function checkTrangThai($masv)
    {
        $this->setInfo($masv);
        return $this->tinhtrang;
    }
    
    /**
     * Kiem tra tinh trang hoc HP cua SV
     * @Return {-1: Chưa đóng HP} {0: Nợ HP} {1: BT} 
     **/
    public function checkHocPhi($masv, $mahk = NULL)
    {
        $sql = "SELECT tongtien, tiendanop FROM hocphi WHERE MaSV='$masv'";
        $sql .= $mahk == NULL ? "" : "and MaHK='$mahk'";
        //echo $sql;
        $qr = $this->db->query($sql);
        $rs = $qr->row_array();
        $tt = $rs['tongtien']-$rs['tiendanop'];
        if($rs['tiendanop']==0) return -1;
        if($tt==0) return 1;
        if($tt>0) return 0;
        
    }
    
    /**
     * Cap nhat thong tin
     */
    public function upInfo($masv, $data)
    {
        $this->db->where("MaSV",$masv);
        $this->db->update($this->tb,$data);
    }
    
    /**
     * kiem tra ma sinh vien
     **/
    
    public function checkMSV($masv)
    {
        $this->db->select('*');
        $this->db->where('masv',$masv);
        $rs = $this->db->get($this->tb);
        if($rs->num_rows()>0)
            return true;
        else
            return false;
    }
    
    /**
     * Danh sách đối tượng SV
     */
    
    public function dsDoiTuong()
    {
        $rs = $this->db->get('doituong');
        return $rs->result_array();
    }
    /**
     *  HTML ds doi tuong
     */
     
    public function htmlDoiTuong($check = array())
    {
        $data = $this->dsDoiTuong();
        $html = "";
        foreach($data as $key =>$v )
        {
                if(in_array($v['MaDT'],$check))
                    $html .= '<label class="checkbox"><input class="doituong" type="checkbox" name="doituong[]" value="'.$v['MaDT'].'" checked="checked">'.$v['TenDT'].'</label>';
                else
                    $html .= '<label class="checkbox"><input class="doituong" type="checkbox" name="doituong[]" value="'.$v['MaDT'].'" >'.$v['TenDT'].'</label>';
        }
        return $html;
    }
    /**
     * Cập nhật đối tượng sinh viên
     */
    public function upDoiTuong($masv, $data)
    {
        $this->db->where('MaSV',$masv);
        $this->db->update($this->tb,$data);
    }
    /**
     * Đổi mật khẩu
     */
    public function changePass($masv,$pass)
    {
        $data = array('MatKhau' =>  $pass);
        $this->db->where('MaSV',$masv);
        $this->db->update($this->tb,$data);
    }
    //Kiểm tra sinh viên đã cập nhật nội trú
    public function kiemtracapnhatnoitru($masv){
        $this->db->select('MaPhuong');
        $this->db->from('sinhvien');
        $this->db->where('MaSV',$masv);
        $query=$this->db->get();
        $rs=$query->result_array();
        $rs=$rs[0]['MaPhuong'];
        if($rs=''){
            return true;
        }
        else{
            return false;
        }
        
    }
   
}
