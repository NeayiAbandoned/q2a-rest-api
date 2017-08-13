<?php

	//
	//	Question2Answer API
	//	Author : Arun Anson
	//	Copyright (c) 2017 Hello Infinity Business Solutions Pvt. Ltd.
	//	21th June 2017
	// 	CREATE QUESTION API
	// 	Creates a question for then loggedin user and returns the post id. if a user is not logged in, returns an error.

	// 	Sample Input
	// { "requestHeader": { "serviceId":"111", "interactionCode":"CREATEQUESTION"}, "requestBody" : { "userid" : "2", "title" : "One test", "content" : "test content", "categoryid" : "1", "tags" : "tag1, tag2" }}

	// 	Sample Output
	// 	{"responseHeader":{"serviceId":"111","status":"200","message":"Question Added"},"responseBody":{"userid":"16","postid":15}}
	
	function create_question($json_request){

		require_once Q2ALOCATION.'/qa-include/qa-base.php';
		require_once Q2ALOCATION.'/qa-include/app/posts.php';

		$serviceId	= $json_request['requestHeader']['serviceId'];

		$type = 'Q';
		$parentpostid = null;
		$format = '';

		$userid = $json_request['requestBody']['userid'];
		$title = $json_request['requestBody']['title'];
		$content = $json_request['requestBody']['content'];
		$categoryid = $json_request['requestBody']['categoryid'];;
		$tags = $json_request['requestBody']['tags'];

		if ($userid != null) {

			$post_id = qa_post_create($type, $parentpostid, $title, $content, $format, $categoryid, $tags, $userid);
			//success
			$res['responseHeader']['serviceId'] = $serviceId;
			$res['responseHeader']['status'] = "200"; 
			$res['responseHeader']['message'] = "Question Added";
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