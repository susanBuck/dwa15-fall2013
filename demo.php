<!DOCTYPE html>
<html>
<head>
	
	<?php
	require_once('logic.php');	
	?>
	
	<link rel='stylesheet' href='styles.css' type='text/css'>


</head>

<body>
		
	<form action='demo.php' method='POST'>
		<input type='text' name='contestant1'><br>
		<input type='text' name='contestant2'><br>
		<input type='text' name='contestant3'><br>
		<input type='text' name='contestant4'><br>
		<input type='submit'>
	</form>

			
	<table>
		<?php foreach($contestants as $name => $winner_or_loser): ?>
			<tr>
				<td><?=$name?></td>
				<td><?=$winner_or_loser?></td>
			</tr>
		<?php endforeach; ?>
	</table>

	
</body>
</html>