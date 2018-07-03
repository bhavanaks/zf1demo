<?php
class Accounting_Model_Reccuringtransaction extends Zend_Db_Table {
     protected $_name = 'ourbank_recurringaccounts';


    public function Addrecuring($account_id,$date1,$matureDates,$amount,$interest,$createby) {
        $data = array('recurringaccount_id' => '',
                      'account_id' => $account_id,
                      'begin_date' => $date1,
                      'mature_date' => $matureDates,
                      'recurring_amount' => $amount,
                      'timefrequncy_id' => '',
                      'fixed_interest'=> $interest,
                      'premature_interest' => '',
                      'fixedaccountstatus_id' => 1,
                      'created_by' => $createby,
                      'created_date' => date('Y-m-d'),
                      'modified_by' => '',
                      'modified_date' =>'',
                      'recordstatus_id' =>3);
       $this->insert($data);
	}
}
