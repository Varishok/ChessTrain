<?php
class TurnController {
    public function actionIndex() {
        session_start();
        include_once(ROOT.'/Assets/Repository/TurnRepository.php');
        $chessman = new Chessman();
        if(empty($_POST['piece'])){
            $piece = array('rook','knight','bishop','queen','king','pawn');
            $chessman->Name = $piece[rand(0,5)];
        } else {
            $chessman->Name = $_POST['piece'];
        }
        $x = 4; $y = 4;
        switch ($chessman->Name){
            case 'pawn':
                $y = rand(2,7);
                break;
            default:
                $y = rand(1,8);
        }
        $board = 'abcdefgh';
        $x = $board[rand(0, 7)];
        $chessman->Position = $x . $y;
        $s = rand(0, 1);
        if($s == 0){
            $chessman->Side='white';
        }else{
            $chessman->Side='black';
        }
        $_SESSION['res'] = TurnRepository::getTurn($chessman);
        $_SESSION['chess_turn']=$chessman;
        $view = '/Views/Turn/index.php';
        render($view);
        return true;
    }
    public function actionCheck() {
        session_start();
        $check = $_SESSION['turn_check'];
        $res = $_POST['move'];
        $i = 0;
        $count = count($check);
        $html = '<tr><th>Возможные ходы фигуры.<th></tr>';
        foreach($res as $value){
            if(in_array($value, $check)){
                $i++;
                $html .= "<tr><td class='check-success'>$value</td></tr>";
            }else{
                $html .= "<tr><td class='check-error'>$value</td></tr>";
            }
        }
        $html .= "<tr><td class='number'>Правильных ответов: $i/$count</td></tr>";
        echo json_encode($html);
        return true;
    }
    public function actionTurn() {
        $view = '/Views/Turn/turn.php';
        render($view);
        return true;
    }
    public function actionAdd() {
        session_start();
        include_once(ROOT.'/Assets/Repository/TurnRepository.php');
        include_once(ROOT.'/Assets/Repository/ChessmanRepository.php');
        $boardTurn = new Board();
        $chessman = new Chessman();
        foreach($_REQUEST as $key=>$class){
            $classes = explode(' ', $class);
            if($classes[1]){
                $class = explode('-', $classes[1]);
                if($class[1]){
                    switch($class[1]){
                        case 'pawn': 
                            $chessman->Side = $class[0] == 'white' ? 1 : 2;
                        default:
                            $chessman->Name = $class[1];
                            $chessman->Position = $key;
                    }
                    
                }
                $boardTurn->board[$key] = $class[1];
            }
        }
        $res = ChessmanRepository::getChessman($chessman->Name);
        $chessman->Id = $res->fetch_array()['id_chessman'];
        if($chessman->Id){
            $res = TurnRepository::addTurn($boardTurn, $chessman);
        }
        var_dump($res);
        return true;
    }
}