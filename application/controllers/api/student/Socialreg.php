<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Socialreg extends REST_Controller 
{


 public function index_post()
  {
  	  
	 $studentEmail   = $this->input->post('studentEmail');	  
	 $studentName    = $this->input->post('studentName');
	 $studentMobile  = $this->input->post('studentMobile');
	 $studentClass   = $this->input->post('studentClass');
	 $studentGender  = $this->input->post('studentGender');
	 $studentPass    = $this->input->post('studentPass');
	 
	 if($studentName==""){
        $data = array('msg' => "studentName required ",'code'=>404);
     }else if($studentEmail==""){
        $data = array('msg' => "studentEmail required ",'code'=>404);
     }else if($studentClass==""){
        $data = array('msg' => "studentClass required ",'code'=>404);
     }else if($studentGender==""){
        $data = array('msg' => "studentGender required ",'code'=>404);
     }else if($studentMobile==""){
        $data = array('msg' => "studentMobile required ",'code'=>404);
     }else if($studentPass==""){
        $data = array('msg' => "studentPass required ",'code'=>404);
     }else{

    	  $socialdata = array(	
    	 					'studentEmail' 	   => $studentEmail,
    	 					'studentName' 	   => $studentName,
    	 					'studentMobile'    => $studentMobile,
    	 					'studentClass'     => $studentClass,
    	 					'studentGender'    => $studentGender,
    	 					'studentPass'      => sha1($studentPass),
    	 					'studentStatus'    => "1",
    	 					'NewrefferalCode'  => "VEDICREF-".rand(111111,999999)
                        );
    
    	  $listvideouploading =  $this->regModel->check_login_exist($socialdata);
    	  if(!empty($listvideouploading)) {
    	        $data = array('msg' => "Social Registration Succeessfully ",'code'=>200,'SocialloginData'=>$listvideouploading);
    	  } else {
    	      $data = array('msg' => "Email Id Already Exist",'code'=>404,'SocialloginData'=>$listvideouploading); 
    	  }
     }
      
      $this->response($data, REST_Controller::HTTP_OK);

}

   



}

?>