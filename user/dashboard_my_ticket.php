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
	<link rel="stylesheet" type="text/css" href="styles.css">
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
      <div>
		<div class="heading">
			<h2>Issues</h2>
			<button type="button"><a href="create_issue.php">Create New Issue</a><br></button>
		</div>
        <div>
          <ul>
            <li>
              <a href="dashboard.php">All</a>
            </li>
            <li>
              <a href="dashboard_open.php">Open</a>
            </li>
            <li>
              <a href="dashboard_my_ticket.php">My Tickets</a>
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

              <form method="post" action="details.php">
                <?php foreach ($issues as $row)
    			        {
    			        	echo '<tr>';
                    		echo '<td>'.'<a href="details.php">' .$row['title'].'</a></td>';
                        $_SESSION['name'] = $row['title'];
    		                echo '<td>'.$row['type'].'</td>';
    		                echo '<td>'.$row['status'].'</td>';
    		                echo '<td>'.$row['assigned_to'].'</td>';
    		                echo '<td>'.$row['created'].'</td>';
    		                echo '</tr>';
    			        }
  			         ?>
            </form>

            </tbody>
          </table>
        </div>
      </div>
    </section>
    </section>
  </body>
</html>