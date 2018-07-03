<?php
class Accounting_Form_Fixed extends Zend_Form {
    public function __construct($minimumDeposit) {
    parent::__construct($minimumDeposit);
        $date1 = new ZendX_JQuery_Form_Element_DatePicker('date1',array('label' => 'Date:'));
        $date1->setAttrib('class', 'txt_put');
        $date1->setJQueryParam('dateFormat', 'yy-mm-dd');
        $date1->setRequired(true);

        $period = new Zend_Form_Element_Select('period');
        $period->addMultiOption('','Select...');
        $period->setAttrib('class', 'txt_put');
        $period->setRequired(true)
               ->addValidators(array(array('NotEmpty')));
        $period->setAttrib('onchange', 'getInterests(this.value)');

        $interest = new Zend_Form_Element_Text('interest');
        $interest->setAttrib('class', 'txt_put');

        $tAmount = new Zend_Form_Element_Text('tAmount');
        $tAmount->setAttrib('class', 'txt_put');
        $tAmount->setAttrib('onchange', 'calculateMatureAmount()');

        $matureamount = new Zend_Form_Element_Text('matureamount');
        $matureamount->setAttrib('class', 'txt_put');

        $amount = new Zend_Form_Element_Text('amount');
        $amount->addValidators(array(array('Float'),
                               array('GreaterThan',false,array($minimumDeposit-.0001,
                                     'messages' => array('notGreaterThan' => 'Minimum 
                                     Amount To open a savings account ='.$minimumDeposit)))));
        $amount->setAttrib('class', 'txt_put');
        $amount->setRequired(true);
        $amount->setAttrib('onchange', 'calculateTotalAmount(this.value),calculateMatureAmount()');

        $memberfirstname = new Zend_Form_Element_MultiCheckbox('memberfirstname');
        $memberfirstname->setAttrib('class', 'textfield');
        $memberfirstname->setRequired(true);

        $memberId = new Zend_Form_Element_Hidden('memberId');

        $productId= new Zend_Form_Element_Hidden('productId');

        $typeId = new Zend_Form_Element_Hidden('typeId');

        $Type= new Zend_Form_Element_Hidden('Type');

        $memberTypeIdv = new Zend_Form_Element_Hidden('memberTypeIdv');

        $submit = new Zend_Form_Element_Submit('Submit');

        $Yes = new Zend_Form_Element_Submit('Yes');

        $back = new Zend_Form_Element_Submit('Back');

        $this->addElements(array($submit,$amount,$period,$matureamount,$interest,$recuringamount,$tAmount,
                                 $memberfirstname,$memberId,$Type,$date1,$productId,$typeId,$memberTypeIdv,
                                 $Yes,$back));
        }
    }
