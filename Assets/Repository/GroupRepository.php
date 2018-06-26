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
                return $Group->Id;
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
        public function searchGroup($userID,$groupID){
            $db = new Database();
            $res = $db->select("SELECT * FROM UsersGroups WHERE userID='".$userID."' AND groupID='".$groupID."'");
            if($res!=false){
                return true;
            } else {
                return false;
            }
        }
        public function getGroup($groupID){
            $db = new Database();
            $res = $db->select("SELECT * FROM Groups WHERE groupID='".$groupID."'");
            if($res!=false){
                return $res;
            } else {
                return false;
            }
        }
        public function copyGroup(){
            session_start();
            $res = GroupRepository::getGroup($_SESSION['group_id']);
            if($res!= false){
                $Group = new Group();
                $row = $res->fetch();
                $Group->Name = $row['nameGroup'];
                $Group->Id = GroupRepository::addGroup($Group);
                $Contacts = ContactRepository::getContacts();
                $_SESSION['group_id'] = $Group->Id;
                foreach ($Contacts as $contact){
                    $res = ContactRepository::addContact($contact);
                    if($res == false){
                        return false;
                    }
                }
            } else {
                return false;
            }
        }
        public function updateGroup(Group $Group){
            $db = new Database();
            $res = $db->update("UPDATE Groups SET nameGroup='".$Group->Name."' WHERE groupID='".$Group->Id."'");
            if(is_numeric($res)){
                return true;
            } else {
                return false;
            }
        }
        public function deleteGroup($groupID){
            include_once(ROOT.'/Assets/Repository/ContactRepository.php');
            $db = new Database();
            $res = $db->select("SELECT * FROM GroupsContacts WHERE groupID='".$groupID."'");
            while($row = $res->fetch()){
                ContactRepository::deleteContact($row['contactID']);
            }
            $res = $db->delete("DELETE FROM Groups WHERE groupID='".$groupID."'");
            if($res!=0){
                return false;
            }
            $res = $db->delete("DELETE FROM UsersGroups WHERE groupID='".$groupID."'");
            if($res==0){
                return true;
            } else {
                return false;
            }
        }
    }