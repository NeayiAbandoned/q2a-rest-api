<?php

	//
	//	Question2Answer API
	//	Author : Arun Anson
	//	Copyright (c) 2017 Hello Infinity Business Solutions Pvt. Ltd.
	//	21th June 2017
	// 	WRITE ANSWER API
	// 	Write an answer to a question for the loggedin user and returns the post id. if a user is not logged in, returns an error.

	// 	Sample Input
	// { "requestHeader": { "serviceId":"111", "interactionCode":"WRITEANSWER"}, "requestBody" : { "content" : "test content", "parentpostid" : "1" }}

	// 	Sample Output
	// 	{"responseHeader":{"serviceId":"111","status":"200","message":"Question Added"},"responseBody":{"userid":17,"postid":19}}
	
	function write_answer($json_request){

		require_once Q2ALOCATION.'/qa-include/qa-base.php';
		require_once Q2ALOCATION.'/qa-include/app/posts.php';

		$serviceId	= $json_request['requestHeader']['serviceId'];

		$type = 'A';
		$categoryid = null;
		$format = '';
		$title = '';
		$tags = '';
		$userid = qa_get_logged_in_userid();
		
		$parentpostid = $json_request['requestBody']['parentpostid'];
		$content = $json_request['requestBody']['content'];

		if ($userid != null) {

			$post_id = qa_post_create($type, $parentpostid, $title, $content, $format, $categoryid, $tags, $userid);
			//success
			$res['responseHeader']['serviceId'] = $serviceId;
			$res['responseHeader']['status'] = "200"; 
			$res['responseHeader']['message'] = "Answer added";
			$res['responseBody']['userid'] = $userid;	
			$res['responseBody']['postid'] = $post_id;
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