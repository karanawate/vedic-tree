<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Login extends REST_Controller 
{



 public function index_post()
{
	
        $studentMobile = $this->input->post('studentMobile');
        $studentPass  = $this->input->post('studentPass');
        if($studentMobile==""){
            $data = array('msg' => "studentMobile required",'res'=>$res,'code'=>404);
            
        }else if($studentPass==""){
            $data = array('msg' => "studentPass required",'res'=>$res,'code'=>404);
        }else{
            $res  = $this->apimodel->getdata($studentMobile,$studentPass);
    
    	    if(!empty($res)){
    
    	          $data = array('msg' => "Student Login Successfully !",'res'=>$res,'code'=>200); 
    	          
    	    } else {
    	          
    	          $data = array('msg' => "Student Not Exist !",'res'=>$res,'code'=>404);
    	    }
        }

     
        $this->response($data, REST_Controller::HTTP_OK);
	}


}

?>