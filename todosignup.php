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

    $sql = "SELECT * FROM users where email =:email";
    $query = $database->prepare( $sql );
    // execute
    $query->execute([
        'email'=>$email
    ]);
    $user = $query->fetch();

    // 1. make sure all fields are not empty
    if ( empty( $name ) || empty($email) || empty($password) || empty($confirm_password)  ) {
        $error = 'All fields are required';
    } else if ( $password !== $confirm_password ) {
        // 2. make sure password is match
        $error = 'The password is not match.';
    } else if ( strlen( $password ) < 8 ) {
        // 3. make sure password is at least 8 chars.
        $error = "Your password must be at least 8 characters";
    }else if ($user){
        $error = "This email is own by someone, pls try again with another email.";
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
        header("Location: /login");
        exit;
    }

     // do error checking
     if ( isset( $error ) ) {
        // store the error message in session
        $_SESSION['error'] = $error;
        // redirect the user back to login.php
        header("Location: /signup");
        exit;
    }

    ?>