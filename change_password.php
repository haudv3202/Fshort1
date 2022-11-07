<?php
@session_start();
if(isset($_SESSION['userinfo'])){
    include("controllers/c_register_login.php");
    $c_register = new c_register_login();
    $c_register->change_password();
}else {
    header('location:register.php');
}