<?php

class Main extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index() 
    {
        $this->site();
    }
    
    public function site()
    {
        $this->load->model('mtuyendung');
        $data['sub_views'] = 'home_page';
        $data['thongtintuyendung'] = $this->mtuyendung->laydanhsachtintuyendung(5);
        $this->load->view("home/sub_layout",$data);
    }
    
    public function form()
    {
        $data['sub_views'] = 'form';
        $this->load->view("home/main_layout",$data);
    }
    
    public function about()
    {
        echo "Page About";
    }
    
    public function contact()
    {
        $data['sub_views'] = 'contact';
        $this->load->view("home/sub_layout",$data);
    }
    public function tuyendung($id) {
        $this->load->model(array('mtuyendung', 'mcanbo' ));
        $data['sub_views'] = 'home/xemtintuyendung';
        $dstd = $this->mtuyendung->xemtintuyendung($id);
        $cb = $this->mcanbo->laytencanbo($dstd->NguoiDangTin);
        $dstd->TenCB = $cb[0]['TenCB'];
        $data['data'] = $dstd;
        $this->load->view("home/sub_layout",$data);
    }
}
