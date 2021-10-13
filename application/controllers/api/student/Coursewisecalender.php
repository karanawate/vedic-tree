<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Coursewisecalender extends REST_Controller 
{

    public function index_post()
    {
        
        $res = $this->regModel->get_coursewise_calender();
        if(!empty($res)){
    
           $data = array('msg' => "Data fetch Successfully",'res'=>$res,'code'=>200);
        }else{
           $data = array('msg' => "No data fetch",'res'=>$res,'code'=>404); 
        }
        
        
         $this->response($data, REST_Controller::HTTP_OK);
        
    }
    
    
}