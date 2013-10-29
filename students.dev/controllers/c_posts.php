<?php
class posts_controller extends base_controller {


	public function __construct() {
        parent::__construct();
    } 



	########### //Index POST ###########
	public function index() {
	
		//Check to see if the user is logged in
		if(!$this->user) {
			
				//Setup up the view of all quotes.
				$this->template->content = View::instance('v_posts_view_stream');
				$this->template->title   = "View All Posts";
		
				//Query the DB for all posts and put into array	        		
				$view_posts = DB::instance(DB_NAME)->select_rows('SELECT * FROM posts LEFT JOIN users ON posts.created_by = users.user_id GROUP BY posts.id ORDER BY posts.id DESC');
        
				$this->template->content->view_posts = $view_posts;
                                		
				//Display view
				echo $this->template;
		
		
		//If the user is logged in, display quotes of only who they are following.	
		}else{
			    # Set up the View
			    $this->template->content = View::instance('v_posts_view_index');
			    $this->template->title   = "All Posts";
			
				$user_id = $this->user->user_id;
								
			    # Query
			    $q = "SELECT
			    		posts.id AS id,
			    		posts.title AS title,
			            posts.content AS content,
			            posts.created_by AS post_created_by,
			            posts.created,
			            users_users.user_id AS follower_id,
			            users.first_name,
			            users.last_name
			        FROM posts
			        INNER JOIN users_users
			        INNER JOIN users ON posts.created_by = users.user_id
			        WHERE users_users.user_id = $user_id
			        AND posts.created_by = users_users.user_id_followed ORDER BY posts.id DESC";
			
			    # Run the query, store the results in the variable $posts
			    $posts = DB::instance(DB_NAME)->select_rows($q);
			
			    # Pass data to the View
			    $this->template->content->posts = $posts;
			
			    # Render the View
			    echo $this->template;
			}		    

		}//End of Function
		
		

	########### //View All Post Stream ###########
	public function stream(){
		
		//Define view parameters
				$this->template->content = View::instance('v_posts_view_stream');
				$this->template->title   = "View All Posts";
		
				//Query the DB for all posts and put into array	        		
				$view_posts = DB::instance(DB_NAME)->select_rows('SELECT * FROM posts LEFT JOIN users ON posts.created_by = users.user_id GROUP BY posts.id ORDER BY posts.id DESC');
        
				$this->template->content->view_posts = $view_posts;
                                		
				//Display view
				echo $this->template;	
		
		
		
	}//End of Function
	
	
	
	########### //View Posts ###########
	public function view($view_posts = NULL, $post = NULL){
	
		
				//Define view parameters
				$this->template->content = View::instance('v_posts_view_single');
				$this->template->title   = "View Post";
				
				//Query the posts table and Join with the users table for a single row
				$q = "SELECT posts.*,
							users.first_name,
							users.last_name,
							users.user_id 
						FROM posts LEFT JOIN users ON (posts.created_by = users.user_id) WHERE id = $post";
												
				//Query the DB for all posts and put into array	        		
				$view_posts = DB::instance(DB_NAME)->select_rows($q);
	
				$this->template->content->view_posts = $view_posts;
								
				//Display view
				echo $this->template;	
	
	}//End of fuction
	
	
	
	########### //View Posts ###########
	public function user($user = NULL, $connections = NULL){
				
				//Define view parameters
				$this->template->content = View::instance('v_posts_view_user');
				$this->template->title   = "View User Posts";
				
				
					//Check to make sure user is logged in before tasks are performed.
					if($this->user) {
	
						$current_user = $this->user->user_id;
		
						//Query DB to determine if my user is 
						$connections_q = "SELECT * FROM users_users WHERE user_id = $current_user AND user_id_followed = $user";
						
						//Query the DB
						$connections = DB::instance(DB_NAME)->select_rows($connections_q);
						
					    //Pass data to quoery
					    $this->template->content->connections = $connections;
				    }

				
				//Query the posts table for a single row
				$q = "SELECT posts.*,
							users.first_name,
							users.last_name
						FROM posts LEFT JOIN users ON (posts.created_by = users.user_id) WHERE created_by = $user ORDER BY posts.id DESC";
				
				//Query the DB for all posts that belong to the specified user and put into array	        		
				$view_posts = DB::instance(DB_NAME)->select_rows($q);
				
				
				$this->template->content->view_posts = $view_posts;
				
								
				//Display view
				echo $this->template;
				
	}//End of Function
	
	
	
	########### //Create Posts ###########
	public function create(){
	
		//Check to make sure user is logged in.
		if(!$this->user) {
			Router::redirect('/users/login/');
			
		}else{
		
			//Define view parameters
			$this->template->content = View::instance('v_posts_create');
			$this->template->title   = "Create a New Post";
			
			//Display the template
			echo $this->template;
		
		}//End of else
		
	}//End of function
	

	
	########### //Process Create Posts ###########
	public function p_create(){
		
		//Sanitize all inputs
		$_POST = DB::instance(DB_NAME)->sanitize($_POST);
		
		//Validate that something has been entered.
		$title = $_POST['title'];
		$content  = $_POST['content'];
		
			if($title == '' || $content == '') {
				Router::redirect('/posts/create/?empty-post');
			}
		
		
		// Specify created and modified time that will be posted to the DB.
		$_POST['created']  = Time::now();
		$_POST['modified'] = Time::now();
		
		$_POST['created_by'] = $this->user->user_id;
				
		// Process from _POST parameters and insert them into the DB. 
		$user_id = DB::instance(DB_NAME)->insert('posts', $_POST);
		
		//Set success message for the view 
		Router::redirect('/posts/user/'.$this->user->user_id.'/?create-successful');
		
	}// End of Function
	

		
	########### //Edit Posts ###########
	public function edit($post = NULL){
	
		//Determine if the user is logged in
		if(!$this->user) {
			Router::redirect('/users/login/?no-permission');
		
		}
		
		//Specify the current logged in users ID.  Required to compare if the user created the post.	
		$user = $this->user->user_id;
		
		//Query to determine which user the post and if it belongs to the logged in user.
		$q = "select * from posts where id = $post and created_by = $user";	
		$posts = DB::instance(DB_NAME)->select_rows($q);
		
			
		if(!empty($posts)){
		
				//Define view parameters
				$this->template->content = View::instance('v_posts_edit');
				$this->template->title   = "Edit a New Post";
				
				//Send post array to the view
				$this->template->content->posts = $posts;

				//Display the template
				echo $this->template;
					 
			}else{
		
				//Redirect to view posts with an error
				Router::redirect('/posts/stream/?no-permission');
			
			}// End of Else
		
	}// End of Function


	
	########### //Edit Posts ###########
	public function p_edit($post = NULL){
	
		//Determine if the user is logged in
		if(!$this->user) {
			Router::redirect('/users/login/?no-permission');
		
		}
		
		//Specify the current logged in users ID.  Required to compare if the user created the post.	
		$user = $this->user->user_id;
		
		//Query to determine which user the post and if it belongs to the logged in user.
		$q = "select * from posts where id = $post and created_by = $user";	
		$posts = DB::instance(DB_NAME)->select_rows($q);
		
				
		if(!empty($posts)){
		
				//Validate that something has been entered.
				$title = $_POST['title'];
				$content  = $_POST['content'];
				
				if($title == '' || $content == '') {
					Router::redirect('/posts/view/posts/'.$post.'/?empty-post');
				}
	
				//Sanitize all inputs
				$_POST = DB::instance(DB_NAME)->sanitize($_POST);
				
				// Specify created and modified time that will be posted to the DB.
				$_POST['modified'] = Time::now();
				
				// Process from _POST parameters and insert them into the DB. 
				DB::instance(DB_NAME)->update("posts", $_POST, "WHERE id = $post");
				
				//Set success message for the view 
				Router::redirect('/posts/view/posts/'.$post.'/?post-updated');
		
			}else{
			
				//Redirect to view posts with an error
				Router::redirect('/posts/stream/?no-permission');
			
		}// End of else
		
		
	}//End of function
	
	

	########### //Delete Post ###########
	public function delete($post = NULL){
	
		//Determine if the user is logged in
		if(!$this->user) {
			Router::redirect('/users/login/?no-permission');
		}
			
		//Specify the current logged in users ID.  Required to compare if the user created the post.	
		$user = $this->user->user_id;
		
		//Query to determine which user the post and if it belongs to the logged in user.
		$q = "select * from posts where id = $post and created_by = $user";	
		$posts = DB::instance(DB_NAME)->select_rows($q);
									
		//Determin if the post belongs to the user who created it
		if(!empty($posts)){
									
				//Delete the post.
				DB::instance(DB_NAME)->delete('posts', "WHERE id = '$post'");
				
				//Redirect to view posts with a success message.
				Router::redirect('/posts/user/'.$this->user->user_id.'/?delete-success');
						
			//The query will be empty if the user did not create the post.		
			}else{
			
				//Redirect to view posts stream with an error
				Router::redirect('/posts/stream/?no-permission');
			
				}//end of else			
		
		}//End of function
		
		
	########### //Display User to Follow ###########
	public function users() {
	
		//Check to make sure user is logged in.
		if(!$this->user) {
		
				Router::redirect('/users/login/');
			
		
			}else{

			    # Set up the View
			    $this->template->content = View::instance("v_posts_users");
			    $this->template->title   = "Users";
			    
			    $current_user = $this->user->user_id;

			
			    # Build the query to get all the users
			    $q = "SELECT * FROM users";
			
			    # Execute the query to get all the users. 
			    # Store the result array in the variable $users
			    $users = DB::instance(DB_NAME)->select_rows($q);
			
			    # Build the query to figure out what connections does this user already have? 
			    # I.e. who are they following
			    
			    $q = "SELECT * 
			        	FROM users_users
						WHERE user_id = $current_user ";
										
			    # Execute this query with the select_array method
			    # select_array will return our results in an array and use the "users_id_followed" field as the index.
			    # This will come in handy when we get to the view
			    # Store our results (an array) in the variable $connections
			    $connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');
			
			    # Pass data (users and connections) to the view
			    $this->template->content->users       = $users;
			    $this->template->content->connections = $connections;
			
			    # Render the view
			    echo $this->template;
			    
			    }//End of Else
		    
	}// End of Function
	
	
	########### //Follow Function ###########
	public function follow($user_id_followed) {

	    # Prepare the data array to be inserted
	    $data = Array(
	        "created" => Time::now(),
	        "user_id" => $this->user->user_id,
	        "user_id_followed" => $user_id_followed
	        );
	
	    # Do the insert
	    DB::instance(DB_NAME)->insert('users_users', $data);
	    		
	    # Send them back
	    Router::redirect("/posts/users");
	
	}// End of Function
	
	
	########### //Un-follow Function ###########
	public function unfollow($user_id_followed) {
	
	    # Delete this connection
	    $where_condition = 'WHERE user_id = '.$this->user->user_id.' AND user_id_followed = '.$user_id_followed;
	    DB::instance(DB_NAME)->delete('users_users', $where_condition);
	
	    # Send them back
	    Router::redirect("/posts/users");
	
	}// End of Function
		
				
	
} # end of class
