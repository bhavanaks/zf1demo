<?php
class Accounting_Model_Recuringpayment extends Zend_Db_Table {
     protected $_name = 'ourbank_recurring_payment';


    public function Addrecuringpayment($transaction_id,$account_id,$date1,$savings_amount) {
        $data = array('rec_paymentserial_id' => '',
                      'transaction_id' => $transaction_id,
                      'account_id' => $account_id,
                      'rec_payment_number' => 1,
                      'rec_paymentpaid_date' => $date1,
                      'rec_paid_amount' => $savings_amount,
                      'rec_paid_interst' => '',
                      'rec_paid_other_amount' => '',
                      'recordstatus_id' => 3);
       $this->insert($data);
	}
}
