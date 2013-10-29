<h1>Search Users</h1>


<!-- Start Search -->
<div class="well">
	<div class="container">
		<form method="GET" class="form-inline" action="/search/users/">
			<input name="query" class="form-control" placeholder="Search Users....">
		</form>
	</div>
</div>
<!-- End Search -->

<?php if(empty($view_users) || empty($_GET['query'])): //Check to see if a user has any posts, if they don't dipslay an error.?>
<div class="alert alert-success fade in">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<strong><i class="icon-info-sign"></i> There are no users that match your Search.</strong><br />Please try your search again.
</div>



<?php else: //If they have posts, show them below and process the $view_posts ARRAY. ?>
	<?php foreach ($view_users as $user): ?>
	
			<!-- Start User -->
			<div class="panel panel-default">
				<div class="panel-body">
					<!-- Process the Posts array -->
					<div class="col-md-8">
						<h4><?php echo $user['first_name']; ?> <?php echo $user['last_name']; ?></h4>
					</div>
					
					<div class="col-md-4">
						<div class="pull-right">
						<a href="/posts/user/<?=$user['user_id']?>/" class="btn btn-default  btn-sm">View Quotes </a>
							
							<!-- If there exists a connection with this user, show a unfollow link -->
							<? if(isset($connections[$user['user_id']])): ?>
							<a class="btn btn-primary btn-sm" style="width: 100px;" href='/posts/unfollow/<?=$user['user_id']?>'><i class="icon-thumbs-down"></i> Unfollow</a>
							<!-- Otherwise, show the follow link -->
							<? else: ?>
							<a class="btn btn-success btn-sm" style="width: 100px;" href='/posts/follow/<?=$user['user_id']?>'><i class="icon-thumbs-up"></i> Follow</a>
							<? endif; ?>
							
							
						</div>
					</div>
					
					
				</div>
			</div>
			<!-- End User -->
			
	<?php endforeach; ?>
<?php endif; ?>