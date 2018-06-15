<?php


class IndexController {

    public function actionIndex() {
        require_once(ROOT.'/Views/Index/index.php');
        return true;
    }

    public function actionLogin() {
        require_once(ROOT.'/Views/Index/login.php');
        return true;
    }
}
