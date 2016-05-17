<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MRenLuyen extends CI_Model 
{
    public $tb;
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('msinhvien'));
        $this->tb = 'renluyen';
    }
    /**
     * Quy doi he so diem
     */
    public function doiDiem($diem)
    {
        if($diem>=90 && $diem<=100) {
            $db['xl']   =   'Xuất sắc';
            $db['dcd']   =   1;
        } elseif($diem>=80) {
            $db['xl']   =   'Tốt';
            $db['dcd']   =   0.8;
        }elseif($diem>=65) {
            $db['xl']   =   'Khá';
            $db['dcd']   =   0.6;
        }elseif($diem>=50) {
            $db['xl']   =   'Trung Bình';
            $db['dcd']   =   0.4;
        }elseif($diem>=40) {
            $db['xl']   =   'Yếu';
            $db['dcd']   =   0.2;
        }else {
            $db['xl']   =   'Kém';
            $db['dcd']   =   0;
        }
        return $db; 
    }
    /**
     * Them ds diem ren luyen
     */
    public function addDRL($masv, $mahk, $diem, $ngayxn, $ghichu = "")
    {
        $sv = $this->msinhvien->setInfo($masv);
        $d = $this->doiDiem($diem);
        $data = array(
            'MaSV'  =>  $masv,
            'MaHK'  =>  $mahk,
            'MaLop' =>  $sv->malop,
            'Diem'  =>  $diem,
            'DiemCD'    =>  $d['dcd'],
            'XepLoai'   =>  $d['xl'],
            'NgayXN'    =>  $ngayxn,
            'GhiChu'    =>  $ghichu
        );
        $this->db->insert($this->tb,$data);
    }
    /**
     * Danh sach diem ren luyen
     */
    
    public function dsDRL($malop, $mahk, $limit = false, $offset = 0)
    {
        $sql = "SELECT rl.MaSV, sv.HoTen, rl.MaHK, rl.MaLop, rl.Diem, rl.DiemCD, rl.XepLoai, rl.NgayXN 
                FROM renluyen AS rl , sinhvien AS sv 
                WHERE rl.MaSV = sv.MaSV and rl.MaLop='$malop' and rl.MaHK='$mahk'";
        $offset = $offset > 0 ? $offset : 0;
        if($limit) $sql .= " limit $offset,$limit";
        $rs = $this->db->query($sql);
        if($rs->num_rows()>0){
            return $rs->result_array();
        } else{
            return false;
        }       
    }
    /**
     *  Danh Sachdiem ren luyen sinh vien
     */
    public function svDRL($masv)
    {
        $this->db->where('MaSV',$masv);
        $rs = $this->db->get($this->tb);
        if($rs->num_rows()>0){
            return $rs->result_array();
        } else{
            return false;
        }
    }
    /**
     * Kiểm tra drl
     */
    
    public function checkDRL($masv, $mahk)
    {
        $this->db->where(array('MaSV'=>$masv,'MaHK'=>$mahk));
        $rs = $this->db->get($this->tb);
        if($rs->num_rows()>0) return true;
        else return false;
    }
    /**
     * Thống kê điểm rèn luyện từng lớp theo từng học kỳ
     */
    public function thongkeDRL($malop, $mahk)
    {
        $sql = "SELECT DiemCD, XepLoai, COUNT(DiemCD) as DCD FROM `renluyen` WHERE MaLop='$malop' and MaHK = '$mahk' GROUP BY DiemCD";
        $rs = $this->db->query($sql);
        return $rs->result_array();
    }
    public function delete($masv,$mahk){
        $data =  array(
            'MaSV' => $masv , 
            'MaHK' => $mahk
        );
        $this->db->where($data);
        $this->db->delete($this->tb);
    }
}

