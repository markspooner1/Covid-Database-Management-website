<?php
include 'header1.php';
include 'database.php';
$sql = "select author, majorT, minorT, dop, cName, dateTimeOf
from (
	select a.aID, a.author, a.majorT, a.minorT, a.dop, u.cID, a.status
	from article a 
	inner join users u on a.author = concat(u.fName, ' ', u.lName)
	union
	select a.aID, a.author, a.majorT, a.minorT, a.dop, orgC.cID, a.status
	from article a 
	inner join (
		select o.oName, goc.cID
		from organization o 
		left join govOfCountry goc on o.oID = goc.oID
	) as orgC on orgC.oName = a.author
) as sub, country c, removalRecord rr
where sub.status = 'removed' AND rr.aID = sub.aID AND sub.cID = c.cID
order by cName asc, dateTimeOF asc";
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
  <h1>Articles Removed</h1>
    <div>
    </div><br><br>
    <table>
    <thead>
        <tr>
            <td><b>Author</b></td>
            <td><b>Major Title</b></td>
            <td><b>Minor Title</b></td>
            <td><b>Date of Publish</b></td>
            <td><b>Country Name</b></td>
            <td><b>Date of Removal</b></td>
        </tr>
        </thead>
        <tbody>
        <?php
         if($result->num_rows > 0){
                while ($row = $result->fetch_assoc()){ ?>
                <tr>
                        <td> <?php echo  $row["author"];?> </td>
                        <td> <?php echo  $row["majorT"];?> </td>
                        <td> <?php echo  $row["minorT"];?> </td>
                        <td> <?php echo  $row["dop"];?> </td>
                        <td> <?php echo  $row["cName"];?> </td>
                        <td> <?php echo  $row["dateTimeOf"];?> </td>

                </tr>
        <?php   }   ?>
        <?php   }   ?>

        </tbody>
    </table>
    <a href = "index.php">back to homepage</a>
</body>
</html>


