<?php
include 'header1.php';
require_once 'database.php';
if (isset($_POST["author"])){
	$author = $_REQUEST["author"];
	$sql = "SELECT majorT , minorT, summary, articleContent, dop
 	FROM article WHERE author = '".$author."'  ORDER BY dop ASC;";
	$result = $conn->query($sql);
}
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
    <h1>List of Articles</h1>
    <div><i>SELECT  majorT, minorT, summary, articleContent, dop
	 <br>FROM article WHERE author = //author inputted 
	 <br>ORDER BY author, dop ASC;</i>
    </div><br><br>
    <form action = "Query14.php" method = "post"> 	
    <label for="author">Author</label><br>
    <input type="text" name = "author" id = "author"> <br>
    <input type ="submit">
    </form>
    <table>
        <thead>
        <tr>
            <td><b>Major Title</b></td>
            <td><b>Minor Title</b></td>
            <td><b>Summary</b></td>
            <td><b>Content</b></td>
            <td><b>Date of Publish</b></td>
        </tr>
        </thead>
        <tbody>
        <?php
         if($result->num_rows > 0){
                while ($row = $result->fetch_assoc()){ ?>
                <tr>
               
                        <td> <?php echo  $row["majorT"];?> </td>
                        <td> <?php echo  $row["minorT"];?> </td>
                        <td> <?php echo  $row["summary"];?> </td>
                        <td> <?php echo  $row["articleContent"];?></td>
                        <td> <?php echo  $row["dop"];?></td>
                </tr>
        <?php   }   ?>
        <?php   }   ?>

        </tbody>
    </table>
    <a href = "index.php">back to homepage</a>
</body>
</html>

