<?php
    include_once(ROOT.'/Models/Board.php');
    include_once(ROOT.'/Models/Chessman.php');
    include_once(ROOT.'/Models/Turn.php');
    class PuzzleRepository
    {
        public function addPuzzle($Chessmans){
            $db = new Database();
            $res = array();
            $query = "INSERT INTO Puzzle (name,difficulty,id_side) VALUES ('Задание №','Легкая','1')";
            $res[] = $db->insert($query);
            $res[] = $db->update("UPDATE Puzzle SET name='Задание №".$res[0]."' WHERE id_puzzle='".$res[0]."'");
            foreach ($Chessmans as $Chessman){
                $query = "INSERT INTO PuzzleChessman (id_puzzle,id_chessman,position,id_side) VALUES ";
                $side = $Chessman->Side == 'white' ? 1 : 2;
                $query .= "('".$res[0]."','".$Chessman->Id."','".$Chessman->Position."','".$side."')";
                $res[] = $db->insert($query);
            }
            return $res;
        }
        public function addPuzzleTurn($IdPuzzle, $Turns) {
            $db = new Database();
            $res = "";
            foreach ($Turns as $Turn){
                $select = "SELECT `id_move` FROM Move WHERE id_chessman='".$Turn->IdChessman."' AND starting_position='".$Turn->StartPosition."' AND ending_position='".$Turn->EndingPosition."'";
                $query = "INSERT INTO PuzzleMove (id_puzzle,id_move,turn,id_side) VALUES ";
                $query .= "('".$IdPuzzle."','".$db->select($select)->fetch_array()[0]."','".$Turn->TurnNumber."','".$Turn->SideChessman."')";
                $res[] = $db->insert($query);
            }
            return $res;
        }
        public function getAllPuzzle(){
            $db = new Database();
            $select = "SELECT * FROM Puzzle";
            $res = $db->select($select);
            return $res;
        }
        public function getPuzzle($id){
            $db = new Database();
            $select = "SELECT * FROM Puzzle WHERE id_puzzle='".$id."'";
            $res = $db->select($select);
            return $res;
        }
        public function getPuzzleChessman($id){
            $db = new Database();
            $select = "SELECT * FROM PuzzleChessman WHERE id_puzzle='".$id."'";
            $res = $db->select($select);
            return $res;
        }
        public function getPuzzleMove($id){
            $db = new Database();
            $select = "SELECT * FROM PuzzleMove JOIN Move USING (id_move) WHERE id_puzzle='".$id."'";
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