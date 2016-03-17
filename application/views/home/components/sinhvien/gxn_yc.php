<script type="text/javascript">
    $(document).ready(function(){
        $('#message-box').hide();
        $('#send').click(function(){
            if($('input[type=checkbox]').is(':checked')){
                return true;
            } else {
                $('#message-box').show().html('<strong>* Vui lòng lựa chọn loại giấy!</strong>');
                return false;
            }
        });
    });
</script>

<h3>Yêu Cầu Cấp Giấy Xác Nhận</h3>
<div id="message-box" class="alert alert-error" style="display:none;">

</div>
<div class="span4 ">
    <form action="<?php echo base_url('sinhvien/yeucaucapgiay'); ?>" method="post">
        <label>Mã Học Kỳ: <input type="hidden" name="mahk" value="<?php echo $mahk; ?>" /><?php echo $mahk; ?></label>
        <?php
        foreach($listGXN as $list)
        {
            echo '<label class="checkbox">
                        <input type="checkbox" id="lg'.$list['MaLG'].'" name="lgiay[]" value="'.$list['MaLG'].'">'.$list['TenLG'].'
                    </label>';
        }
        ?>
            
        <div>
            <input type="submit" name="send" id="send" class="btn btn-primary" value="Gửi Yêu Cầu" />
        </div>
    </form>
</div>

<div class="alert span7 alert-error">  
    Chú ý: <br />
	Nếu Sinh Viên nào <b>Yêu Cầu</b> nhưng <b>không lấy giấy xác nhận</b> thì <b>"cuối kì"</b> sẽ bị <b>trừ điểm rèn luyện</b><br />
	Mong Sinh Viên chú ý!!!
</div>
<?php if(isset($error)) : ?>
<div class="alert span11">
<?php
if($error == '1'){
    echo "Gửi giấy xác nhận thành công! <br />Vui lòng đợi xác nhận từ Phòng CT HSSV.";
} else if($error == '0') {
    echo "Có lỗi xảy ra trong quá trình xử lý. Vui lòng thử lại!";
}
?>
</div>
<?php endif; ?>
