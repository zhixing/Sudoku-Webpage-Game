<html>

<head></head>


<body>

<?php  //This block updates the scores in the user's database.

if (isset($_REQUEST["email"]) && isset($_REQUEST["score"] ) ){ 

	
	require_once("config/config.php");

	
//First, we retrieve the score of the corresponding email name.
	
	$result = mysql_query("SELECT * FROM Records WHERE Email='$_REQUEST[email]'");
	
	if (!$result){
					
		die('Error here: ' . mysql_error());
	}
		
	$row = mysql_fetch_array($result);
	
//Then, we add the new score and update the entry.

	$accumulated = $_REQUEST["score"] + $row["Score"];
	
	mysql_query("UPDATE Records SET Score='$accumulated' WHERE Email='$_REQUEST[email]'" );

	mysql_close($con);
	
}

else {
	echo "Invalid Information, your score haven't been updated.";
}


?>

<form method="post" action="authorization.php">
	<input type="hidden" name="email" value=<?php echo $_REQUEST["email"]  ?> />
	<input type="hidden" name="password" value=<?php echo $_REQUEST["password"] ?> />
	<input type="submit" value=" Successful Updated! Click here to start a new session " /><br />	
</form>


</body>

</html>
