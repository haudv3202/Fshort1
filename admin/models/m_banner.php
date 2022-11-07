<?php
require_once ("database.php");
class m_banner extends database {
    public function insert_banner($ma_tieu_de,$ten_tieu_de,$hinh,$trang_thai) {
        $sql = "insert into tieu_de values (?,?,?,?)";
        $this->setQuery($sql);
        return $this->execute(array($ma_tieu_de,$ten_tieu_de,$hinh,$trang_thai));
    }

    public function read_banner() {
        $sql = "select * from tieu_de";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function read_banner_by_id_banner($ma_tieu_de) {
        $sql = "select * from tieu_de where ma_tieu_de = ?";
        $this->setQuery($sql);
        return $this->loadRow(array($ma_tieu_de));
    }

    public function edit_banner($ma_tieu_de,$ten_tieu_de,$hinh,$trang_thai) {
        $sql = "update tieu_de set ten_tieu_de = ?,hinh = ?,trang_thai = ? where
                ma_tieu_de = ?";
        $this->setQuery($sql);
        return $this->execute(array($ten_tieu_de,$hinh,$trang_thai,$ma_tieu_de));
    }



}