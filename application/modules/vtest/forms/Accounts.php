<?php
class Accounting_Form_Accounts extends Zend_Form {
    public function init() {

        $membercode = new Zend_Form_Element_Text('membercode');
        $membercode->setAttrib('class', 'txt_put');
        $membercode->setLabel('Member Code /First Name/GroupName');
        $membercode->setRequired(true)
                     ->addValidators(array(array('NotEmpty')))
                     ->setDecorators(array('ViewHelper',
                             array('Description',array('tag'=>'','escape'=>false)),'Errors',
                             array(array('data'=>'HtmlTag'), array('tag' => 'td')),
                             array('Label', array('tag' => 'td','requiredSuffix' => ' *',)),
                             array(array('row'=>'HtmlTag'),array('tag'=>'tr'))));



       $Type = new Zend_Form_Element_Hidden('Type');

        $submit = new Zend_Form_Element_Submit('Submit');
        $submit->setAttrib('id', 'save')
               ->setDecorators(array('ViewHelper',
                             array('Description',array('tag'=>'','escape'=>false)),'Errors',
                             array(array('data'=>'HtmlTag'), array('colspan' => '8 ')),
                             array(array('data'=>'HtmlTag'), array('tag' => 'td ', 'colspan'=>'8')),
                             array(array('row'=>'HtmlTag'),array('tag'=>'tr'))));

        $this->addElements(array($membercode,$Type,$fileEle,$submit));

    }
}