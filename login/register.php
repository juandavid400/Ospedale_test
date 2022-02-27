<?php include("../db.php") ;
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $sql = "INSERT INTO users (email, password) VALUES (:email , :password)";
        $stmt = $connUser->prepare($sql);
        $stmt->bindParam(':email',$_POST['email']);
        $password = password_hash($_POST['password'],PASSWORD_BCRYPT);
        $stmt->bindParam(':password',$password);

        if ($stmt->execute()) {
            $_SESSION['message'] = 'Account registered Sucessfully';
            $_SESSION['message_type'] = 'success';
            header("Location: login.php");
        } else{
            $_SESSION['message'] = 'Error creating your password';
            $_SESSION['message_type'] = 'danger';
        }
    } 
?>
<?php include("../includes/header.php") ?>

<div class="container p-4">
    <h1>Welcome</h1>
    <div class="row">
        <div class="col-md-4">

            <div class="card card-body">
                <form action="" method="POST">

                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="Enter your email" autofocus>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" rows="2" class="form-control" placeholder="Enter your password">
                    </div>
                    <div class="form-group">
                        <input type="password" name="confirmpassword" rows="2" class="form-control" placeholder="Confirm your password">
                    </div>
                    <select class="form-select" name="master" aria-label="Default select example">
                        <option selected>Selectec a value</option>
                        <option value="1">Yes</option>
                        <option value="2">No</option>
                    </select>
                    <input type="submit" class="btn btn-success btn-block" value="Login">
                </form>
                <div class="column" style="margin-top:5%;text-align:center;">
                    <a href="login.php">Go to login</a>
                </div>                
            </div>
        </div>
    </div>
</div>

<?php include("../includes/footer.php") ?>