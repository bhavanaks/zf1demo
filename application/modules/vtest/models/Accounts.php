<?php
class Accounting_Model_Accounts extends Zend_Db_Table {
     protected $_name = 'ourbank_accounts';

     public function insertAccounts() {
            $data = array('account_id'=> '');
            $this->insert($data);

       }

    public function UpDateAccounts($account_id,$accountNumber,$memberId,$productId,$grouporIndividualNumber,$createby) {
        $data = array('account_number' =>$accountNumber,
                      'member_id' => $memberId,
                      'product_id' => $productId,
                      'membertype_id' => $grouporIndividualNumber,
                      'accountcreated_date' => date("Y-m-d"),
                      'accountcreated_by' => $createby,
                      'accountstatus_id'=> 1);
        $where = 'account_id = '.$account_id;
        $this->update($data , $where );
	}
}
