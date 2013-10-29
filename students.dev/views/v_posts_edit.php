<div class="jumbotron">

	<?php foreach ($posts as $post): ?>
		<form method='POST' action='/posts/p_edit/<?php echo $post['id']; ?>'>
		
		  	<label><small>Quote Title</small></label>
		    <input type="text" name="title" class="form-control" value="<?php echo $post['title']; ?>" placeholder="Your Quote Title" autofocus="">
		
		    <label><small>Your Quote</small></label>
		    <textarea class="form-control" rows="4" cols="50" name="content"><?php echo $post['content']; ?></textarea><br />
		
		    <button class="btn btn-lg btn-primary btn-block" type="submit">Update My Quote!</button>	
		</form>
	<?php endforeach; ?>

	
</div>