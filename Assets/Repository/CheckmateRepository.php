<?php
    include_once(ROOT.'/Models/Board.php');
    include_once(ROOT.'/Models/Chessman.php');
    include_once(ROOT.'/Models/Turn.php');
    class CheckmateRepository
    {
        public function addCheckmate($Chessmans){
            $db = new Database();
            $res = array();
            $query = "INSERT INTO Checkmate (name,difficulty,id_side) VALUES ('Задание №','Легкая','1')";
            $res[] = $db->insert($query);
            $res[] = $db->update("UPDATE Checkmate SET name='Задание №".$res[0]."' WHERE id_checkmate='".$res[0]."'");
            foreach ($Chessmans as $Chessman){
                $query = "INSERT INTO CheckmateChessman (id_checkmate,id_chessman,position,id_side) VALUES ";
                $side = $Chessman->Side == 'white' ? 1 : 2;
                $query .= "('".$res[0]."','".$Chessman->Id."','".$Chessman->Position."','".$side."')";
                $res[] = $db->insert($query);
            }
            return $res;
        }
        public function addCheckmateTurn($IdCheckmate, $Turns) {
            $db = new Database();
            $res = "";
            foreach ($Turns as $Turn){
                $select = "SELECT `id_move` FROM Move WHERE id_chessman='".$Turn->IdChessman."' AND starting_position='".$Turn->StartPosition."' AND ending_position='".$Turn->EndingPosition."'";
                $query = "INSERT INTO CheckmateMove (id_checkmate,id_move,turn,id_side) VALUES ";
                $query .= "('".$IdCheckmate."','".$db->select($select)->fetch_array()[0]."','".$Turn->TurnNumber."','".$Turn->SideChessman."')";
                $res[] = $db->insert($query);
            }
            return $res;
        }
        public function getAllCheckmate(){
            $db = new Database();
            $select = "SELECT * FROM Checkmate";
            $res = $db->select($select);
            return $res;
        }
        public function getCheckmate($id){
            $db = new Database();
            $select = "SELECT * FROM Checkmate WHERE id_checkmate='".$id."'";
            $res = $db->select($select);
            return $res;
        }
        public function getCheckmateChessman($id){
            $db = new Database();
            $select = "SELECT * FROM CheckmateChessman WHERE id_checkmate='".$id."'";
            $res = $db->select($select);
            return $res;
        }
        public function getCheckmateMove($id){
            $db = new Database();
            $select = "SELECT * FROM CheckmateMove JOIN Move USING (id_move) WHERE id_checkmate='".$id."'";
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