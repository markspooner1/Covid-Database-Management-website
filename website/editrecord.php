<?php 
	include 'header1.php';
      include 'database.php';
      $recordID = $_GET['record'];
      
      if(isset($_POST['infected']) && isset($_POST['dead']) && isset($_POST['dateof'])){
        $infected = $_REQUEST['infected'];
        $dead =  $_REQUEST['dead'];
        $dateof = $_REQUEST['dateof'];
        echo $infected . " ";
	echo $dead . " ";
	echo $dateof; 
	 $sql = "UPDATE pstRecord SET infected = '".$infected."', dead ='".$dead."' , dateOf  ='".$dateof."' WHERE recID = '".$recordID."'";
        if ($conn->query($sql) === TRUE) {
		  echo "New record created successfully";
		} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}

      }
//UPDATE article
                //SET author = '".$author."', majorT = '".$majorT."', minorT = '".$minorT."', summary = '".$summary."', articleContent = '".$content."', dop = '".$pod."'
               // WHERE aID = '".$aID."'" ;

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
    <h1>Updating record: <?php  echo $recordID?></h1>
    <p>current data for record #<?php echo $recordID?> </p><?php  
       
        $currData = "select infected, dead, dateOf  from pstRecord  WHERE recID = '".$recordID."'";
   	$currDataExec = $conn->query($currData); 
    
    ?>
      <table>
        <thead>
        <tr>
        <td><b>Infected</b></td>
            <td><b>Dead</b></td>
            <td><b>Date</b></td>
         </tr>
        </thead>
	 <tbody>
        <?php
         if($currDataExec->num_rows > 0){
                while ($row = $currDataExec->fetch_assoc()){ ?>
                <tr>
                    <td> <?php echo  $row["infected"];?> </td>
		    <td> <?php echo  $row["dead"];?> </td>
                    <td> <?php echo  $row["dateOf"];?> </td>
                </tr>
        <?php   }   ?>
        <?php   }   ?>
        </tbody> 
	</table>
	<br><br>
    <form action="editrecord.php?recordID=<?=$_GET["record"]?>"  method="post">

    <label for="infected">Infected</label><br>
    <input type="text" name = "infected" id = "intected"> <br>

    <label for="dead">Dead</label><br>
    <input type="text" name = "dead" id = "dead"> <br>

    <label for="dateof">Date</label><br>
    <input type="date" name = "dateof" id = "dateof"> <br>

<input type="submit" value = "update">
</form>

</body>
</html>
