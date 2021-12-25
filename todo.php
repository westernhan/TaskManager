<?php
/*
 * todo php file
 * Form is to keep track of user task added to the list
 * User is able to add to list, edit their task, delete and mark task as complete
 */
    require_once 'action.php';    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>TaskMaster</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
<body>
    <!-- TODOLIST CONTAINER -->
    <div class="container">
        
        <!-- CHECK SESSION SECURITY -->
        <?php 
            $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
            if ($_SESSION['ip'] != $_SERVER['REMOTE_ADDR']) 
                different_user();
            
            if($_SESSION['check'] = hash('ripemd128', $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'])){
                $conn = $mysqli->query("SELECT * FROM tasks") or die($mysqli->error);
            }
        ?>

        <!-- PRINT DATE AND TASK -->
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Date Made</th>
                        <th>Task</th>
                        <th>Actions</th>
                    </tr>
                </thead>

            
                <!-- Data from Database -->
                <?php while($row = $conn->fetch_assoc()): ?> 
                <tr>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['task']; ?></td>
                <td>
                    <!-- EDIT, DELETE OR MARK AS COMPLETE -->
                    <a href="todo.php?edit=<?php echo $row['id'];?>"
                    class="btn btn-info">Edit</a>
                    <a href="action.php?delete=<?php echo $row['id'];?>"
                    class="btn btn-danger">Delete</a>
                    <a href="action.php?complete=<?php echo $row['id'];?>"
                    class="btn btn-secondary">Completed</a>
                </td>
            </tr>

            <?php endwhile ;?>
            </table>
        
        </div>

        <!--TaskMaster Form-->
        <div class="row justify-content-center" style = "">
            <form action="action.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <div class="form-group row ">
                    <label><b>Date</b></label>
                    <input type="date" name="date" value="<?php echo $date; ?>"
                    class="form-control" placeholder="(YYYY-MM-DD)" required>
                </div>

                <div class="form-group row">
                    <label><b>Task</b></label>
                    <input type="message" name="task" value="<?php echo $task; ?>"
                    class="form-control form-control-lg" placeholder="Enter Tasks" required>
                </div>

                <div class="form-group row">
                    <?php if($update == true): ?>
                        <button type="submit" class="btn btn-warning" name="update">Update</button>
                    <?php else: ?>
                        <button type="submit" class="btn btn-primary" name="add">Add</button>
                    <?php endif;?>
                </div>
            </form>
        </div>
        <a href="complete.php" class="btn btn-primary" >Completed Tasks</a>
        <div>
            <a href="logout.php" >Logout</a>
        </div>
        
    </div>
</body>
</html>