<?php
include ("models/m_user.php");
@session_start();
class c_user {
    public function checkLogin() {
        if (isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $this->saveLoginSession($username,$password);
            if (isset($_SESSION['user'])) {
                //nhảy vào trang index // kiểm tra có session mới cho nhảy
                //xử lý nút đăng xuất
                header("location:home.php");
            }  else {
                $_SESSION['error_login'] = "Sai thông tin đăng nhập";
                header("location:login.php");
            }
//            $sql = "select * from nguoi_dung where ten_dang_nhap = $username and mat_khau = $password";
//            echo $sql;
            //gọi và xử lý tính năng đăng nhập nếu thành công thì hiển thị ra 123 rồi dừng
            //nếu không thành công quay trở lại trang login và hiển thị ra bạn đã sai tài khoản
        }
    }

    public function logout() {
        unset($_SESSION['user']);
        unset($_SESSION['error_login']);
        header("location:login.php");
    }

    public function saveLoginSession($username,$password) {
        $m_user = new m_user();
        $user = $m_user->read_user_by_id_pass($username,$password);
        if(!empty($user)) {
              $_SESSION['user'] = $user;
        }
    }
}