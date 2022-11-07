<?php
include_once ("database.php");
class m_user extends database {
    //
    public function read_user_by_id_pass($username,$password) {
        $sql = "select * from nguoi_dung where ten_dang_nhap = ? and mat_khau = ?";
        $this->setQuery($sql);
        return $this->loadRow(array($username,md5($password)));
        //gọi và xử lý tính năng đăng nhập nếu thành công thì hiển thị ra 123 rồi dừng
        //nếu không thành công quay trở lại trang login và hiển thị ra bạn đã sai tài khoản
    }
}

