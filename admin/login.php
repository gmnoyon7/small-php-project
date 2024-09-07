<?php

include('inc/header.php');

require_once('../lib/User.php');
Session::checkLogin();

$user = new User();
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
	$userLogin = $user->userLogin($_POST);
}

?>
<div class="container-fluid">
    <div class="row">
		<div class="col-sm-4 col-sm-offset-4 main user-login">
			<h1 class="page-header">User Login</h1>
			<!--toggle sidebar button-->
			<p class="visible-xs">
				<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
			</p>
			<?php
				if(isset($userLogin)) {
					echo $userLogin;
				}
			?>
			<form action="login.php" method="POST">
				<div class="form-group">
					<label for="email">Email</label>
					<input type="text" id="email" name="email" class="form-control" />
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" id="password" name="password" class="form-control" />
				</div>
				<button type="submit" name="login" class="btn btn-success">Login</button>
			</form>
		</div>
	</div>
</div>
<?php include('inc/footer.php'); ?>