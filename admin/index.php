<?php
include('inc/header.php');
Session::checkSession();

include('../lib/config.php');
include('inc/sidebar.php');

include('../lib/RetailProduct.php');
include('../lib/ManufacturingProduct.php');

$retailProduct = new RetailProducts();
$manufacturingProduct = new ManufacturingProducts();


?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-2 main">
			<?php
				$loginmsg = Session::get("loginmsg");
				if(isset($loginmsg)) {
					echo $loginmsg;
				}
				Session::set("loginmsg", null);
			?>
		  <p class="visible-xs">
			<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
		  </p>
		  
		  <h1 class="page-header">Dashboard</h1>
		  
			<div class="row">
				<div class="col-sm-6">
					<h3>Manufacturing Products</h2>
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
								  <th>Product Name</th>
								  <th>Stock</th>
								  <th>Unit Price</th>
								  <th>Total Price</th>
								</tr>
							</thead>
						  <tbody>
							<?php
								$productlist = $manufacturingProduct->ProductList(5);
								foreach($productlist as $list) {
							?>
								<tr>
									<td width="20%"><?php echo $list['productName']; ?></td>
									<td width="10%"><?php echo $list['quantity']; ?></td>
									<td width="10%"><?php echo $list['salePrice']; ?></td>
									<td width="10%">Tk <?php echo $list['salePrice'] * $list['quantity']; ?></td>
								</tr>
							<?php } ?>
						  </tbody>
						</table>
					</div>
					<div class="text-right">
						<a href="manufacturing-products.php" class="btn btn-info">View More</a>
					</div>
				</div>
				<div class="col-sm-6">
					<h3>Retails Products</h2>
					<div class="table-responsive">
						<table class="table table-striped">
							  <thead>
								<tr>
								  <th>Product Name</th>
								  <th>Stock</th>
								  <th>Unit Price</th>
								  <th>Total Price</th>
								</tr>
							  </thead>
							  <tbody>
								<?php
									$stk_limited = 'Stock Limited';
									$productlist = $retailProduct->ProductList(5);
									foreach($productlist as $list) {
								?>
								<tr>
									<td><?php echo $list['pipeName']; ?></td>
									<td><?php echo $list['quantity']; ?></td>
									<td><?php echo $list['unitPrice']; ?></td>
									<td>Tk <?php echo $list['quantity'] * $list['unitPrice']; ?></td>
								</tr>
								<?php } ?>
							  </tbody>
						</table>
					</div>
					<div class="text-right">
						<a href="retail-products.php" class="btn btn-info">View More</a>
					</div>
				</div>
			</div>
		  
	  </div>
	</div>
</div>
<?php include('inc/footer.php'); ?>