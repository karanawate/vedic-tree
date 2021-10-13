<?php

class Sendmail extends CI_Controller
{
	
	function __construct(argument)
	{
		# code...
	}



	public function index()
	{
		
		// PHPMailer object
        $mail = $this->phpmailer_lib->load();
        
        // SMTP configuration
        $mail->isSMTP();

        $mail->SMTPAutoTLS = false;
		$mail->SMTPAuth = true; 
	    $mail->Host = "mail.aspiresolutions.in"; 
	    $mail->Port = 587; 
	    $mail->Username = "info@aspiresolutions.in"; 
	    $mail->Password = "infoAD#1"; 

        $mail->setFrom('info@example.com', 'CodexWorld');
        $mail->addReplyTo('info@example.com', 'CodexWorld');
        
        // Add a recipient
        $mail->addAddress('john.doe@gmail.com');
        
        // Add cc or bcc 
        $mail->addCC('cc@example.com');
        $mail->addBCC('bcc@example.com');
        
        // Email subject
        $mail->Subject = 'Send Email via SMTP using PHPMailer in CodeIgniter';
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        // Email body content
        $mailContent = "<h1>Send HTML Email using SMTP in CodeIgniter</h1>
            <p>This is a test email sending using SMTP mail server with PHPMailer.</p>";
        $mail->Body = $mailContent;
        
        // Send email
        if(!$mail->send()){
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }else{
            echo 'Message has been sent';
        }

	}
}


?>