<?php
class IndexController {
    public function actionIndex() {
        $view = '/Views/Index/index.php';
        render();
        return true;
    }
    public function actionLogin() {
        session_start();
        include_once(ROOT.'/Assets/Repository/UserRepository.php');
        if(!empty($_SESSION['id']) && !empty($_SESSION['login'])){
            if(UserRepository::getUser($_SESSION['id'],$_SESSION['login'])){
                $host = $_SERVER['HTTP_HOST'];
                header("Location: http://$host/");
                return true;
            }
        } else {
            $view = '/Views/Index/login.php';
            render($view);
            return true;
        }
    }
    public function actionRegistered() {
        $view = '/Views/Index/registered.php';
        render($view);
        return true;
    }
    public function actionLogout(){
        session_start();
        unset($_SESSION);
        session_destroy();
        header('Location: /');
        return true;
    }
    public function actionSettings(){
        require_once(ROOT.'/Views/Profile/settings.php');
        return true;
    }
}