<?php
    include_once(ROOT.'/Models/Turn.php');
    include_once(ROOT.'/Models/Game.php');
    class GameRepository
    {
        public function addGame(Game $Game){
            $db = new Database();
            $res = array();
            $query = "INSERT INTO Game (name) VALUES ('".$Game->Name."')";
            $res[] = $db->insert($query);
            if(!empty($Game->Date))
                $res[] = $db->update("UPDATE Game SET date='".$Game->Date."' WHERE id_game='".$res[0]."'");
            if(!empty($Game->Description))
                $res[] = $db->update("UPDATE Game SET description='".$Game->Description."' WHERE id_game='".$res[0]."'");
            return $res;
        }
        public function addGameTurn($IdGame, $Turns) {
            $db = new Database();
            $res = array();
            foreach ($Turns as $Turn){
                $select = "SELECT `id_move` FROM Move WHERE id_chessman='".$Turn->IdChessman."' AND starting_position='".$Turn->StartPosition."' AND ending_position='".$Turn->EndingPosition."'";
                $id_move = $db->select($select)->fetch_array()[0];
                echo json_encode($id_move);
                $query = "INSERT INTO GameMove (id_game,id_move,turn,id_side_move) VALUES ";
                $query .= "('".$IdGame."','".$id_move."','".$Turn->TurnNumber."','".$Turn->SideChessman."')";
                $res[] = $db->insert($query);
            }
            return $res;
        }
        public function getAllGame(){
            $db = new Database();
            $select = "SELECT * FROM Game";
            $res = $db->select($select);
            return $res;
        }
        public function getGame($id){
            $db = new Database();
            $select = "SELECT * FROM Game WHERE id_game='".$id."'";
            $res = $db->select($select);
            return $res;
        }
        public function getGameMove($id){
            $db = new Database();
            $select = "SELECT * FROM GameMove JOIN Move USING (id_move) WHERE id_game='".$id."'";
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