<?php
class Accounting_Form_Recuring extends Zend_Form {
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


        $recuringamount = new Zend_Form_Element_Text('recuringamount');
        $recuringamount->setAttrib('class', 'txt_put');

        $amount = new Zend_Form_Element_Text('amount');
        $amount->addValidators(array(array('Float'),
                               array('GreaterThan',false,array($minimumDeposit-.0001,
                                     'messages' => array('notGreaterThan' => 'Minimum 
                                      Amount To open a savings account ='.$minimumDeposit)))));
        $amount->setAttrib('class', 'txt_put');
        $amount->setRequired(true);
        $amount->setAttrib('onchange', 'calculateTotalAmount(this.value)');


        $memberfirstname = new Zend_Form_Element_MultiCheckbox('memberfirstname');
        $memberfirstname->setAttrib('class', 'textfield');
        $memberfirstname->setRequired(true);

        $memberId = new Zend_Form_Element_Hidden('memberId');

        $productId= new Zend_Form_Element_Hidden('productId');

        $typeId = new Zend_Form_Element_Hidden('typeId');

        $memberTypeIdv = new Zend_Form_Element_Hidden('memberTypeIdv');

        $submit = new Zend_Form_Element_Submit('Submit');

        $Yes = new Zend_Form_Element_Submit('Yes');

        $back = new Zend_Form_Element_Submit('Back');

            $this->addElements(array($submit,$amount,$period,$interest,$recuringamount,
                                     $memberfirstname,$memberId,$date1,$productId,$typeId,$memberTypeIdv,$back,$Yes));
        }
    }
