<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$check = "";

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		
		//something was posted
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$gender = $_POST['gender'];

		if(!empty($username) && !empty($password) && !is_numeric($username))
		{
			$checkQuery = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
			$checkResult = mysqli_query($con, $checkQuery);

			if($checkResult)
			{
				if($checkResult && mysqli_num_rows($checkResult) > 0)
				{
					$check = "Username / Email Already Taken!";
				}else
					{

					$uid = random_num(20);
					$query = "insert into users (uid,firstname,lastname,email,username,password,gender) values ('$uid','$firstname','$lastname','$email','$username','$password','$gender')";

					mysqli_query($con, $query);

					header("Location: login.php");
					die;
					}
				
			}
		}else
		{
			$check = "Missing Information";
		}
	}
?>


<!DOCTYPE html>
<html>

<head>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

<title>Signup</title>
</head>
<body>
<header class=" text-center container-fluid mb-5 display-4 text-white p-3" style="background-color: #88ac6c">
<p >Campus Connect</p>
</header>


<body class="d-flex flex-column min-vh-100 justify-content-center" style="background-color:#f5f5dc ;">

    <div class="text-center py-5">  

	<form method="post">
	Firstname: <input type="text" name="firstname" class=" mb-3" placeholder="FirstName">
		<br>			
	Lastname: <input type="text" name="lastname" class=" mb-3" placeholder="LastName">
		<br>		
	Email: <input type="email" name="email" class=" mb-3" placeholder="Email">
		<br>	
	Username: <input type="text" name="username" class=" mb-3" placeholder="Username">
		<br>									
	Password: <input type="password" name="password" class=" mb-3" placeholder="Password">
		<br>
	Gender: <select type="radio" name="gender" class=" mb-3">
				<option value="Male">Male</option>
				<option value="Female">Female</option>
				<option value="Other">Other</option>
			</select>
		<br>
		<input type="submit" value="Sign Up" class="btn rounded-pill text-white" style="background-color: #88ac6c;">

		<input type="button" value="Log In" class="btn rounded-pill text-white" style="background-color: #88ac6c;" onclick="login()">
		<br>

		<br>
		<p class="text-danger"><?php

					echo $check;
				
				?></p> 
	</form>
		
	</div>

	<footer class="mt-auto" style="background-color: #88ac6c;">
        <div class="container-fluid">
            <p class="text-center text-light display-5" style="font-size:20px;">EastWoods Professional College of Science and Technology </p><br>
	    <div>
    </footer>

</body>
</html>

<script>

	function login(){
		window.location.href = "login.php";
	}

</script>