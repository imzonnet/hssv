<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Test Address Ajax</title>
    <script src="<?php echo base_url("templates/js/jquery.js");?>"></script>
</head>
<body>
<script type="text/javascript">
    $(document).ready(function(){
        //alert('sss');
        $('#quan').hide();
        $('#phuong').hide();
        $('#tinh').change(function(){
            $('#phuong').hide();
            var tinh = $('#tinh').val();
            $.ajax({
                type: 'GET',
                url: '<?php echo site_url(); ?>test/dsquan/'+tinh,
                success: function(data) {
                    $('#quan').show().html(data);
                }
            });
        });
        $('#quan').change(function(){
            var quan = $('#quan').val();
            $.ajax({
                type: 'GET',
                url: '<?php echo site_url(); ?>test/dsphuong/'+quan,
                success: function(data) {
                    $('#phuong').show().html(data);
                }
            });
        });
    });
</script>
<form action="<?php echo base_url('test/index'); ?>" method="get">
    <select name="tinh" id="tinh"><?php echo $tinh; ?></select>
    <select name="quan" id="quan"></select>
    <select name="phuong" id="phuong"></select><br />
    <input type="submit" name="submit" />
</form>


</body>
</html>