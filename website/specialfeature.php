<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: black;
}

* {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
  padding: 16px;
  background-color: white;
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;
}
</style>
</head>
<body>

<form action="specialfeature2.php">
  <div class="container">
    <h1>Please fill in this form to Register for your Covid Vaccine</h1>
    <hr>

    <label for="username"><b>username</b></label>
    <input type="text" placeholder="enter username" name="username" id="username" required>

    <label for="psw"><b>password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" id="psw" required>
    
	<label for = "healthcard"><b>Health Card #</b></label>
        <input type = "number" placeholder="enter health card #" name = "healthcard" id = "healthcar"><br>
    
	<label for="doses"><b>This is your:</b></label>

<select name="doses" id="doses">
  <option value="first">First Dose</option>
  <option value="second">Second Dose</option>
  <option value="third">Third Dose</option>
  <option value="fourth">Fourth Dose</option>
</select>
  <br>
 
  <label for="vacc"><b>select your desired vaccine:</b></label>
<select name="cars" id="cars">
 <option value="pfizer">Pfizer</option>
  <option value="moderna">Moderna</option>
  <option value="astrazenca">Astrazenca</option>
  <option value="JandJ">JandJ</option>
</select><br>
	<label for = "dateOf"><b>select date of appointment</b></label>
    <input type = "date" name = "dateOf" id = "dateOf">
    <br>
    
<label for = "clinic"><b>select your preferred clinic</b></label>
 <select name="clinic" id="clinic">
  <option value="concordia">Concordia</option>
  <option value="mcgill">Mcgill</option>
  <option value="udem">Udem</option>
  <option value="laval">laval</option>
</select>

    <button type="submit" class="registerbtn">Register</button>
  </div>
  
  </form>

</body>
</html>
