<html>

<head>
<script type="text/javascript" src="javascript.js"></script>
<style>
h4 {color: yellow};
</style>
</head>

<body style="text-align: center; color: yellow">

<?php
//First, ensure that the difficulty level is selected.

if (!isset($_REQUEST['level']) && $_REQUEST['state'] == "new_game" ) {
	
	echo "	<form method='post' action='authorization.php'>
			<input type='hidden' name='email' value='" . $_REQUEST["email"] .  "' />
			<input type='hidden' name='password' value='" . $_REQUEST["password"] . "' />
			<h4>Difficulty level not selected.</h4>
			<input type='submit' value='Go back' />
		</form>";
	
	die();
}


//Fist, we extract the sudoku data, if this is a NEW game, we read data from files:

if ( $_REQUEST["state"] == "new_game"){
	
	$group = 799; //We have 799 sets of data in each difficulty level.
	$rand = rand(0, $group);
	$file = fopen($_REQUEST["level"], "r");

	fseek ($file, $rand * 164, SEEK_SET);
	$quiz = fgets($file);
	$ans = fgets($file);
	fclose($file);
}

else { // If this is an OLD game, we read the data from the database:

	require_once("config/config.php");


	$result = mysql_query("SELECT * FROM Records WHERE Email='$_REQUEST[email]'");


	if (!$result){
				
		die('Error here: ' . mysql_error());
	}
						  
	$row = mysql_fetch_array($result);

	$quiz = $row['Quiz'];       //the quiz information: 96050... value=0 means: to be filled.
	$ans = $row['Ans'];         //the answer: 96751...
	$input = $row['Input'] ;    //user's previous input: 00701aaa...value=0 means: given by $quiz value=a: left blank.

	if ( strlen( $quiz ) < 79 ) {
	
		echo "
		<form method='post' action='authorization.php'>
			<input type='hidden' name='email' value='" . $_REQUEST["email"] . "' />
			<input type='hidden' name='password' value='" . $_REQUEST["password"] . "' />
			<input type='submit' value=' No such record! Click here to start a new session ' /><br />	
		</form>";
		exit();
	}	
	
	mysql_close($con);
}

?>

<form name="myClock" method=post>
The time you have spent:<input type=text name="time_spent" id=clock size=8>
</form>
<script type="text/javaScript" src="clock.js"></script>

<?php include("ui.php");    ?>


<form method="post" action="update_score.php">
	<input type="button" value="    Clear all     " onclick="clearAll()" />
	<input type="button" value="   Show answers  " onclick="showAnswer()" />
	<input type="button" value="Check my answers"  onclick="checkAnswer()" />
	<input type="hidden" name="score" value="" id="score" />
	<input type="hidden" name="email" value=<?php echo $_REQUEST["email"];  ?> />
	<input type="hidden" name="password" value=<?php echo $_REQUEST["password"]; ?> />
	<input type="submit" value="Update my score" /><br />
</form>

<form method="post" action="save.php">
	<input type="hidden" name="email" value=<?php echo $_REQUEST["email"];  ?> />
	<input type="hidden" name="password" value=<?php echo $_REQUEST["password"]; ?> />
	<input type="hidden" name="input" value=" "  id="input" />
	<input type="hidden" name="quiz" value=<?php echo $quiz;  ?> />
	<input type="hidden" name="ans" value=<?php echo $ans;  ?> d="ans">
	<input type="submit" value="       Save game        " onclick="updateInput()" />
</form>

<form method="post" action="game.php">
	<input type="hidden" name="email" value=<?php echo $_REQUEST["email"];  ?> />
	<input type="hidden" name="password" value=<?php echo $_REQUEST["password"]; ?> />
	<input type="hidden" name="state" value="old_game" />
	<input type="submit" value="Resume from last saved" />
</form>

<form method="post" action="authorization.php">
	<input type="hidden" name="email" value=<?php echo $_REQUEST["email"];  ?> />
	<input type="hidden" name="password" value=<?php echo $_REQUEST["password"]; ?> />
	<input type="submit" value="       Start a new session      " /><br />	
</form>


</body>

</html>
