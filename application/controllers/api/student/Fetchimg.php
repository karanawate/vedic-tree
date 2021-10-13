<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Fetchimg extends REST_Controller 
{


 public function index_post()
  {
      
      
      $img_name = $this->input->post('img_name');
      $imgpath = "https://vedictreeschool.com/uploads/studetprofile/".$img_name;
      
      $data['error'] = array('error' => "image fetch successfully",'data'=>$imgpath);
      
      $this->response($data, REST_Controller::HTTP_OK);
      
      
      
  }
  
}