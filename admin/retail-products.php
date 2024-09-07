<?php
include('inc/header.php');
Session::checkSession();
include('inc/sidebar.php');

include('../lib/RetailProduct.php');

$retailProduct = new RetailProducts();
$db = new Database();

$per_page = 3;
if(isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}
$start_from = ($page - 1) * $per_page;

if(isset($_GET['delRetail'])) {
	$delPro = $retailProduct->delRetail($_GET['delRetail']);
}

?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-2 main">
		
		  <p class="visible-xs">
			<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
		  </p>
		  
		  <h1 class="page-header">Retail Products</h1>
		  
		  <?php
		  
		  if(isset($delPro)) {
			  echo $delPro;
		  }
		  
		  ?>
			<form class="navbar-form" role="search">
				<div class="input-group add-on" style="width:100%;">
				  <input class="form-control" placeholder="Search" name="srch-term" id="srch-term" type="text">
				</div>
			</form>
		  <div class="table-responsive">
			<table class="table table-striped retail-table">
			  <thead>
				<tr>
				  <th>Product Thumb</th>
				  <th>Last Update</th>
				  <th>Product Name</th>
				  <th>Stock</th>
				  <th>Unit Price</th>
				  <th>Total Price</th>
				  <th class="text-right">Warning</th>
				</tr>
			  </thead>
			  <tbody>
				<?php
				
				$i = 0;
				$query = "SELECT * FROM tbl_retailproduct ORDER BY id DESC LIMIT $start_from, $per_page";
				$post = $db->select($query);
				if($post) {
					while($list = $post->fetch_assoc()) {
					$i++;
				?>
					<tr>
						<td>
							<?php if(empty($list['retailThumb'])) { ?>
								<img src="assets/images/no-thumbnail.jpg" alt="" />
							<?php } else { ?>
								<img src="<?php echo $list['retailThumb']; ?>" alt="" />
							<?php } ?>
						</td>
						<td><?php echo $list['date']; ?></td>
						<td><?php echo $list['pipeName']; ?></td>
						<td><?php echo $list['quantity']; ?></td>
						<td><?php echo $list['unitPrice']; ?></td>
						<td><?php echo $list['unitPrice'] * $list['quantity']; ?></td>
						<?php if($list['quantity'] < 50) {  ?>
						<td class="stk-limited">Stock Limited</td>
						<?php } elseif($list['quantity'] == 0) { ?>
						<td class="stk-out">Stock Out</td>
						<?php } else { ?>
						<td>Stock Balanced</td>
						<?php } ?>
						<td class="text-right">
							<a class="btn btn-warning" href="edit-retail-product.php?editRetail=<?php echo $list['id']; ?>">Edit</a>
							<a href="retail-products.php?delRetail=<?php echo $list['id']; ?>" class="btn btn-danger">Delete</button>
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
			
			$query = "SELECT * FROM tbl_retailproduct";
			$result = $db->select($query);
			$total_rows = mysqli_num_rows($result);
			$total_page = ceil($total_rows / $per_page);
				
		?>
		
		<ul class="pagination pull-right">
			<li><a href="retail-products.php?page=1">First</a></li>
			<?php
			
			for($i = 1; $i <= $total_page; $i++) {
				echo '<li><a href="retail-products.php?page='.$i.'">'.$i.'</a></li>';
			}
			
			?>
			<li><a href="retail-products.php?page=<?php echo $total_page; ?>">Last</a></li>
		</ul>
		  
	  </div>
	</div>
</div>
<?php include('inc/footer.php'); ?>