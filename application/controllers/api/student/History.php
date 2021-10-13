<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class History extends REST_Controller 
{


 public function index_post()
  {
    
      $fk_studId = $this->input->post('fk_studId');      
     	
     	if($fk_studId==""){

     		$data = array('msg' => "Student Id required",'code'=>202);

     	}else{

		       $get_payment_history_with_all_details =  $this->regModel->get_payment_history_with_all_details($fk_studId);
		       if(!empty($get_payment_history_with_all_details)) {
		             $data = array('msg' => "Payment Succeessfully ",'code'=>200,'student_history'=>$get_payment_history_with_all_details);
		       } else {
		           $data = array('msg' => "Payment Already Paid",'code'=>200,'student_history'=>$get_payment_history_with_all_details); 
		       }
     	}
      
      $this->response($data, REST_Controller::HTTP_OK);

}

   



}

?>