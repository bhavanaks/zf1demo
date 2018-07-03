<?php
class Accounting_Form_Savings extends Zend_Form {
    public function init() {
    }
    public function __construct($minimumDeposit) {

    parent::__construct($minimumDeposit);
        $savings_amount = new Zend_Form_Element_Text('savings_amount');
        $savings_amount->addValidators(array(array('Float'),
                                      array('GreaterThan',false,array($minimumDeposit-.0001,
                                            'messages' => array('notGreaterThan' => 'Minimum 
                                             Amount To open a savings account ='.$minimumDeposit)))));
        $savings_amount->setAttrib('class', 'txt_put');
        $savings_amount->setAttrib('id', 'amount');
        $savings_amount->setRequired(true);
        $savings_amount->setAttrib('onchange', 'calculateTotalAmount(this.value)');


        $memberfirstname = new Zend_Form_Element_MultiCheckbox('memberfirstname');
        $memberfirstname->setAttrib('class', 'textfield');
        $memberfirstname->setAttrib('id', 'selector');
//         $memberfirstname->setRequired(true);

        $date1 = new ZendX_JQuery_Form_Element_DatePicker('date1',array('label' => 'Date:'));
        $date1->setAttrib('class', 'txt_put');
        $date1->setJQueryParam('dateFormat', 'yy-mm-dd');
        $date1->setRequired(true);

        $memberId = new Zend_Form_Element_Hidden('memberId');

        $Type = new Zend_Form_Element_Hidden('Type');

        $productId= new Zend_Form_Element_Hidden('productId');

        $typeId = new Zend_Form_Element_Hidden('typeId');

        $memberTypeIdv = new Zend_Form_Element_Hidden('memberTypeIdv');

        $submit = new Zend_Form_Element_Submit('Submit');

        $Yes = new Zend_Form_Element_Submit('Yes');

        $back = new Zend_Form_Element_Submit('Back');

            $this->addElements(array($submit,$savings_amount,$memberfirstname,
                                     $memberId,$date1,$productId,$typeId,
                                     $Type,$memberTypeIdv,$back,$Yes));
        }
    }
