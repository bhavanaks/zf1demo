<?php
class Accounting_Model_Savingtransaction extends Zend_Db_Table {
     protected $_name = 'ourbank_savings_transaction';


    public function Addsavingtransaction($transaction_id,$account_id,$createdby,$savings_amount,$interest,$transactionamount,$date1) {
        $data = array('savingtransaction_id' => '',
                      'transaction_id' => $transaction_id,
                      'account_id' => $account_id,
                      'transaction_date' => $date1,
                      'transactiontype_id' => 1,
                      'transaction_amount' => $savings_amount,
                      'paymenttype_id'=> 1,
                      'paymenttype_details' => '',
                      'transaction_description' => '',
                      'transaction_interest' => '',
                      'transaction_by' =>$createdby,
                      'createddate' => date("Y-m-d"),
                      'recordstatus_id' => 3);
       $this->insert($data);
	}
}
