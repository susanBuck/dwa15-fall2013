<?php
class practice_controller extends base_controller {
public function test_db() {

$_POST = DB::instance(DB_NAME)->sanitize($_POST);

$q = "SELECT token 
	FROM users
	WHERE email = '".$_POST['email']."'
	AND password = '".$_POST['password']."'
	"; 

echo $q; 
$token = DB::instance(DB_NAME)->select_field($q);  

} 

}

?>