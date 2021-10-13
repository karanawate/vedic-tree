<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Payment extends REST_Controller 
{


 public function index_post()
  {
      


       
      $usr_firstname             = $this->input->post('usr_firstname');      
      $usr_lastname              = $this->input->post('usr_lastname');
      $usr_email                 = $this->input->post('usr_email');
      $usr_mobile_no             = $this->input->post('usr_mobile_no');
      $payAmount                 = $this->input->post('payAmount');
      $fk_studId                 = $this->input->post('fk_studId');
      $razorpay_order_id         = $this->input->post('razorpay_order_id');
      $razorpay_payment_id       = $this->input->post('razorpay_payment_id');
      $razorpay_signature        = $this->input->post('razorpay_signature');
      $planId                    = $this->input->post('planId');
      $paymentType               = $this->input->post('paymentType');
      $paystatus                 = $this->input->post('paystatus');
      $paystatusId               = $this->input->post('paystatusId');
      $createDT                  = date("y-m-d h:i:s");
      
      if($usr_firstname==""){
        $data = array('msg' => "usr_firstname required ",'code'=>404);
      }else if($usr_lastname==""){
        $data = array('msg' => "usr_lastname required ",'code'=>404);
      }else if($usr_email=="" || $usr_email==null ){
        $data = array('msg' => "usr_email required ",'code'=>404);
      }else if($usr_mobile_no==""){
        $data = array('msg' => "usr_mobile_no required ",'code'=>404);
      }else if($payAmount==""){
        $data = array('msg' => "payAmount required ",'code'=>404);
      }else if($fk_studId==""){
        $data = array('msg' => "fk_studId required ",'code'=>404);
      }else if($razorpay_order_id==""){
        $data = array('msg' => "razorpay_order_id required ",'code'=>404);
      }else if($razorpay_payment_id==""){
        $data = array('msg' => "razorpay_payment_id required ",'code'=>404);
      }else if($razorpay_signature==""){
        $data = array('msg' => "razorpay_signature required ",'code'=>404);
      }else if($planId==""){
        $data = array('msg' => "planId required ",'code'=>404);
      }else if($paymentType==""){
        $data = array('msg' => "paymentType required ",'code'=>404);
      }else if($paystatus==""){
        $data = array('msg' => "paystatus required ",'code'=>404);
      }else if($paystatusId==""){
        $data = array('msg' => "paystatusId required ",'code'=>404);
      }else{

            $paymentData = array(    
                              
                              'usr_firstname'       => $usr_firstname ,      
                              'usr_lastname'        => $usr_lastname ,
                              'usr_email'           => $usr_email ,
                              'usr_mobile_no'       => $usr_mobile_no ,
                              'payAmount'           => $payAmount ,
                              'fk_studId'           => $fk_studId ,
                              'razorpay_order_id'   => $razorpay_order_id ,
                              'razorpay_payment_id' => $razorpay_payment_id ,
                              'razorpay_signature'  => $razorpay_signature ,
                              'planId'              => $planId ,
                              'paymentType'         => $paymentType ,
                              'paystatus'           => $paystatus ,
                              'paystatusId'         => $paystatusId ,
                              'fk_monthId'          => 10,
                              'createDT'            => date("y-m-d h:i:s")
                          );

             $check_razorpay_payment_id_exist =  $this->regModel->check_razorpay_payment_id_exist($paymentData);
             if($check_razorpay_payment_id_exist == 0) {
                   $data = array('msg' => "Payment Succeessfully ",'code'=>200);
             } else {
                 $data = array('msg' => "Payment Already Paid",'code'=>200); 
             }
      }
      
      $this->response($data, REST_Controller::HTTP_OK);

}

   



}

?>