<?php
session_start();
include("connection.php");

if (isset($_GET['msgID'])) {
    $msgID = intval($_GET['msgID']);

    // Prepare and execute the delete statement
    $stmt = $con->prepare("DELETE FROM usermessages WHERE msgID = ?");
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($con->error));
    }

    $stmt->bind_param('i', $msgID);

    if (!$stmt->execute()) {
        die('Execute failed: ' . htmlspecialchars($stmt->error));
    }

    $stmt->close();
    header("Location: history.php");
    exit();
}
?>