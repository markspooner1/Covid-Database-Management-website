<?php include 'header1.php'; 
require_once 'database.php';
if(isset($_POST["userID"]) && isset($_POST["usercID"]) && isset($_POST["userprivID"]) && isset($_POST["userfName"]) &&
    isset($_POST["userlName"]) &&  isset($_POST["userEmail"])  && isset($_POST["userPhone"]) &&  isset($_POST["userDOB"]) &&  isset($_POST["userStatus"])){
	$userID = $_REQUEST['userID'];
        $usercID = $_REQUEST['usercID'];
        $userprivID =  $_REQUEST['userprivID'];
        $userfName = $_REQUEST['userfName'];
        $userlName = $_REQUEST['userlName'];
        $userEmail = $_REQUEST['userEmail'];
        $userPhone = $_REQUEST['userPhone"'];
        $userDOB = $_REQUEST['userDOB'];
        $userStatus = $_REQUEST['userStatus'];
	$userName = $_REQUEST['username'];
        $sql = "INSERT INTO users  VALUES ('$userID', '$usercID','$userprivID','$userfName','$userlName', '$userEmail', '$userPhone', '$userDOB', '$userStatus');";

	$conn->query($sql);
	$sql2 = "INSERT INTO specialUser(uID, username) VALUES ('$userID', '$userName')";
	 $conn->query($sql2); 
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
    <form action = "createuser.php" method = "post">
        <label for="userID">User's ID</label> <br>
        <input type="number" name = "userID" id = "userID"><br>
	

	<label for ="username">Username</label><br>
	<input type = "text" name = "username" id = "username"><br>
  
        <label for="usercID">User's citizenship ID</label><br>
        <input type="number" name = "usercID" id = "usercID"><br>

        <label for="userprivID">User's Privelege ID</label><br>
        <input type="number" name = "userprivID" id = "userprivID"><br>


        <label for="userfName">User's First Name</label><br>
        <input type="text" name = "userfName" id = "userfName"><br>


        <label for="userlName">User's Last Name</label><br>
        <input type="text" name = "userlName" id = "userlName"><br>

        <label for="userEmail">User's email</label><br>
        <input type="email" name = "userEmail" id = "userEmail"><br>


        <label for="userPhone">User's phone</label><br>
        <input type="text" name = "userPhone" id = "userPhone"><br>


        <label for="userDOB">User's DOB</label><br>
        <input type="date" name = "userDOB" id = "userDOB"><br>


        <label for="userStatus">User's Status</label><br>
        <input type="text" name = "userStatus" id = "userStatus"><br>

        <button type = "submit">Add</button>


    
</body>
</html>

