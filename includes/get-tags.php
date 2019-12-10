<?php

//
//	Question2Answer API
//	Author : Arun Anson
//	Copyright (c) 2017 Hello Infinity Business Solutions Pvt. Ltd.
//	13th July 2017
//	GET TAGS API
//	Get tag suggestions like the one user entered

//	Sample Input
//	{ "requestHeader": { "serviceId":"111", "interactionCode":"GETTAGS"}, "requestBody" : { "keyword" : "ag" }}

//	Sample Output
//	{"responseHeader":{"serviceId":"111","status":"200"},"responseBody":{"questions":[{"wordid":"54","word":"tag2","titlecount":"0","contentcount":"0","tagwordcount":"4","tagcount":"4"},{"wordid":"53","word":"tag1","titlecount":"0","contentcount":"0","tagwordcount":"4","tagcount":"4"}]}}

function get_tags($json_request){

	include '../connection.php';

	$serviceId	= $json_request['requestHeader']['serviceId'];
	$keyword	= $json_request['requestBody']['keyword'];

	$sql_get_tags = "SELECT * FROM `".TABLEPREFIX."words` WHERE `word` LIKE '%".$keyword."%' ORDER BY `word` DESC;";
	$result_get_tags = $conn->query($sql_get_tags);

	while($row_get_tags= $result_get_tags->fetch_assoc()) {
		$data_get_tags[] = $row_get_tags;
	}

	$num_rows = mysqli_num_rows($result_get_tags);

	if ($num_rows > 0) {

		//success
		$res['responseHeader']['serviceId'] = $serviceId;
		$res['responseHeader']['status'] = "200";
		$res['responseBody']['questions'] = $data_get_tags;
	}else{

		//error
		$res['responseHeader']['serviceId'] = $serviceId;
		$res['responseHeader']['status'] = "401";
		$res['responseHeader']['message'] = "No Tags!";
	}


	$json_response = json_encode($res, JSON_UNESCAPED_SLASHES);
	echo $json_response;

}
?>