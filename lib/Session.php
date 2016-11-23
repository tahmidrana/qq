<?php
/**
* Session class
*/
class Session {
	public static function init(){
		session_start();
	}

	public static function set($key, $val){
		$_SESSION[$key] = $val;
	}

	public static function get($key){
		if (isset($_SESSION[$key])) {
			return $_SESSION[$key];
		} else {
			return false;
		}
	}

	public static function checkSession(){
		self::init();
		if(self::get('login') == false){
			//self::destroy();
			header("Location: login.php");
		} else if(self::get('role') == 1){
			//header("Location: superAdmin.php");
		} else if(self::get('role') == 0){
			//header("Location: index.php");
		}
	}
	public static function checkLogin(){
		self::init();
		if(self::get('login') == true){
			header("Location: index.php");
		} else{
			//header("Location:index.php");
		}
	}



	public static function issetSession(){
		self::init();
		if(self::get('login')){
			return true;
		} else {
			return false;
		}
	}


	public static function isAdminLoggedin(){
		self::init();
		if(self::get('role') == 1){
			return true;
		} else {
			return false;
		}
	}

	public static function destroy(){
		session_destroy();
		header("Location: login.php");
	}
}
?>