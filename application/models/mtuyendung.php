<?php

class mtuyendung extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function all_count_table_thongtin()
    {
        $rs = $this->db->get('thongtintuyendung');
        return $rs->num_rows();
    }

    public function laydanhsachtintuyendung($limit = false, $offset = 0)
    {
        $sql = "select * from thongtintuyendung order by MaSo desc ";
        $offset = $offset > 0 ? $offset : 0;
        if ($limit) $sql .= "limit $offset,$limit";
        $rs = $this->db->query($sql);
        if ($rs->num_rows() > 0) return $rs->result_array();
        else return false;
    }

    public function xemtintuyendung($matin)
    {
        $this->db->where('MaSo', $matin);
        $rs = $this->db->get('thongtintuyendung');
        if ($rs->num_rows() > 0) {
            return $rs->row();
        }
        return false;
    }

    public function themtintuyendung($tieude, $noidung, $ngaydangtin, $macb)
    {
        $data = array(
            'MaSo' => '',
            'TieuDe' => $tieude,
            'NoiDung' => $noidung,
            'NgayDangTin' => $ngaydangtin,
            'NguoiDangTin' => $macb,
        );
        $this->db->insert('thongtintuyendung', $data);
    }

    public function xoatintuyendung($matin)
    {
        $this->db->delete('thongtintuyendung', array('MaSo' => $matin));
        return $this->db->affected_rows() > 1 ? true : false;
    }

    public function suatintuyendung($maso, $tieude, $noidung, $ngaycapnhat, $macanbo)
    {
        $data = array(
            'TieuDe' => $tieude,
            'NoiDung' => $noidung,
            'NgayDangTin' => $ngaycapnhat,
            'NguoiDangTin' => $macanbo
        );
        $this->db->where('MaSo', $maso);
        $this->db->update('thongtintuyendung', $data);
    }
}
