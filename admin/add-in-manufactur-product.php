<?php
include('inc/header.php');
Session::checkSession();
include('inc/sidebar.php');

include('../lib/ManufacturingProduct.php');

$MFproduct = new ManufacturingProducts();

if($_SERVER['REQUEST_METHOD'] && isset($_POST['updateQuantity'])) {
	$updateQty = $MFproduct->updateMFqty($_POST);
}

?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-2 main">
		
		<p class="visible-xs">
			<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
		</p>
		 
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-header">Update manufacturing product quantity</h1>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-6">
				<?php
					if(isset($addRetailProduct)) echo $addRetailProduct;
					if(isset($updateQty)) echo $updateQty;
				?>
				
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
					<?php $productlist = $MFproduct->ProductList(); ?>
					<label for="pipe_details">Select Product</label>
					<select class="form-control" name="MFproductId" id="MFproductId">
						<option>Select</option>
						<?php foreach($productlist as $list) { ?>
							<option value="<?php echo $list['id']; ?>">
								<?php echo $list['productName']; ?>
							</option>
						<?php } ?>
					</select>
					
					<div style="margin-bottom:15px;"></div>
					
					<label for="quantity">Existing quantity</label>
					<input readonly type="text" id="existingQty" class="form-control" />
					
					<div style="margin-bottom:15px;"></div>
					
					<label for="quantity">Add quantity</label>
					<input type="number" name="addQty" class="form-control" />
					
					<div style="margin-bottom:15px;"></div>
					<button type="submit" name="updateQuantity" class="btn btn-success">Update Quantity</button>
				</form>
			</div>
			<div class="col-sm-4">
				<div style="margin-bottom:15px;"></div>
				<img src="" id="outImg" />
			</div>
		</div>
		  
	  </div>
	</div>
</div>
<?php include('inc/footer.php');