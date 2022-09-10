<?php include 'header1.php';
      require 'database.php';
     $userID = $_SESSION['userId'];
       
      $usersCountry = "SELECT cID from country WHERE cID IN (SELECT cID FROM users where uID = ".$userID.")";
     $result = $conn->query($usersCountry);
      if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$country = $row['cID'];
	$country_records = "select recID, pstName, infected, dead, dateOf from pstRecord,proStaTer WHERE pstRecord.pstID = proStaTer.pstID AND
	 pstRecord.pstID IN (SELECT pstID FROM proStaTer WHERE cID = 16)
 	ORDER BY dateOf";

	$result2 = $conn->query($country_records);
				
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
    <p><a href="">add</a> a new record</p>
    <table>
        <thead>
        <tr>
            <td><b>recID</b></td>
            <td><b>ProStater</b></td>
            <td><b>Infected</b></td>
            <td><b>dead</b></td>
            <td><b>dateOf</b></td>
        </tr>
        </thead>
        <tbody>
        <?php
         if($result2->num_rows > 0){
                while ($row2 = $result2->fetch_assoc()){ ?>
                <tr>
                        <td> <?php echo  $row2["recID"];?> </td>
                        <td> <?php echo  $row2["pstName"];?> </td>
                        <td> <?php echo  $row2["infected"];?> </td>
                        <td> <?php echo  $row2["dead"];?> </td>
                        <td> <?php echo  $row2["dateOf"];?></td>
                         <td>
                        <a href="./deleterecord.php?record=<?=$row2["recID"]?>"> Delete</a>
			<a href="./editrecord.php?record=<?=$row2["recID"]?>">Edit</a>

                    </td>  
              </tr>
        <?php   }   ?>
        <?php   }   ?>

        </tbody>
    </table>
    <a href = "index.php">back to homepage</a>
</body>
</html>
                     







