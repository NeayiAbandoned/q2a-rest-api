<?php

	//
	//	Question2Answer API
	//	Author : Arun Anson
	//	Copyright (c) 2017 Hello Infinity Business Solutions Pvt. Ltd.
	//	5th July 2017
	// Search API
	// Find questions with occurance of the given string

	// Sample Input
	// { "requestHeader": { "serviceId":"111", "interactionCode":"SEARCH" }, "requestBody" : { "inquery" : "test", "count" : "21", "userid" : "1" } }

	// Sample Output
	// {"responseHeader":{"serviceId":null,"status":"200"},"responseBody":{"posts":"1,15,13"}}

	 function search($json_request){

		require_once Q2ALOCATION.'/qa-include/qa-base.php';
		require_once Q2ALOCATION.'/qa-include/app/search.php';

		$inquery = $json_request['requestBody']['inquery'];
		$count = $json_request['requestBody']['count'];
		$userid = $json_request['requestBody']['userid'];

		$results = qa_get_search_results($inquery, 0, $count, $userid, false, false);

		$count_results = count($results);
		
		for ($i=0; $i < $count_results; $i++) {

			$post_results = $post_results.$results[$i]['question']['postid'];
			if ($i < $count_results-1) {

				$post_results = $post_results.',';
			}
		}

		if ($userid != null) {

			//success
			$res['responseHeader']['serviceId'] = $serviceId;
			$res['responseHeader']['status'] = "200"; 
			$res['responseBody']['posts'] = $post_results;
		}else{

			//error
			$res['responseHeader']['serviceId'] = $serviceId;
			$res['responseHeader']['status'] = "401"; 
			$res['responseHeader']['message'] = "Unauthorized";
		}

		$json_response = json_encode($res, JSON_UNESCAPED_SLASHES);
		echo $json_response;
	}
?>