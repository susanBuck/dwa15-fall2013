<?php foreach($posts as $post): ?>

<article>

	<h1>You posted: </h1>

	<p><?=$post['content']?></p>

	<time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
		<?=Time::display($post['created'])?>
	</time>

</article>

<?php endforeach; ?>

<form method='POST' action='/posts/p_delete'>
<input type='submit' value='Delete Thought'>