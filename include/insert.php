<html>

<head>

<style type="text/css">

h3 {color: yellow};

</style>


</head>

<body>


<?php  //This block insert the uploaded form information into Database called SudokuData.

if (isset($_REQUEST["email"]) && isset($_REQUEST["name"]) && strcmp($_REQUEST["password1"], $_REQUEST["password2"])==0 ){ 


	require_once("config/config.php");
	
	if (!$sql){ //In the case that the SudokuData database has not been created, we create one and create the corresponding tables.
	
		mysql_query("CREATE DATABASE SudokuData", $con);
		mysql_select_db("SudokuData", $con);
		$new_table = "CREATE TABLE Records (    Series int NOT NULL AUTO_INCREMENT, PRIMARY KEY(Series), 	
							Name varchar(255),
							Email varchar(255),
							Password varchar(255),
							Score int,
							Quiz varchar(255),
							Ans varchar(255),
							Input varchar(255)
							)";
		mysql_query($new_table, $con);
			
	}
 	
	//Before we write the new information into our records, We must check that the email-address is unique:

	$result = mysql_query("SELECT * FROM Records");
	
	while ($row = mysql_fetch_array($result)){ //Each time scan one row.
		
	
		if (strcmp($row['Email'], $_REQUEST["email"]) == 0){

			die("<h3>Email address already exists.</h3>");
		}
	}

	$encoded_password = sha1($_REQUEST["password1"]); //Before we put the password in, we must encode it.

	$new = "INSERT INTO Records (Name, Email, Password, Score)
			 	   Values ('$_REQUEST[name]', '$_REQUEST[email]', '$encoded_password', 0)";
  
	if (!mysql_query($new, $con)){
		
		die('Error here: ' . mysql_error());
	}
  

	echo "	<h3>
			Congratulations! Your registration is successful!<br />
			Welcome to the world of Sudoku, " . $_REQUEST["name"] . "! <br />
			Click the log in button. Have fun :)
		</h3>";

	mysql_close($con);
}

else {
  
  echo "<h3>Invalid form. Click Sign_up to try again.</h3>";

}

?>


</body>
</html>
