<?php
class GroupsController {
    public function actionGroups() {
        include_once(ROOT.'/Assets/Repository/GroupRepository.php');
        $groups = GroupRepository::getGroups();
        require_once(ROOT.'/Views/Groups/groups.php');
        return true;
    }
    public function actionAddgroup(){
        include_once(ROOT.'/Assets/Repository/GroupRepository.php');
        $Group = new Group();
        $Group->Name = $_REQUEST['namegroup'];
        $res = GroupRepository::addGroup($Group);
        if(is_numeric($res)){
            $host = $_SERVER['HTTP_HOST'];
            header("Location: http://$host/groups");
            return true;
        }
        return false;
    }
}