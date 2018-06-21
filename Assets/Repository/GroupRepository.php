<?php
    include(ROOT.'/Models/Group.php');
    class GroupRepository
    {
        public function addGroup(Group $Group){
            session_start();
            $db = new Database();
            $Group->Id = $db->insert("INSERT INTO Groups (nameGroup) VALUES ('".$Group->Name."')");
            $res = $db->insert("INSERT INTO UsersGroups (userID,groupID) VALUES ('".$_SESSION['id']."','".$Group->Id."')");
            if(is_numeric($res)){
                return true;
            } else{
                return false;
            }
        }
        public function getGroups(){
            session_start();
            $db = new Database();
            $res = $db->select("SELECT * FROM Groups WHERE Groups.groupID IN (SELECT UsersGroups.groupID FROM UsersGroups WHERE UsersGroups.userID='".$_SESSION['id']."')");
            if($res){
                $data = array();
                while($row = $res->fetch()){
                    $data[] = $row;
                }
                return json_encode($data);
            } else {
                return null;
            }
        }
    }