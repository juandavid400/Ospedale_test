<?php include("../db.php");?>
<?php include("../includes/header.php") ?>

<div class="container p-4">
<a style="margin-top:5%" href="../index.php" type="button" class="btn btn-dark btn-block" name="consult_task">Back to home</a>
    <div class="row">
    <div class="col-md-12">
            <?php if(isset($_SESSION['message'])) { ?>
                <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                
            <?php } 
            $filter = null;
            $finishFilter = null;
            ?>
            <form name="myform" action="" method="post">
            <div class="form-group mb-3">
                        <label>Filter Users:</label>
                        <select required name="filter" onchange="this.form.submit()" class="form-select form-select-md mb-3" aria-label=".form-select-sm example">
                            <option value="all"<?php if($filter == "all"){ echo " selected"; }?> >All the users</option>
            <?php
                $queryU =  "SELECT * FROM users";
                $result_tasksU = mysqli_query($connTableUsers, $queryU); 
                
                if(isset($_POST['filter'])){
                    $filter = $_POST['filter'];
                }
                if(isset($_POST['finishFilter'])){
                    $finishFilter = $_POST['finishFilter'];
                }

                while ($rowU = mysqli_fetch_array($result_tasksU)) { ?>
                    
                            <option value="<?= $rowU['email']?>" <?php if($filter == $rowU['email']){ echo " selected"; }?> ><?php echo $rowU['email']?></option>
                          
            <?php } ?>
                </select>

                <div class="form-group mb-3">
                        <label>Finished task filter:</label>
                        <select required name="finishFilter" onchange="this.form.submit()" class="form-select form-select-md mb-3" aria-label=".form-select-sm example">
                            <option value="all" <?php if($finishFilter == 'all'){ echo " selected"; }?> >All</option>
                            <option value="Yes" <?php if($finishFilter == 'Yes'){ echo " selected"; }?> >Yes</option>
                            <option value="No" <?php if($finishFilter == 'No'){ echo " selected"; }?> >No</option>
                        </select>
                </div>
            </div>  
            </form>
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

                    while ($row = mysqli_fetch_array($result_tasks)) { 
                        if ($filter == 'all') {
                            if ($finishFilter == 'all') {
                        ?>
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
                    
                    <?php }
                          if ($finishFilter == $row['finish']) {?>
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
                     <?php } }elseif ($filter == $row['name']) {
                                if ($finishFilter == 'all') {
                          ?>
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
                    <?php }if ($finishFilter == $row['finish']) { ?>
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
                <?php } }}?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include("../includes/footer.php") ?>    