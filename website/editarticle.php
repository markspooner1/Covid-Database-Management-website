<?php
      include 'header1.php';
      include 'database.php';
	$aID = $_GET['aID'];
	$userID = $_SESSION['userId'];

//select fName, lName FROM users WHERE users.uID = $userID;
//select author from article where aID = $aID;
	$FnameLname = "select fName, lName FROM users WHERE users.uID = $userID;";
	$result = $conn->query($FnameLname);
	$author = "select author from article where aID = $aID;";
	$result2 = $conn->query($author);
	$row = $result->fetch_assoc();
	$row2 = $result2->fetch_assoc();
	$CurrentUser = $row['fName'] . " " . $row['lName'];
	$Author1 = $row2['author'];
	if($CurrentUser != $Author1 && !isset($_SESSION['Administrator']) && !isset($_SESSION['Delegate'])){
        	echo "you do not have permission to edit this article";
        	exit;
	}
      $aID = $_GET['aID'];
	 $currData = "SELECT * FROM article WHERE aID =$aID ";
      $result0 = $conn->query($currData);
      if(isset($_POST["author"]) && isset($_POST["majorT"]) && isset($_POST["minorT"]) && isset($_POST["summary"]) && isset($_POST["content"]) &&  isset($_POST["pod"])){
        $author = $_REQUEST['author'];
        $majorT =  $_REQUEST['majorT'];
        $minorT = $_REQUEST['minorT'];
        $summary = $_REQUEST['summary'];
        $content = $_REQUEST['content'];
        $pod = $_REQUEST['pod'];
        $sql = "UPDATE article
                SET author = '".$author."', majorT = '".$majorT."', minorT = '".$minorT."', summary = '".$summary."', articleContent = '".$content."', dop = '".$pod."'
                WHERE aID = '".$aID."'" ;
        $result = $conn->query($sql);
      }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title> 
    <style>
        table, th, td {
                 border: 1px solid;
        }
    </style>
</head>
<body>

    <h1>Updating article#: <?php  echo $_GET['aID'] ?></h1>
    <p>current data: </p>
        <table>
        <thead>
        <tr>
        <td><b>aID</b></td>
            <td><b>author</b></td>
            <td><b> majorT</b></td>
            <td><b>minorT</b></td>
            <td><b>summary</b></td>
            <td><b>articleContent</b></td>
            <td><b>dop</b></td>
        </tr>
        </thead>
        <tbody>
        <?php
         if($result0->num_rows > 0){
                while ($row = $result0->fetch_assoc()){ ?>
                <tr>
                    <td> <?php echo  $row["aID"];?> </td>
                    <td> <?php echo  $row["author"];?> </td>
                    <td> <?php echo  $row["majorT"];?> </td>
                    <td> <?php echo  $row["minorT"];?> </td>
                    <td> <?php echo  $row["summary"];?> </td>
                    <td> <?php echo  $row["articleContent"];?> </td>
                    <td> <?php echo  $row["dop"];?> </td>
                </tr>
        <?php   }   ?>
        <?php   }   ?>

        </tbody>
    </table>
	<form action="editarticle.php?aID=<?=$aID?>"  method="post">
        <label for="author">Author</label><br>
        <input type="text" name = "author" id = "author"><br>

        <label for="majorT">Major Topic</label><br>
        <textarea type="text" rows="5" cols="40" name = "majorT" id = "majorT"></textarea><br>

        <label for="minorT">Minor Topic</label><br>
        <textarea type="text" rows="5" cols="40"name = "minorT" id = "minorT"></textarea><br>


        <label for="summary">Summary</label><br>
        <textarea type="text" rows="5" cols="40" name = "summary" id = "summary" ></textarea><br>

        <label for="content">Content</label><br>
        <textarea type="text" rows="5" cols="40" name = "content" id = "content"></textarea> <br>


        <label for="pod">Publish Date</label><br>
        <input type="date" name = "pod" id = "pod"><br>

        <button type = "submit">Update</button>
	
	</form>

</body>
</html>
