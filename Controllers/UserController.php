<?php
class UserController
{
    public function actionRegistered() {
        session_start();
        include_once(ROOT.'/Assets/Repository/UserRepository.php');
        $User = new User();
        $User->Login = $_REQUEST['login'];
        $User->Name = $_REQUEST['username'];
        $User->Password = $_REQUEST['password'];
        $password_confirm = $_REQUEST['password_confirm'];
        if($User->Password == $password_confirm){
            $res = UserRepository::addUser($User);
            if(is_numeric($res)) {
                $_SESSION['id'] = $res;
                $_SESSION['username'] = $User->Name;
                session_write_close();
                $host = $_SERVER['HTTP_HOST'];
                header("Location: http://$host/login");
            }
            else
                return false;
        }
        else{
            return false;
        }
        return true;
    }
    public function actionLogin(){
        session_start();
        include_once(ROOT.'/Assets/Repository/UserRepository.php');
        $login = $_REQUEST['login'];
        $password = $_REQUEST['password'];
        $res = UserRepository::logIn($login,$password);
        if($res){
            $_SESSION['id'] = $res->Id;
            $_SESSION['username'] = $res->Name;
            session_write_close();
            $host = $_SERVER['HTTP_HOST'];
            header("Location: http://$host/groups");
        } else {
            return false;
        }
        return true;
    }
}