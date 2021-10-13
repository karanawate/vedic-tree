<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Valuebasededu extends REST_Controller 
{

public function index_post()
{
       
    
    $fk_classId = $this->input->post('fk_classId');
    if($fk_classId==""){
        $data = array('msg' => "fk_classId is required ",'res'=>$results,'code'=>404); 
    }else
    {
        $results = $this->regModel->list_of_valuebased_class($fk_classId);
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