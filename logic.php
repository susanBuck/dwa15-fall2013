<?php

$year = date('g:ia');

$age = 50;

if($age <= 12) {
	$person_type = 'kiddo';
}
else if($age > 12 && $age <= 19) {
	$person_type = 'teenager';
}
else if($age > 19 && $age <= 80) {
	$person_type = 'adult';
}
else {
	$person_type = 'super wise person';
}


?>