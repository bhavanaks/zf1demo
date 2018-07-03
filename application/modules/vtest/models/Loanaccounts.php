<?php
class Accounting_Model_Loanaccounts extends Zend_Db_Table {
     protected $_name = 'ourbank_loanaccounts';


    public function Addloanaccounts($account_id,$date1,$savings_amount,$period,$interest,$createdby) {
        $data = array('loanaccount_id' => '',
                      'account_id' => $account_id,
                      'loanstatus_id' => 1,
                      'loansanctioned_date' => $date1,
                      'loanbegin_date' => date("Y-m-d"),
                      'loan_amount' => $savings_amount,
                      'loan_installments'=> $period,
                      'timefrequncy_id' => '',
                      'loan_interest' => $interest,
                      'savingsaccount_id' => '',
                      'tieup_flag' => 0,
                      'recordstatus_id' => 3,
                      'transacted_by' => $createdby);
       $this->insert($data);
	}
}
