<?php
    // start a session
    session_start();

    // connect to database (PDO - PHP database Object)
    $database = new PDO(
        "mysql:host=devkinsta_db;dbname=ToDoList", 
        'root', // username
        'WlekfIFX5rxSbNj2' // password 
    );

    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // 1. make sure all fields are not empty
    if ( empty( $name ) || empty($email) || empty($password) || empty($confirm_password)  ) {
        echo 'All fields are required';
    } else if ( $password !== $confirm_password ) {
        // 2. make sure password is match
        echo 'The password is not match.';
    } else if ( strlen( $password ) < 8 ) {
        // 3. make sure password is at least 8 chars.
        echo "Your password must be at least 8 characters";
    } else {
        // recipe
        $sql = "INSERT INTO users ( `name`, `email`, `password` )
            VALUES (:name, :email, :password)";
        // prepare
        $query = $database->prepare( $sql );
        // execute
        $query->execute([
            'name' => $name,
            'email' => $email,
            'password' => password_hash( $password, PASSWORD_DEFAULT ) // convert user's password to random string
        ]);

        // redirect user back to index.php
        header("Location: todolist.php");
        exit;
    }