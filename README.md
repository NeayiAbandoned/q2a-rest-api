Login / Signup / Resigtation API
---------------------------------

Registers a user and signs him/her up using the social login.

Sample Input

{ "requestHeader": { "serviceId":"111", "interactionCode":"LOGIN" }, "requestBody" : { "email" : "anoop@helloinfinity.com", "identifier" : "akm1kskdjbgasane", "username" : "anoopanson", "source" : "facebook" } }

Sample Output

{"responseHeader":{"serviceId":"111","status":"200","message":"User Logged in"},"responseBody":{"username":"anoopanson","userid":"4"}}


GET QUESTIONS API
------------------

Gets all of the questions and its basic details in order they are posted.

Sample Input

{ "requestHeader": { "serviceId":"111", "interactionCode":"GETQUESTIONS" }}

Sample Output

{"responseHeader":{"serviceId":"111","status":"200"},"responseBody":{"questions":[{"title":"what is the name of sandra bullock's first movie?","userid":"1","postid":"5","acount":"0","views":"1","content":"What is the name of popular hollywood actress sandra bullock's first movie?","tags":"movie,hollywood","netvotes":"0","updated":null,"created":"1497694735"},{"title":"Test question.","userid":"1","postid":"1","acount":"1","views":"1","content":"this is a test question to get answers for API test purpose.","tags":"test,test2","netvotes":"0","updated":null,"created":"1497455725"}]}}


GET QUESTION DETAIL API
-----------------------

Gets the question and answers to a specific question.

Sample Input

{ "requestHeader": { "serviceId":"111", "interactionCode":"GETQUESTIONDETAIL"}, "requestBody" : { "questionid" : "1" }}

Sample Output

{"responseHeader":{"serviceId":"111","status":"200"},"responseBody":{"question":[{"title":"update post title","acount":"7","views":"1","tags":"tag1 update, tag2 update1","content":"update content","netvotes":"1","updated":null,"created":"1497455725"}],"answers":[{"title":null,"postid":"20","acount":"0","views":"0","tags":null,"content":"?one ?one ?one ?one ?one ?one ?one ?one","netvotes":"0","updated":null,"created":"1498057104"},{"title":null,"postid":"19","acount":"0","views":"0","tags":null,"content":"here goes an another another answer","netvotes":"0","updated":null,"created":"1498056816"},{"title":null,"postid":"18","acount":"0","views":"0","tags":null,"content":"here goes an another answer","netvotes":"0","updated":null,"created":"1498056770"},{"title":null,"postid":"17","acount":"0","views":"0","tags":null,"content":"here goes an answer","netvotes":"0","updated":null,"created":"1498056746"},{"title":null,"postid":"16","acount":"0","views":"0","tags":null,"content":"answer test content","netvotes":"0","updated":null,"created":"1498056517"},{"title":null,"postid":"9","acount":"0","views":"0","tags":null,"content":"Answer2 on the test question","netvotes":"0","updated":null,"created":"1497697943"},{"title":null,"postid":"2","acount":"0","views":"0","tags":null,"content":"answer test test","netvotes":"1","updated":null,"created":"1497455825"}]}}


CREATE QUESTION API
--------------------

Creates a question for then loggedin user and returns the post id. if a user is not logged in, returns an error.

Sample Input

{ "requestHeader": { "serviceId":"111", "interactionCode":"CREATEQUESTION"}, "requestBody" : { "userid" : "1", "title" : "One test", "content" : "test content", "tags" : "tag1, tag2" }}

Sample Output

{"responseHeader":{"serviceId":"111","status":"200","message":"Question Added"},"responseBody":{"userid":"16","postid":15}}

WRITE ANSWER API
-----------------

Write an answer to a question for the loggedin user and returns the post id. if a user is not logged in, returns an error.

Sample Input

{ "requestHeader": { "serviceId":"111", "interactionCode":"WRITEANSWER"}, "requestBody" : { "userid" : "1", "content" : "test content", "parentpostid" : "1" }}

Sample Output

{"responseHeader":{"serviceId":"111","status":"200","message":"Question Added"},"responseBody":{"userid":17,"postid":19}}

WRITE COMMENT API
------------------

Write a comment to an answer for the loggedin user and returns the post id. if a user is not logged in, returns an error.

Sample Input

{ "requestHeader": { "serviceId":"111", "interactionCode":"WRITECOMMENT"}, "requestBody" : { "userid" : "1", "content" : "test content", "parentpostid" : "1" }}

Sample Output

{"responseHeader":{"serviceId":"111","status":"200","message":"Answer added"},"responseBody":{"userid":"17","postid":22}}

UPDATE PROFILE API
--------------------

Updates the user's email, location, fullname and avatar against a specified user_id. if the user_id is not specified, the API shows an error.

Sample Input

{ "requestHeader": { "serviceId":"111", "interactionCode":"UPDATEPROFILE" }, "requestBody" : { "user_id" : "1", "email_id" : "anoop@helloinfinity.com", "location" : "alappuzha", "full_name" : "Anoop Anson", "avatar" : "avatar-here"} }

Sample Output

{"responseHeader":{"status":"200","serviceId":"111","message":"Updated!"}}


VIEW PROFILE API
-----------------

View user's FullName, Username, Email, Location and avatar when userid is passed as an argument.

Sample Input

{ "requestHeader": { "serviceId":"111", "interactionCode":"VIEWPROFILE" }, "requestBody" : { "user_id" : "1" } }

Sample Output

{"responseBody":{"user_fullname":"Anoop Anson","user_location":"alappuzha","user_name":"admin","user_email":"anoop@helloinfinity.com","user_avatarurl":"http://renalbiomed.com/api/avatar/1.png"},"responseHeader":{"status":"200","serviceId":"111","message":"Success"}}


UPDATE POST API
-----------------
Update QUESTION, ANSWER, COMMENT or any other post type using postid

Sample Input

{ "requestHeader": { "serviceId":"111", "interactionCode":"UPDATEPOST"}, "requestBody" : { "postid" : "1", "postitle" : "update post title", "postcontent" : "update content", "posttags" : "tag1 update, tag2 update" }}

Sample Output

{"responseHeader":{"serviceId":"111","status":"200"},"responseBody":{"message":"Successfully updated!"}}


DELETE POST API
----------------
Delete QUESTION, ANSWER, COMMENT or any other post type using postid.

Sample Input

{ "requestHeader": { "serviceId":"111", "interactionCode":"DELETEPOST"}, "requestBody" : { "postid" : "27" }}

Sample Output

{"responseHeader":{"serviceId":"111","status":"200"},"responseBody":{"message":"Successfully deleted!"}}

Voting API
-----------
Upvote or downvote a question. To upvote, specify 'vote' value as '1' and to downvote, specify 'vote' value as '0'

Sample Input

{ "requestHeader": { "serviceId":"111", "interactionCode":"VOTE" }, "requestBody" : { "userid" : "1", "postid" : "1", "vote" : "1" } }

Sample Output

{"responseHeader":{"serviceId":"111","status":"200","message":"User Logged in"},"responseBody":{"username":"anoopanson","userid":"4"}}

Search API
-----------
Find questions with occurance of the given string

Sample Input

{ "requestHeader": { "serviceId":"111", "interactionCode":"SEARCH" }, "requestBody" : { "inquery" : "test", "count" : "21", "userid" : "1" } }

Sample Output

{"responseHeader":{"serviceId":null,"status":"200"},"responseBody":{"result":[{"title":"update post title","postid":"1","userid":"1","acount":"7","views":"1","tags":"tag1 update, tag2 update","netvotes":"1","created":"1497455725"},{"title":"One test","postid":"15","userid":"16","acount":"0","views":"1","tags":"tag1,tag2","netvotes":"0","created":"1498039876"},{"title":"One test","postid":"13","userid":"16","acount":"0","views":"1","tags":"tag1,tag2","netvotes":"0","created":"1498039537"},{"title":"test one","postid":"11","userid":"16","acount":"0","views":"1","tags":"test1","netvotes":"0","created":"1498039316"},{"title":"One test","postid":"14","userid":"16","acount":"0","views":"0","tags":"tag1,tag2","netvotes":"0","created":"1498039791"},{"title":"One test","postid":"12","userid":"16","acount":"0","views":"0","tags":"","netvotes":"0","created":"1498039467"}]}}

CHECK VOTE API
---------------
Check if a user has voted for a specific postid. if voted, return stats.

Sample Input

{ "requestHeader": { "serviceId":"111", "interactionCode":"CHECKVOTE" }, "requestBody" : { "user_id" : "1", "post_id" : "21" } }

Sample Output

{"responseHeader":{"status":"204","serviceId":"111","message":"User hasn't voted for this post"}}