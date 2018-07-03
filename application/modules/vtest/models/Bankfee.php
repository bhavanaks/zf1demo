<?php
class Accounting_Model_Bankfee extends Zend_Db_Table {
     protected $_name = 'ourbank_bankfeeaccount';

    public function Addbankfee($branchAccountNumber,$transaction_id,$account_id,$feeTotal) {
        $data = array('bank_id' => '',
                      'bank_account_id' => $branchAccountNumber,
                      'tranasction_number' => $transaction_id,
                      'fee_id' => '',
                      'transaction_date' => date("Y-m-d"),
                      'amount_to_bank' => $feeTotal,
                      'amount_from_bank'=> '',
                      'From_account_number' => $account_id,
                      'is_fund' => '',
                      'record_status' => 1);
       $this->insert($data);
	}
}
