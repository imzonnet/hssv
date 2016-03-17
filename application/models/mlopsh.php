<?php

class MLopSH extends CI_Model
{
    private $tb;
    public function __construct()
    {
        parent::__construct();
        $this->tb = "lop";
    }
    /**
     * Danh sach lop SH
     */
    public function dsLopSH()
    {
        $rs = $this->db->get($this->tb);
        return $rs->result_array();
    }
    public function getMaLop($macb){
        $this->db->select("MaLop");
        $this->db->from("lop");
        $this->db->where("MaCB",$macb);
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result_array();
        return false;
    }

    public function getMaxOneColOfTable($table,$col_select_max,$where_col1, $where_conditional1, $where_col2,$where_conditional2){
         if($where_col1 !='' && $where_conditional1 !='' ){
            if($where_col2 !='' && $where_conditional2 !='')
                $issetwhere = "where ".$where_col1."='".$where_conditional1." ' "." and ".$where_col2."='".$where_conditional2."'";
            else
                $issetwhere = "where ".$where_col1."='".$where_conditional1." ' ";
        }
        $sql="select Max($col_select_max) from $table $issetwhere";
        $query=$this->db->query($sql);
        if($query->num_rows()>0){
            return $query->result_array();
        }
        else
            return false;
    }

    public function count_all_record_table($table,$where_col,$where_conditional){
        $this->db->from($table);
        $this->db->where($where_col,$where_conditional);
        return $this->db->count_all_results(); 
    }

    public function getAllDataTable($table,$where_col1, $where_conditional1, $where_col2,$where_conditional2, $number,$offset){
        if(!$offset){ $offset= 0;}
        if($where_col1 !='' && $where_conditional1 !='' ){
            if($where_col2 !='' && $where_conditional2 !='')
                $issetwhere = "where ".$where_col1."='".$where_conditional1." ' "." and ".$where_col2."='".$where_conditional2."'";
            else
                $issetwhere = "where ".$where_col1."='".$where_conditional1." ' ";
        }
        if($number !='' ){
            $issetlimit = 'limit '.$offset.','.$number;
        }
        $sql="select * from $table $issetwhere  $issetlimit";
        $query= $this->db->query($sql);
        if($query->num_rows()>0){
            return $query->result_array();
        }
        else
            return false;
    }
}

