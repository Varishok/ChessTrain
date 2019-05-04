<?php
class TurnController {
    public function actionIndex() {
        $view = '/Views/Turn/index.php';
        render($view);
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
        $boardTurn = new Board;
        $chessman = array();
        foreach($_REQUEST as $key=>$class){
            $classes = explode(' ', $class);
            if($classes[1]){
                $class = explode('-', $classes[1]);
                if($class[1]){
                    switch($class[1]){
                        case 'pawn': 
                            $chessman['side'] = $class[0];
                            $chessman['piece'] = $class[1];
                            $chessman['position'] = $key;
                            break;
                        default:
                            $chessman['piece'] = $class[1];
                            $chessman['position'] = $key;
                    }
                    
                }
                $boardTurn->board[$key] = $class[1];
            }
        }
        $res = TurnRepository::getChessman($chessman['piece']);
        $chessman['id'] = $res->fetchColumn();
        if($chessman['id']){
            $res = TurnRepository::addTurn($boardTurn, $chessman);
        }
        var_dump($res);
        return true;
    }
}