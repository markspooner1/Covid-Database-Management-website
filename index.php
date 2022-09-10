<?php include 'header1.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C19PPS</title>
</head>
<body>
      <div style="float:right; background-color:red;">
    <?php if(isset($_SESSION['userName'])){
        echo "You are logged in as: " . $_SESSION['userName'];
    }?>
    </div>
    <h1>Welcome to: <u>COVID-19 Pandemic Progress System (C19PPS) </u> </h1>
    <p>Subscribe to authors <a href = "subscription.php">here</a>
    <p>Choose from the following following predefined queries to our DB: </p>
    <a href="users.php">(Query 10)</a><br>
    <a href="Query11.php">(Query 11)</a><br>
    <a href="Query12.php">(Query 12</a><br>
    <a href="Query13.php">(Query 13)</a><br>
    <a href="Query14.php">(Query 14</a><br>
    <a href="Query15.php">(Query 15)</a><br>
    <a href="Query16.php">(Query 16)</a><br>
    <a href="Query17.php">(Query 17)</a><br>
    <a href="Query18.php">(Query 18)</a><br>
    <a href="Query19.php">(Query 19)</a><br>
    <a href="Query20.php">(Query 20)</a><br>

    <br><br>

    <p>Register for your Covid Vaccine<a href = "specialfeature.php">here</a></p>
</body>
</html>
