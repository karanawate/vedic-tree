<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class State extends REST_Controller 
{


 public function index_post()
  {
      
   $res = $this->regModel->user_state();
    if($res){
       $data['error'] = array('error' => "State Fetched Successfully !",'States'=>$res);
     
     }else{
      $data['error'] = array('error' => "State Not Fetched Successfully !",'States'=>$res);
     
  } 
                      
            
  $this->response($data, REST_Controller::HTTP_OK);
          

}

   



}

?>