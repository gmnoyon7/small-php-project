<?php
include('inc/header.php');
Session::checkSession();
include('inc/sidebar.php');

include('../lib/Customer.php');

$customers = new Customer();

if(isset($_GET['deleteCustomer'])) {
	$delCustomer = $customers->DeleteCustomer($_GET['deleteCustomer']);
}

?>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-2 main">
		
		  <p class="visible-xs">
			<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
		  </p>
		  
		  <h1 class="page-header">Customer list</h1>
		  <?php
			if(isset($delCustomer)) {
				echo $delCustomer;
			}
			$customerList = $customers->customerList();
			if($customerList) {
		  ?>
			  <div class="table-responsive">
				<table class="table table-striped">
				  <thead>
					<tr>
					  <th>Name</th>
					  <th>Email</th>
					  <th>Mobile</th>
					  <th>Address</th>
					</tr>
				  </thead>
				  <tbody>
					<?php
						foreach($customerList as $list) {
					?>
					<tr>
						<td><?php echo $list['name']; ?></td>
						<td><?php echo ucwords($list['email']); ?></td>
						<td><?php echo $list['mobile']; ?></td>
						<td><?php echo $list['address']; ?></td>
						<td class="text-right">
							<a class="btn btn-warning" href="?editCustomer=<?php echo $list['id']; ?>">Edit</a>
							<a href="?deleteCustomer=<?php echo $list['id']; ?>" class="btn btn-danger">Delete</button>
						</td>
					</tr>
					<?php } ?>
				  </tbody>
				</table>
			  </div>
		  <?php } ?>
	  </div>
	</div>
</div>
<?php include('inc/footer.php');