<?php
session_start();
include("connection.php");

if (isset($_POST['msgID'])) {
    $msgID = intval($_POST['msgID']);

    $query = "DELETE from usermessages WHERE msgID = '$msgID' ";

			mysqli_query($con, $query);

			header("Location: history.php");
}
?>