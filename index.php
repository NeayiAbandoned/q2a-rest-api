<?php

	//
	//	Question2Answer API
	//	Author : Arun Anson
	//	Copyright (c) 2017 Hello Infinity Business Solutions Pvt. Ltd.
	//	15th June 2017
	//
	
	include 'settings.php';
	include 'login.php';
	include 'update-profile.php';
	include 'get-questions.php';
	include 'get-question-detail.php';
	include 'create-question.php';
	include 'write-answer.php';

	//Get JSON Request
	$json_request = json_decode(file_get_contents('php://input'), true);

	$interactionCode	= $json_request['requestHeader']['interactionCode'];
	$serviceId	= $json_request['requestHeader']['serviceId'];

	switch ($interactionCode) {

		case 'LOGIN':{
			login($json_request);
		}	
		break;
		
		case 'UPDATEPROFILE':{
			updateprofile($json_request);
		}
		break;

		case 'GETQUESTIONS':{
			get_questions($json_request);
		}
		break;

		case 'GETQUESTIONDETAIL':{
			get_question_detail($json_request);
		}
		break;

		case 'CREATEQUESTION':{
			create_question($json_request);
		}
		break;

		case 'WRITEANSWER':{
			write_answer($json_request);
		}
		break;
		
		default:{
				echo '{"responseHeader"	:	{
							"serviceId": "'.$serviceId.'",
							"status": "405",
							"message": "Method Not Allowed"
						}
					}';
			}
			break;
	}
?>