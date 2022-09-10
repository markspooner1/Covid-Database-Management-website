<?php
include 'header1.php';
require_once 'database.php';
if(isset($_POST['datelower']) && isset($_POST['dateupper'])){
	$datelower = $_POST['datelower'];
	$dateupper = $_POST['dateupper'];
	$sql = "SELECT er.dateOf, er.email, er.subject 
	from emailRecord er
	WHERE er.dateOf >= '$datelower' AND er.dateOf <= '$dateupper'";
	$result = $conn->query($sql);
}
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
    <h1>Email Record Between Entered Dates</h1>
    <form action="Query18.php" method="POST"  enctype= "multipart/form-data"><br><br>
	<label>
	Lower Bound Date: <br>
	</label>
	<input name="datelower" type="date"> <br>
	<label>Upper Dount Date: <br>
	</label>
	<input name="dateupper" type="date">
	<input type="submit" name="datesend" value="datesend" />
    <table>
        <thead>	
	<tr>  
	    <td><b>DateTime</b></td>
            <td><b>Email</b></td>
            <td><b>Subject</b></td>
        </tr>
	</thead>
	<tbody>
	<?php
	 if($result->num_rows > 0){ 
		while ($row = $result->fetch_assoc()){ ?>
		<tr>		
			<td> <?php echo  $row["dateOf"];?> </td>
			<td> <?php echo  $row["email"];?> </td>
			<td> <?php echo  $row["subject"];?> </td>
		</tr>
	<?php	}   ?>
	<?php	}   ?>

	</tbody>
    </table>
    <a href = "index.php">back to homepage</a>
</body>
</html>
