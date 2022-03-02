<?php include("../db.php");

    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $records = $connUser->prepare('SELECT id,email,password FROM users WHERE email=:email');
        $records->bindParam(':email', $_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
            $_SESSION['usser_id'] =  $_POST['email'];
            $_SESSION['message'] = "Login successful";
            $_SESSION['message_type'] = "success";
            header("Location: ../index.php");
        } else {
            $_SESSION['message'] = "The password is incorrect";
            $_SESSION['message_type'] = "danger";
        }
    }

?>
<?php include("../includes/header.php") ?>

<div class="container p-4">
    <h1>Welcome</h1>
    <div class="row">
        <div class="col-md-4">
            <?php if(isset($_SESSION['message'])) { ?>
                <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            <?php session_unset(); ?> 

            <div class="card card-body">
                <form action="../save_task.php" method="POST">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Email</span>
                        <input autofocus type="text" name="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Password</span>
                        <input type="text" name="password" class="form-control" placeholder="password" aria-label="password" aria-describedby="basic-addon1">
                    </div>

                    <input style="margin-top:5%;" name="login_button" type="submit" class="btn btn-success btn-block" value="Login">
                </form>
                <div class="column" style="margin-top:5%;text-align:center;">
                    <a href="register.php">Register</a>
                </div>                
            </div>
        </div>
    </div>
</div>

<?php include("../includes/footer.php") ?>