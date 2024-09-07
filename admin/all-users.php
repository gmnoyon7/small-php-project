<?php
include('inc/header.php');
Session::checkSession();
include('inc/sidebar.php');

include('../lib/User.php');

$users = new User();

?>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-2 main">
		
		  <p class="visible-xs">
			<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
		  </p>
		  
		  <h1 class="page-header">User list</h1>
		  
		  <div class="table-responsive">
			<table class="table table-striped">
			  <thead>
				<tr>
				  <th>Username</th>
				  <th>Name</th>
				  <th>Email</th>
				  <th>Role</th>
				</tr>
			  </thead>
			  <tbody>
				<?php
					$userlist = $users->UserList();
					foreach($userlist as $list) {
				?>
				<tr>
					<td><?php echo $list['username']; ?></td>
					<td><?php echo ucwords($list['username']); ?></td>
					<td><?php echo ucwords($list['email']); ?></td>
					<td>administrator</td>
				</tr>
				<?php } ?>
			  </tbody>
			</table>
		  </div>
		  
	  </div>
	</div>
</div>
<?php include('inc/footer.php'); ?>