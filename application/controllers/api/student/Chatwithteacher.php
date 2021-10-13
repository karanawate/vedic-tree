<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Chatwithteacher extends REST_Controller 
{

    public function index_post()
    {
         $studId      = $this->input->post('studId');
         $fk_teachId  = $this->input->post('fk_teachId');
         $msg         = $this->input->post('msg');
         $planId      = $this->input->post('planId');
         date_default_timezone_set('Asia/Kolkata');
         $currentDate   = date('Y-m-d h:i:s');
         $res = $this->chatModel->start_chat($fk_teachId,$studId,$planId,$msg,$currentDate);
        if(!empty($res)){
            foreach ($res as $key => $value) {
             $dataArray = $value;
            }
    
           $data = array('msg' => "Message Sent Successfully",'res'=>json_encode($dataArray),'code'=>200);
        }else{
           $data = array('msg' => "No Message Sent or either student is not allocate to teacher",'res'=>json_encode($dataArray),'code'=>404); 
        }
                    
		 $this->response($data, REST_Controller::HTTP_OK);
    }
    
    
    public function checkstudentallocatedteacher_post()
    {
        
    
        $studId      = $this->input->post('studId');
        $res = $this->chatModel->checkstudentallocatedteacher($studId);
        if(!empty($res)){
            
           $data = array('msg' => "Data found",'res'=>$res,'code'=>200);
        }else{
           $data = array('msg' => "No data found",'res'=>$res,'code'=>404); 
        }
                    
		 $this->response($data, REST_Controller::HTTP_OK);

    }
    
    


}







?>