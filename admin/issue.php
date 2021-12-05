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
$created_by = $_SESSION["login_user"];

$titleErr = $descErr = $assignErr = $typeErr= $priorityErr="";

// DECLARE ARRAY TO STORE ERRORS
$err = array();

// CHECKS ERROR ARRAY AND IF EMPTY CONNECTS TO DATABASE
if (sizeof($err)==0) {
	require_once 'dbconfig.php';
	try{
		$conn = new PDO("mysql:host = $host; dbname=$dbname", $username,$password);
		$conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			} catch (PDOException $pe) {
		    die("Could not connect to the database $dbname :" . $pe->getMessage());
		}

	$result = $conn -> prepare("SELECT * FROM Users WHERE email = '$created_by'");
	$result -> execute();
	$users = $result ->fetchAll(); 

	foreach ($users as $row)
	{
	    $created_by = $row['id'];
	    echo "$created_by";
	}

	$res = $conn -> prepare("SELECT * FROM Users WHERE firstname = '$assign'");
	$res -> execute();
	$stmt = $res->fetchAll(); 

	foreach ($stmt as $row)
	{
	    $assign = $row['id'];
	    echo "$assign";
	}

	$insertData = "INSERT INTO Issues(title,description,type,priority,status,assigned_to,created_by,created,updated) VALUES('$title','$desc','$type','$priority','$status','$assign','$created_by','$created','$updated')";

	$conn->exec($insertData);
	header( "Location: create_issue.php");
}
