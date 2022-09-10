<?php include 'header1.php';
include 'database.php';
if(!isset($_SESSION["Delegate"])){
        echo"you dont have permission to access this page, please login as Delegate";
        exit;
}
$userID = $_SESSION['userId'];
$IsUseraGovOff = "select uID from users WHERE uID = ".$userID." and uID IN (select userjoinemployee.uID
from (
    select u.uID, eoo.oID 
    from users u 
    left join employeeOfOrg eoo on u.uID = eoo.uID
) as userjoinemployee
left join organization on userjoinemployee.oID = organization.oID 
where organization.otID = 1);";


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <p><?php $result = $conn->query($IsUseraGovOff);
	if ($result->num_rows > 0) {
        	echo "Your username is associated with a government agency. Follow this link to add/edit/delete your countries covid records: https://duc353.encs.concordia.ca/covidrecords.php";
		}

?>
  <p>If you are an organization with articles in the system click<a href="orgarticleview.php">Here</a> to view them</p>
</body>
</html>
</body>
</html>
