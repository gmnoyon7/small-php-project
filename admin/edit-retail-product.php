<?php
include('inc/header.php');
Session::checkSession();
include('inc/sidebar.php');

include('../lib/RetailProduct.php');

if(!isset($_GET['editRetail']) or $_GET['editRetail'] == null) {
	header('Location:retail-products.php');
} else {
	$id = $_GET['editRetail'];
}

$retailProduct = new RetailProducts();

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateRetail'])) {
	$updateRetailProduct = $retailProduct->updateRetailProduct($id, $_POST);
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
					if(isset($updateRetailProduct)) {
						echo $updateRetailProduct;
					}
				?>
				<h1 class="page-header">Add Retail Product</h1>
				<?php
				$retailData = $retailProduct->getRetailById($id);
				if($retailData) {
					foreach($retailData as $info) {
				?>
					<form action="" method="POST">
						<div class="form-group">
							<label>Date</label>
							<input type="text" name="ProentryDate" value="<?php echo $info['date']; ?>" class="form-control" />
						</div>
						<div class="form-group">
							<label for="pipe_name">Retail Product Name</label>
							<input type="text" name="upRproductName" value="<?php echo $info['pipeName']; ?>" class="form-control" />
						</div>
						<div class="form-group">
							<label>Retail Product Details</label>
							<textarea class="form-control" name="uPRproductDetails" rows="3">
								<?php echo $info['pipeDetails']; ?>
							</textarea>
						</div>
						<div class="form-group">
							<label>Quantity</label>
							<input type="number" name="uPproductQuantity" value="<?php echo $info['quantity']; ?>" class="form-control" />
						</div>
						<div class="form-group">
							<label>Unit Price</label>
							<input type="text" name="uPunitPrice" value="<?php echo $info['unitPrice']; ?>" class="form-control" />
						</div>
						<div class="form-group">
							<label>Notes</label>
							<input type="text" name="uPproReference" value="<?php echo $info['reference']; ?>" class="form-control" />
						</div>
						<!--<div class="form-group">
							<label>Upload Product Thumb</label>
							<input type="file" name="retailThumb" value="" class="form-control" />
						</div>-->
						<button type="submit" name="updateRetail" class="btn btn-success">Update</button>
					</form>	
				<?php
					} 
				}
				?>
			</div>
		</div>
		  
	  </div>
	</div>
</div>
<?php include('inc/footer.php'); ?>