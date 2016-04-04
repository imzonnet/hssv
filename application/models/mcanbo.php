<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MCanbo extends CI_Model
{
    public $macb;
    protected $matkhau;
    public $tencb, $email, $phone,$chucvu;
    private $tb;

    public function __construct()
    {
        parent::__construct();
        $this->tb = 'canbo';
        
    }
    /**
     * Set all value form variable
     */
    public function setInfo($id) 
    {
        if(!$this->checkInfo($id)) redirect('canbo/login');
        $data = $this->checkInfo($id);
        $this->macb     = $data['MaCB'];
        $this->matkhau  = $data['MatKhau'];
        $this->tencb    = $data['TenCB'];
        $this->email    = $data['Email'];
        $this->phone    = $data['Phone'];
        $this->chucvu = $data['ChucVu'];
        return $this;    
    }
    /**
     * Check info
     */
    public function checkInfo($id) {
        $this->db->where('MaCB',$id);
        $rs = $this->db->get($this->tb);
        if($rs->num_rows() >0) return $rs->row_array();
        else {$this->session->sess_destroy();return false;}
    }
    /**
     * 
     */
    public function getMatKhau() {return $this->matkhau;}
    public function display()
    {
        return $this;
    }
    /**
     * Check account and login
     * Param: $user, $pass 
     * Return: array()
     **/ 
    public function checkLogin($user, $pass)
    {
        if(strlen($pass)!=32 || strlen($user) < 5) return false;
        $sql = "SELECT * FROM ". $this->tb ." WHERE macb = '$user' and matkhau='$pass'";
        $rs = $this->db->query($sql);
        if($rs->num_rows()>0) {
            return $rs->row_array();
        } else {
            return false;
        } 
    }
    
    /**
     * Đổi mật khẩu
     */
    public function changePass($macb,$pass)
    {
        $data = array('MatKhau' =>  $pass);
        $this->db->where('MaCB',$macb);
        $this->db->update($this->tb,$data);
    }
    /**
    * Lay ten can bo
    */
    public function laytencanbo($macanbo){
        $this->db->select('TenCB');
        $this->db->where('MaCB',$macanbo);
        $rs = $this->db->get('canbo');
        if($rs->num_rows()>0) { return $rs->result_array(); }
        return false;
    }
}