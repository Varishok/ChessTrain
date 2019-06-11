<?php
class PuzzleController
{
    public function actionIndex() {
        session_start();
        include_once(ROOT.'/Assets/Repository/PuzzleRepository.php');
        if(!empty($_SESSION['id'])){
            include_once(ROOT.'/Assets/Repository/UserRepository.php');
            $res = UserRepository::getPuzzle($_SESSION['id']);
            $viewPuzzle = array();
            if(!empty($res)) {
                while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
                    $viewPuzzle[] = $row['id_puzzle'];
                }
            }
            $_SESSION['view_puzzle'] = $viewPuzzle;
        }
        $_SESSION['puzzles'] = PuzzleRepository::getAllPuzzle();
        $view = '/Views/Puzzle/index.php';
        render($view);
        return true;
    }
    public function actionId($puzzle,$id){
        session_start();
        include_once(ROOT.'/Assets/Repository/PuzzleRepository.php');
        include_once(ROOT.'/Assets/Repository/ChessmanRepository.php');
        include_once(ROOT.'/Assets/Repository/HintRepository.php');
        if(!empty($_SESSION['id'])){
            include_once(ROOT.'/Assets/Repository/UserRepository.php');
            UserRepository::viewPuzzle($_SESSION['id'],$id);
        }
        $_SESSION['id_puzzle'] = $id;
        $puzzle = PuzzleRepository::getPuzzle($id)->fetch_array(MYSQLI_ASSOC);
        $_SESSION['side'] = $puzzle['id_side'];
        $id_hint = $puzzle['id_hint'];
        if(!empty($id_hint)){
            $_SESSION['hints'] = HintRepository::getHint($id_hint);
        }else{
            unset($_SESSION['hints']);
        }
        $res = PuzzleRepository::getPuzzleChessman($id);
        $chessmans = array();
        while($row = $res->fetch_array(MYSQLI_ASSOC)){
            $chessman = new Chessman();
            $chessman->Id = $row['id_chessman'];
            $chessman->Name = ChessmanRepository::getChessmanName($row['id_chessman']);
            $chessman->Position = $row['position'];
            $chessman->Side = $row['id_side'] == '1' ? 'white' : 'black';
            $chessmans[] = $chessman;
        }
        $_SESSION['chessman'] = $chessmans;
        $_SESSION['check_puzzle'] = PuzzleRepository::getPuzzleMove($id);
        $view = '/Views/Puzzle/id.php';
        render($view);
        return true;
    }
    public function actionCheck() {
        session_start();
        include_once(ROOT.'/Assets/Repository/PuzzleRepository.php');
        $check_puzzle = PuzzleRepository::getPuzzleMove($_SESSION['id_puzzle']);
        $side = $_SESSION['side'];
        $turn_number = 1 + ($check_puzzle->num_rows >> 1);
        $turns = array();
        for($i = 0; $i < $turn_number; $i++){
            $turn = new Turn();
            $turn->StartPosition = $_REQUEST['start_position'][$i];
            $turn->EndingPosition = $_REQUEST['ending_position'][$i];
            $turn->TurnNumber = $i+1;
            $turns[] = $turn;
        }
        $check_turns = array();
        while($check_turn = $check_puzzle->fetch_array(MYSQLI_ASSOC)){
            $check_turns[$check_turn['turn']][$check_turn['id_side_move']] = ['starting_position' => $check_turn['starting_position'], 'ending_position' => $check_turn['ending_position'],];
        }
        $result = array();
        foreach ($turns as $key=>$turn){
            if($turn->StartPosition == $check_turns[$turn->TurnNumber][$side]['starting_position'] && $turn->EndingPosition == $check_turns[$turn->TurnNumber][$side]['ending_position']){
                $result[$turn->TurnNumber] = array('success',count($check_turns[$turn->TurnNumber]),$check_turns[$turn->TurnNumber]);
            } else {
                $result[$turn->TurnNumber] = array('error');
                break;
            }
        }
        echo json_encode($result);
        return true;
    }
    public function actionPuzzle() {
        $view = '/Views/Puzzle/game.php';
        render($view);
        return true;
    }
    public function actionAdd(){
        include_once(ROOT.'/Assets/Repository/PuzzleRepository.php');
        include_once(ROOT.'/Assets/Repository/ChessmanRepository.php');
        $id = $_REQUEST['id_puzzle'];
        if(empty($id)){
            $chessmans = array();
            foreach($_REQUEST as $key=>$class){
                $chessman = new Chessman();
                $classes = explode(' ', $class);
                if($classes[1]){
                    $class = explode('-', $classes[1]);
                    if($class[1]) {
                        $chessman->Side = $class[0];
                        $chessman->Name = $class[1];
                        $chessman->Position = $key;
                        $res = ChessmanRepository::getChessman($chessman->Name);
                        $chessman->Id = $res->fetch_array()['id_chessman'];
                        $chessmans[] = $chessman;
                    }
                }
            }
            $res = PuzzleRepository::addPuzzle($chessmans);
            echo json_encode($res);
            return true;
        }else{
            $counter = count($_REQUEST['side']);
            $turns = array();
            for($i = 0;$i < $counter;$i++){
                $turn = new Turn();
                $turn->IdChessman = $_REQUEST['pawn'][$i];
                $turn->SideChessman = $_REQUEST['side'][$i] == 'white' ? '1' : '2';
                $turn->StartPosition = $_REQUEST['start_position'][$i];
                $turn->EndingPosition = $_REQUEST['ending_position'][$i];
                $turn->TurnNumber = $_REQUEST['turn_number'][$i];
                $turns[] = $turn;
                unset($turn);
            }
            $res = PuzzleRepository::addPuzzleTurn($id, $turns);
            echo json_encode($res);
            echo json_encode($turns);
            return true;
        }
    }
}