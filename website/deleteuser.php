<?php
include 'header1.php';
require_once 'database.php';
$userID = $_GET['username'];
$sql_delete = "DELETE FROM specialUser WHERE uID =  '".$userID."'";
$result = $conn->query($sql_delete);
$sql_delete2 = "DELETE FROM users WHERE uID = '".$userID."'";
$result2 = $conn->query($sql_delete2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        table, th, td {
                 border: 1px solid;
        }
</style>
</head>
<body>
    <h1>User has been deleted, go to previous page to view your changes</h1>

</body>
</html>
