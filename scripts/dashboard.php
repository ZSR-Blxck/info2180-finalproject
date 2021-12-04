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
			<a href="">Home</a><br>
			<a href="register.html">Add User</a><br>
			<a href="create_issue.php">New Issue</a><br>
			<a href="session_destroy.php">Logout</a>
		</div>
      <div>
		<div class="heading">
			<h2>Issues</h2>
			<button type="button">Create New Issue</button>
		</div>
        <div>
          <ul>
            <li>
              <a>All</a>
            </li>
            <li>
              <a>Open</a>
            </li>
            <li>
              <a>My Tickets</a>
            </li>
          </ul>
        <div>
          <table>
            <colgroup>
              <col width="22%">
              <col width="22%">
              <col width="22%">
              <col width="22%">
              <col width="22%">
            </colgroup>
            <thead>
              <tr>
                <th>Title</th>
                <th>Type</th>
                <th>Status</th>
                <th>Assigned To</th>
                <th>Created</th>
              </tr>
            </thead>
            <tbody>
              <!-- <tr>
                <td>Setup Logger</td>
                <td>Bug</td>
                <td>Open</td>
                <td>Marsha Brady</td>
                <td>2019-10-29</td>
              </tr> -->
              <?php foreach ($issues as $row)
			        {
			        	echo '<tr>';
                		echo '<td>'.$row['title'].'</td>';
		                echo '<td>'.$row['type'].'</td>';
		                echo '<td>'.$row['status'].'</td>';
		                echo '<td>'.$row['assigned_to'].'</td>';
		                echo '<td>'.$row['created'].'</td>';
		                echo '</tr>';
			        	 // $dataTable .= $row['title'].'</td><td>'. $row['type'] . '</td><td>' . $row['status'] .'</td><td>' . $row['assigned_to'] .'</td><td>'. $row['created'] .'</td></tr>';
			        }
			   ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>
    </section>
  </body>
</html>