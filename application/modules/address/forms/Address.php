<?php
class Address_Form_Address extends Zend_Form {
    public function init(){}
    public function __construct($id,$subId) 
    {
        parent::__construct($id);
        parent::__construct($subId);
        $vtype=array('Digits');
        //$id= record id
        //$subId=submodule id
        //create address form elements...
        //$fieldtype,$fieldname,$table,$columnname,$cssname,$labelname,$required,$validationtype,$min,$max,$rows,$cols,$decorator,$value
        $formfield = new App_Form_Field ();
        $addressline1 = $formfield->field('Text','address1','','','mand','Address line1',true,'','','','','',1,0);
        $addressline2 = $formfield->field('Text','address2','','','','Address line2',false,'','','','','',1,0);
        $addressline3 = $formfield->field('Text','address3','','','','Address line3',false,'','','','','',1,0);
        $city = $formfield->field('Text','city','','','mand','City/Taluk',true,'','','','','',1,0);
        $hobli = $formfield->field('Text','hobli','','','','Hobli',false,'','','','','',1,0);
        $village = $formfield->field('Text','village','','','','Village',false,'','','','','',1,0);
        $district = $formfield->field('Text','district','','','','District',false,'','','','','',1,0);
        $state = $formfield->field('Text','state','','','','State',false,'','','','','',1,0);
        $pincode = $formfield->field('Text','zipcode','','','','Pincode',false,$vtype,'','','','',1,0);
        $address_id = $formfield->field('Hidden','id','','','','',false,'','','','','',0,$id);
        $sub_id = $formfield->field('Hidden','submodule_id','','','','',false,'','','','','',0,$subId);
        $created_by = $formfield->field('Hidden','created_by','','','','',false,'','','','','',0,1);
        $created_date = $formfield->field('Hidden','created_date','','','','',false,'','','','','',0,date("y/m/d H:i:s"));
        $this->addElements(array($sub_id,$address_id,$addressline1,$addressline2,$addressline3,$hobli,$village,$city,$district,$state,$pincode,$created_date,$created_by));
    }
}
