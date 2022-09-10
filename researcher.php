<?php include 'header1.php';
if(!isset($_SESSION["Researcher"])){
        echo"you dont have permission to access this page, please login as Researcher";
        exit;
}
$user = $_SESSION['userId'];


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
	<p>click <a href ="createarticle.php">here</a> to add an article</p> 
	<p>click <a href ="researcherarticleview.php">here</a> to edit/delete and article</p>   
</body>
</html>
