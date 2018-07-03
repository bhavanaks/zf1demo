<?php
class IndexController extends Zend_Controller_Action 
{
    public function init() 
    {
        //$this->view->title = "Management";
		$date=date("y/m/d H:i:s");
    }

    public function indexAction() 
    {
        
    }
	
	public function getdropdownAction() 
	{
		$table = $this->_request->getQuery('name');
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$kidb = new App_Model_Adm();
        $data = $kidb->fetchSerivceLine($table);
		echo json_encode($data);

	}
	
	public function getdataAction() 
    {
        $this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		//getParam
		$search = '';
		if(isset($this->_request->getQuery('search')['value'])) {
			$search = $this->_request->getQuery('search')['value'];
		}
		
		$kidb = new App_Model_Adm();
        $data=$kidb->fetchAllKidb($search);
		// Table's primary key
		$primaryKey = 'id';
		$columns = array(
			array( 'db' => 'ticket_number', 'dt' => 'ticket_number' ),
			array( 'db' => 'serviceline_name',  'dt' => 'serviceline_name' ),
			array( 'db' => 'description',   'dt' => 'description' ),
			array( 'db' => 'solution',     'dt' => 'solution' ),
			array( 'db' => 'user_id',   'dt' => 'user_id' ),
			array( 'db' => 'last_updated',     'dt' => 'last_updated' ),
			
		);
		
		$finalData = array(
			"draw"            => 1,
			"recordsTotal"    => count($data),
			"recordsFiltered" => count($data),
			"data"            => $this->dataoutputAction( $columns, $data ),
		);
		
		//print_r($finalData);die();
	    print(json_encode($finalData));
		
    }
	public function addAction() 
    {
        $this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$formData = $this->_request->getPost('data');
		var_dump($formData);
		die();
    }
	/**
	 * Create the data output array for the DataTables rows
	 *
	 *  @param  array $columns Column information array
	 *  @param  array $data    Data from the SQL get
	 *  @return array          Formatted data in a row based format
	 */
	public function dataoutputAction( $columns, $data )
	{
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);

		$out = array();
		for ( $i=0, $ien=count($data) ; $i<$ien ; $i++ ) {
			$row = array();
			for ( $j=0, $jen=count($columns) ; $j<$jen ; $j++ ) {
				$column = $columns[$j];
				// Is there a formatter?
				if ( isset( $column['formatter'] ) ) {
					$row[ $column['dt'] ] = $column['formatter']( $data[$i][ $column['db'] ], $data[$i] );
				}
				else {
					$row[ $column['dt'] ] = $data[$i][ $columns[$j]['db'] ];
				}
			}
			$out[] = $row;
		}
		return $out;
	}

	
	
    
}
