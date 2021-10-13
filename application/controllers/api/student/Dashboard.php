<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Dashboard extends REST_Controller 
{


 public function index_post()
  {
    
	  $fk_classId = $this->input->post('fk_classId');
	  if($fk_classId==""){
         $data['error'] = array('error' => "fk_classId Failed !",'code'=>404);
         $this->response($data, REST_Controller::HTTP_OK);

        }else{
            
        	  $listvideouploading =  $this->regModel->listvideouploading($fk_classId);
        	  if(!empty($listvideouploading)) {
        	        $data = array('msg' => "Data Fetch Succeessfully ",'code'=>200,'list_video_uploading_data'=>$listvideouploading);
        	  } else {
        	      $data = array('msg' => "Data not Fetch Succeessfully",'code'=>404,'list_video_uploading_data'=>$listvideouploading); 
        	  }
              
              $this->response($data, REST_Controller::HTTP_OK);
        }

}


public function sessions_post()
  {
    
	  
	  $sessions =  $this->regModel->listaddsession();
	  if(!empty($sessions)) {
	        $data = array('msg' => "Data Fetch Succeessfully ",'code'=>200,'list_video_uploading_data'=>$sessions);
	  } else {
	      $data = array('msg' => "Data not Fetch Succeessfully",'code'=>404,'list_video_uploading_data'=>$sessions); 
	  }
      
      $this->response($data, REST_Controller::HTTP_OK);

}

public function listvideouploading_by_class_post()
  {
    
	  $fk_classId = $this->input->post('fk_classId');

	  if($fk_classId==""){
         $data['error'] = array('error' => "fk_classId Failed !",'code'=>404);
         $this->response($data, REST_Controller::HTTP_OK);
        }else{

	  
			  $listvideouploading =  $this->regModel->listvideouploading($fk_classId);
			  if(!empty($listvideouploading)) {
			        $data = array('msg' => "Data Fetch Succeessfully ",'code'=>200,'list_video_uploading_data'=>$listvideouploading);
			  } else {
			      $data = array('msg' => "Data not Fetch Succeessfully",'code'=>404,'list_video_uploading_data'=>$listvideouploading); 
			  }
		      
		      $this->response($data, REST_Controller::HTTP_OK);
		  }

}


public function get_day_sessions_post()
  {
    
	  $fk_classId = $this->input->post('fk_classId');
	  $dayId = $this->input->post('fk_dayId');
	  $monthId = $this->input->post('fk_monthId');
	  $studId = $this->input->post('studId');

	  if($fk_classId==""){
         $data['error'] = array('error' => "fk_classId Failed !",'code'=>404);
         $this->response($data, REST_Controller::HTTP_OK);
        }else if($dayId==""){
        $data['error'] = array('error' => "dayId Failed !",'code'=>404);
         $this->response($data, REST_Controller::HTTP_OK);	
        }else if($monthId==""){
        $data['error'] = array('error' => "monthId Failed !",'code'=>404);
         $this->response($data, REST_Controller::HTTP_OK);	
        }else if($studId==""){
        $data['error'] = array('error' => "studId Failed !",'code'=>404);
         $this->response($data, REST_Controller::HTTP_OK);	
        }else{
	  
		  $listvideouploading =  $this->regModel->get_day_sessions($dayId,$monthId,$fk_classId,$studId);
		  if(!empty($listvideouploading)) {
		        $data = array('msg' => "Data Fetch Succeessfully ",'code'=>200,'get_data_day_month_classid'=>$listvideouploading);
		  } else {
		      $data = array('msg' => "Data not Fetch Succeessfully",'code'=>404,'get_data_day_month_classid'=>$listvideouploading); 
		  }
	      
	      $this->response($data, REST_Controller::HTTP_OK);
	  }

}

   



}

?>