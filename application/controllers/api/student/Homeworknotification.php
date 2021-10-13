<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Homeworknotification extends REST_Controller 
{

public function index_post(){


    $studId     = $this->input->post('fk_studentId');
    $startDate  = $this->input->post('start_time');
    $readMsg  = "2";
    if($studId==""){
        $data = array('msg' => "studId required ",'code'=>404);
    }else if($startDate==""){
        $data = array('msg' => "Start date is required ",'code'=>404);
    }elseif($readMsg==""){
         $data = array('msg' => "Read msg is required ",'code'=>404);
    }else{
        $read = $this->regModel->readMessage_homework($studId,$readMsg,$startDate);
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