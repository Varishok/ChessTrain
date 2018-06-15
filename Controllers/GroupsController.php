<?php
class GroupsController {

    public function actionGroups() {
        require_once(ROOT.'/Views/Groups/groups.php');
        return true;
    }

}
