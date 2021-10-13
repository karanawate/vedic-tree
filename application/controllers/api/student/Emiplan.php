<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Emiplan extends REST_Controller 
{


public function index_post()
{
 
   $res = $this->regModel->getemi();
   if(!empty($res)){
      $data = array('msg' => "fetch data Successfully ",'code'=>200,'emiplan'=>$res);
   }else{
      $data = array('msg' => "Data do not fetched ",'code'=>400,'emiplan'=>$res);
   } 
  $this->response($data, REST_Controller::HTTP_OK);

}

   



}

?>
