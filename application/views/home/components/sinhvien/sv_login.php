<div class="container-inner well">
<script type="text/javascript">
$(document).ready(function(){
    $("#submit").click(function(){
        var users = $("#user").val();
        var passs = $("#pass").val();
        var submit = $("#submit").val();
        if(users.length < 12 || passs.length <5) 
        {
            $('.alert').removeClass('alert-success').removeClass('alert-error').addClass('alert-info');
            $('.alert-message').html("Vui lòng kiểm tra lại thông tin!");
        } else {
            $('body').append('<div id="overlay"></div><div id="preloader">Đang kiểm tra..</div>');
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url(); ?>sinhvien/login',
                data: {"user":users, "pass":passs, "login" : submit, "ajax" : 'true'},
                dataType: 'json',
                success: function(data) {
                    $('#overlay, #preloader').fadeOut('fast', function(){$(this).remove()});
                    if(data.stt==1){
                        $('#myModal').modal('toggle');
                    } else {
                        $('.alert').removeClass('alert-success').removeClass('alert-info').addClass('alert-error');
                        $('.alert-message').html("Thông tin tài khoản không đúng!");
                    }
                }
            });
        }
        return false; 
    });
    $('#btn-ok').click(function(){location.href='<?php echo site_url();?>sinhvien';})
});
</script>

    <div class="alert">
        <p class="alert-message">Vui lòng đăng nhập</p>
    </div>
    <!--form login-->
    <form action="<?php echo site_url(); ?>sinhvien/login" class="form-signin" method="post">
        <h2 class="form-signin-heading">Đăng nhập</h3>
        <div class="input-prepend">
            <span class="add-on"><i class="icon-user"></i></span>
            <input type="text" id="user" name="user" class="input-block-level" placeholder="Mã sinh viên" />
        </div><br />
        
        <div class="input-prepend">
            <span class="add-on"><i class="icon-lock"></i></span>
            <input type="password" id="pass" name="pass" class="input-block-level" placeholder="Mật khẩu" />
        </div><br />
        
        <input type="reset" name="reset" class="btn" value="Nhập Lại"/>
        <input type="submit" id="submit" name="login" class="btn btn-primary" value="Đăng Nhập"/>
    </form>
    
    <!-- Modal -->
    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <h3 id="myModalLabel">Đăng nhập thành công</h3>
        </div>
        <div class="modal-body">
            <p>Đăng nhập vào hệ thống quản lý thành công. <br /> Nhấn "Tiếp Tục" để vào trang quản lý</p>
        </div>
        <div class="modal-footer">
            <button id="btn-ok" class="btn btn-primary">Tiếp tục</button>
        </div>
    </div>
</div>