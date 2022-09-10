<?php 
include 'header1.php';
include 'database.php';
$sql = "delete from pstRecord WHERE recID = '".$_GET['record']."'";
if ($conn->query($sql) === TRUE) {
  echo "record deleted";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

?>
