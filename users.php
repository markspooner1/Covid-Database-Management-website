<?php
include 'header1.php';
require_once 'database.php';
$sql = "SELECT privilege.privName, specialUser.username , users.fName, users.lName, country.cName, users.email, users.phone
FROM privilege, specialUser, users,country
WHERE users.privID = privilege.privID and users.cID = country.cID and users.uID = specialUser.uID
ORDER BY privilege.privName ASC, country.cName ASC";
$result = $conn->query($sql);
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
    <h1>List of Users</h1>
    <br><br>
    <table>
        <thead>	
	<tr>  
	    <td><b>User Role</b></td>
            <td><b>Username</b></td>
            <td><b>First Name</b></td>
            <td><b>Last Name</b></td>
            <td><b>Citizenship</b></td>
            <td><b>Email Address</b></td>
            <td><b>Phone Number</b></td>
        </tr>
	</thead>
	<tbody>
	<?php
	 if($result->num_rows > 0){ 
		while ($row = $result->fetch_assoc()){ ?>
		<tr>		
			<td> <?php echo  $row["privName"];?> </td>
			<td> <?php echo  $row["username"];?> </td>
			<td> <?php echo  $row["fName"];?> </td>
		   	<td> <?php echo  $row["lName"];?> </td>
			<td> <?php echo  $row["cName"];?></td>
			<td> <?php echo  $row["email"];?></td>
			<td> <?php echo  $row["phone"];?></td>
		</tr>
	<?php	}   ?>
	<?php	}   ?>

	</tbody>
    </table>
    <a href = "index.php">back to homepage</a>
</body>
</html>
