<?php
class ContactsController
{
    public function actionContacts(){
        include_once(ROOT.'/Assets/Repository/ContactRepository.php');
        include_once(ROOT.'/Assets/Repository/GroupRepository.php');
        $_SESSION['group_id'] = $_REQUEST['group_id'];
        if(isset($_SESSION['id'])){
            if(GroupRepository::searchGroup($_SESSION['id'],$_SESSION['group_id'])){
                $contacts = ContactRepository::getContacts();
                require_once(ROOT.'/Views/Contacts/contacts.php');
                return true;
            } else {
                $res = GroupRepository::copyGroup();
                return $res;
            }
        } else {
            $host = $_SERVER['HTTP_HOST'];
            header("Location: http://$host/");
            return true;
        }


    }
    public function actionAddcontact(){
        include_once(ROOT.'/Assets/Repository/ContactRepository.php');
        $Contact = new Contact();
        $Contact->FullName = $_REQUEST['namecontact'];
        $Contact->Phone = $_REQUEST['phone'];
        $res = ContactRepository::addContact($Contact);
        if($res){
            $host = $_SERVER['HTTP_HOST'];
            header("Location: http://$host/contacts?id=".$_SESSION['group_id']);
            return true;
        }
        return false;
    }
}