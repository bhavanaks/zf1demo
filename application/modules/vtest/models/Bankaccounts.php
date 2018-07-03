<?php
class Accounting_Model_Bankaccounts extends Zend_Db_Table {
     protected $_name = 'ourbank_bankaccount_details';


    public function Addbankaccounts($account_id,$savings_amount,$transaction_id,$branchAccountNumber) {
        $data = array('bank_id' => '',
                      'bank_account_id' => $branchAccountNumber,
                      'tranasction_number' => $transaction_id,
                      'transaction_date' => date("Y-m-d"),
                      'amount_to_bank' => $savings_amount,
                      'amount_from_bank' => '',
                      'From_account_number'=> $account_id,
                      'is_fund' => '',
                      'record_status' => 1);
       $this->insert($data);
	}
}
