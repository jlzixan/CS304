<?php
include "DB.php";
session_start();

function login() {
	if(isset($_POST["submit"])) {
		global $connection;
		
		$username = mysqli_real_escape_string($connection, $_POST['username']);
		$password = mysqli_real_escape_string($connection, $_POST['Password']);
		
		$result = mysqli_query($connection, "SELECT * from person WHERE '$username'=Username and '$password'=Password");
		
		if (!$result){
			die("Login Fails " . mysqli_error($connection));
		} else {
			$_SESSION['username'] = $username;
			$_SESSION['name'] = mysqli_query($connection, "SELECT Name from person where '$username'=Username");
			$_SESSION['sin'] = mysqli_query($connection, "SELECT SIN from person where '$username'=Username");
			return true;
		}
	
	}


}



?>