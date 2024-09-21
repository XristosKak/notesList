
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>My todo App</title>
</head>
<body>
<div class="container-fluid">
      <div class="row p-5 ">
        <div class="col shadow ">
        <h1 class="reg-title">Σύνδεση</h1>
        <form action="" method="post">
            <div class="col">
                <h4>Email</h4>
                <input type="email" placeholder="ex: Your email" required name="email">
                <br>
            </div>
            <div class="col">
                <h4>Password</h4>
                <input type="password" placeholder="ex: Your Password" required name="password">
            </div>
        <div class="row reg-btn">
            <input class="btn btn-primary" type
            ="submit" value="Σύνδεση">
        </div>
    </form>
    <div class="row logref"><span>Δεν έχετε λογαριασμό; <a href="register.php">Κάντε Εγγραφή</span></a></div>
    <div>
    </div>
    <!-- <script src="validation.js"></script> -->
</body>
</html>

<?php
if($_POST){
    $email = $_POST['email'];
    $password = $_POST['password'];
    
  include("conn.php");
    
//   $select = "SELECT * FROM user_reg WHERE user_e_mail = '$email' && user_pass = '$password '";

  $stmt = $conn->prepare("SELECT * FROM users WHERE user_e_mail=? AND user_pass=? ");
  $stmt->bind_param("ss", $email ,$password);

  $stmt->execute();

  $result = $stmt->get_result();

  if($result->num_rows===1){

    $row = $result->fetch_assoc();
    session_start();
    $_SESSION['ses_user_name'] = $row['user_name'];
    $_SESSION['ses_user_id'] = $row['user_id'];

     header("location:home.php") ;
  }
  
//   else{
//      echo "Λάθος στοιχεία σύνδεσης";
//   }

}


?>