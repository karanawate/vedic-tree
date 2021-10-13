<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Readnotification extends REST_Controller 
{

public function index_post(){

      $read = $this->regModel->readNoticeMessage();
        if($read==1){
           $data['error'] = array('error' => "flag updated ",'read'=>$read);
         }else{
           $data['error'] = array('error' => "flag updated ",'read'=>$read);
        }
        
         $this->response($data, REST_Controller::HTTP_OK);
   }
}




?>