<?php
class Accounting_Model_Savingaccounttransaction extends Zend_Db_Table {
     protected $_name = 'ourbank_savingsaccounts';
 
   public function Addsavingaccounttransaction($account_id,$date1,$savings_amount,$createdby,$interest) {

        $data = array('savingsaccount_id' => '',
                      'account_id' => $account_id,
                      'savingsaccountstatus_id' => 1,
                      'approved_date' => $date1,
                      'savingsbegin_date' => date("Y-m-d"),
                      'savingsmature_date' => '',
                      'savings_amount'=> $savings_amount,
                      'savings_rateofinterest' => '',
                      'savings_period_frequency' => '',
                      'savings_description' => '',
                      'recordstatus_id' => 3);
       $this->insert($data);
	}
}