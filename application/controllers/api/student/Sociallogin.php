<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Sociallogin extends REST_Controller 
{


 public function index_post()
  {
  	  
	  $studentEmail   = $this->input->post('studentEmail');	  
	
	if($studentEmail==""){
        $data = array('msg' => "studentEmail required ",'code'=>404);
     }else{
         
    	  $check_social_login_exist =  $this->regModel->check_social_login_exist($studentEmail);
    	  if(!empty($check_social_login_exist)) {
    	        $data = array('msg' => "Login Succeessfully ",'code'=>200,'SocialloginData'=>$check_social_login_exist);
    	  } else {
    	      $data = array('msg' => "Email Id Already Exist",'code'=>404,'SocialloginData'=>$check_social_login_exist); 
    	  }
     }
      
      $this->response($data, REST_Controller::HTTP_OK);

}

   



}

?>