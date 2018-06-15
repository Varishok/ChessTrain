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
                $salt .= chr(mt_rand(33, 126));
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
    }