<?php 
session_start() 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .topnav {
        background-color: #333;
        overflow: hidden;
        }
        .topnav a {
        float: left;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
        }
        .topnav a:hover {
        background-color: #ddd;
        color: black;
        }
        body {
        background-color: #DBF9FC;
        font-family: Georgia, serif;
        }
    </style>
</head>
<body>

  <div class="topnav">
        <a href="index.php">Home</a>
        <a href="admin.php">Admin page</a>
        <a href="researcher.php">Researcher page</a>
        <a href="delegate.php">Delegate/Org page</a>
        <a href="login.php">Login</a>
	<a href="logout.php">Logout</a>
    </div>
</body>
</html>
