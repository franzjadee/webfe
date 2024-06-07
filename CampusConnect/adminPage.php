<?php

session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

    $adminStatus = $user_data['admin'];

    if($adminStatus == 0){
        header("Location: index.php");
    }else{

    }

?>

<!DOCTYPE html>
<html>

<head>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<title>User History</title>
<style> 
            #btnDelete {
                position: relative;
                top: -25px;
                right: -580px;
            }

            #btnEdit {
                position: relative;
                top: -25px;
                right: -450px;
            }

            #date {
                position: relative;
                top: 25px;
                right: -520px;
            }

            #userName {
                position: absolute;
                top: 15px;
                right: 150px;
            }

             #wrapper {
             position: absolute;
             top: 0;
             right: 0;
             }
          </style>
</head>


<body style="background-color:#f5f5dc;">
<header class=" pl-5 pt-4  container-fluid mb-5 display-5 text-white p-3" style="font-size:30px;background-color:#88ac6c">
<p >Campus Connect </p>

<div id="userName"> <?php echo $user_data['username']; ?> </div>

<div id="wrapper">

<button type="button" class="btn btn-default bg-white rounded-pill mt-4 mr-5 text-success " style="font-weight: bold  
  top: 0;" onclick="ufeed()">Return</button>

</div>

</header>

 
<body class="d-flex flex-column min-vh-150 justify-content-center" style="background-color:#88ac6c;">

    <div class=" display-5">
    <p class="display-4 mb-5 text-center" style="color:#88ac6c">Entire User History</p> 

    <div class="container-fluid mt-4 overflow-auto" style="width: 101vh; height:50vh; background-color:#88ac6c" id="msgContainer">
				<div class="container-fluid pl-4 pt-4" style="">

						<?php
							$uid = $user_data['uid'];

							$sql = "SELECT * FROM usermessages ORDER BY timePosted desc";
							$msgResults = mysqli_query($con, $sql); // First parameter is just return of "mysqli_connect()" function

                        if(mysqli_num_rows($msgResults) > 0) {

							while ($row = mysqli_fetch_assoc($msgResults)) { // Important line, returns assoc array
                                $msgName = $row['name'];
                                $message = $row['message'];
                                $date = $row['timePosted'];
								$msgName = $row['name'];
                                $msgID = $row['msgID'];
                                

								echo "<div style='overflow:hidden;'>";
								echo "<div class='text-primary' id='date'>" . $date . "</div>";
								echo "<div class='bg-white text-dark rounded-3 mb-5 border mx-auto' style='width:90vh; height:15vh;'>";
								echo "<p class='text-success ms-5 ml-1'>" . $msgName . "</p>";
                                echo "<p class='ml-3 pt-2'>" . htmlspecialchars($message) . "</p>";

                                echo "<form method='get' action='delete_message.php' style='display:inline;'>";
                                echo "<input type='hidden' name='msgID' value='$msgID'>";
                                echo "<input type='submit'id='btnDelete' value='Delete' class='btn btn-danger rounded-pill' onclick='return confirm(\"Are you sure you want to delete this message?\");'>";
                                echo "</form>";

								echo "</div>";
								echo "</div>";
							}

                        }else{
                            echo "<p class='text-light ms-5 ml-1 display-3'>" . "Go post something!" . "</p>";
                        }
						?>
					
					</div>	
				</div>

    <footer class="" style="background-color: #88ac6c; position: absolute; bottom:0; width: 100%;">
        <div class="container-fluid">
            <p class="text-center text-light display-5" style="font-size:20px;">EastWoods Professional College of Science and Technology </p><br>
        </div>
    </footer>

</body>
</html>

<script>

function ufeed(){
	window.location.href = "index.php";
}

</script>
