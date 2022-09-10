<?php
include 'header1.php';
require_once 'database.php';
if(!isset($_SESSION['userName'])){
	echo "please login to subscribe to an author";
	exit;

}
$result = $conn->query("SELECT distinct  author from article");
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
   <table>
        <thead>
        <tr>
        <td><b>Author's in the system</b></td>
	</tr>
	</thead>
 <tbody>
        <?php
         if($result->num_rows > 0){
                while ($row = $result->fetch_assoc()){ ?>
                <tr>
                    <td> <?php echo  $row["author"];?> </td>
                  
                    <td>
                        <a href="./subscribeTo.php?author=<?=$row["author"]?>">subscribe to</a>
                    </td>
                </tr>
        <?php   }   ?>
        <?php   }   ?>

        </tbody>
    </table>
 
</body>
</html>
