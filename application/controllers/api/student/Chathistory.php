<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Chathistory extends REST_Controller 
{

public function index_post()
{
       
    
    $studId = $this->input->post('studId');
    if($studId==""){
        $data = array('msg' => "studId is required ",'res'=>$results,'code'=>404); 
    }else
    {
        $results = $this->chatModel->chathistory($studId);
        if($results){
           $data = array('msg' => "History data found ",'res'=>$results,'code'=>200);
            }else{
           $data = array('msg' => "No History found ",'res'=>$results,'code'=>404); 
        }
                    
		 $this->response($data, REST_Controller::HTTP_OK);
    }
 }
    
    
    
    
    


}







?>