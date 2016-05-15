<?php

class MHocBong extends CI_Model
{

    private $tb;

    public function __construct()
    {
        parent::__construct();
        $this->tb = 'hocbong';
    }

    public function all()
    {
        $rs = $this->db->get($this->tb);
        return $rs->result_array();
    }

    public function add($data) {
        return $this->db->insert($this->tb,$data);
    }

    public function checkAdd($MaSV, $MaHK) {
        $rs = $this->db->query("SELECT * FROM {$this->tb} WHERE MaSV='{$MaSV}' and MaHK = '{$MaHK}'");
        if($rs->num_rows()>0) {
            return true;
        } else {
            return false;
        }
    }
    public function danhSach($MaHK, $limit = false, $offset = 0) {
        $query = "SELECT sv.MaSV, sv.HoTen, sv.NgaySinh, sv.MaLop, hb.DiemTK, hb.SoTC, rl.Diem, rl.DiemCD, rl.XepLoai, hb.MaHK
                  FROM sinhvien AS sv , hocbong AS hb , renluyen AS rl
                  WHERE sv.MaSV = hb.MaSV AND sv.MaSV = rl.MaSV AND hb.MaHK = '{$MaHK}'";
        $offset = $offset > 0 ? $offset : 0;
        if($limit) $query .= " limit $offset,$limit";
        $rs = $this->db->query($query);
        if($rs->num_rows()>0){
            return $rs->result_array();
        } else{
            return false;
        }
    }


}
