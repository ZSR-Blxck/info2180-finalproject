<?php
session_start();
?>
<!DOCTYPE html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>BugMe Issue Tracker</title>
   <link rel="stylesheet" type="text/css" href="styles/styles.css">
</head>

<body>
   <div class= "nav-bar">
     <a href="register.html">
         <h3>BugMe Issue Tracker</h3></a>   
   </div>
 
      <div class="main">
         <form method="post" name="form" action="login.php">
            <h1>User Login</h1>

            <label>Email</label><br>
            <input type="text" name="email" id="email"/><br><br>

            <label>Password</label><br>
            <input type="password" name="password" id="password"/><br><br>

            <button id="submit">Login</button>

         </form>

      </div>
<?php
// remove all session variables
session_unset();

// destroy the session
session_destroy();
?>

</body>
</html> 