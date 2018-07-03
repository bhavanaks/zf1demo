<?php
class Accounting_Model_fixaccounts extends Zend_Db_Table {

     protected $_name = 'ourbank_fixedaccounts';


    public function Addfixedaccounts($account_id,$date1,$createby,$matureDates,$savings_amount,$interest) {
        $data = array('fixedaccount_id' => '',
                      'account_id' =>$account_id,
                      'begin_date' =>$date1,
                      'mature_date' => $matureDates,
                      'fixed_amount' => $savings_amount,
                      'timefrequncy_id' => 1,
                      'fixed_interest' => $interest,
                      'premature_interest' => '',
                      'fixedaccountstatus_id' => 3,
                      'created_by' => $createby,
                      'created_date' => date('Y-m-d'),
                      'modified_by' => '',
                      'modified_date' => '',
                      'recordstatus_id' => 3
                      ); 
       $this->insert($data);
    }
}
