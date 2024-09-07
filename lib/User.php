<?php

require_once('Session.php');
require_once('config.php');
require_once('Database.php');

Class User {
	private $db;
	
	public function __construct() {
		 $this->db = new Database();
	}
	public function UserRegistration($data) {
		$name 		= $data['name'];
		$email 		= $data['email'];
		$username 	= $data['username'];
		$password 	= md5($data['password']);
		$chk_email = $this->emailCheck($email);
		
		if($name == "" or $email == "" or $username == "" or $password == "") {
			$msg = "<div class=\"alert alert-danger\"><strong>Error! </strong>Field cannot be empty!</div>";
			return $msg;
		}
		if(strlen($username) < 3) {
			$msg = "<div class=\"alert alert-danger\"><strong>Error! </strong>Username is too short!</div>";
			return $msg;
		} elseif(preg_match('/[^a-z0-9_-]+/i', $username)) {
			$msg = "<div class=\"alert alert-danger\"><strong>Error! </strong>Username can be container alphanumerical, dashes or underscore.</div>";
		}
		if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
			$msg = "<div class=\"alert alert-danger\"><strong>Error! </strong>Invalid email address!</div>";
			return $msg;
		}
		if($chk_email == true) {
			$msg = "<div class=\"alert alert-danger\"><strong>Error! </strong> Email address already exists!</div>";
			return $msg;
		}
		
		$sql = "INSERT INTO tbl_user(name, email, username, password) VALUES(:name, :email, :username, :password)";
		$stmt = $this->db->pdo->prepare($sql);
		$stmt->bindValue(':name', $name);
		$stmt->bindValue(':email', $email);
		$stmt->bindValue(':username', $username);
		$stmt->bindValue(':password', $password);
		$result = $stmt->execute();
		if($result) {
			$msg = "<div class=\"alert alert-success\"><strong>Success! </strong> You've successfully registered!</div>";
			return $msg;
		} else {
			$msg = "<div class=\"alert alert-danger\"><strong>Error! </strong> Could not registered!</div>";
			return $msg;
		}
	}
	
	public function emailCheck($email) {
		$sql = "SELECT email FROM tbl_user WHERE email = :email";
		$stmt = $this->db->pdo->prepare($sql);
		$stmt->bindValue(':email', $email);
		$stmt->execute();
		if($stmt->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	public function getLoginUser($email, $password) {
		$sql = "SELECT * FROM tbl_user WHERE email = :email AND password = :password LIMIT 1";
		$stmt = $this->db->pdo->prepare($sql);
		$stmt->bindValue(':email', $email);
		$stmt->bindValue(':password', $password);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_OBJ);
		return $result;
	}
	
	public function userLogin($data) {
		$email 		= $data['email'];
		$password 	= md5($data['password']);
		$chk_email = $this->emailCheck($email);
		
		if($email == "" or $password == "") {
			$msg = "<div class=\"alert alert-danger\"><strong>Error! </strong>Field cannot be empty!</div>";
			return $msg;
		}
		if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
			$msg = "<div class=\"alert alert-danger\"><strong>Error! </strong>Invalid email address!</div>";
			return $msg;
		}
		if($chk_email == false) {
			$msg = "<div class=\"alert alert-danger\"><strong>Error! </strong> Email address NOT exists!</div>";
			return $msg;
		}
		$result = $this->getLoginUser($email, $password);
		if($result) {
			Session::set("login", true);
			Session::set("id", $result->id);
			Session::set("name", $result->name);
			Session::set("username", $result->username);
			Session::set("loginmsg", "<div class=\"alert alert-success\"><strong>Success! </strong> You're logged in!</div>");
			echo '<script>location.href="index.php"</script>';
		} else {
			$msg = "<div class=\"alert alert-danger\"><strong>Error! </strong> Data not found!</div>";
			return $msg;
		}
	}
	
	public function getUserData() {
		$sql = "SELECT * FROM tbl_user ORDER BY id DESC";
		$stmt = $this->db->pdo->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	
	public function getUserById($id) {
		$sql = "SELECT * FROM tbl_user WHERE id = :id LIMIT 1";
		$stmt = $this->db->pdo->prepare($sql);
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_OBJ);
		return $result;
	}
	
	public function updateUserData($id, $data) {
		$name 		= $data['name'];
		$email 		= $data['email'];
		$username 	= $data['username'];
		
		if($name == "" or $email == "" or $username == "") {
			$msg = "<div class=\"alert alert-danger\"><strong>Error! </strong>Field cannot be empty!</div>";
			return $msg;
		}
		
		$sql = "UPDATE tbl_user SET name = :name, username = :username, email = :email WHERE id = :id";
		
		$stmt = $this->db->pdo->prepare($sql);
		$stmt->bindValue(':name', $name);
		$stmt->bindValue(':username', $username);
		$stmt->bindValue(':email', $email);
		$stmt->bindValue(':id', $id);
		$result = $stmt->execute();
		if($result) {
			$msg = "<div class=\"alert alert-success\"><strong>Success! </strong> User data updated successfully!</div>";
			return $msg;
		} else {
			$msg = "<div class=\"alert alert-danger\"><strong>Error! </strong>User data couldn't updated!</div>";
			return $msg;
		}
	}
	
	private function checkPass($id, $oldPass) {
		$password = md5($oldPass);
		$sql = "SELECT password FROM tbl_user WHERE password = :password AND id = :id";
		$stmt = $this->db->pdo->prepare($sql);
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":password", $password, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->rowCount();
		if($result > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	public function updatePassword($id, $data) {
		$oldPass = $data['old_pass'];
		$newPass = $data['new_pass'];
		$chk_pass = $this->checkPass($id, $oldPass);
		
		if($oldPass == "" or $newPass == "") {
			$msg = "<div class=\"alert alert-danger\"><strong>Error! </strong>Field cannot be empty!</div>";
			return $msg;
		}
		
		if($chk_pass == false) {
			$msg = "<div class=\"alert alert-danger\"><strong>Error! </strong>Old password does not exists!</div>";
			return $msg;
		}
		
		if(strlen($newPass) < 6) {
			$msg = "<div class=\"alert alert-danger\"><strong>Error! </strong>The password must have minimum 6 characters.</div>";
			return $msg;
		}
		
		$password = md5($newPass);
		$sql = "UPDATE tbl_user SET password = :password WHERE id = :id";
		
		$stmt = $this->db->pdo->prepare($sql);
		$stmt->bindParam(':password', $password);
		$stmt->bindValue(':id', $id);
		$result = $stmt->execute();
		
		if($result) {
		$msg = "<div class=\"alert alert-success\"><strong>Success! </strong> Password has been updated successfully!</div>";
		return $msg;
		} else {
			$msg = "<div class=\"alert alert-danger\"><strong>Error! </strong>Password couldn't updated!</div>";
			return $msg;
		}
	}
	
	public function UserList() {
		$sql = "SELECT * FROM tbl_user ORDER BY id DESC";
		$stmt = $this->db->pdo->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
}

?>