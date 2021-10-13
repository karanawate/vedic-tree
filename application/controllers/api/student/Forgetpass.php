<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Forgetpass extends REST_Controller 
{


public function index_post(){
        
  $studentMobile = $this->input->post('studentMobile');
  if($studentMobile==""){

      $data = array('msg' => "studentMobile is required",'code'=>404);

    }else{

        $res    = $this->regModel->checkmobile($studentMobile);
        if ($res==1) {
              $data = array('msg' => "Otp Sent on your number !",'res'=>$res,'code'=>200); 
        }else{
               $data = array('msg' => "Mobile number is not exist !",'res'=>$res,'code'=>400); 
        }
    }

        $this->response($data, REST_Controller::HTTP_OK);
  }


 public function updatepass_post(){
    $otp            = $this->input->post('otp');
    $newpass        = $this->input->post('newpass');
    $studentMobile  = $this->input->post('studentMobile');
    if($otp==""){
      $data = array('msg' => "otp is required",'code'=>404);
    }else if($newpass==""){
      $data = array('msg' => "newpass is required",'code'=>404);
    }else if($studentMobile==""){
      $data = array('msg' => "studentMobile is required",'code'=>404);
    }else{
        
            $res        = $this->regModel->updatepass($otp,$newpass,$studentMobile);
            if ($res==1) {
                  $data = array('msg' => "Password updated Successfully !",'res'=>$res,'code'=>200); 
            } else {
                  $data = array('msg' => "Password Is not updated !",'res'=>$res,'code'=>400); 
            }
          }
            
      $this->response($data, REST_Controller::HTTP_OK);
  }
	
public function updatemobpass_post(){
    
   $newpass = sha1($this->input->post('newpass'));
   $studId  = $this->input->post('studId');

   if($newpass==""){
      $data = array('msg' => "newpass is required",'code'=>404);
    }else if($studId==""){
      $data = array('msg' => "studId is required",'code'=>404);
    }else{


            $res        = $this->regModel->updatemobpass($newpass,$studId);

            if ($res==1) {
              
                  $data = array('msg' => "Password updated Successfully !",'res'=>$res,'code'=>200); 
                    
            } else {

                   $data = array('msg' => "Password Is not updated !",'res'=>$res,'code'=>400); 
                    
            }
        }
            
             $this->response($data, REST_Controller::HTTP_OK);
  }
  



 

   



}

?>