<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Viewhomework extends REST_Controller 
{
    
    public function index_post()
    {
        
        $class_id                = $this->input->post('class_id');
        $package_id              = $this->input->post('package_id');
        $approvel_status         = $this->input->post('approvel_status');
        if($class_id==""){
           $data =array('msg'=>'class_id  is required','code'=>400);   
        }else if($package_id==""){
           $data =array('msg'=>'package_id is required','code'=>400); 
        }else if ($approvel_status==""){
           $data =array('msg'=>'approvel_status is required','code'=>400);    
        }else{
         $gethomework_data = $this->teacherModel->view_homeworkfor_student_api($class_id,$package_id,$approvel_status);
         if($gethomework_data) {
	        $data = array('msg' => "Homework data fetch successfully ",'getfeesdata'=>$gethomework_data);
	      } else {
	        $data = array('msg' => "Homework data  not fetch successfully",'getfeesdata'=>$gethomework_data); 
	       }
        }
	       
         $this->response($data, REST_Controller::HTTP_OK);
  
    }
    
   

}

?>
