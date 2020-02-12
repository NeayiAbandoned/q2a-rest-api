<?php

//
//	Question2Answer API
//	Author : Arun Anson
//	Copyright (c) 2017 Hello Infinity Business Solutions Pvt. Ltd.
//	3rd July 2017
// 	UPDATE POST API
// 	Update QUESTION, ANSWER, COMMENT or any other post type using postid

// 	Sample Input
// { "requestHeader": { "serviceId":"111", "interactionCode":"UPDATEPOST"}, "requestBody" : { "postid" : "1", "postitle" : "update post title", "postcontent" : "update content", "posttags" : "tag1 update, tag2 update", "categoryid" : "1" }}

// 	Sample Output
// 	{"responseHeader":{"serviceId":"111","status":"200"},"responseBody":{"message":"Successfully updated!"}}

function update_post($json_request){

	include '../connection.php';

	require_once QA_INCLUDE_DIR.'qa-base.php';
	require_once QA_INCLUDE_DIR.'app/posts.php';

	$serviceId	= $json_request['requestHeader']['serviceId'];
	$postid = $json_request['requestBody']['postid'];
	$postitle = $json_request['requestBody']['postitle'];
	$postcontent = $json_request['requestBody']['postcontent'];
	$posttags = $json_request['requestBody']['posttags'];
	$categoryid =   $json_request['requestBody']['categoryid'];

	qa_post_set_category($postid, $categoryid, $byuserid=null);

	$sql_update_post = 'UPDATE '.TABLEPREFIX.'posts SET `title` = "'.$postitle.'", `content` = "'.$postcontent.'", `tags` = "'.$posttags.'" WHERE `postid` = "'.$postid.'";';

	$result_update_post = $conn->query($sql_update_post);
	$num_rows = mysqli_affected_rows($conn);

	if ($num_rows > 0) {

		//success
		$status = "200";
		$message = "Successfully updated!";
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