<?php
class CheckmateController
{
    public function actionIndex() {
        session_start();
        include_once(ROOT.'/Assets/Repository/CheckmateRepository.php');
        if(!empty($_SESSION['id'])){
            include_once(ROOT.'/Assets/Repository/UserRepository.php');
            $res = UserRepository::getCheckmate($_SESSION['id']);
            $viewCheckmate = array();
            if(!empty($res)) {
                while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
                    $viewCheckmate[] = $row['id_checkmate'];
                }
            }
            $_SESSION['view_checkmate'] = $viewCheckmate;
        }
        $_SESSION['checkmates'] = CheckmateRepository::getAllCheckmate();
        $view = '/Views/Checkmate/index.php';
        render($view);
        return true;
    }
    public function actionId($checkmate,$id){
        session_start();
        include_once(ROOT.'/Assets/Repository/CheckmateRepository.php');
        include_once(ROOT.'/Assets/Repository/ChessmanRepository.php');
        include_once(ROOT.'/Assets/Repository/HintRepository.php');
        if(!empty($_SESSION['id'])){
            include_once(ROOT.'/Assets/Repository/UserRepository.php');
            UserRepository::viewCheckmate($_SESSION['id'],$id);
        }
        $_SESSION['id_checkmate'] = $id;
        $side = CheckmateRepository::getCheckmate($id);
        $_SESSION['side'] = $side->fetch_array(MYSQLI_ASSOC)['id_side'];
        $_SESSION['hints'] = HintRepository::getCheckmateHint($id);
        $res = CheckmateRepository::getCheckmateChessman($id);
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
        $_SESSION['check_checkmate'] = CheckmateRepository::getCheckmateMove($id);
        $view = '/Views/Checkmate/id.php';
        render($view);
        return true;
    }
    public function actionCheck() {
        session_start();
        include_once(ROOT.'/Assets/Repository/CheckmateRepository.php');
        $check_Checkmate = CheckmateRepository::getCheckmateMove($_SESSION['id_checkmate']);
        $side = $_SESSION['side'];
        $turn_number = 1 + ($check_Checkmate->num_rows >> 1);
        $turns = array();
        for($i = 0; $i < $turn_number; $i++){
            $turn = new Turn();
            $turn->StartPosition = $_REQUEST['start_position'][$i];
            $turn->EndingPosition = $_REQUEST['ending_position'][$i];
            $turn->TurnNumber = $i+1;
            $turns[] = $turn;
        }
        $check_turns = array();
        while($check_turn = $check_Checkmate->fetch_array(MYSQLI_ASSOC)){
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
    public function actionCheckmate() {
        $view = '/Views/Checkmate/checkmate.php';
        render($view);
        return true;
    }
    public function actionAdd(){
        include_once(ROOT.'/Assets/Repository/CheckmateRepository.php');
        include_once(ROOT.'/Assets/Repository/ChessmanRepository.php');
        $id = $_REQUEST['id_checkmate'];
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
            $res = CheckmateRepository::addCheckmate($chessmans);
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
            $res = CheckmateRepository::addCheckmateTurn($id, $turns);
            echo json_encode($res);
            return true;
        }
    }
}