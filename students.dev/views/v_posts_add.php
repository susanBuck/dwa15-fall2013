<form method='POST' action='/posts/p_add'>

    <label for='content'>New Post</label><br>
    <textarea  cols="60" rows="10" name='content' id='content'>Say something nice.</textarea>
    
    <br><br>
    <input type='submit' value='New Post'>

</form>

<br> <br>


<!--<article>
<?php foreach($posts as $post): ?>



    <h1><?=$post['first_name']?> <?=$post['last_name']?> posted:</h1>

    <p><?=$post['content']?></p>

    <time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
        <?=Time::display($post['created'])?>
    </time>

</article>

<?php endforeach; ?>-->