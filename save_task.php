<?php

include("db.php");

    if (isset($_POST['login_button'])) {
        $emailUser = $_POST['email'];
        $_SESSION['mail'] = $_POST['email'];
        header("Location: index.php");
    }

    if (isset($_POST['save_task'])){
        $title = $_POST['title'];
        $description = $_POST['description'];
        $finish = $_POST['finish'];
        $due_date = $_POST['date'];
        $name = $_POST['email'];
        
        $query = "INSERT INTO task(name,title, description,finish,due_date) VALUES ('$name','$title', '$description','$finish','$due_date')";
        $result = mysqli_query($conn, $query);

        if (!$result){
            die("Query failed");
        }

        $_SESSION['message'] = 'Task Saved Sucessfully';
        $_SESSION['message_type'] = 'success';
        
        header("Location: index.php");
    }

?>