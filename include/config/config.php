<?php

$db_hostname = "localhost";

$db_username = "root";

$db_password = "yzx12345";

$con = mysql_connect($db_hostname, $db_username, $db_password);

	if (!$con) {
			die('Failed to connect to:' . mysql_error());  
	}

$sql = mysql_select_db("SudokuData", $con);  


?>
