<?php

	//
	//	Question2Answer API
	//	Author : Arun Anson
	//	Copyright (c) 2017 Hello Infinity Business Solutions Pvt. Ltd.
	//	29th June 2017
	// 	VIEW PROFILE API
	// 	View user's FullName, Username, Email, Location and avatar when userid is passed as an argument.

	// 	Sample Input
	// { "requestHeader": { "serviceId":"111", "interactionCode":"VIEWPROFILE" }, "requestBody" : { "user_id" : "1" } }

	// 	Sample Output
	// 	{"responseBody":{"user_fullname":"Anoop Anson","user_location":"alappuzha","user_name":"admin","user_email":"anoop@helloinfinity.com","user_avatarurl":"http://renalbiomed.com/api/avatar/1.png"},"responseHeader":{"status":"200","serviceId":"111","message":"Success"}}
	
	function view_profile($json_request){

		include 'connection.php';

		require_once Q2ALOCATION.'/qa-include/qa-base.php';
		require_once Q2ALOCATION.'/qa-include/db/users.php';

		require_once Q2ALOCATION.'/qa-include/db/metas.php';
		
		$serviceId	= $json_request['requestHeader']['serviceId'];
		$user_id = $json_request['requestBody']['user_id'];

		if ($user_id != '') {
			
			//If the given userid is a valid one

			//create and update email, avatarurl as a meta value if not pressent. else update it
			$email_id = qa_db_usermeta_get($user_id, 'email');
			$avatar_url = qa_db_usermeta_get($user_id, 'avatar');
			$user_name = qa_db_user_get_userid_handles($user_id);

			$sql_getuserinfo = "SELECT `title`,`content` FROM `".TABLEPREFIX."userprofile` WHERE `userid` = ".$user_id." ";
			$result_getuserinfo = $conn->query($sql_getuserinfo);
		
			while($row_getuserinfo = $result_getuserinfo->fetch_assoc()) {
	            $data_getuserinfo[] = $row_getuserinfo;
	        }

	        $num_rows = mysqli_num_rows($result_getuserinfo);

	        if ($num_rows != 0) {
	        	$res['responseBody']['user_fullname'] = $data_getuserinfo[1]["content"];
				$res['responseBody']['user_location'] = $data_getuserinfo[0]["content"];
	        }

			$res['responseBody']['user_name'] = $user_name[$user_id];
			
			//success
			$message = "Success";
			$res['responseHeader']['status'] = "200";
			$res['responseBody']['user_email'] = $email_id;
			$res['responseBody']['user_avatarurl'] = $avatar_url;

		}else{

			//error
			$message = "Unauthorized!";
			$res['responseHeader']['status'] = "401";
		}

		$res['responseHeader']['serviceId'] = $serviceId;
		$res['responseHeader']['message'] = $message;

		$json_response = json_encode($res, JSON_UNESCAPED_SLASHES);
		echo $json_response;

	}
?>