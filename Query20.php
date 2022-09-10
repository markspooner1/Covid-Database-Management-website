<?php
include 'header1.php';
require_once 'database.php';
$sql = "select fc.author, country.cName, fc.followersCount
from(
	select users.cID, followers.author, count(followers.author) as followersCount
	from followers, users
	where followers.author = concat(users.fName, ' ', users.lName)
	group by followers.author
	union all
	select govOfCountry.cID, orgFol.oName as author, orgFol.followersCount
	from(
		select organization.oName, organization.oID, count(followers.author) as followersCount 
		from followers, organization
		where followers.author=organization.oName
		group by followers.author
		) as orgFol
	left join govOfCountry on govOfCountry.oID = orgFol.oID
) as fc, country
where country.cID = fc.cID
having fc.followersCount = (select fc.followersCount
from(
	select users.cID, followers.author, count(followers.author) as followersCount
	from followers, users
	where followers.author = concat(users.fName, ' ', users.lName)
	group by followers.author
	union all
	select govOfCountry.cID, orgFol.oName as author, orgFol.followersCount
	from(
		select organization.oName, organization.oID, count(followers.author) as followersCount 
		from followers, organization
		where followers.author=organization.oName
		group by followers.author
		) as orgFol
	left join govOfCountry on govOfCountry.oID = orgFol.oID
) as fc, country
where country.cID = fc.cID
order by fc.followersCount desc limit 1)
order by fc.followersCount desc";
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
    <h1>List of Highest Followed Authors</h1>
    <br><br>
    <table>
        <thead>	
	<tr>  
	    <td><b>Author</b></td>
            <td><b>Country</b></td>
            <td><b>Number of Followers</b></td>
        </tr>
	</thead>
	<tbody>
	<?php
	 if($result->num_rows > 0){ 
		while ($row = $result->fetch_assoc()){ ?>
		<tr>		
			<td> <?php echo  $row["author"];?> </td>
			<td> <?php echo  $row["cName"];?> </td>
			<td> <?php echo  $row["followersCount"];?> </td>
		</tr>
	<?php	}   ?>
	<?php	}   ?>

	</tbody>
    </table>
    <a href = "index.php">back to homepage</a>
</body>
</html>
