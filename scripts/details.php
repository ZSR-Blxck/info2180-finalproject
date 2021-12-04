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

	$iss = $_SESSION['name'];

	$result = $conn -> prepare("SELECT * FROM Issues WHERE title = '$iss'");
	$result -> execute();
	$issues = $result->fetchAll();
?>
<!DOCTYPE html>
<html style="font-size: 16px;">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
	<title>BugMe Issue Tracker</title>
	<link rel="stylesheet" type="text/css" href="styles/styles.css">
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
			        echo'<h2>'.$row['title'].'</h2>';
			       	echo '<h4>'.$row['description'].'</h4>';
			        echo '<p>'. "Issue #",$row['id']. '</p>';
					'<div>';
				}
			?>
		</div>

		<div>
			<?php foreach ($issues as $row)
				{	
			        echo '<h6>'."Issue created on ". $row['created']. "by". $row['created_by'].'</h6>';
			        echo '<h6>'."Last Updated on ".$row['updated'].'</h6>';
				}?>
		</div>

		<br>
        <div>
        
          <div>
	          	<?php foreach ($issues as $row){

		            echo '<h5>'."Assigned To:".'</h5>';
		            echo $row['assigned_to'];
		            echo '<h5>'."Type:".'</h5>';
					echo $row['type'];
		            echo '<h5>'."Priority:".'</h5>';
					echo $row['priority'];
		            echo '<h5>'."Status:".'</h5>';
		            echo $row['status'];
					'<p></p>';
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