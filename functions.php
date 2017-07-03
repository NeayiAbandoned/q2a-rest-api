<?php

	//
	//	Question2Answer API
	//	Author : Arun Anson
	//	Copyright (c) 2017 Hello Infinity Business Solutions Pvt. Ltd.
	//	30th June 2017
	// 	
	//	All Functions that are reusable throught the system
	// 

	function get_profile_avatar_url($user_id){
		
		//Returns the user's profile picture url if it exsists in db. Else returns an error

		include 'connection.php';
		include 'settings.php';

		$sql_get_profile_avatar_url = "SELECT content FROM `".TABLEPREFIX."usermetas` WHERE `userid` = ".$user_id." AND `title` = 'avatar'";
		$result_get_profile_avatar_url = $conn->query($sql_get_profile_avatar_url);

		while($row_get_profile_avatar_url = $result_get_profile_avatar_url->fetch_assoc()) {
			$data_get_profile_avatar_url[] = $row_get_profile_avatar_url;
		}

		$num_rows = mysqli_num_rows($result_get_profile_avatar_url);

		if ($num_rows != 0) {
			$avatar_url = var_dump($data_get_profile_avatar_url[0]['content']);
		}else{
			$avatar_url = "No Avatar";
		}

		return $avatar_url;
	}