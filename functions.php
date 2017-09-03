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

	function send_push($question_id){

        include 'connection.php';

	    //Send push to the author of the question_id

        //find the author of the quesiton_id
        $query_getuserid = "SELECT g.gcm_key as gcm FROM gcm_token g, qa_posts p
		WHERE g.gcm_user = p.userid AND p.postid = ".$question_id." ";

        //echo $query_getuserid;
        $result_getuserid = $conn->query($query_getuserid);

        while($row_getuserid = $result_getuserid->fetch_assoc()) {
            $data_get_getuserid[] = $row_getuserid;
        }

        //GCM Key against the user of $question_id
        //echo $data_get_getuserid[0][gcm];
        $key = $data_get_getuserid[0][gcm];

        // Replace with the real server API key from Google APIs
        $apiKey = "AAAATm5TvLw:APA91bEwSayGf0o34qc1yjqygqWA6VxpLjUGgmiR1CSasq8J7-Tn0GkLmwW19PKkvtS3ETRYX_VM8hONIb7HBl9CxllwoINkPTtGJGEaqAA7MI-Dex_1uH-vU9xA-RoVTeXgWfNrKA1-";

        // Replace with the real client registration IDs
        $registrationIDs = array( $key );

        // Message to be sent
        $title = "Renal Talk";
        $message = "Someone just left an answer to your question on renal talk. ";
        $image = "http:\/\/icclightshow.com.hk\/images\/icon_hk.png";

        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';

        $fields = array(
            'registration_ids' => $registrationIDs,
            'data' => array( 'data' => array( "title" => $title, "message" => $message, "image" => $image )),
        );

        $headers = array(
            'Authorization: key=' . $apiKey,
            'Content-Type: application/json'
        );

        // Open connection
        $ch = curl_init();

        // Set the URL, number of POST vars, POST data
        curl_setopt( $ch, CURLOPT_URL, $url);
        curl_setopt( $ch, CURLOPT_POST, true);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $aa = json_encode( $fields);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $fields));

        // Execute post
        $result = curl_exec($ch);

        // Close connection
        curl_close($ch);
        echo $result;

    }