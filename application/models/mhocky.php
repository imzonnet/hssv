<?php

class MHocKy extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getMHK()
    {
        $sql = "SELECT * FROM hocky ORDER BY id DESC LIMIT 0,1";
        $rs = $this->db->query($sql);
        $a = $rs->row_array();
        return $a['MaHK'];
    }
    
    public function listHK()
    {
        $sql = "SELECT * FROM hocky ORDER BY id DESC";
        $rs = $this->db->query($sql);
        return $a = $rs->result_array();
    }
    
    public function htmlMHK()
    {
        $dt = $this->listHK();
        
    }
    
}