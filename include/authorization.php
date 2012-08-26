<html>

<head>
</head>


<body style = "color: yellow; font-size: 20px">

<?php //This block varifies the user identity: match the email and password.

if (isset($_REQUEST["email"]) && isset($_REQUEST["password"] ) ){ 


		require_once("config/config.php");

			
		$encoded_password = sha1($_REQUEST["password"]); //We encode the password given by the user, and compare it with our data.
		
		$result = mysql_query("SELECT * FROM Records WHERE Email='$_REQUEST[email]'");


		if (!$result){
				
				die('Error here: ' . mysql_error());
		}
						  
		$row = mysql_fetch_array($result);
			

		echo "<br />";
		
		
		if (strcmp($row['Password'], $encoded_password) != 0){

			die('Wrong password');
		}

		mysql_close($con);

}

else {
	echo "Invlid information, please try again. ";
	die("Good luck.");
}


echo "<p>Welcome back " . $row['Name'] . "! Please select a difficulty level:</p>";


?>




<form action="game.php" method="get">
  <input type="radio" name="level" value="../sudoku_data/SUPEREASY" />Supereasy  <br />
  <input type="radio" name="level" value="../sudoku_data/EASY" />Easy<br />
  <input type="radio" name="level" value="../sudoku_data/MEDIUM" />Medium  <br />
  <input type="radio" name="level" value="../sudoku_data/HARD" />Hard  <br />
  <input type="radio" name="level" value="../sudoku_data/INSANE" />Insane  <br /><br />
  <input type="hidden" name="email" value=<?php echo $_REQUEST["email"];  ?> />
  <input type="hidden" name="password" value=<?php echo $_REQUEST["password"];  ?> />
  <input type="hidden" name="state" value="new_game" />

  <input type="submit" value="Start the adventure" /><br />
 
</form>
<form method="post" action="game.php">
	<input type="hidden" name="email" value=<?php echo $_REQUEST["email"]  ?> />
	<input type="hidden" name="password" value=<?php echo $_REQUEST["password"] ?> />
	<input type="hidden" name="state" value="old_game" />
	<input type="submit" value="    Resume from last saved    ">
</form>
   

</body>

</html>
