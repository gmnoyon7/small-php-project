<?php
    $filepath = realpath(dirname(__FILE__));
	include_once ('../../lib/ManufacturingProduct.php');
	
	$productPrice = new ManufacturingProducts();
	
	if($_SERVER['REQUEST_METHOD'] == 'POST') $productPrice->addCost($_POST);
	
	if($_SERVER['REQUEST_METHOD'] == 'POST') $productPrice->getProductPrice($_POST);
	
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['productPrice'])) $productPrice->getSalePrice($_POST);
