<?php
class Accounting_Model_Transaction extends Zend_Db_Table {
     protected $_name = 'ourbank_transaction';


    public function Addtransaction($savings_amount,$account_id,$createdby,$tAmount,$interest) {
        $data = array('transaction_id' => '',
                      'account_id' => $account_id,
                      'transaction_date' => date("Y-m-d"),
                      'amount_to_bank' => $savings_amount,
                      'amount_from_bank' => '',
                      'transaction_amount' => $tAmount,
                      'transaction_interest_amount'=> $interest,
                      'transaction_fine_amount' => '',
                      'transaction_other_amount' => '',
                      'paymenttype_mode' => 1,
                      'transaction_mode_details' => 1,
                      'transaction_type' => 1,
                      'recordstatus_id' =>3,
                      'reffering_vouchernumber' =>'',
                      'transaction_remarks' => '',
                      'balance' => $savings_amount,
                      'confirmation_flag' =>0,
                      'updated_by' => '',
                      'created_by' => $createdby,
                      'createddate' => date("Y-m-d"));
       $this->insert($data);
	}
}
