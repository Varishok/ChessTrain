<?php
    include_once(ROOT.'/Models/Board.php');
    include_once(ROOT.'/Models/Chessman.php');
    class TurnRepository
    {
        public function addTurn(Board $Board, Chessman $Chessman){
            $db = new Database();
            $res = array();
            foreach($Board->board as $key=>$value){
                if($key == $Chessman->Position) continue;
                $query = "INSERT INTO Move (id_chessman,starting_position,ending_position,side,action) VALUES ";
                $query .= "('".$Chessman->Id."','".$Chessman->Position."','".$key."','".$Chessman->Side."','hit')";
                $res[] = $db->insert($query);
            }
            return $res;
        }
        public function getTurn(Chessman $Chessman) {
            $db = new Database();
            $select = "SELECT * FROM Move LEFT JOIN Chessman USING (id_chessman) WHERE Chessman.name='$Chessman->Name' AND Move.starting_position='$Chessman->Position' AND Move.action IS NULL";
            if($Chessman->Name == 'pawn'){
                $select .= " AND Move.side='$Chessman->Side'";
            }
            $res = $db->select($select);
            return $res;
        }
    }