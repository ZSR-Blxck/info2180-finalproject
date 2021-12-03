<?php
session_start();

$id= '';
$title = $_POST['title'];
$desc = $_POST['desc'];
$assign= $_POST['assign'];
$type= $_POST['type'];
$priority= $_POST['priority'];
$status = "Open";
$created = date("Y.m.d");
$updated = date("Y.m.d");
$created_by = $_SESSION['login_user'];
$created_by = 18;
echo "$created_by";


$titleErr = $descErr = $assignErr = $typeErr= $priorityErr="";

// DECLARE ARRAY TO STORE ERRORS
$err = array();

// NESTED-IF STATEMENT TO PERFORM VALIDATION OF DATA  
/*if($_SERVER["REQUEST_METHOD"]=="POST")
{
	try {
		// CHECKS IF FIELD IS EMPTY
		if (empty($_POST["title"])) 
		{
			// INSERTS ERROR INTO ARRRAY
			array_push($err, $titleErr);
		}

		// CHECKS IF FIELD IS EMPTY
	  	if (empty($_POST["desc"])) 
	  	{
			// INSERTS ERROR INTO ARRRAY
			array_push($err, $descErr);
		}

		// CHECKS IF FIELD IS EMPTY
	    //if (empty($_POST["assign"]))
	    //{
			// INSERTS ERROR INTO ARRRAY
			//array_push($err, $assignErr);
		//}

		// CHECKS IF FIELD IS EMPTY
	    if (empty($_POST["type"])) 
	    {
			// INSERTS ERROR INTO ARRRAY
			array_push($err, $typeErr);
		}

		// CHECKS IF FIELD IS EMPTY
	    if (empty($_POST["priority"])) 
	    {
			// INSERTS ERROR INTO ARRRAY
			array_push($err, $priorityErr);
		}}

		catch ( \Exception $e) {
		header( "Location:Create-Issue.html");
	}
}*/	

// CHECKS ERROR ARRAY AND IF EMPTY CONNECTS TO DATABASE
if (sizeof($err)==0) {
	require_once 'dbconfig.php';
	try{
		$conn = new PDO("mysql:host = $host; dbname=$dbname", $username,$password);
		header( "Location: create_issue.php");
		$conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			} catch (PDOException $pe) {
		    die("Could not connect to the database $dbname :" . $pe->getMessage());
		}

	/*$result = $conn -> prepare("SELECT id FROM Users WHERE email = '$created_by'");
	$result -> execute();
	$users = $result ->fetch(); 

	foreach ($users as $row)
	{
	    $created_by = $row;
	    echo "$created_by";
	}*/

	$res = $conn -> prepare("SELECT id FROM Users WHERE firstname = '$assign'");
	$res -> execute();
	$stmt = $res->fetch(); 

	foreach ($stmt as $row)
	{
	    $assign = $row;
	    echo "$assign";
	}

	$insertData = "INSERT INTO Issues(title,description,type,priority,status,assigned_to,created_by,created,updated) VALUES('$title','$desc','$type','$priority','$status','$assign','$created_by','$created','$updated')";

	$conn->exec($insertData);
}
