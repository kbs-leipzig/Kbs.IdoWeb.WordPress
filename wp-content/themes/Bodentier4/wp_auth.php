<?php
	include_once('02_kbs_assets/JWT/JWT.php');
	use Firebase\JWT\JWT;
	function auth()
	{
		try{
			if (isset($_COOKIE["JWTToken"]))
			{
				$jwt = $_COOKIE["JWTToken"];
				$decoded = JWT::decode($jwt, JWT_AUTH_SECRET_KEY, array('HS256'));
				return true;
			}
			else{
				return false;
			}
		} catch (Exception $e) {
			//echo 'Exception abgefangen: ',  $e->getMessage(), "\n";
			return false;
		}
	}
	function role()
	{
		try{
			if (isset($_COOKIE["JWTToken"]))
			{
				$jwt = $_COOKIE["JWTToken"];
				$decoded = JWT::decode($jwt, JWT_AUTH_SECRET_KEY, array('HS256'));	
				return $decoded ->role;
			}
			else {
				return "";
			}
		} catch (Exception $e) {
			return "";
		}
	}
?>