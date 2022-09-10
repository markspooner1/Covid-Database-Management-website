<?php
$servername = "duc353.encs.concordia.ca";
$username = "duc353_1";
$password = "353AAAA";
$dbname = "duc353_1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  echo "failed";
}
//Your sql query here: v v v v
$sql = "select rID, rName from regions";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "Region ID: " . $row["rID"]. " - Regions Name: " . $row["rName"].  "<br>";
  }
}
$conn->close();
?>
