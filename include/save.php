<html>

<head></head>

<body>

<?php
	require_once("config/config.php");


	
	$new = "UPDATE Records SET Quiz='$_REQUEST[quiz]',
				   Ans='$_REQUEST[ans]',
				   Input='$_REQUEST[input]'
		WHERE Email='$_REQUEST[email]'";
  
	if (!mysql_query($new, $con)){
		
		die('Error here: ' . mysql_error());
	}
  
	mysql_close($con);

?>

<form method="post" action="game.php">
	<input type="hidden" name="email" value=<?php echo $_REQUEST["email"]  ?> />
	<input type="hidden" name="password" value=<?php echo $_REQUEST["password"] ?> />
	<input type="hidden" name="state" value="old_game" />
	<input type="submit" value=" Successful Saved! Click here to go back. " /><br />	
</form>



</body>

</html>
