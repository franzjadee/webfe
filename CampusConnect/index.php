<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

	$adminStatus = $user_data['admin'];

	if(isset($_POST['save']))
	{
		//something was posted
		$notes = htmlspecialchars($_POST['notes']);

		$uid = $user_data['uid'];

		if(!empty($notes))
		{
			//save to database
			$query = "UPDATE users SET notes = '$notes' where uid ='$uid' ";

			mysqli_query($con, $query);

			header("Location: index.php");

		}else
		{
		}

	}elseif(isset($_POST['sendMSG'])){
		$message = htmlspecialchars($_POST['msg']);

		$uid = $user_data['uid'];
		$name = $user_data['username'];
		$userIdentity = $_POST['userIdentity'];

		if( $userIdentity == "Anonymous"){
			if(!empty($message))
		{
			//save to database
			$query = "INSERT into usermessages (uid, name, message) values('$uid', 'Anonymous', '$message') ";

			mysqli_query($con, $query);

			header("Location: index.php");

		}else
		{
			echo "Error posting message: " . mysqli_error($con);
		}
		}else{if(!empty($message))
			{
				//save to database
				$query = "INSERT into usermessages (uid, name, message) values('$uid', '$name', '$message') ";
	
				mysqli_query($con, $query);
	
				header("Location: index.php");
	
			}else
			{
				echo "Error posting message: " . mysqli_error($con);
			}}
	}
		

?>

<!DOCTYPE html>
<html>

<head>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
	<title>My website</title>
	<style>
		#date {
                position: relative;
                top: 25px;
                right: -520px;
            }

	</style>
</head>
<body style="background-color:#f5f5dc;">
<div class="container-fluid row" style="height: 100vh;">

		<div class="col-3 row-auto text-white" style=" background-color:#88ac6c">
			<h1 class="text-center py-2">Campus Connect</h1>
			<br>
			<p class="text-center display-5" style="font-size:150%">Username: <span style="color:#f5f5dc;"><?php echo $user_data['username']; ?></span> </p>
			<br>
			<div class="container-fluid">
			<div class="bg-white text-dark rounded mb-5" style="height: 30vh; >
				<p class="ml-3 pt-2" id="cNotes"> <?php echo $user_data['notes']; ?> </p>
			</div>

				<div class="form-popup" id="myForm" style="display: none;">
  					<form method="post" class="form-container">

						<textarea name="notes" id="msgarea" class="form-control" style="resize:none; height: 40vh" placeholder="Type Here..." required></textarea>
						<br>
    					<input type="submit" name="save" value="Save" class="btn btn-success rounded-pill border border-secondary"></button>
    					<button type="button" class="btn btn-warning rounded-pill border border-secondary" onclick="closeForm()">Cancel</button>
  					</form>
				</div>
			</div>

			<br>

			<div class="d-flex justify-content-between">
				<button type="button" class="btn btn-default bg-white rounded-pill" style="font-weight: bold; font-size:13px;" onclick="uinfo()">User Info</button>
				<button type="button" class="btn btn-default bg-white rounded-pill" style="font-weight: bold; font-size:13px;" onclick="editform()">Edit Notes</button>
				<button type="button" class="btn btn-default bg-white rounded-pill" style="font-weight: bold; font-size:13px;" onclick="logout()">Log Out</button>
				<button type="button" class="btn btn-default bg-white rounded-pill" style="font-weight: bold; font-size:13px;" onclick="history()">History</button>
			</div>
			<div class="mt-3">

			<?php
			if($adminStatus == 1){
				echo "<button type='button' class='btn btn-primary rounded-pill' style='font-weight: bold; font-size:13px;' onclick='admin()'>Admin </button>";
			}else{

			}
			?>
			</div>
		</div>
		
		<div class="col-9 row-auto">

			<h1 class="text-center text-light rounded-pill mt-3 p-2" style="width: 300px; margin: auto; background-color: #88ac6c">News Feed</h4>

			<div class="ml-5" id="postForm" style="display: none;">
				<div class="container-fluid d-flex form-popup bg-light mt-5 justify-content-center rounded ml-5 p-0" style="height: 65vh; width: 120vh; background-color: #88ac6c">

				<div class="d-flex flex-column container-fluid p-0" name="msgbox">

					<div class="text-light display-5 text-center p-3" style="background-color: #88ac6c; font-weight: bold; font-size: 150%">
					TEXT:
					</div>


					<form action="" method="post">
						<div class="text-dark" style="">
							<textarea name="msg" id="msgarea" class="form-control" style="resize:none; height: 43vh" placeholder="Type Here..." required></textarea>

							<div class="mt-auto p-3" style="background-color: #88ac6c"> 
								<div class="d-flex">
									<input type="hidden" name="userIdentity" id="userIdentity" value="Anonymous">
									<button type="button" id="idnbtn" class="mr-auto btn text-dark rounded-pill mb-3" value="Anonymous" style="width:150px; height: 50px; font-weight: bold; background-color:#f5f5dc;" onclick="identity()">Anonymous</button>

					   				<input type="submit" name="sendMSG" value="Post" class="btn text-dark rounded-pill mb-3" value="sendMSG" style="width:100px; height: 50px; font-weight: bold; background-color:#f5f5dc;"></button>

    				   				<button type="button" class="btn text-dark rounded-pill mb-3 ml-3" style="width:100px; height: 50px; font-weight: bold; background-color:#f5f5dc;" onclick="closeMsg()">Cancel</button>
								</div>
							</div>
						
						</div>
					</form>
					
				</div>

				</div>
			</div>

			<div class="container-fluid mt-4 overflow-auto" style="width: 101vh; height:72vh; background-color:#88ac6c" id="msgContainer">
				<div class="container-fluid pl-4 pt-4" style="">

						<?php

							$sql = "SELECT * FROM usermessages ORDER BY timePosted desc";
							$msgResults = mysqli_query($con, $sql);

							while ($row = mysqli_fetch_assoc($msgResults)) { 
                                $message = $row['message'];
                                $date = $row['timePosted'];
								$msgName = $row['name'];
								$msgID = $row['msgID'];
		
								echo "<div style='overflow:hidden;'>";
								echo "<div class='text-primary' id='date'>" . $date . "</div>";
								echo "<div class='bg-white text-dark rounded-3 mb-5 border mx-auto' style='width:90vh; height:15vh;'>";
								echo "<p class='text-success ms-5 ml-1'>" . $msgName . "</p>";
                                echo "<p class='ml-3 pt-2'>" . htmlspecialchars($message) . "</p>";
								echo "</div>";
								echo "</div>";
							}
						?>
					
					</div>	
				</div>

					<div class="d-flex align-items-end flex-column">
						<button type="button" class="btn rounded-circle text-light" onclick="postMsg()" id="postbtn" style="position:relative; width:100px; height:100px; font-weight: bold;font-family: Helvetica; background-color: #88ac6c">POST</button>
					</div>

			</div>

		</div>
	</div>

</div>	

</body>
</html>

<script>

function admin(){
	window.location.href = "adminPage.php";
}

function svNote(){
	window.location.href = "userinfo.php";
}

function postMsg(){
	document.getElementById("msgContainer").style.display = "none";
	document.getElementById("postForm").style.display = "block";
	document.getElementById("postbtn").style.display = "none";
}

function identity(){
	const btn = document.getElementById("idnbtn");

	if(btn.innerText == 'Anonymous'){
		btn.value = 'User';
	    btn.innerText = 'User';
	}else{
		btn.value = 'Anonymous'
	    btn.innerText = 'Anonymous';
	}
	document.getElementById('userIdentity').value = btn.value;

}

function sendMsg(){
	document.getElementById("msgContainer").style.display = "block";
	document.getElementById("postForm").style.display = "none";
	document.getElementById("postbtn").style.display = "block";
}

function closeMsg(){
	document.getElementById("msgContainer").style.display = "block";
	document.getElementById("postForm").style.display = "none";
	document.getElementById("postbtn").style.display = "block";
}

function uinfo(){
	window.location.href = "userinfo.php";
}

function history(){
	window.location.href = "history.php";
}

function logout(){
	window.location.href = "logout.php";
}

function editform(){
	document.getElementById("myForm").style.display = "block";
	document.getElementById("cNotes").style.display = "none";
}

function closeForm(){
	document.getElementById("myForm").style.display = "none";
	document.getElementById("cNotes").style.display = "block";
}

</script>