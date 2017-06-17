Login / Signup / Resigtation API
---------------------------------

Registers a user and signs him/her up using the social login.

Sample Input

{ "requestHeader": { "serviceId":"111", "interactionCode":"LOGIN" }, "requestBody" : { "email" : "anoop@helloinfinity.com", "identifier" : "akm1kskdjbgasane", "username" : "anoopanson", "source" : "facebook" } }

Sample Output

{"responseHeader":{"serviceId":"111","status":"200","message":"User Logged in"},"responseBody":{"username":"anoopanson"}}


GET QUESTIONS API
------------------

Gets all of the questions and its basic details in order they are posted.

Sample Input

{ "requestHeader": { "serviceId":"111", "interactionCode":"GETQUESTIONS" }}

Sample Output

{"responseHeader":{"serviceId":"111","status":"200"},"responseBody":{"questions":[{"title":"what is the name of sandra bullock's first movie?","userid":"1","postid":"5","acount":"0","views":"1","content":"What is the name of popular hollywood actress sandra bullock's first movie?","tags":"movie,hollywood","netvotes":"0","updated":null,"created":"1497694735"},{"title":"Test question.","userid":"1","postid":"1","acount":"1","views":"1","content":"this is a test question to get answers for API test purpose.","tags":"test,test2","netvotes":"0","updated":null,"created":"1497455725"}]}}


GET QUESTION DETAIL API
----------------------

Gets the answers to a specific question.

Sample Input

{ "requestHeader": { "serviceId":"111", "interactionCode":"GETQUESTIONDETAIL"}, "requestBody" : { "questionid" : "1" }}

Sample Output

{"responseHeader":{"serviceId":"111","status":"200"},"responseBody":{"answers":[{"title":null,"postid":"9","acount":"0","views":"0","tags":null,"content":"Answer2 on the test question","netvotes":"0","updated":null,"created":"1497697943"},{"title":null,"postid":"2","acount":"0","views":"0","tags":null,"content":"answer test test","netvotes":"0","updated":null,"created":"1497455825"}]}}

