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
	include 'write-comment.php';
	include 'update-post.php';
	include 'view-profile.php';
	include 'delete-post.php';
	include 'vote.php';
	include 'search.php';
	include 'check-vote.php';
	include 'get-user-questions.php';
	include 'get-tags.php';
	include 'set-best-answer.php';
	include 'save-image.php';
	include 'favorite.php';
	include 'get-user-favorites.php';
	include 'get-categories.php';
	include 'get-pages.php';

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

		case 'WRITECOMMENT':{
			write_comment($json_request);
		}
		break;

		case 'UPDATEPOST':{
			update_post($json_request);
		}
		break;

		case 'VIEWPROFILE':{
			view_profile($json_request);
		}
		break;

		case 'DELETEPOST':{
			delete_post($json_request);
		}
		break;

		case 'VOTE':{
			vote($json_request);
		}
		break;

		case 'SEARCH':{
			search($json_request);
		}
		break;

		case 'CHECKVOTE':{
			check_vote($json_request);
		}
		break;

		case 'GETUSERQUESTIONS':{
			get_user_questions($json_request);
		}
		break;

		case 'GETTAGS':{
			get_tags($json_request);
		}
		break;

		case 'SETBESTANSWER':{
			set_best_answer($json_request);
		}
		break;

		case 'SAVEIMAGE':{
			save_image($json_request);
		}
		break;

		case 'FAVORITE':{
			favorite($json_request);
		}
		break;

		case 'GETUSERFAVORITES':{
			get_user_favorites($json_request);
		}
		break;

		case 'GETCATEGORIES':{
			get_categories($json_request);
		}
		break;

		case 'GETPAGES':{
			get_pages($json_request);
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