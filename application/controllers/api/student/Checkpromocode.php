<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Checkpromocode extends REST_Controller 
{

    public function index_post()
    {
         $promoCode = $this->input->post('promoCode');
        $res = $this->regModel->checkpromocode($promoCode);
        
        if($res==0){
            $data = array('msg' => "Promo Code Does Not Exist !",'res'=>$res,'code'=>404);
         }else if($res==2){
            $data = array('msg' => "Promo Code Expired !",'res'=>$res,'code'=>404);
         }else{
           $data = array('msg' => "promo code exist",'res'=>$res,'code'=>200);
        }
                    
		 $this->response($data, REST_Controller::HTTP_OK);
    }

}




?>