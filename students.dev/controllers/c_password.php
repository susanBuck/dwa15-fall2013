<?php
class password_controller extends base_controller {


	public function __construct() {
        parent::__construct();
    } 


	########### //Main Reset Function ###########
	public function reset(){
	
		//Check to see if the user is logged in.
			if($this->user) {
					Router::redirect('/users/profile');
			}
	
		//Define view paramters
		$this->template->content = View::instance('v_password_reset');
		$this->template->title   = "Reset your Password";
		
		//Display view
		echo $this->template;
	
	}
	
	########### //Process Reset ###########
	public function p_reset($token = NULL){
	
		//Check to see if the user is logged in.
			if($this->user) {
					Router::redirect('/users/profile');	
			}
	
		//Sanitize _POST
		$_POST = DB::instance(DB_NAME)->sanitize($_POST);
			
		
		//Do some error checking gainst the email to make sure it's a valid email construct.
		$email = $_POST['email'];
		
			if($email == '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
				Router::redirect('/password/reset/?email-error');
			}
		
		//Query the DB for a email / password and set it as a variable.
		$q = "SELECT * FROM users WHERE email = '".$_POST['email']."'"; 
	
		//Execute query against DB
		$exsitingUsers = DB::instance(DB_NAME)->select_rows($q);
		
		//Check to determine if the user exsits.
			if(empty($exsitingUsers)){
			
				//Redirect to the login page
				Router::redirect('/password/reset/?user-does-no-exists');
			
					//If is doesn't exsit, continue with processing signup.
					}else{
										
						//Create an encrypted token via their email address and a random string
						$passwordToken = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string()); 
						
						//Specify what we are updating = the token
						$data = Array("password_token" => $passwordToken);
				
						//Update the with then new token
						DB::instance(DB_NAME)->update("users", $data, "WHERE email = \"$email\"");
						
						//Email TOKEN Functionality
						$to[]    = Array("name" => $email, "email" => $email);
						$from    = Array("name" => "Quote Me", "email" => "do-not-reply@rusnac.biz");
						$subject = "Quote Me - Password Reset";
						
						//Setup Body View & pass Token to email body
						$body = View::instance('v_email_p_reset');
						$body->token = $passwordToken;
							
						//Send Email
						Email::send($to, $from, $subject, $body, true, '');
						
						//Redirect to user login page after user has been created in the DB
						Router::redirect('/password/reset/?password-reset');
								
				}// End if 
	
	}// End of Function
	
	########### //Process Reset ###########
	public function set($token = NULL){
		
		//Query to check if the token specified exsits
		$q = "select password_token from users WHERE users.password_token = '$token'";
		$token_q = DB::instance(DB_NAME)->select_rows($q);		
								
		//Check to make sure a token has been passed
			if(!$token || empty($token_q)){
			
					//Define view paramters
					$this->template->content = View::instance('v_password_set_invalid');
					$this->template->title   = "Please provide a token";
				
					//Display view
					echo $this->template;
	
			}else{
		
				//Define view paramters
				$this->template->content = View::instance('v_password_set');
				$this->template->title   = "Set your New Password";
				
				$this->template->content->token = $token;
				
				//Display view
				echo $this->template;
				
			}// End if
			
	}// End of funtion
	
	
	########## //Process Reset ###########
	public function p_set($token = NULL){
	
		//Query to check if the token specified exsits
		$q = "select * from users WHERE users.password_token = '$token'";
		$token_q = DB::instance(DB_NAME)->select_rows($q);		
								
		//Check to make sure a token has been passed
		if(!$token || empty($token_q)){
			
			Router::redirect('/password/reset/');

		}
		
		//Check to make sure the password is not empty
		if((empty($_POST['password']))) { 
			Router::redirect('/password/set/'.$token.'/?empty-password');
		} 

		//Check to make sure the password match
		if(isset($_POST['password'], $_POST['password_check'])) {
			if($_POST['password'] != $_POST['password_check']){
					Router::redirect('/password/set/'.$token.'/?password-match');
				}
		}
		
		$updateUserq = "select user_id from users WHERE users.password_token = '$token'";
		$updateUser = DB::instance(DB_NAME)->select_rows($updateUserq);	
		
		foreach($updateUser as $value){ 
			$updateUserId = $value['user_id'];

			}//End for Each
		
		
		//Specify the new password by hashing it
		$newpassword = sha1(PASSWORD_SALT.$_POST['password']);
		
		$data = Array('password' => $newpassword);
		DB::instance(DB_NAME)->update("users", $data, "WHERE user_id = $updateUserId");
		
		//Specify what we are updating = the token
		$emptyToken = Array("password_token" => '');
		
		//Delete password Token
		DB::instance(DB_NAME)->update("users", $emptyToken, "WHERE user_id = $updateUserId");
					
		Router::redirect('/users/login/?password-updated');
				
		
	}//End of Function
	

		
} // end of class