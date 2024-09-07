<?php
include('inc/header.php');
Session::checkSession();
include('inc/sidebar.php');

include('../lib/ManufacturingProduct.php');

$manufacturingProduct = new ManufacturingProducts();

$db = new Database();

$per_page = 10;
if(isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}
$start_from = ($page - 1) * $per_page;

?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-2 main">
		
		  <p class="visible-xs">
			<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
		  </p>
		  
		  <h1 class="page-header">Manufacturing Products</h1>
		  
		<div class="table-responsive">
			<table class="table table-striped manufacture-table">
			  <thead>
				<tr>
				  <th>Product Thumb</th>
				  <th>Product Name</th>
				  <th>Stock</th>
				  <th>Unit Price</th>
				  <th>Total Price</th>
				  <th>Warning</th>
				</tr>
			  </thead>
			  <tbody>				
				<?php
				
				$query = "SELECT * FROM tbl_manufacture_product_name ORDER BY id DESC LIMIT $start_from, $per_page";
				$post = $db->select($query);
				if($post) {
					while($list = $post->fetch_assoc()) {
				?>
					<tr>
						<td width="20%">
							<?php if(empty($list['manufactureThumb'])) { ?>
								<img src="assets/images/no-thumbnail.jpg" alt="" />
							<?php } else { ?>
								<img src="<?php echo $list['manufactureThumb']; ?>" alt="" />
							<?php } ?>
						</td>
						<td width="15%"><?php echo $list['productName']; ?></td>
						<td width="10%"><?php echo $list['quantity']; ?></td>
						<td width="10%"><?php echo $list['salePrice']; ?></td>
						<td width="8%"><?php echo $list['salePrice'] * $list['quantity']; ?></td>
						<?php if($list['quantity'] < 50) {  ?>
						<td width="15%" class="stk-limited">Stock Limited</td>
						<?php } elseif($list['quantity'] == 0) { ?>
						<td width="15%" class="stk-out">Stock Out</td>
						<?php } else { ?>
						<td width="15%">Stock Balanced</td>
						<?php } ?>
						<td width="12%">
							<a class="btn btn-warning" href="javascript:void(0);">Edit</a>
							<a class="btn btn-primary" href="manufacturing-product-view.php?id=<?php echo $list['id']; ?>">View</a>
						</td>
					</tr>
				<?php } ?>
				<?php } else {?>
					<h3>No post found!</h3>
				<?php } ?>
			  </tbody>
			</table>
		</div>
		  
		<?php
					
			$query = "SELECT * FROM tbl_manufacture_product_name";
			$result = $db->select($query);
			$total_rows = mysqli_num_rows($result);
			$total_page = ceil($total_rows / $per_page);
				
		?>
		
		<ul class="pagination pull-right">
			<li><a href="manufacturing-products.php?page=1">First</a></li>
			<?php
			
			for($i = 1; $i <= $total_page; $i++) {
				echo '<li><a href="manufacturing-products.php?page='.$i.'">'.$i.'</a></li>';
			}
			
			?>
			<li><a href="manufacturing-products.php?page=<?php echo $total_page; ?>">Last</a></li>
		</ul>
		  
	  </div>
	</div>
</div>
<?php include('inc/footer.php'); ?>