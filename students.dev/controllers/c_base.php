<?php

class base_controller {
	
	public $user;
	public $userObj;
	public $template;
	public $email_template;

	/*-------------------------------------------------------------------------------------------------

	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
						
		# Instantiate User obj
			$this->userObj = new User();
			
		# Authenticate / load user
			$this->user = $this->userObj->authenticate();					
						
		# Set up templates
			$this->template 	  = View::instance('_v_template');
			$this->email_template = View::instance('_v_email');			
								
		# So we can use $user in views			
			$this->template->set_global('user', $this->user);
			
		#number of total posts
			$total_posts = DB::instance(DB_NAME)->select_rows('SELECT * FROM posts');
			$this->template->total_number_of_posts = $total_number_of_posts = count($total_posts);
			
		#total number of users
			if($this->user){
				
				$total_users = DB::instance(DB_NAME)->select_rows('SELECT * FROM users_users where user_id = '.$this->user->user_id.'');
				$this->template->total_number_of_users = $total_number_of_users = count($total_users);
			}
			
	
		#total number of followers
			if($this->user){
							
					$total_followers = DB::instance(DB_NAME)->select_rows('select * from users_users where user_id_followed = '.$this->user->user_id.'');
					$this->template->total_number_of_followers = $total_number_of_followers = count($total_followers);

			}// End if
						
	}//End of Function
	
} # eoc
