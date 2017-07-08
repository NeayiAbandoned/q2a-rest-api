<?php

	//
	//	Question2Answer API
	//	Author : Arun Anson
	//	Copyright (c) 2017 Hello Infinity Business Solutions Pvt. Ltd.
	//	8th July 2017
	// 	GET USER QUESTIONS API
	// 	Gets all of the questions and its details created by a specific user in order they are posted.

	// 	Sample Input
	// { "requestHeader": { "serviceId":"111", "interactionCode":"GETUSERQUESTIONS", "user_id" : "1" }}

	// 	Sample Output
	// 	{"responseHeader":{"serviceId":"111","status":"200"},"responseBody":{"questions":[{"title":"How many movies have the RED Camera been used?","userid":"1","postid":"8","acount":"0","views":"1","content":"In total, worldwide, how many movies have the camera RED been used?","tags":"movie,camera","netvotes":"0","updated":null,"created":"1497696372"},{"title":"23post title to update","userid":"1","postid":"5","acount":"1","views":"1","content":"post content to update","tags":"tag1, tag2","netvotes":"0","updated":null,"created":"1497694735"},{"title":"update post title","userid":"1","postid":"1","acount":"7","views":"1","content":"update content","tags":"tag1 update, tag2 update1","netvotes":"1","updated":null,"created":"1497455725"}]}}
	
	function get_user_questions($json_request){

	include 'connection.php';

	$serviceId	= $json_request['requestHeader']['serviceId'];
	$user_id	= $json_request['requestHeader']['user_id'];

		$sql_get_user_questions = "SELECT title, userid, postid, acount, views, content, tags, netvotes, UNIX_TIMESTAMP(updated) as updated, UNIX_TIMESTAMP(created) as created FROM ".TABLEPREFIX."posts WHERE type='Q' and NOT(type='Q_HIDDEN') and userid = ".$user_id." ORDER BY created DESC;";
		$result_get_user_questions = $conn->query($sql_get_user_questions);
		
		while($row_get_user_questions= $result_get_user_questions->fetch_assoc()) {
            $data_get_user_questions[] = $row_get_user_questions;
        }

        $num_rows = mysqli_num_rows($result_get_user_questions);

        if ($num_rows > 0) {

			//success
			$res['responseHeader']['serviceId'] = $serviceId;
			$res['responseHeader']['status'] = "200";
			$res['responseBody']['questions'] = $data_get_user_questions;
		}else{

			//error
			$res['responseHeader']['serviceId'] = $serviceId;
			$res['responseHeader']['status'] = "401"; 
			$res['responseHeader']['message'] = "No Questions";
		}


        $json_response = json_encode($res, JSON_UNESCAPED_SLASHES);
		echo $json_response;

	}
?>