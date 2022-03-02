<?php include("db.php");?>
<?php include("includes/header.php") ?>


<div class="container p-4">

    <div class="row">
        <div class="col-md-4">
            

            <?php if(isset($_SESSION['message'])) { ?>
                <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>           
            

            <div class="card card-body">
                <form action="save_task.php" method="POST">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Title</span>
                        <input required autofocus type="text" name="title" class="form-control" placeholder="Title" aria-label="Username" aria-describedby="basic-addon1">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Description</span>
                        <input required type="text" name="description" class="form-control" placeholder="Description" aria-label="Description" aria-describedby="basic-addon1">
                    </div>

                    <div class="form-group">
                        <input style="display:none;" type="text" name="email" value="<?=$_SESSION['mail']?>">
                    </div>

                    <div class="form-group mb-3">
                        <label>Finished:</label>
                        <select required name="finish" class="form-select form-select-md mb-3" aria-label=".form-select-sm example">
                            <option value="" disabled selected>Select one</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Due date:</label>
                        <input required type="text" name="date" class="form-control" placeholder="Due date" autofocus>
                    </div>
                    <input style="margin-top:5%" type="submit" class="btn btn-success btn-block" name="save_task" value="Save task">
                    <?php if(isset($_SESSION['master']) && $_SESSION['master'] == 'Yes') { ?>
                        <a style="margin-top:5%" href="tasks/consult.php" type="button" class="btn btn-warning btn-block" name="consult_task">Consult</a>
                    <?php } ?>  
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Due date</th>
                        <!-- <th>Actions</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php 

                    $query =  "SELECT * FROM task";
                    $result_tasks = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_array($result_tasks)) { ?>
                        <tr>
                            <td><?php echo $row['name']?></td>
                            <td><?php echo $row['title']?></td>
                            <td><?php echo $row['description']?></td>
                            <td><?php echo $row['finish']?></td>
                            <td><?php echo $row['due_date']?></td>
                            <!-- <td>
                                <a href="edit_task.php?id=<?php echo $row['id']?>" class="btn btn-warning">
                                    <i class="fas fa-marker"></i>
                                </a>
                                <a href="delete_task.php?id=<?php echo $row['id']?>" class="btn btn-danger">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </td> -->
                        </tr>
                    
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>


<?php include("includes/footer.php") ?>    