<?php
include 'header1.php';
require_once 'database.php';
$aID = $_GET['aID'];
$userID = $_SESSION['userId'];

//select fName, lName FROM users WHERE users.uID = $userID;
//select author from article where aID = $aID;
$FnameLname = "select fName, lName FROM users WHERE users.uID = $userID;";
$result = $conn->query($FnameLname);
$author = "select author from article where aID = $aID;";
$result2 = $conn->query($author);
$row = $result->fetch_assoc();
$row2 = $result2->fetch_assoc();
$CurrentUser = $row['fName'] . " " . $row['lName'];
$Author1 = $row2['author'];
if($CurrentUser != $Author1 && !isset($_SESSION['Administrator'])){
	echo "you do not have permission to delete this article";
	exit;

}
$sql_delete = "DELETE FROM article  WHERE aID =  '".$aID."'";
$bye = $conn->query($sql_delete);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>
<h1>Article deleted, go to previous page to see your changes</h1>
</body>
