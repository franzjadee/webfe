<?php 

session_start();

	include("connection.php");
	include("functions.php");

	$check = "";

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$username = $_POST['username'];
		$password = $_POST['password'];

		if(!empty($username) && !empty($password) && !is_numeric($username))
		{

			//read from database
			$query = "select * from users where username = '$username' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{

						$_SESSION['uid'] = $user_data['uid'];
						header("Location: index.php");
						die;
					}
				}
			}
			
			$check = "Incorrect Username or Password";
		}else
		{
			$check = "Incorrect Username or Password";
		}
	}


	
?>

<!DOCTYPE html>
<html lang="en">
	
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Connect</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>

<header class=" text-center container-fluid mb-5 display-4 text-white p-3" style="background-color: #88ac6c;">
<p >Campus Connect</p>
</header>


<body class="d-flex flex-column min-vh-100" style="background-color:#f5f5dc;">
    <div class="text-center py-5 ">  



		<div class="container ">
        
    </div>

            <form method="post"> 
                <div style="font-size: 20px; margin: 10px; color: white;" class="text-success">Login</div>
                <input id="text" type="text" name="username" class=" mb-3" placeholder="Username">
				<br>
                <input id="text" type="password" name="password" class=" mb-3" placeholder="Password ">
				<br>
                <input id="button" type="submit" value="Submit" class="btn text-white rounded-pill" style="background-color: #88ac6c;"><br><br>
                <a href="signup.php">Click to Signup</a>
				<br>
				<p class="text-danger"><?php

					echo $check;
				
				?></p> 
            </form>
        </div>
    </div>


	<footer class="mt-auto" style="background-color: #88ac6c;">
        <div class="container-fluid">
            <p class="text-center text-light display-5" style="font-size:20px;">EastWoods Professional College of Science and Technology </p><br>
	    <div>
    </footer>

</div>  
</div>

</section>

</footer>

</body>
</html>

