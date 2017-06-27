<?php

	//
	//	Question2Answer API
	//	Author : Arun Anson
	//	Copyright (c) 2017 Hello Infinity Business Solutions Pvt. Ltd.
	//	17th June 2017
	// 	GET QUESTIONS API
	// 	Gets all of the questions and its details in order they are posted.

	// 	Sample Input
	// { "requestHeader": { "serviceId":"111", "interactionCode":"UPDATEPOST"}, "requestBody" : { "postid" : "1", "postitle" : "post title to update", "postcontent" : "post content to update", "posttags" : "tag1, tag2" }}

	// 	Sample Output
	//	{"responseHeader":{"serviceId":"111","status":"200"},"responseBody":{"answers":[{"title":null,"postid":"9","acount":"0","views":"0","tags":null,"content":"Answer2 on the test question","netvotes":"0","updated":null,"created":"1497697943"},{"title":null,"postid":"2","acount":"0","views":"0","tags":null,"content":"answer test test","netvotes":"0","updated":null,"created":"1497455825"}]}}
	
	function update_post($json_request){

	include 'connection.php';

	$serviceId	= $json_request['requestHeader']['serviceId'];
	$postid = $json_request['requestBody']['postid'];
	$postitle = $json_request['requestBody']['postitle'];
	$postcontent = $json_request['requestBody']['postcontent'];
	$posttags = $json_request['requestBody']['posttags'];

		$sql_update_post = "UPDATE ".TABLEPREFIX."posts SET `title` = ".$postitle." , `content` = ".$postcontent.", `tags` = ".$posttags." WHERE `".TABLEPREFIX."posts`.`postid` = ".$postid." ;";

		$result_update_post = $conn->query($sql_update_post);
		
		while($row_update_post = $result_update_post->fetch_assoc()) {
            $data_update_post[] = $row_update_post;
        }

        $num_rows = mysqli_num_rows($result_update_post);

        if ($num_rows > 0) {

			//success
			$res['responseHeader']['serviceId'] = $serviceId;
			$res['responseHeader']['status'] = "200";
			$res['responseBody']['answers'] = $data_update_post;
		}else{

			//error
			$res['responseHeader']['serviceId'] = $serviceId;
			$res['responseHeader']['status'] = "401"; 
			$res['responseHeader']['message'] = "There are no answers to the specified question";
		}


        $json_response = json_encode($res, JSON_UNESCAPED_SLASHES);
		echo $json_response;

	}
?>