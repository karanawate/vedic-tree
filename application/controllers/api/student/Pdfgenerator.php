<?php
defined('BASEPATH') OR exit('No direct script access allowed');


require(APPPATH.'/libraries/REST_Controller.php');

class Pdfgenerator extends REST_Controller
{
	
	public function index_post()
	{
	    

    $studId = $this->input->post('studId');
    $logId = $this->input->post('logId');
    $payment_url = "";
    
    
    if($studId==""){
        $data = array('msg' => "studId required ",'code'=>404);
     }else if($logId==""){
        $data = array('msg' => "logId required ",'code'=>404);
     }else{
        
            $check_student_exist = $this->regModel->check_student_exist($studId);
            
            if($check_student_exist) {
                $payment_url = base_url("website/showpdfapp/".$studId.'/'.$logId);
                  $data = array('msg' => "Data Fetch Succeessfully ",'code'=>200,'payment_url'=> $payment_url );
            } else {
                $data = array('msg' => "Data not Fetch Succeessfully",'code'=>404,'payment_url'=> $payment_url ); 
            }
    
      }
     $this->response($data, REST_Controller::HTTP_OK);

	}
	

}

?>