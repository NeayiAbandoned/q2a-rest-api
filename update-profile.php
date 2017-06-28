<?php

	//
	//	Question2Answer API
	//	Author : Arun Anson
	//	Copyright (c) 2017 Hello Infinity Business Solutions Pvt. Ltd.
	//	16th June 2017
	//	Profile Update API
	//

	//	Sample Input
	// { "requestHeader": { "serviceId":"111", "interactionCode":"UPDATEPROFILE" }, "requestBody" : { "user_id" : "1", "email_id" : "anoop@helloinfinity.com", "location" : "alappuzha", "full_name" : "Arun Anson", "avatar" : "akm1kskdjbgasane"} }

	//	Sample Output
	//	{"responseHeader":{"serviceId":"111","status":"200","username":"14","message":"User Logged in"}}
	
	function updateprofile($json_request){

		require_once Q2ALOCATION.'/qa-include/qa-base.php';
		require_once Q2ALOCATION.'/qa-include/app/users-edit.php';

		require_once Q2ALOCATION.'/qa-include/db/metas.php';
		require_once Q2ALOCATION.'/qa-include/db/users.php';
		
		$serviceId	= $json_request['requestHeader']['serviceId'];
		$base64data = $json_request['requestBody']['avatar'];
		$user_id = $json_request['requestBody']['user_id'];
		$email_id = $json_request['requestBody']['email_id'];
		$location = $json_request['requestBody']['location'];
		$full_name = $json_request['requestBody']['full_name'];

		if ($user_id != '') {
			
			//If the given userid is a valid one

			//Create user avatar
			list($type, $base64data) = explode(';', $base64data);
			list(, $base64data)      = explode(',', $base64data);
			$base64data = base64_decode($base64data);
			file_put_contents('./avatar/'.$user_id.'.png', $base64data);
			$image_url = APILIVEURL.'avatar/'.$user_id.'.png';

			//create and update email, avatarurl as a meta value if not pressent. else update it
			qa_db_usermeta_set($user_id, 'email', $email_id);
			qa_db_usermeta_set($user_id, 'avatar', $image_url);

			//update user's location
			qa_db_user_profile_set($user_id, 'location', $location);
			//update user's name field
			qa_db_user_profile_set($user_id, 'name', $full_name);

			//success
			$message = "Updated!";
			$res['responseHeader']['status'] = "200";

		}else{

			//error
			$message = "Unauthorized!";
			$res['responseHeader']['status'] = "401";
		}

		$res['responseHeader']['serviceId'] = $serviceId;
		$res['responseHeader']['message'] = $message;

		$json_response = json_encode($res, JSON_UNESCAPED_SLASHES);
		echo $json_response;

	}
?>