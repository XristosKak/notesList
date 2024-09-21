<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>My todo App</title>
</head>
<body>
    <div class="container-fluid p-5">
        <div class="col p-5 shadow ">
        <div class="row"><h1 class="reg-title">Εγγραφή</h1></div>
        <form action="" method="post">
        <div class="row ">
            <div class="col">
                <h4>Email</h4>
                <input class="form-control" placeholder="ex: me@email.com" required type="email" name="email">
            </div>
            <div class="col ">
                <h4>Username</h4>
                <input class="form-control" placeholder="ex: YourName" required type="text" name="username">
            </div>
            <div class="col">
                <h4>Password</h4>
                <input class="form-control" placeholder="ex: Password123@!" required  type="password" name="password">
            </div>
        </div>
        <div class="row reg-btn">
            <div class="col">
            <input class="btn btn-primary w-100" type ="submit" value="Εγγραφή">
            </div>
        </div>
    </form>
    <div class="row logref mt-3"><span>Έχω λογαριασμό. <a href="login.php">Θέλω να κάνω σύνδεση</span></a></div>
    </div>
    </div>
    <!-- <script src="validation.js"></script> -->
</body>
</html>

<?php
if($_POST){
    $user_name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
  include("conn.php");
    
//   $insert = "INSERT INTO user_reg(user_e_mail, user_pass, user_name) VALUES ('$email','$password','$user_name')";

  $stmt = $conn->prepare("INSERT INTO users (user_e_mail, user_pass, user_name) VALUES (?,?,?)");
  $stmt->bind_param("sss",$email,$password,$user_name);

  if($stmt->execute()){
    echo "Σε ευχαρστούμε για την εγγραφή σου χρήστη";
}else{
    echo "Λάθος ή ελλιπής στοιχεία εγγραφής";
}

}

?>