<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Autologout extends REST_Controller 
{

    public function index_post()
    {
        
        $studId = $this->input->post('studId');
        $logstatus = 2 ;
        $res = $this->regModel->autologout($logstatus,$studId);
        if($res==1){

           $data = array('msg' => "Logout web Successfully",'res'=>$res,'code'=>200,'flag'=>1);
        }else{
           $data = array('msg' => "No Logout from web ",'res'=>$res,'code'=>404,'flag'=>2); 
        }
        
        
         $this->response($data, REST_Controller::HTTP_OK);
        
    }
    
    
}