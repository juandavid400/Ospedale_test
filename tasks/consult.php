<?php include("../db.php");?>
<?php include("../includes/header.php") ?>

<div class="container p-4">

    <div class="row">
    <div class="col-md-12">
            <?php if(isset($_SESSION['message'])) { ?>
                <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?> 
            <!-- <?php session_unset(); ?>  -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Created at</th>
                        <th>Name</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Finish</th>
                        <th>Due date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 

                    $query =  "SELECT * FROM task";
                    $result_tasks = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_array($result_tasks)) { ?>
                        <tr>
                            <td><?php echo $row['created_at']?></td>
                            <td><?php echo $row['name']?></td>
                            <td><?php echo $row['title']?></td>
                            <td><?php echo $row['description']?></td>
                            <td><?php echo $row['finish']?></td>
                            <td><?php echo $row['due_date']?></td>
                            
                            <td>
                                <a href="../edit_task.php?id=<?php echo $row['id']?>" class="btn btn-warning">
                                    <i class="fas fa-marker"></i>
                                </a>
                                <a href="../delete_task.php?id=<?php echo $row['id']?>" class="btn btn-danger">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include("../includes/footer.php") ?>    