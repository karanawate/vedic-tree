<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Studentnotice extends REST_Controller 
{
    
    public function index_post()
    {
        $class_id       = $this->input->post('class_id');
            
            if($class_id == '')
            {
                  $data = array('msg' => "class_id is required ",'code'=>404); 
            }else{
                
                $res = $this->teacherModel->student_common_notice($class_id);
        	    if(!empty($res)){
        
        	          $data = array('msg' => "Notice data Successfully !",'res'=>$res,'code'=>200); 
        	          
        	    } else {
        	          
        	          $data = array('msg' => "Notice Not Exist !",'res'=>$res,'code'=>404);
        	    }
    	  
                  
            }
            
             $this->response($data, REST_Controller::HTTP_OK);
            
        
    
    }
    
   

}

?>
