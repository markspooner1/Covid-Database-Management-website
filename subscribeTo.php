<?php
include 'header1.php';
include 'database.php';
$author = $_GET['author'];

$user = $_SESSION['userName'];
$sql = "INSERT INTO followers VALUES('$author','$user')";
if ($conn->query($sql) === TRUE) {
  echo 'you are now registered with the author: ' .$_GET['author'] . ' you will receive email notifications when a new publication from: ' . $_GET['author'] . " is released";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
