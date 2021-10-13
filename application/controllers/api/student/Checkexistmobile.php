<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Checkexistmobile extends REST_Controller 
{


 public function index_post()
  {
    
	  $studentMobile = $this->input->post('studentMobile');
	  if($studentMobile==""){
         $data['error'] = array('error' => "studentMobile required",'code'=>404);

        }else{
            
        	 $userinfo = $this->regModel->checkstudentMobile($studentMobile);
        	  if($userinfo==1) {
        	        $data = array('msg' => "Mobile Number Already Exist ",'code'=>404);
        	  } else {
        	      $data = array('msg' => "Mobile Number Not Exist ",'code'=>200); 
        	  }
              
        }
        
        $this->response($data, REST_Controller::HTTP_OK);
        
}





}
?>