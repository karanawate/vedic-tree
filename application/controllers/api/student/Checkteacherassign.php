<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Checkteacherassign extends REST_Controller 
{

public function index_post()
{
       
    
    $studId = $this->input->post('studId');
    if($studId==""){
        $data = array('msg' => "studId is required ",'res'=>$results,'code'=>404); 
    }else
    {
        $results = $this->chatModel->Checkteacherassign($studId);
        if($results){
           $data = array('msg' => "data found assigned Student ",'res'=>$results,'code'=>200);
            }else{
           $data = array('msg' => "No data found ",'res'=>$results,'code'=>404); 
        }
                    
		 $this->response($data, REST_Controller::HTTP_OK);
    }
 }



function get_teacher_details_post(){
    

    $studentClass = $this->input->post('fk_classId');
    if($studentClass=="")
    {
        $data = array('msg' => "fk_classId is required ",'code'=>404); 
    }
    else
    {
        
     $res = tbl_teacher_data($studentClass);    
     if($res){
           $data = array('msg' => " data found ",'res'=>$res,'code'=>200);
        }else{
           $data = array('msg' => "No data found ",'res'=>$res,'code'=>404); 
        }
    }
     $this->response($data, REST_Controller::HTTP_OK);

 }

}







?>