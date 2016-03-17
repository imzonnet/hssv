<?php

class MGiayXN extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('mhocky','msinhvien'));
    }
    
    /**
     * Lấy ds các loại giấy
     * Return array()
     **/
     
    public function listGXN($malg=0)
    {
        $sql = $malg == 0 ?"SELECT * FROM loaigiay" : "SELECT * FROM loaigiay WHERE MaLG = '$malg'";
        $rs = $this->db->query($sql);
        if($rs->num_rows()>0)
            return $rs->result_array();
        else
            return false;
    }
    /**
     * Luu thong tin yeu cau cap giay cua SV 
     * 
     **/
     
    public function luuYeuCau($masv, $lgiay, $ngayyc,  $mahk = "")
    {
        if(!$this->msinhvien->checkMSV($masv)) return false;
        
        $mahk = $mahk != "" ? $mahk: $this->mhocky->getMHK();
        
        $sql  = "INSERT INTO yeucaucapgiay(MaSV,NgayYC) VALUES ('$masv','$ngayyc')";
        //echo $sql;
        $rs = $this->db->query($sql);
        if(!$rs) return false;
        $mayc = $this->getMaYC($masv, $ngayyc);
        if(!$mayc) return false;
        foreach($lgiay as $k => $vl){
            $sql = "INSERT INTO chitietyeucau(MaYC,MaLG,MaHK) VALUES ('$mayc','$vl','$mahk')";
            //echo $sql;
            $rs = $this->db->query($sql);
            if(!$rs) return false;
        }
        return true;
    }
    
    /**
     * Lay toan bo thong tin yeu cau cap giay
     * @param $masv, $mayc, $limit, $offset
     * @Return array()
     **/
     
    public function listYCCG($masv = false, $mayc = false, $limit = false, $offset = 0)
    {
        /**
        $this->db->select("y.mayc, y.ngayyc, c.mahk, count(y.mayc) as sodon");
        $this->db->from('YeuCauCapGiay as y');
        $this->db->join('chitietyeucau as c','c.MaYC = y.MaYC');
        $rs = $this->db->get();
        */
        $sql = "SELECT y.mayc, y.masv, y.ngayyc, c.mahk, count(y.mayc) as sodon
                FROM yeucaucapgiay y, chitietyeucau c 
                WHERE c.MaYC = y.MaYC";
        if($masv) $sql .= " and y.MaSV = '$masv'";
        if($mayc) $sql .= " and y.mayc = '$mayc'";
        $sql .= " GROUP BY y.MaYC DESC";
        $offset = $offset > 0 ? $offset : 0;
        if($limit) $sql .= " limit $offset,$limit";
        $rs = $this->db->query($sql);
        
        if($rs->num_rows()>0){
            return $rs->result_array();
        } else{
            return false;
        }
    } 

    /**
     * Xem thong tin chi tiet cua yeu cau cap giay
     * Return array()
     */
    
    public function xemChiTietYCCG($mayc = 0)
    {
        $sql = "SELECT c.mahk, c.ngayxn, c.trangthai, y.masv, c.malg, 
                    CASE c.trangthai 
                        WHEN 0 THEN 'Chờ xác nhận' 
                        WHEN 1 THEN 'Đã In' 
                        WHEN '-1' THEN 'Hủy Bỏ' 
                    END as tinhtrang,
                    (SELECT TenLG FROM loaigiay WHERE MaLG = c.MaLG) as tenlg
                FROM yeucaucapgiay y, chitietyeucau c
                WHERE y.mayc = c.mayc and y.mayc = '$mayc'";
        //if($masv != 0) $sql .= " and y.masv = '$masv'";
        //if($mayc != 0) $sql .= " and y.masv = '$mayc'";
        $rs = $this->db->query($sql);
        if($rs->num_rows()>0){
            return $rs->result_array();
        } else{
            return false;
        }
    }

    /**
     * Lay ma yeu cau cua SV
     * Return int
     **/
    
    public function getMaYC($masv, $ngayyc)
    {
        $sql = "SELECT MaYC FROM yeucaucapgiay WHERE MaSV = '$masv' and NgayYC = '$ngayyc'";
        $rs = $this->db->query($sql);
        if($rs->num_rows()>0){
            $dt = $rs->row_array();
            return $dt['MaYC'];
        } else{
            return false;
        }
    }
   
    /****************************************************************
                Xử Lý Yêu Cầu
                   Cán Bộ
    ****************************************************************/
    /**
     * Xác nhận yêu cầu
     * @param $masv, $mahk, @mayc
     * @return boolean
     */
    
    public function checkTTSV($masv, $mahk)
    {
        //kiem tra trang thai cua sinh vien
        $trangthai =  $this->msinhvien->checkTrangThai($masv);
        //kiem tra tinh trang hoc phi cua sinhvien
        $hp = $this->msinhvien->checkHocPhi($masv,$mahk);
        if($trangthai == '1'){
            if($hp==-1) return -1;
            if($hp==0)  return 0;
            if($hp==1)  return 1;
        }else 
            return -2;
    }
    
    /**
     * Lấy Mã Xác Nhận từ Mã Yêu Cầu
     * */
    public function getMXN($mayc)
    {
        $sql = "SELECT maxn FROM giayxacnhan WHERE MaYC='$mayc'";
        $rs = $this->db->query($sql);
        if($rs->num_rows()>0)
        {
            $ft = $rs->row_array();
            return $ft['maxn'];
        }else return false;
    }
    /**
     * Kiem tra giay da in
     */
    
    public function checkGiay($masv, $mahk, $malg)
    {
        $sql = "SELECT * FROM chitietgiayxacnhan WHERE MaSV='$masv' and MaHK='$mahk' and MaLG='$malg'";
        //echo $sql;
        $rs = $this->db->query($sql);
        if($rs->num_rows()>0)
            return $rs->row_array();
        else
            return false;
    }
    /**
     * Kiem tra thong tin loai giay
     **/
     
    public function checkLG($mayc, $malg, $mahk)
    {
        $this->db->where(array("MaYC"=>$mayc,"MALG"=>$malg, "MaHK"=>$mahk));
        $db = $this->db->get("chitietyeucau");
        if($db->num_rows()>0) return true;
        else return false;
    } 
    /**
     * Xac Nhan Yeu Cau Cap Giay Va Luu Thon Tin Giay Xac Nhan
     **/
    public function xnYeuCau($masv, $mayc, $malg, $mahk,$ngayxn, $tt, $nx = "")
    {
        
        if(!$this->getMXN($mayc))
            $rs = $this->db->query("INSERT INTO giayxacnhan(MaYC) VALUES ('$mayc')");
        $sv     = $this->msinhvien->setInfo($masv);
        $maxn = $this->getMXN($mayc);
        
        if(!$this->checkGiay($masv, $mahk, $malg))
        {
            $sql = "INSERT INTO chitietgiayxacnhan(MaXN,MaSV,MaHK,DiaChiNhan,NhanXet,NgayXN,MaLG)
                        VALUES('$maxn','$masv','$mahk','".$sv->maphuong."','$nx','$ngayxn','$malg')";
            $rs1 = $this->db->query($sql);
            $this->db->query("UPDATE chitietyeucau SET NgayXN='$ngayxn', TrangThai='$tt' WHERE MaYC='$mayc' and MaLG='$malg' and MaHK='$mahk'"); 
            return $maxn;                   
        } else {
            $this->db->query("UPDATE chitietyeucau SET NgayXN='$ngayxn', TrangThai='$tt' WHERE MaYC='$mayc' and MaLG='$malg' and MaHK='$mahk'");
            $this->db->query("UPDATE chitietgiayxacnhan SET SoLanCap=SoLanCap+1 WHERE MaSV='$masv' and MaHK='$mahk' and MaLG='$malg'");
            $kq = $this->checkGiay($masv, $mahk, $malg);
            return $kq;
        }
    }
    /**
     * Hủy bỏ yêu cầu
     * 
     */
    public function huyYCCG($mayc, $malg, $mahk, $ngayxn, $ghichu="")
    {
        $this->db->query("UPDATE chitietyeucau SET NgayXN='$ngayxn', TrangThai='-1', GhiChu='$ghichu' WHERE MaYC='$mayc' and MaLG='$malg' and MaHK='$mahk'");
    }
    /**
     * 
     */
    public function xoaLG($mayc, $malg, $mahk)
    {
        $this->db->query("DELETE FROM chitietyeucau WHERE MaYC='$mayc' and MaLG='$malg' and MaHK='$mahk'");
    }
    /**
     * 
     */
    public function deleteYCCG($masv, $mayc, $mahk)
    {
        $rs = $this->db->query("SELECT * FROM giayxacnhan WHERE MaYC='$mayc'");
        if($rs->num_rows()<1) {
            $this->db->query("DELETE FROM yeucaucapgiay WHERE MaYC='$mayc'and MaSV='$masv'");    
        }
        $this->db->query("DELETE FROM chitietyeucau WHERE MaYC='$mayc'and MaHK='$mahk'");
    
    }
    /**
     *  Kiem tra yccg cua sinh vien
     */
    public function checkYCCG($masv,$mayc) 
    {
        $this->db->where(array('MaSV'   =>  $masv, 'MaYC'   =>  $mayc));
        $rs = $this->db->get('yeucaucapgiay');
        if($rs->num_rows()>0) return true;
        else return false;
    }
}