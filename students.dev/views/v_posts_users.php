<!-- View to follow or unfollow all users -->

<? foreach($users as $user): ?>
	<div class='users cf'>
			<ul>
				<li class='name'>
    				<!-- Print this user's name -->
    				<?=$user['first_name']?> <?=$user['last_name']?>
    			</li>
    			<li class='website'>
					<!-- Display website content -->
					<a href='<?=$user['website']?>'><?=$user['website']?></a>		
				</li>
    		</ul>
    		
    		<!-- If there exists a connection with this user, show a unfollow link -->
    		<? if(isset($connections[$user['user_id']])): ?>
        		<a href='/posts/unfollow/<?=$user['user_id']?>' class='buttonLink'>
        			Unfollow
        		</a>
    		<!-- Follow button -->
    		<? else: ?>
        		<a href='/posts/follow/<?=$user['user_id']?>' class='buttonLink'>
        			Follow
        		</a>
    		<? endif; ?>
    	<br><br>
	</div>
<? endforeach; ?>
