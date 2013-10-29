<div class="panel panel-default">
	<div class="panel-body">
		<h1>Follow Users</h1>
		
		<!-- Start Search -->
		<div class="well">
			<div class="container">
				<form method="GET" class="form-inline" action="/search/users/">
					<input name="query" class="form-control" placeholder="Search Users....">
				</form>
			</div>
		</div>
		<!-- End Search -->

		
		<hr>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Quotes</th>
					<th>Options</th>
				</tr>
			</thead>
			<tbody>
				<? foreach($users as $user): ?>
				<tr>
					<td><?=$user['first_name']?> </td>
					<td><?=$user['last_name']?> </td>
					<td><a href="/posts/user/<?=$user['user_id']?>/" class="btn btn-default  btn-sm">View Quotes </a></td>
					<td style="width: 15%;">
						<!-- If there exists a connection with this user, show a unfollow link -->
						<? if(isset($connections[$user['user_id']])): ?>
						<a class="btn btn-primary btn-sm" style="width: 100px;" href='/posts/unfollow/<?=$user['user_id']?>'><i class="icon-thumbs-down"></i> Unfollow</a>
						<!-- Otherwise, show the follow link -->
						<? else: ?>
						<a class="btn btn-success btn-sm" style="width: 100px;" href='/posts/follow/<?=$user['user_id']?>'><i class="icon-thumbs-up"></i> Follow</a>
						<? endif; ?>
					</td>
				</tr>
				<? endforeach; ?>
			</tbody>
		</table>
	</div>
</div>