<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Updatedata extends REST_Controller 
{


 public function index_post()
{
	
        $studId = $this->input->post('studId');
        if($studId==""){
            $data = array('msg' => "studId required",'code'=>404);
            
        }else{
            $res  = $this->apimodel->updateData($studId);
    
    	    if(!empty($res)){
    
    	          $data = array('msg' => "Student data get Successfully !",'res'=>$res,'code'=>200); 
    	          
    	    } else {
    	          
    	          $data = array('msg' => "Student Not Exist !",'res'=>$res,'code'=>404);
    	    }
        }

     
        $this->response($data, REST_Controller::HTTP_OK);
	}


}

?>