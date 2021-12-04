<?php
session_start();

// remove all session variables
session_unset();

// destroy the session
session_destroy();
header("location: http://localhost/info2180-project2_/login.html")
?>