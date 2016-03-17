<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index() 
    {
        $this->login();
    }
    
    public function login()
    {
        $data['sub_views'] = 'contact';
        $this->load->view("home/sub_layout",$data);
    }
    
    public function send()
    {
        if($this->input->post('send')) {
            $this->load->library('email');
            $name = $this->input->post('name');
            $mail = $this->input->post('mail');
            $msg = $this->input->post('msg');
            $this->email->from($mail, $name);
            $this->email->to('vnzacky39@hotmail.com');
            
            $this->email->subject('Email Test');
            $this->email->message($msg);
            $this->email->send();
            
            echo $this->email->print_debugger();
        }
    }
    
}