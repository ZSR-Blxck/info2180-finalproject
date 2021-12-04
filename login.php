<?php

require_once "dbconfig.php";
require_once "session.php";
$count = 0;
 if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form

      $email = $_POST['email'];
      $_password =$_POST['password'];
      $compare = ("SELECT OLD_PASSWORD('$_password')");
      $admin ="admin@project2.com";

      $email = filter_var($email, FILTER_SANITIZE_EMAIL);
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {  try{
     	$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    	    $conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
          // CATCHES ERRORS AND PRINTS FAILURE MESSAGE
    	} catch (PDOException $pe) {
        die("Could not connect to the database $dbname :" . $pe->getMessage());
    	}
        $result = $conn-> prepare("SELECT * FROM Users WHERE email = :email");

        $email = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_EMAIL); 

        $result->bindParam(':email', $email, PDO::PARAM_INT);

        $result -> execute(array('email'=> $_POST["email"]));

        $row = $result->fetch(PDO::FETCH_ASSOC);
        if(is_array($row))
        {
            if ($_POST['email'] === $admin)
            {
                $_SESSION['login_user'] = $email; 
                header( "Location: admin/dashboard.php");
             /* if($compare == $_password){
                $_SESSION['login_user'] = $email; 
                header( "Location: admin/dashboard.php");
              }else {
                 $error = "Your Password is invalid";
                 echo nl2br ("$error \r\n");
                }*/
            }else {
             if ( password_verify($_password,$row['password']))
                {
                    $_SESSION['login_user'] = $email; 
                    header( "Location: user/dashboard.php");
                }else {
                 $error = "Your User Name or Password is invalid";
                 echo nl2br ("$error \r\n");
                }
            }
        }
    }else{
        $error = "Your Login Name or Password is invalid";
        echo nl2br ("$error \r\n");
        header( "Location: login.html");
    }
}