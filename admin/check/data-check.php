<?php

$filepath = realpath(dirname(__FILE__));
include_once ('../../lib/ManufacturingProduct.php');
include_once ('../../lib/RetailProduct.php');

$productPrice = new ManufacturingProducts();
$retailPro = new RetailProducts();

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['quantity'])) {
	$productPrice->retailProductPriceCheck($_POST);
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deletePro'])) {
	$productPrice->deleteTempPro($_POST['deletePro']);
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['factoryCost'])) {
	$productPrice->totalProductPrice($_POST);
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delRetail'])) {
	$retailPro->delRetail($_POST['delRetail']);
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['retailId'])) {
	$productPrice->getImgOnChange('tbl_retailproduct', $_POST['retailId']);
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['MFproductId'])) {
	$productPrice->getImgOnChange('tbl_manufacture_product_name', $_POST['MFproductId']);
}
