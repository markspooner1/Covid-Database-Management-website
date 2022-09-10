<?php
include 'header1.php';
require_once 'database.php';
if(!isset($_SESSION["Administrator"])){
        echo "you dont have permission to view this page";
        exit;
}
$sql = "SELECT users.uID, username, fName, lName FROM specialUser, users
WHERE users.uID = specialUser.uID AND users.status <> 'suspended'";
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
    <table>
        <thead>
        <tr>
        <td><b>uID</b></td>
            <td><b>Username</b></td>
            <td><b>First Name</b></td>
            <td><b>Last Name</b></td>
        </tr>
        </thead>
        <tbody>
        <?php
         if($result->num_rows > 0){
                while ($row = $result->fetch_assoc()){ ?>
                <tr>
                    <td> <?php echo  $row["uID"];?> </td>
                    <td> <?php echo  $row["username"];?> </td>
                    <td> <?php echo  $row["fName"];?> </td>
                    <td> <?php echo  $row["lName"];?> </td>
                    <td>
                        <a href="./deleteuser.php?username=<?=$row["uID"] ?>">Delete</a>
                        <a href="./edituser.php?username=<?=$row["uID"]?>">Edit</a>

                    </td>
                </tr>
        <?php   }   ?>
        <?php   }   ?>

        </tbody>
    </table>

</body>
</html>
