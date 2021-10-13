<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Uploadhomework extends REST_Controller 
{
    
    public function index_post()
    {
        
        
             $studId                    =  $this->input->post('studId');
             $start_time                 =  $this->input->post('start_time');
             $homework_id                = $this->input->post('homework_id');
             $fk_feesId                  = $this->input->post('fk_feesId');
             $class_id                   = $this->input->post('class_id');
             $home_title                 = $this->input->post('home_title');
             
        if($studId==""){
              $data =array('msg'=>'student id  is required','code'=>400);   
        }else if($start_time==""){
              $data =array('msg'=>'start time is required','code'=>400); 
        }else if ($homework_id==""){
              $data =array('msg'=>'homework id is required','code'=>400);    
        }else if($fk_feesId==""){
        	  $data =array('msg'=>'package id is required','code'=>400);
        }else if($home_title==""){
        	  $data =array('msg'=>'home title is required','code'=>400);
        }else  if($class_id==""){
              $data =array('msg'=>'class  is required','code'=>400);
        }else{
             
          $this->load->library('upload');
          $image = array();
          $ImageCount = count($_FILES['file_allocated']['name']);
       
        for($i = 0; $i < $ImageCount; $i++){
           $FILENAMES =  $_FILES['file']['name']       = $_FILES['file_allocated']['name'][$i];
            $_FILES['file']['type']       = $_FILES['file_allocated']['type'][$i];
            $_FILES['file']['tmp_name']   = $_FILES['file_allocated']['tmp_name'][$i];
            $_FILES['file']['error']      = $_FILES['file_allocated']['error'][$i];
            $_FILES['file']['size']       = $_FILES['file_allocated']['size'][$i];
            // File upload configuration
             $studId                    =  $this->input->post('studId');
             $start_time                =  $this->input->post('start_time');
             $homework_id               = $this->input->post('homework_id');
             $fk_feesId                 = $this->input->post('fk_feesId');
             $class_id                  = $this->input->post('class_id');
             $home_title                = $this->input->post('home_title');
              
            $uploadPath = './uploads/homework_allocated_student/';
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|PNG|JPEG';

            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            // Upload file to server
            
             $gethomework_data = $this->teacherModel->back_reposense_homeworkapi($start_time,$homework_id,$fk_feesId,$class_id,$FILENAMES,$home_title,$studId);
             
            if($this->upload->do_upload('file')){
                $imageData = $this->upload->data();
            }
            
            
        }
          
         if(!empty($uploadImgData)){
            // Insert files data into the database
            // $this->pages_model->multiple_images($uploadImgData);              
        }
        
         if($gethomework_data) {
	        $data = array('msg' => "Homework Insert successfully ",'gethomework_data'     =>$gethomework_data);
	      } else {
	        $data = array('msg' => "Homework Insert not  successfully",'gethomework_data' =>$gethomework_data); 
	       }
        
        }
        
         $this->response($data, REST_Controller::HTTP_OK);
            
        
    
    }
    
   

}

?>
