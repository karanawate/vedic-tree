<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class ChecklogId extends REST_Controller 
{


 public function index_post()
 {
    
	  $logRandomId = $this->input->post('logRandomId');
	   if($logRandomId==""){
         $data['error'] = array('error' => "logRandomId required",'code'=>404);

        }else{
            
        	 $ChecklogId = $this->regModel->ChecklogId($logRandomId);
        	  if($ChecklogId==1) {
        	        $data = array('msg' => "Key Found ",'code'=>200);
        	  } else {
        	      $data = array('msg' => "Key Not Exist ",'code'=>404); 
        	  }
              
        }
        
        $this->response($data, REST_Controller::HTTP_OK);
        
}





}
?>