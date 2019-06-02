<?php
    include_once(ROOT.'/Models/Turn.php');
    include_once(ROOT.'/Models/Debut.php');
    class DebutRepository
    {
        public function addDebut(Debut $Debut){
            $db = new Database();
            $res = array();
            $query = "INSERT INTO Debut (name,difficulty) VALUES ('".$Debut->Name."','".$Debut->Difficulty."')";
            $res[] = $db->insert($query);
            if(!empty($Debut->Description))
                $res[] = $db->update("UPDATE Debut SET description='".$Debut->Description."' WHERE id_debut='".$res[0]."'");
            return $res;
        }
        public function addDebutTurn($IdDebut, $Turns) {
            $db = new Database();
            $res = array();
            foreach ($Turns as $Turn){
                $select = "SELECT `id_move` FROM Move WHERE id_chessman='".$Turn->IdChessman."' AND starting_position='".$Turn->StartPosition."' AND ending_position='".$Turn->EndingPosition."'";
                $id_move = $db->select($select)->fetch_array()[0];
                echo json_encode($id_move);
                $query = "INSERT INTO DebutMove (id_debut,id_move,turn,id_side_move) VALUES ";
                $query .= "('".$IdDebut."','".$id_move."','".$Turn->TurnNumber."','".$Turn->SideChessman."')";
                $res[] = $db->insert($query);
            }
            return $res;
        }
        public function getAllDebut(){
            $db = new Database();
            $select = "SELECT * FROM Debut";
            $res = $db->select($select);
            return $res;
        }
        public function getDebut($id){
            $db = new Database();
            $select = "SELECT * FROM Debut WHERE id_debut='".$id."'";
            $res = $db->select($select);
            return $res;
        }
        public function getDebutMove($id){
            $db = new Database();
            $select = "SELECT * FROM DebutMove JOIN Move USING (id_move) WHERE id_debut='".$id."'";
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