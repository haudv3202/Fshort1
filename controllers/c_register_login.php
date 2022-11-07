<?php
@session_start();
include ("models/m_account.php");
class c_register_login {
    protected $account;
    function __construct(){
        $this->account = new m_account();
    }

    public function index() {
        require_once ('google/config.php');
        $view = "views/resgister_login/v_register.php";
        include ("templates/login_register/layout.php");
    }

    public function login(){

        $view = "views/resgister_login/v_login.php";
        include ("templates/login_register/layout.php");
    }

    public function token_verification(){
        require_once ('google/config.php');
        require_once ("mail/SendMail.php");
        if (isset($_GET['code'])) {
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
            $client->setAccessToken($token['access_token']);

            // get profile info
            $google_oauth = new Google_Service_Oauth2($client);
            $google_account_info = $google_oauth->userinfo->get();

            $_SESSION['userinfo']  = [
                'email' => $google_account_info['email'],
                'full_name' => $google_account_info['name'],
                'token_user' => $google_account_info['id'],
            ];

            if(!empty($_SESSION['userinfo'])){
                $token = substr(rand(0,999999),0,6);
                $title = "Token password";
                $content = "Your verification code is " . "<b>$token</b>";
                $result_mail = send_token($title,$content,$_SESSION['userinfo']['email']);
                $_SESSION['userinfo']['token_check'] = $token;

            }

            header("location:token_pass.php");
        }
    }

    public function token_pass(){
        if(isset($_POST['token_submit'])){
            $user_token = $this->checkData('token');
            if(!empty($user_token)){
                if($user_token == $_SESSION['userinfo']['token_check']){
                    $_SESSION["success"] = 'Thành công vui lòng nhập mật khẩu';
                    header('Location:change_password.php');
                }else {
                    $_SESSION["error"] = 'Token sai';
                }
            }
        }

        $view = "views/resgister_login/v_token_verification.php";
        include ("templates/login_register/layout.php");
    }

    public function change_password(){
        if(isset($_POST["submit_account"])){
            $pass = $this->checkData('new_pass');
            $ress_pass = $this->checkData('ress_pass');
            if($pass == $ress_pass){
                $result = $this->account->add_account($_SESSION['userinfo']['full_name'],$_SESSION['userinfo']['email'],$pass,$_SESSION['userinfo']['token_user']);
                if($result){
                    header('location:index.php');
                }else {
                    echo 'Lỗi ';
                }
            }
        }
        $view = "views/resgister_login/v_change_password.php";
        include ("templates/login_register/layout.php");
    }
    protected function checkData($name_post){
        $namePost = $_POST["{$name_post}"] == "" ? "" : $_POST["{$name_post}"];
        return $namePost;
    }
}
