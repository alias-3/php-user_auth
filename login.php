<?php
   require('config.php');
   session_start();
   
	   if(isset($_POST['login']))
	   {
	   		$name = $_POST['name'];
	   		$email = $_POST['email'];
	   		$contact = $_POST['contact'];
	   		$password = $_POST['password'];

	   		if($_SERVER['REQUEST_METHOD']=="POST")
	   		{
	   	
	   			if(!(empty($name) && empty($email) && empty($contact)) && !empty($password))
		   		{	
		   			$query = "SELECT Name FROM user_login WHERE (Name = '{$name}'OR Email = '{$email}' OR Contact = '{$contact}') AND Password = '{$password}'";

		   			

		   			$result = mysqli_query($conn,$query);
		   			
		   			
		   			$count = mysqli_num_rows($result);

		   			if($count)
		   			{
		   				$_SESSION['username'] = $name;
		   				echo $count;
		   				echo "user". $name ."found"; 
		   				header("Location:welcome.php");
		   			}	
		   			else{
		   				echo "no such user found";
		   				
		   			}
		   		} 
		   		else{
	   				echo "please fill the form";
	   			}
		   	}	   			 
   		}
?>

<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script>
		function opt(e){
			var a = e.value;
			if(a=="name"){
				document.getElementById("name").removeAttribute("hidden");
				document.getElementById("email").hidden = "true";
				document.getElementById("contact").hidden = "true";
			}
			else{
				document.getElementById("contact").removeAttribute("hidden");
				document.getElementById("email").hidden = "true";
				document.getElementById("name").hidden = "true";
			}
		}
	</script>
</head>
<body>
	<nav class="container-fluid navbar-custom navbar-fixed-top"  data-spy="affix" role="navigation">
		<a class="navbar-brand" href="home.php">BFL</a>
		<div class="navbar-header"> 
           <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
            </button>
			<div class="collapse navbar-collapse " id="myNavbar">
			<ul class="nav navbar-nav">
				<li><a class="glyphicon glyphicon-home"></a></li>
			</ul>
		</div>	
	</div>
	</nav>
	<div class="container" id="content">
			<?php if(isset($msg) && $msg != "PASS"):?>
		<div id="msg" class="alert <?php echo $msgClass;?>">
			<?php echo $msg;?></div>
			<?php endif;?>
				<div class="form-group">Other login options: 
					<nav id="login-type">
						<button class="btn btn-default" onClick="opt(this)" value="name">Name</button>
						<button class="btn btn-default" onClick="opt(this)" value="mobile">Mobile</button>
						<!--<button id="log" onClick="opt()" value="email">Email</button>-->
					</nav>
				</div>
		
		<form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>">	

			<div hidden id="name" class="form-group">Name: <input title="contains only alphabets" class="form-control" type="text" name="name"></div>
					
			<div id="email" class="form-group">Email: <input title="" class="form-control" type="text" name="email"></div>
					
			<div hidden id="contact" class="form-group">Contact: <input title="Enter mobile number(helpful for sms alerts)" class="form-control" type="number" name="contact"></div>					
			<div class="form-group">Password: <input title="Type a password" class="form-control" type="password" name="password"></div>

			<input class="btn btn-default" type="submit" name="login">
		</form>
	</div>
</body>
</html>