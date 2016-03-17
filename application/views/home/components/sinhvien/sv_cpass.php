<form class="form-horizontal" method="post" action="sinhvien/changepass" id="changepass">
    <div class="control-group">
        <label class="control-label">Mật khẩu cũ:</label>
        <div class="controls">
            <input type="password" name="pass" value="" />
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Mật khẩu mới:</label>
        <div class="controls">
            <input type="password" name="newpass" value="" class="newpass"/>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Xác nhận mật khẩu:</label>
        <div class="controls">
            <input type="password" name="repass" value="" />
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <input type="submit" name="done" value="Xác Nhận" class="btn btn-primary" />
            <input type="reset" value="Nhập lại" class="btn"/>
        </div>
    </div>
</form>
<script>
$(document).ready(function(){
    $('#changepass').validate({
        rules : {
            pass : {
                required : true,
                minlength : 5
            },
            newpass : {
                required : true,
                minlength : 5
            },
            repass : {
                required : true,
                minlength: 5,
                equalTo : ".newpass"
            }
        },
        messages : {
            pass : {
                required : "Không được để trống.",
                minlength : "Vui lòng nhập nhiều hơn 5 ký tự."
            },
            newpass : {
                required : "Không được để trống.",
                minlength : "Vui lòng nhập nhiều hơn 5 ký tự."
            },
            repass : {
                required : "Không được để trống",
                equalTo : "Không trùng với mật khẩu mới."
            }
        }
    });
});
</script>