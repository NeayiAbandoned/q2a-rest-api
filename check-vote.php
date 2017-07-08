<?php

	//
	//	Question2Answer API
	//	Author : Arun Anson
	//	Copyright (c) 2017 Hello Infinity Business Solutions Pvt. Ltd.
	//	8th July 2017
	// 	CHECK VOTE API
	// 	Check if a user has voted for a specific postid. if voted, return stats.

	// 	Sample Input
	// { "requestHeader": { "serviceId":"111", "interactionCode":"CHECKVOTE" }, "requestBody" : { "user_id" : "1", "post_id" : "21" } }

	// 	Sample Output
	// 	{"responseHeader":{"status":"204","serviceId":"111","message":"User hasn't voted for this post"}}
	
	function check_vote($json_request){
		
		include 'connection.php';
		
		$serviceId	= $json_request['requestHeader']['serviceId'];
		$user_id = $json_request['requestBody']['user_id'];
		$post_id = $json_request['requestBody']['post_id'];

		if ($user_id != '') {
			
			//If the given userid is a valid one

			
			$sql_getvotes = "SELECT * FROM `".TABLEPREFIX."uservotes` WHERE `postid` = ".$post_id." AND `userid` = ".$user_id." ";
			$result_getvotes = $conn->query($sql_getvotes);
		
			while($row_getvotes = $result_getvotes->fetch_assoc()) {
	            $data_getvotes[] = $row_getvotes;
	        }

	        $num_rows = mysqli_num_rows($result_getvotes);

	        if ($num_rows != 0) {
				
				//success
				$message = "The User has already voted for the post";
				$res['responseHeader']['status'] = "200";
	        	$res['responseBody']['data'] = $data_getvotes;
	        }
	       	else{

	       		//no rows fetched
	       		$res['responseHeader']['status'] = "204";
	       		$message = "User hasn't voted for this post";
	       	}
			

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