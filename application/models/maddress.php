<?php

class MAddress extends CI_Model 
{
    
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Get list data Tinh
     * Return: array()
     * */
    public function dsTinh($matinh = 0)
    {
        $sql = "SELECT matinh, tentinh, cap FROM tinh";
        if($matinh != 0) $sql = $sql." WHERE MaTinh='$matinh'";
        $sql .= " ORDER BY tentinh";
        $rs = $this->db->query($sql);
        if($rs->num_rows()>0)
            return $rs->result_array();
        else 
            return false;
    }
    /**
     * Get list Quan
     * Return: array();
     * */
    public function dsQuan($matinh = 0, $maquan = 0)
    {
        $sql = "SELECT q.maquan,q.tenquan, q.cap, q.matinh FROM quan q";
        if($matinh != 0) $sql .= ", tinh t WHERE q.MaTinh = t.MaTinh and t.MaTinh='$matinh'";
        if($maquan!=0) $sql .= " WHERE q.maquan = '$maquan'";
        $rs = $this->db->query($sql);
        if($rs->num_rows()>0)
            return $rs->result_array();
        else 
            return false;
    }
    /**
     * Get list Phuong
     * Return: array();
     * */
    public function dsPhuong($maquan = 0, $maphuong = 0)
    {
        $sql = "SELECT p.maphuong, p.tenphuong, p.cap, p.maquan FROM phuong p";
        if($maquan != 0) $sql .= ", quan q WHERE p.MaQuan = q.MaQuan and q.MaQuan='$maquan'";
        if($maphuong!=0) $sql .= " WHERE p.maphuong = '$maphuong'";
        $rs = $this->db->query($sql);
        if($rs->num_rows()>0)
            return $rs->result_array();
        else 
            return false;
    }
    //***************
    
    //return list option
    function htmlTinh($matinh = 0, $check = 0)
    {
        $rs = $this->dsTinh($matinh);
        $arr = "<option value='0'>--Chọn Tỉnh--</option>";
        //var_dump($rs);
        foreach($rs as $list)
        {
            if($list['matinh'] == $check)
                $arr .= "<option value='{$list['matinh']}' selected='selected'>{$list['cap']} {$list['tentinh']}</option>\n";
            else
                $arr .= "<option value='{$list['matinh']}'>{$list['cap']} {$list['tentinh']}</option>\n";
        }
        return $arr;
    }
    //return list option
    function htmlQuan($matinh = 0, $maquan= 0, $check = 0)
    {
        $rs = $this->dsQuan($matinh, $maquan);
        $arr = "<option value='0'>--Chọn Quận--</option>";
        //var_dump($rs);


        foreach($rs as $list)
        {
            if($list['maquan'] == $check)
                $arr .= "<option value='{$list['maquan']}' selected='selected'>{$list['cap']} {$list['tenquan']}</option>\n";
            else
                $arr .= "<option value='{$list['maquan']}'>{$list['cap']} {$list['tenquan']}</option>\n";
        }
        return $arr;
    }
    //return list option
    function htmlPhuong($maquan= 0,$maphuong = 0, $check = 0)
    {
        $rs = $this->dsPhuong($maquan,$maphuong);
        $arr = "<option value='0'>--Chọn Phường--</option>";
        //var_dump($rs);
        foreach($rs as $list)
        {
            if($list['maphuong'] == $check)
                $arr .= "<option value='{$list['maphuong']}' selected='selected'>{$list['cap']} {$list['tenphuong']}</option>\n";
            else
                $arr .= "<option value='{$list['maphuong']}'>{$list['cap']} {$list['tenphuong']}</option>\n";
        }
        return $arr;
    }
    
    /**
     * Lay dia chi cua Sinh Vien
     **/
    function getAddress($maphuong)
    {
        $phuong = $this->dsPhuong(0,$maphuong);
        $quan   = $this->dsQuan(0,$phuong[0]['maquan']);
        $tinh   = $this->dsTinh($quan[0]['matinh']);
        $data = array(
            'phuong'      =>  $phuong[0]['tenphuong'],
            'quan'      =>  $quan[0]['tenquan'],
            'tinh'      =>  $tinh[0]['tentinh'],
            'thuongtru' => $phuong[0]['tenphuong'] .' - '.$quan[0]['tenquan'].' - '.$tinh[0]['tentinh'],
            'diachi'    => $phuong[0]['cap'].' '. $phuong[0]['tenphuong'] .', '.$quan[0]['cap'].' '.$quan[0]['tenquan'].', '.$tinh[0]['cap'].' '.$tinh[0]['tentinh']
        );
        return $data;
    }
    
    /**
     * Tim kiem ma phuong theo ten
     * */
     
    public function getMP($tenp)
    {
        $sql = "SELECT p.maphuong, p.tenphuong, p.cap, p.maquan FROM phuong p Where p.tenphuong='$tenp'";
        $rs = $this->db->query($sql);
        if($rs->num_rows()>0)
            return $rs->row_array();
        else 
            return false;
    }
}