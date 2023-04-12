<?php

include "db_functions.php";
include "User.php";

if (isset($_POST['username']) && isset($_POST['password'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    //check to make sure the user doesn't already exist in the database
    $conn = connect_to_db();
    $data = find_user($conn, $username, $password);

    if (mysqli_num_rows($data) === 1) {

        echo "User already exists";
        header("Location: create_account.php?error=User already exists.");
        exit();
    } else {

        $user = new User($username, $password, false); //any user being made this way won't be an admin
        insert_user($conn, $user);
        //return to the login page where they can use their new credentials
        header("Location: login.html");
    }
}
?>


