<?php
include 'header1.php';
require_once 'database.php';
$sql = "SELECT privName, username, fName, lName, cName, email, phone, sr.dateTimeOf as 'dates'
FROM privilege, users, specialUser, country, suspensionRecord sr
WHERE users.privID = privilege.privID AND users.cID = country.cID AND specialUser.uID = users.uID AND users.status = 'suspended' AND users.uID = sr.uID
order by dateTimeOf asc;";
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
  <h1>Users suspended</h1>
    <div>
    </div><br><br>
    <table>
    <thead>
        <tr>
            <td><b>privName</b></td>
            <td><b>username</b></td>
            <td><b>First Name</b></td>
            <td><b>Last Name</b></td>
            <td><b>Country</b></td>
            <td><b>Email</b></td>
            <td><b>phone</b></td>
            <td><b>Suspension date</b></td>
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
                        <td> <?php echo  $row["cName"];?> </td>
                        <td> <?php echo  $row["email"];?> </td>
                        <td> <?php echo  $row["phone"];?> </td>
                        <td> <?php echo  $row["dates"];?> </td>
                </tr>
        <?php   }   ?>
        <?php   }   ?>

        </tbody>
    </table>
    <a href = "index.php">back to homepage</a>
</body>
</html>


