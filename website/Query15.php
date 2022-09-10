<?php
include 'header1.php';
require_once 'database.php';
$sql = "select * from (
    SELECT author, country.cName as 'citizenship', count(article.aID) as 'total number of publication'
    FROM article, users, country
    WHERE article.author = concat(users.fName, ' ',users.lName) AND  country.cID = users.cID
    group by country.cName
    union all
    SELECT author, country.cName as 'citizenship', count(article.aID) as 'total number of publication'
    FROM article, country, govOfCountry, organization
    WHERE article.author = organization.oName AND organization.oID = govOfCountry.oID AND govOfCountry.cID = country.cID
    ) as a
    ORDER BY 3 DESC;";
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
  <h1>List of Authors citizenship and the number of articles they have published</h1> 
    <div>
    </div><br><br>
    <table>
        <thead>
        <tr>
            <td><b>Author</b></td>
            <td><b>Country</b></td>
            <td><b>Total Publications</b></td>
        </tr>
        </thead>
        <tbody>
        <?php
         if($result->num_rows > 0){
                while ($row = $result->fetch_assoc()){ ?>
                <tr>
                        <td> <?php echo  $row["author"];?> </td>
                        <td> <?php echo  $row["citizenship"];?> </td>
                        <td> <?php echo  $row["total number of publication"];?> </td>
                </tr>
        <?php   }   ?>
        <?php   }   ?>

        </tbody>
    </table>
    <a href = "index.php">back to homepage</a>
</body>
</html>

