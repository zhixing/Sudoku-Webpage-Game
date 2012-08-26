<?php

//Fill up the 9*9 form.

echo "<div style='text-align:center;'><table cellspacing=0 border=1 align='center'>";

$count = 0;

for ($i = 0; $i < 9; $i++){

	echo "<tr>";

	for ($j = 0; $j<9; $j++){

		echo "<script type='text/javascript'> answering(" . $ans{$count} . "); </script>";
		
		
		$readonly = " ";
		$celltype = " ";
		$value = "value =''";
		$color = " ";

		if ($quiz{$count} != 0){

			$readonly = "readonly='readonly'";
			$value = "value=" . $quiz{$count};
			$color = "background-color:CCFF00;";

		}

		else {
			echo "<script type='text/javascript'> filling(" . $count . "); </script>";

			if ( $_REQUEST["state"] == "old_game") {

				
				if ($input[$count] != 0 ) {

					if ($input[$count] != "a" ) {
			
						$value = "value=" . $input[$count];
					}
				}
				
			}
		}

		
		
		if ($i == 2 || $i == 5){

			$celltype = "style='border-bottom:3px solid black'";

		}

		if ($j ==2 || $j == 5) {
			
			$celltype = "style='border-right:3px solid black'";
		}

		if ( ($i == 2 && $j == 2) || ($i == 2 && $j == 5) || ($i == 5 && $j == 2) || ($i == 5 && $j ==5)){

			$celltype = "style='border-right:3px solid black; border-bottom:3px solid black'";
		}

			
		
		
		echo "<td " . $celltype . " > <input type='text' id='cell_" . $count . "' style='width:30px; " . $color . "' " . $readonly . " " . $value . " /></td>";
	
		$count++;
		
	
	}

	echo "</tr>";

}

echo "</table></div>";
?>




