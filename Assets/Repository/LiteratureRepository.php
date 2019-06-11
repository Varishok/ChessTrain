<?php
    include_once(ROOT.'/Models/Turn.php');
    include_once(ROOT.'/Models/Literature.php');
    class LiteratureRepository
    {
        public function addLiterature(Literature $Literature){
            $db = new Database();
            $res = array();
            $query = "INSERT INTO Literature (name,author,preffered_level) VALUES ('".$Literature->Name."','".$Literature->Author."','".$Literature->PrefferedLevel."')";
            $res[] = $db->insert($query);
            return $res;
        }
        public function getAllLiterature(){
            $db = new Database();
            $select = "SELECT * FROM Literature";
            $res = $db->select($select);
            return $res;
        }
        public function getLiterature($id){
            $db = new Database();
            $select = "SELECT * FROM Literature WHERE id_book='".$id."'";
            $res = $db->select($select);
            return $res;
        }
        /*public function updatePuzzle(Board $Board){
            $db = new Database();
            $res = $db->update("UPDATE Users SET userName='".$User->Name."',avatar='".$User->Avatar."',additions='".$User->Additions."' WHERE userID='".$User->Id."'");
            if(is_numeric($res)){
                return true;
            } else {
                return false;
            }
        }
        public function deletePuzzle($turnID){
            include_once(ROOT.'/Assets/Repository/GroupRepository.php');
            $db = new Database();
            $res = $db->select("SELECT * FROM UsersGroups WHERE userID='".$userID."'");
            while($row = $res->fetch()){
                GroupRepository::deleteGroup($row['groupID']);
            }
            $res = $db->delete("DELETE FROM Users WHERE userID='".$userID."'");
            if($res==0){
                return true;
            } else {
                return false;
            }
        }*/
    }