<?php
include_once(APPPATH."/views/home/includes/header.php");
?>
<div class="container">
    <div class="alert alert-error text-center">
        <h1><?php echo $heading; ?></h1>
        <p>
            <?php echo $message; ?>
        </p>
        <a href="<?php echo base_url();?>" class="btn btn-inverse">Trở về</a>
<?php include_once(APPPATH."/views/home/includes/footer.php"); ?>
