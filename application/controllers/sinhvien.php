<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SinhVien extends CI_Controller
{
    public $sv;
    public $sv_id;
    public $sv_url;
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('msinhvien','mgiayxn','mhocky','maddress','mngoaitru','mrenluyen','mnoitru','mtuyendung','mcanbo'));
        if($this->my_auth->is_Login()) 
        {
            $this->sv_id = $this->session->userdata('u_id');
            if($this->msinhvien->setInfo($this->sv_id))
                $this->sv = $this->msinhvien->setInfo($this->sv_id);
            else{
                $this->session->sess_destroy();
                redirect("sinhvien/login");
            }
                
        }
        $this->sv_url = base_url('sinhvien');
    }
    /**
     * Index
     * */
    public function index() 
    {
        if(!$this->my_auth->is_SinhVien()) {redirect("sinhvien/login");}//check login
        /**set info SinhVien **/
        $this->sv_id = $this->session->userdata('u_id');
        $this->sv = $this->msinhvien->setInfo($this->sv_id);
        $data['sv_id'] = $this->sv_id;
        $data['sv_name'] = $this->sv->hoten;
        $check=$this->msinhvien->kiemtracapnhatnoitru($data['sv_id']);
        if($check == true){
            $this->session->set_userdata('status','true');
            redirect('sinhvien/updateinfo');
        }
        else{
            $this->load->view("home/sv_layout",$data);                
        }
    }
    
    public function display()
    {
       //var_dump($this->msinhvien->display());
        //var_dump($this->mgiayxn->getYCCG(2));
        echo $this->my_auth->cvDdate('20-10-2013');
        echo date("Y-m-d",strtotime('20/10/2013'));
    }
    /**
     * Kiểm tra và đăng nhập
     **/
    public function login()
    {
        if($this->my_auth->is_SinhVien()) {redirect("sinhvien");}
        $data['stt'] = "0";
        if($this->input->post('login')!="") 
        {
            $user = addslashes(trim($this->input->post('user')));
            $pass = md5($this->input->post('pass'));
            $rs = $this->msinhvien->checkLogin($user,$pass);
            if($rs)
            {
                $datass = array(
                    'u_id'  =>  $user,
                    'u_group'   => 3
                );
                $this->session->set_userdata($datass);
                $data['stt'] = "1";
            } else {
                $data['stt'] = "-1";
            }
        }
        if($this->input->post('ajax')!="") {
            echo json_encode($data);
        } else {
            $data['sub_views'] = 'sinhvien/sv_login';
            $this->load->view("home/sub_layout",$data);
        }
    }
    /**
     * Đăng xuất
     **/
    public function logout() 
    {
        $this->session->sess_destroy();
        redirect('sinhvien');
    }
    /*************************************************************************************
                                    Quản Lý Giấy Xác Nhận
    *************************************************************************************/
    /**
     * Chức năng gửi yêu cầu cấp giấy xác nhận
     **/
    public function YeuCauCapGiay()
    {
        if(!$this->my_auth->is_SinhVien()) {redirect("sinhvien/login");}//check login
        /**khoi tao gia tri **/
        $data['sv_id'] = $this->sv_id;
        $data['sv_name'] = $this->sv->hoten;
        $data['sub_views']  = 'gxn_yc';
        $data['task_name']  = 'Yêu Cầu Cấp Giấy Xác Nhận';
        $data['listGXN'] = $this->mgiayxn->listGXN();
        $data['mahk']   = $this->mhocky->getMHK();

        /** Thuc thi **/
        if($this->input->post('send')!="")
        {
            $arr = $this->input->post('lgiay');
            $mahk = $data['mahk'];
            $ngayyc = $this->my_auth->setDate();
            $rs = $this->mgiayxn->luuYeuCau($this->sv_id, $arr, $ngayyc, $mahk);
            if($rs) {
                $mayc = $this->mgiayxn->getMaYC($this->sv_id,$ngayyc);
                redirect('sinhvien/xemyeucau/'.$mayc);
            } else {
                $data['error'] = '0';
            }
        }
        $this->load->view("home/sv_layout",$data);
    }
    /**
     * Danh sách các giấy yêu cầu được cấp
     * 
     **/
    public function dsYeuCau()
    {
        if(!$this->my_auth->is_SinhVien()) {redirect("sinhvien/login");}//check login
        if(!$this->mgiayxn->listYCCG($this->sv_id)) {
            $data['url'] = $this->sv_url;
            $data['error'] = '100';
            $this->load->view('home/error', $data);
            return false; 
        }
        $data['sv_id']      =   $this->sv_id;
        $data['sv_name']    =   $this->sv->hoten;
        $data['sub_views']  =   'gxn_list';
        $data['task_name']  =   'Danh sách yêu cầu cấp giấy';
        
        $max = count($this->mgiayxn->listYCCG($this->sv_id)); //count rows posts
        $min = 10;
        $cf['base_url']      = $this->sv_url.'/dsyeucau';
        $cf['total_rows']    = $max;
        $cf['per_page']      = $min;
        $cf['num_link']      = 2;
        $cf['uri_segment']   = 3;
        $this->pagination->initialize($cf);

        $data['list_yccg']  =   $this->mgiayxn->listYCCG($this->sv_id,false,$min,$this->uri->segment($cf['uri_segment']));
        $data['page_link'] = $this->pagination->create_links();
        
        $this->load->view('home/sv_layout',$data);
    }
    /**
     * Xem chi tiết yêu cầu cấp giấy
     **/
    public function xemYeuCau($mayc = 0)
    {
        if(!$this->my_auth->is_SinhVien()) {redirect("sinhvien/login");}//check login
        if(!$this->mgiayxn->xemChiTietYCCG($mayc) || !$this->mgiayxn->checkYCCG($this->sv_id,$mayc)) {
            $data['error'] = "100";
            $data['url']    = $this->sv_url;
            $this->load->view('home/error', $data);
            return false; 
        }
        $data['mayc']       = $mayc;
        $data['sv_id']      =   $this->sv_id;
        $data['sv_name']    =   $this->sv->hoten;
        $data['sub_views']  =   'gxn_xem';
        $data['task_name']  =   'Chi tiết yêu cầu cấp giấy';
        $data['list_info']  =   $this->mgiayxn->listYCCG($this->sv_id, $mayc);
        $data['list_detail']  =   $this->mgiayxn->xemChiTietYCCG($mayc); //xem(MaSV, YCC))
        
        $this->load->view('home/sv_layout',$data);

    } 
    /**
     * Hàm in giấy xác nhận
     * @param $mayc, $maLG
     * 
     */
    public function kiemTraGXN($mayc, $malg)
    {
        if(!$this->my_auth->is_SinhVien()) {redirect("sinhvien/login");}
        $data['sv_id']      =   $this->sv_id;
        $data['sv_name']    =   $this->sv->hoten;
        $data['yeucau'] = array('mayc'=>$mayc,'lg'=>$malg);
        $ct = $this->mgiayxn->xemChiTietYCCG($mayc); //lay thong tin ma yeu cau cap giay
        $masv = $ct[0]['masv']; $mahk = $ct[0]['mahk']; //lay ma sinh vien, ma hoc ky yeu cau
        $sv   = $this->msinhvien->setInfo($masv); //Toan bo thong tin cua sinh vien
        $tt_sv = $this->mgiayxn->checkTTSV($masv, $mahk); //lay trang thai cua sinh vien
        $add = $this->maddress->getAddress($sv->maphuong); //lay dia chi cua sinh vien
        
        if(!$this->mgiayxn->checkLG($mayc, $malg, $mahk) || !$this->mgiayxn->checkYCCG($this->sv_id,$mayc)) { //kiem tra xem co ton tai loai giay trong yccg hay k
            $data['error'] = '100';
            $data['url']    = $this->sv_url.'/yeucaucapgiay';
            $this->load->view('home/error', $data);
            return false;
        }
        if($tt_sv==-2) { //kiem tra trang thai cua SV
            $data['error'] = '103';
            $data['url']    = $this->sv_url.'/yeucaucapgiay';
            $this->load->view('home/error', $data);
            return false;
        }
        
        $solanin= $this->mgiayxn->checkGiay($masv, $mahk, $malg);
        if(!is_array($solanin)) $data['solanin'] = 0;
        else $data['solanin']   = $solanin['SoLanCap'];
        
        $data['type']       =   $malg;
        $data['sinhvien']   =   $sv;
        $data['mahk']       =   $mahk;
        $data['namhoc']     =   "20".substr($mahk,1,2);
        $data['address']    =   $add;
        
        switch($malg)
        {
            case '1':
                $data['task_name']  =   "Xem thông tin giấy Hoãn nghĩa Vụ Quân Sự";
                $data['sub_views']  =   "gxn_xem_qs";
                if($tt_sv == 1) $data['trangthai'] = 1;
                else $data['trangthai'] =   0;
                break;
            case '2':
                $data['task_name']  =   "Xem thông tin giấy Vay vốn";
                $data['sub_views']  =   "gxn_xem_vv";
                break;
            case '3':
                $data['task_name']  =   "Xem thông tin giấy Miễn giảm học phí";
                $data['sub_views']  =   "gxn_xem_mg";
                break;
            default :
                $data['url']    = $this->sv_url.'/xemyeucau/'.$mayc;
                $this->load->view('home/error', $data);
                break;
        }
        $this->load->view('home/sv_layout',$data);
    }
    /**
     *  Huy giay xac nhan
     */
    public function huyGXN($mayc, $malg=0)
    {
        if(!$this->my_auth->is_SinhVien()) {redirect("sinhvien/login");}
        $data['cb_id']      =   $this->sv_id;
        $data['cb_name']    =   $this->sv->hoten;
        $data['task_name']  =   "Hủy yêu cầu in giấy xác nhận";
        $data['yeucau'] = array('mayc'=>$mayc,'lg'=>$malg);
        $ct     = $this->mgiayxn->xemChiTietYCCG($mayc); //lay thong tin ma yeu cau cap giay
        $masv   = $ct[0]['masv']; $mahk = $ct[0]['mahk']; //lay ma sinh vien, ma hoc ky yeu cau
        $ngayxn = $this->my_auth->setDate();
        //huy bo yeu cau
        if(!$this->mgiayxn->checkLG($mayc, $malg, $mahk)) { //kiem tra xem co ton tai loai giay trong yccg hay k
            $data['error'] = '100';
        } else {
            $this->mgiayxn->xoaLG($mayc, $malg, $mahk);
            $data['error'] = '202';
        }
        $data['url']    = $this->sv_url.'/dsyeucau';
        $this->load->view('home/error', $data);
    }
    /**
     * Xoa Yeu Cau Cap Giay
     */
    public function xoaGXN($mayc)
    {
        if(!$this->my_auth->is_SinhVien()) {redirect("sinhvien/login");}
        $data['sv_id']      =   $this->sv_id;
        $data['sv_name']    =   $this->sv->hoten;
        $data['sub_views']  =   'gxn_xoa';
        $data['mayc'] = $mayc;
        $data['task_name']  =   "Xóa yêu cầu in giấy xác nhận";
        if(!$this->mgiayxn->checkYCCG($this->sv_id,$mayc))
        {
            $data['error'] = '100';
            $data['url']    = $this->sv_url.'/dsyeucau';
            $this->load->view('home/error', $data);
            return false;
        }
        $ct     = $this->mgiayxn->xemChiTietYCCG($mayc); //lay thong tin ma yeu cau cap giay
        $mahk = $ct[0]['mahk']; //lay ma sinh vien, ma hoc ky yeu cau
        if($this->input->post('delete'))
        {
            if(!$this->mgiayxn->checkYCCG($this->sv_id,$mayc))
            {
                $data['error'] = '100'; 
            } else {
                $this->mgiayxn->deleteYCCG($this->sv_id, $mayc, $mahk);
                $data['error'] = '202';
                $data['url'] = 'sinhvien/dsyeucau';
            }
            $this->load->view('home/error', $data);
            return false;
        }
        $this->load->view('home/sv_layout',$data);
    }

    /**
     * Thêm đia chỉ ngoại trú
     * */
    
    public function addNgoaiTru()
    {
        if(!$this->my_auth->is_SinhVien()) {redirect("sinhvien/login");}//check login
        
        $data['sv_id']      =   $this->sv_id;
        $data['sv_name']    =   $this->sv->hoten;
        $data['sub_views']  =   'nt_add';
        $data['task_name']  =   "Thêm địa chỉ ngoại trú";
        $data['ds_quan']    =   $this->maddress->htmlQuan(48); //48 = Đà Nẵng
        $data['mahk']   = $this->mhocky->getMHK();
        $data['error'] = '0';
        if($this->input->post('add') != "")
        {
            $input = $this->input->post();
            $ngayden = $this->my_auth->cvDdate($input['ngayden']);
            $ngaydi = (strlen($input['ngaydi']) > 5 )? $this->my_auth->cvDdate($input['ngaydi']) : NULL;
            $arr = array(
                'MaSV' => $this->sv_id,
                'TenChuTro' =>  htmlspecialchars($input['ten']),
                'DienThoai' =>  htmlspecialchars($input['sodt']),
                'DiaChi'    =>  htmlspecialchars($input['diachi']),
                'MaPhuong'  =>  htmlspecialchars($input['phuong']),
                'NgayDen'   =>  $ngayden,
                'NgayDi'    =>  $ngaydi,
                'MaHK'      =>  $data['mahk']
            );
            $data['ds_quan']    =   $this->maddress->htmlQuan(48,0,$input['quan']); //48 = Đà Nẵng
            $data['ds_phuong']  =   $this->maddress->htmlPhuong($input['quan'],0,$input['phuong']);
            if($this->mngoaitru->checkAdd($this->sv_id,$ngayden))
            {
                $rs = $this->mngoaitru->add($arr);
                if($rs)
                    $data['error'] = '1';
                else
                    $data['error'] = '-2';
            } else {
                $data['error'] = '-1';
            }
            $data['input']   = $input;
        }
        $this->load->view('home/sv_layout',$data);
   
    }
    /**
     * Xem địa chỉ ngoại trú trước khi thêm
     */
    
    public function vaddNgoaiTru()
    {
        if(!$this->my_auth->is_SinhVien()) {redirect("sinhvien/login");}//check login
        
        $data['sv_id']      =   $this->sv_id;
        $data['sv_name']    =   $this->sv->hoten;
        $data['sub_views']  =   'nt_xem_add';
        $data['task_name']  =   "Kiểm tra thông tin địa chỉ ngoại trú";
        $data['ds_quan']    =   $this->maddress->htmlQuan(48); //48 = Đà Nẵng
        $data['mahk']   = $this->mhocky->getMHK();
        $data['error'] = '0';
        if($this->input->post('add') != "")
        {
            $input = $this->input->post();
            $quan       =   $this->maddress->dsQuan(0,$input['quan']);
            $phuong     =   $this->maddress->dsPhuong(0,$input['phuong']);
            $data['input']      = $input;
            $data['input']['tquan'] = $quan[0]['tenquan'];
            $data['input']['tphuong'] = $phuong[0]['tenphuong'];
        } else {
            redirect('sinhvien/addngoaitru');
        }
        $this->load->view('home/sv_layout',$data);
    }
    
    /**
     * Xem danh sach ngoai tru
     **/
    public function dsNgoaiTru()
    {
        if(!$this->my_auth->is_SinhVien()) {redirect("sinhvien/login");}//check login
        if(!$this->mngoaitru->danhsach($this->sv_id)) {
            $data['error'] = "100";
            $data['url'] = $this->sv_url;
            $this->load->view('home/error', $data);
            return false;
        }
        //var_dump($this->mngoaitru->danhsach($this->sv_id));
        $data['sv_id']      =   $this->sv_id;
        $data['sv_name']    =   $this->sv->hoten;
        $data['sub_views']  =   'nt_list';
        $data['task_name']  =   "Danh sách ngoại trú";
        $data['ds_nt']      =   $this->mngoaitru->danhsach($this->sv_id);
        $this->load->view('home/sv_layout',$data);
    }
    
    /**
     * Edit, Delete dia chi ngoại tru
     */    
    
    public function editNgoaiTru($action, $mant)
    {
        if(!$this->my_auth->is_SinhVien()) {redirect("sinhvien/login");}//check login
        $data['sv_id']      =   $this->sv_id;
        $data['sv_name']    =   $this->sv->hoten;
        $data['task_name']  =   "Cập nhật thông tin ngoại trú";
        $data['error'] = "";
        if(!$this->mngoaitru->checkMNT($this->sv_id, $mant)) {
            $data['error'] = "100";
            $data['url'] = $this->sv_url.'/dsngoaitru';
            $this->load->view('home/error', $data);
            return false;
        }
        $data['nt']         =   $this->mngoaitru->infoNT($this->sv_id,$mant);
        if($data['nt']['NgayDi'] != "") redirect('sinhvien/dsngoaitru');
        $phuong = $this->maddress->dsPhuong(0,$data['nt']['MaPhuong']);
        if($action=='edit') {
            $data['sub_views']  =   'nt_edit'; //file temp
            $quan     =   $this->maddress->dsQuan(0,$phuong[0]['maquan']); //48 = Đà Nẵng
            $data['nt']['tquan']    =   $quan[0]['tenquan'];
            $data['nt']['maquan']    =   $quan[0]['maquan'];
            $data['nt']['tphuong']  =   $phuong[0]['tenphuong'];
            $data['nt']['maphuong']  =   $phuong[0]['maphuong'];          
            if($this->input->post('update')!="")
            {
                $input = $this->input->post();
                $ngayden = $this->my_auth->cvDdate($input['ngayden']);
                $ngaydi = (strlen($input['ngaydi']) > 5 )? $this->my_auth->cvDdate($input['ngaydi']) : NULL;
                $arr = array(
                    'TenChuTro' =>  addslashes($input['ten']),
                    'DienThoai' =>  addslashes($input['sodt']),
                    'DiaChi'    =>  addslashes($input['diachi']),
                    'MaPhuong'  =>  addslashes($input['phuong']),
                    'NgayDen'   =>  $ngayden,
                    'NgayDi'    =>  $ngaydi
                );
                $kq = $this->mngoaitru->update($mant,$arr);
                if($kq) $data['error'] = 1;
                else $data['error'] = -1;
            }
        } elseif($action=='delete') {
            $data['sub_views']  =   'nt_del'; //file temp
            $quan    =   $this->maddress->dsQuan(0,$phuong[0]['maquan']); //48 = Đà Nẵng
            $data['ds_quan'] = $quan[0]['tenquan'];
            $data['ds_phuong']  =   $phuong[0]['tenphuong'];
            if($this->input->post('delete')!="")
            {
                //$this->mngoaitru->delete($mant);
                $data['error'] = 999;
                $data['url'] = $this->sv_url.'/dsngoaitru';
                $this->load->view('home/error', $data);
                return false;
            }
        }
        $this->load->view('home/sv_layout',$data);   
    }
    /**use for ajax load**/
    function ajaxTinh($matinh = 0)
    {
        echo $this->maddress->htmlTinh($matinh);
    }
    function ajaxQuan($matinh = 0)
    {
        echo $this->maddress->htmlQuan($matinh);
    }
    function ajaxPhuong($maquan = 0)
    {
        echo $this->maddress->htmlPhuong($maquan);
    }
    /*************************************************************************************
                                    Quản lý tài khoản
    *************************************************************************************/
    /**
     * Xem diem ren luyen
     */
    public function xemDRL()
    {
        if(!$this->my_auth->is_SinhVien()) {redirect("sinhvien/login");}//check login
        $data['sv_id']      =   $this->sv_id;
        $data['sv_name']    =   $this->sv->hoten;
        $data['sub_views']  =   'drl_xem';
        $data['task_name']  =   "Xem bảng điểm rèn luyện";
        $drl                =   $this->mrenluyen->svDRL($this->sv_id);
        if(!$drl) {
            $data['error'] = 300;
            $this->load->view('home/error',$data);
            return false;
        } else $data['drl'] = $drl;
        $this->load->view('home/sv_layout',$data);
        
    }
    /*************************************************************************************
                                    Quản lý tài khoản
    *************************************************************************************/

    /**
     * Cập nhật Thông tin sinh viên
     * 
     */
    public function updateInfo()
    {
        if(!$this->my_auth->is_SinhVien()) {redirect("sinhvien/login");}//check login
        
        $data['sv_id']      =   $this->sv_id;
        $data['sv_name']    =   $this->sv->hoten;
        $data['sub_views']  =   'sv_info';
        $data['task_name']  =   "Cập nhật thông tin";
        $data['sv']         =   $this->sv;
        
        if($this->input->post("update") != "")
        {
            $arr = $this->input->post();
            $info = array(
                'diachi'    =>  $arr['diachi'],
                'maphuong'  =>  $arr['phuong'],
                'cmnd'      =>  $arr['cmnd'],
                'ngaycap'   =>  $arr['ngaycap'],
                'noicap'    =>  $arr['noicap'],
                'hotencha'  =>  $arr['hotencha'],
                'hotenme'   =>  $arr['hotenme'],
                'manghecha' =>  $arr['manghecha'],
                'mangheme'  =>  $arr['mangheme']
            );
            $this->msinhvien->upInfo($this->sv_id,$info);
            $dt['error'] = "111";
            $dt['url'] = $this->sv_url.'/updateinfo';
            $this->load->view('home/error', $dt);
            return false;
        }
        
        
        $phuong = $this->maddress->dsPhuong(0,$this->sv->maphuong);
        $quan   = $this->maddress->dsQuan(0,$phuong[0]['maquan']);
        $tinh   = $this->maddress->dsTinh($quan[0]['matinh']);
        
        $data['tinh']   = $this->maddress->htmlTinh(0,$tinh[0]['matinh']);
        $data['quan']   = $this->maddress->htmlQuan($tinh[0]['matinh'],0,$quan['0']['maquan']);
        $data['phuong'] = $this->maddress->htmlPhuong($quan[0]['maquan'],0,$phuong['0']['maphuong']);
        $data['diachi'] = $phuong[0]['tenphuong'] .' - '.$quan[0]['tenquan'].' - '.$tinh[0]['tentinh'];
        //var_dump($phuong,$quan,$tinh);
        
        $this->load->view('home/sv_layout',$data);
        
    }

    /**
     * Cập nhật đối tượng
     */
     
    public function doiTuong()
    {
        if(!$this->my_auth->is_SinhVien()) {redirect("sinhvien/login");}//check login
        
        $data['sv_id']      =   $this->sv_id;
        $data['sv_name']    =   $this->sv->hoten;
        $data['sub_views']  =   'sv_doituong';
        $data['task_name']  =   "Cập nhật đối tượng";
        $data['doituong']   =   $this->msinhvien->htmlDoiTuong($this->sv->doituong);
        if($this->input->post('update'))
        {
            $dt = array('DoiTuong' => implode(',',$this->input->post('doituong')));
            $this->msinhvien->upDoiTuong($this->sv_id,$dt);
            $data['stt'] = 1;
            $data['dd'] = $this->input->post('doituong');
        }         
        if($this->input->post('ajax')!="") {
            echo json_encode($data);
        } else {
            $this->load->view("home/sv_layout",$data);
        }
    }
    
    public function ajaxDoiTuong() {
        echo $this->msinhvien->htmlDoiTuong($this->sv->doituong);
    }
    
    /**
     * Doi mat khau
     */
    public function changePass()
    {
        if(!$this->my_auth->is_SinhVien()) {redirect("sinhvien/login");}//check login
        $data['sv_id']      =   $this->sv_id;
        $data['sv_name']    =   $this->sv->hoten;
        $data['task_name']  =   "Thay đổi mật khẩu";
        $opass              =   $this->sv->getMatKhau();
        if($this->input->post('done'))
        {
            $pass = md5($this->input->post('pass'));
            $newpass = md5($this->input->post('newpass'));
            $repass = md5($this->input->post('repass'));
            if($pass == $opass) {
                if($newpass == $repass and strlen($newpass) >4) {
                    $this->msinhvien->changePass($this->sv_id,$newpass);
                    $this->session->sess_destroy();
                    $err['error'] = 111;
                } else {
                    $err['error'] = 400;
                }
            } else {
                $err['error'] = 401;
            }
            $err['url'] = $this->sv_url.'/changepass';
            $this->load->view('home/error',$err);
            return false;
        } else {
            $data['sub_views']  =   'sv_cpass';
        }
        $this->load->view('home/sv_layout',$data);
    }
    /*************************************************************************************
                                    Quản lý phòng ký túc xá
    *************************************************************************************/
    /**
     * Đăng ký phòng ký túc xá
     * */

    public function dsPhongTrong(){
        if(!$this->my_auth->is_SinhVien()) {redirect("sinhvien/login");}//check login
        $data['sv_id']      =   $this->sv_id;
        $data['sv_name']    =   $this->sv->hoten;
        $data['sub_views']  =   'ktx_add';
        $data['task_name']  =   "Đăng ký phòng ký túc xá";
        $this->load->model('mktx');
        $tt = $this->mktx->svTinhTrangDKP($data['sv_id']);
        switch($tt){
            case 1:
                $data['message_chuaxn'] ="Bạn đã đăng ký phòng, vui lòng chờ xác nhận";
                $this->load->view('home/sv_layout',$data);
                break;
            case 0:
                $data['message_daxn'] ="Bạn đã đăng ký ở thành công phòng ký túc xá</br><h5>Sau đây là thông tin phòng của bạn</h5>";
                $data['data']=$this->mktx->svTinhTrangPhongKTX($data['sv_id']);
                $this->load->view('home/sv_layout',$data);
                break;
            case -1:
                $data['sex'] = $this->mktx->checkSex($data['sv_id']);
                $data['phong']=$this->mktx->getKtxPhong();
                $data['dsphong']=$this->mktx->danhSachPhongTrong();
                $this->load->view('home/sv_layout',$data);  
                break;
        }
    }
    
    public function svDkPhong(){
        if(!$this->my_auth->is_SinhVien()) {redirect("sinhvien/login");}//check login
        $data['sv_id']      =   $this->sv_id;
        $data['sv_name']    =   $this->sv->hoten;
        $data['sub_views']  =   'ktx_mesage';
        $data['task_name']  =   "Đăng ký phòng ký túc xá";
        $data['mg_sc'] = "Đăng ký thành công, xin đợi cán bộ phê duyệt";
        $maphong= $this->uri->segment(3,0);
        $this->load->Model('mktx');
        $tt = $this->mktx->svTinhTrangDKP($data['sv_id']);
        switch($tt){
            case 1:
                $data['message_chuaxn'] ="Bạn đã đăng ký phòng, vui lòng chờ xác nhận";
                $this->load->view('home/sv_layout',$data);
                break;
            case 0:
                $data['message_daxn'] ="Bạn đã đăng ký ở thành công phòng ký túc xá</br><h5>Sau đây là thông tin phòng của bạn</h5>";
                $data['data']=$this->mktx->svTinhTrangPhongKTX($data['sv_id']);
                $this->load->view('home/sv_layout',$data);
                break;
            case -1:
                $mahk=$this->mktx->layMaHk();
                $this->mktx->svDkPhong($data['sv_id'],$maphong,$mahk);
                $this->load->view('home/sv_layout',$data);
                break;
        }
        //
    }
    // lịch sử đăng ký phòng
    public function lsDkPhong(){
        if(!$this->my_auth->is_SinhVien()) {redirect("sinhvien/login");}//check login
        $data['sv_id']      =   $this->sv_id;
        $data['sv_name']    =   $this->sv->hoten;
        $data['sub_views']  =   'ktx_sv_lsdkp';
        $data['task_name']  =   "Đăng ký phòng ký túc xá";
        $this->load->model('mktx');
        $data['data']=$this->mktx->flsDkPhong($data['sv_id']);
        $this->load->view('home/sv_layout',$data);
    }


    // chuyển phòng
    public function chuyenPhong(){
        if(!$this->my_auth->is_SinhVien()) {redirect("sinhvien/login");}//check login
        $data['sv_id']      =   $this->sv_id;
        $data['sv_name']    =   $this->sv->hoten;
        $data['sub_views']  =   'ktx_sv_chuyenphong';
        $data['task_name']  =   "Đăng ký chuyển phòng ký túc xá";
        $this->load->model('mktx');
        $id=$this->mktx->svDkLanCuoi($data['sv_id']);
        if($id==false || $id[0]['maxid']=='NULL'){
            $data['mesage']='chuadkphong';
            $this->load->view('home/sv_layout',$data);
        }
        else{
            $checkdadk=$this->mktx->checkSvDaDkChuyenPhong($id[0]['maxid']);
            $tt = $this->mktx->svTinhTrangDKP($data['sv_id']);
            if($tt==-1 || $tt == 1){
                $data['mesage'] ='chuadkphong';
                $this->load->view('home/sv_layout',$data);
            }
            if($tt== 0){
                if($checkdadk== true){
                    $data['mesage']='dadkchuyen';
                    $this->load->view('home/sv_layout',$data);      
                }
                else{
                    $data['maphong']=$this->mktx->svMaPhongLanCuoi($id[0]['maxid']);
                    $data['dsphong']=$this->mktx->danhSachPhongTrong();
                    $this->load->view('home/sv_layout',$data);         
                }
            }
        }
    }

    // đăng ký chuyển phòng
    public function dkChuyenPhong(){
        if(!$this->my_auth->is_SinhVien()) {redirect("sinhvien/login");}//check login
        $data['sv_id']      =   $this->sv_id;
        $data['sv_name']    =   $this->sv->hoten;
        $data['sub_views']  =   'ktx_sv_chuyenphong';
        $data['task_name']  =   "Đăng ký chuyển phòng ký túc xá";
        $maphongchuyen = $this->uri->segment(3,0);
        $this->load->model('mktx');
        $id=$this->mktx->svDkLanCuoi($data['sv_id']);
        $rs= $this->mktx->svDkChuyenPhong($maphongchuyen,$id[0]['maxid']);
        if($rs == true){
            $data['mesage']='chuyenthanhcong';
            $this->load->view('home/sv_layout',$data);
        }
        else{
            $data['mesage'] ='chuyenthatbai';
            $this->load->view('home/sv_layout',$data);
        }

    }
    // Hủy đăng ký phòng
    public function svHuyDkPhong(){
        if(!$this->my_auth->is_SinhVien()){redirect("sinhvien/login");}
        $data['sv_id'] = $this->sv_id;
        $data['sv_name']= $this->sv->hoten;
        $data['sub_views']='ktx_sv_huydkphong';
        $data['task_name']='Hủy đăng ký phòng';
        $stt=$this->uri->segment(3);
        if($stt==false){
            $this->load->view('home/sv_layout',$data);  
        }
        elseif($stt='yes'){
            $this->load->model('mktx');
            $id= $this->mktx->svDkLanCuoi($data['sv_id']);
            $this->db->delete('sinhvien_phong',array('Id'=>$id[0]['maxid']));
            $data['mesage']='Hủy thành công';
            $this->load->view('home/sv_layout',$data);
        }
    }
/*************************************************************************************
                                Khac
*************************************************************************************/
/**
 * Phan hoi - dong gop y kien
 * */
    public function sinhvienphanhoi(){
        if(!$this->my_auth->is_SinhVien()){redirect("sinhvien/login");}
        $data['sv_id'] = $this->sv_id;
        $data['sv_name']= $this->sv->hoten;
        $data['sub_views']='v_sinhvien_phanhoi';
        $data['task_name']='Phản hồi - đóng góp ý kiến';        
        $data['max']= $this->mnoitru->count_all_dsphanhoi();
        $data['min'] = 10;
        $cf['base_url']      = base_url('sinhvien/sinhvienphanhoi');
        $cf['total_rows']    = $data['max'];
        $cf['per_page']      = $data['min'];
        $cf['num_link']      = 2;
        $cf['uri_segment']   = 3;
        $this->pagination->initialize($cf);
        $data['ds'] = $this->mnoitru->dsphanhoi($data['min'],$this->uri->segment($cf['uri_segment']));
        $data['page_link'] = $this->pagination->create_links();
        $this->load->view('home/sv_layout',$data);
    }
    public function xemtinphanhoi(){
        if(!$this->my_auth->is_SinhVien()){redirect("sinhvien/login");}
        $data['sv_id'] = $this->sv_id;
        $data['sv_name']= $this->sv->hoten;
        $data['sub_views']='v_xemtin_phanhoi';
        $matin= $this->uri->segment(3);
        if(isset($_POST['xacnhan'])){
           $content = str_replace("\r\n","<br>",$_POST["txtnote"]);
           if($content==''){
                redirect('sinhvien/xemtinphanhoi'.'/'.$matin); 
           }
           else{
                $check = $this->mnoitru->gioihanslblcuasinhvien($data['sv_id'],$matin);
                if($check==false){
                    $ngayupdate = $this->my_auth->setDate();
                    $this->mnoitru->updatephanhoi($_POST['tieude'],$content,$data['sv_id'],$matin,$ngayupdate);
                    unset($_POST['xacnhan']);
                    redirect('sinhvien/xemtinphanhoi'.'/'.$matin);
                }
                else{
                    $this->session->set_flashdata('error', 'Bạn đang bình luận quá nhiều');
                    redirect('sinhvien/xemtinphanhoi'.'/'.$matin);
                }
           }
           
        }
            if($matin >= 0){
            $data['nd'] = $this->mnoitru->xemtinphanhoi($matin);
            $data['ndtraloi'] = $this->mnoitru->traloiphanhoi($matin);
            $data['task_name']='Phản hồi - đóng góp ý kiến';
            $this->load->view('home/sv_layout',$data);
            }
    }
    public function dangtinphanhoi(){
        if(!$this->my_auth->is_SinhVien()){redirect("sinhvien/login");}
        $data['sv_id'] = $this->sv_id;
        $data['sv_name']= $this->sv->hoten;
        $data['sub_views']='v_dangtin_phanhoi';
        $data['task_name']='Phản hồi - đóng góp ý kiến';
        if(isset($_POST['dangtin'])){
           $content = str_replace("\r\n","<br>",$_POST["txtnd"]);
           if($content==''){
                redirect('sinhvien/dangtinphanhoi'); 
           }
           else{
                $check = $this->mnoitru->gioihansltincuasinhvien($data['sv_id']);
                if($check==false){
                    $this->mnoitru->insertphanhoi($_POST['tieude'],$content,$data['sv_id']);
                    unset($_POST['dangtin']);
                    $this->session->set_flashdata('result', 'Bạn đã đăng tin thành công');
                    redirect('sinhvien/sinhvienphanhoi');    
                }
                else{
                    $this->session->set_flashdata('error', 'Bạn đã đăng quá nhiều tin, vui lòng đợi phản hồi');
                    redirect('sinhvien/sinhvienphanhoi');      
                }
           }
                
        }
        $this->load->view('home/sv_layout',$data);
    }

    public function phanhoicuasinhvien(){
        $data['sv_id'] = $this->sv_id;
        $data['sv_name']= $this->sv->hoten;
        $data['sub_views']='v_phanhoi_cua_sinhvien';
        $data['task_name']='Phản hồi - đóng góp ý kiến';        
        $data['max']= $this->mnoitru->count_all_phanhoi_sinhvien($data['sv_id']);
        $data['min'] = 10;
        $cf['base_url']      = base_url('sinhvien/phanhoicuasinhvien');
        $cf['total_rows']    = $data['max'];
        $cf['per_page']      = $data['min'];
        $cf['num_link']      = 2;
        $cf['uri_segment']   = 3;
        $this->pagination->initialize($cf);
        $data['dsphanhoi'] = $this->mnoitru->phanhoicuasinhvien($data['min'],$this->uri->segment($cf['uri_segment']),$data['sv_id']);
        $data['page_link'] = $this->pagination->create_links();
        $this->load->view('home/sv_layout',$data);
    }
    public function xemcohoivieclam(){
            $data['sv_id'] = $this->sv_id;
            $data['sv_name']= $this->sv->hoten;
            $data['sub_views']='v_xemcohoivieclam';
            $data['task_name']='Xem cơ hội việc làm';        
            $data['max']= $this->mtuyendung->all_count_table_thongtin();
            $data['min'] = 15;
            $cf['base_url']      = base_url('sinhvien/xemcohoivieclam');
            $cf['total_rows']    = $data['max'];
            $cf['per_page']      = $data['min'];
            $cf['num_link']      = 2;
            $cf['uri_segment']   = 3;
            $this->pagination->initialize($cf);
            $data['page_link'] = $this->pagination->create_links();
            $dstd = $this->mtuyendung->laydanhsachtintuyendung($data['min'], $this->uri->segment($cf['uri_segment']));
            foreach ($dstd as $k => $v) {
                        $inter_var_ds[] =  array(
                                    'MaSo' => $v['MaSo'],
                                    'TieuDe' => $v['TieuDe'],
                                    'NoiDung' => $v['NoiDung'],
                                    'NgayDangTin' => $v['NgayDangTin'],
                                    $ten = $this->mcanbo->laytencanbo($v['NguoiDangTin']),
                                    'TenCb' => $ten[0]['TenCB'],
                        );
            }
            $data['ds'] = $inter_var_ds;
            $this->load->view('home/sv_layout',$data);
    }
   public function xemtinvieclam(){
            $data['sv_id'] = $this->sv_id;
            $data['sv_name']= $this->sv->hoten;
            $data['sub_views']='v_xemtinvieclam';
            $data['task_name']='Xem cơ hội việc làm';
            $matin = $this->uri->segment(3,0);
            $dstd = $this->mtuyendung->xemtintuyendung($matin);
            if($dstd == ''){
                        $data['error'] = 'Không tìm thấy tin phù hợp' ;
            }
            else{
                        foreach ($dstd as $k => $v) {
                                    $inter_var_ds[] =  array(
                                                'MaSo' => $v['MaSo'],
                                                'TieuDe' => $v['TieuDe'],
                                                'NoiDung' => $v['NoiDung'],
                                                'NgayDangTin' => $v['NgayDangTin'],
                                                $ten = $this->mcanbo->laytencanbo($v['NguoiDangTin']),
                                                'TenCb' => $ten[0]['TenCB'],
                                    );
                        }
                        $data['nd'] = $inter_var_ds;
                        $data['dst'] = $this->mtuyendung->laydanhsachtintuyendung();
            }
            $this->load->view('home/sv_layout',$data);
   }
}//end class