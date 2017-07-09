<?php

	//
	//	Question2Answer API
	//	Author : Arun Anson
	//	Copyright (c) 2017 Hello Infinity Business Solutions Pvt. Ltd.
	//	4th July 2017
	// 	Voting API
	// 	Upvote or downvote a question

	// 	Sample Input
	// { "requestHeader": { "serviceId":"111", "interactionCode":"VOTE" }, "requestBody" : { "userid" : "1", "postid" : "1", "vote" : "1" } }

	// 	Sample Output
	// 	{"responseHeader":{"serviceId":"111","status":"200","message":"User Logged in"},"responseBody":{"username":"anoopanson","userid":"4"}}

	function vote($json_request){

		require_once Q2ALOCATION.'/qa-include/qa-base.php';
		require_once Q2ALOCATION.'/qa-include/db/users.php';
		require_once Q2ALOCATION.'/qa-include/app/cookies.php';
		require_once Q2ALOCATION.'/qa-include/app/votes.php';

		$serviceId	= $json_request['requestHeader']['serviceId'];
		
		$userid = $json_request['requestBody']['userid'];
		$postid['postid'] = $json_request['requestBody']['postid'];
		$vote = $json_request['requestBody']['vote'];

		$handle_array = qa_db_user_get_userid_handles($userid);
		$handle = $handle_array[$userid];

		$cookie = qa_cookie_get_create();

		qa_vote_set($postid, $userid, $handle, $cookie, $vote);
		
		if ($userid != null) {

			//success
			$res['responseHeader']['serviceId'] = $serviceId;
			$res['responseHeader']['status'] = "200"; 
			$res['responseHeader']['message'] = "Success!";
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