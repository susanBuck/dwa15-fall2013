<!-- Start Error/Success Messages -->
<?php if(isset($_GET['empty-post'])): ?>
<div class="alert alert-danger fade in">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<strong><i class="icon-info-sign"></i> Your Quote was empty!</strong> Please try again.
</div>
<?php endif; ?>
<!-- End Error/Success Messages -->


<div class="jumbotron">
	<form method="POST" action="/posts/p_create">
	
		<label><small>Quote Title</small></label>
		<input type="text" name="title" class="form-control" placeholder="Your Quote Title" autofocus="">
		
		<label><small>Your Quote</small></label>
		<textarea class="form-control" rows="4" cols="50" name="content"></textarea>
			<br />
			
		<button class="btn btn-lg btn-primary btn-block" type="submit">Quote Me!</button>
	</form>
</div>