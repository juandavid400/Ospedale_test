<?php 
    include("db.php");

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM task WHERE id = $id";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $title = $row['title'];
            $description = $row['description'];
            $finish = $row['finish'];
            $due_date = $row['due_date'];    
        }
    }

    if (isset($_POST['update'])) {
        $id = $_GET['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $finish = $_POST['finish'];
        $due_date = $_POST['due_date']; 

        $query = "UPDATE task set title = '$title', description = '$description', finish = '$finish', due_date = '$due_date' WHERE id = $id";
        mysqli_query($conn, $query);

        $_SESSION['message'] = "Task Update Succesfully";
        $_SESSION['message_type'] = "info";
        if ($_SESSION['master'] == 'No') {
            header("Location: index.php");
        } else {
            header("Location: tasks/consult.php");
        }
        
    }

?>

<?php include("includes/header.php") ?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="edit_task.php?id=<?php echo $_GET['id']; ?>" method = "POST">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Title</span>
                        <input required required autofocus type="text" value="<?php echo $title;?>" name="title" class="form-control" placeholder="Title" aria-label="Username" aria-describedby="basic-addon1">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Description</span>
                        <input required required type="text" value="<?php echo $description;?>" name="description" class="form-control" placeholder="Description" aria-label="Description" aria-describedby="basic-addon1">
                    </div>

                    <div class="form-group">
                        <label>Finished:</label>
                        <select name="finish" class="form-select form-select-lg mb-3" >
                            <option required value="<?php echo $finish;?>" disabled selected><?php echo $finish;?></option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input name="due_date" rows="2" class="form-control" placeholder="Update the due date" value="<?php echo $due_date; ?>">
                    </div>
                    <button class="btn btn-success" name="update"> Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php") ?>   