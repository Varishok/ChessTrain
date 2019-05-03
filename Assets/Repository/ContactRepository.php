<?php
include(ROOT.'/Models/Contact.php');
class ContactRepository
{
    public function addContact(Contact $Contact){
        session_start();
        $db = new Database();
        $Contact->Id = $db->insert("INSERT INTO Contacts (fullName,phone) VALUES ('".$Contact->FullName."','".$Contact->Phone."')");
        $res = $db->insert("INSERT INTO GroupsContacts (groupID,contactsID) VALUES ('".$_SESSION['group_id']."','".$Contact->Id."')");
        if(is_numeric($res)){
            return true;
        } else{
            return false;
        }
    }
    public function getContacts(){
        session_start();
        $db = new Database();
        $res = $db->select("SELECT * FROM Contacts WHERE Contacts.contactID IN (SELECT GroupsContacts.contactID FROM GroupsContacts WHERE GroupsContacts.groupID='".$_SESSION['group_id']."')");
        if($res != false){
            $contacts = array();
            while($row = $res->fetch()){
                $contact = new Contact();
                $contact->Id = $res['contactID'];
                $contact->FullName = $res['fullName'];
                $contact->Phone = $res['phone'];
                $contact->Picture = $res['picture'];
                $contact->Links = $res['links'];
                $contacts[] = $contact;
            }
            return $contacts;
        } else {
            return null;
        }
    }
    public function updateContact(Contact $Contact){
        $db  = new Database();
        $res = $db->update("UPDATE Contacts SET fullName='".$Contact->FullName."',phone='".$Contact->Phone."',picture='".$Contact->Picture."',links='".$Contact->Links."' WHERE conactsID='".$Contact->Id."'");
        if(is_numeric($res)){
            return true;
        } else {
            return false;
        }
    }
    public function deleteContact($contactID){
        $db = new Database();
        $res = $db->delete("DELETE FROM Contacts WHERE contactID='".$contactID."'");
        if($res!=0){
            return false;
        }
        $res = $db->delete("DELETE FROM GroupsContacts WHERE contactID='".$contactID."'");
        if($res==0){
            return true;
        } else {
            return false;
        }
    }
}