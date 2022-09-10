<?php
include 'header1.php';
require_once 'database.php';
$sql = "select region.rName as RegionName, CountryName, Population, TotalDead, TotalVaccinatedDead, TotalInfected, TotalVaccinatedInfected, TotalVaccinated
from(
	select c.cID,  sum(pstr.dead) as TotalDead,  sum(pstr.infected) as TotalInfected
	from pstRecord pstr, country c, proStaTer pst 
	where c.cID = pst.cID AND pst.pstID = pstr.pstID
	group by c.cID
) as nonvaxx, (
	select c.cID, sum(vaccinated) as TotalVaccinated, sum(vr.dead) as TotalVaccinatedDead, sum(vr.infected) as TotalVaccinatedInfected
	from vacRecord vr, country c, proStaTer pst 
	where c.cID = pst.cID AND pst.pstID = vr.pstID
	group by c.cID
) as vaxx, (
	select c.cName as CountryName, c.cID, sum(pop) as Population
	from country c, proStaTer pst 
	where c.cID = pst.cID 
	group by c.cID
) as popcount, region, country
where nonvaxx.cID = vaxx.cID AND vaxx.cID=popcount.cID AND country.cID = popcount.cID AND country.rID = region.rID
order by TotalDead asc";
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
    <h1>Progress of Covid per country sorted by deaths</h1>
    <br><br>
    <table>
        <thead>	
	<tr>  
	    <td><b>Region Name</b></td>
            <td><b>Country Name</b></td>
            <td><b>Population</b></td>
	    <td><b>Total Deaths</b></td>
            <td><b>Vaccinated Deaths</b></td>
            <td><b>Total Infected</b></td>
	    <td><b>Vaccinated Infected</b></td>
	    <td><b>Total Vaccinations</b></td>
        </tr>
	</thead>
	<tbody>
	<?php
	 if($result->num_rows > 0){ 
		while ($row = $result->fetch_assoc()){ ?>
		<tr>		
			<td> <?php echo  $row["RegionName"];?> </td>
			<td> <?php echo  $row["CountryName"];?> </td>
			<td> <?php echo  $row["Population"];?> </td>
			<td> <?php echo  $row["TotalDead"];?> </td>
			<td> <?php echo  $row["TotalVaccinatedDead"];?> </td>
			<td> <?php echo  $row["TotalInfected"];?> </td>
			<td> <?php echo  $row["TotalVaccinatedInfected"];?> </td>
			<td> <?php echo  $row["TotalVaccinated"];?> </td>
		</tr>
	<?php	}   ?>
	<?php	}   ?>

	</tbody>
    </table>
    <a href = "index.php">back to homepage</a>
</body>
</html>





