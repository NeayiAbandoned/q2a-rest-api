<?php

	//
	//	Question2Answer API
	//	Author : Arun Anson
	//	Copyright (c) 2017 Hello Infinity Business Solutions Pvt. Ltd.
	//	15th June 2017
	//	User Registration & Login API
	//

	//	Sample Input
	// { "requestHeader": { "serviceId":"111", "interactionCode":"LOGIN" }, "requestBody" : { "email" : "anoop@helloinfinity.com", "identifier" : "akm1kskdjbgasane", "username" : "anoopanson", "source" : "facebook" } }

	//	Sample Output
	//	{"responseHeader":{"serviceId":"111","status":"200","message":"User Logged in"},"responseBody":{"username":"anoopanson","userid":"4"}}

	function login($json_request){

		require_once Q2ALOCATION.'/qa-include/qa-base.php';
		require_once Q2ALOCATION.'/qa-include/app/users.php';

		$serviceId	= $json_request['requestHeader']['serviceId'];
		
		$source = $json_request['requestBody']['source'];
		$identifier = $json_request['requestBody']['identifier'];
		$fields['email'] = $json_request['requestBody']['email'];
		$fields['confirmed'] = true;
		$fields['handle'] = $json_request['requestBody']['username'];
		
		qa_log_in_external_user($source, $identifier, $fields);

		$logged_in_user = qa_get_logged_in_handle();
		$logged_in_user_id = qa_get_logged_in_userid();

		if ($logged_in_user != null) {

			//success
			$res['responseHeader']['serviceId'] = $serviceId;
			$res['responseHeader']['status'] = "200"; 
			$res['responseHeader']['message'] = "User Logged in";
			$res['responseBody']['username'] = $logged_in_user;
			$res['responseBody']['userid'] = $logged_in_user_id;
		}else{

			//error
			$res['responseHeader']['serviceId'] = $serviceId;
			$res['responseHeader']['status'] = "401"; 
			$res['responseHeader']['message'] = "Unauthorized";
		}

		$json_response = json_encode($res, JSON_UNESCAPED_SLASHES);
		echo $json_response;
		
	}
?>