Login / Signup / Resigtation API
---------------------------------

Registers a user and signs him/her up using the social login.

Sample Input

{ "requestHeader": { "serviceId":"111", "interactionCode":"LOGIN" }, "requestBody" : { "email" : "anoop@helloinfinity.com", "identifier" : "akm1kskdjbgasane", "username" : "anoopanson", "source" : "facebook" } }

Sample Output

{"responseHeader":{"serviceId":"111","status":"200","message":"User Logged in"},"responseBody":{"username":"anoopanson","userid":"4"}}


GET QUESTIONS API
------------------

Gets all of the questions and its details in order they are posted.

Sample Input

{ "requestHeader": { "serviceId":"111", "interactionCode":"GETQUESTIONS" }}

Sample Output

{"responseHeader":{"serviceId":"111","status":"200"},"responseBody":{"questions":[{"title":"question with image test","userid":"1","postid":"27","acount":"0","views":"1","content":"<p><img alt=\"\" src=\"https://www.w3schools.com/css/img_fjords.jpg\" style=\"height:400px; width:600px\">image goes here with text</p>","tags":"image","netvotes":"0","updated":null,"created":"1500354649","favorite":"27"},{"title":"Question title1","userid":"17","postid":"21","acount":"1","views":"1","content":"Question content","tags":"tag1,tag2","netvotes":"0","updated":null,"created":"1498057186","favorite":null},{"title":"One test","userid":"16","postid":"15","acount":"0","views":"1","content":"test content","tags":"tag1,tag2","netvotes":"0","updated":null,"created":"1498039876","favorite":null},{"title":"One test","userid":"16","postid":"14","acount":"0","views":"1","content":"test content","tags":"tag1,tag2","netvotes":"0","updated":null,"created":"1498039791","favorite":null},{"title":"One test","userid":"16","postid":"13","acount":"0","views":"1","content":"test content","tags":"tag1,tag2","netvotes":"0","updated":null,"created":"1498039537","favorite":null},{"title":"One test","userid":"16","postid":"12","acount":"0","views":"0","content":null,"tags":"","netvotes":"0","updated":null,"created":"1498039467","favorite":null},{"title":"test one","userid":"16","postid":"11","acount":"0","views":"1","content":"test content","tags":"test1","netvotes":"0","updated":null,"created":"1498039316","favorite":null},{"title":"How many movies have the RED Camera been used?","userid":"1","postid":"8","acount":"0","views":"1","content":"In total, worldwide, how many movies have the camera RED been used?","tags":"movie,camera","netvotes":"-2","updated":null,"created":"1497696372","favorite":null},{"title":"23post title to update","userid":"1","postid":"5","acount":"1","views":"1","content":"post content to update","tags":"tag1, tag2","netvotes":"0","updated":null,"created":"1497694735","favorite":null},{"title":"update post title","userid":"1","postid":"1","acount":"7","views":"1","content":"update content","tags":"tag1 update, tag2 update1","netvotes":"-1","updated":null,"created":"1497455725","favorite":"1"}]}}


GET QUESTION DETAIL API
-----------------------

Gets the question and answers to a specific question.

Sample Input

{ "requestHeader": { "serviceId":"111", "interactionCode":"GETQUESTIONDETAIL"}, "requestBody" : { "questionid" : "1", "user_id" : "user" }}

Sample Output

{"responseHeader":{"serviceId":"111","status":"200"},"responseBody":{"question":[{"title":"update post title","acount":"7","userid":"1","views":"1","tags":"tag1 update, tag2 update1","content":"update content","selchildid":"16","netvotes":"-1","updated":null,"created":"1497455725","answered":"yes"}],"answers":[{"title":null,"postid":"20","userid":"1","acount":"0","views":"0","tags":null,"content":"?one ?one ?one ?one ?one ?one ?one ?one","netvotes":"0","updated":null,"created":"1498057104"},{"title":null,"postid":"19","userid":"17","acount":"0","views":"0","tags":null,"content":"here goes an another another answer","netvotes":"0","updated":null,"created":"1498056816"},{"title":null,"postid":"18","userid":"17","acount":"0","views":"0","tags":null,"content":"here goes an another answer","netvotes":"0","updated":null,"created":"1498056770"},{"title":null,"postid":"17","userid":"17","acount":"0","views":"0","tags":null,"content":"here goes an answer","netvotes":"0","updated":null,"created":"1498056746"},{"title":null,"postid":"16","userid":"17","acount":"0","views":"0","tags":null,"content":"answer test content","netvotes":"0","updated":"1500285887","created":"1498056517"},{"title":null,"postid":"9","userid":"1","acount":"0","views":"0","tags":null,"content":"Answer2 on the test question","netvotes":"0","updated":null,"created":"1497697943"},{"title":null,"postid":"2","userid":null,"acount":"0","views":"0","tags":null,"content":"answer test test","netvotes":"-1","updated":null,"created":"1497455825"}]}}

CREATE QUESTION API
--------------------

Creates a question for then loggedin user and returns the post id. if a user is not logged in, returns an error.

Sample Input

{ "requestHeader": { "serviceId":"111", "interactionCode":"CREATEQUESTION"}, "requestBody" : { "userid" : "2", "title" : "One test", "content" : "test content", "categoryid" : "1", "tags" : "tag1, tag2" }}

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

{ "requestHeader": { "serviceId":"111", "interactionCode":"UPDATEPOST"}, "requestBody" : { "postid" : "5", "postitle" : "update post title 5", "postcontent" : "update content5", "posttags" : "tag1 update, tag2 update", "categoryid" : "1" }}

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

Find questions with occurance of the given string.

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

GET USER QUESTIONS API
----------------------

Gets all of the questions and its details created by a specific user in order they are posted.

Sample Input

{ "requestHeader": { "serviceId":"111", "interactionCode":"GETUSERQUESTIONS", "user_id" : "1" }}

Sample Output

{"responseHeader":{"serviceId":"111","status":"200"},"responseBody":{"questions":[{"title":"How many movies have the RED Camera been used?","userid":"1","postid":"8","acount":"0","views":"1","content":"In total, worldwide, how many movies have the camera RED been used?","tags":"movie,camera","netvotes":"0","updated":null,"created":"1497696372"},{"title":"23post title to update","userid":"1","postid":"5","acount":"1","views":"1","content":"post content to update","tags":"tag1, tag2","netvotes":"0","updated":null,"created":"1497694735"},{"title":"update post title","userid":"1","postid":"1","acount":"7","views":"1","content":"update content","tags":"tag1 update, tag2 update1","netvotes":"1","updated":null,"created":"1497455725"}]}}

GET TAGS API
--------------------

Get tag suggestions like the one user entered.

Sample Input

{ "requestHeader": { "serviceId":"111", "interactionCode":"GETTAGS"}, "requestBody" : { "keyword" : "ag" }}

Sample Output

{"responseHeader":{"serviceId":"111","status":"200"},"responseBody":{"questions":[{"wordid":"54","word":"tag2","titlecount":"0","contentcount":"0","tagwordcount":"4","tagcount":"4"},{"wordid":"53","word":"tag1","titlecount":"0","contentcount":"0","tagwordcount":"4","tagcount":"4"}]}}

SET BEST ANSWER API
--------------------

Set best answer amoung the existing answers.

Sample Input

{ "requestHeader": { "serviceId":"111", "interactionCode":"SETBESTANSWER"}, "requestBody" : { "questionid" : "1", "answerid" : "2", "userid" : "1" }}

Sample Output

{"responseHeader":{"serviceId":"111","status":"200","message":"Success"}}

SAVE IMAGE API
----------------

Save images to server and return a url.

Sample Input

{ "requestHeader": { "serviceId":"111", "interactionCode":"SAVEIMAGE"}, "requestBody" : { "base64data" : "1"}}

Sample Output

{"responseHeader":{"serviceId":"111","status":"200","message":"Wrote Image"},"responseBody":{"Url":"http://renalbiomed.com/api/post/G3mRScNF.png"}}

FAVORITE SET/CLEAR API
-----------------------

Sets/clears a post item as favorite.

Sample Input

{ "requestHeader": { "serviceId":"111", "interactionCode":"FAVORITE"}, "requestBody" : { "userid":"1", "posttype" : "Q", "postid" : "27", "favorite" : "1" }}

Sample Output

{"responseHeader":{"serviceId":"111","status":"200","message":"Favorite Added"}}

GET USER FAVORITES API
-----------------------

Get the user's favourite posts.

Sample Input

{ "requestHeader": { "serviceId":"111", "interactionCode":"GETUSERFAVORITES"}, "requestBody" : { "userid" : "2"}}

Sample Output

{"responseHeader":{"serviceId":"111","status":"200"},"responseBody":{"questions":[{"title":"question with image test","userid":"1","postid":"27","acount":"0","views":"1","content":"<p><img alt=\"\" src=\"https://www.w3schools.com/css/img_fjords.jpg\" style=\"height:400px; width:600px\">image goes here with text</p>","tags":"image","netvotes":"0","updated":null,"created":"1500354649","favorite":"1"},{"title":"update post title","userid":"1","postid":"1","acount":"7","views":"1","content":"update content","tags":"tag1 update, tag2 update1","netvotes":"-1","updated":null,"created":"1497455725","favorite":"1"}]}}

GET CATEGORIES API
-------------------

Get categories and its associated details.

Sample Input

{ "requestHeader": { "serviceId":"111", "interactionCode":"GETCATEGORIES"} }

Sample Output

{"responseHeader":{"serviceId":"111","status":"200"},"responseBody":{"categories":[{"categoryid":"1","parentid":null,"title":"Category 1","tags":"category-1","content":"category 1 description","qcount":"1","position":"1","backpath":"category-1"},{"categoryid":"2","parentid":null,"title":"Category 2","tags":"category-2","content":"Category 2 description","qcount":"0","position":"2","backpath":"category-2"}]}}

GET PAGES API
--------------

Get pages and its associated details.

Sample Input

{ "requestHeader": { "serviceId":"111", "interactionCode":"GETPAGES"} }

Sample Output

{"responseHeader":{"serviceId":"111","status":"200"},"responseBody":{"pages":[{"pageid":"2","title":"Disclaimer","nav":"_","position":"1","flags":"0","permit":"150","tags":"disclaimer","heading":"Disclaimer","content":"Disclaimers have a long legal history. They generally have two purposes:\r\n\r\nTo warn\r\nTo limit liability\r\nA warning sign is likely the earliest and easiest manifestation of a disclaimer.\r\n\r\nNo trespassing alerts passing individuals that they are near a private land boundary and also excuses the landowner of some liability if people visit uninvited.\r\n\r\nSometimes, the warning and limitation of liability are based on statutory law. For example, the state of Washington in the United States has a law that prevents people injured at equestrian facilities from pursuing legal damages.\r\n\r\nAny business that boards, trains or allows the riding of horses has to have a specific sign to enjoy this protection from liability. This sign acts as a disclaimer much like a No trespassing sign in that it informs and specifies limits on facility responsibilities"}]}}