<?php

$id = '';
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$password= $_POST['password'];
$email= $_POST['email'];
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$password_digest = password_hash($password, PASSWORD_DEFAULT);
$date_joined = date("Y.m.d");

$fnameErr = $lnameErr = $passwordErr = $emailErr="";

// DECLARE ARRAY TO STORE ERRORS
$err = array();

// NESTED-IF STATEMENT TO PERFORM VALIDATION OF DATA  
//CHECKS IF EMAIL
if (filter_var($email, FILTER_VALIDATE_EMAIL));
{
	
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		try {
			// CHECKS IF FIELD IS EMPTY
			if (empty($_POST["fname"])) 
			{
				// INSERTS ERROR INTO ARRRAY
				array_push($err, $fnameErr);
			}

			// CHECKS IF FIELD IS EMPTY
		  	if (empty($_POST["lname"])) 
		  	{
				// INSERTS ERROR INTO ARRRAY
				array_push($err, $lnameErr);
			}

			// CHECKS IF FIELD IS EMPTY
		    if (empty($_POST["email"]))
		    {
				// INSERTS ERROR INTO ARRRAY
				array_push($err, $emailErr);
			}

			// CHECKS IF FIELD IS EMPTY
		    if (empty($_POST["password"])) 
		    {
				// INSERTS ERROR INTO ARRRAY
				array_push($err, $passwordErr);
			}else 
			{
				// CHECKS IF VALUE WAS NOT ALPHANUMERIC 
				if(!preg_match("/^[a-zA-Z0-9]*$/", $password))
				{
					// INSERTS ERROR INTO ARRRAY
					array_push($err, $passwordErr);
				}else{
					$password = $_POST["password"];
				}
			}
		} catch ( \Exception $e) {
			header( "Location: register.html");
		}
}}		

// CHECKS ERROR ARRAY AND IF EMPTY CONNECTS TO DATABASE
if (sizeof($err)==0) {
	require_once 'dbconfig.php';
	try{
		$conn = new PDO("mysql:host = $host; dbname=$dbname", $username,$password);
		header( "Location: register.html");
		$conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			} catch (PDOException $pe) {
		    die("Could not connect to the database $dbname :" . $pe->getMessage());
		}

$insertData = "INSERT INTO Users(firstname,lastname,password,email,date_joined) VALUES('$fname','$lname','$password_digest','$email','$date_joined')";

$conn->exec($insertData);
}
