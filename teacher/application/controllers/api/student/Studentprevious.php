<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Studentprevious extends REST_Controller 
{
    
    public function index_post()
    {
          $student_id       = $this->input->post('student_id');
          if($student_id == '')
            {
                  $data = array('msg' => "student id  is required "); 
            }else{
                      $res = $this->teacherModel->student_previous_month($student_id);
                      $monthdate = date('m', strtotime($res[0]['createDT']));
                      $check_date = $this->teacherModel->student_previous_month_table($monthdate);
                   
                      if(!empty($check_date)){
                 	          $data = array('msg' => " access granted !"); 
                	          
                 	    } else {
                 	          $data = array('msg' => " access denied !");
                 	    }
        	  
                  
                }
                
             $this->response($data, REST_Controller::HTTP_OK);
         	    
    }
    
    
    
    
    
    
    
   

}

?>
