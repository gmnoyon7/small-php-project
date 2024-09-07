<?php

Class Session {
	public static function init() {
        session_start();
	}
	
	public static function set($key, $value) {
        $_SESSION[$key] = $value;
	}
	
	public static function get($key) {
		if(isset($_SESSION[$key])) {
			return $_SESSION[$key];
		} else {
			return false;
		}
	}
	
	public static function checkSession() {
		if(self::get("login") == false) {
			self::destroy();
			echo '<script>location.href="login.php"</script>';
		}
	}
	
	public static function checkLogin() {
		if(self::get("login") == true) {
			echo '<script>location.href="index.php"</script>';
		}
	}
	
	public static function destroy() {
		session_destroy();
		session_unset();
		echo '<script>location.href="login.php"</script>';
	}
}

?>