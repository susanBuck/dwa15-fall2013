<?php if(isset($_GET['post-updated'])): ?>
<div class="alert alert-success fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong><i class="icon-info-sign"></i> Your post has been update!</strong>
</div>
<?php endif; ?>


<div class="panel panel-default">
	<div class="panel-heading">
		
		<!-- Process the Posts array -->
		<?php foreach ($view_posts as $post): ?>
		
		<div class="row">
			<div class="col-md-10">
				<h3><i class="icon-comment"></i> <?php echo $post['title']; ?></h3>
			</div>
			<?php if($user): //Check if the user is loggged in...?>
				<?php if($user->user_id == $post['created_by']): //See if the post belongs to the logged in user...?>
				<div class="col-md-2">
					<div class="pull-right">
					
					<!-- Split button -->
						<div class="btn-group">
						  <button type="button" class="btn btn-primary"><i class="icon-cog"></i> Action</button>
						  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
						    <span class="caret"></span>
						  </button>
						  <ul class="dropdown-menu" role="menu">
						    <li><a href="/posts/edit/<?php echo $post['id']; ?>"><i class="icon-edit"></i> Edit Quote</a></li>
						    <li><a href="#delete" data-toggle="modal" ><i class="icon-ban-circle"></i> Delete Quote</a></li>
						  </ul>
						</div>
					
					
					
					
						

					</div>
				</div>
				<?php endif; ?>
			<?php endif; ?> 
		</div>
	</div>
	
	<div class="panel-body">
		<?php echo $post['content']; ?>
	</div>
	
	<ul class="list-group">
		<li class="list-group-item"><small><strong>Created by:</strong> <a href="/posts/user/<?php echo $post['user_id']; ?>"><?php echo $post['first_name']; ?> <?php echo $post['last_name']; ?></a></small></li>
		<li class="list-group-item"><small><strong>Created on:</strong> <em><?php echo Time::display($post['created'], 'M d, Y @ g:i a T'); ?></em></small></li>
		<li class="list-group-item"><small><strong>Modified on:</strong> <em><?php echo Time::display($post['modified'], 'M d, Y @ g:i a T'); ?></em></small></li>
	</ul>
	<div class="panel-footer"></div>
</div>

<div class="modal fade" id="delete">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Delete Post: <?php echo $post['title']; ?></h4>
      </div>
      <div class="modal-body">
      	<p>Are you sure you want to delete this post?</p>
      </div>
      
      <div class="modal-footer">
        <a href="/posts/delete/<?php echo $post['id']; ?>" type="button" class="btn btn-danger"><i class="icon-ban-circle"></i> Yes, Please Delete Post</a>
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<?php endforeach; ?>