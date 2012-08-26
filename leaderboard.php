<html>

<head></head>

<body>

<?php

require_once("include/config/config.php");


$result = mysql_query("SELECT * FROM Records ORDER BY Score DESC");


echo "

<div style='text-align:center;'>

<table cellspacing=0 border=1 align='center' style='background-color: orange'>

<tr>
	<td>Name</td>
	<td>Email</td>
	<td>Total Score</td>
</tr>";


while($row = mysql_fetch_array($result)) {
	
	echo "<tr>";
		echo "<td> " . $row["Name"] . " </td>";
		echo "<td> " . $row["Email"] . "</td>";
		echo "<td> " . $row["Score"] . "</td>";
	echo "</tr>";

}

echo "</table></div>";

mysql_close($con);

?>

</body>

</html>

