<?php
class App_Model_Adm extends Zend_Db_Table 
{
    protected $_name = 'kidb_solution';
    public function fetchAllKidb($search,$start,$length,$order) 
    {
		$db = Zend_Db_Table::getDefaultAdapter();
		$query = "SELECT `A`.*, `B`.* FROM `kidb_solution` AS `A`
					 LEFT JOIN `kidb_serviceline` AS `B` ON A.serviceline_id = B.id
					 where 1 ";
		if(isset($search) AND $search != '') {
			$query .= "AND CONCAT(short_description, description,solution,ticket_number,serviceline_name) REGEXP '".$search."'";
		}
		$query .= $order; 
		$query .= " LIMIT ".$start.",".$length." "; 
		//echo $query; die();
		$result = $db->fetchAll($query);
		return $result;
	}
	
	public function ticketExist($ticketNum)
	{
	    $select = $this->select()
	              ->setIntegrityCheck(false)
	              ->from("kidb_solution", array('count(*) as ticket_count'))
	               ->where('ticket_number = ?',$ticketNum)
	               ;
        //echo $select; die();
	    $rows = $this->fetchAll($select);
	    return($rows[0]->ticket_count);  
	}
	
	public function fetchSerivceLine($table) 
	{
		$select = $this->select()
                        ->setIntegrityCheck(false)  
                        ->from($table)
                        ->where('status = ?',1)
						;
        $result = $this->fetchAll($select);
        return $result->toArray(); 
	}
	public function addKedb($dataArray)
	{
		$this->db = Zend_Db_Table::getDefaultAdapter();
        $this->db->insert("kidb_solution",$dataArray);
        return '1';
	}
	
	
	
}
