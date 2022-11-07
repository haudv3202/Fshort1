<?php
@session_start();
    include("controllers/c_register_login.php");
    $c_register = new c_register_login();
    $c_register->token_verification();
