<?php
session_start();
require_once 'dbconfig.php';
	try{
		$conn = new PDO("mysql:host = $host; dbname=$dbname", $username,$password);
		//header( "Location: Create-Issue.html");
		$conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			} catch (PDOException $pe) {
		    die("Could not connect to the database $dbname :" . $pe->getMessage());
		}

	$result = $conn -> prepare("SELECT * FROM Issues");
	$result -> execute();
	$issues = $result->fetchAll();
?>
<!DOCTYPE html>
<html style="font-size: 16px;">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
	<title>BugMe Issue Tracker</title>
	<link rel="stylesheet" type="text/css" href="styles/styles2.css">
  </head>
  <body>
	<div class= "nav-bar">
		<h3>BugMe Issue Tracker</h3>	
	</div>
	<div class="container">
		<div class="nav-panel">
			<a href="dashboard.php">Home</a><br>
			<a href="register.html">Add User</a><br>
			<a href="create_issue.php">New Issue</a><br>
			<a href="session_destroy.php">Logout</a>
		</div>
	<section>

		<div>
	      	<?php foreach ($issues as $row)
				{
			        <h2>Title</h2>
			        <h4>Issue</h4>
			        <p>Sample text. </p>
					<div>
				}?>
		</div>

		<div>
			<?php foreach ($issues as $row)
				{	
			        <h6>Issue Created</h6>
			        <h6>Last Updated</h6>
				}?>
		</div>

		<br>
        <div>
        
          <div>
	          	<?php foreach ($issues as $row){

		            <h5>Assigned To</h5>
					<p>Sample</p>
		            <h5>Type</h5>
					<p>Sample</p>
		            <h5>Priority</h5>
					<p>Sample</p>
		            <h5>Status</h5>
					<p></p>
				}?>
          </div>
		  <div>
			<button type="button">Mark as Closed</button>
			<button type="button">Mark In Progress</button>
		  </div>
      </div>
    </section>
      </div>
  </body>
</html>