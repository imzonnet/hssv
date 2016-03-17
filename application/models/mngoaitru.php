<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MNgoaiTru extends CI_Model
{
    
    public $tb;
       
    public function __construct()
    {
        parent::__construct();
        $this->tb = 'ngoaitru';
    }
    /**
     * Them dia chi ngoai tru
     **/
    public function add($data)
    {
        $rs = $this->db->query("SELECT mant, ngayden, ngaydi FROM $this->tb WHERE MaSV='{$data['MaSV']}' ORDER BY mant DESC LIMIT 0,1")->row_array();
        if(strlen($rs['ngaydi']) < 7) $this->db->query("UPDATE $this->tb SET ngaydi='{$data['NgayDen']}' WHERE MaNT='{$rs['mant']}'");
        if($this->checkInfo($data))
            return $this->db->insert($this->tb,$data);
        else
            return false;
    }
    /**
     * Cap nhat dia chi ngoai tru
     */
    public function update($mant,$data)
    {
        if(!$this->checkInfo($data)) return false;
        $this->db->where('MaNT',$mant);
        return $this->db->update($this->tb,$data);
    }
    /**
     * Xoa dia chi ngoai tru
     */
    public function delete($mant)
    {
        $this->db->where('MaNt',$mant);
        $this->db->delete($this->tb);
    }
    /**
     * Lấy toàn bộ thông tin ngoại trú của sinh viên
     **/
    public function danhsach($masv)
    {
        $sql = "SELECT nt.MaNT, nt.TenChuTro, 
                CONCAT_WS('-',nt.DiaChi,p.TenPhuong,q.TenQuan) as DiaChi,
    			nt.DienThoai, nt.MaHK, nt.NgayDen, nt.NgayDi, nt.NgayXN
                FROM $this->tb AS nt, phuong as p, quan as q
                WHERE nt.MaPhuong = p.MaPhuong AND p.MaQuan = q.MaQuan AND 
                nt.MaSV='$masv' ORDER BY nt.MaNT";
        $rs = $this->db->query($sql);
        if($rs->num_rows()>0)
            return $rs->result_array();
        else 
            return false;
    }
    /**
     * Kiểm tra địa chỉ ngoại trú của sinh viên
     **/
    public function checkAdd($masv, $ngayden)
    {
        $rs = $this->db->query("SELECT mant, ngayden, ngaydi FROM $this->tb WHERE MaSV='$masv' ORDER BY NgayDen DESC LIMIT 0,1");
        $kq = $rs->row_array();
        $nd = $kq['ngayden'];
        $ndi = $kq['ngaydi'];
        if(date('Y-m-d') < $ngayden) return false;
        if($ngayden < $ndi || $ngayden <= $nd) return false;
        else return true;
    }
    
    public function checkInfo($dt)
    {
        //MaSV`, `TenChuTro`, `DienThoai`, `DiaChi`, `MaPhuong`, `NgayDen`, `NgayDi`, `MaHK
        if(strlen($dt['TenChuTro']) >5 && is_numeric($dt['DienThoai']) && strlen($dt['DienThoai']) > 8 && strlen($dt['DiaChi']) >3 ) 
            return true;
        return false;
    }
    /**
     * Tim kiem danh sach ngoai tru theo lớp sinh hoạt
     * 
     */
    public function timKiemLop($malop, $mahk, $limit = false, $offset = 0)
    {
        $sql = "SELECT nt.MaNT, nt.MaSV, sv.HoTen, sv.NgaySinh, sv.MaLop,
                        nt.TenChuTro, nt.DienThoai, nt.DiaChi, q.TenQuan, p.TenPhuong, nt.NgayDen, nt.NgayDi,nt.NgayXN
                FROM ngoaitru AS nt , sinhvien AS sv , quan AS q , phuong AS p 
                WHERE  nt.MaPhuong = p.MaPhuong AND q.MaQuan = p.MaQuan AND nt.MaSV = sv.MaSV
                    AND nt.MaHK = '$mahk' AND sv.MaLop = '$malop'";
        $offset = $offset > 0 ? $offset : 0;
        if($limit) $sql .= " limit $offset,$limit";
        //echo $sql;
        $rs = $this->db->query($sql);
        if($rs->num_rows()>0) return $rs->result_array();
        else return false;
    }
    /**
     * Tim kiem danh sach ngoai tru theo Sinh Vien
     * 
     */
    public function timKiemSV($tc, $mahk, $nd, $limit = false, $offset = 0)
    {
        $sql = "SELECT nt.MaNT, nt.MaSV, sv.HoTen, sv.NgaySinh, sv.MaLop,
                        nt.TenChuTro, nt.DienThoai, nt.DiaChi, q.TenQuan, p.TenPhuong, nt.NgayDen, nt.NgayDi,nt.NgayXN
                FROM ngoaitru AS nt , sinhvien AS sv , quan AS q , phuong AS p 
                WHERE  nt.MaPhuong = p.MaPhuong AND q.MaQuan = p.MaQuan AND nt.MaSV = sv.MaSV
                    AND nt.MaHK = '$mahk'";
        if($tc == 1) $sql .= " AND nt.MaSV = '$nd'";
        else   $sql .= " AND sv.HoTen Like '%$nd%'";
        $offset = $offset > 0 ? $offset : 0;
        if($limit) $sql .= " limit $offset,$limit";
        //echo $sql;
        $rs = $this->db->query($sql);
        if($rs->num_rows()>0) return $rs->result_array();
        else return false;
    }
    /**
     * Tim kiem danh sach ngoai tru theo dia chi
     * 
     */
    public function timKiemDC($maquan, $maphuong = false, $limit = false, $offset = 0)
    {
        $sql = "SELECT nt.MaNT, nt.MaSV, sv.HoTen, sv.NgaySinh, sv.MaLop,
                        nt.TenChuTro, nt.DienThoai, nt.DiaChi, q.TenQuan, p.TenPhuong, nt.NgayDen, nt.NgayDi,nt.NgayXN
                FROM ngoaitru AS nt , sinhvien AS sv , quan AS q , phuong AS p 
                WHERE  nt.MaPhuong = p.MaPhuong AND q.MaQuan = p.MaQuan AND nt.MaSV = sv.MaSV
                    AND q.MaQuan = '$maquan'";
        if($maphuong) $sql .= " AND p.MaPhuong = '$maphuong'";
        $sql .= " GROUP BY nt.MaNT DESC";
        $offset = $offset > 0 ? $offset : 0;
        if($limit) $sql .= " limit $offset,$limit";
        //echo $sql;
        $rs = $this->db->query($sql);
        if($rs->num_rows()>0) return $rs->result_array();
        else return false;
    }
    
    /**
     * Kiem tra ma ngoai tru
     */
    public function checkMNT($masv, $mant)
    {
        $this->db->where(array('MaNT'=>$mant,'MaSV'=>$masv));
        $rs = $this->db->get($this->tb);
        if($rs->num_rows()>0) return true;
        else return false;
    } 
    
    /**
     * Lay thong tin dia chi ngoai tru
     */
    public function infoNT($masv, $mant)
    {
        if(!$this->checkMNT($masv ,$mant)) return null;
        $this->db->where(array('MaNT'=>$mant,'MaSV'=>$masv));
        $rs = $this->db->get($this->tb);
        return $rs->row_array();
    }
    /**
     * Kiem tra thong tin mant
     */

}
