<?php
class IndexController extends Zend_Controller_Action 
{
    public function init() 
    {
        //$this->view->title = "Management";
		$date=date("y/m/d H:i:s");
		$this->view->baseUrl = $this->view->baseUrl();
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
		$columns = array(
		    array( 'db' => 'id', 'dt' => 'id' ),
		    array( 'db' => 'ticket_number', 'dt' => 'ticket_number' ),
		    array( 'db' => 'serviceline_name',  'dt' => 'serviceline_name' ),
		    array( 'db' => 'description',   'dt' => 'description' ),
		    array( 'db' => 'solution',     'dt' => 'solution' ),
		    array( 'db' => 'user_id',   'dt' => 'user_id' ),
		    array( 'db' => 'last_updated',     'dt' => 'last_updated' ),
		    
		);
		$order = $this->orderAction($this->getRequest()->getParams(),$columns);
		
		
		$data=$kidb->fetchAllKidb($search,$this->_request->getQuery('start'),$this->_request->getQuery('length'),$order);
		// Table's primary key
		$primaryKey = 'id';
		
		
		$finalData = array(
		    "draw"            => $this->_request->getQuery('draw'),
			"recordsTotal"    => 11,
			"recordsFiltered" => count($data),
			"data"            => $this->dataoutputAction( $columns, $data ),
		);
	    print(json_encode($finalData));
		
    }
    /**
     * Ordering
     *
     * Construct the ORDER BY clause for server-side processing SQL query
     *
     *  @param  array $request Data sent to server by DataTables
     *  @param  array $columns Column information array
     *  @return string SQL order by clause
     */
    public function orderAction ( $request, $columns )
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $order = '';
        if ( isset($request['order']) && count($request['order']) ) {
            $orderBy = array();
            $dtColumns = self::pluckAction( $columns, 'dt' );
            for ( $i=0, $ien=count($request['order']) ; $i<$ien ; $i++ ) {
                // Convert the column index into the column data property
                $columnIdx = intval($request['order'][$i]['column']);
                $requestColumn = $request['columns'][$columnIdx];
                $columnIdx = array_search( $requestColumn['data'], $dtColumns );
                $column = $columns[ $columnIdx ];
                if ( $requestColumn['orderable'] == 'true' ) {
                    $dir = $request['order'][$i]['dir'] === 'asc' ?
                    'ASC' :
                    'DESC';
                    $orderBy[] = '`'.$column['db'].'` '.$dir;
                }
            }
            if ( count( $orderBy ) ) {
                $order = 'ORDER BY '.implode(', ', $orderBy);
            }
        }
        return $order;
    }
    public function pluckAction ( $a, $prop )
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $out = array();
        for ( $i=0, $len=count($a) ; $i<$len ; $i++ ) {
            $out[] = $a[$i][$prop];
        }
        return $out;
    }
	public function addAction() 
    {
        $this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$formdata = json_decode($this->getRequest()->getRawBody());
		//var_dump($formdata);
		$data = array();
		foreach ($formdata as $key => $jsons) { // This will search in the 2 jsons
			$data[$jsons->name]=$jsons->value; 
		}
		//var_dump($data);
		
		$kidb = new App_Model_Adm();
        $data=$kidb->addKedb($data);
		$finalData = array(
			"success" => true,
			"message" => "record inserted"
		);
		print(json_encode($finalData));
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
