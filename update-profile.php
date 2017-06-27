<?php

	//
	//	Question2Answer API
	//	Author : Arun Anson
	//	Copyright (c) 2017 Hello Infinity Business Solutions Pvt. Ltd.
	//	16th June 2017
	//	Profile Update API
	//

	//	Sample Input
	// { "requestHeader": { "serviceId":"111", "interactionCode":"UPDATEPROFILE" }, "requestBody" : { "email" : "anoop@helloinfinity.com", "image" : "akm1kskdjbgasane"} }

	//	Sample Output
	//	{"responseHeader":{"serviceId":"111","status":"200","username":"14","message":"User Logged in"}}
	
	function updateprofile($json_request){

	require_once Q2ALOCATION.'/qa-include/qa-base.php';
	require_once Q2ALOCATION.'/qa-include/app/users-edit.php';
	
	$serviceId	= $json_request['requestHeader']['serviceId'];
	$image_data = $json_request['requestBody']['image'];
	//echo $image_data;
	$t = qa_set_user_avatar(1, $image_data);
	echo $t;
	}
?>