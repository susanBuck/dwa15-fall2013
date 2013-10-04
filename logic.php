<?php 

$contestants['bob']   = 'Winner';
$contestants['frank'] = 'Loser';

$keys = array_keys($contestants);

for($i = 0; $i < count($contestants); $i++) {
	echo $keys[$i]." is a ".$contestants[$keys[$i]]."<br>";
}

?>