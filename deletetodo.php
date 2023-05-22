<?php

$database = new PDO(
    "mysql:host=devkinsta_db;dbname=ToDoList", 
    'root', // username
    'WlekfIFX5rxSbNj2' // password 
);

$task_id = $_POST["task_id"];

if ( empty( $task_id ) ) {
    echo "Missing List";
} else {
    // recipe
    $sql = "DELETE FROM todo WHERE id = :id";

    // prepare
    $query = $database->prepare($sql);

    // execute (cook)
    $query->execute([
        'id' => $task_id
    ]);

    // redirect to the index.php
    header("Location: /");
        exit;

}
?>