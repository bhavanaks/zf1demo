<?php
class Accounting_Model_Groupmembersavingtransaction extends Zend_Db_Table {
     protected $_name = 'ourbank_groupmember_savingstransaction';


    public function Addgroupmembersavingtransaction($memberfirstname,$transaction_id,$account_id,$savings_amount,$createdby) {
        foreach($memberfirstname as $memberfirstname) {
            $data = array('groupmembersavingtransaction_id' => '',
                          'groupmembertransaction_id' => $transaction_id,
                          'groupaccount_id' => $account_id,
                          'groupmemberaccount_id' => $memberfirstname,
                          'groupmembertransaction_date' => date("Y-m-d"),
                          'groupmembertransaction_type' => 1,
                          'groupmembertransaction_amount'=> $savings_amount,
                          'groupmembertransaction_interest'=> '',
                          'groupmembertransaction_by'=> $createdby,
                          'groupmembercreateddate'=> date("Y-m-d"));
           $this->insert($data);
        }
    }
}
