<?php
class DebutController
{
    public function actionIndex() {
        session_start();
        include_once(ROOT.'/Assets/Repository/DebutRepository.php');
        if(!empty($_SESSION['id'])){
            include_once(ROOT.'/Assets/Repository/UserRepository.php');
            $res = UserRepository::getDebut($_SESSION['id']);
            $viewDebut = array();
            if(!empty($res)) {
                while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
                    $viewDebut[] = $row['id_debut'];
                }
            }
            $_SESSION['view_debut'] = $viewDebut;
        }
        $_SESSION['debuts'] = DebutRepository::getAllDebut();
        $view = '/Views/Debut/index.php';
        render($view);
        return true;
    }
    public function actionId($debut,$id){
        session_start();
        unset($_SESSION['debut_pawn']);
        unset($_SESSION['debut_turn']);
        include_once(ROOT.'/Assets/Repository/DebutRepository.php');
        if(!empty($_SESSION['id'])){
            include_once(ROOT.'/Assets/Repository/UserRepository.php');
            UserRepository::viewDebut($_SESSION['id'],$id);
        }
        $_SESSION['debut'] = DebutRepository::getDebut($id)->fetch_array(MYSQLI_ASSOC);
        $Debut_move = DebutRepository::getDebutMove($id);
        $Debut_turn = array();
        while($move = $Debut_move->fetch_array(MYSQLI_ASSOC)){
            $Debut_turn[(int)$move['turn']][(int)$move['id_side_move']] = ['starting_position' => $move['starting_position'], 'ending_position' => $move['ending_position'], 'action' =>$move['action'],];
        }
        $_SESSION['debut_turn'] = $Debut_turn;
        $view = '/Views/Debut/id.php';
        render($view);
        return true;
    }
    public function actionDebut() {
        $view = '/Views/Debut/debut.php';
        render($view);
        return true;
    }
    public function actionBoard() {
        session_start();
        if($_REQUEST['board']){
            require_once("/../Views/include/board.php");
            return true;
        }elseif($_REQUEST['next']){
            echo json_encode($_SESSION['debut_turn'][(int)$_REQUEST['turn']][(int)$_REQUEST['id_side']]);
            return true;
        }elseif($_REQUEST['save']){
            $pawn = array('turn' => $_REQUEST['turn'], 'id_side' => $_REQUEST['id_side'], 'pawn' => $_REQUEST['pawn'],);
            $_SESSION['debut_pawn'][] = $pawn;
            return true;
        }elseif($_REQUEST['prev']){
            $pawns = $_SESSION['debut_pawn'];
            $turn = $_REQUEST['turn'];
            $id_side = $_REQUEST['id_side'];
            if($id_side == 1 and $turn == 1){
                return true;
            }
            if($id_side == 1){
                $id_side = 2;
                $turn = $turn - 1;
            } else {
                $id_side = 1;
            }
            $res = $_SESSION['debut_turn'][$turn][$id_side];
            if(is_array($pawns)){
                foreach ($pawns as $pawn){
                    if($pawn['turn'] == $turn and $pawn['id_side'] == $id_side){
                        $res['pawn'] = $pawn['pawn'];
                        break;
                    }
                }
            }
            echo json_encode($res);
            return true;
        }
        return false;
    }
    public function actionAdd(){
        include_once(ROOT.'/Assets/Repository/DebutRepository.php');
        $Debut = new Debut();
        $Debut->Id = $_REQUEST['id_debut'];
        $Debut->Name = $_REQUEST['name'];
        $Debut->Difficulty = $_REQUEST['difficulty'];
        $Debut->Description = $_REQUEST['description'];
        if(!empty($Debut->Name)){
            $res = DebutRepository::addDebut($Debut);
            echo json_encode($res);
            return true;
        }elseif(!empty($Debut->Id)){
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
            $res = DebutRepository::addDebutTurn($Debut->Id, $turns);
            echo json_encode($res);
            return true;
        }
        return true;
    }
}