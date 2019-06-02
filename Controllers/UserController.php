<?php
class UserController
{
    public function actionRegistered() {
        session_start();
        include_once(ROOT.'/Assets/Repository/UserRepository.php');
        $User = new User();
        $User->Login = $_REQUEST['login'];
        $User->Password = $_REQUEST['password'];
        $User->Email = $_REQUEST['email'];
        $password_sec = $_REQUEST['password_sec'];
        if($User->Password == $password_sec){
            $res = UserRepository::addUser($User);
            if(is_numeric($res)) {
                $_SESSION['id'] = $res;
                $_SESSION['login'] = $User->Login;
                session_write_close();
                $host = $_SERVER['HTTP_HOST'];
                header("Location: http://$host/");
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
            $_SESSION['login'] = $res->Login;
            session_write_close();
            $host = $_SERVER['HTTP_HOST'];
            header("Location: http://$host/");
            return true;
        } else {
            $host = $_SERVER['HTTP_HOST'];
            $_SESSION['error']='Неверные данные';
            header("Location: http://$host/login/");
            return true;
        }
    }
}