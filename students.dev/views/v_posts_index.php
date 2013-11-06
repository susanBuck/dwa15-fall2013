<section>

<article>
	<h1 class="title">All Things European Blogs</h1>
</article>

<?php foreach($posts as $post): ?>

<article>

	<p><img src="<?=$user->picture; ?>" class='profile'></p>

    <h2><?=$post['first_name']?> <?=$post['last_name']?> posted:</h2>

    <p><?=$post['content']?></p>

    <time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
        <?=Time::display($post['created'])?>
    </time>

</article>

<?php endforeach; ?>

</section>