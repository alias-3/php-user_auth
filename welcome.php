<?php
require('config.php');

   session_start();
	$name =  $_SESSION['username'];
   //include('session.php');
?>
<!doctype html>
<html>
   
   <head>
      <title>Welcome </title>
   </head>
   
   <body>
      <h1>Welcome <?php echo $name; ?></h1> 
      <h2><a href="logout.php">Sign Out</a></h2>
   </body>
   
</html>