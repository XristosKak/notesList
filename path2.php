<?php
session_start();
if(!isset($_SESSION['ses_user_id'])){
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Todo App</title>
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-8 offset-2">
                <h2>Η καταχώρηση ολοκληρώθηκε επιτυχώς!</h2>
            </div>
        </div>
        <div class="row mt-5">
                <a class="btn btn-primary" href="home.php">Αρχική</a>
            </div>
        </div>
    </div>
</body>
</html>