<?php

class Address extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
    }
    //return list option
    function dsTinh($matinh = 0, $check = 0)
    {
        $rs = $this->maddress->dsTinh($matinh);
        $arr = "<option value='0'>--Chọn--</option>";
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
    function dsQuan($matinh = 0, $maquan= 0, $check = 0)
    {
        $rs = $this->maddress->dsQuan($matinh, $maquan);
        $arr = "<option value='0'>--Chọn--</option>";
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
    function dsPhuong($maquan= 0,$maphuong = 0, $check = 0)
    {
        $rs = $this->maddress->dsPhuong($maquan,$maphuong);
        $arr = "<option value='0'>--Chọn--</option>";
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
    
    
    

}