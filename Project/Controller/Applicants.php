<?php include "DB.php";
session_start();

//Allows new user to create new account
function createApplicant() {
	if(isset($_POST["register"])) {
		global $connection;

		$username = mysqli_real_escape_string($connection, $_POST['username']);
		$password = mysqli_real_escape_string($connection, $_POST['Password']);
		$sin = mysqli_real_escape_string($connection, $_POST['sin']);
		$contactinfo = mysqli_real_escape_string($connection, $_POST['contact_info']);
		$name = mysqli_real_escape_string($connection, $_POST['name']);
		$physiologicalinfo = mysqli_real_escape_string($connection, $_POST['physiological_info']);
		$workexperience = mysqli_real_escape_string($connection, $_POST['work_experience']);
		$education = mysqli_real_escape_string($connection, $_POST['education']);
		$industry = mysqli_real_escape_string($connection, $_POST['industry']);

		$_SESSION['username'] = $username;
		$_SESSION['name'] = $name;
		$_SESSION['sin'] = $sin;


		$query = 'INSERT INTO person(SIN, Password, Username, Name, Contact_info, Physiological_Info, Work_Experience, Education)';
		$query .= "VALUES ('$sin','$password', '$username','$name','$contactinfo','$physiologicalinfo','$workexperience','$education')";
		
		
		$result = mysqli_query($connection, $query);
		$result2 = mysqli_query($connection, "INSERT INTO applicant(SIN, Industry) VALUES ('$sin', '$industry')");
		
		if (!$result and !$result2) {
			die("Query Failed" . mysqli_error($connection));
		} else {
			echo "Record Created";
			return true;
		}
	}
}

//Allows applicants to view all available postings
function viewPostings() {
	global $connection;
	//$connection = mysqli_connect('localhost', 'root', '', 'postings');

	if(!$connection) {
		die("Database connection fails");
		}
	
	if(isset($_POST["view"])) {

		$query = 'SELECT * FROM postings';

		echo mysqli_query($connection, $query);
	}
}

//Create applications
function createApplication() {
	if(isset($_POST["submit"])){
	global $connection;
	
	//$connection = mysqli_connect('local', 'root', '', 'applications');
	
	if(!$connection) { 
		die("Database connection fails"); 
	}
	
	$jobid = mysqli_real_escape_string($connection, $_POST['job_id']);
	$coverletter = mysqli_real_escape_string($connection, $_POST['cover_letter']);
	$resume = mysqli_real_escape_string($connectio, $_POST['resume']);
	
	$query = 'INSERT INTO applications';
	$query .= "VALUES ('$jobid', '$coverletter', '$resume')";
	
	$result = mysqli_query($connection, $query);
	if (!$result) {
		die("Application failed" . mysqli_error($connection));
	} else {
		echo "Application submitted";
	}
	}
}

//Allows applicants view all his or her offers
function viewOffers() {
	if(isset($_POST["submit"])){
		global $connection;
		//$connection = mysqli_connect('local', 'root', '', 'offers');
		
		if (!$connection) {
			die("Database connection fails");
		}
		
		$query = 'SELECT * from offers';
		
		$result = mysqli_query($connection, $query);
		echo $result; 
		
	}
}

//Allows applicant to view the evaluation time for the for evaluations
function viewEvalTime() {
	if(isset($_POST["search"])) {
		global $sin;
		global $connection;
		
		if (!$connection_eval or !connection_app) {
			die("Database connection fails");
		}
		
		$application = mysqli_query($connection, 'SELECT application_ID from applications WHERE applications.applicant_username = sin');
		$query = 'SELECT * FROM evaluation WHERE evaluation.application_ID = $application.application_ID';
		
		echo mysqli_query($connection, $query);
		
		
	}
}
//TODO:
function searchJob() {}

//Don't need to autmoatically generate ID
?>