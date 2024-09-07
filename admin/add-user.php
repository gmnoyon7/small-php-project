<?php
include('inc/header.php');
Session::checkSession();
include('inc/sidebar.php');

include('../lib/User.php');

$userAdd = new User();

/* if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addNewProduct'])) {
	$addRetailProduct = $userAdd->AddProduct($_POST);
} */

?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-2 main">
		
		<p class="visible-xs">
			<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
		</p>
		  
		
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<?php
					if(isset($addRetailProduct)) {
						echo $addRetailProduct;
					}
				?>
				<h1 class="page-header">Add User</h1>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
					<div class="form-group">
						<label>Full Name</label>
						<input type="text" name="fulname" class="form-control" />
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="text" name="email" class="form-control" />
					</div>
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="username" class="form-control" />
					</div>
					<div class="form-group">
						<label for="pipe_name">Password</label>
						<input type="password" name="password" class="form-control" />
					</div>
					<div class="form-group">
						<label for="pipe_details">Role</label>
						<select class="form-control" name="role">
							<option value="1">Administrator</option>
							<option value="2">Manager</option>
						</select>
					</div>
					<button type="submit" name="adduser" class="btn btn-success">Add User</button>
				</form>	
			</div>
		</div>
		  
	  </div>
	</div>
</div>
<?php include('inc/footer.php'); ?>