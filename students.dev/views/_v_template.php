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
		
			<h1 class="logo"><a href="">Talkfest</a></h1>
			
			<a class="to_nav" href="#access">Menu</a>
		
		</header>

		<article>
	
		<?php if(isset($content)) echo $content; ?>
	
		</article>

		<!-- 
			I placed the nav bar here because I'm using a mobile first responsive template 
			which gives more importance to content with the nav bar listed under content and
			a 'menu' link (for smaller browsers) at the top to bounce to the nav below 
		-->

    	<!-- Primary navigation accessible to all -->
    	<nav id='primary_nav'>
			<ul>
        		<li id="navindex_index"><a href='/'>Home</a></li>
        		<li id="navproducts"><a href='/products'>Products</a></li>
        		<li id="navcontact"><a href='/contacts'>Contact</a></li>
        	</ul>
    	</nav><!-- end primary_nav-->
    
    	<!-- Menu for users who are logged in -->
    	<?php if($user): ?>
    		<nav id='access'>
				<ul >
            		<!--<li id="navadd"><a href='/posts/add'>Add</a></li>-->
            		<li id="navtalkers"><a href='/posts'>Talkers</a></li>
            		<li id="navusers"><a href='/posts/users'>Members</a></li>
            		<li id="navprofile"><a href='/users/profile'>Profile</a></li>
            		<li id="navlogout"><a href='/users/logout'>Logout</a></li>
					<li class="top"><a href="#home">Top</a></li>            	
            	</ul>
    		</nav><!-- end primary_nav-->
    	
    	<!-- Menu options for users who are not logged in -->
    	<?php else: ?>
    		<nav id='access_out'>
        		<ul>
            		<li id="navsignup"><a href='/users/signup'>Sign up</a></li>
            		<li id="navlogin"><a href='/users/login'>Log in</a></li>
				</ul>
    		</nav><!-- end primary_nav-->

    	<?php endif; ?>

    	<br>
    
    	<footer>
    
    		<p id='mySpan'>Lucille Kenney, Dynamic Website Development with Susan Buck at Harvard Extension &copy;2013</p>
    
    	</footer>
		
	</div><!--end wrapper-->
	
	<!--<?php if(isset($client_files_body)) echo $client_files_body; ?>-->
	
</body>
</html>
