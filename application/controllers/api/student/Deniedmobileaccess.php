<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Deniedmobileaccess extends REST_Controller 
{


 public function index_post()
  {
      
      
      $studentMobile = $this->input->post('studentMobile');
      $res = $this->apimodel->deniedmobileaccess($studentMobile);
      if($res==2){
        $data['error'] = array('error' => "Login  successfully",'data'=>$res);
      }else if($res==1){
        $data['error'] = array('error' => "Already Login in another device",'data'=>$res);  
      }else{
        $data['error'] = array('error' => "Access Denied",'data'=>$res);
      }
      
      $this->response($data, REST_Controller::HTTP_OK);
      
      
      
  }
  
  
   public function change_mobile_status_post()
  {
      
      
      $studentMobile = $this->input->post('studentMobile');
      $res = $this->apimodel->change_mobile_status($studentMobile);
      if($res==1){
        $data['error'] = array('error' => "Logout successfully",'data'=>$res);
      }else{
        $data['error'] = array('error' => "Access Denied",'data'=>$res);
      }
      
      $this->response($data, REST_Controller::HTTP_OK);
      
      
      
  }
  
  
  
}