<?php
class Accounting_Form_Loan extends Zend_Form
{
    public function init()
    {
        Zend_Dojo::enableForm($this);
    }


    public function __construct($beginDate,$matureDate,$minimumDeposit,$maxmDeposit,$app)
    {
        Zend_Dojo::enableForm($this);
        parent::__construct($beginDate,$matureDate,$minimumDeposit,$maxmDeposit);

        $memberfirstname = new Zend_Form_Element_MultiCheckbox('memberfirstname');
        $memberfirstname->setAttrib('class', 'txt_put');
        $memberfirstname->setRequired(true);

        $savingAccount = new Zend_Form_Element_multiCheckbox('savingAccount');
        $savingAccount->setAttrib('class', 'txt_put');
//         $savingAccount->setRequired(true);

        $startdate = new ZendX_JQuery_Form_Element_DatePicker('loanAccountdate',array('label' => 'Date:'));
        $startdate->setJQueryParam('dateFormat', 'yy-mm-dd');
        $startdate->setAttrib('size', '8');
        $startdate->setAttrib('class', 'txt_put');
        $startdate->setRequired(true);

        $amount = new Zend_Form_Element_Text('amount');
        $amount->setRequired(true);
        $amount->addValidator('Float');
        $amount->setAttrib('size', '8');
        $amount->setAttrib('class', 'txt_put');
        $amount->setAttrib('onchange', 'calculateTotalAmount(this.value)');

        $loanInstallements = new Zend_Form_Element_Select('loanInterest');
        $loanInstallements->addMultiOption('','Select...');
        $loanInstallements->setAttrib('class', 'txt_put');
        $loanInstallements->setAttrib('id', 'loanInterest');
        $loanInstallements->setRequired(true);
        $loanInstallements->setAttrib('onchange', 'getInterests(this.value,"'.$app.'")');

        $interest = new Zend_Form_Element_Text('interest');
        $interest->setAttrib('class', 'txt_put');
        $interest->setAttrib('id', 'interest');
        $interest->setAttrib('size', '8');
        $this->addElements( array ($memberfirstname,$interest,$startdate,
                                   $amount,$loanInstallements));

        $submit = new Zend_Form_Element_Submit('Submit');

        $memberId = new Zend_Form_Element_Hidden('memberId');

        $productId= new Zend_Form_Element_Hidden('productId');

        $typeId = new Zend_Form_Element_Hidden('typeId');

        $Type= new Zend_Form_Element_Hidden('Type');

        $back = new Zend_Form_Element_Submit('Back');

        $Yes = new Zend_Form_Element_Submit('Yes');

        $this->addElements(array($submit,$memberId,$productId,$savingAccount,$typeId,$Type,$back,$Yes));
    }
}
