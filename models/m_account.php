<?php
require_once ("database.php");
class m_account extends database {
    public function add_account($name,$email,$password,$token_user){
        $sql = 'INSERT INTO account (id,name, email, password, create_date,token_user) VALUES (NULL,?,?,?,CURRENT_TIMESTAMP(),?)';
        $this->setQuery($sql);
        return $this->execute(array($name,$email,md5($password),$token_user));
    }
}