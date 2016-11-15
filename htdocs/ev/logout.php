<?php		
//to garantee we are on the same session
session_start();
//remove all session variables
session_unset(); 
//destroy the session 
session_destroy(); 
header("Location: signin.php");
die();
?>