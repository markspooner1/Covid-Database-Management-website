<?php
include 'header1.php';
require_once 'database.php';
$sql = "select sub.author as 'author', sub.majorT as 'major', sub.minorT as 'minor', sub.dop as 'dop', c.cName as 'Country Name'
from (
	select a.author, a.majorT, a.minorT, a.dop, u.cID
	from article a 
	inner join users u on a.author = concat(u.fName, ' ', u.lName)
	union
	select a.author, a.majorT, a.minorT, a.dop, orgC.cID
	from article a 
	inner join (
		select o.oName, goc.cID
		from organization o 
		left join govOfCountry goc on o.oID = goc.oID
	) as orgC on orgC.oName = a.author
) as sub, country c
where c.cID = sub.cID
order by cName asc, author asc, dop asc;";
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
  <h1>Overiview of articles in the system </h1>
    <div>
    </div><br><br>
    <table>
    <thead>
        <tr>
            <td><b>Author</b></td>
            <td><b>Major Title</b></td>
            <td><b>Minor Title</b></td>
            <td><b>Date of Publish</b></td>
            <td><b>Country</b></td>
        </tr>
        </thead>
        <tbody>
        <?php
         if($result->num_rows > 0){
                while ($row = $result->fetch_assoc()){ ?>
                <tr>
                        <td> <?php echo  $row['author'];?> </td>
                        <td> <?php echo  $row['major'];?> </td>
                        <td> <?php echo  $row['minor'];?> </td>
                        <td> <?php echo  $row['dop'];?> </td>
                        <td> <?php echo  $row['Country Name'];?> </td>
                </tr>
        <?php   }   ?>
        <?php   }   ?>

        </tbody>
    </table>
    <a href = "index.php">back to homepage</a>
</body>
</html>


