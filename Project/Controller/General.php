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
			$row = mysqli_fetch_assoc($result);
			$_SESSION['name'] = $row['Name'];
			$_SESSION['sin'] = $row['SIN'];
			echo "Welcome " . $username;
			return true;
		}
	
	}


}



?>