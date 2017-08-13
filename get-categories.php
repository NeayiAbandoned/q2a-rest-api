<?php

	//
	//	Question2Answer API
	//	Author : Arun Anson
	//	Copyright (c) 2017 Hello Infinity Business Solutions Pvt. Ltd.
	//	11th August 2017
	//	GET CATEGORIES API
	//	Get categories and its associated details.

	//	Sample Input
	//	{ "requestHeader": { "serviceId":"111", "interactionCode":"GETCATEGORIES"} }

	//	Sample Output
	//	{"responseHeader":{"serviceId":"111","status":"200"},"responseBody":{"questions":[{"categoryid":"1","parentid":null,"title":"Category 1","tags":"category-1","content":"category 1 description","qcount":"1","position":"1","backpath":"category-1"},{"categoryid":"2","parentid":null,"title":"Category 2","tags":"category-2","content":"Category 2 description","qcount":"0","position":"2","backpath":"category-2"}]}}
	
	function get_categories($json_request){

	include 'connection.php';

	$serviceId	= $json_request['requestHeader']['serviceId'];
	$keyword	= $json_request['requestBody']['keyword'];

		$sql_get_categories = "SELECT * FROM `".TABLEPREFIX."categories`;";
		$result_get_categories = $conn->query($sql_get_categories);
		
		while($row_get_categories= $result_get_categories->fetch_assoc()) {
            $data_get_categories[] = $row_get_categories;
        }

        $num_rows = mysqli_num_rows($result_get_categories);

        if ($num_rows > 0) {

			//success
			$res['responseHeader']['serviceId'] = $serviceId;
			$res['responseHeader']['status'] = "200";
			$res['responseBody']['categories'] = $data_get_categories;
		}else{

			//error
			$res['responseHeader']['serviceId'] = $serviceId;
			$res['responseHeader']['status'] = "401"; 
			$res['responseHeader']['message'] = "No categories!";
		}


        $json_response = json_encode($res, JSON_UNESCAPED_SLASHES);
		echo $json_response;

	}
?>