
<?php
/*
 * copmplete php file
 * Form is to show all completed tasks from todolist
 */
    require_once 'action.php';    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>TaskMaster Completed Tasks</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">

    <!-- CHECK SESSION SECURITY -->
    <?php 
        $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
        if ($_SESSION['ip'] != $_SERVER['REMOTE_ADDR']) 
            different_user();
        
        if($_SESSION['check'] = hash('ripemd128', $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'])){
            $conn = $mysqli->query("SELECT * FROM completedtasks") or die($mysqli->error);
        }
    ?>


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
                <a href="action.php?remove=<?php echo $row['id'];?>"
                class="btn btn-danger">Delete</a>
            </td>
        </tr>

        <?php endwhile;?>
        </table>
    
    </div>
    <a href="todo.php" class="btn btn-primary" name="return">Go back</a>
    </div>
</body>
</html>