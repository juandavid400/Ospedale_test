<?php

include("db.php");

    if (isset($_POST['save_task'])){
        $title = $_POST['title'];
        $description = $_POST['description'];

        if (isset($_SESSION[usser_id])) {
            $emailUser = $_SESSION[usser_id];
        }
        
        $query = "INSERT INTO task(name,title, description) VALUES ('$emailUser','$title', '$description')";
        $result = mysqli_query($conn, $query);

        if (!$result){
            die("Query failed");
        }

        $_SESSION['message'] = 'Task Saved Sucessfully';
        $_SESSION['message_type'] = 'success';
        
        header("Location: index.php");
    }

?>