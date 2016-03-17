<?php
include_once("includes/header.php");
?>
<div class="container">
<?php
$msg = 'Yêu cầu không hợp lệ!!!';
$class = 'error';
if(isset($error)) {
    switch($error)
    {
        case 111 :
            $msg = "Thành công"; 
            $class = 'success';
            break;
        case 100 :
            $msg = "Không tìm thấy thông tin yêu cầu";
            break;
        case 101 :
            $msg =  "Mã sinh viên không hợp lệ!"; break;
        case 103 :
            $msg = "Sinh viên đã tốt nghiệp, đang bảo lưu hoặc đã bị đuổi học!"; 
            $class = 'info';
            break;
        case 202 :
            $msg =  "Đã hủy bỏ yêu cầu!"; break;
        case 300 :
            $msg =  "Không tìm thấy danh sách nào!"; break;
        case 302 :
            $msg =  "Đã xóa địa chỉ này!";
            $class = 'success';
            break;
        case 404  :
            $msg =  "Không tìm thấy tập tin";
            break;
        case 400:
            $msg = "Thông tin mật khẩu mới không khớp!";
            break;
        case 401 :
            $msg = "Thông tin mật khẩu không chính xác!";
            break;
        case 999 :
            $msg =  "Chức năng đang được xây dựng";
            $class='info';
            break;
        default:
            $msg =  "Yêu cầu không hợp lệ!"; break;
    }
}
?>
    <div class="alert alert-<?php echo $class; ?> text-center">
        <p>
            <?php echo $msg; ?>
        </p>
        <a href="<?php echo isset($url) ? $url : base_url();?>" class="btn btn-inverse">Trở về</a>
<?php include_once("includes/footer.php"); ?>