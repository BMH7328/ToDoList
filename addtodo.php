<?php

session_start();

$database = new PDO(
    "mysql:host=devkinsta_db;dbname=ToDoList", 
         'root', // username
         'WlekfIFX5rxSbNj2' // password 
);

$task_name = $_POST['task_name'];

if (empty($task_name)){
    $error = "Missing List, Pls Type Anything";
} else {
    
    $sql = 'INSERT INTO todo (`task`, `completed`) VALUES(:task, :completed)';
    
    $query = $database->prepare( $sql );
    
    $query->execute([
        'task'=> $task_name,
        'completed' => 0
    ]);

header("Location: /");
exit;
}
 // do error checking
 if ( isset( $error ) ) {
    // store the error message in session
    $_SESSION['error'] = $error;
    // redirect the user back to login.php
    header("Location: /");
    exit;
}
?>