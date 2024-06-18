<?php

session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

    $adminStatus = $user_data['admin'];

    if($adminStatus == 0){
        header("Location: index.php");
    }else{
        if (isset($_GET['msgID'])) {
            $msgID = intval($_GET['msgID']);
        
            $query = "DELETE from usermessages WHERE msgID = '$msgID' ";
        
                    mysqli_query($con, $query);
        
                    header("Location: adminPage.php");
        }

    }

?>