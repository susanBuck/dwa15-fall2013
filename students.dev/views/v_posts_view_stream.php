<!-- Start Error/Success Messages -->

<?php if(isset($_GET['no-permission'])): ?>
	<div class="alert alert-danger fade in">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<strong><i class="icon-info-sign"></i> I am sorry, you don't have permission to perform this task!</strong>
	</div>
<?php endif; ?>

<!-- End Error/Success Messages -->


<h1>What our users are Quoting...</h1>
<?php foreach ($view_posts as $post): ?>

		<!-- Start Post -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<!-- Process the Posts array -->
				<h3><a href="/posts/view/post/<?php echo $post['id']; ?>"><i class="icon-comment"></i> <?php echo $post['title']; ?></a></h3>
			</div>
			<div class="panel-body">
				<?php echo $post['content']; ?>
			</div>
			<div class="panel-footer">
				<strong><small>Created by:</strong> <a href="/posts/user/<?php echo $post['created_by']; ?>">
					<?php echo $post['first_name']; ?> <?php echo $post['last_name']; ?></a></small>
			</div>
		</div>
		<!-- End Post -->

<?php endforeach; ?>
