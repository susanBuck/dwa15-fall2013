<h1><?php echo $user->first_name; ?>, what your followers are Quoting...</h1>

<?php if(empty($posts)): ?>

<!-- Start Error/Success Messages -->

	<div class="alert alert-warning fade in">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<strong><i class="icon-info-sign"></i> I'm sorry, you don't have an followers or your followers haven't posted anything yet. <br />Start <i class="icon-thumbs-up"></i> <a href="/posts/users/"> following!</a>. </strong>
	</div>

<!-- End Error/Success Messages -->


<?php endif; ?>


<?php foreach ($posts as $post): ?>

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
				<strong><small>Created by:</strong> <a href="/posts/user/<?php echo $post['post_created_by']; ?>">
					<?php echo $post['first_name']; ?> <?php echo $post['last_name']; ?></a> on <em><?php echo Time::display($post['created'], 'M d, Y @ g:i a T'); ?></em></small>
			</div>
		</div>
		<!-- End Post -->

<?php endforeach; ?>