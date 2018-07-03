<?php
class App_Model_Users extends Zend_Db_Table
 {
    protected $_name="";

   
    public function checkSession(){

        $storage = new Zend_Auth_Storage_Session();
        $data = $storage->read();
        if(!$data) return 0;
        else {
                  $sessionName = new Zend_Session_Namespace('kedb');
                return  $sessionName->primaryuserid;
        }
    }

 }


