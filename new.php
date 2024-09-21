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
    <link rel="stylesheet" href="global.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Add Task</title>
</head>
<body>
            <br>
          <div id="navbar">
                <a href="home.php">Home</a>
                <a href="logout.php">Αποσύνδεση</a>
                <a href="new.php">Προσθήκη Task</a>
          </div>
              <br>
    <div class="container mt-5">
    <form action="" method="POST" enctype="multipart/form-data">
    <input type="text" class="form-control mb-2" placeholder="Τίτλος Task" name="tasktitle" required>
    <textarea class="form-control mb-2" cols="60" rows="20" placeholder="Περιγραφή" name="taskdesc"></textarea>
    <input type="file" class="form-control mb-5" name="mediafiles">
    <input type="submit" value="Καταχώρηση Task" class="btn btn-primary form-control">
    </form>
    </div>
</body>
</html>

<?php
if($_POST){
    $ttitle = $_POST['tasktitle'];
    $tdescr = $_POST['taskdesc'];
    $tfiles = $_FILES['mediafiles']['name'];

    $target = "Files/".basename($tfiles);
    if(move_uploaded_file($_FILES['mediafiles']['tmp_name'],$target));

    include("conn.php");

    $stmt = $conn->prepare("INSERT tasks (user_id,task_title,task_desc,task_media) VALUES (?,?,?,?)");
    $stmt->bind_param("ssss",$_SESSION['ses_user_id'],$ttitle,$tdescr,$tfiles);
    
    if($stmt->execute()){
       header("location:path.php");
    }else{
        echo "<script>alert('Κάτι πήγε λάθος! Προσπάθησε ξανά');</script>";
    }

    

}

?>