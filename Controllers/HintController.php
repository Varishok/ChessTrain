<?php
class HintController
{
    public function actionIndex() {
        $view = '/Views/Hint/index.php';
        render($view);
        return true;
    }
    public function actionAdd(){
        include_once(ROOT.'/Assets/Repository/HintRepository.php');
        $Hint = new Hint();
        $Hint->Hint = $_REQUEST['hint'];
        $idCheckmate = $_REQUEST['id_checkmate'];
        $idPuzzle = $_REQUEST['id_puzzle'];
        $Hint->Id = HintRepository::addHint($Hint);
        $res[] = $Hint->Id;
        if(isset($idCheckmate)){
            $res[] = HintRepository::addCheckmateHint($Hint,$idCheckmate);
        }
        if(isset($idPuzzle)){
            $res[] = HintRepository::addPuzzleHint($Hint, $idPuzzle);
        }
        echo json_encode($res);
        return true;
    }
}