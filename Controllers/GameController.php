<?php
class GameController
{
    public function actionIndex() {
        session_start();
        include_once(ROOT.'/Assets/Repository/GameRepository.php');
        if(!empty($_SESSION['id'])){
            include_once(ROOT.'/Assets/Repository/UserRepository.php');
            $res = UserRepository::getGame($_SESSION['id']);
            $viewGame = array();
            if(!empty($res)) {
                while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
                    $viewGame[] = $row['id_game'];
                }
            }
            $_SESSION['view_game'] = $viewGame;
        }
        $_SESSION['games'] = GameRepository::getAllGame();
        $view = '/Views/Game/index.php';
        render($view);
        return true;
    }
    public function actionId($game,$id){
        session_start();
        unset($_SESSION['game_pawn']);
        include_once(ROOT.'/Assets/Repository/GameRepository.php');
        $_SESSION['game'] = GameRepository::getGame($id)->fetch_array(MYSQLI_ASSOC);
        if(!empty($_SESSION['id'])){
            include_once(ROOT.'/Assets/Repository/UserRepository.php');
            UserRepository::viewGame($_SESSION['id'],$id);
        }
        $game_move = GameRepository::getGameMove($id);
        $game_turn = array();
        while($move = $game_move->fetch_array(MYSQLI_ASSOC)){
            $game_turn[(int)$move['turn']][(int)$move['id_side_move']] = ['starting_position' => $move['starting_position'], 'ending_position' => $move['ending_position'], 'action' =>$move['action'],];
        }
        $_SESSION['game_turn'] = $game_turn;
        $view = '/Views/Game/id.php';
        render($view);
        return true;
    }
    public function actionGame() {
        $view = '/Views/Game/game.php';
        render($view);
        return true;
    }
    public function actionBoard() {
        session_start();
        if($_REQUEST['board']){
            require_once("/../Views/include/board.php");
            return true;
        }elseif($_REQUEST['next']){
            echo json_encode($_SESSION['game_turn'][(int)$_REQUEST['turn']][(int)$_REQUEST['id_side']]);
            return true;
        }elseif($_REQUEST['save']){
            $pawn = array('turn' => $_REQUEST['turn'], 'id_side' => $_REQUEST['id_side'], 'pawn' => $_REQUEST['pawn'],);
            $_SESSION['game_pawn'][] = $pawn;
            return true;
        }elseif($_REQUEST['prev']){
            $pawns = $_SESSION['game_pawn'];
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
            $res = $_SESSION['game_turn'][$turn][$id_side];
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
        include_once(ROOT.'/Assets/Repository/GameRepository.php');
        $game = new Game();
        $game->Id = $_REQUEST['id_game'];
        $game->Name = $_REQUEST['name'];
        $game->Date = $_REQUEST['date'];
        $game->Description = $_REQUEST['description'];
        if(!empty($game->Name)){
            $res = GameRepository::addGame($game);
            echo json_encode($res);
            return true;
        }elseif(!empty($game->Id)){
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
            $res = GameRepository::addGameTurn($game->Id, $turns);
            echo json_encode($res);
            return true;
        }
        return true;
    }
}