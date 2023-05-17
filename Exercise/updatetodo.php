<?php

    // connect to database (PDO - PHP database Object)
    $database = new PDO(
        "mysql:host=devkinsta_db;dbname=ToDoList", 
        'root', // username
        'WlekfIFX5rxSbNj2' // password 
    );

    $task_completed = $_POST['task_completed'];
    $task_id = $_POST['task_id'];

    if( $task_completed == 0){
        $task_completed = 1;
    }else if( $task_completed == 1){
        $task_completed = 0;
    }

    if (empty( $task_id )){
        echo "Empty";
    }else{
        $sql = 'UPDATE todo set completed = :completed WHERE id = :id';
        // prepare
        $query = $database->prepare( $sql );
        // execute
        $query->execute([
            'completed' => $task_completed,
            'id' => $task_id
        ]);        
        
        // 3. redirect the user back to index.php
        header("Location: todolist.php");
        exit;

    }
    