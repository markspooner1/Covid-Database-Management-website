<?php
      include 'header1.php';
      include 'database.php';
      $userID = $_GET['username'];
      if(isset($_POST['uName']) && isset($_POST['fName']) && isset($_POST['lName']) && isset($_POST['Email']) && isset($_POST['DOB']) && isset($_POST['status'])){
	echo "test";
        $uName = $_POST['uName'];
        $fName = $_POST['fName'];
        $lName = $_POST['lName'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $DOB = $_POST['DOB'];
        $status = $_POST['status'];
	$sql = "UPDATE specialUser
                SET username = '".$uName."' WHERE specialUser.uID = '".$userID."'" ;
        $result = $conn->query($sql);
	$sql2 = "UPDATE users SET fName ='".$fName."', lName = '".$lName."', email = '".$email."', phone = '".$phone."', DOB = '".$DOB."', status = '".$status."' WHERE users.uID = '".$userID."'";
	$result2 = $conn->query($sql2);
      }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="edituser.php?username=<?=$userID?>"  method="post">
    <h1>Updating user#: <?php  echo $_GET['username'] ?></h1>
    <label for="uName">UserName</label><br>
    <input type="text" name = "uName" id = "uName"> <br>

    <label for="fName">First Name</label><br>
    <input type="text" name = "fName" id = "fName"> <br>

    <label for="lName">Last Name</label><br>
    <input type="text" name = "lName" id = "lName"> <br>

    <label for="Email">Email</label><br>
    <input type="text" name = "Email" id = "Email"> <br>

    <label for="phone">Phone</label><br>
    <input type="text" name = "phone" id = "phone"> <br>

    <label for="DOB">DOB</label><br>
    <input type="date" name = "DOB" id = "DOB"> <br>


    <label for="status">Status</label><br>
    <input type="text" name = "status" id = "status"> <br>

<input type="Submit" value = "update">
</form>

</body>
</html>

