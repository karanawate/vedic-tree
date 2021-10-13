<?php

function getdata($data){
 
 		$CI =& get_instance();

 		$url = "https://pay.financepeer.co/uat/partner/pay/lead-create/";

 		$ch = curl_init();

	    //set opt
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	    // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

	    //exec
	    $output = curl_exec($ch);

	    //close
	    curl_close($ch);

	    echo $output;
	
}




?>