<?php
		
	require('config.php');


	$email_err = $name_err = $pass_err = $website_err = $contact_err = "";
	$f = 1;
	if(filter_has_var(INPUT_POST, 'submit'))
	{
		if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["contact"]) && isset($_POST["website"]) && isset($_POST["description"]) && isset($_POST["pass_confirm"]) && isset($_POST["pass_confirm"])&& isset($_POST['location']) && isset($_POST['category']))
		{
			$email = $_POST['email'];
			$name = $_POST['name'];
			$contact = $_POST['contact'];
			$desc = $_POST['description'];
			$website = $_POST['website'];
			$password = $_POST['password'];
			$pass_confirm = $_POST['pass_confirm'];
			$location = $_POST['location'];
			$category = $_POST['category'];
			
			$msg = "PASS";

			if($_SERVER["REQUEST_METHOD"]=="POST")
			{
				if(!(empty($name) && empty($email) && empty($contact) && empty($desc) && empty($website) && empty($password) && empty($pass_confirm) && empty($pass_confirm) && empty($category)))
				{
					$email = filter_var($email, FILTER_SANITIZE_EMAIL);
					$website = strpos($website, 'http') !== 0 ? "http://$website" : $website;
					$website = filter_var($website, FILTER_SANITIZE_URL);
					if(!preg_match("/^[a-zA-Z0-9 ]*$/",$name)){
						$name_err = "name invalid";	$f = 0;
					}

					
					if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
						$email_err = "*email not valid"; $f = 0;
					}

					if($password!=$pass_confirm){
						$pass_err = "*passwords do not match";$f = 0;
					}

					if(!(filter_var($contact,FILTER_VALIDATE_INT) && preg_match("/^[789]\d{9}$/",$contact))&&(strlen((string)$contact)!=10))
					{
					//!preg_match("/^[789]\d{9}$/",$contact)===false && (strlen((string)$contact)!=10)){
						$contact_err = "*invalid contact"; $f = 0;
					}
						
					if(!filter_var($website,FILTER_VALIDATE_URL)){
						$website_err = "*website not valid"; $f =0;	
					}
					if($f == 1){						
						$query = "INSERT INTO user_login (Name,Email,Location,Description,Category,Contact,Website,Password)
								VALUES ('$name','$email','$location','$desc','$category','$contact','$website','$password')";

						if(mysqli_query($conn,$query))
							header("Location:home.php");	
						else
							echo "error during account creation";
					}

				}
				else
				{
					$msg = "*please fill all details*";
					$msgClass = 'alert-danger';
				}
			}
		}
	}


?>

<!DOCTYPE html>
<html>
<head>
	<title>SIGN UP</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
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
				<form id="carform" method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>">
				<div class="form-group">Name: <input title="contains only alphabets" class="form-control" type="text" name="name"><?php echo $name_err; ?></div>
				<div class="form-group">Email: <input title="" class="form-control" type="text" name="email"><?php echo $email_err;?></div>
				<div class="form-group">Location: 
				<select name="location" form="carform">
					<option value = "Pune">Pune</option>
					<option value = "Mumbai">Mumbai</option>
					<option value = "Delhi">Delhi</option>
					<option value = "Chennai">Chennai</option>
				</select></div>
				<div class="form-group">Description: <input title="Enter description" class="form-control" type="text" name="description"></div>
				<div class="form-group">Category: <input title="Enter category" class="form-control" type="text" name="category"></div>
				<div class="form-group">Contact: <input title="Enter mobile number(helpful for sms alerts)" class="form-control" type="number" name="contact"><?php echo $contact_err;?></div>				
				<div class="form-group">Website: <input title="Enter website" class="form-control" type="text" name="website"><?php echo $website_err?></div>
				<div class="form-group">Password: <input title="Type a password" class="form-control" type="password" name="password"></div>
				<div class="form-group">Confirm Password: <input title="Confirm password " class="form-control" type="password" name="pass_confirm"><?php echo $pass_err; ?></div>
				<input class="btn btn-default" type="submit" name="submit">
				</form>
			</div>
</body>
</html>