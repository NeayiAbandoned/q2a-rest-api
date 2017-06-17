<?php

	//
	//	Question2Answer API
	//	Author : Arun Anson
	//	Copyright (c) 2017 Hello Infinity Business Solutions Pvt. Ltd.
	//	17th June 2017
	//	GET QUESTIONS API
	//	Gets all of the questions and its details in order they are posted.

	//	Sample Input
	// { "requestHeader": { "serviceId":"111", "interactionCode":"GETQUESTIONS" }}

	//	Sample Output
	//	{"responseHeader":{"serviceId":"111","status":"200"},"responseBody":{"questions":[{"title":"what is the name of sandra bullock's first movie?","userid":"1","postid":"5","acount":"0","views":"1","content":"What is the name of popular hollywood actress sandra bullock's first movie?","tags":"movie,hollywood","netvotes":"0","updated":null,"created":"1497694735"},{"title":"Test question.","userid":"1","postid":"1","acount":"1","views":"1","content":"this is a test question to get answers for API test purpose.","tags":"test,test2","netvotes":"0","updated":null,"created":"1497455725"}]}}
	
	function get_questions($json_request){

	include 'connection.php';

	$serviceId	= $json_request['requestHeader']['serviceId'];

		$sql = "SELECT title, userid, postid, acount, views, content, tags, netvotes, UNIX_TIMESTAMP(updated) as updated, UNIX_TIMESTAMP(created) as created FROM qa_posts WHERE type='Q' and NOT(type='Q_HIDDEN') ORDER BY created DESC LIMIT 20;";
		$posts = $conn->query($sql);
		
		while($row_list_details= $posts->fetch_assoc()) {
            $product_details[] = $row_list_details;
        }

        $num_rows = mysqli_num_rows($posts);

        if ($num_rows > 0) {

			//success
			$res['responseHeader']['serviceId'] = $serviceId;
			$res['responseHeader']['status'] = "200";
			$res['responseBody']['questions'] = $product_details;
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