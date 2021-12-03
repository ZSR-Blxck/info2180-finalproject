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

	$result = $conn -> prepare("SELECT firstname FROM Users");
	$result -> execute();
	$users = $result->fetch();
?>
<!DOCTYPE html>
<html style="font-size: 16px;">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="styles/styles.css">
  </head>

  <header>
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

	</header>
    <section>
      <div class="main">
        <h2>Create Issue</h2>
        <div>
          <form method="post" name="form" action="issue.php">
            <div>
              <label>Title</label>
              <input type="text" name="title" id="issue-title">
            </div>

            <div>
              <label>Description</label>
              <textarea name="desc" id="description"></textarea>
            </div>

            <div>
              <label>Assigned To</label>
              <div>
                <select id="assigned" name="assign">
				<?php foreach ($users as $row): ?>
				    <option> <?echo "$row";?> </option>
				<?php endforeach ?>
                </select>
              </div>
            </div>

            <div>
              <label>Type</label>
              <div>
                <select id="type" name="type">
                  <option value="bug">Bug</option>
                  <option value="proposal">Proposal</option>
                  <option value="task">Task</option>
                </select>
              </div>
            </div>

            <div>
              <label>Priority</label>
              <div>
                <select name="priority">
                  <option value="minor">Minor</option>
                  <option value="major">Major</option>
                  <option value="critical">Critical</option>
                </select>
              </div>
            </div>

            <div>
              <input id="submit" type="submit" value="submit">
            </div>

          </form>
        </div>
      </div>
    </section>
  </body>
</html>