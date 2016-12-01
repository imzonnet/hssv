<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class My_Auth extends CI_Session
{

    function __construct(){
        parent::__construct();
    }
    
    /**
    *   Check permission a user:
    *   is_SinhVien
    * Return: boolean
    */
    public function is_CanBo() {
        if($this->is_Login() && $this->userdata('u_group') == 1) {
            return true;
        } else {
            $this->sess_destroy();
            return false;
        }
    }
    /**
    *   Check permission a user:
    *   is_SinhVien
    * Return: boolean
    */
    public function is_GiaoVien() {
        if($this->is_CanBo() && $this->userdata('u_chucvu') == 'giaovien') {
            return true;
        } else {
            return false;
        }
    }
    /**
    * Check permission a user:
    * is_SinhVien
    * Return: boolean
    */
    public function is_SinhVien() {
        if($this->is_Login() && $this->userdata('u_group') == 3) {
            return true;
        } else {
            $this->sess_destroy();
            return false;
        }
    }
    
    public function is_Login() {
        if(isset($this->userdata['u_id']) && !empty($this->userdata['u_id']) &&
           isset($this->userdata['u_group']) && !empty($this->userdata['u_group'])) {
            return true;
        } else {
            $this->sess_destroy();
            return false;
        }
    }
    
    public function is_Active() {
        
    }
    
    public function checkAdmLogin() {
        if(!$this->is_Admin() && !$this->is_Mod()) {
            $this->sess_destroy();
            redirect(base_url().'admincp/accounts');
        }
    }

    public function setDate($type = NULL)
    {
        return $type != NULL ? date('Y-m-d') : date('Y-m-d H:i:s');
    }
    
    public function cvDdate($str)
    {
        return strtotime($str) != 0 ? date("Y-m-d", strtotime($str)) : date("Y-m-d");
    }
    
}