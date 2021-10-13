<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  require_once(APPPATH.'libraries/lib/config_paytm.php');
  require_once(APPPATH.'libraries/lib/encdec_paytm.php');

class Payment extends CI_Controller
{
	


	public function index()
	{
		
    if(isset($_POST['submit'])){

      $checkSum = "";
      $data = array();

      $ORDER_ID = $_POST["ORDER_ID"];
      $CUST_ID = $_POST["CUST_ID"];
      $INDUSTRY_TYPE_ID = $_POST["INDUSTRY_TYPE_ID"];
      $CHANNEL_ID = $_POST["CHANNEL_ID"];
      $TXN_AMOUNT = $_POST["TXN_AMOUNT"];

      $data['data']["MID"] = PAYTM_MERCHANT_MID;
      $data['data']["ORDER_ID"] = $ORDER_ID;
      $data['data']["CUST_ID"] = $CUST_ID;
      $data['data']["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
      $data['data']["CHANNEL_ID"] = $CHANNEL_ID;
      $data['data']["TXN_AMOUNT"] = $TXN_AMOUNT;
      $data['data']["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
      $data['data']["CALLBACK_URL"] = base_url('payment/response');

      $data['data']['checkSum'] = getChecksumFromArray($data['data'],PAYTM_MERCHANT_KEY);


       $this->load->view('payment1',$data);


    }else{

	    $usersession = $this->session->userdata('usersession');
      if($this->session->userdata('usersession'))
      {
		    $this->load->view('payment');
      } else {
      	redirect('welcome');
      }
    }

	}


public function response(){

 $data['data']["CALLBACK_URL"] = base_url('payment/response');
$this->load->view('payment2',$data['data']);
}

	




















































































}

?>