<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CanBo extends CI_Controller
{
    public $cb;
    public $cb_id;
    public $cb_regency;
    public $cb_url;

    public function __construct()
    {
        parent::__construct();

        $this->load->model(array('mcanbo', 'mgiayxn', 'msinhvien', 'maddress', 'mngoaitru', 'mrenluyen', 'mlopsh', 'mktx', 'mnoitru', 'mctdaukhoa', 'mtuyendung'));

        if ($this->my_auth->is_Login()) {
            $this->cb_id = $this->session->userdata('u_id');
            if ($this->mcanbo->setInfo($this->cb_id)) {
                $this->cb = $this->mcanbo->setInfo($this->cb_id);
            } else {
                $this->session->sess_destroy();
                redirect("canbo/login");
            }
        }
        $this->cb_url = base_url('canbo');
    }

    public function index()
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }

        /** info account **/
        $data['cb_id'] = $this->cb->macb;
        $data['cb_name'] = $this->cb->tencb;
        $data['cb_regency'] = $this->cb->chucvu;
        /** Main Task **/

        $this->load->view("home/main_layout", $data);
    }

    /**
     * Can bo dang nhap
     */
    public function login()
    {
        if ($this->my_auth->is_CanBo()) {
            redirect("canbo");
        }
        $data['stt'] = "0";
        if ($this->input->post('login') != "") {
            $user = addslashes(trim($this->input->post('user')));
            $pass = md5($this->input->post('pass'));
            $rs = $this->mcanbo->checkLogin($user, $pass);
            if ($rs) {
                $datass = array(
                    'u_id' => $user,
                    'u_group' => 1,
                    'u_chucvu' => $rs['ChucVu']
                );
                $this->session->set_userdata($datass);
                $data['stt'] = "1";
            } else {
                $data['stt'] = "-1";
            }
        }
        if ($this->input->post('ajax') != "") {
            echo json_encode($data);
        } else {
            $data['sub_views'] = 'canbo/cb_login';
            $this->load->view("home/sub_layout", $data);
        }

    }

    /**
     * Dang xuat
     **/
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('canbo');
    }
    /*************************************************************************************
     * Giấy Xác Nhận
     *************************************************************************************/
    /**
     *  Lấy và hiển thị toàn bộ danh sách yêu cầu cấp giấy của sinh viên
     *
     **/
    public function dsYCCG($tc = false, $lc = false)
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb->macb;
        $data['cb_name'] = $this->cb->tencb;
        $data['sub_views'] = 'gxn_list';
        $data['task_name'] = 'Danh Sách Yêu Cầu Cấp Giấy';
        $tmayc = false;
        $tmasv = false;
        if ($this->input->post('search')) {
            if ($this->input->post('tc') == '1') {
                $tmayc = $this->input->post('key');
                $cf['base_url'] = $this->cb_url . '/dsyccg/' . $this->input->post('tc') . '/' . $tmayc;
            } else {
                $tmasv = $this->input->post('key');
                $cf['base_url'] = $this->cb_url . '/dsyccg/' . $this->input->post('tc') . '/' . $tmasv;
            }
            $cf['uri_segment'] = 5;
        } else {
            $cf['base_url'] = $this->cb_url . '/dsyccg';
            $cf['uri_segment'] = 3;
        }
        if ($tc == 1) {
            $tmayc = $lc;
            $cf['base_url'] = $this->cb_url . '/dsyccg/' . $tc . '/' . $tmayc;
            $cf['uri_segment'] = 5;
        } elseif ($tc == 2) {
            $tmasv = $lc;
            $cf['base_url'] = $this->cb_url . '/dsyccg/' . $tc . '/' . $tmasv;
            $cf['uri_segment'] = 5;
        }
        $max = count($this->mgiayxn->listYCCG($tmasv, $tmayc)); //count rows posts
        $min = 20;
        $cf['total_rows'] = $max;
        $cf['per_page'] = $min;
        $cf['num_link'] = 2;
        $this->pagination->initialize($cf);
        $data['list_yccg'] = $this->mgiayxn->listYCCG($tmasv, $tmayc, $min, $this->uri->segment($cf['uri_segment']));
        if (!$data['list_yccg']) {
            $data['error'] = '100';
            $data['url'] = $this->cb_url . '/dsyccg';
            $this->load->view('home/error', $data);
            return false;
        }
        $data['page_link'] = $this->pagination->create_links();

        $this->load->view("home/main_layout", $data);
    }

    /**
     * Xem chi tiết yêu cầu cấp giấy
     **/
    public function xemYCCG($mayc = 0)
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        if (!$this->mgiayxn->xemChiTietYCCG($mayc)) {
            $data['error'] = "100";
            $data['url'] = $this->cb_url;
            $this->load->view('home/error', $data);
            return false;
        }
        $data['cb_id'] = $this->cb_id;
        $data['cb_name'] = $this->cb->tencb;
        $data['sub_views'] = 'xemyccg';
        $data['task_name'] = 'Chi tiết yêu cầu cấp giấy';
        $data['mayc'] = $mayc;
        $data['list_info'] = $this->mgiayxn->listYCCG(false, $mayc);
        $data['list_detail'] = $this->mgiayxn->xemChiTietYCCG($mayc);
        $sinhvien = $this->msinhvien->getInfo($data['list_info'][0]['masv']);
        $data['sv_id'] = $sinhvien['MaSV'];
        $data['sv_name'] = $sinhvien['HoTen'];

        $this->load->view('home/main_layout', $data);

    }

    /**
     * Can bo gui yeu cau cap giay xac nhan
     *
     **/
    public function yccGXN()
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb_id;
        $data['cb_name'] = $this->cb->tencb;
        $data['task_name'] = "In giấy xác nhận";
        $data['sub_views'] = "gxn_in";

        $data['listGXN'] = $this->mgiayxn->listGXN();
        $data['mahk'] = $this->mhocky->getMHK();

        $this->load->view('home/main_layout', $data);
    }

    /**
     * Xac nhan va in giay xac nhan
     **/
    public function checkYCCGXN()
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb_id;
        $data['cb_name'] = $this->cb->tencb;
        $data['task_name'] = "Kiểm tra yêu cầu cấp giấy";
        $data['sub_views'] = "gxn_in";

        $data['listGXN'] = $this->mgiayxn->listGXN();
        $data['mahk'] = $this->mhocky->getMHK();

        if ($this->input->post('send') != "") {
            $arr = $this->input->post('lgiay');
            //var_dump($arr);
            $masv = $this->input->post('masv');
            $mahk = $this->input->post('mahk');
            $ngayyc = $this->my_auth->setDate();//lay gia tri ngay hien gio hien tai
            $rs = $this->mgiayxn->luuYeuCau($masv, $arr, $ngayyc, $mahk); //luu thong tin yeu cau
            if ($rs) {
                $mayc = $this->mgiayxn->getMaYC($masv, $ngayyc);
                redirect("canbo/xemYCCG/" . $mayc);
            } else {
                $data['error'] = "101";
                $data['url'] = $this->cb_url . '/yccgxn';
                $this->load->view('home/error', $data);
                return false;
            }
        }
        $this->load->view('home/main_layout', $data);
    }

    /**
     * Hàm in giấy xác nhận
     * @param $mayc , $maLG
     *
     */

    public function kiemTraGXN($mayc, $malg)
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb_id;
        $data['cb_name'] = $this->cb->tencb;
        $data['task_name'] = "Kiểm tra thông tin giấy xác nhận";
        $data['yeucau'] = array('mayc' => $mayc, 'lg' => $malg);
        $ct = $this->mgiayxn->xemChiTietYCCG($mayc); //lay thong tin ma yeu cau cap giay
        $masv = $ct[0]['masv'];
        $mahk = $ct[0]['mahk']; //lay ma sinh vien, ma hoc ky yeu cau
        $sv = $this->msinhvien->setInfo($masv); //Toan bo thong tin cua sinh vien
        $tt_sv = $this->mgiayxn->checkTTSV($masv, $mahk); //lay trang thai cua sinh vien
        $add = $this->maddress->getAddress($sv->maphuong); //lay dia chi cua sinh vien

        if (!$this->mgiayxn->checkLG($mayc, $malg, $mahk)) { //kiem tra xem co ton tai loai giay trong yccg hay k
            $data['error'] = '100';
            $data['url'] = $this->cb_url . '/yccgxn';
            $this->load->view('home/error', $data);
            return false;
        }
        if ($tt_sv == -2) { //kiem tra trang thai cua SV
            $data['error'] = '103';
            $data['url'] = $this->cb_url . '/yccgxn';
            $this->load->view('home/error', $data);
            return false;
        }

        $solanin = $this->mgiayxn->checkGiay($masv, $mahk, $malg);
        if (!is_array($solanin)) $data['solanin'] = 0;
        else $data['solanin'] = $solanin['SoLanCap'];

        $data['type'] = $malg;
        $data['sinhvien'] = $sv;
        $data['mahk'] = $mahk;
        $data['namhoc'] = "20" . substr($mahk, 1, 2);
        $data['address'] = $add;
        switch ($malg) {
            case '1':
                $data['task_name'] = "Xem thông tin giấy Hoãn nghĩa Vụ Quân Sự";
                $data['sub_views'] = "gxn_xem_qs";
                if ($tt_sv == 1) $data['trangthai'] = 1;
                else $data['trangthai'] = 0;
                break;
            case '2':
                $data['task_name'] = "Xem thông tin giấy Vay vốn";
                $data['sub_views'] = "gxn_xem_vv";
                break;
            case '3':
                $data['task_name'] = "Xem thông tin giấy Miễn giảm học phí";
                $data['sub_views'] = "gxn_xem_mg";
                break;
            default :
                $data['url'] = $this->cb_url . '/xemyccg/' . $mayc;
                $this->load->view('home/error', $data);
                break;
        }
        $this->load->view('home/main_layout', $data);
    }

    /**
     *  Huy giay xac nhan
     */
    public function huyGXN($mayc, $malg)
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb_id;
        $data['cb_name'] = $this->cb->tencb;
        $data['yeucau'] = array('mayc' => $mayc, 'lg' => $malg);
        $ct = $this->mgiayxn->xemChiTietYCCG($mayc); //lay thong tin ma yeu cau cap giay
        $masv = $ct[0]['masv'];
        $mahk = $ct[0]['mahk']; //lay ma sinh vien, ma hoc ky yeu cau
        $sv = $this->msinhvien->setInfo($masv); //Toan bo thong tin cua sinh vien
        $tt_sv = $this->mgiayxn->checkTTSV($masv, $mahk); //lay trang thai cua sinh vien
        $ngayxn = $this->my_auth->setDate();
        $data['task_name'] = "Hủy giấy xác nhận";
        $this->mgiayxn->huyYCCG($mayc, $malg, $mahk, $ngayxn);
        $data['error'] = '202';
        $data['url'] = $this->cb_url . '/xemyccg/' . $mayc;
        $this->load->view('home/error', $data);
    }

    /**
     * Luu va in giay xac nhan
     */
    public function inGXN($mayc, $malg)
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb_id;
        $data['cb_name'] = $this->cb->tencb;
        $data['yeucau'] = array('mayc' => $mayc, 'lg' => $malg);
        $data['task_name'] = "In giấy xác nhận";
        $ct = $this->mgiayxn->xemChiTietYCCG($mayc); //lay thong tin ma yeu cau cap giay
        $masv = $ct[0]['masv'];
        $mahk = $ct[0]['mahk']; //lay ma sinh vien, ma hoc ky yeu cau
        $sv = $this->msinhvien->setInfo($masv); //Toan bo thong tin cua sinh vien
        $tt_sv = $this->mgiayxn->checkTTSV($masv, $mahk); //lay trang thai cua sinh vien
        if ($tt_sv == -2) {
            $data['error'] = '103';
            $data['url'] = $this->cb_url . '/yccgxn';
            $this->load->view('home/error', $data);
            return false;
        }

        $add = $this->maddress->getAddress($sv->maphuong); //lay dia chi cua sinh vien
        $ngayxn = $this->my_auth->setDate();
        $data['sinhvien'] = $sv;
        $data['mahk'] = $mahk;
        $data['namhoc'] = "20" . substr($mahk, 1, 2);
        $data['address'] = $add;
        $kq = $this->mgiayxn->xnYeuCau($masv, $mayc, $malg, $mahk, $ngayxn, 1);
        if (is_array($kq)) $data['maxn'] = $kq['MaXN'];
        else $data['maxn'] = $kq;
        $data['ngayxn'] = array(
            'ngay' => date('d', strtotime($ngayxn)),
            'thang' => date('m', strtotime($ngayxn)),
            'nam' => date('Y', strtotime($ngayxn))
        );
        switch ($malg) {
            case '1':
                $maugiay = 'nvqs';
                break;
            case '2':
                $maugiay = 'giayvv';
                break;
            case '3':
                $data['doituong'] = $this->msinhvien->htmlDoiTuong($sv->doituong);
                $maugiay = 'mghp';
                break;
            default :
                $data['url'] = $this->cb_url . '/yccgxn';
                $this->load->view('home/error', $data);
                break;
        }
        $this->load->view('home/maugiay/' . $maugiay, $data);
    }

    /*************************************************************************************
     * Noi Tru
     *************************************************************************************/
    /**
     * Danh sach sinh vien noi tru
     *
     **/

    public function dssvNoiTru()
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb_id;
        $data['cb_name'] = $this->cb->tencb;
        $data['task_name'] = "Danh sách sinh viên nội trú";
        $data['sub_views'] = "v_dssvnoitru";
        $data['dssvnoitru'] = $this->mnoitru->dssvnoitru();
        $this->load->view('home/main_layout', $data);
    }

    /**
     * Danh sach sinh vien noi tru
     *
     **/
    public function tksvnoitru()
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb_id;
        $data['cb_name'] = $this->cb->tencb;
        $data['task_name'] = "Tìm kiếm sinh viên nội trú";
        $data['sub_views'] = "v_timkiemsvnoitru";
        $data['ds_quan'] = $this->maddress->htmlQuan(48); //48 = Đà Nẵng
        $data['lopsh'] = $this->mlopsh->dsLopSH();
        $this->load->view('home/main_layout', $data);
    }

    // bao cao danh sach sinh vien noi tru theo ten
    public function thongKeDsSvNoiTruTheoTen($tc, $nd)
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        if ($tc == '1') {
            $data['sv'] = $this->msinhvien->setInfo($nd); //Toan bo thong tin cua sinh vien
            $data['sub_views'] = "bc_tk_masv_noitru";
        } else {
            $data['sub_views'] = "bc_tk_tensv_noitru";
            $nd = utf8_urldecode($nd);
        }
        $data['nd'] = $nd;
        $data['kqtk'] = $this->mnoitru->timSvNoiTru($tc, $nd);
        $this->load->view('home/maugiay/' . $data['sub_views'], $data);
    }

    // tim kiem theo thong tin sinh vien noi tru
    public function timKiemTheoThongTinSv()
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb_id;
        $data['cb_name'] = $this->cb->tencb;
        $data['task_name'] = "Kết quả tìm kiếm thông tin nội trú";
        if ($this->input->post('searchsvnoitru') != "") {
            $tc = $this->input->post('tc');
            $nd = addslashes(trim($this->input->post('txtsv')));
        } else {
            $nd = utf8_urldecode($nd);
        }
        if ($tc != "" and $nd != '') {
            if ($tc == '1') {
                $data['sv'] = $this->msinhvien->setInfo($nd); //Toan bo thong tin cua sinh vien
                $data['sub_views'] = "v_tk_msv_noitru";
            } else {
                $data['sub_views'] = "v_tk_tsv_noitru";
            }
            $data['tc'] = $tc;
            $data['nd'] = $nd;
            $data['min'] = 20;
            $config['base_url'] = site_url(base_url());
            $cf['base_url'] = site_url('canbo/tksvnoitru/' . $tc . '/' . $nd);
            $cf['per_page'] = $data['min'];
            $cf['num_link'] = 2;
            $cf['uri_segment'] = 6;
            $this->pagination->initialize($cf);
            $data['kqtk'] = $this->mnoitru->timSvNoiTru($tc, $nd, $data['min'], $this->uri->segment($cf['uri_segment']));
            $data['max'] = count($this->mnoitru->timSvNoiTru($tc, $nd, $data['min'], $this->uri->segment($cf['uri_segment'])));
            $cf['total_rows'] = $data['max'];
            $data['page_link'] = $this->pagination->create_links();
            if (!$data['kqtk']) {
                $data['error'] = '300';
                $data['url'] = $this->cb_url . '/timkiemsvnoitru';
                $this->load->view('home/error', $data);
                return false;
            }
        } else {
            redirect('canbo/timkiemsvnoitru');
        }
        $this->load->view("home/main_layout", $data);
    }

    /**
     * Ket qua tim kiem sinh vien noi tru theo thong tin lop sinh hoat
     */
    public function timKiemTheoLopSinhHoat($malop = "")
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb_id;
        $data['cb_name'] = $this->cb->tencb;
        $data['task_name'] = "Kết quả tìm kiếm thông tin nội trú";
        if ($this->input->post('search') != "") {
            $malop = $this->input->post('malop');
        }
        //echo $tc, $nd, $mahk;
        if ($malop != "") {
            $data['sub_views'] = "v_tk_lopsh_noitru";
            $data['malop'] = $malop;
            $data['max'] = count($this->mnoitru->timKiemLopNoiTru($malop)); //count rows posts
            $data['min'] = 20;
            //$config['base_url'] = site_url($base_url);
            $cf['base_url'] = site_url('canbo/tklopnt/' . $malop);
            $cf['total_rows'] = $data['max'];
            $cf['per_page'] = $data['min'];
            $cf['num_link'] = 2;
            $cf['uri_segment'] = 6;
            $this->pagination->initialize($cf);
            $data['kqtk'] = $this->mnoitru->timKiemLopNoiTru($malop, $data['min'], $this->uri->segment($cf['uri_segment']));
            $data['page_link'] = $this->pagination->create_links();

            if (!$data['kqtk']) {
                $data['error'] = '300';
                $data['url'] = $this->cb_url . '/timkiemsvnoitru';
                $this->load->view('home/error', $data);
                return false;
            }
        } else {
            redirect('canbo/timkiemsvnoitru');
        }
        $this->load->view("home/main_layout", $data);
    }

    /**
     * bao cao danh sach sinh vien noi tru theo lop sinh hoat
     */

    public function thongKeDsSvNoiTruTheoLop($malop)
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['sub_views'] = "bc_tk_lopsh_noitru";
        $data['malop'] = $malop;
        $data['kqtk'] = $this->mnoitru->timKiemLopNoiTru($malop);
        if (!$data['kqtk']) {
            $data['error'] = '300';
            $data['url'] = $this->cb_url . '/timkiemsvnoitru';
            $this->load->view('home/error', $data);
            return false;
        }
        $this->load->view('home/maugiay/' . $data['sub_views'], $data);
    }
    /*************************************************************************************
     * Ngoại Trú
     *************************************************************************************/
    /**
     * Them danh sach sv ngoai tru
     *
     **/
    public function themSVNT()
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        /** info account **/
        $data['cb_id'] = $this->cb_id;
        $data['cb_name'] = $this->cb->tencb;
        $data['task_name'] = "Thêm sinh viên ngoại trú";
        /** Main Task **/
        $data['sub_views'] = "nt_them";
        $config['upload_path'] = './upload/ngoaitru/';
        $config['allowed_types'] = 'xls|xlsx';
        $CI = get_instance();
        $CI->load->library('upload', $config);

        $svnt = array();
        if ($this->input->post('upload') != "") {
            if (!$CI->upload->do_upload("fex")) {
                $data['error'] = $CI->upload->display_errors();
            } else {
                $file = $CI->upload->data();
                $url = 'upload/ngoaitru/' . $file['file_name'];
                $this->load->library("excel");
                $ok = 0;
                $no = 0;
                $objPHPExcel = PHPExcel_IOFactory::load($url);
                foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                    $worksheetTitle = $worksheet->getTitle();
                    $highestRow = $worksheet->getHighestRow() - 6; // e.g. 10
                    $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'

                    //$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); so cot

                    $nrColumns = ord($highestColumn) - 64;

                    $data['namhoc'] = $worksheet->getCellByColumnAndRow(3, 4)->getValue();
                    $data['malop'] = $worksheet->getCellByColumnAndRow(5, 4)->getValue();
                    $data['mahk'] = $this->mhocky->getMHK();
                    for ($row = 8; $row <= $highestRow; ++$row) {
                        $masv = trim($worksheet->getCellByColumnAndRow(3, $row)->getValue());
                        $map = $this->maddress->getMP(addslashes(trim($worksheet->getCellByColumnAndRow(6, $row)->getValue())));
                        $x = explode('/', trim($worksheet->getCellByColumnAndRow(9, $row)->getValue()));
                        $str = count($x) > 2 ? $x[2] . '-' . $x[1] . '-' . $x[0] : 0;
                        $ngayden = $this->my_auth->cvDdate($str);
                        if ($this->mngoaitru->checkAdd($masv, $ngayden)) {
                            $class = 'success';
                            $ok++;
                        } else {
                            $class = 'error';
                            $no++;
                        }
                        $svnt[] = array(
                            'TenSV' => trim($worksheet->getCellByColumnAndRow(1, $row)->getValue()),
                            'NgaySinh' => trim($worksheet->getCellByColumnAndRow(2, $row)->getValue()),
                            'MaSV' => $masv,
                            'TenChuTro' => addslashes(trim($worksheet->getCellByColumnAndRow(4, $row)->getValue())),
                            'DienThoai' => addslashes(trim($worksheet->getCellByColumnAndRow(8, $row)->getValue())),
                            'DiaChi' => addslashes(trim($worksheet->getCellByColumnAndRow(5, $row)->getValue())),
                            'TenPhuong' => addslashes(trim($worksheet->getCellByColumnAndRow(6, $row)->getValue())),
                            'TenQuan' => addslashes(trim($worksheet->getCellByColumnAndRow(7, $row)->getValue())),
                            'MaPhuong' => $map['maphuong'],
                            'NgayDen' => $ngayden,
                            'MaHK' => $data['mahk'],
                            'class' => $class
                        );
                    }
                    break;
                }
                $data['ok'] = $ok;
                $data['no'] = $no;
                $data['file'] = $url;
                $data['ds_sv'] = $svnt;
                $data['sub_views'] = "nt_them_xem";
            }
        } elseif ($this->input->post('done') != "") {
            $furl = $this->input->post('file');
            $dem = 0;
            if (file_exists($furl)) {
                $this->load->library("excel");
                $objPHPExcel = PHPExcel_IOFactory::load($furl);
                foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow() - 6; // e.g. 10
                    $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'

                    //$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); so cot

                    $nrColumns = ord($highestColumn) - 64;

                    $data['namhoc'] = $worksheet->getCellByColumnAndRow(3, 4)->getValue();
                    $data['malop'] = $worksheet->getCellByColumnAndRow(5, 4)->getValue();
                    $data['mahk'] = $this->mhocky->getMHK();
                    for ($row = 8; $row <= $highestRow; ++$row) {
                        $masv = trim($worksheet->getCellByColumnAndRow(3, $row)->getValue());
                        $map = $this->maddress->getMP(addslashes(trim($worksheet->getCellByColumnAndRow(6, $row)->getValue())));
                        $x = explode('/', trim($worksheet->getCellByColumnAndRow(9, $row)->getValue()));
                        $str = count($x) > 2 ? $x[2] . '-' . $x[1] . '-' . $x[0] : 0;
                        $ngayden = $this->my_auth->cvDdate($str);
                        if ($this->mngoaitru->checkAdd($masv, $ngayden)) $class = 'success';
                        else $class = 'error';
                        if ($class == 'success') {
                            $arr = array(
                                'MaSV' => $masv,
                                'TenChuTro' => addslashes(trim($worksheet->getCellByColumnAndRow(4, $row)->getValue())),
                                'DienThoai' => addslashes(trim($worksheet->getCellByColumnAndRow(8, $row)->getValue())),
                                'DiaChi' => addslashes(trim($worksheet->getCellByColumnAndRow(5, $row)->getValue())),
                                'MaPhuong' => $map['maphuong'],
                                'NgayDen' => $ngayden,
                                'MaHK' => $data['mahk']
                            );
                            $this->mngoaitru->add($arr);
                            $dem++;
                        }
                    }
                    break;
                }
            } else {
                $er['error'] = 404;
                $er['url'] = $this->cb_url . '/themsvnt';
                $this->load->view('home/error', $er);
            }
            $data['dem'] = $dem;
            $data['ds_sv'] = $svnt;
            $data['sub_views'] = "nt_them_ok";

        }
        $this->load->view("home/main_layout", $data);
    }

    /**
     * Thong ke, Tim kiem danh sach SV ngoai tru
     **/
    public function timKiemSVNT()
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb_id;
        $data['cb_name'] = $this->cb->tencb;
        $data['sub_views'] = "nt_timkiem";
        $data['task_name'] = "Tìm kiếm thông tin ngoại trú";
        $data['ds_quan'] = $this->maddress->htmlQuan(48); //48 = Đà Nẵng
        $data['ds_hk'] = $this->mhocky->listHK();
        $data['lopsh'] = $this->mlopsh->dsLopSH();
        $this->load->view("home/main_layout", $data);
    }

    /**
     * Ket qua tim kiem theo thong tin sinh vien
     */
    public function tksvnt($tc = "", $mahk = "", $nd = "")
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb_id;
        $data['cb_name'] = $this->cb->tencb;
        $data['task_name'] = "Kết quả tìm kiếm thông tin ngoại trú";
        if ($this->input->post('searchsv') != "") {
            $tc = $this->input->post('tc');
            $nd = addslashes(trim($this->input->post('txtsv')));
            $mahk = $this->input->post('mahk');
        } else {
            $nd = utf8_urldecode($nd);
        }
        //echo $tc, $nd, $mahk;
        if ($tc != "" and $mahk != "" and $nd != '') {
            if ($tc == '1') {
                $data['sv'] = $this->msinhvien->setInfo($nd); //Toan bo thong tin cua sinh vien
                $data['sub_views'] = "nt_tk_msv";
            } else {
                $data['sub_views'] = "nt_tk_tsv";
            }
            $data['tc'] = $tc;
            $data['nd'] = $nd;
            $data['mahk'] = $mahk;
            $data['max'] = count($this->mngoaitru->timKiemSV($tc, $mahk, $nd)); //count rows posts
            $data['min'] = 20;
            //$config['base_url'] = site_url($base_url);
            $cf['base_url'] = site_url('canbo/tksvnt/' . $tc . '/' . $mahk . '/' . $nd);
            $cf['total_rows'] = $data['max'];
            $cf['per_page'] = $data['min'];
            $cf['num_link'] = 2;
            $cf['uri_segment'] = 6;
            $this->pagination->initialize($cf);
            $data['kqtk'] = $this->mngoaitru->timKiemSV($tc, $mahk, $nd, $data['min'], $this->uri->segment($cf['uri_segment']));
            $data['page_link'] = $this->pagination->create_links();

            if (!$data['kqtk']) {
                $data['error'] = '300';
                $data['url'] = $this->cb_url . '/timkiemsvnt';
                $this->load->view('home/error', $data);
                return false;
            }
        } else {
            redirect('canbo/timkiemsvnt');
        }
        $this->load->view("home/main_layout", $data);
    }

    /**
     * Thong ke theo thong tin sinh vien
     */

    public function thongKeSVNT($tc, $mahk, $nd)
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        if ($tc == '1') {
            $data['sv'] = $this->msinhvien->setInfo($nd); //Toan bo thong tin cua sinh vien
            $data['sub_views'] = "nt_tk_sv";
        } else {
            $data['sub_views'] = "nt_tk_ten";
            $nd = utf8_urldecode($nd);
        }
        $data['mahk'] = $mahk;
        $data['nd'] = $nd;
        $data['kqtk'] = $this->mngoaitru->timKiemSV($tc, $mahk, $nd);
        $this->load->view('home/maugiay/' . $data['sub_views'], $data);
    }

    /**
     * Ket qua tim kiem theo thong tin lop sinh hoat
     */
    public function tklopnt($malop = "", $mahk = "")
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb_id;
        $data['cb_name'] = $this->cb->tencb;
        $data['task_name'] = "Kết quả tìm kiếm thông tin ngoại trú";
        if ($this->input->post('search') != "") {
            $malop = $this->input->post('malop');
            $mahk = $this->input->post('mahk');
        }
        //echo $tc, $nd, $mahk;
        if ($malop != "" and $mahk != "") {
            $data['sub_views'] = "nt_tk_lop";
            $data['malop'] = $malop;
            $data['mahk'] = $mahk;
            $data['max'] = count($this->mngoaitru->timKiemLop($malop, $mahk)); //count rows posts
            $data['min'] = 20;
            //$config['base_url'] = site_url($base_url);
            $cf['base_url'] = site_url('canbo/tklopnt/' . $malop . '/' . $mahk);
            $cf['total_rows'] = $data['max'];
            $cf['per_page'] = $data['min'];
            $cf['num_link'] = 2;
            $cf['uri_segment'] = 6;
            $this->pagination->initialize($cf);
            $data['kqtk'] = $this->mngoaitru->timKiemLop($malop, $mahk, $data['min'], $this->uri->segment($cf['uri_segment']));
            $data['page_link'] = $this->pagination->create_links();

            if (!$data['kqtk']) {
                $data['error'] = '300';
                $data['url'] = $this->cb_url . '/timkiemsvnt';
                $this->load->view('home/error', $data);
                return false;
            }
        } else {
            redirect('canbo/timkiemsvnt');
        }
        $this->load->view("home/main_layout", $data);
    }

    /**
     * Thong ke theo thong sin sinh vien
     */

    public function thongKeLopNT($malop, $mahk)
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['sub_views'] = "nt_tk_lop";
        $data['mahk'] = $mahk;
        $data['malop'] = $malop;
        $data['kqtk'] = $this->mngoaitru->timKiemLop($malop, $mahk);
        if (!$data['kqtk']) {
            $data['error'] = '300';
            $data['url'] = $this->cb_url . '/timkiemsvnt';
            $this->load->view('home/error', $data);
            return false;
        }
        $this->load->view('home/maugiay/' . $data['sub_views'], $data);
    }

    /**
     * Ket qua tim kiem theo dia chi ngoai tru
     */
    public function tkdcnt($quan = 0, $phuong = 0)
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb_id;
        $data['cb_name'] = $this->cb->tencb;
        $data['task_name'] = "Tìm kiếm thông tin ngoại trú";

        if ($this->input->post('searchdc') != "") {
            $quan = $this->input->post('quan');
            $phuong = $this->input->post('phuong');
        }

        if ($quan != 0) {
            $data['sub_views'] = "nt_kq_dc";
            $max = count($this->mngoaitru->timKiemDC($quan, $phuong)); //count rows posts
            $min = 20;
            //$config['base_url'] = site_url($base_url);
            $cf['base_url'] = site_url('canbo/tkdcnt/' . $quan . '/' . $phuong);
            $cf['total_rows'] = $max;
            $cf['per_page'] = $min;
            $cf['num_link'] = 2;
            $cf['uri_segment'] = 5;
            $this->pagination->initialize($cf);
            $data['kqtk'] = $this->mngoaitru->timKiemDC($quan, $phuong, $min, $this->uri->segment($cf['uri_segment']));

            $data['page_link'] = $this->pagination->create_links();
            if (!$data['kqtk']) {
                $data['error'] = '300';
                $data['url'] = $this->cb_url . '/timkiemsvnt';
                $this->load->view('home/error', $data);
                return false;
            }
            $data['mquan'] = $quan;
            $data['mphuong'] = $phuong;
            $data['quan'] = $this->maddress->dsQuan(0, $quan);
            $data['phuong'] = $phuong > 0 ? $this->maddress->dsPhuong(0, $phuong) : null;
        } else {
            redirect('canbo/timkiemsvnt');
        }
        $this->load->view("home/main_layout", $data);
    }

    /**
     * Thong ke theo dia chi ngoai tru
     */

    public function thongKeDCNT($quan, $phuong)
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['kqtk'] = $this->mngoaitru->timKiemDC($quan, $phuong);
        $data['quan'] = $this->maddress->dsQuan(0, $quan);

        $data['phuong'] = $phuong > 0 ? $this->maddress->dsPhuong(0, $phuong) : null;
        $data['sub_views'] = 'nt_tk_dc';
        $this->load->view('home/maugiay/' . $data['sub_views'], $data);
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
     * Ky Tuc Xa
     *************************************************************************************/
    /**
     * Quan ly dang ky phong ktx
     **/

    public function dsChoDuyet()
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb_id;
        $data['cb_name'] = $this->cb->tencb;
        $data['sub_views'] = "dschoduyet_ktx";
        $data['task_name'] = "Danh sánh sinh viên chờ duyệt";
        $cf['base_url'] = base_url('canbo/dschoduyet/');
        $cf['total_rows'] = $this->mktx->count_all();
        $cf['per_page'] = 15;
        $cf['num_link'] = 2;
        $cf['uri_segment'] = 3;
        $data['data'] = $this->mktx->dsDkPhong($cf['per_page'], $this->uri->segment($cf['uri_segment']));
        $this->pagination->initialize($cf);
        $data['page_link'] = $this->pagination->create_links();

        $this->load->view("home/main_layout", $data);
    }

    // sinh viên đăng ký phòng
    public function svDkPhong()
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb_id;
        $data['cb_name'] = $this->cb->tencb;
        $data['sub_views'] = "v_formxnsvdkphong";
        $data['task_name'] = "Xác nhận sinh viên đăng ký phòng";
        $data['id'] = $this->uri->segment(3, 0);
        $data['MaPhong'] = $this->uri->segment(4, 0);
        $masv = $this->uri->segment(5, 0);
        $data['thongtinsv'] = $this->mktx->thongtinsv($masv);
        $this->load->view("home/main_layout", $data);
    }

    // Xác nhận sinh viên đăng ký phòng
    public function xacNhanSvDkPhong()
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb_id;
        $data['cb_name'] = $this->cb->tencb;
        $data['sub_views'] = "v_xnsvdkphong";
        $data['task_name'] = "Xác nhận sinh viên đăng ký phòng";
        if (isset($_POST['xacnhan'])) {
            $checktoexist = $this->mktx->checkToExist($_POST['id']);
            if ($checktoexist == false) {
                redirect(base_url() . 'canbo/dsSvDkMotPhong/' . $_POST['maphong']);
            } else {
                $status = $this->mktx->XnDkPhong($data['cb_id'], $_POST['id'], $_POST['ghichu']);
                $capnhatsoluong = $this->mktx->updateSlSvOPhong($_POST['maphong'], $trangthai = 'tang');
                if ($status == true && $capnhatsoluong == true) {
                    $data['mesage_susscess'] = "Xác nhận thành công";
                    $this->load->view('home/main_layout', $data);
                } else {
                    $data['mesage_error'] = "Xác nhận không thành công, vui lòng thử lại";
                    $this->load->view("home/main_layout", $data);
                }
            }
        }
    }

    // load form tu choi
    public function formTuChoiSvDkPhong()
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb_id;
        $data['cb_name'] = $this->cb->tencb;
        $data['sub_views'] = "v_formtuchoisvdkphong";
        $data['task_name'] = "Từ chối sinh viên đăng ký phòng";
        $data['id'] = $this->uri->segment(3, 0);
        $data['maphong'] = $this->uri->segment(4, 0);
        $this->load->view("home/main_layout", $data);
    }

    // Từ chối sinh viên đăng ký phòng
    public function tuChoiSvDkPhong()
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb_id;
        $data['cb_name'] = $this->cb->tencb;
        $data['sub_views'] = "v_formtuchoisvdkphong";
        $data['task_name'] = "Từ chối sinh viên đăng ký phòng";
        $data['id'] = $this->uri->segment(3, 0);
        $data['maphong'] = $this->uri->segment(4, 0);
        $data['data'] = $_POST['noidungtuchoi'];
        if ($data['data'] == '') {
            $data['message_error'] = "Hãy nhập nội dung từ chối";
            $this->load->view('home/main_layout', $data);
        } else {
            $query = $this->mktx->ftuChoiSvDkPhong($data['cb_id'], $data['id'], $data['data']);
            $data['message_susscess'] = "Từ chối thành công";
            $this->load->view('home/main_layout', $data);
        }
    }

    /***************** Tinh trang phong ktx ***************************/
    public function tinhtrangphongktx()
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb_id;
        $data['cb_name'] = $this->cb->tencb;
        $data['sub_views'] = "v_tinhtrangphongktx";
        $data['task_name'] = "Tình trạng phòng ký túc xá";
        $data['rs'] = $this->mktx->getKtxPhong();
        $this->load->view("home/main_layout", $data);
    }

    public function thongtinmotphong()
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb_id;
        $data['cb_name'] = $this->cb->tencb;
        $data['sub_views'] = "v_thongtinmotphong";
        $maphong = $this->uri->segment(3);
        $data['task_name'] = "Danh sách sinh viên ở phòng: " . $maphong;
        $data['dssv'] = $this->mktx->getDsSvOMotPhong($maphong);
        $data['soluongsv'] = count($data['dssv']);
        $this->load->view("home/main_layout", $data);
    }

    public function dsSvDkMotPhong($maphong)
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb_id;
        $data['cb_name'] = $this->cb->tencb;
        $data['sub_views'] = "v_dssvdkmotphong";
        $maphong = $this->uri->segment(3);
        $data['MaPhong'] = $maphong;
        $data['task_name'] = "Danh sách sinh viên đăng ký phòng: " . $maphong;
        $cf['base_url'] = base_url('canbo/dsSvDkMotPhong/' . $maphong);
        $cf['per_page'] = 10;
        $cf['num_link'] = 2;
        $cf['uri_segment'] = 4;
        $cf['total_rows'] = $this->mktx->count_all_table($maphong);
        $data['soluongsv'] = $cf['total_rows'];
        $data['dssv'] = $this->mktx->getDsSvDkMotPhong($cf['per_page'], $this->uri->segment($cf['uri_segment']), $maphong);
        $this->pagination->initialize($cf);
        $data['page_link'] = $this->pagination->create_links();
        $this->load->view("home/main_layout", $data);
    }

    public function svTinhTrangPhong()
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb_id;
        $data['cb_name'] = $this->cb->tencb;
        $data['sub_views'] = "v_svtinhtrangphong";
        $data['task_name'] = "Danh sách sinh viên đăng ký phòng: " . $maphong;
        $this->load->view("home/main_layout", $data);
        $masv = $this->uri->segment(3);
    }
    /************************ Đăng ký chuyển phòng ************************/
    // Danh sách đăng ký chuyển phòng
    public function dsdkchuyenphong()
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb_id;
        $data['cb_name'] = $this->cb->tencb;
        $data['sub_views'] = "v_dssvdkchuyenphong";
        $data['task_name'] = "Danh sách sinh viên đăng ký chuyển phòng";
        $data['danhsach'] = $this->mktx->layDsSvDkChuyenPhong();
        $this->load->view("home/main_layout", $data);
    }

    public function xnsvchuyenphong()
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb_id;
        $data['cb_name'] = $this->cb->tencb;
        $data['sub_views'] = 'v_dssvdkchuyenphong';
        $data['task_name'] = 'Xác nhận sinh viên chuyển phòng';
        $id = $this->uri->segment(3);
        $maphongcu = $this->uri->segment(4);
        $maphongmoi = $this->uri->segment(5);
        $masv = $this->uri->segment(6);
        $mahk = $this->uri->segment(7);
        $ngaydk = $this->uri->segment(8);
        $macb = $this->uri->segment(9);
        $newngaydk = str_replace('%20', ' ', $ngaydk);
        $mg = $this->mktx->xnsvdkchuyenphong($id, $maphongcu, $maphongmoi, $masv, $mahk, $newngaydk, $macb);
        if ($mg == true) {
            $data['mesage_susscess'] = 'Chuyển phòng thành công';
            $this->load->view('home/main_layout', $data);
        } else {
            $data['mesage_error'] = 'Chuyển phòng thất bại, vui lòng thử lại';
            $this->load->view('home/main_layout', $data);
        }
    }

    public function tuchoisvchuyenphong()
    {
        $data['cb_id'] = $this->cb_id;
        $data['cb_name'] = $this->cb->tencb;
        $data['sub_views'] = 'v_dssvdkchuyenphong';
        $data['task_name'] = 'Xác nhận sinh viên chuyển phòng';
        $id = $this->uri->segment(3);
        $this->mktx->tcsvchuyenphong($id);
        $data['tuchoichuyenphong'] = 'Từ chối chuyển phòng thành công';
        $this->load->view('home/main_layout', $data);
    }
    /*************************************************************************************
     * Quản lý Lớp
     *************************************************************************************/

    /**
     * Xem danh sách sinh vien
     *
     **/
    public function dssinhvien()
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb_id;
        $data['cb_name'] = $this->cb->tencb;
        $data['cb_regency'] = $this->cb->chucvu;
        $data['sub_views'] = 'v_dssinhvien';
        if ($data['cb_regency'] == 'giaovien') {
            $btg = $this->mlopsh->getMaLop($data['cb_id']);
            $malop = $btg[0]['MaLop'];
            $data['task_name'] = 'Danh sách sinh viên lớp: ' . $malop;
            $cf['base_url'] = base_url('canbo/dssinhvien');
            $cf['per_page'] = 20;
            $cf['num_link'] = 2;
            $cf['uri_segment'] = 3;
            $cf['total_rows'] = $this->mlopsh->count_all_record_table('sinhvien', 'MaLop', $malop);
            $data['dssinhvien'] = $this->mlopsh->getAllDataTable('sinhvien', 'MaLop', $malop, '', '', $cf['per_page'], $this->uri->segment($cf['uri_segment']));
            $this->pagination->initialize($cf);
            $data['page_link'] = $this->pagination->create_links();
            $this->load->view("home/main_layout", $data);
        } else {
            show_404();
        }

    }

    public function diemrenluyensinhvien()
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb_id;
        $data['cb_name'] = $this->cb->tencb;
        $data['cb_regency'] = $this->cb->chucvu;
        $data['sub_views'] = 'v_diemrenluyen';
        if ($data['cb_regency'] == 'giaovien') {
            $btg = $this->mlopsh->getMaLop($data['cb_id']);
            $malop = $btg[0]['MaLop'];
            $data['task_name'] = 'Điểm rèn luyện sinh viên lớp: ' . $malop;
            $cf['base_url'] = base_url('canbo/dssinhvien');
            $cf['per_page'] = 20;
            $cf['num_link'] = 2;
            $cf['uri_segment'] = 3;
            $cf['total_rows'] = $this->mlopsh->count_all_record_table('renluyen', 'MaLop', $malop);
            $maxmahk = $this->mlopsh->getMaxOneColOfTable('renluyen', 'MaHk', 'MaLop', $malop, '', '');
            $maxmahk = $maxmahk[0]['Max(MaHk)'];
            $data['dsdiemrenluyen'] = $this->mlopsh->getAllDataTable('renluyen', 'MaLop', $malop, 'MaHk', $maxmahk, $cf['per_page'], $this->uri->segment($cf['uri_segment']));
            $this->pagination->initialize($cf);
            $data['page_link'] = $this->pagination->create_links();
            $this->load->view("home/main_layout", $data);
        } else {
            show_404();
        }
    }

    /*************************************************************************************
     * Điểm Rèn Luyện
     *************************************************************************************/

    /**
     * Them danh sach diem ren luyen
     *
     **/
    public function themDRL()
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        /** info account **/
        $data['cb_id'] = $this->cb->macb;
        $data['cb_name'] = $this->cb->tencb;
        $ngayxn = $this->my_auth->setDate();
        $data['task_name'] = "Thêm danh sách điểm rèn luyện";
        /** Main Task **/
        $data['mahk'] = $this->mhocky->getMHK();//get hoc ky hien tai
        $config['upload_path'] = './upload/renluyen/';
        $config['allowed_types'] = 'xls|xlsx';
        $CI = get_instance();
        $CI->load->library('upload', $config);
        $CI->load->library("excel");
        $data['sub_views'] = "drl_them";
        if ($this->input->post('upload') != "") {
            if (!$CI->upload->do_upload("fex")) {
                $data['error'] = $CI->upload->display_errors();
            } else {
                $file = $CI->upload->data();
                $url = 'upload/renluyen/' . $file['file_name'];
                $ok = 0;
                $no = 0;

                $objPHPExcel = PHPExcel_IOFactory::load($url);
                foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                    $worksheetTitle = $worksheet->getTitle();
                    $highestRow = $worksheet->getHighestRow() - 12; // e.g. 10
                    $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
                    $nrColumns = ord($highestColumn) - 64;
                    $data['namhoc'] = $worksheet->getCellByColumnAndRow(3, 4)->getValue();
                    $data['malop'] = $worksheet->getCellByColumnAndRow(5, 4)->getValue();
                    for ($row = 11; $row <= $highestRow; ++$row) {
                        $masv = trim($worksheet->getCellByColumnAndRow(1, $row)->getValue());
                        $v = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $diem = $this->mrenluyen->doiDiem($v);
                        if (!$this->mrenluyen->checkDRL($masv, $data['mahk'])) {
                            $class = 'success';
                            $ok++;
                        } else {
                            $class = 'error';
                            $no++;
                        }
                        $drl[] = array(
                            'MaSV' => $masv,
                            'HoSV' => trim($worksheet->getCellByColumnAndRow(2, $row)->getValue()),
                            'TenSV' => trim($worksheet->getCellByColumnAndRow(3, $row)->getValue()),
                            'Diem' => trim($worksheet->getCellByColumnAndRow(4, $row)->getValue()),
                            'DiemCD' => $diem['dcd'],
                            'XepLoai' => $diem['xl'],
                            'GhiChu' => trim($worksheet->getCellByColumnAndRow(7, $row)->getValue()),
                            'class' => $class
                        );
                    }
                    break;
                }
                $data['file'] = $url;
                $data['ds_sv'] = $drl;
                $data['ok'] = $ok;
                $data['no'] = $no;
                $data['sub_views'] = "drl_them_xem";
            }
        } else if ($this->input->post('done') != "") {
            $url = $this->input->post('file');
            if (!file_exists($url)) {
                $err['error'] = 404;
                $er['url'] = $this->cb_url . '/themdrl';
                $this->load->view('home/error', $er);
                return false;
            }
            $dem = 0;
            $objPHPExcel = PHPExcel_IOFactory::load($url);
            foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                $worksheetTitle = $worksheet->getTitle();
                $highestRow = $worksheet->getHighestRow() - 12; // e.g. 10
                $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
                $data['namhoc'] = $worksheet->getCellByColumnAndRow(3, 4)->getValue();
                $data['malop'] = $worksheet->getCellByColumnAndRow(5, 4)->getValue();
                for ($row = 11; $row <= $highestRow; ++$row) {
                    $v = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $diem = $this->mrenluyen->doiDiem($v);
                    $drl[] = array(
                        'MaSV' => trim($worksheet->getCellByColumnAndRow(1, $row)->getValue()),
                        'HoSV' => trim($worksheet->getCellByColumnAndRow(2, $row)->getValue()),
                        'TenSV' => trim($worksheet->getCellByColumnAndRow(3, $row)->getValue()),
                        'Diem' => trim($worksheet->getCellByColumnAndRow(4, $row)->getValue()),
                        'DiemCD' => $diem['dcd'],
                        'XepLoai' => $diem['xl'],
                        'GhiChu' => trim($worksheet->getCellByColumnAndRow(7, $row)->getValue())
                    );
                    $masv = addslashes(trim($worksheet->getCellByColumnAndRow(1, $row)->getValue()));
                    $diem = addslashes(trim($worksheet->getCellByColumnAndRow(4, $row)->getValue()));
                    $ghichu = trim($worksheet->getCellByColumnAndRow(7, $row)->getValue());
                    if (!$this->mrenluyen->checkDRL($masv, $data['mahk'])) {
                        $this->mrenluyen->addDRL($masv, $data['mahk'], $diem, $ngayxn, $ghichu);
                        $dem++;
                    }
                }
                break; //get one sheet
            }
            $data['sub_views'] = "drl_them_done";
            $data['dem'] = $dem;
        }
        $this->load->view("home/main_layout", $data);
    }

    /**
     * Tim kiem diem ren luyen
     */
    public function timKiemDRL()
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb_id;
        $data['cb_name'] = $this->cb->tencb;
        $data['sub_views'] = "drl_timkiem";
        $data['task_name'] = "Tìm kiếm điểm rèn luyện";
        $data['ds_lop'] = $this->mlopsh->dsLopSH();
        $data['ds_hk'] = $this->mhocky->listHK();
        $this->load->view("home/main_layout", $data);
    }

    /**
     * Ket qua tim kiem diem ren luyen
     */

    public function ketQuaDRLLSH($malop = "", $mahk = "")
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb_id;
        $data['cb_name'] = $this->cb->tencb;
        $data['task_name'] = "Kết quả tìm kiếm điểm rèn luyện";
        $data['ds_lop'] = $this->mlopsh->dsLopSH();
        $data['ds_hk'] = $this->mhocky->listHK();
        if ($this->input->post('search') != "") {
            $malop = $this->input->post('lopsh');
            $mahk = $this->input->post('mahk');
        }

        if ($malop != "" && $mahk != "") {
            $data['sub_views'] = "drl_kq";
            $data['lopsh'] = $malop;
            $data['mahk'] = $mahk;
            $data['thongke'] = $this->mrenluyen->thongkeDRL($malop, $mahk); //thong ke
            $max = count($this->mrenluyen->dsDRL($malop, $mahk)); //count rows posts
            $min = 20;
            //$config['base_url'] = site_url($base_url);
            $cf['base_url'] = site_url('canbo/ketquadrllsh/' . $malop . '/' . $mahk);
            $cf['total_rows'] = $max;
            $cf['per_page'] = $min;
            $cf['num_link'] = 2;
            $cf['uri_segment'] = 5;
            $this->pagination->initialize($cf);
            $data['kqtk'] = $this->mrenluyen->dsDRL($malop, $mahk, $min, $this->uri->segment($cf['uri_segment']));
            $data['page_link'] = $this->pagination->create_links();
            if (!$data['kqtk']) {
                $data['error'] = '300';
                $data['url'] = $this->cb_url . '/timKiemDRL';
                $this->load->view('home/error', $data);
                return false;
            }
        } else
            $data['sub_views'] = "drl_timkiem";
        $this->load->view("home/main_layout", $data);
    }

    /**
     * Ket qua tim kiem diem ren luyen
     */

    public function ketQuaDRLSV($masv = "")
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb_id;
        $data['cb_name'] = $this->cb->tencb;
        $data['task_name'] = "Kết quả tìm kiếm điểm rèn luyện";
        if ($this->input->post('search') != "") {
            $masv = $this->input->post('masv');
        }

        if ($masv != "") {
            $data['sv'] = $this->msinhvien->setInfo($masv);
            if (!$data['sv']) {
                $err['error'] = '101';
                $err['url'] = $this->cb_url . '/timKiemDRL';
                $this->load->view('home/error', $err);
                return false;
            }
            $data['sub_views'] = "drl_kq_sv";
            $data['kqtk'] = $this->mrenluyen->svDRL($masv);
            if (!$data['kqtk']) {
                $data['error'] = '300';
                $data['url'] = $this->cb_url . '/timKiemDRL';
                $this->load->view('home/error', $data);
                return false;
            }
        } else
            $data['sub_views'] = "drl_timkiem";
        $data['ds_lop'] = $this->mlopsh->dsLopSH();
        $data['ds_hk'] = $this->mhocky->listHK();
        $this->load->view("home/main_layout", $data);
    }

    /**
     * Thống kê điểm Rèn Luyện
     */

    public function thongKeDRL($malop, $mahk)
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['malop'] = $malop;
        $data['mahk'] = $mahk;
        $data['thongke'] = $this->mrenluyen->thongkeDRL($malop, $mahk); //thong ke
        $data['kqtk'] = $this->mrenluyen->dsDRL($malop, $mahk);
        $this->load->view('home/maugiay/tk_renluyen', $data);
    }

    /**
     * Doi mat khau
     */
    public function changePass()
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }//check login
        $data['cb_id'] = $this->cb_id;
        $data['cb_name'] = $this->cb->tencb;
        $opass = $this->cb->getMatKhau();
        $data['task_name'] = "Thay đổi mật khẩu";
        if ($this->input->post('done')) {
            $pass = md5($this->input->post('pass'));
            $newpass = md5($this->input->post('newpass'));
            $repass = md5($this->input->post('repass'));
            if ($pass == $opass) {
                if ($newpass == $repass and strlen($newpass) > 4) {
                    $this->mcanbo->changePass($this->cb_id, $newpass);
                    $this->session->sess_destroy();
                    $err['error'] = 111;
                } else {
                    $err['error'] = 400;
                }
            } else {
                $err['error'] = 401;
            }
            $err['url'] = $this->cb_url . '/changepass';
            $this->load->view('home/error', $err);
            return false;
        } else {
            $data['sub_views'] = 'cb_cpass';
        }
        $this->load->view('home/main_layout', $data);
    }

    public function test($mc = 0)
    {
        echo utf8_urldecode($mc);
    }
    /*************************************************************************************
     * Chinh Tri Dau Khoa
     *************************************************************************************/
    /**
     * Tao danh sach diem chinh tri dau khoa
     *
     **/
    public function themdiemctdk()
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb->macb;
        $data['cb_name'] = $this->cb->tencb;
        $data['task_name'] = "Thêm danh sách điểm rèn luyện";
        $data['sub_views'] = "ct_them";
        $this->load->view("home/main_layout", $data);
    }

    public function xemdsctdk()
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb->macb;
        $data['cb_name'] = $this->cb->tencb;
        $data['task_name'] = "Thêm danh sách điểm rèn luyện";
        $data['sub_views'] = "ct_them_xem";
        $config['upload_path'] = './upload/chinhtri/';
        $config['allowed_types'] = 'xls|xlsx';
        $CI = get_instance();
        $CI->load->library('upload', $config);
        $ctdk = array();
        if ($this->input->post('upload') != "") {
            if (!$CI->upload->do_upload("fex")) {
                $data['error'] = $CI->upload->display_errors();
            } else {
                $file = $CI->upload->data();
                $url = 'upload/chinhtri/' . $file['file_name'];
                $this->session->set_flashdata('surl', $url);
                $this->load->library("excel");
                if ($this->session->flashdata('surl') != null) {
                    $objPHPExcel = PHPExcel_IOFactory::load($this->session->flashdata('surl'));
                }
                $objPHPExcel = PHPExcel_IOFactory::load($url);
                foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                    $worksheetTitle = $worksheet->getTitle();
                    $highestRow = $worksheet->getHighestRow() - 6; // e.g. 10
                    $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
                    $nrColumns = ord($highestColumn) - 64;
                    $rowOnPage = 160;
                    $soPage = ceil($highestRow / $rowOnPage);
                    $currentpage = $this->uri->segment(3, 0);
                    if ($currentpage == 0) {
                        $recordStart = 5;
                        $recordEnd = $recordStart + $rowOnPage;
                    } else {
                        $recordStart = $rowOnPage * $currentpage;
                        $recordEnd = $recordStart + $rowOnPage;
                    }
                    for ($row = $recordStart; $row <= $recordEnd; ++$row) {
                        $ctdk[] = array(
                            'stt' => trim($worksheet->getCellByColumnAndRow(0, $row)->getValue()),
                            'masv' => trim($worksheet->getCellByColumnAndRow(2, $row)->getValue()),
                            'bienlaiso' => trim($worksheet->getCellByColumnAndRow(3, $row)->getValue()),
                            'hovachulot' => trim($worksheet->getCellByColumnAndRow(4, $row)->getValue()),
                            'ten' => trim($worksheet->getCellByColumnAndRow(5, $row)->getValue()),
                            'ngaysinh' => trim($worksheet->getCellByColumnAndRow(6, $row)->getValue()),
                            'nganh' => trim($worksheet->getCellByColumnAndRow(7, $row)->getValue()),
                            'lop' => trim($worksheet->getCellByColumnAndRow(14, $row)->getValue()),
                        );
                    }
                }
                $data['ds'] = $ctdk;
            }
        }
        $this->load->view("home/main_layout", $data);
    }

    public function addctdaukhoa()
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb->macb;
        $data['cb_name'] = $this->cb->tencb;
        $data['task_name'] = "Thêm danh sách điểm rèn luyện";
        $data['sub_views'] = "ct_them_add";
        $config['upload_path'] = './upload/chinhtri/';
        $config['allowed_types'] = 'xls|xlsx';
        $CI = get_instance();
        $CI->load->library('upload', $config);
        $ctdk = array();
        if ($this->input->post('done') != "") {
            $this->load->library("excel");
            if ($this->session->flashdata('surl') != null) {
                $objPHPExcel = PHPExcel_IOFactory::load($this->session->flashdata('surl'));
            }
            $objPHPExcel = PHPExcel_IOFactory::load($this->session->flashdata('surl'));
            foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow(); // e.g. 10
                $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
                $nrColumns = ord($highestColumn) - 64;
                $soluongthemmoi = $soluongcapnhat = 0;
                for ($row = 5; $row <= $highestRow; ++$row) {
                    $masv = trim($worksheet->getCellByColumnAndRow(2, $row)->getValue());
                    $bienlaiso = trim($worksheet->getCellByColumnAndRow(3, $row)->getValue());
                    $ns = trim($worksheet->getCellByColumnAndRow(6, $row)->getValue());
                    $ngay = substr($ns, 0, 2);
                    $thang = substr($ns, 3, 2);
                    $nam = substr($ns, 6, 4);
                    $ngaysinh = $nam . '-' . $thang . '-' . $ngay;
                    $nganh = trim($worksheet->getCellByColumnAndRow(7, $row)->getValue());
                    $diem['ngay1'] = trim($worksheet->getCellByColumnAndRow(8, $row)->getValue());
                    $diem['ngay2'] = trim($worksheet->getCellByColumnAndRow(9, $row)->getValue());
                    $diem['ngay3'] = trim($worksheet->getCellByColumnAndRow(10, $row)->getValue());
                    $diem['ngay4'] = trim($worksheet->getCellByColumnAndRow(11, $row)->getValue());
                    $diem['ngay5'] = trim($worksheet->getCellByColumnAndRow(12, $row)->getValue());
                    $diem['ngay6'] = trim($worksheet->getCellByColumnAndRow(13, $row)->getValue());
                    $hovachulot = trim($worksheet->getCellByColumnAndRow(4, $row)->getValue());
                    $ten = trim($worksheet->getCellByColumnAndRow(5, $row)->getValue());
                    $hovaten = $hovachulot . ' ' . $ten;
                    $lop = trim($worksheet->getCellByColumnAndRow(14, $row)->getValue());
                    if ($this->mctdaukhoa->checkchinhtridaukhoa($bienlaiso) == true) {
                        $this->mctdaukhoa->updatechinhtridaukhoa($bienlaiso, json_encode($diem));
                        $soluongcapnhat++;
                    } else {
                        $this->mctdaukhoa->addchinhtridaukhoa($masv, $bienlaiso, $hovaten, $ngaysinh, $nganh, json_encode($diem), $lop);
                        $soluongthemmoi++;
                    }
                }
            }
            if ($soluongcapnhat && $soluongthemmoi = 0) {
                $data['error'] = 'Thêm mới thất bại';
            } else {
                $data['slcn'] = $soluongcapnhat;
                $data['sltm'] = $soluongthemmoi;
            }

        }
        $this->load->view("home/main_layout", $data);
    }

    public function timdiemctdk()
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb->macb;
        $data['cb_name'] = $this->cb->tencb;
        $data['task_name'] = "Tìm kiếm điểm chính trị đầu khóa";
        $data['sub_views'] = 'v_tk_diemctdk';
        $data['dslopct'] = $this->mctdaukhoa->laydslopchinhtri();
        $this->load->view('home/main_layout', $data);
    }

    public function timdiemctdktheoma()
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb->macb;
        $data['cb_name'] = $this->cb->tencb;
        $data['task_name'] = "Tìm kiếm điểm chính trị đầu khóa";
        $data['sub_views'] = 'v_tk_diemctdk_theoma';
        if ($this->input->get('searchmasv') != '') {
            $masv = addslashes(trim($this->input->get('txtmasv')));
            $data['dstheoma'] = $this->mctdaukhoa->timdiemchinhtritheomasv($masv);
            $data['masv'] = $masv;
            unset($this->input->get['searchmasv']);
        }
        $this->load->view('home/main_layout', $data);
    }

    public function timdiemctdktheolop()
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb->macb;
        $data['cb_name'] = $this->cb->tencb;
        $data['task_name'] = "Tìm kiếm điểm chính trị đầu khóa";
        $data['sub_views'] = 'v_tk_diemctdk_theolop';
        if ($this->input->get('search', true) != '') {
            $malop = $this->input->get('malop', true);
            $data['danhsach'] = $this->mctdaukhoa->timdsdiemchinhtritheolop($malop);
            $data['malop'] = $malop;
        }
        $this->load->view('home/main_layout', $data);
    }

    public function tkdiemctdaukhoa()
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb->macb;
        $data['cb_name'] = $this->cb->tencb;
        $data['task_name'] = "Thống kê điểm chính trị đầu khóa";
        $data['sub_views'] = 'v_thongke_diemctdk';
        $data['max'] = $this->mctdaukhoa->all_count_table_chinhtri();
        $data['min'] = 20;
        $cf['base_url'] = base_url('canbo/tkdiemctdaukhoa/');
        $cf['total_rows'] = $data['max'];
        $cf['per_page'] = $data['min'];
        $cf['num_link'] = 2;
        $cf['uri_segment'] = 3;
        $this->pagination->initialize($cf);
        $data['page_link'] = $this->pagination->create_links();
        $result = $this->mctdaukhoa->thongkediemctdk($data['min'], $this->uri->segment($cf['uri_segment']));
        foreach ($result as $k => $v) {
            $kq[] = array(
                'MaSV' => $v['MaSV'],
                'HoTen' => $v['HoTen'],
                'NgaySinh' => $v['NgaySinh'],
                'Nganh' => $v['Nganh'],
                'Lop' => $v['Lop'],
                $diem[] = array(),
                $diem = json_decode($v['Diem'], true),
                $inter_var_diem = $diem['ngay1'] . $diem['ngay2'] . $diem['ngay3'] . $diem['ngay4'] . $diem['ngay5'] . $diem['ngay6'],
                'Diem' => strlen($inter_var_diem),
                'Dat' => (strlen($inter_var_diem) >= 4 && strlen($inter_var_diem) <= 6) ? 'Đạt' : 'Không Đạt',
            );
        }
        $data['kqtk'] = $kq;
        $this->load->view('home/main_layout', $data);
    }

    public function thongKeDsCtDk()
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['sub_views'] = "bc_tk_ctdk";
        $result = $this->mctdaukhoa->laythongkediemctdk();
        foreach ($result as $k => $v) {
            $kq[] = array(
                'MaSV' => $v['MaSV'],
                'HoTen' => $v['HoTen'],
                'NgaySinh' => $v['NgaySinh'],
                'Nganh' => $v['Nganh'],
                'Lop' => $v['Lop'],
                $diem[] = array(),
                $diem = json_decode($v['Diem'], true),
                $inter_var_diem = $diem['ngay1'] . $diem['ngay2'] . $diem['ngay3'] . $diem['ngay4'] . $diem['ngay5'] . $diem['ngay6'],
                'Diem' => strlen($inter_var_diem),
                'Dat' => (strlen($inter_var_diem) >= 4 && strlen($inter_var_diem) <= 6) ? 'Đạt' : 'Không Đạt',
            );
        }
        $data['kqtk'] = $kq;
        $this->load->view('home/maugiay/' . $data['sub_views'], $data);
    }
    /*************************************************************************************
     * Khac |
     *************************************************************************************/
    /**
     * Thong tin tuyen dung
     *
     **/
    public function thongtintuyendung()
    {
        if (!$this->my_auth->is_Canbo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb->macb;
        $data['cb_name'] = $this->cb->tencb;
        $data['task_name'] = "Thông tin tuyển dụng";
        $data['sub_views'] = 'v_thongtintuyendung';
        if ($this->input->post('tuyendung_edit_submit', true) != '') {
            var_dump($this->input->post('tieude'));
            echo $this->input->post("tieude");
        } else {
            $data['max'] = $this->mtuyendung->all_count_table_thongtin();
            $data['min'] = 15;
            $cf['base_url'] = base_url('canbo/thongtintuyendung/');
            $cf['total_rows'] = $data['max'];
            $cf['per_page'] = $data['min'];
            $cf['num_link'] = 2;
            $cf['uri_segment'] = 3;
            $this->pagination->initialize($cf);
            $data['page_link'] = $this->pagination->create_links();
            $dstd = $this->mtuyendung->laydanhsachtintuyendung($data['min'], $this->uri->segment($cf['uri_segment']));
            foreach ($dstd as $k => $v) {
                $inter_var_ds[] = array(
                    'MaSo' => $v['MaSo'],
                    'TieuDe' => $v['TieuDe'],
                    'NoiDung' => $v['NoiDung'],
                    'NgayDangTin' => $v['NgayDangTin'],
                    $ten = $this->mcanbo->laytencanbo($v['NguoiDangTin']),
                    'TenCb' => $ten[0]['TenCB'],
                );
            }
            $data['ds'] = $inter_var_ds;
        }

        $this->load->view('home/main_layout', $data);
    }

    public function tuyendungedit()
    {
        if (!$this->my_auth->is_Canbo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb->macb;
        $data['cb_name'] = $this->cb->tencb;
        $data['task_name'] = "Xem tin tuyển dụng";
        $data['sub_views'] = 'v_test_modal';
        if ($this->input->post('tuyendung_edit_submit', true) != '') {
            echo $this->input->post('tieude');
        }
        $this->load->view('home/main_layout', $data);
    }

    public function xemtintuyendung($matin)
    {
        if (!$this->my_auth->is_Canbo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb->macb;
        $data['cb_name'] = $this->cb->tencb;
        $data['task_name'] = "Xem tin tuyển dụng";
        $data['sub_views'] = 'v_xemtintuyendung';
        $matin = $this->uri->segment(3, 0);
        $dstd = $this->mtuyendung->xemtintuyendung($matin);
        if ($dstd == '') {
            $data['error'] = 'Không tìm thấy tin phù hợp';
        } else {
            $ten = $this->mcanbo->laytencanbo($dstd->NguoiDangTin);
            $inter_var_ds = array(
                'MaSo' => $dstd->MaSo,
                'TieuDe' => $dstd->TieuDe,
                'NoiDung' => $dstd->NoiDung,
                'NgayDangTin' => $dstd->NgayDangTin,
                'TenCb' => $ten[0]['TenCB'],
            );
            $data['nd'] = $inter_var_ds;
            $data['dst'] = $this->mtuyendung->laydanhsachtintuyendung();
        }

        $this->load->view('home/main_layout', $data);
    }

    public function themtintuyendung()
    {
        if (!$this->my_auth->is_Canbo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb->macb;
        $data['cb_name'] = $this->cb->tencb;
        $data['task_name'] = "Thêm tin tuyển dụng";
        $data['sub_views'] = 'v_themtintuyendung';
        if ($this->input->post('themtin', true) != '') {
            $this->mtuyendung->themtintuyendung($this->input->post('tieude'), $this->input->post('txtnd'), $this->my_auth->setDate(), $data['cb_id']);
            $this->session->set_flashdata('success_mgs', 'Đăng tin thành công!');
            redirect('canbo/thongtintuyendung');
        }
        $this->load->view('home/main_layout', $data);
    }

    public function xoatintuyendung($id)
    {
        if (!$this->my_auth->is_Canbo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb->macb;
        $data['cb_name'] = $this->cb->tencb;
        if ($id)
            return $this->mtuyendung->xoatintuyendung($id);
        return false;

        $this->load->view('home/main_layout', $data);

    }

    public function suatintuyendung()
    {
        if (!$this->my_auth->is_Canbo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb->macb;
        $data['cb_name'] = $this->cb->tencb;
        $this->mtuyendung->suatintuyendung(
            $this->input->post('MaSo'),
            $this->input->post('TieuDe'),
            $this->input->post('NoiDung'),
            $this->my_auth->setDate(),
            $data['cb_id']
        );
        //$this->load->view('home/main_layout', $data);
        return redirect("canbo/thongtintuyendung");
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Phan hoi sinh vien
     *
     **/
    public function phanhoisinhvien()
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb->macb;
        $data['cb_name'] = $this->cb->tencb;
        $ngayxn = $this->my_auth->setDate();
        $data['task_name'] = "Phản hồi sinh viên";
        $data['sub_views'] = 'v_phanhoi_sinhvien';
        $data['soluongyeucau'] = $this->mnoitru->soluongyeucau();
        $data['soluongchudedcnoiden'] = $this->mnoitru->soluongchudedcnoiden();
        $data['soluongphanhoi'] = $this->mnoitru->soluongphanhoi();
        $this->load->view('home/main_layout', $data);
    }

    public function yeucausinhvien()
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb->macb;
        $data['cb_name'] = $this->cb->tencb;
        $ngayxn = $this->my_auth->setDate();
        $data['task_name'] = "Phản hồi sinh viên";
        $data['sub_views'] = 'v_yeucau_sinhvien';
        $data['max'] = $this->mnoitru->soluongyeucau();
        $data['min'] = 10;
        $cf['base_url'] = base_url('canbo/yeucausinhvien');
        $cf['total_rows'] = $data['max'];
        $cf['per_page'] = $data['min'];
        $cf['num_link'] = 2;
        $cf['uri_segment'] = 3;
        $this->pagination->initialize($cf);
        $data['danhsachyeucau'] = $this->mnoitru->danhsachyeucau($data['min'], $this->uri->segment($cf['uri_segment']));
        $data['page_link'] = $this->pagination->create_links();
        $this->load->view('home/main_layout', $data);
    }

    public function xemyeucausinhvien()
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb->macb;
        $data['cb_name'] = $this->cb->tencb;
        $ngayxn = $this->my_auth->setDate();
        $matin = $this->uri->segment(3);
        $data['task_name'] = "Phản hồi sinh viên";
        $data['sub_views'] = 'v_xemyeucau_sinhvien';
        if (isset($_POST['xacnhan'])) {
            $content = str_replace("\r\n", "<br>", $_POST["txtnote"]);
            if ($content == '') {
                redirect('canbo/xemyeucausinhvien' . '/' . $matin);
            } else {
                $this->mnoitru->cbphanhoi($_POST['tieude'], $content, $data['cb_id'], $matin);
                $this->mnoitru->updatematin($matin);
                unset($_POST['xacnhan']);
                redirect('canbo/xemyeucausinhvien' . '/' . $matin);
            }

        }
        $data['nd'] = $this->mnoitru->xemtinphanhoi($matin);
        $data['ndtraloi'] = $this->mnoitru->traloiphanhoi($matin);
        $this->load->view('home/main_layout', $data);
    }

    public function sinhvientraloi()
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb->macb;
        $data['cb_name'] = $this->cb->tencb;
        $ngayxn = $this->my_auth->setDate();
        $data['task_name'] = "Phản hồi sinh viên";
        $data['sub_views'] = 'v_sinhvien_traloi';
        $data['max'] = $this->mnoitru->soluongphanhoi();
        $data['min'] = 10;
        $cf['base_url'] = base_url('canbo/sinhvientraloi');
        $cf['total_rows'] = $data['max'];
        $cf['per_page'] = $data['min'];
        $cf['num_link'] = 2;
        $cf['uri_segment'] = 3;
        $this->pagination->initialize($cf);
        $data['danhsach'] = $this->mnoitru->danhsachsinhvientraloi($data['min'], $this->uri->segment($cf['uri_segment']));
        $data['page_link'] = $this->pagination->create_links();
        $this->load->view('home/main_layout', $data);
    }

    public function chudedcnoiden()
    {
        if (!$this->my_auth->is_CanBo()) {
            redirect("canbo/login");
        }
        $data['cb_id'] = $this->cb->macb;
        $data['cb_name'] = $this->cb->tencb;
        $ngayxn = $this->my_auth->setDate();
        $data['task_name'] = "Chủ đề được nói đến";
        $data['sub_views'] = 'v_chude_sinhvien';
        $data['max'] = $this->mnoitru->soluongchudedcnoiden();
        $data['min'] = 10;
        $cf['base_url'] = base_url('canbo/chudedcnoiden');
        $cf['total_rows'] = $data['max'];
        $cf['per_page'] = $data['min'];
        $cf['num_link'] = 2;
        $cf['uri_segment'] = 3;
        $this->pagination->initialize($cf);
        $data['danhsachchude'] = $this->mnoitru->chudedcnoiden($data['min'], $this->uri->segment($cf['uri_segment']));
        $data['page_link'] = $this->pagination->create_links();
        $this->load->view('home/main_layout', $data);
    }
}
