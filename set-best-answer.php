<?php

	//
	//	Question2Answer API
	//	Author : Arun Anson
	//	Copyright (c) 2017 Hello Infinity Business Solutions Pvt. Ltd.
	//	17th July 2017
	//	SET BEST ANSWER API
	//	Set best answer amoung the existing answers

	//	Sample Input
	//	{ "requestHeader": { "serviceId":"111", "interactionCode":"SETBESTANSWER"}, "requestBody" : { "questionid" : "1", "answerid" : "2", "userid" : "1" }}

	//	Sample Output
	//	{"responseHeader":{"serviceId":"111","status":"200","message":"Success"}}
	
	function set_best_answer($json_request){

		include 'connection.php';
		require_once Q2ALOCATION.'/qa-include/qa-base.php';
		require_once Q2ALOCATION.'/qa-include/app/posts.php';

		$serviceId	= $json_request['requestHeader']['serviceId'];
		$questionid	= $json_request['requestBody']['questionid'];
		$answerid	= $json_request['requestBody']['answerid'];
		$userid	= $json_request['requestBody']['userid'];

		if ($questionid == '' || $questionid == 'null' || $answerid == '' ||  $answerid == 'null' || $userid == '' || $userid == 'null' ) {
			
			$message = "Error";
			$status	= "401";
		}else{

			qa_post_set_selchildid($questionid, $answerid, $userid);
			$message = "Success";
			$status = "200";
		}

		$res['responseHeader']['serviceId'] = $serviceId;
		$res['responseHeader']['status'] = $status;
		$res['responseHeader']['message'] = $message;

	    $json_response = json_encode($res, JSON_UNESCAPED_SLASHES);
		echo $json_response;

	}
?>