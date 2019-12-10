<?php

	//
	//	Question2Answer API
	//	Author : Arun Anson
	//	Copyright (c) 2017 Hello Infinity Business Solutions Pvt. Ltd.
	//	3rd July 2017
	// 	DELETE POST API
	// 	Delete QUESTION, ANSWER, COMMENT or any other post type using postid.

	// 	Sample Input
	// { "requestHeader": { "serviceId":"111", "interactionCode":"DELETEPOST"}, "requestBody" : { "postid" : "27" }}

	// 	Sample Output
	// 	{"responseHeader":{"serviceId":"111","status":"200"},"responseBody":{"message":"Successfully deleted!"}}

	function delete_post($json_request){

		include '../connection.php';

		$serviceId	= $json_request['requestHeader']['serviceId'];
		$postid = $json_request['requestBody']['postid'];

		$sql_delete_post = 'DELETE FROM `qa_posts` WHERE `postid`= '.$postid.' ';

		$result_delete_post = $conn->query($sql_delete_post);
		$num_rows = mysqli_affected_rows($conn);

        if ($num_rows > 0) {

			//success
			$status = "200";
			$message = "Successfully deleted!";
		}else{

			//error
			$status = "401";
			$message = "No posts associated with the id specified.";
		}

		$res['responseHeader']['serviceId'] = $serviceId;
		$res['responseHeader']['status'] = $status;
		$res['responseBody']['message'] = $message;

        $json_response = json_encode($res, JSON_UNESCAPED_SLASHES);
		echo $json_response;

	}
?>