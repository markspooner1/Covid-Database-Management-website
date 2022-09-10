<?php
include 'header1.php';
require_once 'database.php';
$sql = "select * from 
(
SELECT region.rName, country.cName, count(article.author) AS 'total number of authors', count(article.aID) AS 'total number of publication'
FROM article, users, country, region 
WHERE article.author = concat(users.fName, ' ',users.lName) AND region.rID = country.rID AND country.cID = users.cID
GROUP BY region.rName, country.cName
union all 
SELECT region.rName, country.cName, count(article.author) AS 'total number of authors', count(article.aID) AS 'total number of publication'
FROM organization, region, country, article, govOfCountry
WHERE article.author = organization.oName AND organization.oID = govOfCountry.oID AND region.rID = country.rID AND govOfCountry.cID = country.cID
) AS a 
ORDER by 1 asc, 4 DESC;";
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
    <h1>Total Authors and publications in the system by country</h1>
    <table>
        <thead>
        <tr>
            <td><b>Region</b></td>
            <td><b>Country</b></td>
            <td><b>Total Authors</b></td>
            <td><b>Total Publications</b></td>
        </tr>
        </thead>
        <tbody>
        <?php
         if($result->num_rows > 0){
                while ($row = $result->fetch_assoc()){ ?>
                <tr>
                        <td> <?php echo  $row["rName"];?> </td>
                        <td> <?php echo  $row["cName"];?> </td>
                        <td> <?php echo  $row['total number of authors'];?> </td>
                        <td> <?php echo  $row['total number of publication'];?> </td>
                </tr>
        <?php   }   ?>
        <?php   }   ?>

        </tbody>
    </table>
    <a href = "index.php">back to homepage</a>
</body>
</html>

