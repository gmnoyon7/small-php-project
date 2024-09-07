<?php
include('inc/header.php');
Session::checkSession();
include('inc/sidebar.php');

include('../lib/RetailProduct.php');
include('../lib/ManufacturingProduct.php');
include('../lib/Customer.php');
include('../lib/Stuff.php');

$retailProduct = new RetailProducts();
$manufacturingProduct = new ManufacturingProducts();
$customer = new Customer();
$stuff = new Stuff();

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addProduct'])) {
	$addTempProduct = $manufacturingProduct->AddTemporaryProduct($_POST);
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['fullProduct'])) {
	$addProduct = $manufacturingProduct->AddProduct($_POST);
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
					<h1 class="page-header">Sell Retail Product</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 col-sm-6">
					<?php
						if(isset($addTempProduct)) {
							echo $addTempProduct;
						}
						
						if(isset($addProduct)) {
							echo $addProduct;
						}
					?>
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
						
						<?php $productlist = $retailProduct->ProductList(); ?>
						<label for="pipe_details">Select Retail Product</label>
						<select class="form-control" name="retailProduct" id="retailProduct">
							<option value="select">Select</option>
							<?php foreach($productlist as $list) { ?>
								<option value="<?php echo $list['id']; ?>">
									<?php echo $list['pipeName']; ?>
								</option>
							<?php } ?>
						</select>
						
						<div style="margin-bottom:15px;"></div>
						
						<label for="quantity">Quantity</label>
						<input type="number" name="quantity" id="quantity" class="form-control" />
						
						<div style="margin-bottom:15px;"></div>
						
						<div class="form-group hidden">
							<label>Price</label>
							<input type="text" readonly name="unitPrice" id="unitPrice" class="form-control" />
						</div>
						<div class="form-group hidden">
							<label>Unique Id</label>
							<input type="text" name="customId" value="<?php echo substr(md5(time()), 0, 6); ?>" class="form-control" />
						</div>
						
						<div style="margin-bottom:15px;"></div>
						
						<button type="submit" name="addProduct" class="btn btn-success">Add product</button>
						
						<div style="margin-bottom:15px;"></div>
						<div class="mb">
							<img src="" id="outImg" />
						</div>
					</form>
				</div>
				<div class="col-md-4 col-sm-6">
					<?php
						if(isset($addTempProduct)) {
							echo $addTempProduct;
						}
						
						if(isset($addProduct)) {
							echo $addProduct;
						}
					?>
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
						
						<?php $customerlist = $customer->CustomerList(); ?>
						<label for="pipe_details">Select Customer</label>
						<select class="form-control" name="retailProduct" id="retailProduct">
							<option value="select">Select</option>
							<?php foreach($customerlist as $list) { ?>
								<option value="<?php echo $list['id']; ?>">
									<?php echo $list['name']; ?>
								</option>
							<?php } ?>
						</select>
						
						<div style="margin-bottom:15px;"></div>
						
						<label for="customer-mobile">Mobile no.</label>
						<input type="text" name="customer-mobile" id="customer-mobile" class="form-control" />
						
						<div style="margin-bottom:15px;"></div>
						
						<label for="customer-address">Address</label>
						<input type="text" name="customer-address" id="customer-address" class="form-control" />
					</form>
				</div>
				<div class="col-md-4 col-sm-6">
					<?php
						if(isset($addTempProduct)) {
							echo $addTempProduct;
						}
						
						if(isset($addProduct)) {
							echo $addProduct;
						}
					?>
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
						
						<?php $stufflist = $stuff->stuffsList(); ?>
						<label for="pipe_details">Select Stuff</label>
						<select class="form-control" name="retailProduct" id="retailProduct">
							<option value="select">Select</option>
							<?php foreach($stufflist as $list) { ?>
								<option value="<?php echo $list['id']; ?>">
									<?php echo $list['name']; ?>
								</option>
							<?php } ?>
						</select>
						
						<div style="margin-bottom:15px;"></div>
						
						<label for="customer-mobile">Mobile no.</label>
						<input type="text" name="customer-mobile" id="customer-mobile" class="form-control" />
						
						<div style="margin-bottom:15px;"></div>
						
						<label for="customer-address">Address</label>
						<input type="text" name="customer-address" id="customer-address" class="form-control" />
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
						<div id="msg"></div>
						<table class="table table-bordered">
							<thead>
								<th>Retail Products</th>
								<th>Quantity</th>
								<th>Unit Price</th>
								<th>Amount</th>
								<th>X</th>
							</thead>
							<tbody>
								<?php
									$TempProducts = $manufacturingProduct->GetTempProductList();
									$getId = null;
									foreach($TempProducts as $list) {
										if(isset($list['customId'])) {
											$getId = $list['customId'];
										}
								?>
										<tr>
											<td width="30%">
												<input readonly type="text" class="form-control" value="<?php echo $list['retailProduct']; ?>">
											</td>
											<td><input type="text" class="form-control" value="<?php echo $list['quantity']; ?>"></td>
											<td><input readonly type="text" class="form-control" value="<?php echo $list['unitPrice']; ?>"></td>
											<td><input readonly type="text" class="form-control" value="<?php echo $list['price']; ?>"></td>
											<td>
												<button class="btn btn-danger" href="javascript:void(0);" id="deleteRow" onclick="deleteTempProduct('<?php echo $list['id']; ?>');">Delete</button>
											</td>
										</tr>
								<?php } ?>
								<tr>
									<td></th>
									<td>Total QTY</th>
									<td></th>
									<td>Total amount</th>
									<td></th>
								</tr>
							</tbody>
						</table>
						
						<table class="table table-bordered">
							<tr>
								<td style="vertical-align:middle"><strong>Discount</strong></td>
								<td class="text-center" style="vertical-align:middle"><strong>BDT</strong></td>
								<td>
									<div class="row">
										<div class="col-sm-12">
											<input type="text" class="form-control" id="productDiscount" name="productDiscount" placeholder="Product Discount">
										</div>
									</div>
								</td>
								<td style="vertical-align:middle">%</td>
							</tr>
							<tr>
								<td style="vertical-align:middle"><strong>Payable Amount</strong></td>
								<td class="text-center" style="vertical-align:middle"><strong>BDT</strong></td>
								<td>
									<div class="row">
										<div class="col-sm-12">
											<input readonly type="text" class="form-control" id="salePrice" name="salePrice" placeholder="Sale Price">
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td style="vertical-align:middle"><strong>Advance</strong></td>
								<td class="text-center" style="vertical-align:middle"><strong>BDT</strong></td>
								<td>
									<div class="row">
										<div class="col-sm-12">
											<input readonly type="text" class="form-control" id="profitMargin" name="profitMargin" placeholder="Profit Margin">
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td style="vertical-align:middle"><strong>Due</strong></td>
								<td class="text-center" style="vertical-align:middle"><strong>BDT</strong></td>
								<td>
									<div class="row">
										<div class="col-sm-12">
											<input readonly type="text" class="form-control" id="profitMargin" name="profitMargin" placeholder="Profit Margin">
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td class="text-right">
									<button type="submit" name="fullProduct" class="btn btn-success">Submit</button>
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		  
	  </div>
	</div>
</div>
<?php include('inc/footer.php');