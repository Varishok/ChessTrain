<?php
class GroupsController {

    public function actionIndex() {
        require_once(ROOT.'/Views/Groups/groups.php');
        return true;
    }

}
