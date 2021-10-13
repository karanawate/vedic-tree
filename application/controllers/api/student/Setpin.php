<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Setpin extends REST_Controller 
{


public function index_post(){
        
  $pinNumber  = $this->input->post('pinNumber');
  $studId     = $this->input->post('studId');
  if($pinNumber==""){

      $data = array('msg' => "pinNumber is required",'code'=>404);
      

    }else if($studId==""){
      $data = array('msg' => "studId is required",'code'=>404);  
    }else{

        $res    = $this->regModel->setpin($studId,$pinNumber);
        if ($res==1) {
              $data = array('msg' => "Pin Number is set succesfully ",'res'=>$res,'code'=>200); 
        }else{
               $data = array('msg' => "student id is not exist !",'res'=>$res,'code'=>400); 
        }
    }

        $this->response($data, REST_Controller::HTTP_OK);
  }





 

   



}

?>