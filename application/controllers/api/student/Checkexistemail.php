<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Checkexistemail extends REST_Controller 
{


 public function index_post()
  {
    
	  $checkstudentEmail = $this->input->post('studentEmail');
	  if($checkstudentEmail==""){
         $data['error'] = array('error' => "Email Id required",'code'=>404);
        }else{
            
        	$userinfo = $this->regModel->checkstudentEmail($checkstudentEmail);
        	  if($userinfo==1) {
        	        $data = array('msg' => "Email Already Exist ",'code'=>404);
        	  } else {
        	      $data = array('msg' => "Email Not Exist",'code'=>200); 
        	  }
        }
        $this->response($data, REST_Controller::HTTP_OK);

}





}
?>