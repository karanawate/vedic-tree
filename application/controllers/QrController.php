<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class QrController extends CI_Controller {

	function __construct ()
	{	
		parent::__construct();
		$this->load->library('phpqrcode/qrlib');
	}

	public function index()
	{
		if(isset($_POST['submit']))
    	{

	          $this->form_validation->set_error_delimiters('<span>', '</span>');
	          $this->form_validation->set_rules('qrcodeNumber', 'qrcode text', 'trim|required');
	          $this->form_validation->set_rules('qrcodeStartTime', 'qrcode text', 'trim|required');
	          $this->form_validation->set_rules('qrcodeEndTime', 'qrcode text', 'trim|required');
	          if ($this->form_validation->run() == FALSE)
	          {     
	              $data['qrcodelist'] = $this->regModel->qrcodelist(); 
	              $this->load->view('qrcodetext',$data);
	          }
	          else
	          {

	          	$qrcodeNumber 		= $this->input->post('qrcodeNumber');
	          	$qrcodeStartTime 	= $this->input->post('qrcodeStartTime');
	          	$qrcodeEndTime 		= $this->input->post('qrcodeEndTime');
	          	$qrcode_data 		= array(
	          								'qrcodeNumber'	    => $qrcodeNumber,
	          						  		'qrcodeStartTime'   => $qrcodeStartTime,
	          						  		'qrcodeEndTime'     => $qrcodeEndTime,
	          						  		'qrcodeCountUse' 	=> "0"
	          						  		);

	          	$qrcodeNumberExist = $this->regModel->qrcodeNumberExist($qrcodeNumber);
	          	if($qrcodeNumberExist==1){
	          			$data['error'] 		= array('error' => "QR Code Already Exist !");
	                    $data['qrcodelist'] = $this->regModel->qrcodelist();
	                    $this->load->view('qrcodetext',$data);
	          	}else{
		          	$res = $this->regModel->qrcode_data($qrcode_data);
		          	if(!empty($res)){
	                  $data['error'] 	  = array('error' => "QR Code Generated Successfully !");
	                  $data['qrcodelist'] = $this->regModel->qrcodelist();
	                  $this->load->view('qrcodetext',$data);

	                }else{
	                	
	                    $data['error']      = array('error' => "QR Code not Generated Successfully !");
	                    $data['qrcodelist'] = $this->regModel->qrcodelist();
	                    $this->load->view('qrcodetext',$data);
	                }
	            }

	          	
	          }

         } else {
         	$data['qrcodelist'] = $this->regModel->qrcodelist();
			$this->load->view('qrcodetext',$data);
         }	
	}

	public function qrcodeGenerator ( )
	{
		
		
		$qrtext = $this->input->post('qrcode_text');
		
		if(isset($qrtext))
		{

			//file path for store images
		    $SERVERFILEPATH = $_SERVER['DOCUMENT_ROOT'].'/studentadmin/assets/qrcode/';
		   
			$text = $qrtext;
			$text1= substr($text, 0,9);
			
			$folder = $SERVERFILEPATH;
			$file_name1 = $text1."-Qrcode" . rand(2,200) . ".png";
			$file_name = $folder.$file_name1;


			QRcode::png($text,$file_name);
			
			echo"<center><img src=".base_url().'assets/qrcode/'.$file_name1."></center";
		}
		else
		{
			echo 'No Text Entered';
		}	
	}

public function deleteqrId()
{
	
	 $usersession = $this->session->userdata('usersession');
     
        if(isset($_POST['submit']))
        {

              $this->form_validation->set_error_delimiters('<span>', '</span>');
              $this->form_validation->set_rules('qrId', 'qrId', "trim|required|numeric|greater_than[0]");
              if ($this->form_validation->run() == FALSE)
              {     
                   $data['getstudlist'] = $this->regModel->getstudlist(); 
                   $this->load->view('getstudlist',$data);
              }
              else
              {
                $qrId     = $this->input->post('qrId');
                $result   = $this->regModel->deleteqrId($qrId);
                 if($result==1){
                    $data['error'] 		= array('error' => "Qrcode  Id Deleted Successfully !");
                    $data['qrcodelist'] = $this->regModel->qrcodelist();
					$this->load->view('qrcodetext',$data);
                 }else{
                    $data['error'] 		= array('error' => "Qrcode  Id Not Deleted Successfully !");
                    $data['qrcodelist'] = $this->regModel->qrcodelist();
					$this->load->view('qrcodetext',$data);
                 }
              }         

        }else{  
                  $data['qrcodelist'] = $this->regModel->qrcodelist();
				  $this->load->view('qrcodetext',$data);
        }

}









}
?>