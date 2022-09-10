<?php
 include 'header1.php';
 if(!isset($_SESSION["Administrator"])){
	echo"you dont have permission to access this page, please login as admin";
	exit;
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
    
</head>
<body>
    <p>To create a new user click <a href="createuser.php">here</a></p>
    <p>To delete/edit a user click <a href="adminuserview.php">here</a></p>
    <p>To delete/edit an article in the system click <a href="researcherarticleview.php">here</a></p>
</body>
</html>
