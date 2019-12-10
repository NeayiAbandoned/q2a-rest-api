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
// {"responseHeader":{"serviceId":null,"status":"200"},"responseBody":{"result":[{"title":"update post title","postid":"1","userid":"1","acount":"7","views":"1","tags":"tag1 update, tag2 update","netvotes":"1","created":"1497455725"},{"title":"One test","postid":"15","userid":"16","acount":"0","views":"1","tags":"tag1,tag2","netvotes":"0","created":"1498039876"},{"title":"One test","postid":"13","userid":"16","acount":"0","views":"1","tags":"tag1,tag2","netvotes":"0","created":"1498039537"},{"title":"test one","postid":"11","userid":"16","acount":"0","views":"1","tags":"test1","netvotes":"0","created":"1498039316"},{"title":"One test","postid":"14","userid":"16","acount":"0","views":"0","tags":"tag1,tag2","netvotes":"0","created":"1498039791"},{"title":"One test","postid":"12","userid":"16","acount":"0","views":"0","tags":"","netvotes":"0","created":"1498039467"}]}}

function search($json_request){

	require_once Q2ALOCATION.'/qa-include/qa-base.php';
	require_once Q2ALOCATION.'/qa-include/app/search.php';

	$inquery = $json_request['requestBody']['inquery'];
	$count = $json_request['requestBody']['count'];
	$userid = $json_request['requestBody']['userid'];

	$results = qa_get_search_results($inquery, 0, $count, $userid, false, false);

	$count_results = count($results);

	for ($i=0; $i < $count_results; $i++) {

		$result[$i]['title'] = $post_results.$results[$i]['question']['title'];
		$result[$i]['postid'] = $post_results.$results[$i]['question']['postid'];
		$result[$i]['userid'] = $post_results.$results[$i]['question']['userid'];
		$result[$i]['acount'] = $post_results.$results[$i]['question']['acount'];
		$result[$i]['views'] = $post_results.$results[$i]['question']['views'];
		$result[$i]['tags'] = $post_results.$results[$i]['question']['tags'];
		$result[$i]['netvotes'] = $post_results.$results[$i]['question']['netvotes'];
		$result[$i]['created'] = $post_results.$results[$i]['question']['created'];
	}

	if ($userid != null) {

		//success
		$res['responseHeader']['serviceId'] = $serviceId;
		$res['responseHeader']['status'] = "200";
		$res['responseBody']['result'] = $result;

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