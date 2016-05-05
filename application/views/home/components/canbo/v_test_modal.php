<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="">
</head>
<body>
    <form action="http://localhost.testing/modal-processing.php" class="form-horizontal" role="form" method="GET">
    <label>Landlord<span class="mandatory">*</span></label>
    <select class="form-control input-sm chosen chzn-select" tabindex="1" data-placeholder="Choose a landlord" data-rule-required="true" name="landlord_id" id="landlord_id">
        <option value=""></option>
        <option value="31" >Liam Lawlor</option>
        <option value="34" >Damian Lavelle</option>
        <option value="35" >Mick Lally</option>
        <option value="36" >Joanne Lavelle</option>
        <option value="37" >Liam Lacey</option>
        <option value="38" >Laura Luney</option>
        <option value="39" >Lenihan Enterprises</option>
    </select>

    <!-- modal caller -->
    <a href="#modal-dialog" class="modal-toggle" data-toggle="modal" data-href="http://localhost.testing/modal-processing.php" data-modal-type="confirm" data-modal-title="Delete Property" data-modal-text="Are you sure you want to delete {$property.address_string}?" data-modal-confirm-url="{$base_url}residential-lettings/properties/do-delete/property/{$property.id}"><i class="icon-trash"></i> Modal Submit</a>

    <!-- proper submit -->
    <input type="submit">
</form>
</body>
</html>