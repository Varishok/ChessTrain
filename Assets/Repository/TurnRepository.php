<?php
    include(ROOT.'/Models/Board.php');
    class TurnRepository
    {
        public function addTurn(Board $Board, $chessman){
            $db = new Database();
            $res = array();
            foreach($Board->board as $key=>$value){
                if($key == $chessman['position']) continue;
                $query = "INSERT INTO Move (id_chessman,starting_position,ending_position,side) VALUES ";
                $query .= "('".$chessman['id']."','".$chessman['position']."','".$key."','".$chessman['side']."')";
                $res[] = $db->insert($query);
            }
            return $res;
        }
        public function getTurn($id = null) {
            $db = new Database();
            $res = $db->select("SELECT * FROM Users WHERE userID='".$id."' AND userName='".$username."'");
            if($res !== false) {
                return true;
            }
            else
                return false;
        }
        public function getChessman($chessman) {
            $db = new Database();
            $res = $db->select("SELECT `id_chessman` FROM `Chessman` WHERE name='".$chessman."'");
            return $res;
        }
        public function updateTurn(Board $Board){
            $db = new Database();
            $res = $db->update("UPDATE Users SET userName='".$User->Name."',avatar='".$User->Avatar."',additions='".$User->Additions."' WHERE userID='".$User->Id."'");
            if(is_numeric($res)){
                return true;
            } else {
                return false;
            }
        }
        public function deleteTurn($turnID){
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
        }
    }