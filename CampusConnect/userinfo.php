<?php

session_start();

	include("connection.php");
	include("functions.php");

    $check = "";

	$user_data = check_login($con);

    if($_SERVER['REQUEST_METHOD'] == "POST")
	{
        $uid = $user_data['uid'];
		//something was posted
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$gender = $_POST['gender'];

		if(!empty($username) && !empty($password) && !is_numeric($username))
		{
			//save to database
			
			$query = "UPDATE users SET firstname='$firstname', lastname='$lastname', email='$email', username='$username', password='$password', gender='$gender' WHERE uid = '$uid' ";

			mysqli_query($con, $query);
		}
	}


?>

<!DOCTYPE html>
<html>

<head>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

<title>UserInfo</title>
</head>
<body>
<header class=" text-center container-fluid mb-3 display-4 text-white p-3" style="background-color: #88ac6c;">
<p >Campus Connect</p>
</header>


<body class="d-flex flex-column min-vh-100 justify-content-center" style="background-color:#f5f5dc;">

    <div class="text-center display-5">

        <div id="infoEdit" style="display: none">
            <div class="text-center py-5" > 
            <p class="display-4 py-3 mb-4" style="color: #88ac6c;">Edit Info</p>  

                <form method="post">
                First Name: <input type="text" name="firstname" class=" mb-3" placeholder="<?php echo $user_data['firstname']; ?>" required>
                    <br>			
                Last Name: <input type="text" name="lastname" class=" mb-3" placeholder="<?php echo $user_data['lastname']; ?>" required>
                    <br>		
                 Username: <input type="text" name="username" class=" mb-3" placeholder="<?php echo $user_data['username']; ?>" required>
                    <br>
                Email: <input type="email" name="email" class=" mb-3" placeholder="<?php echo $user_data['email']; ?>" required>
                    <br>							
                Password: <input type="password" name="password" class=" mb-3" placeholder="<?php echo $user_data['password']; ?>" required>
                    <br>
                Gender: <select type="radio" name="gender" class=" mb-3">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    <br>
                    <input type="submit" value="Confirm" class="btn rounded-pill text-white" style="background-color: #88ac6c;">
                    <button type="button" class="btn btn-danger rounded-pill" onclick="cancel()">Cancel</button>

                    <br>
                </form>
            
            </div>
        </div>

        <div id="userInfo">
        <p class="display-4 py-3 mb-4" style="color: #88ac6c;">User Info</p> 
        <h2>User ID : <span><?php echo $user_data['uid']; ?></span></h2>
        <h2>First Name : <span><?php echo $user_data['firstname']; ?></span></h2>
        <h2>Last Name : <span><?php echo $user_data['lastname']; ?></span></h2>
        <h2>Username : <span><?php echo $user_data['username']; ?></span></h2>
        <h2>Email : <span><?php echo $user_data['email']; ?></span></h2>
        <h2>Password : <span><?php echo $user_data['password']; ?></span></h2>
        <h2 class="mb-5">Gender : <span><?php echo $user_data['gender']; ?></span></h2>
        </div>
       
    <div id="buttons">
    <button type="button" class="btn btn-default bg-white rounded-pill" style="font-weight: bold" onclick="ufeed()">Return</button>
    <button type="button" class="btn btn-warning rounded-pill" style="font-weight: bold" onclick="infoChange()">Change Info</button>
    </div>
	
	</div>

    <footer class="mt-auto" style="background-color: #88ac6c;">
        <div class="container-fluid">
            <p class="text-center text-light display-5" style="font-size:20px;">EastWoods Professional College of Science and Technology </p><br>
        </div>
    </footer>

</body>
</html>

<script>

var buttons = document.getElementById("buttons");

var infoEdit = document.getElementById("infoEdit");
var userInfo = document.getElementById("userInfo");

function infoChange(){
    infoEdit.style.display = "block";
    userInfo.style.display = "none";
    buttons.style.display = "none";
}

function cancel(){
    infoEdit.style.display = "none";
    userInfo.style.display = "block";
    buttons.style.display = "block";
}


function ufeed(){
	window.location.href = "index.php";
}

</script>