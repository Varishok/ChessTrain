<?php


class IndexController {

    public function actionIndex() {
        require_once(ROOT.'/Views/Index/index.php');
        return true;
    }

    public function loginIndex() {
        require_once(ROOT.'/Views/Index/reg.php');
        return true;
    }
}
