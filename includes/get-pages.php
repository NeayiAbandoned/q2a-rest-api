<?php

//
//	Question2Answer API
//	Author : Arun Anson
//	Copyright (c) 2017 Hello Infinity Business Solutions Pvt. Ltd.
//	11th August 2017
//	GET PAGES API
//	Get pages and its associated details.

//	Sample Input
//	{ "requestHeader": { "serviceId":"111", "interactionCode":"GETPAGES"} }

//	Sample Output
//	{"responseHeader":{"serviceId":"111","status":"200"},"responseBody":{"pages":[{"pageid":"2","title":"Disclaimer","nav":"_","position":"1","flags":"0","permit":"150","tags":"disclaimer","heading":"Disclaimer","content":"Disclaimers have a long legal history. They generally have two purposes:\r\n\r\nTo warn\r\nTo limit liability\r\nA warning sign is likely the earliest and easiest manifestation of a disclaimer.\r\n\r\nNo trespassing alerts passing individuals that they are near a private land boundary and also excuses the landowner of some liability if people visit uninvited.\r\n\r\nSometimes, the warning and limitation of liability are based on statutory law. For example, the state of Washington in the United States has a law that prevents people injured at equestrian facilities from pursuing legal damages.\r\n\r\nAny business that boards, trains or allows the riding of horses has to have a specific sign to enjoy this protection from liability. This sign acts as a disclaimer much like a No trespassing sign in that it informs and specifies limits on facility responsibilities"}]}}

function get_pages($json_request)
{

	include '../connection.php';

	$serviceId	= $json_request['requestHeader']['serviceId'];
	$keyword	= $json_request['requestBody']['keyword'];

	$sql_get_pages = "SELECT * FROM `".TABLEPREFIX."pages`;";
	$result_get_pages = $conn->query($sql_get_pages);

	while($row_get_pages= $result_get_pages->fetch_assoc()) {
		$data_get_pages[] = $row_get_pages;
	}

	$num_rows = mysqli_num_rows($result_get_pages);

	if ($num_rows > 0) {

		//success
		$res['responseHeader']['serviceId'] = $serviceId;
		$res['responseHeader']['status'] = "200";
		$res['responseBody']['pages'] = $data_get_pages;
	}else{

		//error
		$res['responseHeader']['serviceId'] = $serviceId;
		$res['responseHeader']['status'] = "401";
		$res['responseHeader']['message'] = "No pages!";
	}

	$json_response = json_encode($res, JSON_UNESCAPED_SLASHES);
	echo $json_response;

}
?>