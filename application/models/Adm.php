<?php
class App_Model_Adm extends Zend_Db_Table 
{
    protected $_name = 'kidb_solution';
    public function fetchAllKidb($search) 
    {
		$db = Zend_Db_Table::getDefaultAdapter();
		$query = "SELECT `A`.*, `B`.* FROM `kidb_solution` AS `A`
					 LEFT JOIN `kidb_serviceline` AS `B` ON A.serviceline_id = B.id
					 where 1 ";
		if(isset($search) AND $search != '') {
			$query .= "AND CONCAT(short_description, description, solution,ticket_number,serviceline_name) REGEXP '".$search."'";
		}
		$result = $db->fetchAll($query);
		return $result;
	}
	
	public function fetchSerivceLine($table) 
	{
		$select = $this->select()
                        ->setIntegrityCheck(false)  
                        ->from($table)
                        ->where('status = ?',1)
						;
		//die($select->__toString());
        $result = $this->fetchAll($select);
        return $result->toArray(); 
	}
	
		
}
