<?php
	
	echo '
	<div class="ruletdiv">
	<table border="1" cellpadding="5">';
	for($trnum = 1;$trnum < 4 ;$trnum++)
	{
		echo '<tr style="line-height:60px;">';
		
		for($tdnum = $trnum;$tdnum <= (33 + $trnum);$tdnum += 3)
		{
			if($tdnum == 1)
				echo '<td style="background-color:green" rowspan="3">0<input class="roulette" type="text" name="r0" size="2" style="background-color:transparent" /></td>';
			echo'<td>'.$tdnum.'<input class="roulette" type="text" name="r'.$tdnum.'" size="2" style="background-color:transparent" /></td>';
		}
		echo '
		<td><input type="text" name="r'.(36 + $trnum).'" size="2" 
		style="background-color:transparent" />'.$trnum.'st</td>
		</tr>';
		if($tdnum == 39)
		{
			echo '<tr><td><input type="text" name="Red" size="2" 
		style="background-color:transparent" />Red</td>';
		for($i=1;$i < 4; $i++)
		{
			$valuemax = $i*12;
			$valuemin = $valuemax-11;
		echo'<td align="center" colspan="4">'.$valuemin.'
		<input type="text" name="'.$valuemin.'-'.$valuemax.'" size="2" 
		style="background-color:transparent" />'.$valuemax.'</td>';
		}
		echo'
		<td><input type="text" name="Odd" size="2" 
		style="background-color:transparent" />Odd</td></tr>
		<tr><td><input type="text" name="black" size="2" 
		style="background-color:transparent" />Black</td>';
		for($i=1;$i < 3; $i++)
		{
			$valuemax = $i*18;
			$valuemin = $valuemax-17;
		echo'<td align="center" colspan="6">'.$valuemin.'
		<input type="text" name="'.$valuemin.'-'.$valuemax.'" size="2" 
		style="background-color:transparent" />'.$valuemax.'</td>';
		}
		echo'<td><input type="text" name="even" size="2" 
		style="background-color:transparent" />Even</td></tr>';
		}
	}
	echo '</table></div>';

?>