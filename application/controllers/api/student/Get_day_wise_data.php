<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Get_day_wise_data extends REST_Controller 
{


 public function index_post(){
		
		$studId     = $this->input->post('studId');
		$monthId    = $this->input->post('monthId');
		$dayId      = $this->input->post('dayId');
		$fk_classId = $this->input->post('fk_classId');
		
		if($studId==""){
		    $data = array('msg' => "studId is required",'code'=>404);
		}else if($monthId==""){
		    $data = array('msg' => "monthId is required",'code'=>404);
		}else if($dayId==""){
		    $data = array('msg' => "dayId is required",'code'=>404);
		}else if($fk_classId==""){
		    $data = array('msg' => "fk_classId is required ",'code'=>404);
		}else{
		    
            $res    = $this->regModel->get_day_sessions($dayId,$monthId,$fk_classId,$studId);
            if (!empty($res)) {
                  $data = array('msg' => "Data fetch successfully",'res'=>$res,'code'=>200); 
            }else{
                   $data = array('msg' => "Data do not fetch successfully",'res'=>$res,'code'=>404); 
            }
		}

        $this->response($data, REST_Controller::HTTP_OK);
	}







}

?>