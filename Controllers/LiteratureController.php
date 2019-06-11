<?php
class LiteratureController
{
    public function actionIndex() {
        session_start();
        include_once(ROOT.'/Assets/Repository/LiteratureRepository.php');
        $books = array();
        if($_SESSION['id']){
            include_once(ROOT.'/Assets/Repository/UserRepository.php');
            $res = UserRepository::getLiterature($_SESSION['id']);
            if($res){
                while($row = $res->fetch_array()){
                    $books[] = $row['id_book'];
                }
            }else{
                $books[] = 0;
            }
        }
        $literatures = array();
        $res = LiteratureRepository::getAllLiterature();
        while($row = $res->fetch_array(MYSQLI_ASSOC)){
            $literature = new Literature();
            $literature->Id = $row['id_book'];
            $literature->Name = $row['name'];
            $literature->Author = $row['author'];
            $literature->PrefferedLevel = $row['preffered_level'];
            if(empty($books)){
                $literature->Favorit = null;
                $literatures[] = $literature;
            }elseif(in_array($literature->Id, $books)){
                $literature->Favorit = true;
                $literatures = array_reverse($literatures);
                $literatures[] = $literature;
                $literatures = array_reverse($literatures);
            }else{
                $literature->Favorit = false;
                $literatures[] = $literature;
            }
        }
        $_SESSION['literatures'] = $literatures;
        $view = '/Views/Literature/index.php';
        render($view);
        return true;
    }
    public function actionLiterature() {
        $view = '/Views/Literature/literature.php';
        render($view);
        return true;
    }
    public function actionAdd(){
        include_once(ROOT.'/Assets/Repository/LiteratureRepository.php');
        $Literature = new Literature();
        $Literature->Name = $_REQUEST['name'];
        $Literature->Author = $_REQUEST['author'];
        $Literature->PrefferedLevel = $_REQUEST['level'];
        $res = LiteratureRepository::addLiterature($Literature);
        echo json_encode($res);
        return true;
    }
    public function actionFavorit(){
        session_start();
        include_once(ROOT.'/Assets/Repository/UserRepository.php');
        $res = UserRepository::favoritLiterature($_SESSION['id'],$_REQUEST['id'],$_REQUEST['favorit']);
        echo json_encode($res);
        return true;
    }
}