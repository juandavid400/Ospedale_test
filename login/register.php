<?php include("../db.php") ;

    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $confirm_password = $_POST['confirm_password'];
        $passwordBeforeHash = $_POST['password'];

        $sql = "INSERT INTO users (email, password, master) VALUES (:email , :password, :master)";
        $stmt = $connUser->prepare($sql);
        $stmt->bindParam(':email',$_POST['email']);
        $password = password_hash($_POST['password'],PASSWORD_BCRYPT);
        $stmt->bindParam(':password',$password);
        $stmt->bindParam(':master',$_POST['master']);

        if ($confirm_password == $passwordBeforeHash) {
            if ($stmt->execute()) {
                $_SESSION['message'] = 'Account registered Sucessfully';
                $_SESSION['message_type'] = 'success';
                header("Location: login.php");
            } else{
                $_SESSION['message'] = 'Error creating your password';
                $_SESSION['message_type'] = 'danger';
            }
        } else {
            $_SESSION['message'] = 'The password dont match';
            $_SESSION['message_type'] = 'danger';
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

            <div class="card card-body">
                <form action="" method="POST">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Email</span>
                        <input required autofocus type="text" name="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Password</span>
                        <input required type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">confirm_password</span>
                        <input required type="password" name="confirm_password" class="form-control" placeholder="Confirm password" aria-label="confirm_password" aria-describedby="basic-addon1">
                    </div>

                    <div class="form-group mb-3">
                        <label>Master permisions?</label>
                        <select required name="master" class="form-select form-select-md mb-3" aria-label=".form-select-sm example">
                            <option value="" disabled selected>Select one</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>

                    <input name="register_button" type="submit" class="btn btn-success btn-block" value="Register">
                </form>
                <div class="column" style="margin-top:5%;text-align:center;">
                    <a href="login.php">Go to login</a>
                </div>                
            </div>
        </div>
    </div>
</div>

<?php include("../includes/footer.php") ?>