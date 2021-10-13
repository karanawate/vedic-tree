<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Studentinfo extends REST_Controller 
{


 public function index_post()
  {
    
	  $studId = $this->input->post('studId');
	  if($studId==""){
         $data['error'] = array('error' => "studId required",'code'=>404);
         $this->response($data, REST_Controller::HTTP_OK);

        }else{
            
        	 $userinfo = $this->regModel->userinfo($studId);
        	  if(!empty($userinfo)) {
        	        $data = array('msg' => "Data Fetch Succeessfully ",'code'=>200,'userinfo'=>$userinfo);
        	  } else {
        	      $data = array('msg' => "Data not Fetch Succeessfully",'code'=>404,'userinfo'=>$userinfo); 
        	  }
              
              $this->response($data, REST_Controller::HTTP_OK);
        }

}





}
?>