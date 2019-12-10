<?php

//
//	Question2Answer API
//	Author : Arun Anson
//	Copyright (c) 2017 Hello Infinity Business Solutions Pvt. Ltd.
//	15th June 2017
//

include 'settings.php';

//Get JSON Request
$json_request = json_decode(file_get_contents('php://input'), true);

$interactionCode = $json_request['requestHeader']['interactionCode'];
$serviceId = $json_request['requestHeader']['serviceId'];

switch ($interactionCode)
{
	case 'LOGIN':
		include 'includes/login.php';
		login($json_request);
		break;

	case 'UPDATEPROFILE':
		include 'includes/update-profile.php';
		updateprofile($json_request);
		break;

	case 'GETQUESTIONS':
		include 'includes/get-questions.php';
		get_questions($json_request);
		break;

	case 'GETQUESTIONDETAIL':
		include 'includes/get-question-detail.php';
		get_question_detail($json_request);
		break;

	case 'CREATEQUESTION':
		include 'includes/create-question.php';
		create_question($json_request);
		break;

	case 'WRITEANSWER':
		include 'includes/write-answer.php';
		write_answer($json_request);
		break;

	case 'WRITECOMMENT':
		include 'includes/write-comment.php';
		write_comment($json_request);
		break;

	case 'UPDATEPOST':
		include 'includes/update-post.php';
		update_post($json_request);
		break;

	case 'VIEWPROFILE':
		include 'includes/view-profile.php';
		view_profile($json_request);
		break;

	case 'DELETEPOST':
		include 'includes/delete-post.php';
		delete_post($json_request);
		break;

	case 'VOTE':
		include 'includes/vote.php';
		vote($json_request);
		break;

	case 'SEARCH':
		include 'includes/search.php';
		search($json_request);
		break;

	case 'CHECKVOTE':
		include 'includes/check-vote.php';
		check_vote($json_request);
		break;

	case 'GETUSERQUESTIONS':
		include 'includes/get-user-questions.php';
		get_user_questions($json_request);
		break;

	case 'GETTAGS':
		include 'includes/get-tags.php';
		get_tags($json_request);
		break;

	case 'SETBESTANSWER':
		include 'includes/set-best-answer.php';
		set_best_answer($json_request);
		break;

	case 'SAVEIMAGE':
		include 'includes/save-image.php';
		save_image($json_request);
		break;

	case 'FAVORITE':
		include 'includes/favorite.php';
		favorite($json_request);
		break;

	case 'GETUSERFAVORITES':
		include 'includes/get-user-favorites.php';
		get_user_favorites($json_request);
		break;

	case 'GETCATEGORIES':
		include 'includes/get-categories.php';
		get_categories($json_request);
		break;

	case 'GETPAGES':
		include 'includes/get-pages.php';
		get_pages($json_request);
		break;

default:
	echo '{"responseHeader"	:	{
		"serviceId": "'.$serviceId.'",
		"status": "405",
		"message": "Method Not Allowed" }}';
	break;
}
