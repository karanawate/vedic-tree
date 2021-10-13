<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Homeworkremark extends REST_Controller 
{
    
    public function index_post()
    {
        
          $homework_id  = $this->input->post('homework_id');
            if($homework_id == '')
            {
                  $data = array('msg' => "homework id is required ",'code'=>404); 
            }else{
                
                $res = $this->regModel->student_homeworks_remarks_reponsetbl($homework_id);
        	    if(!empty($res)){
        
        	          $data = array('msg' => "Remark response Successfully !",'res'=>$res,'code'=>200); 
        	          
        	    } else {
        	          
        	          $data = array('msg' => "Remark response not Successfully !",'res'=>$res,'code'=>404);
        	    }
    	  
                  
            }
            
             $this->response($data, REST_Controller::HTTP_OK);
            
        
    }
    
   

}

?>
