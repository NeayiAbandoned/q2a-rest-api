<?php

//
//	Question2Answer API
//	Author : Arun Anson
//	Copyright (c) 2017 Hello Infinity Business Solutions Pvt. Ltd.
//	18th July 2017
//	SAVE IMAGE API
//	Save images to server and return a url.

//	Sample Input
//	{ "requestHeader": { "serviceId":"111", "interactionCode":"SAVEIMAGE"}, "requestBody" : { "base64data" : "1"}}

//	Sample Output
//	{"responseHeader":{"serviceId":"111","status":"200","message":"Wrote Image"},"responseBody":{"Url":"http://renalbiomed.com/api/post/G3mRScNF.png"}}

function save_image($json_request){

	$serviceId	=	$json_request['requestHeader']['serviceId'];
	$base64data	=	$json_request['requestBody']['base64data'];
	$type		=	$json_request['requestBody']['type'];
	$folder 	=	'post';

	$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
	$pass = array(); //remember to declare $pass as an array
	$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	for ($i = 0; $i < 8; $i++) {
		$n = rand(0, $alphaLength);
		$pass[] = $alphabet[$n];
	}

	$image_name = implode($pass); //turn the array into a string
	//Save image
	list($type, $base64data) = explode(';', $base64data);
	list(, $base64data)      = explode(',', $base64data);
	$base64data = base64_decode($base64data);
	$data_wrote = file_put_contents('./'.$folder.'/'.$image_name.'.png', $base64data);

	if ($data_wrote != 0) {

		$message = "Wrote Image";
		$status = "200";

		$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$image_url = $actual_link.$folder.'/'.$image_name.'.png';
	}else{

		$message = "Image Error";
		$status	= "400";
	}

	$res['responseHeader']['serviceId'] = $serviceId;
	$res['responseHeader']['status'] = $status;
	$res['responseHeader']['message'] = $message;
	$res['responseBody']['Url'] = $image_url;

	$json_response = json_encode($res, JSON_UNESCAPED_SLASHES);
	echo $json_response;
}
?>