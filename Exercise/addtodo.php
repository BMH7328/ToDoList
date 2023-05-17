<?php

$database = new PDO(
    "mysql:host=devkinsta_db;dbname=ToDoList", 
         'root', // username
         'WlekfIFX5rxSbNj2' // password 
);

$task_name = $_POST['task_name'];

if (empty($task_name)){
    echo "Missing Task";
} else {
    
    $sql = 'INSERT INTO todo (`task`, `completed`) VALUES(:task, :completed)';
    
    $query = $database->prepare( $sql );
    
    $query->execute([
        'task'=> $task_name,
        'completed' => 0
    ]);

header("Location: todolist.php");
exit;
}
?>