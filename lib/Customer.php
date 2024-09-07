<?php

require_once('Session.php');
require_once('config.php');
require_once('Database.php');

Class Customer {
	private $db;
	
	public function __construct() {
		$this->db = new Database();
	}
	
	public function CustomerRegistration($data) {
		$name 		= $data['name'];
		$email 		= $data['email'];
		$mobile 	= $data['mobile'];
		$address 	= $data['address'];
		$chk_email = $this->emailCheck($email);
		$chk_mobile = $this->mobileCheck($mobile);
		
		if($name == "" or $email == "" or $mobile == "") {
			$msg = "<div class=\"alert alert-danger\"><strong>Error! </strong>Field cannot be empty!</div>";
			return $msg;
		}
		if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
			$msg = "<div class=\"alert alert-danger\"><strong>Error! </strong>Invalid email address!</div>";
			return $msg;
		}
		if($chk_email == true) {
			$msg = "<div class=\"alert alert-danger\"><strong>Error! </strong> Email address already exists!</div>";
			return $msg;
		}
		if($chk_mobile == true) {
			$msg = "<div class=\"alert alert-danger\"><strong>Error! </strong> Mobile number already exists!</div>";
			return $msg;
		}
		
		$sql = "INSERT INTO tbl_customer(name, email, mobile, address) VALUES(:name, :email, :mobile, :address)";
		$stmt = $this->db->pdo->prepare($sql);
		$stmt->bindValue(':name', $name);
		$stmt->bindValue(':email', $email);
		$stmt->bindValue(':mobile', $mobile);
		$stmt->bindValue(':address', $address);
		$result = $stmt->execute();
		if($result) {
			$msg = "<div class=\"alert alert-success\"><strong>Success! </strong> Customer added successfully!</div>";
			return $msg;
		} else {
			$msg = "<div class=\"alert alert-danger\"><strong>Error! </strong> Could not added!</div>";
			return $msg;
		}
	}
	
	public function emailCheck($email) {
		$sql = "SELECT email FROM tbl_customer WHERE email = :email";
		$stmt = $this->db->pdo->prepare($sql);
		$stmt->bindValue(':email', $email);
		$stmt->execute();
		if($stmt->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	public function mobileCheck($mobile) {
		$sql = "SELECT email FROM tbl_customer WHERE mobile = :mobile";
		$stmt = $this->db->pdo->prepare($sql);
		$stmt->bindValue(':mobile', $mobile);
		$stmt->execute();
		if($stmt->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	public function CustomerList() {
		$sql = "SELECT * FROM tbl_customer ORDER BY id DESC";
		$stmt = $this->db->pdo->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	
	public function DeleteCustomer($id) {
		$sql = "DELETE FROM tbl_customer WHERE id = :id LIMIT 1";
		$stmt = $this->db->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$delUser = $stmt->execute();
		if($delUser) {
			$msg = "<div class=\"alert alert-success\"><strong>Success! </strong> Stuff deleted successfully! :)</div>";
			return $msg;
		} else {
			$msg = "<div class=\"alert alert-danger\"><strong>Error! </strong>Suff could not deleted! :(</div>";
			return $msg;
		}
	}
}