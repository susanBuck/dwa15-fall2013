<?php
class search_controller extends base_controller {


	public function __construct() {
        parent::__construct();
    } 


	########### //Main Reset Function ###########
	public function posts($view_posts = NULL){
	
		//Define view paramters
		$this->template->content = View::instance('v_search_posts');
		$this->template->title   = "Search Posts";
		
		$query = $_GET['query'];
		
		//Specify that the USER query is
		$this->template->content->query = $query;
		
		$q = "	SELECT  *
				FROM    posts
				WHERE   title LIKE '%$query%' OR content LIKE '%$query%'";
				
				//Query the DB for all posts and put into array	        		
				$view_posts = DB::instance(DB_NAME)->select_rows($q);
	
				$this->template->content->view_posts = $view_posts;


		//Display view
		echo $this->template;
		
	
	}//End of Function

	
	########### //Main Reset Function ###########
	public function users($view_users = NULL){
	
		//Define view paramters
		$this->template->content = View::instance('v_search_users');
		$this->template->title   = "Search Users";
		
		$query = $_GET['query'];
		
		
		
		//Specify that the USER query is
		$this->template->content->query = $query;
		
		$q = "	SELECT  *
				FROM    users
				WHERE   first_name LIKE '%$query%' OR last_name LIKE '%$query%'";
								
				//Query the DB for all posts and put into array	        		
				$view_users = DB::instance(DB_NAME)->select_rows($q);
	
				$this->template->content->view_users = $view_users;
				
		# Build the query to get all the users
		    $q = "SELECT * FROM users";
		
		    # Execute the query to get all the users. 
		    # Store the result array in the variable $users
		    $users = DB::instance(DB_NAME)->select_rows($q);
		
		    # Build the query to figure out what connections does this user already have? 
		    # I.e. who are they following
		    $q = "SELECT * 
		        	FROM users_users
					WHERE user_id = ".$this->user->user_id;
		
		    # Execute this query with the select_array method
		    # select_array will return our results in an array and use the "users_id_followed" field as the index.
		    # This will come in handy when we get to the view
		    # Store our results (an array) in the variable $connections
		    $connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');
		
		    # Pass data (users and connections) to the view
		    $this->template->content->users       = $users;
		    $this->template->content->connections = $connections;


		//Display view
		echo $this->template;
		
	
	}//End of Function


	

		
} // end of class