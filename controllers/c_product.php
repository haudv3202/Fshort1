<?php
class c_product {
    public function __construct()
    {
    }

    public function index() {
        include ("models/m_product.php");
        $m_product = new m_product();
        $products = $m_product->read_product();

        // gọi phương thức read_product vào đây ;
        $view = "views/listproduct/v_listproduct.php";
        include ("templates/front-end/layout.php");
    }
}
?>