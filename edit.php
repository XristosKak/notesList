<?php
session_start();

if (!isset($_SESSION['ses_user_id'])) {
    header("location: login.php");
    
}

include("conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_id'])) {
    
    $task_id = $_POST['task_id'];
    $new_task_title = $_POST['task_title'];
    $new_task_desc = $_POST['task_desc'];

 
    $stmt = $conn->prepare("UPDATE tasks SET task_title = ?, task_desc = ? WHERE task_id = ?");
    $stmt->bind_param("ssi", $new_task_title, $new_task_desc, $task_id);
    if ($stmt->execute()) {
        header("location:path2.php");
    } else {
        echo "Error updating task: " . $conn->error;
    }
}

if (isset($_GET['id'])) {
    $task_id = $_GET['id'];

    
    $stmt = $conn->prepare("SELECT * FROM tasks WHERE task_id = ?");
    $stmt->bind_param("i", $task_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $task = $result->fetch_assoc();
        
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo App</title>
    <link rel="stylesheet" href="global.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<h1>Επεξεργασία Task</h1>
             <br>
         <div id="navbar">
                <a href="home.php">Home</a>
                <a href="logout.php">Αποσύνδεση</a>
                <a href="new.php">Προσθήκη Task</a>
          </div>
              <br>
    <div class="container-fluid">
        <form action="" method="POST">
            <input type="hidden" name="task_id"  value="<?php echo $task['task_id']; ?>" >
            <input type="text"   class="form-control mb-2 mt-2" placeholder="Τίτλος Task" name="task_title" value="<?php echo $task['task_title']; ?>"required>
            <textarea name="task_desc" class="form-control mb-2" cols="60" rows="20" placeholder="Περιγραφή" required><?php echo $task['task_desc']; ?></textarea>
            <!-- Other fields for editing, if any -->
            <input type="submit" value="Καταχώρηση Task" class="btn btn-primary form-control">
        </form>
    </div>
</body>
</html>
<?php
    } else {
        
        echo "<script>alert('To task δεν υπάρχει στη βάση δεδομένων μας!');</script>";
    }
} else {
    
    echo "<script>alert('Δεν βρέθηκε task id!');</script>";
}
?>
