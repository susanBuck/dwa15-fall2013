<h1>Search Posts</h1>


<!-- Start Search -->
<div class="well">
	<div class="container">
		<form method="GET" class="form-inline" action="/search/posts/">
			<input name="query" class="form-control" placeholder="Search Quotes....">
		</form>
	</div>
</div>
<!-- End Search -->


<?php if(empty($view_posts) || empty($_GET['query'])): //Check to see if a user has any posts, if they don't dipslay an error.?>
<div class="alert alert-success fade in">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<strong><i class="icon-info-sign"></i> There are no Quotes that match your Search.</strong><br />Please try your search again.
</div>


<?php else: //If they have posts, show them below and process the $view_posts ARRAY. ?>
	<?php foreach ($view_posts as $post): ?>
	
			<!-- Start Post -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<!-- Process the Posts array -->
					<h4><a href="/posts/view/post/<?php echo $post['id']; ?>"><i class="icon-comment"></i> 
						<?php echo $post['title']; ?></a>
					</h4>
				</div>
				<div class="panel-body">
					<?php echo $post['content']; ?>
				</div>
			</div>
			<!-- End Post -->
			
	<?php endforeach; ?>
<?php endif; ?>