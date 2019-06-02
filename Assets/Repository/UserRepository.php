<?php
    include(ROOT.'/Models/User.php');
    class UserRepository
    {
        public function addUser(User $User){
            $db = new Database();
            $User->Password = password_hash($User->Password, PASSWORD_DEFAULT);
            $res = $db->insert("INSERT INTO User (email,login,password) 
								VALUES ('".$User->Email."','".$User->Login."','".$User->Password."')");

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