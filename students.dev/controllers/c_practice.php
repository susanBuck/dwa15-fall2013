<?php

class practice_controller extends base_controller {

	/*-------------------------------------------------------------------------------------------------
	Demonstrating sample method
	-------------------------------------------------------------------------------------------------*/
	public function test_db() {
	
	// Notes: protect against sql injection attachs
	// INSERT PRACTICE
	/*$q = 'INSERT INTO users
		SET first_name = "Albert",
		last_name = "Einstein"';
	// echo a query is a useful debugging technique		
	echo $q;
	DB::instance(DB_NAME)->query($q);*/
	
	
	/*// UPDATE PRACTICE manual way of running a query
	$q ='UPDATE users
		SET email = "albert@aol.com"
		WHERE first_name = "Albert"';
	
	echo $q;
	
	// All sql queries go through this method
	DB::instance(DB_NAME)->query($q);*/
	
	/*// INSERT PRACTICE using the query builder
	$new_user = Array (
		'first_name' => 'Albert',
		'last_name' => 'Einstein',
		'email' => 'albert@gmail.com',
	);
	
	echo $q;
	
	DB::instance(DB_NAME)->insert('users',$new_user);*/
	
	
	// Lets pretend this is data we got from a form
	$_POST['first_name'] = 'Albert';
	
	//Make sure it's sanitized first
	$_POST = DB::instance(DB_NAME)->sanitize($_POST);
	
	$q = 'SELECT email
			FROM users
			WHERE first_name = "'.$_POST['first_name'].'"';
	// echo a query is a useful debugging technique
	echo $q;
		
	// Run the query, echo what it returns	
	echo DB::instance(DB_NAME)->select_field($q);
	
	}

	
	/*-------------------------------------------------------------------------------------------------
	Demonstrating Classes/Objects
	-------------------------------------------------------------------------------------------------*/
	public function display_image() {
	
		// Make sure code has access to my image class (temp solution)
		#require(APP_PATH.'/libraries/Image.php');
	
		#echo "You are looking at test1.";
	
		#echo APP_PATH."<br>";
		#echo DOC_ROOT."<br>";
	
		// Once we have access, we instantiate an object from that class
		// and pass the parameter to the construct
		$imageObj = new Image('http://placekitten.com/1000/1000');
	
		// Then we have access to all the methods within that object
		// and we can point to the methods in that class
		$imageObj->resize(500,500);
	
		$imageObj->display();

	}
	

  	public function test1(){
    	#require(APP_PATH.'/libraries/image.php');
    	#echo "testing!";
    	$imgObj = new Image('images/placeholder.png');
       	$imgObj->resize(200, 200);
    	$imgObj->display();
  	}

	
	public function test2() {
	
		// Static ... didn't have to instantiate it i.e., $timeObj = new Time();
		echo Time::now();
	
	}
	
	public function test3() {
	
	# Our SQL command
	$q = "INSERT INTO users SET 
    		first_name = 'Sam', 
    		last_name = 'Seaborn',
    		email = 'seaborn@whitehouse.gov'";

	# Run the command
	echo DB::instance(DB_NAME)->query($q);
	}

	// Our Update SQL command
	public function test4() {
	$q = "UPDATE users
    		SET email = 'samseaborn@whitehouse.gov'
    		WHERE email = 'seaborn@whitehouse.gov'";

	# Run the command
	echo DB::instance(DB_NAME)->query($q);
	}
	
	// Our Delete SQL command
	public function test5() {
	$q = "DELETE FROM users
    		WHERE email = 'sam@whitehouse.gov'";

	# Run the command
	echo DB::instance(DB_NAME)->query($q);
	}
	
	/*-------------------------------------------------------------------------------------------------
	Testing email on live server with not SMTP settings
	-------------------------------------------------------------------------------------------------*/
	public function test_email() {
		echo Utils::alert_admin('Testing email from live server', '');
	}
	
	/*-------------------------------------------------------------------------------------------------
	Demonstrating two different ways to render a view
	-------------------------------------------------------------------------------------------------*/
	public function test_render() {
		
		# Setup view
			$this->template->content = View::instance('v_index_index');
			
		# Render template
		# Either one of these works
			#echo $this->template;
			echo $this->template->render();
		
	}
	
	/*-------------------------------------------------------------------------------------------------
	Demonstrating PHP Warning when a param is not defaulted and not passed
	-------------------------------------------------------------------------------------------------*/
	public function test_not_null_var($message) {
		
		if($message != NULL) {
			echo $message;
		}
		
	}
	
	/*-------------------------------------------------------------------------------------------------
	Demonstrating vague MySQL errors on live server
	-------------------------------------------------------------------------------------------------*/
	public function test_db_error() {
		
		$q = "SELECT * FROM posts";
		echo DB::instance(DB_NAME)->select_rows($q);
	}
	
	/*-------------------------------------------------------------------------------------------------
	Time tests
	-------------------------------------------------------------------------------------------------*/
	public function test_time() {
	
		$full_moon = 1326119760; # Jan 9, 2012 07:30 GMT

		# Shows the time in your app's timezone
		echo "<br>App TZ: ".Time::display($full_moon);
	
		# Hard code in the timezone you want to display
		echo "<br>Los Angeles TZ: ".Time::display($full_moon, '', 'America/Los_Angeles');
		
		# Or, assuming you know your user's timezone, pass it in as a variable
		//echo "<br>User's TZ: ".Time::display($full_moon, '', $this->user->timezone);

		
	}		

}  # eoc

