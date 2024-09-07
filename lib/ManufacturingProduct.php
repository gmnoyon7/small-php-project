<?php

require_once('config.php');
require_once('Database.php');
require_once('RetailProduct.php');

Class ManufacturingProducts {
	private $db;
	
	public function __construct() {
		$this->db = new Database();
	}
	
	public function AddTemporaryProduct($data) {
		$customId 			= $data['customId'];
		$retailProduct 		= $data['retailProduct'];
		$productQuantity 	= $data['quantity'];
		$productPrice 		= $data['unitPrice'];
		
		if(empty($retailProduct) || $retailProduct == 'select' || empty($productQuantity) || empty($productPrice) || empty($customId)) {
			$msg = "<div class=\"alert alert-danger\"><strong>Error: </strong> Field cannot empty!</div>";
			return $msg;
		}
		
		$checkTemp = "SELECT * FROM tbl_temp";
		$checkStmt = $this->db->pdo->prepare($checkTemp);
		$checkStmt->execute();
		$getCheck = $checkStmt->fetchAll(PDO::FETCH_ASSOC);
		
		if(count($getCheck) > 0) $customId = $getCheck[0]['customId'];
		
		$sql = "SELECT * FROM tbl_retailproduct WHERE id = '$retailProduct '";
		$stmt = $this->db->pdo->prepare($sql);
		$stmt->execute();
		$getRetailProduct = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$tempProductPrice = '';
		
		if($productQuantity <=  $getRetailProduct[0]['quantity']) {
			$tempProductPrice = $getRetailProduct[0]['unitPrice'] * $productQuantity;
		} else {
			$msg = "<div class=\"alert alert-danger\"><strong>Error: </strong>Insufficient products to add!</div>";
			return $msg;
		}
		
		$insertSql = "INSERT INTO tbl_temp(customId, retailProId, retailProduct, quantity, unitPrice, price) VALUES(:customId, :retailProId, :retailProduct, :quantity, :unitPrice, :price)";
		
		$insertStmt = $this->db->pdo->prepare($insertSql);
		$insertStmt->bindValue(':customId', $customId);
		$insertStmt->bindValue(':retailProId', $retailProduct);
		$insertStmt->bindValue(':retailProduct', $getRetailProduct[0]['pipeName']);
		$insertStmt->bindValue(':quantity', $productQuantity);
		$insertStmt->bindValue(':unitPrice', $getRetailProduct[0]['unitPrice']);
		$insertStmt->bindValue(':price', $tempProductPrice);
		$result = $insertStmt->execute();
		if($result) {
			$msg = "<div class=\"alert alert-success\"><strong>Success: </strong>Product added in your list.</div>";
			return $msg;
		} else {
			$msg = "<div class=\"alert alert-danger\"><strong>Error: </strong>Product could not added!</div>";
			return $msg;
		}
	}
	
	public function GetTempProductList() {
		$sql = "SELECT * FROM tbl_temp ORDER BY id DESC";
		$stmt = $this->db->pdo->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	
	public function AddProduct($data) {
		$productName 		= $data['productName'];
		$productDetails 	= $data['productDetails'];
		$productQuantity 	= $data['productQuantity'];
		$actualPrice 		= $data['actualPrice'];
		$factoryCost 		= $data['factoryPrice'];
		$labourCost 		= $data['labourCost'];
		$othersOne 			= $data['othersOne'];
		$othersTwo 			= $data['othersTwo'];
		$totalCost 			= $data['totalCost'];
		$profit 			= $data['profit'];
		$productPrice 		= $data['productPrice'];
		$productDiscount 	= $data['productDiscount'];
		$salePrice 			= $data['salePrice'];
		$profitMargin 		= $data['profitMargin'];
		
		$permited = array('jpg', 'jpeg', 'png', 'gif');
		$fileName = $_FILES['manufactureThumb']['name'];
		$fileSize = $_FILES['manufactureThumb']['size'];
		$fileTemp = $_FILES['manufactureThumb']['tmp_name'];
		
		$div = explode('.', $fileName);
		$fileExt = strtolower(end($div));
		$uniqueImgName = substr(md5(time()), 0, 10).'.'.$fileExt;
		$uploadedImg = "upload/manufacture/".$uniqueImgName;

		$tempProducts = $this->GetTempProductList();
		$uniqueId = $tempProducts[0]['customId'];
		
		if(empty($productName) || empty($productDetails) || empty($productQuantity) || empty($actualPrice) || empty($totalCost) || empty($productPrice) || empty($salePrice) || empty($profitMargin)) {
			$msg = "<div class=\"alert alert-danger\"><strong>Error: </strong> Some important fields are empty.</div>";
			return $msg;
		}
		
		if($fileSize >1048567) {
			$msg = "<div class=\"alert alert-danger\"><strong>Error: </strong> Image Size should be less then 1MB!</div>";
			return $msg;
		}
		
		if ($_FILES['manufactureThumb']['size'] !== 0 && $_FILES['manufactureThumb']['error'] !== 0) {
			if(in_array($fileExt, $permited) === false) {
				$msg = "<div class=\"alert alert-danger\"><strong>Error: </strong> You can upload only:-".implode(', ', $permited)."</div>";
				return $msg;
			}
		}
		
		move_uploaded_file($fileTemp, '../admin/'.$uploadedImg);
		
		$tblTempAll = "SELECT * FROM tbl_temp";
		$transStmt = $this->db->pdo->prepare($tblTempAll);
		$transStmt->execute();
		$outputs = $transStmt->fetchAll();
		
		foreach($outputs as $output) {
			
			$tempRetailId = $output['retailProId'];
			
			$retailProQuery = "SELECT * FROM tbl_retailproduct WHERE id = '$tempRetailId'";
			$retailProQuantity = $this->db->pdo->prepare($retailProQuery);
			$retailProQuantity->execute();
			$retailProOutputs = $retailProQuantity->fetchAll(PDO::FETCH_ASSOC);
			
			$totalQuantity = $productQuantity * $output['quantity'];
			
			if($totalQuantity > $retailProOutputs[0]['quantity']) {
				$msg = "<div class=\"alert alert-danger\"><strong>Error: </strong>Insufficient products to add!</div>";
				return $msg;
			}
			
			$retatilQUpdate = ($retailProOutputs[0]['quantity'] - $totalQuantity);
			
			$tblRetailAll = "UPDATE tbl_retailproduct SET quantity = :quantity WHERE id = :id";
			
			$retailUpdate = $this->db->pdo->prepare($tblRetailAll);
			$retailUpdate->bindValue(':quantity', $retatilQUpdate);
			$retailUpdate->bindValue(':id', $output['retailProId']);
			$updateResult = $retailUpdate->execute();
		}
		
		$sql = "INSERT INTO tbl_manufacture_product_name(
			customId, productName, 
			productDetails, 
			quantity, 
			manufactureThumb, 
			actualPrice, 
			factoryCost, 
			labourCost, 
			othersOne, 
			othersTwo, 
			totalCost, 
			profit, 
			productPrice, 
			discount, 
			salePrice, 
			profitMargin) VALUES(
			:customId, 
			:productName, 
			:productDetails, 
			:quantity, 
			:manufactureThumb, 
			:actualPrice, 
			:factoryCost, 
			:labourCost, 
			:othersOne, 
			:othersTwo, 
			:totalCost, 
			:profit, 
			:productPrice, 
			:discount, 
			:salePrice, 
			:profitMargin)";
		
		$stmt = $this->db->pdo->prepare($sql);
		$stmt->bindValue(':customId', $uniqueId);
		$stmt->bindValue(':productName', $productName);
		$stmt->bindValue(':productDetails', $productDetails);
		$stmt->bindValue(':quantity', $productQuantity);
		$stmt->bindValue(':manufactureThumb', $uploadedImg);
		$stmt->bindValue(':actualPrice', $actualPrice);
		$stmt->bindValue(':factoryCost', $factoryCost);
		$stmt->bindValue(':labourCost', $labourCost);
		$stmt->bindValue(':othersOne', $othersOne);
		$stmt->bindValue(':othersTwo', $othersTwo);
		$stmt->bindValue(':totalCost', $totalCost);
		$stmt->bindValue(':profit', $profit);
		$stmt->bindValue(':productPrice', $productPrice);
		$stmt->bindValue(':discount', $productDiscount);
		$stmt->bindValue(':salePrice', $salePrice);
		$stmt->bindValue(':profitMargin', $profitMargin);
		$result = $stmt->execute();
		if($result) {

			$tblTempAll = "SELECT * FROM tbl_temp";
			$transStmt = $this->db->pdo->prepare($tblTempAll);
			$transStmt->execute();
			$outputs = $transStmt->fetchAll();
			
			$sql2 = "INSERT INTO tbl_manufacture (customId, retailProId, retailProduct, quantity, unitPrice, price) SELECT customId, retailProId, retailProduct, quantity, unitPrice, price FROM tbl_temp WHERE customId = '$uniqueId'";
			$stmt2 = $this->db->pdo->prepare($sql2);
			$result2 = $stmt2->execute();
			if($result2) {
				$sql3 = "DELETE FROM tbl_temp where customId = '$uniqueId';";
				$stmt3 = $this->db->pdo->prepare($sql3);
				$result3 = $stmt3->execute();
				if($result3) {
					$msg = "<div class=\"alert alert-success\"><strong>Success: </strong> Manufacturing product added successfully</div>";
					return $msg;
				} else {
					$msg = "<div class=\"alert alert-danger\"><strong>Error: </strong> Manufacturing Product could not added!</div>";
					return $msg;
				}
			}
		}
	}
	
	public function ProductList($limit = NULL) {
		if($limit !== NULL) {
			$sql = "SELECT * FROM tbl_manufacture_product_name ORDER BY id DESC LIMIT $limit";
		} else {
			$sql = "SELECT * FROM tbl_manufacture_product_name ORDER BY id DESC";
		}
		$stmt = $this->db->pdo->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	
	public function retailProductPriceCheck($data) {
		$retailProductId = $data['retailProduct'];
		$quantity = $data['quantity'];
		if(!empty($retailProductId) && $retailProductId !== 'select' && !empty($quantity)) {
			$sql = "SELECT * FROM tbl_retailproduct WHERE id='$retailProductId' LIMIT 1";
			$stmt = $this->db->pdo->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			if(empty($result[0]['quantity'])) {
				echo 'There is no product found.';
			} elseif($result[0]['quantity'] >= $quantity) {
				echo $quantity * $result[0]['unitPrice'];
			} else {
				echo 'There is insufficient product.';
			}
			
		} else {
			return false;
		}
	}
	
	public function deleteTempPro($id) {
		$id = intval($id);
		if(!empty($id) && is_int($id)) {
			$sql = "DELETE FROM tbl_temp WHERE id = '$id'";
			$stmt = $this->db->pdo->prepare($sql);
			$result = $stmt->execute();
			if($result) {
				echo "<div class=\"alert alert-success\"><strong>Success: </strong> Product deleted successfully.</div>";
			} else {
				echo "<div class=\"alert alert-danger\"><strong>Success: </strong> Product could not delete.</div>";
			}
		}
	}
	
	public function productActualPrice($id) {
		$sql = "SELECT * FROM tbl_temp WHERE customId = '$id'";
		$stmt = $this->db->pdo->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		$actualPrice = NULL;
		if($result) {
			foreach($result as $price) {
				$actualPrice += $price['price'];
			}
		}
		return $actualPrice;
	}
	
	public function addCost($data) {
		
		$total = NULL;
		
		if(isset($data['actualPrice']) && !empty($data['actualPrice'])) {
			$total = $data['actualPrice'];
		}
		if(isset($data['factoryCost']) && !empty($data['factoryCost'])) {
			$total += $data['factoryCost'];
		}
		if(isset($data['labourCost']) && !empty($data['labourCost'])) {
			$total += $data['labourCost'];
		}
		if(isset($data['othersOne']) && !empty($data['othersOne'])) {
			$total += $data['othersOne'];
		}
		if(isset($data['othersTwo']) && !empty($data['othersTwo'])) {
			$total += $data['othersTwo'];
		}
		echo $total;
		
	}
	
	public function getProductPrice($data) {
		$total = NULL;
		
		if(isset($data['totalCost']) && !empty($data['totalCost'])) {
			$total = $data['totalCost'];
		}
		
		if(isset($data['profit']) && !empty($data['profit'])) {
			$total += $data['profit'];
		}
		echo $total;
	}
	
	public function getSalePrice($data) {
		$total = NULL;
		$productPrice = NULL;
		$productDiscount = NULL;
		
		if(isset($data['productPrice']) && !empty($data['productPrice'])) {
			$productPrice = $data['productPrice'];
		}
		
		if(isset($data['productDiscount']) && !empty($data['productDiscount'])) {
			$productDiscount = $data['productDiscount'];
		}
		$total = ($productPrice / 100) * $productDiscount;
		echo $productPrice - $total;
	}
	
	public function getImgOnChange($tbl, $id) {
		$sql = "SELECT * FROM $tbl WHERE id = '$id'";
		$stmt = $this->db->pdo->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		if(empty($result[0])) {
			echo 'assets/images/no-thumbnail.jpg';
		} else {
			echo json_encode($result[0]);
		}
	}
	
	public function getMFbyId($id) {
		$sql = "SELECT * FROM tbl_manufacture_product_name WHERE id = '$id' LIMIT 1";
		$stmt = $this->db->pdo->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
	
	public function updateMFqty($data) {
 		if(isset($data['addQty'])) {
			$addQty = (int) $data['addQty'];
		}
		
		if(empty($data['addQty'])) {
			return "<div class=\"alert alert-danger\"><strong>Success: </strong> Add Quantity field cannot be empty!</div>";
		}
		
		if(!is_numeric($data['addQty'])) {
			return "<div class=\"alert alert-danger\"><strong>Success: </strong> Quantity must have to be numeric format.</div>";
		}
		
		$getCurrentQty = $this->getMFbyId($data['MFproductId']);
		$CurrentQtycustomId = $getCurrentQty['0']['customId'];
		
		$sqlM = "SELECT * FROM tbl_manufacture WHERE customId = '$CurrentQtycustomId'";
		$getRetailProductById = $this->db->pdo->prepare($sqlM);
		$getRetailProductById->execute();
		$getProlist = $getRetailProductById->fetchAll(PDO::FETCH_ASSOC);
		
 		$conf = array();
		
		foreach($getProlist as $list) {
			
			$multiplyQ = $addQty * $list['quantity'];
			
			$retailProId = $list['retailProId'];
			
			$Rproductsql = "SELECT * FROM tbl_retailproduct WHERE id = '$retailProId'";
			$Rproductstmt = $this->db->pdo->prepare($Rproductsql);
			$Rproductstmt->execute();
			$getRproduct = $Rproductstmt->fetchAll(PDO::FETCH_ASSOC);
			
			$getQ = $getRproduct[0]['quantity'];
			
			if($getQ < $multiplyQ) {
				$conf[] = 2;
			} else {
				$key = $getRproduct[0]['id'];
				$conf[$key] = $getQ - $multiplyQ;
			}
			
		}
		
		if(in_array(2, $conf)) {
			return "<div class=\"alert alert-danger\"><strong>Error: </strong> Insufficient products to add</div>";
		} else {
			foreach($conf as $key => $value) {
				$updateQuery = "UPDATE tbl_retailproduct SET quantity = :quantity WHERE id = :id";
				$retailUpdate = $this->db->pdo->prepare($updateQuery);
				$retailUpdate->bindValue(':quantity', $value);
				$retailUpdate->bindValue(':id', $key);
				$updateResult = $retailUpdate->execute();
			}
		}
		
 		$qty = $getCurrentQty[0]['quantity'];
		$qty += $addQty;
		
		$tblRetailAll = "UPDATE tbl_manufacture_product_name SET quantity = :quantity WHERE id = :id";
					
		$retailUpdate = $this->db->pdo->prepare($tblRetailAll);
		$retailUpdate->bindValue(':quantity', $qty);
		$retailUpdate->bindValue(':id', $data['MFproductId']);
		$updateResult = $retailUpdate->execute();
		
		if($updateResult) {
			return "<div class=\"alert alert-success\"><strong>Success: </strong> Product quantity updated successfully.</div>";
		}
	}
}