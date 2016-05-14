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
        return $rs->num_rows();
    }

    public function add($data) {
        $this->db->insert($this->tb,$data);
    }

    public function checkAdd($MaSV, $MaHK) {
        $rs = $this->db->query("SELECT * FROM {$this->tb} WHERE MaSV='{$MaSV}' and MaHK = '{$MaHK}'");
        if($rs->num_rows()>0){
            return true;
        } else{
            return false;
        }
    }
    

}
