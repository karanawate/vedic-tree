<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Readnotificationchat extends REST_Controller 
{

public function index_post(){


    $studId  = $this->input->post('studId');
    $readMsg  = "1";
    if($studId==""){
        $data = array('msg' => "studId required ",'code'=>404);
    }else if($readMsg==""){
        $data = array('msg' => "readMsg required ",'code'=>404);
    }else{
        
        $read = $this->regModel->readMessage($studId,$readMsg);
        if($read==1){
           $data['error'] = array('error' => "flag updated read ",'read'=>$read);
         }else{
           $data['error'] = array('error' => "flag updated read",'read'=>$read);
        }
    }
             
         $this->response($data, REST_Controller::HTTP_OK);
}




}

?>