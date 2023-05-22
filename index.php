<?php

    // enable session in /
    session_start();

    // your website path
    // parse_url will remove all the query string starting from the ?
    $path = parse_url( $_SERVER["REQUEST_URI"], PHP_URL_PATH );
    // remove / using trim()
    $path = trim( $path, '/' );

    if ( $path == 'login' ) {
        // load login.php
        require "logintodo.php";
    } else if ( $path == 'signup' ) {
        // load signup.php
        require "signuptodo.php";
    } else if ( $path == 'logout' ) {
        // load logout.php
        require "logouttodo.php";
    } else {
        // load home.php
        require "todolist.php";
    }