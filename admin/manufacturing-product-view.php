<?php
include('inc/header.php');
Session::checkSession();
include('inc/sidebar.php');

include('../lib/ManufacturingProduct.php');

$manufacturingProduct = new ManufacturingProducts();

if(isset($_GET['id'])) {
	$id = $_GET['id'];
} else {
	header('Location: manufacturing-products.php');
}

$db = new Database();

?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-2 main">
			<p class="visible-xs">
				<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
			</p>
		  
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<?php
					
					$query = "SELECT * FROM tbl_manufacture_product_name WHERE id = '$id'";
					$product = $db->select($query);
					if($product) {
						while($result = $product->fetch_assoc()) {
					?>
					  
					<h1 class="page-header"><?php echo $result['productName']; ?></h1>
					<div class="date-time">
						Entery Date: <span style="color:#cf0000;"><?php echo $result['entryDate']; ?></span>
					</div>
					<hr />
					<div class="row">
						<div class="col-sm-6">
							<img src="<?php echo $result['manufactureThumb']; ?>" alt="" />
						</div>
						<div class="col-sm-6">
							<p><?php echo $result['productDetails']; ?></p>
						</div>
					</div>
					
					<div style="margin-bottom:30px;"></div>
					
					<hr />
					
					<div class="row">
						<div class="col-sm-6">
							<div class="table-responsive">
								<table class="table table-striped">
								  <thead>
									<tr>
										<th>Retail Product</th>
										<th>QTY</th>
										<th>Unit Price</th>
										<th>Amount</th>
									</tr>
								  </thead>
								  <tbody>				
									<?php
									
									$query = "SELECT * FROM tbl_manufacture WHERE customId = '$result[customId]' ORDER BY id DESC";
									$post = $db->select($query);
									if($post) {
										while($list = $post->fetch_assoc()) {
									?>
										<tr>
											<td><?php echo $list['retailProduct']; ?></td>
											<td><?php echo $list['quantity']; ?></td>
											<td><?php echo $list['unitPrice']; ?></td>
											<td><?php echo $list['price']; ?></td>
										</tr>
									<?php } ?>
									<?php } else {?>
										<h3>No retail product found!</h3>
									<?php } ?>
								  </tbody>
								</table>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="table-responsive">
								<table class="table table-striped">
									<tbody>
										<tr>
											<td><strong>Actual Price</strong></td>
											<td>BDT</td>
											<td><?php echo $result['actualPrice']; ?></td>
										</tr>
										<tr>
											<td><strong>Factory Cost</strong></td>
											<td>BDT</td>
											<td><?php echo $result['factoryCost']; ?></td>
										</tr>
										<tr>
											<td><strong>Labour Cost</strong></td>
											<td>BDT</td>
											<td><?php echo $result['labourCost']; ?></td>
										</tr>
										<tr>
											<td><strong>Others One</strong></td>
											<td>BDT</td>
											<td><?php echo $result['othersOne']; ?></td>
										</tr>
										<tr>
											<td><strong>Others Two</strong></td>
											<td>BDT</td>
											<td><?php echo $result['othersTwo']; ?></td>
										</tr>
										<tr>
											<td><strong>Total Cost</strong></td>
											<td>BDT</td>
											<td><?php echo $result['totalCost']; ?></td>
										</tr>
										<tr>
											<td><strong>Profit</strong></td>
											<td>BDT</td>
											<td><?php echo $result['profit']; ?></td>
										</tr>
										<tr>
											<td><strong>Product Price</strong></td>
											<td>BDT</td>
											<td><?php echo $result['productPrice']; ?></td>
										</tr>
										<tr>
											<td><strong>Discount</strong></td>
											<td>BDT</td>
											<td><?php echo $result['discount'].'%'; ?></td>
										</tr>
										<tr>
											<td><strong>Sale Price</strong></td>
											<td>BDT</td>
											<td><?php echo $result['salePrice']; ?></td>
										</tr>
										<tr>
											<td><strong>Profit Margin</strong></td>
											<td>BDT</td>
											<td><?php echo $result['profitMargin']; ?></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					  
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