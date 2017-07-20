<?php

	//
	//	Question2Answer API
	//	Author : Arun Anson
	//	Copyright (c) 2017 Hello Infinity Business Solutions Pvt. Ltd.
	//	17th June 2017
	// 	GET QUESTIONS API
	// 	Gets all of the questions and its details in order they are posted.

	// 	Sample Input
	// { "requestHeader": { "serviceId":"111", "interactionCode":"GETQUESTIONS" }, "requestBody" : { "userid" : "2"}}

	// 	Sample Output
	// 	{"responseHeader":{"serviceId":"111","status":"200"},"responseBody":{"questions":[{"title":"question with image test","userid":"1","postid":"27","acount":"0","views":"1","content":"<p><img alt=\"\" src=\"https://www.w3schools.com/css/img_fjords.jpg\" style=\"height:400px; width:600px\">image goes here with text</p>","tags":"image","netvotes":"0","updated":null,"created":"1500354649","favorite":"27"},{"title":"Question title1","userid":"17","postid":"21","acount":"1","views":"1","content":"Question content","tags":"tag1,tag2","netvotes":"0","updated":null,"created":"1498057186","favorite":null},{"title":"One test","userid":"16","postid":"15","acount":"0","views":"1","content":"test content","tags":"tag1,tag2","netvotes":"0","updated":null,"created":"1498039876","favorite":null},{"title":"One test","userid":"16","postid":"14","acount":"0","views":"1","content":"test content","tags":"tag1,tag2","netvotes":"0","updated":null,"created":"1498039791","favorite":null},{"title":"One test","userid":"16","postid":"13","acount":"0","views":"1","content":"test content","tags":"tag1,tag2","netvotes":"0","updated":null,"created":"1498039537","favorite":null},{"title":"One test","userid":"16","postid":"12","acount":"0","views":"0","content":null,"tags":"","netvotes":"0","updated":null,"created":"1498039467","favorite":null},{"title":"test one","userid":"16","postid":"11","acount":"0","views":"1","content":"test content","tags":"test1","netvotes":"0","updated":null,"created":"1498039316","favorite":null},{"title":"How many movies have the RED Camera been used?","userid":"1","postid":"8","acount":"0","views":"1","content":"In total, worldwide, how many movies have the camera RED been used?","tags":"movie,camera","netvotes":"-2","updated":null,"created":"1497696372","favorite":null},{"title":"23post title to update","userid":"1","postid":"5","acount":"1","views":"1","content":"post content to update","tags":"tag1, tag2","netvotes":"0","updated":null,"created":"1497694735","favorite":null},{"title":"update post title","userid":"1","postid":"1","acount":"7","views":"1","content":"update content","tags":"tag1 update, tag2 update1","netvotes":"-1","updated":null,"created":"1497455725","favorite":"1"}]}}
	
	function get_questions($json_request){

	include 'connection.php';

	$serviceId	= 	$json_request['requestHeader']['serviceId'];
	$userid		=	$json_request['requestBody']['userid'];

		$sql_get_questions = "SELECT title, A.userid, postid, acount, views, content, tags, netvotes, UNIX_TIMESTAMP(updated) as updated, UNIX_TIMESTAMP(created) as created, B.userid as favorite FROM ".TABLEPREFIX."posts AS A LEFT JOIN ( select * from ".TABLEPREFIX."userfavorites where userid = ".$userid." ) as B ON A.postid = B.entityid WHERE type='Q' and NOT(type='Q_HIDDEN') ORDER BY created DESC;";
		$result_get_questions = $conn->query($sql_get_questions);
		
		while($row_get_questions= $result_get_questions->fetch_assoc()) {
            $data_get_questions[] = $row_get_questions;
        }

        $num_rows = mysqli_num_rows($result_get_questions);

        if ($num_rows > 0) {

			//success
			$res['responseHeader']['serviceId'] = $serviceId;
			$res['responseHeader']['status'] = "200";
			$res['responseBody']['questions'] = $data_get_questions;
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