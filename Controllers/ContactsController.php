<?php
class ContactsController
{
    public function actionContacts(){
        include_once(ROOT.'/Assets/Repository/ContactRepository.php');
        $_SESSION['group_id'] = $_REQUEST['group_id'];
        $contacts = ContactRepository::getContacts();
        require_once(ROOT.'/Views/Contacts/contacts.php');
        return true;
    }
    public function actionAddcontact(){
        include_once(ROOT.'/Assets/Repository/ContactRepository.php');
        $Contact = new Contact();
        $Contact->FullName = $_REQUEST['namecontact'];
        $Contact->Phone = $_REQUEST['phone'];
        $res = ContactRepository::addContact($Contact);
        if($res){
            $host = $_SERVER['HTTP_HOST'];
            header("Location: http://$host/contacts");
            return true;
        }
        return false;
    }
}