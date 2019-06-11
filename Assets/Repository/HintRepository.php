<?php
    include_once(ROOT.'/Models/Hint.php');
    class HintRepository
    {
        public function addHint(Hint $Hint){
            $db = new Database();
            $insert = "INSERT INTO Hint (hint) VALUES ('".$Hint->Hint."')";
            $res = $db->insert($insert);
            return $res;
        }
        public function addCheckmateHint(Hint $Hint, $IdCheckmate){
            $db = new Database();
            $query = "INSERT INTO CheckmateHint (id_checkmate,id_hint) VALUES ('".$IdCheckmate."','".$Hint->Id."')";
            $res = $db->insert($query);
            return $res;
        }
        public function addPuzzleHint(Hint $Hint, $IdPuzzle){
            $db = new Database();
            $res = array();
            $query = "UPDATE Puzzle SET id_hint='".$Hint->Id."' WHERE id_puzzle='".$IdPuzzle."'";
            $res[] = $db->update($query);
            return $res;
        }
        public function getCheckmateHint($IdCheckmate){
            $db = new Database();
            $select = "SELECT * FROM CheckmateHint JOIN Hint USING(id_hint) WHERE id_checkmate='".$IdCheckmate."'";
            $res = $db->select($select);
            return $res;
        }
        public function getHint($IdHint){
            $db = new Database();
            $select = "SELECT * FROM Hint WHERE id_hint='".$IdHint."'";
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