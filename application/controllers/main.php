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
        $data['sub_views'] = 'home_page';
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
}
