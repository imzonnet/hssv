<?php

class Test extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('msinhvien','maddress'));
    }
    
    function index()
    {
        //$this->msinhvien->setInfo(1);
        //var_dump($this->maddress->dsTinh());
        //var_dump($this->maddress->dsQuan('48'));
        //var_dump($this->maddress->dsPhuong('490'));
        $data['tinh'] = $this->dsTinh();
        $this->load->view('test/add',$data);
        
    }
    
    function dsTinh($matinh = 0)
    {
        $rs = $this->maddress->dsTinh($matinh);
        $arr = "<option value='0'>--Chọn--</option>";
        //var_dump($rs);
        foreach($rs as $list)
        {
            $arr .= "<option value='{$list['matinh']}'>{$list['cap']} {$list['tentinh']}</option>\n";
        }
        return $arr;
    }
    function dsQuan($matinh = 0)
    {
        $rs = $this->maddress->dsQuan($matinh);
        $arr = "<option value='0'>--Chọn--</option>";
        //var_dump($rs);
        foreach($rs as $list)
        {
            $arr .= "<option value='{$list['maquan']}'>{$list['cap']} {$list['tenquan']}</option>\n";
        }
        echo $arr;
    }
    function dsPhuong($maquan= 0)
    {
        $rs = $this->maddress->dsPhuong($maquan);
        $arr = "<option value='0'>--Chọn--</option>";
        //var_dump($rs);
        foreach($rs as $list)
        {
            $arr .= "<option value='{$list['maphuong']}'>{$list['cap']} {$list['tenphuong']}</option>\n";
        }
        echo $arr;
    }
    
}