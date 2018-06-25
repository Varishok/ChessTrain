<?php
class IndexController {
    public function actionIndex() {
        require_once(ROOT.'/Views/Index/index.php');
        return true;
    }
    public function actionLogin() {
        session_start();
        include_once(ROOT.'/Assets/Repository/UserRepository.php');
        if(!empty($_SESSION['id']) and !empty($_SESSION['username'])){
            if(UserRepository::getUser($_SESSION['id'],$_SESSION['username'])){
                $host = $_SERVER['HTTP_HOST'];
                header("Location: http://$host/groups");
                return true;
            }
        } else {
            require_once(ROOT.'/Views/Index/login.php');
            return true;
        }
    }
    public function actionSettings(){
        require_once(ROOT.'/Views/Profile/settings.php');
        return true;
    }
}