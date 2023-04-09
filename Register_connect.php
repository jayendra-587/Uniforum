<?php
if(empty($_POST['First_Name']))
{
    $msg = '<font color ="red"><b> Field for First_Name is empty!</b></font>';
    include("Register.php");
    exit;
}

?>
