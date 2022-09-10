<?php include'header1.php';

session_start();
session_unset();
session_destroy();
echo "bye bye";
?>
