<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	<!--Mobile specific meta goodness :) Ian Yates-->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!--google fonts-->
	<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700|PT+Serif:400,700,400italic' rel='stylesheet' type='text/css'>

	<!--css-->
	<!--<link rel="stylesheet" href="/css/master.css">-->
	<link rel="stylesheet" href="/css/styles.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <!-- Navigation highlight css 'iamhere' -->
	<script type="text/javascript" src="/js/highlightnavigation.js"> </script>
	


	<!-- Controller Specific JS/CSS -->
	<!-- <?php if(isset($client_files_head)) echo $client_files_head; ?>-->
	
</head>

<body id='<?php if(isset($body_id)) echo $body_id; ?>'>

	<div class="wrapper">
	
	<header>
		
		<h1 class="logo"><a href="">Lucille Kenney Jewelry</a></h1>
			
		<a class="to_nav" href="#primary_nav">Menu</a>
		
	</header>

	
	<article>
	
	<?php if(isset($content)) echo $content; ?>
	
	</article>

    <nav id='primary_nav'>
			<ul>
        		<li id="nav_index_index"><a href='/'>Home</a></li>
        		<li id="nav_products"><a href='/products'>Products</a></li>
        		<li id="nav_contact"><a href='/contact'>Contact</a></li>
        	</ul>
    </nav><!-- end primary_nav-->
        	<!-- Menu for users who are logged in -->
        	<?php if($user): ?>
    <nav id='access'>
			<ul >
            	<li id="nav_users_logout"><a href='/users/logout'>Logout</a></li>
            	<li id="nav_users_profile"><a href='/users/profile'>Profile</a></li>
            	<li id="nav_posts_add"><a href='/posts/add'>Add Post</a></li>
				<li class="top"><a href="#home" title="...">Top</a></li>            	
            </ul>
    </nav><!-- end primary_nav-->
        	<!-- Menu options for users who are not logged in -->
        	<?php else: ?>
    <nav id='access_out'>
        	<ul>
            	<li id="nav_users_signup"><a href='/users/signup'>Sign up</a></li>
            	<li id="nav_users_login"><a href='/users/login'>Log in</a></li>
				<li class="top"><a href="#home" title="...">Top</a></li>            
			</ul>
    </nav><!-- end primary_nav-->

        	<?php endif; ?>


    <br>

	<article>
	<!--<?php if(isset($client_files_body)) echo $client_files_body; ?>-->
	</article>
	</div><!--end wrapper-->
</body>
</html>