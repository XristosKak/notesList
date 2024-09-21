<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo App</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<?php
session_start();
if(isset($_SESSION['ses_user_id'])){ ?>
           <br>
         <div id="navbar">
                <a href="home.php">Home</a>
                <a href="logout.php">Αποσύνδεση</a>
                <a href="new.php">Προσθήκη Task</a>
          </div>
              <br>
    <div class ="container-fluid">
        <div class="row ">
            <div class="col hellobar pb-2 mb-2">
                <h1 class="hellouser">Γεια σου, <?php print $_SESSION['ses_user_name']?></h1>
                <h2 class="hellouser2"> Αυτά είναι τα task σου</h2>
                
            </div>
        </div>
    </div>  
        <?php
        include("conn.php");
        $sqltasks = "SELECT * FROM tasks";
        $result = $conn->query($sqltasks);

        if($result->num_rows>0){
            while($ttable = $result->fetch_assoc()){
            $ttid = $ttable['task_id'];
            $tasktitle = $ttable['task_title'];
            $taskdescription = $ttable['task_desc'];
            $taskmediafile = 'Files/'.$ttable['task_media']; 
            $mediafilepath = $ttable['task_media']; ?>

      <div class="row">
            <div class="col">
                <ul>
                   <li>
                        <div><h3><?php echo $tasktitle?></h3></div>
                    </li>
                    <li>
                        <div><p><?php echo $taskdescription?></p></div>
                    </li>
                    <li><?php

                         if($taskmediafile!=""){
                            echo '<div><a href="'.$taskmediafile.'" class="btn btn-primary" target="_blank"><i class="fa-regular fa-file-zipper fa-lg" id="mediadonwload"></i></a></div>';

                            
                              }
                             ?>
                        
                    </li>
                    <li>
                        <div class="row">
                            <div class="col">
                                <a class="btn btn-primary" href="edit.php?id=<?php echo $ttid; ?>">Επεξεργασία</a>
                        </div>
                        <div class="col">
                        <form action="delete.php" method="POST">
                            <input type="hidden" name="task_id" value="<?php echo $ttid; ?>">
                            <button type="submit" class="btn btn-danger">Διαγραφή</button>
                        </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>  
      </div>
   



    <?php }
        }
        ?>
       

    <?php }else{
     header("location:login.php");   
     
    }?> 

<script src="https://kit.fontawesome.com/f70c7e9929.js" crossorigin="anonymous"></script>
</body>
</html>