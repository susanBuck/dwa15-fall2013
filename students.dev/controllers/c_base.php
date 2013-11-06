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
			
		# Default the body_id to be controller + method name
			$this->template->body_id = Router::$controller.'_'.Router::$method;
			
		# Default the body_id to be controller + method name
			$this->template->li_id = Router::$controller.'_'.Router::$method;			
	}
	
} # eoc
