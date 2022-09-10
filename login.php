<?php include 'header1.php';
      include 'database.php';
      if(isset($_POST['username']) && isset($_POST['password']) ){
	$uname = $_POST['username'];
	$password = $_POST['password'];
	$sql = "select username, pwd, uID from specialUser WHERE username ='".$uname."' AND pwd ='".$password."'";
	$priv = "select privName from privilege, users,specialUser
		WHERE username = '".$uname."' AND users.uID = specialUser.uID AND users.privID = privilege.privID;";
	$result = $conn->query($sql);
	$privresult = $conn->query($priv);
	$resultt = $result->fetch_assoc();
	$test = $privresult->fetch_assoc();
	if($result->num_rows == 1){
		echo"login success";
		session_start();
                $_SESSION['userName'] = $uname;
		$_SESSION['userId'] = $resultt['uID'];   
//         		header('Location: index.php');
		echo ", you have " . $test["privName"] .  " priveleges" ;
		$_SESSION[$test["privName"]] = "active";
		exit;	
	}else echo "login not found in the DB";
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
	
<form action="login.php" method="post">
	Username: <input type="text" name="username"><br>
	Password: <input type="password" name="password"><br>
<input type="submit">
</form>
</body>
</html>
