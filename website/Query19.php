<?php
include 'header1.php';
require_once 'database.php';
$sql = "select sub2.cName as Country, sub2.sumpop as Population, sub.dateOf, coalesce(allVac, 0) as TotalVaccinated, TotalInfected, coalesce(VacInf, 0) as VaccinatedInfected, TotalDied, coalesce(VacDead, 0) as VaccinatedDead
from(
	select coalesce(total.dateOf, vaxx.dateOf) as dateOf, allVac, coalesce(TotalInf, VacInf) as TotalInfected, VacInf, coalesce(TotalDead, VacDead) as TotalDied, VacDead
	from (
		select sum(infected) as TotalInf, sum(dead) as TotalDead, dateOf, cName, pop 
		from pstRecord pr, country c, proStaTer pst 
		where c.cName = 'Canada' AND pst.cID = c.cId AND pr.pstID = pst.pstID
		group by dateOf
		order by dateOf desc
	) as total
	left join (
		select sum(vaccinated) as allVac, sum(infected) as VacInf, sum(dead) as VacDead, dateOf, cName, pop 
		from vacRecord vr , country c, proStaTer pst 
		where c.cName = 'Canada' AND pst.cID = c.cId AND vr.pstID = pst.pstID
		group by dateOf
		order by dateOf desc
	) as vaxx on total.dateOf = vaxx.dateOf
	UNION 
	select coalesce(total.dateOf, vaxx.dateOf) as dateOf, allVac, coalesce(TotalInf, VacInf) as TotalInfected, VacInf, coalesce(TotalDead, VacDead) as TotalDied, VacDead
	from (
		select sum(infected) as TotalInf, sum(dead) as TotalDead, dateOf, cName, pop 
		from pstRecord pr, country c, proStaTer pst 
		where c.cName = 'Canada' AND pst.cID = c.cId AND pr.pstID = pst.pstID
		group by dateOf
		order by dateOf desc
	) as total
	right join (
		select sum(vaccinated) as allVac, sum(infected) as VacInf, sum(dead) as VacDead, dateOf, cName, pop 
		from vacRecord vr , country c, proStaTer pst 
		where c.cName = 'Canada' AND pst.cID = c.cId AND vr.pstID = pst.pstID
		group by dateOf
		order by dateOf desc
	) as vaxx on total.dateOf = vaxx.dateOf
) as sub, (
	select cName, sum(pop) as sumpop
	from country cty, proStaTer pst2
	where cty.cName = 'Canada' AND pst2.cID=cty.cID 
	group by cName
) as sub2
order by dateOf desc";
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
    <h1>Record of Covid in Canada</h1>
    <br><br>
    <table>
        <thead>	
	<tr>  
	    <td><b>Country</b></td>
            <td><b>Population</b></td>
            <td><b>Date</b></td>
            <td><b>Vaccinated</b></td>
            <td><b>Infected</b></td>
            <td><b>Vaccinated and Infected</b></td>
            <td><b>Dead</b></td>
            <td><b>Vaccinated Dead</b></td>
        </tr>
	</thead>
	<tbody>
	<?php
	 if($result->num_rows > 0){ 
		while ($row = $result->fetch_assoc()){ ?>
		<tr>		
			<td> <?php echo  $row["Country"];?> </td>
			<td> <?php echo  $row["Population"];?> </td>
			<td> <?php echo  $row["dateOf"];?> </td>
		   	<td> <?php echo  $row["TotalVaccinated"];?> </td>
			<td> <?php echo  $row["TotalInfected"];?></td>
			<td> <?php echo  $row["VaccinatedInfected"];?></td>
			<td> <?php echo  $row["TotalDied"];?></td>
			<td> <?php echo  $row["VaccinatedDead"];?></td>
		</tr>
	<?php	}   ?>
	<?php	}   ?>

	</tbody>
    </table>
    <a href = "index.php">back to homepage</a>
</body>
</html>
