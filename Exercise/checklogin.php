<?php

session_start();

$database = new PDO(
    "mysql:host=devkinsta_db;dbname=ToDoList", 
    'root', // username
    'WlekfIFX5rxSbNj2' // password 
);

$email = $_POST['email'];
$password = $_POST['password'];

if( empty($email) || empty($password)){
    echo 'Email and Password is Required';
} else {
    $sql = "SELECT * FROM users where email = :email";

    $query = $database->prepare( $sql );

    $query->execute([
        'email' => $email

    ]);

    $user = $query->fetch(); // fetch() will only return one row of data

    // make sure the email provided is in the database
    if ( empty( $user ) ) {
        echo "The email provided does not exists";
    } else {
        // make sure password is correct
        if ( password_verify( $password, $user["password"] ) ) {
            // if password is valid, set the user session
            $_SESSION["user"] = $user;

            header("Location: todolist.php");
            exit;
        } else {
            // if password is incorrect
            echo "The password provided is not match";
        }
    }
}
?>