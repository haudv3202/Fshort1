<?php
include ("models/m_banner.php");
class c_banner {
    public function showbanner() {
        $m_banner = new m_banner();
        $banners = $m_banner->read_banner();
        $view = "views/banner/v_banner.php";
        include ("templates/layout.php");
    }
    public function addbanner() {
        if (isset($_POST['btn-submit'])) {
            $ma_tieu_de = NULL;
            $ten_tieu_de = $_POST['ten_tieu_de'];
            $trang_thai = $_POST['trang_thai'];
            //lấy được tên của hình ảnh
//            echo "<pre>";
//            echo print_r($_FILES['f_hinh_anh']);
//            die();
            $hinh_tieu_de = ($_FILES['f_hinh_anh']['error'] == 0) ? $_FILES['f_hinh_anh']['name'] :"";
            $banner = new m_banner();
           $result = $banner->insert_banner($ma_tieu_de,$ten_tieu_de,$hinh_tieu_de,$trang_thai);
           if ($result) {
               if ($hinh_tieu_de != "") {
                   //di chuyển hình ảnh vào thư mục source
                   move_uploaded_file($_FILES['f_hinh_anh']['tmp_name'],"../public/layout/imagebanner/".$hinh_tieu_de);
               }
               echo "<script>alert('thành công')</script>";
           } else {
               echo "<script>alert('thêm không thành công')</script>";
           }
        }
        $view = "views/banner/v_addbanner.php";
        include ("templates/layout.php");
    }

    public function editbanner() {
        $m_banner = new m_banner();
        if (isset($_GET['ma_tieu_de'])) {
            $ma_tieu_de = $_GET['ma_tieu_de'];
            $banner_detail = $m_banner->read_banner_by_id_banner($ma_tieu_de);
            if ($_POST['btn-submit']) {
                $ten_tieu_de = $_POST['ten_tieu_de'];
                $trang_thai = $_POST['trang_thai'];
                $hinh_tieu_de = ($_FILES['f_hinh_anh']['error'] == 0) ? $_FILES['f_hinh_anh']['name'] :$banner_detail->hinh;
                // y sì như phần thêm
            }


        }
        $view = "views/banner/v_editbanner.php";
        include ("templates/layout.php");
    }

    // tạo được view editbanner
}