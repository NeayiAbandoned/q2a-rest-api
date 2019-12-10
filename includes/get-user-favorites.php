<?php

//
//	Question2Answer API
//	Author : Arun Anson
//	Copyright (c) 2017 Hello Infinity Business Solutions Pvt. Ltd.
//	20th July 2017
// 	GET USER FAVORITES API
// 	Get the user's favourite posts.

// 	Sample Input
// { "requestHeader": { "serviceId":"111", "interactionCode":"GETUSERFAVORITES"}, "requestBody" : { "userid" : "2"}}

// 	Sample Output
// 	{"responseHeader":{"serviceId":"111","status":"200"},"responseBody":{"questions":[{"title":"question with image test","userid":"1","postid":"27","acount":"0","views":"1","content":"<p><img alt=\"\" src=\"https://www.w3schools.com/css/img_fjords.jpg\" style=\"height:400px; width:600px\">image goes here with text</p>","tags":"image","netvotes":"0","updated":null,"created":"1500354649","favorite":"1"},{"title":"update post title","userid":"1","postid":"1","acount":"7","views":"1","content":"update content","tags":"tag1 update, tag2 update1","netvotes":"-1","updated":null,"created":"1497455725","favorite":"1"}]}}

function get_user_favorites($json_request){

	include '../connection.php';

	$serviceId	= 	$json_request['requestHeader']['serviceId'];
	$userid		=	$json_request['requestBody']['userid'];

	$sql_user_favorites = "SELECT title, A.userid, postid, acount, views, content, tags, netvotes, UNIX_TIMESTAMP(updated) as updated, UNIX_TIMESTAMP(created) as created, B.userid as favorite FROM ".TABLEPREFIX."posts AS A JOIN ( select * from ".TABLEPREFIX."userfavorites where userid = ".$userid." ) as B ON A.postid = B.entityid WHERE type='Q' and NOT(type='Q_HIDDEN') ORDER BY created DESC;";
	$result_user_favorites = $conn->query($sql_user_favorites);

	while($row_user_favorites= $result_user_favorites->fetch_assoc()) {
		$data_user_favorites[] = $row_user_favorites;
	}

	$num_rows = mysqli_num_rows($result_user_favorites);

	if ($num_rows > 0) {

		//success
		$res['responseHeader']['serviceId'] = $serviceId;
		$res['responseHeader']['status'] = "200";
		$res['responseBody']['questions'] = $data_user_favorites;
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