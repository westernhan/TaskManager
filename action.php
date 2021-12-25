<?php
/*
 * action php file
 * all the actions of the todo list 
 * add, edit, update, and delete
 * 
 */
require_once 'login.php';

session_start();

$mysqli = new mysqli($hn, $un, $pw, $db) or die(mysqli_error($mysqli));

$id=0;
$update= false;
$date= "";
$task= "";

//Saving Task Input
if(isset($_POST['add'])){
    $date = $_POST['date'];
    $task = $_POST['task'];

    $mysqli-> query("INSERT INTO tasks(date, task) VALUES('$date', '$task') ") or
        die($mysqli->error);


    header("Location: todo.php");
}

//Delete Unwanted Tasks
if(isset($_GET['delete'])){
    $id= $_GET['delete']; //The value the need to be deleted
    $mysqli->query("DELETE FROM tasks WHERE id=$id") or die($mysqli->error());

    header("Location: todo.php");
}

//Modify/Edit Tasks
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $conn = $mysqli->query("SELECT * FROM tasks where id=$id") or die ($mysqli->error());
    if(!empty($conn)){  
        $row = $conn->fetch_array();  
        $date = $row['date'];
        $task = $row['task'];
    }
}

//Update Modifications
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $date = $_POST['date'];
    $task = $_POST['task'];

    $mysqli->query("UPDATE tasks SET date='$date', task='$task' WHERE id=$id")
    or die($mysqli->error);

    header("Location: todo.php");

}


//Marked as Completed Tasks
if(isset($_GET['complete'])){
    $id = $_GET['complete'];

    //get data
    $conn = $mysqli->query("SELECT * FROM tasks where id=$id") or die ($mysqli->error());
    $row = $conn->fetch_array();  
    $date = $row['date'];
    $task = $row['task'];

    //keep track in next table
    $mysqli-> query("INSERT INTO completedtasks(date, task) VALUES('$date', '$task') ") 
    or die($mysqli->error);

    //remove completed from main
    $mysqli->query("DELETE FROM tasks WHERE id=$id") or die($mysqli->error());

    header("Location: todo.php");
}

//Clear Completes Tasks
if(isset($_GET['remove'])){
    $id= $_GET['remove']; 
    $mysqli->query("DELETE FROM completedtasks WHERE id=$id") or die($mysqli->error());

    header("Location: complete.php");
}
