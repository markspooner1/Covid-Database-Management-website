<?php
include 'header1.php';
require_once 'database.php';
if(isset($_POST["aID"]) && isset($_POST["author"]) && isset($_POST["majorT"]) && isset($_POST["minorT"]) && isset($_POST["summary"]) &&
    isset($_POST["content"]) &&  isset($_POST["pod"])){
        $aID = $_REQUEST['aID'];
        $author = $_REQUEST['author'];
        $majorT =  $_REQUEST['majorT'];
        $minorT = $_REQUEST['minorT'];
        $summary = $_REQUEST['summary'];
        $content = $_REQUEST['content'];
        $pod = $_REQUEST['pod'];
	$status = $_REQUEST['status'];
        $sql = "INSERT INTO article VALUES ('$aID', '$author','$majorT','$minorT','$summary', '$content', '$pod', '$status');";
	if($conn->query($sql) === TRUE) {
  	//	echo "New record created successfully";
	} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$userID = $_SESSION["userId"];
	$FnameLname = "select fName, lName FROM users WHERE users.uID = $userID;";
	$result = $conn->query($FnameLname);
	$row = $result->fetch_assoc();
	$CurrentUser = $row['fName'] . " " . $row['lName'];
	$CheckSubs = "SELECT username from followers where author = '$CurrentUser'";
	$result2 = $conn->query($CheckSubs);
	// Really bad variable naming because i was so tired lol sorry 
	if ($result2->num_rows > 0) {
		$row = $result2->fetch_assoc();
		$usersubbed = $row['username'];
		$userEmail = "SELECT email FROM users WHERE users.uID in (SELECT uID FROM specialUser WHERE username = '$usersubbed')";
		$result3 = $conn->query($userEmail);
		$row4 = $result3->fetch_assoc();
		$test = $_REQUEST['pod'];
	       	$theemail = $row4['email'];
  	
	     	$emailbeingsent = "INSERT INTO emailRecord(dateOf, email, subject, body) VALUES('$test', '$theemail', 'New article!', 'hi  " . $CurrentUser ." has released a new article check your email')";
		
		if ($conn->query($emailbeingsent) === TRUE) {
 	//		 echo " and email sent";
			} else {
 				 echo "Error: " . $sql . "<br>" . $conn->error;
			}
	}	
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
</head>
<body>
   <b>an email will be sent to your subscribers (if you have any) notifying them of your new article</b>
 
   <form action = "createarticle.php" method = "post">
        <label for="aID">Article's ID</label> <br>
        <input type="number" name = "aID" id = "aID"><br>

        <label for="author">Author</label><br>
        <input type="text" name = "author" id = "author"><br>

        <label for="majorT">Major Topic</label><br>
        <textarea type="text" rows="5" cols="40" name = "majorT" id = "majorT"></textarea><br>

        <label for="minorT">Minor Topic</label><br>
        <textarea type="text" rows="5" cols="40"name = "minorT" id = "minorT"></textarea><br>


        <label for="summary">Summary</label><br>
        <textarea type="text" rows="5" cols="40" name = "summary" id = "summary" ></textarea><br>

        <label for="content">Content</label><br>
	<textarea type="text" rows="5" cols="40" name = "content" id = "content"></textarea> <br>


        <label for="pod">Publish Date</label><br>
        <input type="date" name = "pod" id = "pod"><br>
	

	<label for "status">Status</label><br>
	<input type = "text" name = "status" id = "status">	
        <button type = "submit">Add</button>       
</body>
</html>
