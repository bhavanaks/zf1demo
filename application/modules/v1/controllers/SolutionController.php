<?php
class SolutionController extends Zend_Rest_Controller
{
	public function init()
	{
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
	}
	public function indexAction()
	{
	  $this->getResponse()->setBody('Hello World');
	  $this->getResponse()->setHttpResponseCode(200);
	}

	public function getAction()
	{
	  $this->getResponse()->setBody('Foo!');
	  $this->getResponse()->setHttpResponseCode(200);
	}

	public function postAction()
	{
      if (! $this->isjsonAction($this->getRequest()->getRawBody())) {
          $this->getResponse()->setHttpResponseCode(400);
          $finalData = array(
              "status_code"  => 400,
              "error" => "Bad request",
              "message" => "Not a valid json input",
          );
          die(print(json_encode($finalData)));
      }
	  
	  $data = Zend_Json::decode($this->getRequest()->getRawBody());
	  if(! $this->countAction($data,6)) {
	      $this->getResponse()->setHttpResponseCode(400);
	      $finalData = array(
	          "status_code"  => 400,
	          "error" => "Bad request",
	          "message" => "Oops! some attributes are missing",
	      );
	      die(print(json_encode($finalData)));
	  }
	  
      $validate = array(
	      'ticket_number' => array('mandatory' => true, 'regex' => '/^[0-9]*$/'),
	      'serviceline_id' => array('mandatory' => true, 'regex' => '/^[0-9]*$/'),
	      'category_id' => array('mandatory' => true, 'regex' => '/^[0-9]*$/'),
	      'short_description' => array('mandatory' => true, 'regex' => null),
	      'description' => array('mandatory' => true, 'regex' => null),
	      'solution' => array('mandatory' => true, 'regex' => null),
	      
	      // Same like the above example you can create all validation
	  );
      $valResult = $this->validateAction($data,$validate);
      if($valResult === "pass") {
          
      } else {
          $this->getResponse()->setHttpResponseCode(400);
          $valResult["status_code"] = "400";
          die(print(json_encode($valResult)));
      }
      $kidb = new App_Model_Adm();
      $tCount = $kidb->ticketExist($data["ticket_number"]);
      if(intval($tCount) > 0) {
          $finalData = array(
              "status_code"  => 400,
              "error" => "Bad request",
              "message" => "This ticket_number ==> ".$data["ticket_number"]." already exist",
          );
          die(print(json_encode($finalData)));
      } 
	  $data=$kidb->addKedb($data);
	  if($data) {
	      $finalData = array(
	          "status_code"  => 200,
	          "message" => "successfuly inserted the data",
	      );
	  }
	  $this->getResponse()->setHttpResponseCode(200);   
	  die(print(json_encode($finalData)));
	}

	public function putAction()
	{
	  $this->getResponse()->setBody('resource updated');
	  $this->getResponse()->setHttpResponseCode(200);
	}

	public function deleteAction()
	{
	  $this->getResponse()->setBody('resource deleted');
	  $this->getResponse()->setHttpResponseCode(200);
	}
	
	public function isjsonAction($data)
	{
	    json_decode($data);
	    return (json_last_error() == JSON_ERROR_NONE);
	}
	public function countAction($data,$count)
	{
	    return (count($data) === $count) ? true:false;
	}
	
	public function validateAction($data,$validate)
	{
	    $missing_input = array();
	    $invalid_input = array();
	    
	    foreach($data as $key => $val){
	        $mandatory = isset($validate[$key]['mandatory']) ? $validate[$key]['mandatory'] : false;
	        $regex = isset($validate[$key]['regex']) ? $validate[$key]['regex'] : null;
	        if($mandatory && !trim($val)){
	            // Manage error here
	            $missing_input[] = $key;
	        } else if($regex != null && trim($val)){
	            if(!preg_match($regex,$val)){
	                $invalid_input[] = $key;
	            }
	        }
	    }
	    if(!empty($missing_input) or !empty($invalid_input)) {
	        $errorData = array(
	            "Missing Inputs"  => implode(", ", $missing_input),
	            "Invalid Inputs" => implode(", ", $invalid_input),
	        );
	       return $errorData;
	    } else {
	        return "pass";
	    }
	}
}
