<?php

include("db.php");

    if (isset($_POST['login_button'])) {
        $emailUser = $_POST['email'];
        $password = $_POST['password'];
        $_SESSION['mail'] = $_POST['email'];

        if (!empty($emailUser) && !empty($_POST['password'])) {
            $records = $connUser->prepare('SELECT id,email,password,master FROM users WHERE email=:email');
            $records->bindParam(':email',  $emailUser);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);
            // echo $results['master'];
    
            if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
                $_SESSION['master'] =  $results['master'];
                $_SESSION['message'] = "Login successful";
                $_SESSION['message_type'] = "success";
                header("Location: index.php");
            } else {
                $_SESSION['message'] = "The password is incorrect";
                $_SESSION['message_type'] = "danger";
                header("Location: login/login.php");
            }
        }
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