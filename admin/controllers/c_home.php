<?php
class c_home {
    public function index() {
        $view = "views/home/v_home.php";
       include ("templates/layout.php");
    }
}
// làm tính năng đăng nhập nhảy vào trang home.php
// nếu như không đăng nhập mà vào link của home.php sẽ bị bật về trang login
// làm tính năng đăng xuất
//cắt trang chart html