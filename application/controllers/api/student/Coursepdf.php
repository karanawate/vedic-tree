<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Coursepdf extends REST_Controller 
{


 public function index_post()
  {
    
	  $fk_classId = $this->input->post('fk_classId');
	  $fk_planid = $this->input->post('fk_planid');
	  if($fk_classId=="" || $fk_planid==""){
         $data['error'] = array('error' => "fk_classId or fk_planid required ",'code'=>404);
         $this->response($data, REST_Controller::HTTP_OK);

        }else{
            
        	 $get_tbl_pdfcourse_list = $this->regModel->get_tbl_pdfcourse_list($fk_classId,$fk_planid);
        	  if(!empty($get_tbl_pdfcourse_list)) {
        	        $data = array('msg' => "Data Fetch Succeessfully ",'code'=>200,'get_tbl_pdfcourse_list'=>$get_tbl_pdfcourse_list);
        	  } else {
        	      $data = array('msg' => "Data not Fetch Succeessfully",'code'=>404,'get_tbl_pdfcourse_list'=>$get_tbl_pdfcourse_list); 
        	  }
              
              $this->response($data, REST_Controller::HTTP_OK);
        }

}





}
?>