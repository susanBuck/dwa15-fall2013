<?php
// setting PHP error reporting 

    error_reporting(E_ALL); 
	ini_set('display_errors', 1);
	
class practice_controller extends base_controller{

	public function test1(){
		/*
		echo "You are looking at test one"."<br>";
		echo APP_PATH."<br>";
		echo DOC_ROOT."<br>";
		
		require(APP_PATH.'/libraries/Image.php');
		*/
		
		
		/*
		Instantiate an Image object using the "new" keyword
		Whatever params we use when instantiating are passed to __construct 
		*/
		$imageObj = new Image('http://placekitten.com/1000/1000');

		/*
		Call the resize method on this object using the object operator (single arrow ->) 
		which is used to access methods and properties of an object
		*/
		$imageObj->resize(200,200);

		# Display the resized image
		$imageObj->display();
		
		
		
	}
	public function test2(){
	
		echo Time::now();
	}
	
	public function db_test(){
	
		# Our SQL command
		$q = "INSERT INTO users SET 
			first_name = 'Furrukh', 
			last_name = 'Baber',
			email = 'furrukh.baber@gmail.com'";

		# Run the command
		echo DB::instance(DB_NAME)->query($q);
		
		# Our SQL update command
		$q = "UPDATE users
			SET email = 'samseaborn@whitehouse.gov'
			WHERE email = 'seaborn@whitehouse.gov'";

		# Run the command
		echo DB::instance(DB_NAME)->query($q);
	
	
	}
	

}






?>