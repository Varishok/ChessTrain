<?php
    include(ROOT.'/Models/User.php');
    class UserRepository
    {
        public function generateSalt()
        {
            $salt = '';
            $saltLength = 8;
            for($i = 0; $i < $saltLength; $i++)
            {
                $salt .= chr(mt_rand(43, 126));
            }
            return $salt;
        }
        public function addUser(User $User){
            $db = new Database();
            $User->Salt = UserRepository::generateSalt();
            $User->Password = md5($User->Password . $User->Salt);
            $res = $db->insert("INSERT INTO Users (login,password,salt,userName) 
								VALUES ('".$User->Login."','".$User->Password."','".$User->Salt."','".$User->Name."')");

            return $res;
        }
        public function getUser($id, $username) {
            $db = new Database();
            $res = $db->select("SELECT * FROM Users WHERE userID='".$id."' AND userName='".$username."'");
            if($res !== false) {
                return true;
            }
            else
                return false;
        }
        public function logIn($login, $password){
            $db = new Database();
            $res = $db->select("SELECT * FROM Users WHERE login='".$login."'");
            if($res != false){
                $row = $res->fetch();
                $User = new User();
                $User->Id = $row['userID'];
                $User->Salt = $row['salt'];
                $User->Name = $row['userName'];
                $User->Password = $row['password'];
                $saltedpassword = md5($password.$User->Salt);
                if($saltedpassword == $User->Password){
                    return $User;
                }
                else{
                    return false;
                }
            }
        }
    }