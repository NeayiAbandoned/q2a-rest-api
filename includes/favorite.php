<?php

	//
	//	Question2Answer API
	//	Author : Arun Anson
	//	Copyright (c) 2017 Hello Infinity Business Solutions Pvt. Ltd.
	//	20th July 2017
	//	FAVORITE SET/CLEAR API
	//	Sets/clears a post item as favorite.

	//	Sample Input
	//	{ "requestHeader": { "serviceId":"111", "interactionCode":"FAVORITE"}, "requestBody" : { "userid":"1", "posttype" : "Q", "postid" : "27", "favorite" : "1" }}

	//	Sample Output
	//	{"responseHeader":{"serviceId":"111","status":"200","message":"Favorite Added"}}

	function favorite($json_request){

		include '../connection.php';

		require_once QA_INCLUDE_DIR.'qa-base.php';
		require_once QA_INCLUDE_DIR.'db/users.php';
		require_once QA_INCLUDE_DIR.'app/cookies.php';
		require_once QA_INCLUDE_DIR.'app/favorites.php';

		$serviceId	=	$json_request['requestHeader']['serviceId'];
		$userid 	=	$json_request['requestBody']['userid'];
		$entitytype	=	$json_request['requestBody']['posttype'];
		$entityid	=	$json_request['requestBody']['postid'];
		$favorite 	=	$json_request['requestBody']['favorite'];

		$handle_array = qa_db_user_get_userid_handles($userid);
		$handle = $handle_array[$userid];

		$cookieid = qa_cookie_get_create();

	    $favorite_status = qa_user_favorite_set($userid, $handle, $cookieid, $entitytype, $entityid, $favorite);

	    $sql_get_favorite_status = "SELECT * FROM ".TABLEPREFIX."userfavorites WHERE `entityid` = ".$entityid.";";

	    $result_get_favorite_status = $conn->query($sql_get_favorite_status);


        $num_rows = mysqli_num_rows($result_get_favorite_status);

		if ($num_rows != 0) {

			$message = "Favorite Added";
			$status = "200";
		}else{

			$message = "Favorite Removed";
			$status	= "400";
		}

		$res['responseHeader']['serviceId'] = $serviceId;
		$res['responseHeader']['status'] = $status;
		$res['responseHeader']['message'] = $message;

	    $json_response = json_encode($res, JSON_UNESCAPED_SLASHES);
		echo $json_response;
	}
?>