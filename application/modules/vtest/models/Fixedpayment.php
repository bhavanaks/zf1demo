<?php
class Accounting_Model_Fixedpayment extends Zend_Db_Table {
     protected $_name = 'ourbank_fixed_payment';


    public function Addfixedpayment($transaction_id,$account_id,$date1) {
        $data = array('fixed_paymentserial_id' => '',
                      'transaction_id' => $transaction_id,
                      'account_id' => $account_id,
                      'fixed_paymentpaid_date' => $date1,
                      'fixed_amount' => '',
                      'fixed_interst_amount' => '',
                      'fixed_penalty_amount'=> '',
                      'fixed_other_deduction_amount' => '',
                      'recordstatus_id' => 1);
       $this->insert($data);
	}
}
