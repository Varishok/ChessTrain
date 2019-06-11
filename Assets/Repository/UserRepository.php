<?php
    include(ROOT.'/Models/User.php');
    class UserRepository
    {
        public function addUser(User $User){
            $db = new Database();
            $User->Password = password_hash($User->Password, PASSWORD_DEFAULT);
            $res = $db->insert("INSERT INTO User (email,login,password) VALUES ('".$User->Email."','".$User->Login."','".$User->Password."')");

            return $res;
        }
        public function getUser($id, $login) {
            $db = new Database();
            $res = $db->select("SELECT * FROM User WHERE id_user='".$id."' AND login='".$login."'");
            if($res !== false) {
                return true;
            }
            else
                return false;
        }
        public function logIn($login, $password){
            $db = new Database();
            $res = $db->select("SELECT * FROM User WHERE login='".$login."'");
            if($res != false){
                $row = $res->fetch_array();
                $User = new User();
                $User->Id = $row['id_user'];
                $User->Login = $row['login'];
                $User->Password = $row['password'];
                if(password_verify($password, $User->Password)){
                    return $User;
                }
                else{
                    return false;
                }
            }
        }
        public function viewCheckmate($id_user,$id_checkmate){
            $db = new Database();
            $res = $db->insert("INSERT INTO UserCheckmate (id_user,id_checkmate) VALUES ('".$id_user."','".$id_checkmate."')");
            return $res;
        }
        public function getCheckmate($id_user){
            $db = new Database();
            $res = $db->select("SELECT * FROM UserCheckmate WHERE id_user='".$id_user."'");
            return $res;
        }
        public function viewPuzzle($id_user,$id_puzzle){
            $db = new Database();
            $res = $db->insert("INSERT INTO UserPuzzle (id_user,id_puzzle) VALUES ('".$id_user."','".$id_puzzle."')");
            return $res;
        }
        public function getPuzzle($id_user){
            $db = new Database();
            $res = $db->select("SELECT * FROM UserPuzzle WHERE id_user='".$id_user."'");
            return $res;
        }
        public function viewDebut($id_user,$id_debut){
            $db = new Database();
            $res = $db->insert("INSERT INTO UserDebut (id_user,id_debut) VALUES ('".$id_user."','".$id_debut."')");
            return $res;
        }
        public function getDebut($id_user){
            $db = new Database();
            $res = $db->select("SELECT * FROM UserDebut WHERE id_user='".$id_user."'");
            return $res;
        }
        public function viewGame($id_user,$id_game){
            $db = new Database();
            $res = $db->insert("INSERT INTO UserGame (id_user,id_game) VALUES ('".$id_user."','".$id_game."')");
            return $res;
        }
        public function getGame($id_user){
            $db = new Database();
            $res = $db->select("SELECT * FROM UserGame WHERE id_user='".$id_user."'");
            return $res;
        }
        public function favoritLiterature($id_user,$id_literature,$favorit){
            $db = new Database();
            if($favorit == "not-favorit"){
                $res = $db->insert("INSERT INTO UserLiterature (id_user,id_book) VALUES ('".$id_user."','".$id_literature."')");
            }else{
                $res = $db->delete("DELETE FROM UserLiterature WHERE id_user='".$id_user."' AND id_book='".$id_literature."'");
            }
            return $res;
        }
        public function getLiterature($id_user){
            $db = new Database();
            $res = $db->select("SELECT * FROM UserLiterature WHERE id_user='".$id_user."'");
            return $res;
        }
        public function updateUser(User $User){
            $db = new Database();
            $res = $db->update("UPDATE User SET login='".$User->Login."' WHERE id_user='".$User->Id."'");
            if(is_numeric($res)){
                return true;
            } else {
                return false;
            }
        }
        public function deleteUser($userID){
            include_once(ROOT.'/Assets/Repository/GroupRepository.php');
            $db = new Database();
            $res = $db->delete("DELETE FROM User WHERE id_user='".$userID."'");
            if($res==0){
                return true;
            } else {
                return false;
            }
        }
    }