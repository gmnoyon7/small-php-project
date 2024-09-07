<?php
include('inc/header.php');
Session::checkSession();
include('inc/sidebar.php');

include('../lib/Stuff.php');

$stuffAdd = new Stuff();

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addStuff'])) {
	$addStuff = $stuffAdd->StuffRegistration($_POST);
}

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
					if(isset($addStuff)) {
						echo $addStuff;
					}
				?>
				<h1 class="page-header">Add Stuff</h1>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="name" class="form-control" />
					</div>
					<div class="form-group">
						<label>Email address</label>
						<input type="text" name="email" class="form-control" />
					</div>
					<div class="form-group">
						<label>Mobile number</label>
						<input type="text" name="mobile" class="form-control" />
					</div>
					<div class="form-group">
						<label>Address</label>
						<input type="text" name="address" class="form-control" />
					</div>
					<button type="submit" name="addStuff" class="btn btn-success">Add Stuff</button>
				</form>	
			</div>
		</div>
		  
	  </div>
	</div>
</div>
<?php include('inc/footer.php'); ?>