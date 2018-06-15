<?php


class IndexController {

    public function actionIndex() {
        require_once(ROOT.'/Views/Index/index.php');
        return true;
    }

}
