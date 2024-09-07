<?php
include('inc/header.php');
Session::checkSession();
include('inc/sidebar.php');

include('../lib/RetailProduct.php');

$retailProduct = new RetailProducts();

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addNewProduct'])) {
	$addRetailProduct = $retailProduct->AddProduct($_POST);
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
					if(isset($addRetailProduct)) {
						echo $addRetailProduct;
					}
				?>
				<h1 class="page-header">Add Retail Product</h1>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label>Date</label>
						<input type="text" name="ProentryDate" value="<?php echo date("Y/m/d"); ?>" class="form-control" />
					</div>
					<div class="form-group">
						<label for="pipe_name">Retail Product Name</label>
						<input type="text" name="RproductName" class="form-control" />
					</div>
					<div class="form-group">
						<label>Retail Product Details</label>
						<textarea class="form-control" name="RproductDetails" rows="3"></textarea>
					</div>
					<div class="form-group">
						<label>Quantity</label>
						<input type="number" name="productQuantity" class="form-control" />
					</div>
					<div class="form-group">
						<label>Unit Price</label>
						<input type="text" name="unitPrice" class="form-control" />
					</div>
					<div class="form-group">
						<label>Notes</label>
						<input type="text" name="proReference" class="form-control" />
					</div>
					<div class="form-group">
						<label>Upload Product Thumb</label>
						<input type="file" name="retailThumb" class="form-control" />
					</div>
					<button type="submit" name="addNewProduct" class="btn btn-success">Add product</button>
				</form>	
			</div>
		</div>
		  
	  </div>
	</div>
</div>
<?php include('inc/footer.php'); ?>