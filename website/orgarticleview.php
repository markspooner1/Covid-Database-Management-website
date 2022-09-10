<?php
include 'header1.php';
require_once 'database.php';
$userID = $_SESSION['userId'];
//select oID from employeeOfOrg WHERE uID = $userID;
//select oName FROM organization WHERE organization.oID IN (select oID from employeeOfOrg WHERE uID = 9);
//SELECT majorT from article WHERE author in (select oName FROM organization WHERE organization.oID IN (select oID from employeeOfOrg WHERE uID = 9));
$orgsArts =  "SELECT aID, majorT, minorT, summary, articleContent, dop from article WHERE author in (select oName FROM organization WHERE organization.oID IN (select oID from employeeOfOrg WHERE uID = $userID))";
$result = $conn->query($orgsArts);
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
    <h1>List of Articles for your organization</h1>
    <table>
        <thead>
        <tr>
        <td><b>aID</b></td>
            <td><b> majorT</b></td>
            <td><b>minorT</b></td>
            <td><b>summary</b></td>
            <td><b>articleContent</b></td>
            <td><b>dop</b></td>
        </tr>
        </thead>
        <tbody>
        <?php
         if($result->num_rows > 0){
                while ($row = $result->fetch_assoc()){ ?>
                <tr>
                    <td> <?php echo  $row["aID"];?> </td>
                    <td> <?php echo  $row["majorT"];?> </td>
                    <td> <?php echo  $row["minorT"];?> </td>
                    <td> <?php echo  $row["summary"];?> </td>
                    <td> <?php echo  $row["articleContent"];?> </td>
                    <td> <?php echo  $row["dop"];?> </td>
                    <td>
                        <a href="./deletearticle.php?aID=<?=$row["aID"] ?>">Delete</a>
                        <a href="./editarticle.php?aID=<?=$row["aID"]?>">Edit</a>
                    </td>
                </tr>
        <?php   }    ?>
        <?php   }else{ echo "No articles associated with your organization were found";  } ?>
        </tbody>
    </table>

</body>
</html>
