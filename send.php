<!DOCTYPE html>
<html lang="en">
	<head>
		<title></title>
	</head>
	<body>
		<h4>SENT TO CLIENT</h4>
		<button id="btnfun1" name="btnfun1" onClick='location.href="?button1=1"'>Submission Processed</button><br><br>
		<button id="btnfun2" name="btnfun2" onClick='location.href="?button2=1"'>Submission Rejected</button><br><br>
		<button id="btnfun3" name="btnfun3" onClick='location.href="?button3=1"'>Submission Accepted</button><br><br><br><br>

		<h4>SENT TO APPROVER</h4>
		<button id="btnfun4" name="btnfun4" onClick='location.href="?button4=1"'>Submission Rejected</button><br><br>

	</body>
</html>

<?php

$botToken = "336125372:AAFgGIRGG6dpoLu-BTqjIB9kQcScyLlhhK0";
$website = "https://api.telegram.org/bot".$botToken;


$chatid = "247653891";


 if(@$_GET['button1']){_submissionprocessed($chatid);}
 if(@$_GET['button2']){_submissionrejected($chatid);}
 if(@$_GET['button3']){_submissionaccepted($chatid);}
 if(@$_GET['button4']){_requesttoapprover($chatid);}
 

function _submissionprocessed($chatid){
	global $website;
	$text = "Your travel submission is being processed.";
	file_get_contents($website."/sendMessage?chat_id=".$chatid."&text=".$text);

	echo "Message has been sent!";
}

function _submissionrejected($chatid){
	global $website;
	$text = "Your travel submission is rejected.";
	file_get_contents($website."/sendMessage?chat_id=".$chatid."&text=".$text);

	echo "Message has been sent!";
}

function _submissionaccepted($chatid){
	global $website;
	$text = "The travel request has been approved.\nPlease complete the required documents and contact the finance department";
	file_get_contents($website."/sendMessage?chat_id=".$chatid."&text=".$text);

	echo "Message has been sent!";
}


function _requesttoapprover($chatid){
	global $website;
	$text = 'You have a travel request that needs to be approved.\nPlease open this <a href="https://batamschool.id/">LINK</a> to open TraZa website.';
	file_get_contents($website."/sendMessage?chat_id=".$chatid."&text=".$text."&parse_mode=html");

	echo "Message has been sent!";
}
?>