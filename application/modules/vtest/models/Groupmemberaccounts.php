<?php
class Accounting_Model_Groupmemberaccounts extends Zend_Db_Table {
     protected $_name = 'ourbank_groupmembers_acccounts';


    public function Addgroupmembers($memberfirstname,$account_id,$productId,$createdby) {

        foreach($memberfirstname as $memberfirstname) {
            $data = array('groupmemberaccount_id' => '',
                          'groupaccount_id' => $account_id,
                          'groupmember_id' => $memberfirstname,
                          'product_id' => $productId,
                          'groupmember_account_status' => 3,
                          'groupcreateddate' => date("Y-m-d"),
                          'groupcreatedby'=> '');
           $this->insert($data);
        }
    }
}
