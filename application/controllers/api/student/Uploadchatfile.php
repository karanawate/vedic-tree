<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Uploadchatfile extends REST_Controller 
{


 public function index_post()
  {
    
      $planId = $this->input->post('planId');
      if($planId==""){
           $data = array('msg' => "plan id required ",'res'=>array(),'code'=>400);
      }else{
	  $chatimgup   = $_FILES['chatimgup']['name'];
      $fk_teachId  = $this->input->post('fk_teachId');
         
        if(!empty($chatimgup)){

         $studId                  = $this->input->post('fk_studId');
         $msg                     = "";
         $fk_teachId              = $this->input->post('fk_teachId');
         $config['upload_path']   = './uploads/chatimgup/';
         $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
         $config['max_size']      = 2084;

         $this->load->library('upload', $config);
         $this->upload->initialize($config);

         if ( ! $this->upload->do_upload('chatimgup'))
          {
              $data['error'] = $this->upload->display_errors();
              
              $data = array('msg' => "Data found",'res'=>json_encode($data),'code'=>200);
          }
          else
          {
                  $data = array('chatimgup' => $this->upload->data());  
                  $chatimgup = $data['chatimgup']['file_name'];
          }

          date_default_timezone_set('Asia/Kolkata');
          $currentDate   = date('Y-m-d h:i:s');
          $res = $this->chatModel->start_chat_with_img($fk_teachId,$studId,$msg,$planId,$currentDate,$chatimgup);
          $dataArray = array();    
          foreach ($res as $key => $value) {
                   $dataArray = $value;
          }
          
        
          
          
         $data = array('msg' => "Data found",'res'=>json_encode($dataArray),'code'=>200);
          
        
            
        }else{
            $data = array('msg' => "Data found",'res'=>$res,'code'=>200);
        }
      }
    
    $this->response($data, REST_Controller::HTTP_OK);

}





}
?>