
<?php
include "db_functions.php";

if (isset($_POST['username']) && isset($_POST['password'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = connect_to_db();
    //find the user in the db
    $data = find_user($conn, $username, $password);

    if (mysqli_num_rows($data) === 1) {

        $row = $data->fetch_assoc();

        if ($row['username'] == $username && $row['password'] == $password) {

            //if a normal user has logged in, go to voting. Otherwise, go to the admin panel
            if ($row['is_admin'] == 0)
                header("Location: voting_page.php");
            else
                header("Location: admin_panel.php");

        } else {

            echo "incorrect username or password";
            header("Location: login.html");
        }

    } else {

        echo "incorrect username or password";
        header("Location: login.html");
    }

} else {

    header("Location: login.html");
}

exit();
?>