<!DOCTYPE html>
<html>
	<head>
		<title><?php if(isset($title)) echo $title; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="/inc/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="/inc/css/default.css">
		<link rel="stylesheet" href="/inc/css/font-awesome.min.css">

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="/inc/js/jquery.min.js"></script>

		<!-- Latest compiled and minified JavaScript -->
		<script src="/inc/js/bootstrap.min.js"></script>
		<script src="/inc/js/jqBootstrapValidation.js"></script>
		<script src="/inc/js/custom.js"></script>
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="/js/html5shiv.js"></script>
			<script src="/js/respond.min.js"></script>
		<![endif]-->
		
		<!-- Controller Specific JS/CSS -->
		<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
	</head>
	
	<!-- Wrap all page content here -->
	<div id="wrap">
		<!-- Fixed navbar -->
		<div class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/"><img src="/inc/images/logo.png"></a>
				</div>
				<div class="collapse navbar-collapse pull-right">
					<ul class="nav navbar-nav">
						<li class="tooltiped" title="Total Number of Quotes">
							<a href="/posts/stream/"><span class="badge"> <?php echo $total_number_of_posts; ?> <i class="icon-comment"></i></span> 
							</a>
						</li>
						
						<?php if($user): ?>
						<li class="tooltiped" title="Number of Followers">
							<a href="/posts/users/"><span class="badge"> <?php echo $total_number_of_followers; ?> <i class="icon-thumbs-up"></i></span> 
							</a>
						</li>
						
						
						
						<li class="tooltiped" title="You are Following">
							<a href="/posts/"><span class="badge"> <?php echo $total_number_of_users; ?> <i class="icon-user"></i>
							</span></a>
						</li>

						<?php endif; ?> 
						
						<!-- Menu for users who are logged in -->
						<?php if($user): ?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome, <?php echo $user->first_name; ?> <?php echo $user->last_name; ?> <b class="caret"></b></a>

							<ul class="dropdown-menu">

								<li><a href="/posts/stream/">View All Quotes</a></li>
								<li class="divider"></li>

								<li><a href="/users/profile">View my Profile</a></li>
								<li><a href="/posts/user/<?php echo $user->user_id; ?>">View my Quotes</a></li>
								<li class="divider"></li>
								<li><a href="/posts/create/"><i class="icon-comment"></i> New Quote</a></li>
								<li class="divider"></li>
								<li><a href="/users/logout"><i class="icon-signout"></i> Sign Out</a></li>
							</ul>
						</li>

						<!-- Menu options for users who are not logged in -->
						<?php else: ?>
						
							<li><a href='/users/signup'><i class="icon-user"></i> Register</a></li>
							<li><a href='/users/login'><i class="icon-lock"></i> Sign In</a></li>
						
						<?php endif; ?> 
						
					</ul>
				</div>
			</div>
		</div>
		
		<!-- Start Page Content -->
		<div class="container content">
			<?php if(isset($content)) echo $content; ?>
			<?php if(isset($client_files_body)) echo $client_files_body; ?>
		</div>
		<!-- End Page Content -->
		
	</div>
	<div id="footer">
		<div class="container">
			<p class="text-muted credit"><?=APP_NAME?> is a project application for <a href="http://www.extension.harvard.edu/courses/dynamic-web-applications" target="_blank">Harvard University / CSIE-15</a> - 
			<strong>Professor:</strong> Susan Buck - <strong>Build by:</strong> Claudiu Rusnac</p>
		</div>
	</div>
	</body>
</html>