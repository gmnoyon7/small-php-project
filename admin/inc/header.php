<?php
require_once('../lib/Session.php');
Session::init();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Dashboard</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/css/styles.css" rel="stylesheet">
	</head>
	<body>
		<?php
			if(isset($_GET['action']) && $_GET['action'] == 'logout') {
				Session::destroy();
			}
		?>
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.php">Small PHP Project</a>
				</div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
							<?php
								$id = Session::get("id");
								$userLogin = Session::get("login");
								
								if($userLogin == true) {
							?>
							<li><a href="#">Settings</a></li>
							<li><a href="profile.php?id=<?php echo $id; ?>">Profile</a></li>
							<li><a href="?action=logout">Logout</a></li>
							<?php
								} else {
							?>
							<li><a href="index.php">Home</a></li>
							<?php } ?>
					</ul>
				</div>
			</div>
		</nav>