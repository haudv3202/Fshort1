<?php
//if (isset($_POST['login'])) {
//    echo $_POST['username'];
//}
include ("controllers/c_user.php");
$c_user = new c_user();
$c_user->checkLogin();
//gọi phương thức checklogin ra đây