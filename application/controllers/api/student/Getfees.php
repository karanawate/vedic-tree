<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Getfees extends REST_Controller 
{


 public function index_post()
  {
  	  
	 
      $fk_classId  = $this->input->post('fk_classId'); 
      if($fk_classId==""){
      	$data = array('msg' => "fk_classId requierd",'code'=>404);
      	$this->response($data, REST_Controller::HTTP_OK);
      }else{

		  $getfeesdata =  $this->regModel->getfees($fk_classId);
		  if(!empty($getfeesdata)) {
		        $data = array('msg' => "Fees data fetch successfully ",'code'=>200,'getfeesdata'=>$getfeesdata);
		  } else {
		      $data = array('msg' => "Email Id Already Exist",'code'=>404,'getfeesdata'=>$getfeesdata); 
		  }
	      
	      $this->response($data, REST_Controller::HTTP_OK);
      }

}

   



}

?>