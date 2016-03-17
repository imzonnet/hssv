<h3 class="text-center">Danh sách đối tượng chính sách của sinh viên</h3>
<div class="alert alert-error">
Thông tin này cần thiếc cho mọi hồ sơ của SV nên 
    SV vui lòng lựa chọn đúng đối tượng của mình.<br />SV Chịu trách nhiệm cho việc lựa chọn này<br />
</div>
<form name="frmDoiTuong" id="frmDoiTuong" class="form-horizontal" action="<?php echo site_url('sinhvien/doituong'); ?>" method="POST">
    <div class="control-group" id="doituong">
        <?php echo $doituong; ?>
    </div>
    <div class="control-group">
        <div class="controls">
            <a href="sinhvien" class="btn btn-inverse">Trở về</a>
            <input type="submit" name="update" value="Cập nhật" class="btn btn-primary" id="submit" />
        </div>
    </div>
</form>
<script type="text/javascript">
$(document).ready(function(){
    $("#submit").click(function(){
        var doituong = [];
        if(!$('#frmDoiTuong input[type="checkbox"]').is(':checked')){
            alert("Đối tượng không được để trống");
            return false;
        }
        $(':checkbox:checked').each(function(i){
          doituong[i] = $(this).val();
        });
        
        var submit = $("#submit").val();
        $('body').append('<div id="overlay"></div><div id="preloader">Đang xử lý..</div>');
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url(); ?>sinhvien/doituong',
            data: { "doituong":doituong,"update" : 'ok', "ajax" : 'true'},
            dataType: 'json',
            success: function(data) {
                $('#overlay, #preloader').fadeOut('fast', function(){$(this).remove()});
                if(data.stt == 1) {
                    alert('Cập nhật thành công');
                    loaddt();
                } else {
                    alert('Error');
                }
            }
        });
        return false; 
    });
    
    function loaddt() {
        var pid = $('#pid').val();
        $.get('<?php echo site_url()."sinhvien/ajaxDoiTuong";?>', function(data) {
            $('#doituongt').html(data);
        });
    }

});
</script>