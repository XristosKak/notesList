<?php
session_start();
if (!isset($_SESSION['ses_user_id'])) {
    header("location: login.php");
}

include("conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_id'])) {
    $task_id = $_POST['task_id'];

    $stmt = $conn->prepare("DELETE FROM tasks WHERE task_id = ?");
    $stmt->bind_param("i", $task_id);
    if ($stmt->execute()) {
        header("location: home.php"); 
    } else {
        echo "Error deleting task: " . $conn->error;
    }
}
?>