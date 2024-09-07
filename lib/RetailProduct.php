<?php

require_once('config.php');
require_once('Database.php');

Class RetailProducts {
	private $db;
	
	public function __construct() {
		$this->db = new Database();
	}
	
	public function AddProduct($data) {
		$ProductDate = $data['ProentryDate'];
		$ProductReference = $data['proReference'];
		$productName = $data['RproductName'];
		$productDetails = $data['RproductDetails'];
		$productQuantity = $data['productQuantity'];
		$unitPrice = $data['unitPrice'];
		
		$permited = array('jpg', 'jpeg', 'png', 'gif');
		$fileName = $_FILES['retailThumb']['name'];
		$fileSize = $_FILES['retailThumb']['size'];
		$fileTemp = $_FILES['retailThumb']['tmp_name'];
		
		$div = explode('.', $fileName);
		$fileExt = strtolower(end($div));
		$uniqueImgName = substr(md5(time()), 0, 10).'.'.$fileExt;
		$uploadedImg = "upload/retail/".$uniqueImgName;
		
		if(empty($ProductDate) || empty($ProductReference) || empty($productName) || empty($productDetails) || empty($productQuantity) || empty($unitPrice)) {
			$msg = "<div class=\"alert alert-danger\"><strong>Error: </strong> Field cannot empty!</div>";
			return $msg;
		}
		
		if($fileSize >1048567) {
			$msg = "<div class=\"alert alert-danger\"><strong>Error: </strong> Image Size should be less then 1MB!</div>";
			return $msg;
		}
		
		if ($_FILES['retailThumb']['size'] !== 0 && $_FILES['retailThumb']['error'] !== 0) {
			if(in_array($fileExt, $permited) === false) {
				$msg = "<div class=\"alert alert-danger\"><strong>Error: </strong> You can upload only:-".implode(', ', $permited)."</div>";
				return $msg;
			}
		}

		move_uploaded_file($fileTemp, '../admin/'.$uploadedImg);
		
		$sql = "insert into tbl_retailproduct(date, retailThumb, reference, pipeName, pipeDetails, quantity, unitPrice) VALUES(:date, :retailThumb,  :reference, :pipeName, :pipeDetails, :quantity, :unitPrice)";
		
		$stmt = $this->db->pdo->prepare($sql);
		$stmt->bindValue(':date', $ProductDate);
		$stmt->bindValue(':retailThumb', $uploadedImg);
		$stmt->bindValue(':reference', $ProductReference);
		$stmt->bindValue(':pipeName', $productName);
		$stmt->bindValue(':pipeDetails', $productDetails);
		$stmt->bindValue(':quantity', $productQuantity);
		$stmt->bindValue(':unitPrice', $unitPrice);
		$result = $stmt->execute();
		if($result) {
			$msg = "<div class=\"alert alert-success\"><strong>Success: </strong> Retail product addess successfully</div>";
			return $msg;
		} else {
			$msg = "<div class=\"alert alert-danger\"><strong>Error: </strong> Retail Product could not added!</div>";
			return $msg;
		}
	}
	
	public function ProductList($limit = NULL) {
		if($limit !== NULL) {
			$sql = "SELECT * FROM tbl_retailproduct ORDER BY id DESC LIMIT $limit";
		} else {
			$sql = "SELECT * FROM tbl_retailproduct ORDER BY id DESC";
		}
		$stmt = $this->db->pdo->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	
	public function getRetailById($id) {
		$sql = "SELECT * FROM tbl_retailproduct WHERE id = '$id' LIMIT 1";
		$stmt = $this->db->pdo->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
	
	public function delRetail($id) {
		$id = intval($id);
		if(!empty($id) && is_int($id)) {
			
			$getRow = $this->getRetailById($id);
			if($getRow) {
				$delImg = $getRow[0]['retailThumb'];
				unlink($delImg);
			}

			$sql = "DELETE FROM tbl_retailproduct WHERE id = '$id'";
			$stmt = $this->db->pdo->prepare($sql);
			$result = $stmt->execute();
			if($result) {
				return "<div class=\"alert alert-success\"><strong>Success: </strong> Product deleted successfully.</div>";
			} else {
				return "<div class=\"alert alert-danger\"><strong>Success: </strong> Product could not delete.</div>";
			}
		}
	}
	
	public function updateRetailQty($data) {
		
 		if(isset($data['addQty'])) {
			$addQty = (int) $data['addQty'];
		}
		
		if(empty($data['addQty'])) {
			return "<div class=\"alert alert-danger\"><strong>Success: </strong> Add Quantity field cannot be empty!</div>";
		}
		
		if(!is_numeric($data['addQty'])) {
			return "<div class=\"alert alert-danger\"><strong>Success: </strong> Quantity must have to be numeric format.</div>";
		}
		
		$getCurrentQty = $this->getRetailById($data['retailProductId']);
		
		$qty = $getCurrentQty[0]['quantity'];
		$qty += $addQty;
		
		$tblRetailAll = "UPDATE tbl_retailproduct SET quantity = :quantity WHERE id = :id";
					
		$retailUpdate = $this->db->pdo->prepare($tblRetailAll);
		$retailUpdate->bindValue(':quantity', $qty);
		$retailUpdate->bindValue(':id', $data['retailProductId']);
		$updateResult = $retailUpdate->execute();
		
		if($updateResult) {
			return "<div class=\"alert alert-success\"><strong>Success: </strong> Product quantity updated successfully.</div>";
		}
	}
	
	public function updateRetailProduct($id, $data) {
		$ProductDate = $data['ProentryDate'];
		$ProductReference = $data['uPproReference'];
		$productName = $data['upRproductName'];
		$productDetails = $data['uPRproductDetails'];
		$productQuantity = $data['uPproductQuantity'];
		$unitPrice = $data['uPunitPrice'];
		
		$sql = "UPDATE tbl_retailproduct SET date=:date, reference=:reference, pipeName=:pipeName, pipeDetails=:pipeDetails, quantity=:quantity, unitPrice=:unitPrice WHERE id=:id";
		
		$stmt = $this->db->pdo->prepare($sql);
		$stmt->bindValue(':date', $ProductDate);
		$stmt->bindValue(':reference', $ProductReference);
		$stmt->bindValue(':pipeName', $productName);
		$stmt->bindValue(':pipeDetails', $productDetails);
		$stmt->bindValue(':quantity', $productQuantity);
		$stmt->bindValue(':unitPrice', $unitPrice);
		$stmt->bindValue(':id', $id);
		$result = $stmt->execute();
		
		if($result) {
			$msg = "<div class=\"alert alert-success\"><strong>Success: </strong> Retail product updated successfully</div>";
			return $msg;
		} else {
			$msg = "<div class=\"alert alert-danger\"><strong>Error: </strong> Retail Product could not updated!</div>";
			return $msg;
		}
	}
	
}