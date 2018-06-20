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
                header('Location: http://myprojects/groups');
                return true;
            }
        } else {
            require_once(ROOT.'/Views/Index/login.php');
            return true;
        }
    }
}