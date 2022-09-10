<?php 
include 'header1.php';
include 'database.php';

$uname = $_GET['username'];
$hc = $_GET['healthcard'];
$dose = $_GET['doses'];
$vacc = $_GET['cars'];
$date = $_GET['dateOf'];
$clinic = $_GET['clinic'];
$sql = "INSERT INTO VaccAppointment VALUES('$uname', '$hc', '$dose', '$vacc', '$date', '$clinic');";
//$sql = "insert into VaccAppointment VALUES('".$_GET['username']."','".$_GET['healthcard']."', '".$_GET['doses']."', '".$_GET['cars']."', '"$_GET['dateOf']"','"$_GET['clinic']"'";
if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql2 = "SELECT username, dose, vaccine, appDate, clinic FROM VaccAppointment ORDER BY appDate";
$result = $conn->query($sql2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
	    <style>
 
	  table, th, td {
                 border: 1px solid;
        }
		</style>
</head>
<body>
<h3>Thank you for registering for your <u><?php echo $_GET['doses']?></u> dose, vaccine: <u><?php echo $_GET['cars']?></u> See you
on <u><?echo $_GET['dateOf']?></u> @ <u><? echo $_GET['clinic']?></u> clinic
</h3>
   <br><br>
   <h4>List of appointments</h4>
   <table>
        <thead>
        <tr>
            <td><b>username</b></td>
            <td><b>dose</b></td>
            <td><b>vaccine</b></td>
            <td><b>Date</b></td>
            <td><b>Clinic</b></td>
  	 </tr>
        </thead>
	 <tbody>
        <?php
         if($result->num_rows > 0){
                while ($row = $result->fetch_assoc()){ ?>
                <tr>
                        <td> <?php echo  $row["username"];?> </td>
                        <td> <?php echo  $row["dose"];?> </td>
                        <td> <?php echo  $row["vaccine"];?> </td>
                	<td> <?php echo  $row["appDate"];?> </td>
                        <td> <?php echo  $row["clinic"];?> </td>
     
		</tr>
        <?php   }   ?>
        <?php   }   ?>

        </tbody>
    </table>
             
</body>
</html>
