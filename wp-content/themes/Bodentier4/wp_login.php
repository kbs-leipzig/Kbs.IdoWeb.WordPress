<?php
//temporary site for POST requests with JWTToken from login
//sets JWTToken-cookie, used for permission checks
//if WordPress & corenet are on same domain, only one JWTToken is used automatically
 $data = json_decode(file_get_contents('php://input'), true);
 if (setcookie ( "JWTToken" , $data["token"] , time()+360*24*14, "/", ".bodentierhochvier.de", FALSE , TRUE ))
	echo "ok";
 else
	echo "failed";
?>